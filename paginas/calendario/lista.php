<?php

$mesAtual = $mes;

$timestamp = strtotime($mesAtual . '-01');

$ano = date('Y', $timestamp);
$numeroMes = date('m', $timestamp);

$nomeMeses = [
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

$nomeMes = $nomeMeses[(int)$numeroMes];

$primeiroDia = (int)date('w', $timestamp);
$diasNoMes = (int)date('t', $timestamp);

$mesAnterior = date('Y-m', strtotime('-1 month', $timestamp));
$proximoMes = date('Y-m', strtotime('+1 month', $timestamp));

$eventosPorDia = [];

foreach ($eventos as $evento) {
    $dia = (int)date('j', strtotime($evento['data_evento']));

    if (!isset($eventosPorDia[$dia])) {
        $eventosPorDia[$dia] = [];
    }

    $eventosPorDia[$dia][] = $evento;
}

$hoje = date('Y-m-d');

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Calendário</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../css/calendario.css">
</head>

<body>

<div class="calendario-container">

    <div class="calendario-topo">

        <div>
            <span class="calendario-subtitulo">ORGANIZAÇÃO DO ALUNO</span>
            <h1>Meu Calendário</h1>
            <p>Organize provas, trabalhos, tarefas e compromissos.</p>
        </div>

        <a href="../../index.php" class="btn-voltar">
            Voltar
        </a>

    </div>

    <div class="calendario-card">

        <div class="calendario-controles">

            <a href="controller.php?acao=index&mes=<?= $mesAnterior ?>"
               class="btn-mes">
                ‹
            </a>

            <div class="mes-atual">
                <?= $nomeMes ?> <span><?= $ano ?></span>
            </div>

            <a href="controller.php?acao=index&mes=<?= $proximoMes ?>"
               class="btn-mes">
                ›
            </a>

        </div>

        <div class="semana">

            <div>DOM</div>
            <div>SEG</div>
            <div>TER</div>
            <div>QUA</div>
            <div>QUI</div>
            <div>SEX</div>
            <div>SÁB</div>

        </div>

        <div class="dias">

            <?php for ($i = 0; $i < $primeiroDia; $i++): ?>

                <div class="dia vazio"></div>

            <?php endfor; ?>


            <?php for ($dia = 1; $dia <= $diasNoMes; $dia++): ?>

                <?php

                $dataCompleta = sprintf(
                    '%04d-%02d-%02d',
                    $ano,
                    $numeroMes,
                    $dia
                );

                $ehHoje = $dataCompleta === $hoje;

                ?>

                <a
                    href="controller.php?acao=form&data=<?= $dataCompleta ?>"
                    class="dia <?= $ehHoje ? 'hoje' : '' ?>"
                >

                    <div class="numero-dia">
                        <?= $dia ?>
                    </div>

                    <div class="eventos">

                        <?php if (isset($eventosPorDia[$dia])): ?>

                            <?php foreach ($eventosPorDia[$dia] as $evento): ?>

                                <div
                                    class="evento tipo-<?= strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $evento['tipo'])) ?>"
                                    onclick="event.stopPropagation();"
                                >

                                    <div class="evento-titulo">
                                        <?= htmlspecialchars($evento['titulo']) ?>
                                    </div>

                                    <?php if (!empty($evento['hora'])): ?>

                                        <div class="evento-hora">
                                            <?= substr($evento['hora'], 0, 5) ?>
                                        </div>

                                    <?php endif; ?>

                                    <div class="evento-acoes">

                                        <a
                                            href="controller.php?acao=form&id=<?= $evento['id'] ?>"
                                            onclick="event.stopPropagation();"
                                        >
                                            Editar
                                        </a>

                                        <a
                                            href="controller.php?acao=excluir&id=<?= $evento['id'] ?>&mes=<?= $mesAtual ?>"
                                            onclick="event.stopPropagation(); return confirm('Deseja excluir este evento?');"
                                        >
                                            Excluir
                                        </a>

                                    </div>

                                </div>

                            <?php endforeach; ?>

                        <?php endif; ?>

                    </div>

                </a>

            <?php endfor; ?>

        </div>

    </div>

    <div class="legenda">

        <span>
            <i class="legenda-ponto prova"></i>
            Prova
        </span>

        <span>
            <i class="legenda-ponto trabalho"></i>
            Trabalho
        </span>

        <span>
            <i class="legenda-ponto tarefa"></i>
            Tarefa
        </span>

        <span>
            <i class="legenda-ponto outro"></i>
            Outro
        </span>

    </div>

</div>

</body>
</html>