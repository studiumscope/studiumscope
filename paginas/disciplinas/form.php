<div class="card-header">
    <h3 ><?= isset($dado) ? "Cadastrar nova Disciplina" : "Editar Matéria" ?></h3>
</div>
<div class="card mt-5 sem-bordas">
    <div class="card-body">
        <form method="post" action="controller.php?acao=salvar">
            <input type="hidden" name="id" value="<?= $dado['id'] ?? '' ?>">

            <div class="insere-azul d-flex align-items-center">
                <label class="form-label">Matéria:</label>
                <input class="form-control" type="text" name="materia"
                       value="<?= $dado["materia"] ?? '' ?>" required autofocus>
            </div>

            <div class="insere-azul d-flex align-items-center">
                <label class="form-label">Professor(a):</label>
                <input class="form-control" type="text" name="professor"
                    value="<?= $dado["professor"] ?? '' ?>" required autofocus>
            </div>

            <div class="insere-azul d-flex align-items-center ">
                <label class="form-label">Contatos:</label>
                <input class="form-control contatos" type="text" name="contatos"
                    value="<?= $dado["contatos"] ?? '' ?>" required autofocus>
            </div>

            <div class="insere-azul d-flex align-items-center">
                <label class="form-label">Nota Atual:</label>
                <input class="form-control" type="number" name="nota_atual"
                    value="<?= $dado["nota_atual"] ?? '' ?>" required autofocus>
            </div>

            <div class="insere-azul d-flex align-items-center">
                <label class="form-label">Nota Necessária:</label>
                <input class="form-control" type="number" name="nota_necessaria"
                    value="<?= $dado["nota_necessaria"] ?? '' ?>" required autofocus>
            </div>

            <button class="btn mt-4 insere-azul text-black sem-bordas salvar" type="submit">Salvar</button>
        </form>
    </div>
</div>
