<?php 
    require "../components/database/db_connect_Beisl.php";


    session_start();

    if(!isset($_SESSION["superadmin"])&&!isset($_SESSION["admin"])){
        header("Location: ../index.php");
        exit;
    }

    $sql_textliste = "select * from hp_texte order by create_date DESC";
    $resTL = mysqli_query($connect,$sql_textliste);

    if(mysqli_num_rows($resTL)  > 0) {
        while($rowTL = mysqli_fetch_array($resTL, MYSQLI_ASSOC)){
            $tid = $rowTL['id'];
            $fk_textart = $rowTL['fk_textart'];
            $text = $rowTL['hp_meldung'];
            $create = $rowTL['create_date'];
        
            $create_date = date("d.m.Y", strtotime($create));
            $create_time = date("H:i:s", strtotime($create));
            // $create_date = date("d.m.Y", strtotime($create)); 

            $sql_textart = "select * from text_art where art_id = $fk_textart";
            $resTA = mysqli_query($connect,$sql_textart);
            $rowTA = mysqli_fetch_assoc($resTA);
            $textart = $rowTA["textart"];


            $tbody .= "
            <tr>
                <td class='table_text'>" .$textart."</td>
                <td class='table_text'>" .$text."</td>
                <td>
                    <div class='btn-group' role='group' aria-label='Basic mixed styles example'>
                        <a type='button' class='btn btn-sm btn-warning button_shadow' href='update_kunde.php?id=$uid'>Update</a>
                        <a type='button' class='btn btn-sm btn-danger button_shadow text-white' href='delete.php?id=$uid".$id.'&deletekunde'."'>Löschen</a>
                    </div>
                </td>
            </tr>
            ";
        }
    }else {
            $tbody =  "<tr><td colspan='9' class='noitem'><center>Derzeit keine Events im PSVBeisl geplant. </center></td></tr>";
    }

    $sql_dashboardtext = "select * from hp_texte where fk_textart = 17";
    $resDT = mysqli_query($connect,$sql_dashboardtext);
    $rowDT = mysqli_fetch_assoc($resDT);
    $dashboard_text = $rowDT["hp_meldung"];

    //Wer ist eingeloggt?
    if($_SESSION["superadmin"]){
        $id = $_SESSION["superadmin"];
    }else if ($_SESSION["admin"]){
        $id = $_SESSION["admin"];
    }
        // $id2 = $_SESSION["admin"];
    
        $sql_user = "select * from users where id = $id";
        $resUS1 = mysqli_query($connect,$sql_user);
        $rowUS1 = mysqli_fetch_assoc($resUS1);
        $vorname = $rowUS1['username'];
    
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
                    <a class="nav-link" href="create_event.php">Events</a>
                </li>
                <li class="nav-item" <?php if ($session_admin) {echo 'style="display:none;"';}?>>
                    <a class="nav-link active" href="texte_liste.php">Texte</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="https://www.psvbeisl.at" target="_blank">zur Website...</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Eingeloggt als: <?php echo $vorname; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <!-- <li><hr class="dropdown-divider"></li> -->
                    <li><a class="dropdown-item" href="logout.php?logout">Logout</a></li>
                </ul>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <section id="texte_list">
        <div id="infobox_texte">
            <!-- <div class="left">

            </div> -->
            <div class="main_box opacity_dark50">
                <h1 class="beisl_standardtitel"> Texte auf psvbeisl.at</h1>
                <p class="beisl_standardtext">
                    <?php echo $dashboard_text; ?>
                </p>
                <table class="table table-dark table-striped">
                   <tr>
                        <th class="table_title">
                            Titel
                        </th>
                        <th class="table_title">
                            Text
                        </th>
                        <th class="table_title">
                            Optionen
                        </th>
                    </tr>
                    <?php echo $tbody; ?>
                </table>
                <div class="addTextButton">
                    <a href="create_text.php" class="btn btn-primary w-100">Text hinzufügen</a>
                </div>
            </div>
        <div class="right"></div>
        </div>
    </section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>