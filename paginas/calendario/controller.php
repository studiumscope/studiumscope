<?php
session_start();
require_once __DIR__ . '/../../db.php';

$controller = new CalendarioController();

$acao = $_GET['acao'] ?? 'index';

switch ($acao) {
    case 'form':
        $controller->form();
        break;
    case 'salvar':
        $controller->salvar();
        break;
    case 'excluir':
        $controller->excluir();
        break;
    default:
        $controller->index();
        break;
}

class CalendarioController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = getConnection();
    }

    public function index()
    {
        $id_usuario = $_SESSION['usuario_id'];
        $mes = isset($_GET['mes']) ? $_GET['mes'] : date('Y-m');

        if (!preg_match('/^\d{4}-\d{2}$/', $mes)) {
            $mes = date('Y-m');
        }

        $inicio = $mes . '-01';
        $fim = date('Y-m-t', strtotime($inicio));

        $sql = "SELECT * FROM calendario
                WHERE id_usuario = :id_usuario AND data_evento BETWEEN :inicio AND :fim
                ORDER BY data_evento, hora";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id_usuario' => $id_usuario,
            ':inicio' => $inicio,
            ':fim' => $fim
        ]);

        $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/lista.php';
    }

    public function form()
    {
        $id_usuario = $_SESSION['usuario_id'];
        $evento = null;

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $stmt = $this->pdo->prepare(
                "SELECT * FROM calendario WHERE id = :id AND id_usuario = :id_usuario"
            );

            $stmt->execute([
                ':id' => $_GET['id'],
                ':id_usuario' => $id_usuario
            ]);

            $evento = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        $data = $_GET['data'] ?? ($evento['data_evento'] ?? date('Y-m-d'));

        include __DIR__ . '/form.php';
    }

    public function salvar()
    {
        $id_usuario = $_SESSION['usuario_id'];
        $id = $_POST['id'] ?? '';
        $titulo = trim($_POST['titulo'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');
        $data_evento = $_POST['data_evento'] ?? '';
        $hora = $_POST['hora'] ?? '';
        $tipo = trim($_POST['tipo'] ?? '');

        if ($titulo === '' || $data_evento === '' || $tipo === '') {
            header('Location: controller.php?acao=form&erro=1');
            exit;
        }

        if ($id !== '') {
            $sql = "UPDATE calendario
                    SET titulo = :titulo,
                        descricao = :descricao,
                        data_evento = :data_evento,
                        hora = :hora,
                        tipo = :tipo
                    WHERE id = :id AND id_usuario = :id_usuario";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ':titulo' => $titulo,
                ':descricao' => $descricao,
                ':data_evento' => $data_evento,
                ':hora' => $hora !== '' ? $hora : null,
                ':tipo' => $tipo,
                ':id' => $id,
                ':id_usuario' => $id_usuario
            ]);
        } else {
            $sql = "INSERT INTO calendario
                    (titulo, descricao, data_evento, hora, tipo, id_usuario)
                    VALUES
                    (:titulo, :descricao, :data_evento, :hora, :tipo, :id_usuario)";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ':titulo' => $titulo,
                ':descricao' => $descricao,
                ':data_evento' => $data_evento,
                ':hora' => $hora !== '' ? $hora : null,
                ':tipo' => $tipo,
                ':id_usuario' => $id_usuario
            ]);
        }

        header('Location: controller.php?acao=index&mes=' . date('Y-m', strtotime($data_evento)));
        exit;
    }

    public function excluir()
    {
        $id_usuario = $_SESSION['usuario_id'];
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $stmt = $this->pdo->prepare(
                "DELETE FROM calendario WHERE id = :id AND id_usuario = :id_usuario"
            );

            $stmt->execute([
                ':id' => $_GET['id'],
                ':id_usuario' => $id_usuario
            ]);
        }

        header('Location: controller.php?acao=index&mes=' . ($_GET['mes'] ?? date('Y-m')));
        exit;
    }
}