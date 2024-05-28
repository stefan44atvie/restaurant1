<?php 




?>

<!DOCTYPE html>
<html lang="de">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../components/css/beisl_general.css">
    <link rel="stylesheet" href="../components/css/beisl_admin.css">
    <link rel="stylesheet" href="../components/css/beisl_fonts.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>PSV-Beisl Admin-Dashboard</title>
</head>
<body class="body_admin">
<nav class="navbar navbar-expand-lg opacity_dark50 navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand active" href="index.php">
                <img src = "components/media/Logos/psvbeisl.png" height="40px" alt ="menu">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Unsere Menükarten
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="speisekarte.php">Speisekarte</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="wochenkarte.php">Wochenkarte</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Reservierung</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="openhours.php">Kontakt/Öffnungszeiten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="impressionen.php">Impressionen</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="impressum.php">Impressum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="datenschutz.php">Datenschutz</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
<section id="dashboard">
    <div class="dash_box">
        <div class="lefta"></div>
        <div class="main_abox opacity_dark50">
            <div class="titel_dashboard">
                <h1>Dashboard PSV-Beisl</h1>
            </div>
            <div class="text_dashboard">
                <p class="dashboard_introtext">
                    Hallo USER, du befindest dich nun im Admin-Bereich des PSV-Beisls. Hier kannst du ab sofort diverse Einstellungen und Änderungen an der Homepage vornehmen. Lade neue Speisekarten hoch oder trage zukünftige Events ein. 
                </p> 
                <br>
                <p class="text_admin_team">
                    Dein Admin-Team
                </p>
            </div>
        </div>
        <div class="righta"></div>
    </div>
</section>







  <noscript>Your browser don't support JavaScript!</noscript>
  <script src="./scripts.js"></script>
</body>
</html>