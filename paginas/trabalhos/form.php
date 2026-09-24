<div class="trab-form-header">
    <h3><?= !empty($dado['id']) ? "Editar Trabalho" : "Cadastrar novo Trabalho" ?></h3>
</div>

<div class="card mt-5 sem-bordas">
    <div class="card-body">
        <form method="post" action="controller.php?acao=salvar">
            <input type="hidden" name="id" value="<?= $dado['id'] ?? '' ?>">

            <div class="trab-campo">
                <label>Título:</label>
                <input type="text" name="titulo"
                       value="<?= htmlspecialchars($dado['titulo'] ?? '') ?>" required autofocus>
            </div>

            <div class="trab-campo">
                <label>Matéria:</label>
                <input type="text" name="materia"
                       value="<?= htmlspecialchars($dado['materia'] ?? '') ?>" required>
            </div>

            <div class="trab-campo">
                <label>Integrantes:</label>
                <textarea name="integrantes" rows="2"
                          placeholder="Ex: João, Maria, Pedro"><?= htmlspecialchars($dado['integrantes'] ?? '') ?></textarea>
            </div>

            <div class="trab-campo">
                <label>Data de Entrega:</label>
                <input type="date" name="data_entrega"
                       value="<?= $dado['data_entrega'] ?? '' ?>" required>
            </div>

            <div class="trab-campo">
                <label>Descrição:</label>
                <textarea name="descricao" rows="4"
                          placeholder="Detalhes do trabalho..."><?= htmlspecialchars($dado['descricao'] ?? '') ?></textarea>
            </div>

            <button class="trab-btn-salvar" type="submit">Salvar</button>
        </form>
    </div>
</div>