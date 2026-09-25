<?php
session_start();
require_once 'db.php';

$controller = new AuthController();

$acao = $_GET['acao'] ?? 'index';
switch ($acao) {
    case 'login':
        $controller->login();
        break;
    case 'cadastrar':
        $controller->cadastrar();
        break;
    case 'salvar':
        $controller->salvar();
        break;
    case 'sair':
        $controller->sair();
        break;
    default:
        $controller->index();
}

class AuthController {

    public function index() {
        if (isset($_SESSION['usuario_id'])) {
            header("Location: home.php");
            exit;
        }
        $this->login();
    }

    public function cadastrar() {
        include "_cabecalho.php";
        include 'cadastro.php';
        include "_rodape.php";
    }

    public function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pdo = getConnection();
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
        $stmt->execute([':email' => $email, ':senha' => $senha]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            $_SESSION['usuario_id'] = $usuario['id'];
            header("Location: home.php");
            exit;
        }
    }

    include "_cabecalho.php";
    include 'login.php';
    include "_rodape.php";
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pdo = getConnection();
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
            $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':senha' => $senha
            ]);

            header("Location: authController.php?acao=login");
            exit;
        }
    }

    public function sair() {
        session_destroy();
        header("Location: authController.php?acao=login");
        exit;
    }
}