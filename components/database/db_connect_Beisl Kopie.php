<?php

    $hostname="localhost";
    $username="d04083ec";
    $password="NY6xJXzopPMR7FRpKCNp";
    $databasename="d04083ec";

    $connect = mysqli_connect($hostname,$username,$password,$databasename);

    if(!$connect){
        die("connection failed".mysqli_connect_error());
    }
?>