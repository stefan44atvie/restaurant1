<?php 
    require "components/database/db_connect_Beisl.php";

    session_start(); 

    $sql_contact = "select * from psvb_contact";
    $resCO = mysqli_query($connect,$sql_contact);
    $rowCO = mysqli_fetch_assoc($resCO);

    $phone = $rowCO['telephone'];
    $address = $rowCO['adresse'];
    $email = $rowCO['email'];
    //Öffnungszeiten - Test

    $sql_openhours = "select * from psvb_hp_texte where fk_textart=2";
    $resOH = mysqli_query($connect,$sql_openhours);
    $rowOH = mysqli_fetch_assoc($resOH);
    $openhours = $rowOH['hp_meldung'];

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
    <link rel="stylesheet" href="components/css/beisl_fonts.css">
    <link rel="stylesheet" href="components/css/beisl_contactbox.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <title><?php echo $restaurant_name; ?></title>
</head>
<body class="body_contact">
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
                    <a class="nav-link active" href="openhours.php">Kontakt/Öffnungszeiten</a>
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

    <section id="contact">
    <div class="contact_fenster">
        <div class="contact_box">
            <div id="contact_grid">
                <div class="contact_addresse">
                    <a class="btn contact_titel" onclick="contact_onklick('address_inhalt')">Addresse</a>
                </div>
                <div class="contact_anfahrt">
                    <a class="btn contact_titel" onclick="contact_onklick('anfahrt_inhalt')">Anfahrt</a>
                </div>
                <div class="contact_openhours" onclick="contact_onklick('openhours_inhalt')">
                    <a class="btn contact_titel" onclick="contact_onklick('openhours_inhalt')">Öffnungszeiten</a>
                </div>
                <!-- <div class="contact_contact" onclick="contact_onklick('contact_inhalt')">
                    <a class="btn contact_titel" onclick="contact_onklick('contact_inhalt')">Kontakt</a>
                </div> -->
                <div class="contact_inhalt">
                    <div class="contact_address_inhalt" id="address_inhalt">
                        <p class="gen_text_contact"><?php echo $addresse_titel; ?>
                        <br>
                        <?php echo $address; ?>
                        <br>
                        <span class="gen_text_bold">email:</span> <?php echo $email; ?>
                        <br>
                        <span class="gen_text_bold">Telefon:</span> <?php echo $phone; ?>
                        </p>
                    </div>
                    <div class="contact_anfahrt_inhalt" id="anfahrt_inhalt">
                        <a class="general_text_bold"><?php echo $anfahrt_titel; ?> </a>
                        <br>
                        <p class="general_text">
                            <?php echo $anfahrt_text; ?>
                        </p>
                        <div class="google_maps">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2658.8900670106937!2d16.37110157663566!3d48.208733371251476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476d079f3e69c281%3A0x20563c156aa1fde!2sStephansplatz%2C%201010%20Wien!5e0!3m2!1sde!2sat!4v1716888145870!5m2!1sde!2sat" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        
                    </div>
                    <div class="contact_openhours_inhalt" id="openhours_inhalt">
                        <a class="gen_text_contact"><?php echo $openhours; ?></a>
                        <br>
                        <a class="gen_text_contact"><?php echo $opening_text; ?></a>
                    </div>
                    <!-- <div class="contact_contact_inhalt" id="contact_inhalt">
                        <a class="general_text_bold"><?php echo $contacts_title; ?></a>
                        <br>
                        <a class="general_text">Telefon: <?php echo $phone; ?></a>
                        <br>
                        <a class="general_text">email: <?php echo $email; ?></a>
                    </div> -->
                </div>
            </div>
            
        </div>
    </div>

</section>
    
<script src="components/scripts/contact_klick.js"></script>
<script src="components/scripts/klickme.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>