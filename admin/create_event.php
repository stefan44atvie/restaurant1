<?php 

    require "../components/database/db_connect_Beisl.php";
    require "../components/fileupload.php";

    session_start();

    if(!isset($_SESSION["superadmin"])&&!isset($_SESSION["admin"])){
        header("Location: index.php");
        exit;
    }

    $session_admin = $_SESSION['admin'];
    $session_superadmin = $_SESSION['superadmin'];

    $date = date("d.m.Y H:i:s");
    setcookie("username","Max"); 
    setcookie("logdate",$date); 
    setcookie('cookiename', 'data', time()+60*60*24*365, '/', $domain, false);


    //CREATE
    if(isset($_POST["createevent"])){
        $eventname = $_POST["name_event"];
        $eventdate = $_POST["event_date"];
        $eventtime = $_POST["eventtime"];
        $event_details = $_POST["event_details"];

        $user_id = $_COOKIE["userlog"]["userid"];
        $sql_username = "select * from users where id = $user_id";
        $resUN = mysqli_query($connect,$sql_username);
        $rowUN = mysqli_fetch_assoc($resUN);
        $myname = $rowUN['username'];
        // $picture = $_POST["phone"];
      
        $picture = picture_upload($_FILES["picture"]);

        $new_date = date("Y-m-d H:i:s");
        setcookie("updateEvents[user]", $myname,time() + (86400 * 30), "/");
        setcookie("updateEvents[addEvent]", $new_date,time() + (86400 * 30), "/");

       
        $error = false;
      
       try {
        if(!$error){
            $sql_write = "INSERT INTO `psvb_events`(`event_title`,`event_date`,`event_start`, `event_description`, `event_picture`, `event_author`) VALUES ('$eventname','$eventdate','$eventtime','$event_details','$picture->fileName','$myname')";
            $res_write = mysqli_query($connect, $sql_write);
            // $res_write1 = mysqli_query($connect, $sql_write1);

            if($res_write){
            
              $errType = "success";
              $errMsg = "Kunde erfolgreich angelegt!!";
              $text = "";
              header("Location: dashboard.php");

            }else{
              $errType = "danger";
              $errMsg = "something went wrong, try again later!!";
            } 
        }
       } catch (Exception $e){
       {
        echo $e;
        $errType = "danger";
        $errMsg = "Dieser Eintrag ist leider schon vorhanden!";
       }
    }
    }

    if($_SESSION["superadmin"]){
        $id = $_SESSION["superadmin"];
    }else if ($_SESSION["admin"]){
        $id = $_SESSION["admin"];
    }
        // $id2 = $_SESSION["admin"];
    
        $sql_user = "select * from psvb_users where id = $id";
        $resUS1 = mysqli_query($connect,$sql_user);
        $rowUS1 = mysqli_fetch_assoc($resUS1);
        $vorname = $rowUS1['username'];

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
    <link rel="stylesheet" href="../components/css/beisl_general.css">
    <link rel="stylesheet" href="../components/css/beisl_admin.css">
    <link rel="stylesheet" href="../components/css/beisl_fonts.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <title><?php echo $restaurant_name; ?></title>
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
                    <a class="nav-link active" href="event_list.php">Events</a>
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
                            <a class="dropdown-item" href="dashboard.php">Zum Admin-Dashboard</a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php?logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <div class="createevent_box">
       <div class="d_left">#</div>
       <div class="d_main_box opacity_dark50 box_shadow">
            <form class="w-100 pb-2" method="POST" action="<?= htmlspecialchars($_SERVER['SCRIPT_NAME'])?>" enctype="multipart/form-data">
                <div class="createevent_gridbox">
                    <div class="title">
                        <h1 class="titel_dashboard">Eventerstellung</h1>
                    </div>
                    <div class="dashboard_text">
                        <p class="text_dashboard">
                           Möchtest du Events im PSV-Beisl auf der Website bewerben? Trage das zukünftige Event hier nun ein.
                        </p>
                    </div>
                    <div class="eventname">
                        <label for="floatingInputGrid" class="bg-success input_title">Eventtitel</label>
                        <input type="text" placeholder="Bitte Titel einfügen" class="form-control" name= "name_event">
                    </div>
                    <div class="eventdate">
                        <label for="floatingInputGrid" class="bg-success input_title">Datum</label>
                        <input type="date" class="form-control" name="event_date" value="Wochenkarte aktualisieren">
                    </div>
                    <div class="eventtime">
                        <label for="floatingInputGrid" class="bg-success input_title">Uhrzeit</label>
                        <input type="time" placeholder="Bitte Speisekarte einfügen" class="form-control " name= "eventtime">
                    </div>
                    <div class="eventpic">
                        <input type="file" placeholder="Bitte Foto einfügen" class="form-control " name= "picture">
                    </div>
                    <div class="eventdetails">
                        <label for="floatingInputGrid" class="bg-success input_title">Eventdetails</label>
                        <textarea id="eventdetails_area" class="w-100" name="event_details" rows="4">
                        </textarea> 
                    </div>
                    <div class="uploadButton_speisekarte">
                        <input type="submit" class="form-control btn btn-primary w-100" name="createevent" value="Event erstellen">
                    </div>
                </div>
            </form>
       </div>
       <div class="d_right"></div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>