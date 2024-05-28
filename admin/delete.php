<?php 
    require "../components/database/db_connect_Beisl.php";

    $id = $_GET["id"];

    $sql_deletetext = "DELETE FROM `psvb_hp_texte` WHERE id = $id";


    if(isset($_GET["deletetext"])){
        if(mysqli_query($connect, $sql_deletetext)){
                header("Location: dashboard.php");
        }
    }

?>