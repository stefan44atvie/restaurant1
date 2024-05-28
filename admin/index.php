<?php 

    require_once "../components/database/db_connect_Beisl.php";

     session_start();

     if(isset($_SESSION["superadmin"])){
       header("Location: dashboard.php");
     }elseif(isset($_SESSION["user"])){
       header("Location: userhome.php");
     }elseif(isset($_SESSION["admin"])){
        header("Location: dashboard.php");
    }
    
    // $path2 = $_SERVER['HTTP_HOST'];
    // $pathX = '$path2/psvbeisl2024/admin/';

    $sql_test = "select * from psvb_hp_texte where id = 2";
    $resTE = mysqli_query($connect,$sql_test);
    $rowTE = mysqli_fetch_assoc($resTE);
    $stest = $rowTE['hp_meldung'];
    function cleanInput ($param){
        $clean = trim($param);
        $clean = strip_tags($clean);
        $clean = htmlspecialchars ($clean);
        return $clean;
    }

    $emailError = $email = $passError = "";
    if(isset($_POST["login"])){
        $error = false;
        
        $email = cleanInput($_POST["email"]);
        $password = cleanInput($_POST["password"]);
       
        if (empty($email)){
            $error = true;
            $emailError = "Bitte geben Sie Ihre email-Addresse ein";
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = true;
            $emailError = "Bitte geben Sie eine korrekte email-Adresse ein!";
        }

    if (empty($password)){
        $error = true;
        $passError = "Bitte geben Sie ein Password ein!";
    } 
    if(!$error){
        $password = hash("sha256", $password);

        $sql = "SELECT * from psvb_users where email = '$email' AND password = '$password'";
        $result = mysqli_query($connect, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        if($count == 1){
        if($row["status"] == "superadmin"){
            $_SESSION["superadmin"] = $row["id"];
            $id = $row["id"];
           
            // $cookie_name = "Login";
            $cookie_id = $id;
            $userengine = $_SERVER['HTTP_USER_AGENT'];
            $cookie_value = date("d.m.Y, H:i:s");
            $ip_addr = $_SERVER['REMOTE_ADDR'];
            $sname = $_SERVER['SERVER_NAME'];
            setcookie("userlog[userid]", $id, time()+ (60*60*24*30));
            setcookie("userlog[logindate]",$cookie_value);
            setcookie("userlog[userengine]",$userengine);
            setcookie("userlog[ip]",$ip_addr);
            setcookie("userlog[sname]",$sname);

            header("Location: dashboard.php");
            
        }else if($row["status"] == "admin"){
            $_SESSION["admin"] = $row["id"];
            $id = $row["id"];
            
            $cookie_id = $id;
            $cookie_value = date("d.m.Y, H:i:s");
            setcookie("userlog[userid]", $id);
            setcookie("userlog[logindate]",$cookie_value);
            
            header("Location: dashboard.php");

        }else{
            $_SESSION["user"] = $row["id"];
            $_SESSION["name"] = "USER";
            
            $cookie_id = $id;
            $cookie_value = date("d.m.Y, H:i:s");
            setcookie("userlog[userid]", $id);
            setcookie("userlog[logindate]",$cookie_value);
            
            header("Location: userhome.php");
        }

         //COOKIE Test
        //  $sql_user = "select * from users where id = $id";
        //  $resUS1 = mysqli_query($connect,$sql_user);
        //  $rowUS1 = mysqli_fetch_assoc($resUS1);
        //  $vorname = $rowUS1['username'];
        // $cookie_name = "user";
        // $cookie_name2 = "Uhrzeit";
        // $cookie_value = $vorname;
        // $cookie_date = date("d.m.Y, H:i:s");


        }

    }


    }

    $sql_restname = "select * from psvb_texte where text_id = 3";
    $resNAME = mysqli_query($connect,$sql_restname);
    $rowNAME = mysqli_fetch_assoc($resNAME);
    $restaurant_name = $rowNAME['text'];
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../components/css/beisl_general.css">
    <link rel="stylesheet" href="../components/css/beisl_admin.css">
    <link rel="stylesheet" href="../components/css/beisl_fonts.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title><?php echo $restaurant_name; ?> Admin-Dashboard</title>
</head>
<body class="body_admin">
  <section id="login">
    <div class="login_grid">
        <div class="leftb"></div>
        <div class="main_login">
            <div class="login_box box_shadow">
                <div>
                    <h1>Beisl-Login</h1>
                </div>
                <div class="login_body">
                    <p>
                        Bitte melden Sie sich mit Ihrer email und dem korrekten Passwort an:
                    </p>
                    <form class="w-100" method="post" action="<?php echo htmlspecialchars($_SERVER['SCRIPT _NAME']) ; ?>" autocomplete="off">
                    <div class="act_login_grid">
                        <div class="mail_box">
                            <input type="email" autocomplete="off" name="email" class="form-control" placeholder="Ihre email-Addresse" value="<?php echo $email;?>">
                        </div>
                        <div class="password_box">
                            <input type="password" autocomplete="off" name="password" class="form-control" placeholder="Ihr Passwort" value="<?php echo $password;?>">
                        </div>
                        <div class="button_box">
                            <button class="btn btn-block btn-primary w-100" type="submit" name="login">Login</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="rightb"></div>
    </div>
  </section>

  <noscript>Your browser don't support JavaScript!</noscript>
  <script src="./scripts.js"></script>
</body>
</html>