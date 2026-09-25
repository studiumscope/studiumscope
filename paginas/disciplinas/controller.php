<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../authController.php?acao=login");
    exit;
}
require_once __DIR__ . '/../../db.php';

class DisciplinasController {

    public function index() {
        $pdo = getConnection();
        $id_usuario = $_SESSION['usuario_id'];
        
        $stmt = $pdo->prepare("SELECT * FROM disciplinas WHERE id_usuario = :id_usuario ORDER BY id DESC");
        $stmt->execute([':id_usuario' => $id_usuario]);
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . "../../../_cabecalho.php";
        include "lista.php";
        include __DIR__ . "../../../_rodape.php";
    }

    public function novo() {
        $dado = []; 
        include __DIR__ . "../../../_cabecalho.php";
        include "form.php";
        include __DIR__ . "../../../_rodape.php";
    }

    public function editar() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: ?acao=index");
            exit;
        }

        $pdo = getConnection();
        $id_usuario = $_SESSION['usuario_id'];
        
        $stmt = $pdo->prepare("SELECT * FROM disciplinas WHERE id = :id AND id_usuario = :id_usuario");
        $stmt->execute([
            ':id' => $id,
            ':id_usuario' => $id_usuario
        ]);
        $dado = $stmt->fetch(PDO::FETCH_ASSOC);

        include __DIR__ . "../../../_cabecalho.php";
        include "form.php";
        include __DIR__ . "../../../_rodape.php";
    }

    public function salvar() {
        $pdo = getConnection();
        $id_usuario = $_SESSION['usuario_id'];
        $id = $_POST['id'] ?? '';

        if (empty($id)) {
            $stmt = $pdo->prepare("INSERT INTO disciplinas
                                   (materia, professor, contatos, nota_atual, nota_necessaria, id_usuario)
                                   VALUES (:materia, :professor, :contatos, :nota_atual, :nota_necessaria, :id_usuario)");
            $stmt->execute([
                ':materia'         => $_POST['materia'] ?? '',
                ':professor'       => $_POST['professor'] ?? '',
                ':contatos'        => $_POST['contatos'] ?? '',
                ':nota_atual'      => $_POST['nota_atual'] ?? 0,
                ':nota_necessaria' => $_POST['nota_necessaria'] ?? 0,
                ':id_usuario'      => $id_usuario
            ]);
        } else {
            $stmt = $pdo->prepare("UPDATE disciplinas SET
                                    materia = :materia,
                                    professor = :professor,
                                    contatos = :contatos,
                                    nota_atual = :nota_atual,
                                    nota_necessaria = :nota_necessaria
                                    WHERE id = :id AND id_usuario = :id_usuario");
            $stmt->execute([
                ':materia'         => $_POST['materia'] ?? '',
                ':professor'       => $_POST['professor'] ?? '',
                ':contatos'        => $_POST['contatos'] ?? '',
                ':nota_atual'      => $_POST['nota_atual'] ?? 0,
                ':nota_necessaria' => $_POST['nota_necessaria'] ?? 0,
                ':id'              => $id,
                ':id_usuario'      => $id_usuario
            ]);
        }

        header("Location: ?acao=index");
        exit;
    }

    public function excluir() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $pdo = getConnection();
            $id_usuario = $_SESSION['usuario_id'];
            
            $stmt = $pdo->prepare("DELETE FROM disciplinas WHERE id = :id AND id_usuario = :id_usuario");
            $stmt->execute([
                ':id' => $id,
                ':id_usuario' => $id_usuario
            ]);
        }

        header("Location: ?acao=index");
        exit;
    }
}

$controller = new DisciplinasController();

$acao = $_GET['acao'] ?? 'index';
switch ($acao) {
    case 'novo':
        $controller->novo();
        break;
    case 'editar':
        $controller->editar();
        break;
    case 'salvar':
        $controller->salvar();
        break;
    case 'excluir':
        $controller->excluir();
        break;
    default:
        $controller->index();
}