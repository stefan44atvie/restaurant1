<?php 
    require "components/database/db_connect_Beisl.php";

    session_start(); 

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

    // var_dump($vorname);
    // die();

    $sql_eventlist = "select * from psvb_events order by event_date DESC";
    $resEV = mysqli_query($connect,$sql_eventlist);

    if(mysqli_num_rows($resEV)  > 0) {
        while($rowEV = mysqli_fetch_array($resEV, MYSQLI_ASSOC)){
            $eid = $rowEV['id'];
            $event_title = $rowEV['event_title'];
            $event_description = $rowEV['event_description'];
            $event_dateX = $rowEV['event_date'];
            $event_startX = $rowEV['event_start'];
            $event_endX = $rowEV['event_end'];
            $event_picture = $rowEV['event_picture'];
            $pfad="uploads/events";
            
            $event_date = date("d.m.Y", strtotime($event_dateX));
            $event_start = date("H:i", strtotime($event_startX));
            $event_end = date("H:i", strtotime($event_endX));

            // $create_date = date("d.m.Y", strtotime($create)); 

            $tbody .= "
            <tr>
                <td class='table_text'><img src=' $pfad/$event_picture' width='150'></td>
                <td class='table_text'>" .$event_title."</td>
                <td class='table_text'>" .$event_date."</td>
                <td class='table_text'>" .$event_start."</td>
            </tr>
            ";
        }
    }else {
            $tbody =  "<tr><td colspan='9' class='noitem'><center>Derzeit keine Events im PSVBeisl geplant. </center></td></tr>";
    }

    //TEXTE 
    $sql_textcat_events = "select * from psvb_text_art where textart='Veranstaltungen Text'";
    $resEVT = mysqli_query($connect,$sql_textcat_events);
    $rowEVT = mysqli_fetch_assoc($resEVT);
    $textcat_eventtext = $rowEVT["art_id"];
    //$sql_abschiedstext = "select "
    $sql_eventtext = "select * from psvb_hp_texte where fk_textart = $textcat_eventtext";
    $resET = mysqli_query($connect,$sql_eventtext);
    $rowET = mysqli_fetch_assoc($resET);
    $event_text = $rowET['hp_meldung'];

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
    <link rel="stylesheet" href="components/css/beisl_events.css">
    <link rel="stylesheet" href="components/css/beisl_fonts.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <title><?php echo $restaurant_name; ?></title>
</head>
<body class="body_events">
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
                <a class="nav-link active" href="events.php">Events</a>
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

    <section id="events_list">
        <div id="infobox_events">
            <div class="main_box opacity_dark50">
                <h1 class="beisl_standardtitel"> Veranstaltungen WelcomeLounge</h1>
                <p class="beisl_standardtext">
                    <?php echo $event_text; ?>
                </p>
                <div class="events_scroll">
                    <table class="table table-dark table-striped">
                    <!--  <tr>
                            <th class="table_title">
                                Bild
                            </th>
                            <th class="table_title">
                                Titel
                            </th>
                            <th class="table_title">
                                Datum
                            </th>
                            <th class="table_title">
                                Uhrzeit
                            </th>
                            <th class="table_title">
                                Optionen
                            </th>
                        </tr> -->
                        <?php echo $tbody; ?>
                    </table>
                </div>
            </div>
            <div class="right"></div>
        </div>
    </section>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>