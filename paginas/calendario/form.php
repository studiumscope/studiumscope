<?php
$evento = $evento ?? null;
$editando = $evento !== null;

$titulo     = $evento['titulo']      ?? '';
$descricao  = $evento['descricao']   ?? '';
$dataEvento = $evento['data_evento'] ?? ($data ?? date('Y-m-d'));
$hora       = $evento['hora']        ?? '';
$tipo       = $evento['tipo']        ?? '';
?>

<div class="cal-form-wrapper">
    <div class="cal-form-card">

        <a href="?acao=index&mes=<?= date('Y-m', strtotime($dataEvento)) ?>" class="cal-form-voltar">
            ← Voltar para o calendário
        </a>

        <div class="cal-form-header">
            <span>CALENDÁRIO</span>
            <h1><?= $editando ? 'Editar Evento' : 'Novo Evento' ?></h1>
            <p>Adicione uma informação importante ao seu calendário.</p>
        </div>

        <?php if (isset($_GET['erro'])): ?>
            <div class="cal-alerta">Preencha o título, a data e o tipo do evento.</div>
        <?php endif; ?>

        <form action="?acao=salvar" method="POST">

            <?php if ($editando): ?>
                <input type="hidden" name="id" value="<?= htmlspecialchars((string) ($evento['id'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
            <?php endif; ?>

            <div class="cal-campo">
                <label>Título</label>
                <input type="text" name="titulo"
                       value="<?= htmlspecialchars($titulo) ?>"
                       placeholder="Ex.: Prova de Matemática" maxlength="150" required autofocus>
            </div>

            <div class="cal-campo">
                <label>Descrição</label>
                <textarea name="descricao" rows="4"
                          placeholder="Adicione os detalhes do evento..."><?= htmlspecialchars($descricao) ?></textarea>
            </div>

            <div class="cal-campo">
                <label>Data</label>
                <input type="date" name="data_evento"
                       value="<?= htmlspecialchars($dataEvento) ?>" required>
            </div>

            <div class="cal-form-linha">
                <div class="cal-campo">
                    <label>Horário</label>
                    <input type="time" name="hora" value="<?= htmlspecialchars($hora) ?>">
                </div>

                <div class="cal-campo">
                    <label>Tipo</label>
                    <select name="tipo" required>
                        <option value="">Selecione</option>
                        <option value="Prova"    <?= $tipo === 'Prova'    ? 'selected' : '' ?>>Prova</option>
                        <option value="Trabalho" <?= $tipo === 'Trabalho' ? 'selected' : '' ?>>Trabalho</option>
                        <option value="Tarefa"   <?= $tipo === 'Tarefa'   ? 'selected' : '' ?>>Tarefa</option>
                        <option value="Outro"    <?= $tipo === 'Outro'    ? 'selected' : '' ?>>Outro</option>
                    </select>
                </div>
            </div>

            <div class="cal-form-acoes">
                <a href="?acao=index" class="cal-btn-cancelar">Cancelar</a>
                <button type="submit" class="cal-btn-salvar">
                    <?= $editando ? 'Salvar' : 'Adicionar' ?>
                </button>
            </div>

        </form>
    </div>
</div>