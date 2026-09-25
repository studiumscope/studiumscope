<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../authController.php?acao=login");
    exit;
}

require_once __DIR__ . '/../../db.php';
$pdo = getConnection();
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (!empty($senha)) {
        $stmt = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = :id");
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senha,
            ':id' => $_SESSION['usuario_id']
        ]);
    } else {
        $stmt = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id");
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':id' => $_SESSION['usuario_id']
        ]);
    }
    $mensagem = "Perfil atualizado com sucesso!";
}

$stmt = $pdo->prepare("SELECT nome, email FROM usuarios WHERE id = :id");
$stmt->execute([':id' => $_SESSION['usuario_id']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    header("Location: ../../authController.php?acao=sair");
    exit;
}

include 'perfil.php';