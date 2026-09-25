<div class="disc-form-wrapper">
    <div class="disc-form-card">

        <div class="disc-form-header">
            <h1><?= !empty($dado['id']) ? 'Editar Disciplina' : 'Nova Disciplina' ?></h1>
            <p>Preencha as informações da matéria abaixo.</p>
        </div>

        <form method="post" action="controller.php?acao=salvar">
            <input type="hidden" name="id" value="<?= $dado['id'] ?? '' ?>">

            <div class="disc-campo">
                <label>Matéria</label>
                <input type="text" name="materia"
                       value="<?= htmlspecialchars($dado['materia'] ?? '') ?>"
                       placeholder="Ex.: Matemática" required autofocus>
            </div>

            <div class="disc-campo">
                <label>Professor(a)</label>
                <input type="text" name="professor"
                       value="<?= htmlspecialchars($dado['professor'] ?? '') ?>"
                       placeholder="Ex.: João Silva" required>
            </div>

            <div class="disc-campo">
                <label>Contatos</label>
                <input type="text" name="contatos"
                       value="<?= htmlspecialchars($dado['contatos'] ?? '') ?>"
                       placeholder="Ex.: joao@escola.com">
            </div>

            <div class="disc-form-linha">
                <div class="disc-campo">
                    <label>Nota Atual</label>
                    <input type="number" step="0.1" min="0" max="10" name="nota_atual"
                           value="<?= htmlspecialchars($dado['nota_atual'] ?? '') ?>"
                           placeholder="0.0" required>
                </div>

                <div class="disc-campo">
                    <label>Nota Necessária</label>
                    <input type="number" step="0.1" min="0" max="10" name="nota_necessaria"
                           value="<?= htmlspecialchars($dado['nota_necessaria'] ?? '') ?>"
                           placeholder="0.0" required>
                </div>
            </div>

            <div class="disc-form-acoes">
                <a href="?acao=index" class="disc-btn-cancelar">Cancelar</a>
                <button type="submit" class="disc-btn-salvar">Salvar</button>
            </div>
        </form>

    </div>
</div>