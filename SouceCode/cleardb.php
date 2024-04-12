<?php 
    require("backend/dbconnect.php");

    $sql = "DELETE FROM `order_ingredient`";
    mysqli_query($connection,$sql);

    $sql = "DELETE FROM `orders`";
    mysqli_query($connection,$sql);

    $sql = "DELETE FROM `customers`";
    mysqli_query($connection,$sql);

    $sql = "DELETE FROM `payments`";
    mysqli_query($connection,$sql);

    $sql = "DELETE FROM `order_ingre_used`";
    mysqli_query($connection,$sql);

    $sql = "UPDATE ingredients SET ing_quantity = 100";
    mysqli_query($connection,$sql);

    mysqli_close($connection);
?>