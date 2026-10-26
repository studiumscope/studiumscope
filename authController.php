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

            // 1. Buscamos apenas pelo e-mail (nunca pela senha direto no SQL)
            $stmt = $pdo->prepare("SELECT id, senha FROM usuarios WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // 2. Usamos password_verify para checar a senha criptografada de forma segura
            if ($usuario && password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                header("Location: home.php");
                exit;
            } else {
                $erro = "E-mail ou senha incorretos."; // Dica: use essa variável na sua view login.php para exibir o erro
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

            if (!empty($nome) && !empty($email) && !empty($senha)) {
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
                $stmt->execute([
                    ':nome' => $nome,
                    ':email' => $email,
                    ':senha' => $senhaHash
                ]);
            }

            header("Location: authController.php?acao=login");
            exit;
        }
    }

    public function sair() {
        // Limpa todas as variáveis de sessão e destrói o arquivo no servidor
        $_SESSION = [];
        session_destroy();
        header("Location: authController.php?acao=login");
        exit;
    }
}
