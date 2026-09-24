<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Calendário</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="../../css/calendario.css"
    >

</head>

<body>

<div class="calendario-pagina">

    <header class="calendario-cabecalho">

        <a
            href="../../home.php"
            class="btn-voltar"
        >
            ← Voltar
        </a>

        <div class="titulo-area">

            <span class="calendario-subtitulo">
                ORGANIZAÇÃO
            </span>

            <h1>
                Calendário
            </h1>

            <p>
                Organize suas provas, tarefas e compromissos.
            </p>

        </div>

    </header>


    <main class="calendario-card">

        <div class="calendario-barra">

            <a
                href="controller.php?mes=<?= $mesAnterior ?>&ano=<?= $anoAnterior ?>"
                class="btn-calendario"
                title="Mês anterior"
            >
                ‹
            </a>


            <div class="mes-atual">

                <strong>
                    <?= $nomeMes ?>
                </strong>

                <span>
                    <?= $ano ?>
                </span>

            </div>


            <a
                href="controller.php?mes=<?= $mesProximo ?>&ano=<?= $anoProximo ?>"
                class="btn-calendario"
                title="Próximo mês"
            >
                ›
            </a>


            <a
                href="controller.php"
                class="btn-hoje"
            >
                Hoje
            </a>

        </div>


        <div class="calendario-grade">


            <?php foreach ($diasSemana as $diaSemana): ?>

                <div class="dia-semana">
                    <?= $diaSemana ?>
                </div>

            <?php endforeach; ?>


            <?php for (
                $i = 0;
                $i < $diaSemanaPrimeiro;
                $i++
            ): ?>

                <div class="dia vazio"></div>

            <?php endfor; ?>


            <?php for (
                $dia = 1;
                $dia <= $diasNoMes;
                $dia++
            ): ?>

                <?php

                $dataAtual = sprintf(
                    '%04d-%02d-%02d',
                    $ano,
                    $mes,
                    $dia
                );

                $ehHoje =
                    $dataAtual === date('Y-m-d');

                ?>

                <div class="dia <?= $ehHoje ? 'dia-hoje' : '' ?>">


                    <div class="dia-topo">

                        <a
                            href="controller.php?acao=form&data=<?= $dataAtual ?>"
                            class="numero-dia"
                            title="Adicionar evento"
                        >
                            <?= $dia ?>
                        </a>

                        <a
                            href="controller.php?acao=form&data=<?= $dataAtual ?>"
                            class="adicionar-evento"
                            title="Adicionar evento"
                        >
                            +
                        </a>

                    </div>


                    <div class="eventos">

                        <?php if (
                            isset($eventosPorDia[$dia])
                        ): ?>

                            <?php foreach (
                                $eventosPorDia[$dia]
                                as $evento
                            ): ?>

                                <?php

                                $tipoClasse = strtolower(
                                    preg_replace(
                                        '/[^a-zA-Z]/',
                                        '',
                                        $evento['tipo']
                                    )
                                );

                                ?>

                                <div
                                    class="evento evento-<?= htmlspecialchars($tipoClasse) ?>"
                                >

                                    <a
                                        href="controller.php?acao=form&id=<?= $evento['id'] ?>"
                                        class="evento-link"
                                    >

                                        <span class="evento-titulo">
                                            <?= htmlspecialchars(
                                                $evento['titulo']
                                            ) ?>
                                        </span>


                                        <?php if (
                                            !empty($evento['hora'])
                                        ): ?>

                                            <span class="evento-hora">

                                                <?= htmlspecialchars(
                                                    substr(
                                                        $evento['hora'],
                                                        0,
                                                        5
                                                    )
                                                ) ?>

                                            </span>

                                        <?php endif; ?>

                                    </a>

                                </div>

                            <?php endforeach; ?>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endfor; ?>


        </div>


        <div class="calendario-rodape">

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


            <a
                href="controller.php?acao=form&data=<?= date('Y-m-d') ?>"
                class="btn-novo-evento"
            >
                + Novo evento
            </a>

        </div>

    </main>

</div>

</body>

</html>