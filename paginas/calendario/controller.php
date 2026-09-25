<?php
require_once __DIR__ . '/../../db.php';

class CalendarioController {

    private function idUsuario() {
        return $_SESSION['usuario_id'] ?? $_SESSION['id_usuario'] ?? $_SESSION['id'] ?? null;
    }

    public function index() {
        $pdo = getConnection();

        $mes = $_GET['mes'] ?? date('Y-m');
        if (!preg_match('/^\d{4}-\d{2}$/', $mes)) {
            $mes = date('Y-m');
        }

        $inicio = $mes . '-01';
        $fim = date('Y-m-t', strtotime($inicio));
        $idUsuario = $this->idUsuario();

        if ($idUsuario) {
            $stmt = $pdo->prepare("SELECT * FROM calendario
                                   WHERE data_evento BETWEEN :inicio AND :fim
                                     AND id_usuario = :id_usuario
                                   ORDER BY data_evento ASC, hora ASC");
            $stmt->execute([
                ':inicio'     => $inicio,
                ':fim'        => $fim,
                ':id_usuario' => $idUsuario,
            ]);
        } else {
            $stmt = $pdo->prepare("SELECT * FROM calendario
                                   WHERE data_evento BETWEEN :inicio AND :fim
                                   ORDER BY data_evento ASC, hora ASC");
            $stmt->execute([':inicio' => $inicio, ':fim' => $fim]);
        }

        $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . "/../../_cabecalho.php";
        include "lista.php";
        include __DIR__ . "/../../_rodape.php";
    }

    public function form() {
        $pdo = getConnection();

        $id = $_GET['id'] ?? null;
        $data = $_GET['data'] ?? date('Y-m-d');
        $evento = null;

        if ($id) {
            $stmt = $pdo->prepare("SELECT * FROM calendario WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $evento = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$evento) {
                header("Location: ?acao=index");
                exit;
            }
        }

        include __DIR__ . "/../../_cabecalho.php";
        include "form.php";
        include __DIR__ . "/../../_rodape.php";
    }

    public function salvar() {
        $pdo = getConnection();

        $id        = $_POST['id'] ?? '';
        $titulo    = trim($_POST['titulo'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');
        $data      = $_POST['data_evento'] ?? '';
        $hora      = $_POST['hora'] ?? null;
        $tipo      = $_POST['tipo'] ?? '';
        $idUsuario = $this->idUsuario();

        if ($titulo === '' || $data === '' || $tipo === '') {
            header("Location: ?acao=form&erro=1&data=$data");
            exit;
        }

        if ($hora === '') $hora = null;

        if (empty($id)) {
            $stmt = $pdo->prepare("INSERT INTO calendario
                (titulo, descricao, data_evento, hora, tipo, id_usuario)
                VALUES (:titulo, :descricao, :data_evento, :hora, :tipo, :id_usuario)");
            $stmt->execute([
                ':titulo'      => $titulo,
                ':descricao'   => $descricao,
                ':data_evento' => $data,
                ':hora'        => $hora,
                ':tipo'        => $tipo,
                ':id_usuario'  => $idUsuario,
            ]);
        } else {
            $stmt = $pdo->prepare("UPDATE calendario SET
                titulo = :titulo,
                descricao = :descricao,
                data_evento = :data_evento,
                hora = :hora,
                tipo = :tipo
                WHERE id = :id");
            $stmt->execute([
                ':titulo'      => $titulo,
                ':descricao'   => $descricao,
                ':data_evento' => $data,
                ':hora'        => $hora,
                ':tipo'        => $tipo,
                ':id'          => $id,
            ]);
        }

        $mes = date('Y-m', strtotime($data));
        header("Location: ?acao=index&mes=$mes");
        exit;
    }

    public function excluir() {
        $pdo = getConnection();
        $id  = $_GET['id'] ?? null;
        $mes = $_GET['mes'] ?? date('Y-m');

        if ($id) {
            $stmt = $pdo->prepare("DELETE FROM calendario WHERE id = :id");
            $stmt->execute([':id' => $id]);
        }

        header("Location: ?acao=index&mes=$mes");
        exit;
    }
}

$controller = new CalendarioController();
$acao = $_GET['acao'] ?? 'index';

switch ($acao) {
    case 'form':    $controller->form();    break;
    case 'salvar':  $controller->salvar();  break;
    case 'excluir': $controller->excluir(); break;
    default:        $controller->index();
}