<style>
.tabela-horario {
    width: 100%;
    table-layout: fixed;
}

.tabela-horario th,
.tabela-horario td {
    text-align: center;
    vertical-align: middle;
    padding: 10px 5px;
    word-wrap: break-word;
    overflow-wrap: anywhere;
}

.tabela-horario th:first-child,
.tabela-horario td:first-child {
    width: 70px;
}

.tabela-horario th:nth-child(2),
.tabela-horario td:nth-child(2),
.tabela-horario th:nth-child(3),
.tabela-horario td:nth-child(3),
.tabela-horario th:nth-child(4),
.tabela-horario td:nth-child(4),
.tabela-horario th:nth-child(5),
.tabela-horario td:nth-child(5),
.tabela-horario th:nth-child(6),
.tabela-horario td:nth-child(6),
.tabela-horario th:nth-child(7),
.tabela-horario td:nth-child(7),
.tabela-horario th:nth-child(8),
.tabela-horario td:nth-child(8) {
    width: 110px;
}

.tabela-horario th:last-child,
.tabela-horario td:last-child {
    width: 150px;
}

.tabela-horario .btn {
    margin: 2px;
    white-space: nowrap;
}

.btn-voltar {
    display: inline-block;
    background-color: #17b5d0;
    color: #000;
    text-decoration: none;
    padding: 12px 22px;
    border-radius: 30px;
    font-size: 18px;
    margin-bottom: 10px;
}

.btn-voltar:hover {
    background-color: #0fa0b9;
    color: #000;
}
</style>

<a href="../../home.php" class="btn-voltar">Voltar</a>

<div class="card-header">
    <h3>Tela Horário</h3>
</div>

<div class="card mt-5">
    <div class="card-body">

        <a href="controller.php?acao=editar" class="btn btn-primary mb-4">
            Agendar Horário
        </a>

        <table class="table tabela-horario">

            <thead>
                <tr>
                    <th>Período</th>
                    <th>Dom</th>
                    <th>Seg</th>
                    <th>Ter</th>
                    <th>Qua</th>
                    <th>Qui</th>
                    <th>Sex</th>
                    <th>Sáb</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>

                <?php for ($periodo = 1; $periodo <= 6; $periodo++): ?>

                    <?php
                    $dadoPeriodo = null;

                    foreach ($dados as $dado) {
                        if ((int)$dado['periodo'] === $periodo) {
                            $dadoPeriodo = $dado;
                            break;
                        }
                    }
                    ?>

                    <tr>

                        <td><?= $periodo ?>º</td>

                        <td><?= $dadoPeriodo['domingo'] ?? '' ?></td>
                        <td><?= $dadoPeriodo['segunda'] ?? '' ?></td>
                        <td><?= $dadoPeriodo['terca'] ?? '' ?></td>
                        <td><?= $dadoPeriodo['quarta'] ?? '' ?></td>
                        <td><?= $dadoPeriodo['quinta'] ?? '' ?></td>
                        <td><?= $dadoPeriodo['sexta'] ?? '' ?></td>
                        <td><?= $dadoPeriodo['sabado'] ?? '' ?></td>

                        <td>

                            <?php if ($dadoPeriodo): ?>

                                <a href="controller.php?acao=editar&id=<?= $dadoPeriodo['id'] ?>"
                                   class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                <a href="controller.php?acao=excluir&id=<?= $dadoPeriodo['id'] ?>"
                                   class="btn btn-danger btn-sm">
                                    Excluir
                                </a>

                            <?php else: ?>

                                <a href="controller.php?acao=editar&periodo=<?= $periodo ?>"
                                   class="btn btn-primary btn-sm">
                                    Agendar
                                </a>

                            <?php endif; ?>

                        </td>

                    </tr>

                <?php endfor; ?>

            </tbody>

        </table>

    </div>
</div>