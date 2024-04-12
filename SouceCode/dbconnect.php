<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "ramen_db";
    $port = 3308;

    // Don't show error
    mysqli_report(MYSQLI_REPORT_OFF);

    $connection = mysqli_connect($hostname,$username,$password,$database,$port);

    // if(!$connection){
    //     die("connection to db fail " . mysqli_connect_error());
    // }
    // else{
    //     echo "connection to db successful";
    // }


?>