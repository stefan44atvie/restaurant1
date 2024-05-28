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
            <a class="navbar-brand active" href="../index.php">
                <img src = "../components/media/Logos/psvbeisl.png" height="40px" alt ="menu">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Menükarten hochladen</a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Events hinzufügen</a>
                </li>
               <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Reservierung</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="openhours.php">Kontakt/Öffnungszeiten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="impressionen.php">Impressionen</a>
                </li> -->
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="impressum.php">Impressum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="datenschutz.php">Datenschutz</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
<section id="dashboard">
    <div class="dash_box">
        <div class="lefta"></div>
        <div class="main_abox opacity_dark50 box_shadow">
            <div class="titel_dashboard">
                <h1>Menükarten</h1>
            </div>
            <div class="text_dashboard">
                <p class="dashboard_introtext">
                    Hallo USER, hier hast du die Möglichkeit, entweder eine neue Speisekarte oder eine neue Wochenkarte hochzuladen. 
                </p> 
                <br>
                <p class="text_admin_team">
                    Dein Admin-Team
                </p>
                <br>
                <form class="w-100 pb-2" method="POST" action="<?= htmlspecialchars($_SERVER['SCRIPT_NAME'])?>" enctype="multipart/form-data">
                    <div id="upload_box">

                        <div id="weeklymenu">
                            <h3>Wochenkarte</h3>
                                <input type="file" placeholder="Bitte Dokument einfügen" class="form-control" name= "dokument">
                        </div>
                        <div id="standardmenu">
                            <h3>Speisekarte</h3>
                                <input type="file" placeholder="Bitte Dokument einfügen" class="form-control" name= "dokument">
                        </div>
                        <div id="uploadweekly">
                            <input type="submit" class="form-control btn btn-primary w-100" name="uploadWeekly" value="Wochenkarte aktualisieren">
                        </div>
                        <div id="uploadstandard">
                            <input type="submit" class="form-control btn btn-primary w-100" name="uploadStandard" value="Speisekarte aktualisieren">
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="righta"></div>
    </div>
</section>







  <noscript>Your browser don't support JavaScript!</noscript>
  <script src="./scripts.js"></script>
</body>
</html>