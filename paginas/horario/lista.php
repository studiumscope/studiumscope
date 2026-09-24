<div class="card-header">
    <h3>Tela Horário</h3>
</div>

<div class="card mt-5">
    <div class="card-body">

        <table class="table">

            <thead>
                <tr>
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

                <?php foreach ($dados as $dado): ?>

                    <tr>

                        <td><?= $dado['domingo'] ?></td>
                        <td><?= $dado['segunda'] ?></td>
                        <td><?= $dado['terca'] ?></td>
                        <td><?= $dado['quarta'] ?></td>
                        <td><?= $dado['quinta'] ?></td>
                        <td><?= $dado['sexta'] ?></td>
                        <td><?= $dado['sabado'] ?></td>

                        <td>
                            <a href="controller.php?acao=editar&id=<?= $dado['id'] ?>">Editar</a>
                            <a href="controller.php?acao=excluir&id=<?= $dado['id'] ?>">Excluir</a>
                              
                            </a>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>
</div>