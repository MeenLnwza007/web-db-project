<?php 
    session_start();
    ob_start();
    require("backend/dbconnect.php");
    
    if(isset($_POST['ing_id'])){ 
        $ing_id = $_POST['ing_id'];
        $qty = $_POST['qty'];
    }

    $sql = "UPDATE ingredients SET ing_quantity = ing_quantity + $qty WHERE ing_id = $ing_id";
    $result = mysqli_query($connection,$sql);
    if($result){
        echo "Success";
    }
    else{
        echo "fail";
    }
    

    if($_SESSION['lang'] == "en"){
        header("location:ingredient.php?lang=en");
    }
    else{
        header("location:ingredient.php?lang=th");
    }
    ob_end_flush();

?>