<?php 
    session_start(); 

    require "components/database/db_connect_Beisl.php";

    //Eingeloggt als ...
    if($_SESSION["superadmin"]){
        $id = $_SESSION["superadmin"];
        $session_superadmin = $_SESSION['superadmin'];

        // $sql_user = "select * from users where id = $id";
        // $resUS1 = mysqli_query($connect,$sql_user);
        // $rowUS1 = mysqli_fetch_assoc($resUS1);
        // $vorname = $rowUS1['username'];
    }else if ($_SESSION["admin"]){
        $id = $_SESSION["admin"];
        $session_admin = $_SESSION['admin'];
        // $sql_user = "select * from users where id = $id";
        // $resUS1 = mysqli_query($connect,$sql_user);
        // $rowUS1 = mysqli_fetch_assoc($resUS1);
        // $vorname = $rowUS1['username'];
    }
    // else{
    //     $id="0";
    // }

    if($id){
        $sql_user = "select * from psvb_users where id = $id";
        $resUS1 = mysqli_query($connect,$sql_user);
        $rowUS1 = mysqli_fetch_assoc($resUS1);
        $vorname = $rowUS1['username'];
    }
    //Eingeloggt als... ENDE

    $sql_restname = "select * from psvb_texte where text_id = 3";
    $resNAME = mysqli_query($connect,$sql_restname);
    $rowNAME = mysqli_fetch_assoc($resNAME);
    $restaurant_name = $rowNAME['text'];
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="components/css/beisl_general.css">
    <link rel="stylesheet" href="components/css/beisl_impressum.css">
    <link rel="stylesheet" href="components/css/beisl_fonts.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <title><?php echo $restaurant_name; ?></title>
</head>
<body class="body_impressum">
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
                <a class="nav-link" href="events.php">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reservierung.php">Reservierung</a>
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
                    <a class="nav-link active disabled" href="impressum.php">Impressum</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link disabled" href="datenschutz.php">Datenschutz</a>
                </li>
                <li class="nav-item dropdown" <?php if (!$session_superadmin && !$session_admin) {echo 'style="display:none;"';}?>>
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Eingeloggt als: <?php echo $vorname; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="admin/dashboard.php">Dashboard</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="admin/logout.php?logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
            </div>
        </div>
    </nav>

<section id="impressum">
    <div class="infobox_impressum ">
        <div class="left"></div>
        <div class="main_box opacity_dark50">
            <h1 class="title_impressum">Impressum</h1>
            <p class="text_impressum">
                <span class="bold">
                    Angaben gemäß § 5 TMG
                </span>
                <br>
                HABS Gastronomie Betriebs GmbH
                <br>
                Große Pfarrgasse 11/Top 4
                <br>
                1020 Wien
            </p>
            <p class="text_impressum">
                <span class="bold">
                    Vertreten durch
                </span>    
                <br>
                HABS Gastronomie Betriebs GmbH,
                <br>
                Geschäftsführer: Bernhard Schmidt, Andreas Horner
            </p>
            <p class="text_impressum">
                <span class="bold">
                    Design & Umsetzung
                </span>    
                <br>
                WebDesign Digitale Seele
                <br>
                Stefan Rüdenauer
                <br>
                <a>webdesign.digitaleseele.at</a>
            </p>
            <p class="text_impressum">
                <span class="bold">
                    Kontakt                
                </span>    
                <br>
                Telefon: +43 (1) 263 36 66-32
                <br>
                E-Mail: office@psvbeisl.at
            </p>
            <p class="text_impressum">
                <span class="bold">
                    Registereintrag                
                </span>    
                <br>
                Eintragung im Handelsregister.
                <br>
                Registergericht: Handelsgericht Wien
                <br>
                Registernummer: FN 525480 s
            </p>
            <p class="text_impressum">
                <span class="bold">
                Umsatzsteuer                
                </span>  
                <br>
                Umsatzsteuer-Identifikationsnummer gemäß §27 a Umsatzsteuergesetz:
                <br>
                ATU75007813
            </p>
            <p class="text_impressum">
                <span class="bold">
                    Aufsichtsbehörde
                </span>  
                <br>
                Magistratisches Bezirksamt des 22. Bezirkes
                <br>
                Schrödingerplatz 1, 1220 Wien
            </p>
            <p class="text_impressum">
                <span class="bold">
                    Berufsbezeichnung und berufsrechtliche Regelungen
                </span>  
                <br>
                Berufsbezeichnung: Gastgewerbe in der Betriebsart Restaurant
                <br>
                Zuständige Kammer: WKÖ – Fachgruppe Gastronomie
                <br>
                Verliehen durch: Wien
                <br>
                Es gelten folgende berufsrechtliche Regelungen: Gewerbeverordnung Gastronomie
                <br>
                Regelungen einsehbar unter: http://www.ris.bka.gv.at
            </p>
            <p class="text_impressum">
                <span class="bold">
                    Streitschlichtung
                </span>   
                <br>
                Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit: https://ec.europa.eu/consumers/odr 
                <br>    
                Unsere E-Mail-Adresse finden Sie oben im Impressum.
            </p>
            <p class="text_impressum">
                Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.
            </p>
        </div>
        <div class="right"></div>
    </div>
</section>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
