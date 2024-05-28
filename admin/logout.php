<?php 
    session_start();

    if(!isset($_SESSION["user"]) && !isset($_SESSION["admin"])&& !isset($_SESSION["superadmin"])){
        header("Location: index.php");
        exit;
    }


    if(isset($_GET["logout"])){
        unset ($_SESSION["user"]);
        unset ($_SESSION["admin"]);
        unset ($_SESSION["superadmin"]);

        $cookie_name = "Logout";
        $cookie_value = date("d.m.Y, H:i:s");
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie("userlog[logoutdate]",$cookie_value);

        session_unset();
        session_destroy();
        header("Location: index.php");
        exit;

    }
?>