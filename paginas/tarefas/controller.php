<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../authController.php?acao=login");
    exit;
}
require_once __DIR__ . '/../../db.php';

class tarefasController
{
    public function index()
    {
        $pdo = getConnection();
        $id_usuario = $_SESSION['usuario_id'];
        
        $filtro = $_GET['filtro'] ?? 'todos';
        
        $sql = "SELECT * FROM tarefas WHERE id_usuario = :id_usuario";
        if ($filtro === 'atrasados') {
            $sql .= " AND data_entrega < CURRENT_DATE";
        }
        $sql .= " ORDER BY data_entrega ASC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_usuario' => $id_usuario]);
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . "../../../_cabecalho.php";
        include "lista.php";
        include __DIR__ . "../../../_rodape.php";
    }

    public function novo()
    {
        $dado = [];
        include __DIR__ . "../../../_cabecalho.php";
        include "form.php";
        include __DIR__ . "../../../_rodape.php";
    }

    public function editar()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: ?acao=index");
            exit;
        }

        $pdo = getConnection();
        $id_usuario = $_SESSION['usuario_id'];
        
        $stmt = $pdo->prepare("SELECT * FROM tarefas WHERE id = :id AND id_usuario = :id_usuario");
        $stmt->execute([
            ':id' => $id,
            ':id_usuario' => $id_usuario
        ]);
        $dado = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dado) {
            header("Location: ?acao=index");
            exit;
        }

        include __DIR__ . "../../../_cabecalho.php";
        include "form.php";
        include __DIR__ . "../../../_rodape.php";
    }

    public function salvar()
    {
        $pdo = getConnection();
        $id_usuario = $_SESSION['usuario_id'];
        $id = $_POST['id'] ?? '';

        if (empty($id)) {
            $stmt = $pdo->prepare("INSERT INTO tarefas
                                   (titulo, materia, integrantes, data_entrega, descricao, id_usuario)
                                   VALUES (:titulo, :materia, :integrantes, :data_entrega, :descricao, :id_usuario)");
            $stmt->execute([
                ':titulo'       => $_POST['titulo'] ?? '',
                ':materia'      => $_POST['materia'] ?? '',
                ':integrantes'  => $_POST['integrantes'] ?? '',
                ':data_entrega' => $_POST['data_entrega'] ?? date('Y-m-d'),
                ':descricao'    => $_POST['descricao'] ?? '',
                ':id_usuario'   => $id_usuario
            ]);
        } else {
            $stmt = $pdo->prepare("UPDATE tarefas SET
                                    titulo = :titulo,
                                    materia = :materia,
                                    integrantes = :integrantes,
                                    data_entrega = :data_entrega,
                                    descricao = :descricao
                                    WHERE id = :id AND id_usuario = :id_usuario");
            $stmt->execute([
                ':titulo'       => $_POST['titulo'] ?? '',
                ':materia'      => $_POST['materia'] ?? '',
                ':integrantes'  => $_POST['integrantes'] ?? '',
                ':data_entrega' => $_POST['data_entrega'] ?? date('Y-m-d'),
                ':descricao'    => $_POST['descricao'] ?? '',
                ':id'           => $id,
                ':id_usuario'   => $id_usuario
            ]);
        }

        header("Location: ?acao=index");
        exit;
    }

    public function excluir()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $pdo = getConnection();
            $id_usuario = $_SESSION['usuario_id'];
            
            $stmt = $pdo->prepare("DELETE FROM tarefas WHERE id = :id AND id_usuario = :id_usuario");
            $stmt->execute([
                ':id' => $id,
                ':id_usuario' => $id_usuario
            ]);
        }

        header("Location: ?acao=index");
        exit;
    }
}

$controller = new tarefasController();

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