<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUDIUM!!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/home.css" rel="stylesheet">
</head>
<body>

    <header class="home-header">
        <h1>STUDIUM</h1>
        
        <div class="user-actions">
            <a class="btn btn-primary" href="paginas/premium/premium.php" aria-label="STUD+">+</a>
            <a href="paginas/perfil/perfil.php" class="profile-avatar">
                <span class="icon icon-perfil" aria-hidden="true"></span>
            </a>
        </div>
    </header>

    <main class="dashboard-container">

        <nav class="card-menu">
            <ul>
                <li>
                    <a href="paginas/disciplinas/controller.php">
                        <span class="icon icon-disciplinas" aria-hidden="true"></span>
                        <span class="label">Disciplinas</span>
                    </a>
                </li>
                <li>
                    <a href="paginas/horario/controller.php">
                        <span class="icon icon-horario" aria-hidden="true"></span>
                        <span class="label">Horário</span>
                    </a>
                </li>
                <li>
                    <a href="paginas/trabalhos/controller.php">
                        <span class="icon icon-trabalhos" aria-hidden="true"></span>
                        <span class="label">Trabalhos</span>
                    </a>
                </li>
                <li>
                    <a href="paginas/premium.php">
                        <span class="icon icon-metas" aria-hidden="true"></span>
                        <span class="label">Metas</span>
                    </a>
                </li>
                <li>
                    <a href="paginas/premium.php">
                        <span class="icon icon-progresso" aria-hidden="true"></span>
                        <span class="label">Progresso</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        

        <section class="card-calendario">
            <h2>Calendário</h2>
            
            <div class="calendario-card">
                <span class="weekday">Terça-Feira</span>
                <time datetime="2026-09-08">
                    <span class="day">08</span>
                    <span class="month">setembro</span>
                </time>

                <div class="parahoje">
                    <h3>Para hoje:</h3>
                    <p>...</p>
                </div>

                <a class="btn btn-primary" href="paginas/calendario/controller.php">ENTRAR</a>
            </div>
        </section>

    </main>

</body>
</html>
