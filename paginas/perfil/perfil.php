<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - STUDIUM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/perfil.css" rel="stylesheet">
</head>
<body class="perfil-body bg-light">

    <header class="perfil-header text-center mt-4 mb-4">
        <h1 class="perfil-title">Meu Perfil</h1>
        <nav class="perfil-nav mt-2">
            <a href="../../home.php" class="btn btn-outline-secondary btn-voltar">Voltar ao Início</a>
        </nav>
    </header>

    <main class="perfil-container container" style="max-width: 600px;">
        
        <section class="perfil-edicao card shadow-sm p-4 mb-4">
            <h2 class="section-title h4 mb-4">Editar Meus Dados</h2>
            
            <?php if (!empty($mensagem)): ?>
                <div class="alerta-sucesso alert alert-success" role="alert">
                    <strong><?php echo $mensagem; ?></strong>
                </div>
            <?php endif; ?>

            <form action="controller.php" method="POST" class="form-perfil">
                <div class="form-group mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" id="nome" name="nome" class="form-control input-nome" value="<?php echo htmlspecialchars($usuario['nome'] ?? ''); ?>" required>
                </div>
                
                <div class="form-group mb-3">
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="email" id="email" name="email" class="form-control input-email" value="<?php echo htmlspecialchars($usuario['email'] ?? ''); ?>" required>
                </div>
                
                <div class="form-group mb-4">
                    <label for="senha" class="form-label">Nova Senha <small class="text-muted">(deixe em branco para manter a atual)</small>:</label>
                    <input type="password" id="senha" name="senha" class="form-control input-senha">
                </div>
                
                <button type="submit" class="btn btn-primary w-100 btn-salvar">Salvar Alterações</button>
            </form>
        </section>

        <section class="perfil-opcoes card shadow-sm p-4 text-center">
            <h2 class="section-title h5 mb-3">Opções da Conta</h2>
            <a href="../../authController.php?acao=sair" class="btn btn-danger btn-sair">Sair / Terminar Sessão</a>
        </section>

    </main>

</body>
</html>