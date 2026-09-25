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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/premium.css">
    <title>STUD+ Premium - STUDIUM</title>
</head>
<body>

    <header>
        <h1>Descubra o STUD+</h1>
        <nav>
            <a href="../../home.php">Voltar ao Início</a>
        </nav>
    </header>

    <main>
        <section>
            <h2>Escolha o melhor plano para os seus estudos</h2>
            <p>Desbloqueie ferramentas exclusivas para atingir as suas metas mais rápido!</p>

            <article>
                <h3>Plano Básico</h3>
                <p><strong>Gratuito</strong></p>
                <ul>
                    <li>Gestão de Disciplinas</li>
                    <li>Quadro de Horários</li>
                    <li>Controle de Trabalhos</li>
                    <li>Acesso ao Calendário</li>
                </ul>
                <button type="button" disabled>O seu plano atual</button>
            </article>

            <br><hr><br>

            <article>
                <h3>STUD+ (Premium)</h3>
                <p><strong>R$ 9,90 / mês</strong></p>
                <ul>
                    <li>Tudo do Plano Básico</li>
                    <li><strong>Metas:</strong> Defina e acompanhe objetivos de estudo</li>
                    <li><strong>Progresso:</strong> Gráficos e estatísticas de desempenho detalhadas</li>
                    <li>Sem anúncios</li>
                </ul>
                <button type="button">Assinar STUD+</button>
            </article>
        </section>
    </main>

</body>
</html>