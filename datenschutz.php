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
                <li class="nav-item ">
                    <a class="nav-link disabled" href="impressum.php">Impressum</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active disabled" href="datenschutz.php">Datenschutz</a>
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
            <div class="imp_title">
                <h1 class="title_impressum">Datenschutzerklärung</h1>
            </div>
            <p class="text_impressum">
                Der Schutz Ihrer persönlichen Daten ist uns ein besonderes Anliegen. Wir verarbeiten Ihre Daten daher ausschließlich auf Grundlage der gesetzlichen Bestimmungen (DSGVO, TKG 2003). In diesen Datenschutzinformationen informieren wir Sie über die wichtigsten Aspekte der Datenverarbeitung im Rahmen unserer Website.
            </p>
            <a class="title_impressum bold">KONTAKT MIT UNS / RESERVIERUNGEN</a>
            <p class="text_impressum">
                Wenn Sie per Formular auf der Website oder per E-Mail Kontakt mit uns aufnehmen beziehungsweise eine Reservierung vornehmen, werden Ihre angegebenen Daten zwecks Bearbeitung der Anfrage/Hinterlegung der Reservierung und für den Fall von Anschlussfragen bis zu zwei Jahre bei uns gespeichert. Diese Daten geben wir nicht ohne Ihre Einwilligung weiter.
            </p>
            <a class="title_impressum bold">IHRE RECHTE</a>
            <p class="text_impressum">
                Ihnen stehen grundsätzlich die Rechte auf Auskunft, Berichtigung, Löschung, Einschränkung, Datenübertragbarkeit, Widerruf und Widerspruch zu. Wenn Sie glauben, dass die Verarbeitung Ihrer Daten gegen das Datenschutzrecht verstößt oder Ihre datenschutzrechtlichen Ansprüche sonst in einer Weise verletzt worden sind, können Sie sich bei der Aufsichtsbehörde beschweren. In Österreich ist dies die Datenschutzbehörde.
            </p>
            <a class="title_impressum bold">UNSERE KONTAKTDATEN</a>
            <p class="text_impressum">
                B & S public entertainment GmbH
                <br>
                Große Pfarrgasse 11/1-3
                <br>
                1020 Wien
                <br>
                Österreich
                <br>
                Telefon: +43 (1) 263 36 66-32
                <br>
                E-Mail: office@psvbeisl.at
            </p>
            <a class="title_impressum bold">WEB-ANALYSE</a>
            <p class="text_impressum">
                Unsere Website verwendet Funktionen des Webanalysedienstes Matomo (die Daten werden nicht an ein (außereuropäisches) Drittland übertragen). Dazu werden Cookies verwendet, die eine Analyse der Benutzung der Website durch Ihre Benutzer ermöglicht. Die dadurch erzeugten Informationen werden auf unseren Webserver übertragen und dort gespeichert. Sie können dies verhindern, indem Sie Ihren Browser so einrichten, dass keine Cookies gespeichert werden. Ihre IP-Adresse wird erfasst, aber umgehend pseudonymisiert. Dadurch ist nur mehr eine grobe Lokalisierung möglich.
                <br>
                Die Datenverarbeitung erfolgt auf Basis der gesetzlichen Bestimmungen des § 96 Abs 3 TKG sowie des Art 6 Abs 1 lit a (Einwilligung) und/oder f (berechtigtes Interesse) der DSGVO.
                Unser Anliegen im Sinne der DSGVO (berechtigtes Interesse) ist die Verbesserung unseres Angebotes und unseres Webauftritts. Da uns die Privatsphäre unserer Nutzer wichtig ist, werden die Nutzerdaten pseudonymisiert.
                <br>
                Die Nutzerdaten werden für die Dauer von 2 Jahren aufbewahrt.
                <br>
                <br>
                Web-Analyse mit Matomo
            </p>
        </div>
        <div class="right"></div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>