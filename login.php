<div class="card mt-5 sem-bordas">
    <div class="card-body">
        <form method="post" action="authController.php?acao=login">
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

            <a class="btn btn-link mt-4" href="authController.php?acao=cadastrar" >Cadastrar</a>
            <button class="btn mt-4 bg-transparent sem-bordas text-black" type="submit">Entrar</button>
        </form>
    </div>
</div>
