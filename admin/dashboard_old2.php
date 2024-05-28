<?php 

    session_start();

    if(!isset($_SESSION["superadmin"])&&!isset($_SESSION["admin"])){
        header("Location: index.php");
        exit;
    }

    $session_admin = $_SESSION['admin'];
    $session_superadmin = $_SESSION['superadmin'];

    require "../components/database/db_connect_Beisl.php";

    $sql_welcometext = "select * from hp_texte where fk_textart = 1";
    $resWT = mysqli_query($connect,$sql_welcometext);
    $rowWT = mysqli_fetch_assoc($resWT);
    $welcome_text = $rowWT['hp_meldung'];

    $sql_latestnews = "select * from latestnews order by create_date DESC limit 1";
    $resLN = mysqli_query($connect,$sql_latestnews);
    $rowLN = mysqli_fetch_assoc($resLN);

    $news_title = $rowLN['titel'];
    $news_meldung = $rowLN['meldung'];
    $gueltig_abD = $rowLN['gueltig_ab'];
    $gueltig_bisD = $rowLN['gueltig_bis'];
 
    $gueltig_ab = date("d.m.Y", strtotime($gueltig_abD)); 
    $gueltig_bis = date("d.m.Y", strtotime($gueltig_bisD)); 

    $date_now = date("d.m.Y");

    $newday = 0;

    if(($date_now>=$gueltig_ab)&&($date_now<$gueltig_bis)) {
        $newday = "OHA".' '.$news_meldung; //$gueltig_ab ist aktuell oder schon vergangen
        $tex = "YES";
    }else{
        $news_meldung = 0; //"Derzeit keine aktuellen News. Bitte schauen Sie später wieder vorbei !"; //Datum $gueltig_ab ist noch nicht erreicht 
        $tex = "NO";
    }
if($_SESSION["superadmin"]){
    $id = $_SESSION["superadmin"];
    $sql_user = "select * from users where user_id = $id";
        $resUS1 = mysqli_query($connect,$sql_user);
        $rowUS1 = mysqli_fetch_assoc($resUS1);
        $vorname = $rowUS1['username'];
}else if ($_SESSION["admin"]){
    $id = $_SESSION["admin"];
    $sql_user = "select * from users where user_id = $id";
        $resUS1 = mysqli_query($connect,$sql_user);
        $rowUS1 = mysqli_fetch_assoc($resUS1);
        $vorname = $rowUS1['username'];
}

    var_dump($id);
    die();
    // $id2 = $_SESSION["admin"];
    // if($id){
        
    // }
    // var_dump($vorname);
    // die();
    $user_id = $_COOKIE["userlog"]["userid"];
    $ldatec = $_COOKIE["userlog"]["logindate"];
    $logintime = date("H:i:s", strtotime($ldatec)); 
    $logindate = date("d.m.Y", strtotime($ldatec));
    $logout = $_COOKIE["userlog"]["logoutdate"];
    $logoutdate = date("d.m.Y", strtotime($logout));
    $logouttime = date("H:i:s", strtotime($logout));
    // $engine = $_COOKIE["userlog"]["userengine"];
    $your_ip = $_COOKIE["userlog"]["ip"];
    // $sname = $_COOKIE["userlog"]["sname"];

    date_default_timezone_set('EUROPE/Vienna');
    $localtime = date('H:i:s T', strtotime($logout));
    
    $sql_uploadtimeWK = "select * from wochenkarte order by wochen_date DESC limit 1";
    $resUWK = mysqli_query($connect,$sql_uploadtimeWK);
    $rowUWK = mysqli_fetch_assoc($resUWK);
    $last_upldateWK = $rowUWK['wochen_date'];
    $last_uplUserWK = $rowUWK['wochen_user'];

    $last_upldateWKd = date("d.m.Y", strtotime($last_upldateWK));
    $last_upltimeWKt = date("H:i:s", strtotime($last_upldateWK));

    $sql_uploadtimeSK = "select * from speisekarte order by speise_date DESC limit 1";
    $resSK = mysqli_query($connect,$sql_uploadtimeSK);
    $rowSK = mysqli_fetch_assoc($resSK);
    $last_upldateSKo = $rowSK['speise_date'];
    $last_uplUserSK = $rowSK['speise_user'];

    $last_upldateSK = date("d.m.Y", strtotime($last_upldateSKo));
    $last_upltimeSK = date("H:i:s", strtotime($last_upldateSKo));

    //Events aus der Datenbank holen
    $sql_events = "select * from events order by create_date DESC limit 1";
    $resEV = mysqli_query($connect,$sql_events);
    $rowEV = mysqli_fetch_assoc($resEV);
    $event_creator = $rowEV["event_author"];
    $event_added = $rowEV["create_date"];

    $event_createdate = date("d.m.Y", strtotime($event_added));
    $event_createtime = date("H:i:s", strtotime($event_added));
  
      $sql_username = "select * from users where id = $user_id";
      $resUN = mysqli_query($connect,$sql_username);
      $rowUN = mysqli_fetch_assoc($resUN);
      $myname = $rowUN['username'];

    //Texte
    $sql_dashboardtext = "select * from hp_texte where fk_textart = 14";
    $resDBT = mysqli_query($connect,$sql_dashboardtext);
    $rowDBT = mysqli_fetch_assoc($resDBT);
    $dashboard_text = $rowDBT['hp_meldung'];

    $sql_adminabtext = "select * from hp_texte where fk_textart = 15";
    $resDAT = mysqli_query($connect,$sql_adminabtext);
    $rowDAT = mysqli_fetch_assoc($resDAT);
    $dashboard_admintext = $rowDAT['hp_meldung'];

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../components/css/beisl_general.css">
    <link rel="stylesheet" href="../components/css/beisl_admin.css">
    <link rel="stylesheet" href="../components/css/beisl_fonts.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <title>PSV-Beisl</title>
