<div class="card mt-5 sem-bordas">
    <div class="card-body">
        <form method="post" action="authController.php?acao=salvar">
            <div class="insere-azul d-flex align-items-center">
                <label class="form-label">Nome:</label>
                <input class="form-control" type="text" name="nome"
                       value="<?= $dado["nome"] ?? '' ?>" required autofocus>
            </div>

            <div class="insere-azul d-flex align-items-center">
                <label class="form-label">E-mail:</label>
                <input class="form-control" type="email" name="email"
                    value="<?= $dado["email"] ?? '' ?>" required autofocus>
            </div>

            <div class="insere-azul d-flex align-items-center">
                <label class="form-label">Senha:</label>
                <input class="form-control" type="password" name="senha"
                    value="<?= $dado["senha"] ?? '' ?>" required autofocus>
            </div>

            <button class="btn btn-primary mt-4 bg-transparent text-black sem-bordas salvar" type="submit">Salvar</button>
        </form>
    </div>
</div>
