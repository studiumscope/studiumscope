<?php

require_once __DIR__ . '/../../db.php';

$pdo = getConnection();

$acao = $_GET['acao'] ?? 'index';

function redirecionar($url)
{
    header("Location: $url");
    exit;
}

if ($acao === 'salvar') {

    $id = $_POST['id'] ?? '';
    $titulo = trim($_POST['titulo'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $data = $_POST['data_evento'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $tipo = $_POST['tipo'] ?? 'Outro';

    if ($titulo === '' || $data === '') {
        die('Preencha o título e a data do evento.');
    }

    if ($id !== '') {

        $sql = "
            UPDATE calendario
            SET titulo = :titulo,
                descricao = :descricao,
                data_evento = :data_evento,
                hora = :hora,
                tipo = :tipo
            WHERE id = :id
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':titulo' => $titulo,
            ':descricao' => $descricao,
            ':data_evento' => $data,
            ':hora' => $hora !== '' ? $hora : null,
            ':tipo' => $tipo,
            ':id' => $id
        ]);

    } else {

        $sql = "
            INSERT INTO calendario
                (titulo, descricao, data_evento, hora, tipo)
            VALUES
                (:titulo, :descricao, :data_evento, :hora, :tipo)
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':titulo' => $titulo,
            ':descricao' => $descricao,
            ':data_evento' => $data,
            ':hora' => $hora !== '' ? $hora : null,
            ':tipo' => $tipo
        ]);
    }

    $mes = date('m', strtotime($data));
    $ano = date('Y', strtotime($data));

    redirecionar("controller.php?mes=$mes&ano=$ano");
}


if ($acao === 'excluir') {

    $id = $_GET['id'] ?? '';

    if ($id !== '') {
        $stmt = $pdo->prepare("DELETE FROM calendario WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }

    redirecionar('controller.php');
}


if ($acao === 'form') {

    $id = $_GET['id'] ?? '';
    $data = $_GET['data'] ?? date('Y-m-d');

    $evento = null;

    if ($id !== '') {

        $stmt = $pdo->prepare(
            "SELECT * FROM calendario WHERE id = :id"
        );

        $stmt->execute([':id' => $id]);

        $evento = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$evento) {
            die('Evento não encontrado.');
        }

        $data = $evento['data_evento'];
    }

    include __DIR__ . '/form.php';
    exit;
}


$mes = isset($_GET['mes']) ? (int) $_GET['mes'] : (int) date('m');
$ano = isset($_GET['ano']) ? (int) $_GET['ano'] : (int) date('Y');

if ($mes < 1) {
    $mes = 12;
    $ano--;
}

if ($mes > 12) {
    $mes = 1;
    $ano++;
}

$primeiroDia = new DateTime("$ano-$mes-01");
$ultimoDia = new DateTime(
    $primeiroDia->format('Y-m-t')
);

$diasNoMes = (int) $ultimoDia->format('d');

$diaSemanaPrimeiro = (int) $primeiroDia->format('w');

$meses = [
    1 => 'Janeiro',
    2 => 'Fevereiro',
    3 => 'Março',
    4 => 'Abril',
    5 => 'Maio',
    6 => 'Junho',
    7 => 'Julho',
    8 => 'Agosto',
    9 => 'Setembro',
    10 => 'Outubro',
    11 => 'Novembro',
    12 => 'Dezembro'
];

$diasSemana = [
    'Dom',
    'Seg',
    'Ter',
    'Qua',
    'Qui',
    'Sex',
    'Sáb'
];

$nomeMes = $meses[$mes];

$mesAnterior = $mes - 1;
$anoAnterior = $ano;

if ($mesAnterior === 0) {
    $mesAnterior = 12;
    $anoAnterior--;
}

$mesProximo = $mes + 1;
$anoProximo = $ano;

if ($mesProximo === 13) {
    $mesProximo = 1;
    $anoProximo++;
}

$inicioPeriodo = "$ano-$mes-01";

$fimPeriodo = $ultimoDia->format('Y-m-d');

$stmt = $pdo->prepare("
    SELECT *
    FROM calendario
    WHERE data_evento BETWEEN :inicio AND :fim
    ORDER BY data_evento, hora NULLS LAST, id
");

$stmt->execute([
    ':inicio' => $inicioPeriodo,
    ':fim' => $fimPeriodo
]);

$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$eventosPorDia = [];

foreach ($eventos as $evento) {

    $dia = (int) date(
        'd',
        strtotime($evento['data_evento'])
    );

    if (!isset($eventosPorDia[$dia])) {
        $eventosPorDia[$dia] = [];
    }

    $eventosPorDia[$dia][] = $evento;
}

include __DIR__ . '/lista.php';