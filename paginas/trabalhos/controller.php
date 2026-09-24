<?php
require_once __DIR__ . '/../../db.php';

class TrabalhosController
{

    public function index()
    {
        $pdo = getConnection();
        // No controller, antes do query:
        $filtro = $_GET['filtro'] ?? 'todos';
        $sql = "SELECT * FROM trabalhos";
        if ($filtro === 'atrasados') {
            $sql .= " WHERE data_entrega < CURRENT_DATE";
        }
        $sql .= " ORDER BY data_entrega ASC";
        $stmt = $pdo->query("SELECT * FROM trabalhos ORDER BY data_entrega ASC");
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
        $stmt = $pdo->prepare("SELECT * FROM trabalhos WHERE id = :id");
        $stmt->execute([':id' => $id]);
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
        $id = $_POST['id'] ?? '';

        if (empty($id)) {

            $stmt = $pdo->prepare("INSERT INTO trabalhos
                                   (titulo, materia, integrantes, data_entrega, descricao)
                                   VALUES (:titulo, :materia, :integrantes, :data_entrega, :descricao)");
            $stmt->execute([
                ':titulo'       => $_POST['titulo'] ?? '',
                ':materia'      => $_POST['materia'] ?? '',
                ':integrantes'  => $_POST['integrantes'] ?? '',
                ':data_entrega' => $_POST['data_entrega'] ?? date('Y-m-d'),
                ':descricao'    => $_POST['descricao'] ?? ''
            ]);
        } else {

            $stmt = $pdo->prepare("UPDATE trabalhos SET
                                    titulo = :titulo,
                                    materia = :materia,
                                    integrantes = :integrantes,
                                    data_entrega = :data_entrega,
                                    descricao = :descricao
                                    WHERE id = :id");
            $stmt->execute([
                ':titulo'       => $_POST['titulo'] ?? '',
                ':materia'      => $_POST['materia'] ?? '',
                ':integrantes'  => $_POST['integrantes'] ?? '',
                ':data_entrega' => $_POST['data_entrega'] ?? date('Y-m-d'),
                ':descricao'    => $_POST['descricao'] ?? '',
                ':id'           => $id
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
            $stmt = $pdo->prepare("DELETE FROM trabalhos WHERE id = :id");
            $stmt->execute([':id' => $id]);
        }

        header("Location: ?acao=index");
        exit;
    }
}


$controller = new TrabalhosController();

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
