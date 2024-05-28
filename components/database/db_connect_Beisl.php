<?php

    $hostname="localhost";
    $username="root";
    $password="";
    $databasename="portfolio_projects";

    $connect = mysqli_connect($hostname,$username,$password,$databasename);

    if(!$connect){
        die("connection failed".mysqli_connect_error());
    }
?>