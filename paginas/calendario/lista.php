<?php
$mesAtual = $mes ?? date('Y-m');
$timestamp = strtotime($mesAtual . '-01');

$ano = date('Y', $timestamp);
$numeroMes = date('m', $timestamp);

$nomeMeses = [
    1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
    5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
    9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
];
$nomeMes = $nomeMeses[(int)$numeroMes];

$primeiroDia = (int)date('w', $timestamp);
$diasNoMes = (int)date('t', $timestamp);

$mesAnterior = date('Y-m', strtotime('-1 month', $timestamp));
$proximoMes  = date('Y-m', strtotime('+1 month', $timestamp));

$eventosPorDia = [];
$eventos = $eventos ?? [];
foreach ($eventos as $evento) {
    if (date('Y-m', strtotime($evento['data_evento'])) !== $mesAtual) continue;
    $dia = (int)date('j', strtotime($evento['data_evento']));
    $eventosPorDia[$dia][] = $evento;
}

$hoje = date('Y-m-d');
?>

<div class="cal-container">

    <div class="cal-topo">
        <div>
            <span class="cal-subtitulo">ORGANIZAÇÃO DO ALUNO</span>
            <h1>Meu Calendário</h1>
            <p>Organize provas, trabalhos, tarefas e compromissos.</p>
        </div>
        <a href="?acao=form" class="cal-btn-novo">+ Novo Evento</a>
    </div>

    <div class="cal-card">

        <div class="cal-controles">
            <a href="?acao=index&mes=<?= $mesAnterior ?>" class="cal-btn-mes">‹</a>
            <div class="cal-mes-atual"><?= $nomeMes ?> <span><?= $ano ?></span></div>
            <a href="?acao=index&mes=<?= $proximoMes ?>" class="cal-btn-mes">›</a>
        </div>

        <div class="cal-semana">
            <div>DOM</div><div>SEG</div><div>TER</div><div>QUA</div>
            <div>QUI</div><div>SEX</div><div>SÁB</div>
        </div>

        <div class="cal-dias">

            <?php for ($i = 0; $i < $primeiroDia; $i++): ?>
                <div class="cal-dia cal-vazio"></div>
            <?php endfor; ?>

            <?php for ($dia = 1; $dia <= $diasNoMes; $dia++): ?>
                <?php
                    $dataCompleta = sprintf('%04d-%02d-%02d', $ano, $numeroMes, $dia);
                    $ehHoje = $dataCompleta === $hoje;
                ?>

                <div class="cal-dia <?= $ehHoje ? 'cal-hoje' : '' ?>">

                    <a href="?acao=form&data=<?= $dataCompleta ?>"
                       class="cal-numero-dia"
                       title="Adicionar evento"><?= $dia ?></a>

                    <div class="cal-eventos">
                        <?php if (isset($eventosPorDia[$dia])): ?>
                            <?php foreach ($eventosPorDia[$dia] as $evento): ?>
                                <?php
                                    $tipoClasse = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $evento['tipo']));
                                ?>
                                <div class="cal-evento cal-tipo-<?= $tipoClasse ?>">
                                    <div class="cal-evento-titulo"><?= htmlspecialchars($evento['titulo']) ?></div>
                                    <?php if (!empty($evento['hora'])): ?>
                                        <div class="cal-evento-hora"><?= substr($evento['hora'], 0, 5) ?></div>
                                    <?php endif; ?>
                                    <div class="cal-evento-acoes">
                                        <a href="?acao=form&id=<?= $evento['id'] ?>">Editar</a>
                                        <a href="?acao=excluir&id=<?= $evento['id'] ?>&mes=<?= $mesAtual ?>"
                                           onclick="return confirm('Deseja excluir este evento?');">Excluir</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endfor; ?>

        </div>
    </div>

    <div class="cal-legenda">
        <span><i class="cal-ponto cal-prova"></i> Prova</span>
        <span><i class="cal-ponto cal-trabalho"></i> Trabalho</span>
        <span><i class="cal-ponto cal-tarefa"></i> Tarefa</span>
        <span><i class="cal-ponto cal-outro"></i> Outro</span>
    </div>

</div>