</head>
<body class="body_admin">
    <nav class="navbar navbar-expand-lg opacity_dark50 navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand active" href="index.php">
                <img src = "../components/media/Logos/psvbeisl.png" height="40px" alt ="menu">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" href="upload_menu.php">Speisekarten</a>
                </li>
                <li class="nav-item" <?php if ($session_admin) {echo 'style="display:none;"';}?>>
                    <a class="nav-link" href="event_list.php">Events</a>
                </li>
                <li class="nav-item" <?php if ($session_admin) {echo 'style="display:none;"';}?>>
                    <a class="nav-link" href="texte_liste.php">Texte</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Eingeloggt als: <?php echo $vorname; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="https://www.psvbeisl.at">Zur Webseite</a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item active" href="dashboard.php">Zum Admin-Dashboard</a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php?logout">Logout</a></li>
                </ul>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <div class="dashboard_box">
        <div class="d_left"></div>
        <div class="d_main_box opacity_dark50 box_shadow_black">
            <div class="titel_dashboard">
                <h1>Admin-Dashboard PSV-Beisl</h1>
                <a class="dashboard_undertext">Du warst am  <?php echo $logoutdate; ?> um <?php echo $logouttime; ?>  zuletzt hier angemeldet (<?php echo $your_ip; ?>)</a>
                <br>
            </div>
            <div class="text_dashboard">
                <p class="dashboard_introtext">
                    Hallo <?php echo $vorname; ?>, <?php echo $dashboard_text; ?> 
                    <br>
                    <p class="text-start">Die aktuelle PSVBeisl-Wochenkarte wurde zuletzt am <?php echo $last_upldateWKd; ?> um <?php echo $last_upltimeWKt; ?> durch <?php echo $last_uplUserWK; ?> aktualisiert.
                    <br>
                    Die aktuelle PSVBeisl-Speisekarte wurde zuletzt am <?php echo $last_upldateSK; ?> um <?php echo $last_upltimeSK; ?> durch <?php echo $last_uplUserSK; ?> aktualisiert.
                    <br>
                    Der Event-Bereich wurde zuletzt am <?php echo $event_createdate; ?> um <?php echo $event_createtime; ?> von <?php echo $event_creator; ?> bearbeitet.
                    </p>
                </p>
                <br>
                <p class="text_admin_team">
                    <?php echo $dashboard_admintext; ?>
                </p>
            </div>
        </div>
        <div class="d_right"></div>
    </div>
    
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>