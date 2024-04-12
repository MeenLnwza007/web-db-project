<?php
    require("backend/dbconnect.php");

    $order_id = $_GET["order_id"];

    $sql = "DELETE FROM orders WHERE order_id = $order_id";

    $result = mysqli_query($connection,$sql);
    
    if($result){
        header("location:cart_en.php");
        exit(0);
    }
    else{
        mysqli_error($connection);
    }
?>