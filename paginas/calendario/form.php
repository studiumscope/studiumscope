<?php

$editando = $evento !== null;

$titulo = $evento['titulo'] ?? '';
$descricao = $evento['descricao'] ?? '';
$dataEvento = $evento['data_evento'] ?? $data;
$hora = $evento['hora'] ?? '';
$tipo = $evento['tipo'] ?? '';

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= $editando ? 'Editar evento' : 'Novo evento' ?>
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/calendario.css">
</head>

<body>

<div class="form-container">

    <div class="form-card">

        <a
            href="controller.php?acao=index&mes=<?= date('Y-m', strtotime($dataEvento)) ?>"
            class="form-voltar"
        >
            ← Voltar para o calendário
        </a>

        <div class="form-header">

            <span>CALENDÁRIO</span>

            <h1>
                <?= $editando ? 'Editar evento' : 'Novo evento' ?>
            </h1>

            <p>
                Adicione uma informação importante ao seu calendário.
            </p>

        </div>

        <?php if (isset($_GET['erro'])): ?>

            <div class="alert alert-danger">
                Preencha o título, a data e o tipo do evento.
            </div>

        <?php endif; ?>


        <form
            action="controller.php?acao=salvar"
            method="POST"
        >

            <?php if ($editando): ?>

                <input
                    type="hidden"
                    name="id"
                    value="<?= $evento['id'] ?>"
                >

            <?php endif; ?>


            <div class="campo">

                <label for="titulo">
                    Título
                </label>

                <input
                    type="text"
                    id="titulo"
                    name="titulo"
                    value="<?= htmlspecialchars($titulo) ?>"
                    placeholder="Ex.: Prova de Matemática"
                    maxlength="150"
                    required
                >

            </div>


            <div class="campo">

                <label for="descricao">
                    Descrição
                </label>

                <textarea
                    id="descricao"
                    name="descricao"
                    placeholder="Adicione os detalhes do evento..."
                    rows="4"
                ><?= htmlspecialchars($descricao) ?></textarea>

            </div>


            <div class="campo">

                <label for="data_evento">
                    Data
                </label>

                <input
                    type="date"
                    id="data_evento"
                    name="data_evento"
                    value="<?= htmlspecialchars($dataEvento) ?>"
                    required
                >

            </div>


            <div class="form-linha">

                <div class="campo">

                    <label for="hora">
                        Horário
                    </label>

                    <input
                        type="time"
                        id="hora"
                        name="hora"
                        value="<?= htmlspecialchars($hora) ?>"
                    >

                </div>


                <div class="campo">

                    <label for="tipo">
                        Tipo
                    </label>

                    <select
                        id="tipo"
                        name="tipo"
                        required
                    >

                        <option value="">
                            Selecione
                        </option>

                        <option value="Prova" <?= $tipo === 'Prova' ? 'selected' : '' ?>>
                            Prova
                        </option>

                        <option value="Trabalho" <?= $tipo === 'Trabalho' ? 'selected' : '' ?>>
                            Trabalho
                        </option>

                        <option value="Tarefa" <?= $tipo === 'Tarefa' ? 'selected' : '' ?>>
                            Tarefa
                        </option>

                        <option value="Outro" <?= $tipo === 'Outro' ? 'selected' : '' ?>>
                            Outro
                        </option>

                    </select>

                </div>

            </div>


            <button
                type="submit"
                class="btn-salvar"
            >
                <?= $editando ? 'Salvar alterações' : 'Adicionar ao calendário' ?>
            </button>

        </form>

    </div>

</div>

</body>

</html>