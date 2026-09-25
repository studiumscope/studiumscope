<?php
require_once __DIR__ . '/../../db.php';

class DisciplinasController {

    /**
     * Retorna o ID do usuário logado.
     * Ajusta aqui se o nome da sessão for diferente (ex: $_SESSION['id']).
     */
    private function idUsuario() {
        return $_SESSION['usuario_id'] ?? $_SESSION['id_usuario'] ?? $_SESSION['id'] ?? null;
    }

    public function index() {
        $pdo = getConnection();
        $idUsuario = $this->idUsuario();

        if ($idUsuario) {
            $stmt = $pdo->prepare("SELECT * FROM disciplinas 
                                   WHERE id_usuario = :id_usuario 
                                   ORDER BY id DESC");
            $stmt->execute([':id_usuario' => $idUsuario]);
        } else {
            // Fallback: se não tiver sessão, lista tudo (útil pra testar)
            $stmt = $pdo->query("SELECT * FROM disciplinas ORDER BY id DESC");
        }

        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . "/../../_cabecalho.php";
        include "lista.php";
        include __DIR__ . "/../../_rodape.php";
    }

    public function novo() {
        $dado = [];
        include __DIR__ . "/../../_cabecalho.php";
        include "form.php";
        include __DIR__ . "/../../_rodape.php";
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

        if (!$dado) {
            header("Location: ?acao=index");
            exit;
        }

        include __DIR__ . "/../../../_cabecalho.php";
        include "form.php";
        include __DIR__ . "/../../../_rodape.php";
    }

    public function salvar() {
        $pdo = getConnection();
        $id = $_POST['id'] ?? '';
        $idUsuario = $this->idUsuario();

        $params = [
            ':materia'         => $_POST['materia'] ?? '',
            ':professor'       => $_POST['professor'] ?? '',
            ':contatos'        => $_POST['contatos'] ?? '',
            ':nota_atual'      => $_POST['nota_atual'] !== '' ? $_POST['nota_atual'] : 0,
            ':nota_necessaria' => $_POST['nota_necessaria'] !== '' ? $_POST['nota_necessaria'] : 0,
            ':id_usuario'      => $idUsuario,
        ];

        if (empty($id)) {
            // INSERT
            $stmt = $pdo->prepare("INSERT INTO disciplinas
                                   (materia, professor, contatos, nota_atual, nota_necessaria, id_usuario)
                                   VALUES (:materia, :professor, :contatos, :nota_atual, :nota_necessaria, :id_usuario)");
            $stmt->execute($params);
        } else {
            // UPDATE
            $params[':id'] = $id;
            $stmt = $pdo->prepare("UPDATE disciplinas SET
                                    materia = :materia,
                                    professor = :professor,
                                    contatos = :contatos,
                                    nota_atual = :nota_atual,
                                    nota_necessaria = :nota_necessaria
                                    WHERE id = :id");
            $stmt->execute($params);
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

// Roteamento
$controller = new DisciplinasController();
$acao = $_GET['acao'] ?? 'index';

switch ($acao) {
    case 'novo':    $controller->novo();    break;
    case 'editar':  $controller->editar();  break;
    case 'salvar':  $controller->salvar();  break;
    case 'excluir': $controller->excluir(); break;
    default:        $controller->index();
}