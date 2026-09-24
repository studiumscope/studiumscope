<div class="card-header">
    <h3><?= isset($dado) ? "Cadastrar Horário" : "Editar Horário" ?></h3>
</div>

<div class="card mt-5 sem-bordas">
    <div class="card-body">

        <form method="post" action="controller.php?acao=salvar">

            <input type="hidden" name="id" value="<?= $dado['id'] ?? '' ?>">

            <div class="insere-azul d-flex align-items-center">
                <label class="form-label">Dom</label>
                <input class="form-control" type="text" name="domingo"
                       value="<?= $dado["domingo"] ?? '' ?>">
            </div>

            <div class="insere-azul d-flex align-items-center">
                <label class="form-label">Seg</label>
                <input class="form-control" type="text" name="segunda"
                       value="<?= $dado["segunda"] ?? '' ?>">
            </div>

            <div class="insere-azul d-flex align-items-center">
                <label class="form-label">Ter</label>
                <input class="form-control" type="text" name="terca"
                       value="<?= $dado["terca"] ?? '' ?>">
            </div>

            <div class="insere-azul d-flex align-items-center">
                <label class="form-label">Qua</label>
                <input class="form-control" type="text" name="quarta"
                       value="<?= $dado["quarta"] ?? '' ?>">
            </div>

            <div class="insere-azul d-flex align-items-center">
                <label class="form-label">Qui</label>
                <input class="form-control" type="text" name="quinta"
                       value="<?= $dado["quinta"] ?? '' ?>">
            </div>

            <div class="insere-azul d-flex align-items-center">
                <label class="form-label">Sex</label>
                <input class="form-control" type="text" name="sexta"
                       value="<?= $dado["sexta"] ?? '' ?>">
            </div>

            <div class="insere-azul d-flex align-items-center">
                <label class="form-label">Sab</label>
                <input class="form-control" type="text" name="sabado"
                       value="<?= $dado["sabado"] ?? '' ?>">
            </div>

            <button class="btn mt-4 insere-azul text-black sem-bordas salvar"
                    type="submit">
                Salvar
            </button>

        </form>

    </div>
</div>