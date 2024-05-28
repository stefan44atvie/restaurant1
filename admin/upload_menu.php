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

    // $date = date("d.m.Y H:i:s");
    // setcookie("username","Max"); 
    // setcookie("logdate",$date); 
    // setcookie('cookiename', 'data', time()+60*60*24*365, '/', $domain, false);

     //UPLOAD Wochenkarte
     if(isset($_POST["uploadWeeklyButton"])){

        $test = 43;
       
        $wochenkarte = wochenkarte_upload($_FILES["weeklymenu"]);
        
        $error = false;

        if(!$error){
            // no error, so insert in database
            $uploaddate = date("d.m.Y H:i:s");
           
            // $sql = "INSERT INTO speisekarte(`speisekarte`) VALUES ('$speisekarte->fileName')";

            $user_id = $_COOKIE["userlog"]["userid"];
            $sql_username = "select * from psvb_users where id = $user_id";
            $resUN = mysqli_query($connect,$sql_username);
            $rowUN = mysqli_fetch_assoc($resUN);
            $myname = $rowUN['username'];
            $upload_date = date("d.m.Y H:i:s");

            $sql_write = "INSERT INTO `psvb_wochenkarte`(`wochenkarte`,`wochen_user`) 
            VALUES ('$wochenkarte->fileName','$myname')";
            $res = mysqli_query($connect, $sql_write);

            // setcookie("uploadWochenkarte[user]", $myname,time() + (86400 * 30), "/");
            // setcookie("uploadWochenkarte[uploaddate]", $upload_date,time() + (86400 * 30), "/");

            // setcookie("uploadWeekly[user]", $myname);
            // setcookie("uploadWeekly[uploaddate]", $upload_date);
            
            if($res){
                $errType = "success";
                $errMSG = "Der User wurde erfolgreich registriert";
                header("Location: dashboard.php");
            }else{
                $errType = "danger";
                $errMSG = "User konnte nicht registriert werden.";
            }
        }

    }

    //UPLOAD Speisekarte
    if(isset($_POST["uploadStandardButton"])){

        $speisekarte = speise_upload($_FILES["standardmenu"]);

        $error = false;

        if(!$error){
            // no error, so insert in database
            $uploaddate = date("d.m.Y, H:i:s");
            // var_dump($uploaddate);
            // die();

            $user_id = $_COOKIE["userlog"]["userid"];
            $sql_username = "select * from psvb_users where id = $user_id";
            $resUN = mysqli_query($connect,$sql_username);
            $rowUN = mysqli_fetch_assoc($resUN);
            $myname = $rowUN['username'];
            $upload_date = date("d.m.Y H:i:s");

            
            $sql_write = "INSERT INTO `psvb_speisekarte`(`speisekarte`,`speise_user`) 
            VALUES ('$speisekarte->fileName','$myname')";
            $res = mysqli_query($connect, $sql_write);
            // $sql = "INSERT INTO speisekarte(`speisekarte`) VALUES ('$speisekarte->fileName')";

            

            // setcookie("uploadStandardKarte[user]", $myname);
            // // setcookie("uploadStandard[user]", $myname);
            // setcookie("uploadStandardKarte[uploaddate]", $upload_date);

            setcookie("uploadStandardkarte[user]", $myname,time() + (86400 * 30), "/");
            setcookie("uploadStandardkarte[uploaddate]", $upload_date,time() + (86400 * 30), "/");

            // setcookie("uploadSpeisekarte", $upload_date);
            
            if($res){
                $errType = "success";
                $errMSG = "Der User wurde erfolgreich registriert";
                header("Location: dashboard.php");
            }else{
                $errType = "danger";
                $errMSG = "User konnte nicht registriert werden.";
            }
        }

    }

   
    //Wer ist eingeloggt?
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
                <a class="nav-link active" href="upload_menu.php">Speisekarten</a>
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


    <div class="dashboard_box">
       <div class="d_left">#</div>
       <div class="d_main_box opacity_dark50 box_shadow">
            <form class="w-100 pb-2" method="POST" action="<?= htmlspecialchars($_SERVER['SCRIPT_NAME'])?>" enctype="multipart/form-data">
                <div class="upload_gridbox">
                    <div class="titledash">
                        <h1 class="titel_dashboard">Menükarten aktualisieren</h1>
                    </div>
                    <div class="dashboard_text">
                        <p class="text_dashboard">
                            Um Speisekarten, bzw. Wochenkarten zu aktualisieren, lade Sie bitte hier hoch.
                        </p>
                    </div>
                    <div class="uploadweekly">
                        <h3>Wochenkarte</h3>
                        <input type="file" placeholder="Bitte Wochenkarte einfügen" class="form-control" name= "weeklymenu">
                    </div>
                    <div class="uploadButton_wochenkarte">
                        <input type="submit" class="form-control btn btn-primary w-100" name="uploadWeeklyButton" value="Wochenkarte aktualisieren">
                    </div>
                    <div class="uploadStandard">
                        <h3>Speisekarte</h3>
                        <input type="file" placeholder="Bitte Speisekarte einfügen" class="form-control " name= "standardmenu">
                    </div>
                    <div class="uploadButton_speisekarte">
                        <input type="submit" class="form-control btn btn-primary w-100" name="uploadStandardButton" value="Speisekarte aktualisieren">
                    </div>
                </div>
            </form>
       </div>
       <div class="d_right"></div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>