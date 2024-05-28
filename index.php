<?php 
    require "components/database/db_connect_Beisl.php";

    session_start();

    $sql_welcometext = "select * from psvb_hp_texte where fk_textart = 1";
    $resWT = mysqli_query($connect,$sql_welcometext);
    $rowWT = mysqli_fetch_assoc($resWT);
    $welcome_text = $rowWT['hp_meldung'];

    $sql_abschiedstext = "select * from psvb_hp_texte where fk_textart = 12";
    $resTAB = mysqli_query($connect,$sql_abschiedstext);
    $rowTAB = mysqli_fetch_assoc($resTAB);
    $text_abschied = $rowTAB["hp_meldung"];

    $sql_restname = "select * from psvb_texte where text_id = 3";
    $resNAME = mysqli_query($connect,$sql_restname);
    $rowNAME = mysqli_fetch_assoc($resNAME);
    $restaurant_name = $rowNAME['text'];

   //Eingeloggt als ...
    if($_SESSION["superadmin"]){
        $id = $_SESSION["superadmin"];

        // $sql_user = "select * from users where id = $id";
        // $resUS1 = mysqli_query($connect,$sql_user);
        // $rowUS1 = mysqli_fetch_assoc($resUS1);
        // $vorname = $rowUS1['username'];
    }else if ($_SESSION["admin"]){
        $id = $_SESSION["admin"];

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

    // var_dump($text_abschied);
    // die();

    $sql_latestnews = "select * from psvb_latestnews order by create_date DESC limit 1";
    $resLN = mysqli_query($connect,$sql_latestnews);
    $rowLN = mysqli_fetch_assoc($resLN);

    $news_title = $rowLN['titel'];
    $news_meldung = $rowLN['meldung'];
    $gueltig_abD = $rowLN['gueltig_ab'];
    $gueltig_bisD = $rowLN['gueltig_bis'];
 
    $gueltig_ab = date("d.m.Y", strtotime($gueltig_abD)); 
    $gueltig_bis = date("d.m.Y", strtotime($gueltig_bisD)); 

    // var_dump($news_meldung);
    // die();
    $date_now = date("d.m.Y");

    $newday = 0;

    if(($date_now>=$gueltig_ab)&&($date_now<$gueltig_bis)) {
        $newday = "OHA".' '.$news_meldung; //$gueltig_ab ist aktuell oder schon vergangen
        $tex = "YES";
    }else{
        $news_meldung = 0; //"Derzeit keine aktuellen News. Bitte schauen Sie später wieder vorbei !"; //Datum $gueltig_ab ist noch nicht erreicht 
        $tex = "NO";
    }

    // var_dump($news_meldung);
    // die();
    //Öffnungszeiten - Test

    $session_admin = $_SESSION['admin'];
    $session_superadmin = $_SESSION['superadmin'];
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="components/css/beisl_general.css">
    <link rel="stylesheet" href="components/css/beisl_index.css">
    <link rel="stylesheet" href="components/css/beisl_fonts.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <title><?php echo $restaurant_name; ?></title>
</head>
<body class="body_start">
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
                    <a class="nav-link disabled" href="impressum.php">Impressum</a>
                </li>
                <li class="nav-item">
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


    <div id="startpage_grid">
        <div id="infobox" class="opacity_dark50">
            <h1>Herzlich Willkommen</h1>
            <p class="welcome_text">
                <?php echo $welcome_text; ?>
            </p>
            <p class="welcome_text_abschied">
                <?php echo $text_abschied; ?>
            </p>
            <div class="latest" <?php if ($news_meldung==0) {echo 'style="display:none;"';} ?>>
                <br>
                <p class="latest_news"><span class="latest_news_title text-uppercase">Latest NEWS</span>: <?php echo $news_meldung; ?>
                </p>
            </div>
        </div>
    </div>
    
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>