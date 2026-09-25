<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../authController.php?acao=login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUD+ Premium - STUDIUM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/premium.css" rel="stylesheet">
</head>
<body class="premium-body bg-light">

    <header class="premium-header text-center mt-5 mb-5">
        <h1 class="premium-title display-5 fw-bold">Descubra o STUD+</h1>
        <nav class="premium-nav mt-3">
            <a href="../../home.php" class="btn btn-outline-secondary btn-voltar">Voltar ao Início</a>
        </nav>
    </header>

    <main class="premium-container container">
        <section class="planos-section text-center mb-5">
            <h2 class="section-subtitle h3 mb-3">Escolha o melhor plano para os seus estudos</h2>
            <p class="section-desc text-muted mb-5">Desbloqueie ferramentas exclusivas para atingir as suas metas mais rápido!</p>

            <div class="row justify-content-center gap-4">
                
                <article class="card-plano plano-basico col-md-5 card shadow-sm p-4">
                    <h3 class="plano-title h4">Plano Básico</h3>
                    <p class="plano-preco fs-5 mb-4"><strong>Gratuito</strong></p>
                    
                    <ul class="plano-features list-unstyled text-start mb-4 mx-auto" style="max-width: 250px;">
                        <li class="mb-2">Gestão de Disciplinas</li>
                        <li class="mb-2">Quadro de Horários</li>
                        <li class="mb-2">Controle de Trabalhos</li>
                        <li class="mb-2">Acesso ao Calendário</li>
                    </ul>
                    
                    <button type="button" class="btn btn-secondary mt-auto btn-plano" disabled>O seu plano atual</button>
                </article>

                <article class="card-plano plano-premium col-md-5 card shadow p-4 border border-primary border-2">
                    <h3 class="plano-title h4 text-primary">STUD+ (Premium)</h3>
                    <p class="plano-preco fs-5 mb-4 text-primary"><strong>R$ 9,90 / mês</strong></p>
                    
                    <ul class="plano-features list-unstyled text-start mb-4 mx-auto" style="max-width: 250px;">
                        <li class="mb-2">Tudo do Plano Básico</li>
                        <li class="mb-2"><strong>Metas:</strong> Defina objetivos</li>
                        <li class="mb-2"><strong>Progresso:</strong> Estatísticas reais</li>
                        <li class="mb-2">Sem anúncios</li>
                    </ul>
                    
                    <button type="button" class="btn btn-primary mt-auto btn-plano">Assinar STUD+</button>
                </article>

            </div>
        </section>
    </main>

</body>
</html>