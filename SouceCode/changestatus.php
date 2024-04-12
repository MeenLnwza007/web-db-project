<?php 
    session_start();
    ob_start();
    require("backend/dbconnect.php");

    if(isset($_GET['order_id'])){ //remove
        $order_id = $_GET['order_id'];
    }

    $sql = "UPDATE orders SET serve_status = 'Served' WHERE order_id = $order_id";
    $result = mysqli_query($connection,$sql);
    if($result){
        echo "Success";
    }
    else{
        echo "fail";
    }


    if($_SESSION['lang'] == "en"){
        header("location:backstore.php?lang=en");
    }
    else{
        header("location:backstore.php?lang=th");
    }
    ob_end_flush();

?>