<?php 
    session_start();
    ob_start();
    require("backend/dbconnect.php");

    if(isset($_GET['act'])){ //remove
        $id_send_get = $_GET['id_send'];
        $act_get = $_GET['act'];
    }

    // echo "<pre>";
    // echo print_r($_GET);
    // echo "</pre> <br>";

    // echo "<br> Session <br><pre>";
    // echo print_r($_SESSION);
    // echo "</pre>";

    // echo "Amount : " .$_SESSION['cart'][$id_send_get]['quantity'];
    // //update cart
	if($act_get =='plus' && !empty($id_send_get)) //แก้ไข
	{
        if($_SESSION['cart'][$id_send_get]['quantity'] >= 1){
            $_SESSION['cart'][$id_send_get]['quantity'] += 1;
        }
	}

    if($_SESSION['lang'] == "en"){
        header("location:cart.php?lang=en");
    }
    else{
        header("location:cart.php?lang=th");
    }
    
    ob_end_flush();

?>