<?php
require_once __DIR__ . '/../../db.php';

class DisciplinasController {

    public function index() {
        $pdo = getConnection();
        $stmt = $pdo->query("SELECT * FROM disciplinas ORDER BY id DESC");
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
        $stmt = $pdo->prepare("SELECT * FROM disciplinas WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $dado = $stmt->fetch(PDO::FETCH_ASSOC);

        include __DIR__ . "../../../_cabecalho.php";
        include "form.php";
        include __DIR__ . "../../../_rodape.php";
    }

    public function salvar() {
        $pdo = getConnection();
        $id = $_POST['id'] ?? '';

        if (empty($id)) {
        
            $stmt = $pdo->prepare("INSERT INTO disciplinas
                                   (nome materia, professor, contatos, nota_atual, nota_necessaria)
                                   VALUES (nome :materia, :professor, :contatos, :nota_atual, :nota_necessaria)");
            $stmt->execute([
                ':nome'         => "",
                ':materia'         => $_POST['materia'] ?? '',
                ':professor'       => $_POST['professor'] ?? '',
                ':contatos'        => $_POST['contatos'] ?? '',
                ':nota_atual'      => $_POST['nota_atual'] ?? 0,
                ':nota_necessaria' => $_POST['nota_necessaria'] ?? 0
            ]);
        } else {
            
            $stmt = $pdo->prepare("UPDATE disciplinas SET
                                    nome = :nome,
                                    materia = :materia,
                                    professor = :professor,
                                    contatos = :contatos,
                                    nota_atual = :nota_atual,
                                    nota_necessaria = :nota_necessaria
                                    WHERE id = :id");
            $stmt->execute([
                ':nome'         => "",
                ':materia'         => $_POST['materia'] ?? '',
                ':professor'       => $_POST['professor'] ?? '',
                ':contatos'        => $_POST['contatos'] ?? '',
                ':nota_atual'      => $_POST['nota_atual'] ?? 0,
                ':nota_necessaria' => $_POST['nota_necessaria'] ?? 0,
                ':id'              => $id
            ]);
        }

        header("Location: ?acao=index");
        exit;
    }

    public function excluir() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $pdo = getConnection();
            $stmt = $pdo->prepare("DELETE FROM disciplinas WHERE id = :id");
            $stmt->execute([':id' => $id]);
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
