<?php 
    session_start();
    require("backend/dbconnect.php");

    if(isset($_GET['act'])){ //remove
        $id_send_get = $_GET['id_send'];
        $act_get = $_GET['act'];
    }

    // remove from cart
	if($act_get=='remove' && !empty($id_send_get))  //ยกเลิกการสั่งซื้อ
	{
        echo "Remove Success !@!";
		unset($_SESSION['cart'][$id_send_get]);
        header("location:cart.php");
	}

    if($_SESSION['lang'] == "en"){
        header("location:cart.php?lang=en");
    }
    else{
        header("location:cart.php?lang=th");
    }
?>