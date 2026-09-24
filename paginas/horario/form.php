<div class="card-header">
    <h3><?= isset($dado) ? "Editar Horário" : "Cadastrar Horário" ?></h3>
</div>

<div class="card mt-5 sem-bordas">
    <div class="card-body">

        <form method="post" action="controller.php?acao=salvar">

            <input type="hidden" name="id" value="<?= $dado['id'] ?? '' ?>">

            <div class="mb-4">
                <label class="form-label">Período</label>

                <select class="form-control" name="periodo" required>

                    <?php for ($i = 1; $i <= 6; $i++): ?>

                        <option value="<?= $i ?>"
                            <?= (($dado['periodo'] ?? $_GET['periodo'] ?? '') == $i) ? 'selected' : '' ?>>
                            <?= $i ?>º período
                        </option>

                    <?php endfor; ?>

                </select>
            </div>

            <div class="insere-azul d-flex align-items-center mb-3">
                <label class="form-label me-3">Dom</label>
                <input class="form-control"
                       type="text"
                       name="domingo"
                       value="<?= $dado['domingo'] ?? '' ?>">
            </div>

            <div class="insere-azul d-flex align-items-center mb-3">
                <label class="form-label me-3">Seg</label>
                <input class="form-control"
                       type="text"
                       name="segunda"
                       value="<?= $dado['segunda'] ?? '' ?>">
            </div>

            <div class="insere-azul d-flex align-items-center mb-3">
                <label class="form-label me-3">Ter</label>
                <input class="form-control"
                       type="text"
                       name="terca"
                       value="<?= $dado['terca'] ?? '' ?>">
            </div>

            <div class="insere-azul d-flex align-items-center mb-3">
                <label class="form-label me-3">Qua</label>
                <input class="form-control"
                       type="text"
                       name="quarta"
                       value="<?= $dado['quarta'] ?? '' ?>">
            </div>

            <div class="insere-azul d-flex align-items-center mb-3">
                <label class="form-label me-3">Qui</label>
                <input class="form-control"
                       type="text"
                       name="quinta"
                       value="<?= $dado['quinta'] ?? '' ?>">
            </div>

            <div class="insere-azul d-flex align-items-center mb-3">
                <label class="form-label me-3">Sex</label>
                <input class="form-control"
                       type="text"
                       name="sexta"
                       value="<?= $dado['sexta'] ?? '' ?>">
            </div>

            <div class="insere-azul d-flex align-items-center mb-3">
                <label class="form-label me-3">Sáb</label>
                <input class="form-control"
                       type="text"
                       name="sabado"
                       value="<?= $dado['sabado'] ?? '' ?>">
            </div>

            <button class="btn mt-3 insere-azul text-black sem-bordas salvar"
                    type="submit">
                Salvar
            </button>

        </form>

    </div>
</div>