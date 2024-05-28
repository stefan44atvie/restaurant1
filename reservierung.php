<?php 

require "components/database/db_connect_Beisl.php";

    session_start(); 

    //Eingeloggt als ...
    if($_SESSION["superadmin"]){
        $id = $_SESSION["superadmin"];
        $session_superadmin = $_SESSION['superadmin'];
    }else if ($_SESSION["admin"]){
        $id = $_SESSION["admin"];
        $session_admin = $_SESSION['admin'];
       
    }

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
    <link rel="stylesheet" href="components/css/beisl_fonts.css">
    <link rel="stylesheet" href="components/css/beisl_reservierung.css">
    <link rel="stylesheet" href="components/css/beisl_admin.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <title><?php echo $restaurant_name; ?></title>
</head>
<body class="body_reserve   ">
    <section id="navi">
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
                        <li><a class="dropdown-item active" href="speisekarte.php">Speisekarte</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="wochenkarte.php">Wochenkarte</a></li>
                    </ul>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="events.php">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="reservierung.php">Reservierung</a>
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
    </section>
    <section id="reservierung">
        <div id="reserve_grid">
            <div id="reserve_box" class="opacity_dark50">
                <h1 class="beisl_standardtitel"> Reservieren</h1>
                <div class="reserveform">
                    <form method="POST" action="reserve_formular.php" class = "" enctype="multipart/form-data">
                        <div class="create_reserve">
                            <div class="cust_name">
                                <label for="floatingInputGrid" class="bg-success input_title">Name</label>
                                <input type="text" placeholder="Bitte Namen einfügen" class="form-control" name= "customer_name" required>
                            </div>
                            <div class="reserve_date">
                                <label for="floatingInputGrid" class="bg-success input_title">Datum</label>
                                <input type="date" placeholder="Bitte Namen einfügen" class="form-control" name= "reserve_date" required>
                            </div>
                            <div class="reserve_timehour">
                                <label for="floatingInputGrid" class="bg-success input_title">Stunde</label>
                                <input type="number" min="00" max="23" step="1" class="form-control" name= "hour" required>
                            </div>
                            <div class="reserve_timeminute">
                                <label for="floatingInputGrid" class="bg-success input_title">Minute</label>
                                <input type="number" min="00" max="45" step="15" class="form-control" name= "minute" required>
                            </div>
                            <div class="reserve_personen">
                                <label for="floatingInputGrid" class="bg-success input_title">Personen</label>
                                <input type="number" min="00" max="200" step="1" class="form-control" name= "personen" required>
                            </div>
                            <div class="reserve_rueckruf">
                                <label for="floatingInputGrid" class="bg-success input_title">Rückrufnummer</label>
                                <input type="text" class="form-control" name= "rueckrufnummer" required>
                            </div>
                            <div class="reserve_contactemail">
                                <label for="floatingInputGrid" class="bg-success input_title">email-Addresse</label>
                                <input type="email" class="form-control" name= "email" required>
                            </div>
                            <div class="reserve_comment">
                                <label for="floatingInputGrid" class="bg-success input_title">Anmerkungen</label>
                                <textarea id="textarea_comment" class="w-100" name="comment_details" rows="4">
                                </textarea> 
                            </div>
                            <div class="reserve_checkbox">
                                <input type="checkbox" name="agree" id="agree">
                                <label for="agree" class="input_title">Ich bin einverstanden Informationen über Themenabende (zB. Weinverkostungen, kulinarische Schwerpunkte) und Aktionen per E-Mail informiert zu werden.
                                </label>
                            </div>
                            <div class="reserve_checkbox_dsgvo">
                                <input type="checkbox" name="dsgvo" id="dsgvo" required>
                                <label for="dsgvo" class="input_title">Ja, ich bin damit einverstanden, dass meine Daten im Zuge dieser Anfrage übermittelt und verarbeitet werden.
                                </label>
                            </div>
                            <div class="reserve_submitbutton">
                                <input type="submit" class="form-control btn btn-primary mt-2 button_shadow w-100" name="addreserve" value="Reservierung abschicken">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>