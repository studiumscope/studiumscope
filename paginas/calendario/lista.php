<div class="calendario-pagina">

    <div class="calendario-cabecalho">

        <a href="../home.php" class="btn-voltar">
            ← Voltar
        </a>

        <div>
            <span class="calendario-subtitulo">ORGANIZAÇÃO</span>
            <h1>Tela Calendário</h1>
            <p><?= $nomeMes ?> de <?= $ano ?></p>
        </div>

    </div>


    <div class="calendario-card">

        <div class="calendario-barra">

            <a
                href="controller.php?mes=<?= $mesAnterior ?>&ano=<?= $anoAnterior ?>"
                class="btn-calendario"
            >
                ←
            </a>

            <div class="mes-atual">
                <strong><?= $nomeMes ?></strong>
                <span><?= $ano ?></span>
            </div>

            <a
                href="controller.php?mes=<?= $mesProximo ?>&ano=<?= $anoProximo ?>"
                class="btn-calendario"
            >
                →
            </a>

            <a href="controller.php" class="btn-hoje">
                Hoje
            </a>

        </div>


        <div class="calendario-grade">

            <?php foreach ($diasSemana as $diaSemana): ?>

                <div class="dia-semana">
                    <?= $diaSemana ?>
                </div>

            <?php endforeach; ?>


            <?php for ($i = 1; $i < $primeiroDiaSemana; $i++): ?>

                <div class="dia vazio"></div>

            <?php endfor; ?>


            <?php for ($dia = 1; $dia <= $diasNoMes; $dia++): ?>

                <?php

                $dataAtual = sprintf(
                    '%04d-%02d-%02d',
                    $ano,
                    $mes,
                    $dia
                );

                $ehHoje = $dataAtual === date('Y-m-d');

                ?>

                <a
                    href="controller.php?acao=form&data=<?= $dataAtual ?>"
                    class="dia <?= $ehHoje ? 'dia-hoje' : '' ?>"
                >

                    <span class="numero-dia">
                        <?= $dia ?>
                    </span>


                    <div class="eventos">

                        <?php if (isset($eventosPorDia[$dia])): ?>

                            <?php foreach ($eventosPorDia[$dia] as $evento): ?>

                                <?php
                                $classeTipo = strtolower(
                                    preg_replace(
                                        '/[^a-zA-Z0-9]/',
                                        '',
                                        $evento['tipo']
                                    )
                                );
                                ?>

                                <div
                                    class="evento evento-<?= $classeTipo ?>"
                                    onclick="event.preventDefault(); event.stopPropagation();"
                                >

                                    <span class="evento-titulo">
                                        <?= htmlspecialchars($evento['titulo']) ?>
                                    </span>

                                    <?php if (!empty($evento['hora'])): ?>

                                        <span class="evento-hora">
                                            <?= htmlspecialchars(
                                                substr($evento['hora'], 0, 5)
                                            ) ?>
                                        </span>

                                    <?php endif; ?>

                                </div>

                            <?php endforeach; ?>

                        <?php endif; ?>

                    </div>

                </a>

            <?php endfor; ?>

        </div>


        <div class="legenda">

            <span>
                <i class="legenda-cor prova"></i>
                Prova
            </span>

            <span>
                <i class="legenda-cor tarefa"></i>
                Tarefa
            </span>

            <span>
                <i class="legenda-cor trabalho"></i>
                Trabalho
            </span>

            <span>
                <i class="legenda-cor lembrete"></i>
                Lembrete
            </span>

            <span>
                <i class="legenda-cor outro"></i>
                Outro
            </span>

        </div>

    </div>

</div>