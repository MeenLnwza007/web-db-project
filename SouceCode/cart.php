<?php 
    session_start();
    require("backend/dbconnect.php");

    // if(isset($_POST["submit"])){
    //     $noodle = $_POST["noodle"];
    //     $soup = $_POST["soup"];
    //     $meat = $_POST["meat"]; 
    //     $spicy = $_POST["spicy"];
    //     $toppings = $_POST["toppings"];
    //     // var_dump($toppings);
    //     $topping = implode("," , $toppings);
    //     $act = $_POST["act"];
        
    //     include("createid.php");
    // }

    // // echo "<pre>";
    // // print_r($toppings);
    // // echo "</pre> <br>";

    // // echo "<pre>";
    // // print_r($topping);
    // // echo "</pre> <br>";      
    

    // // $id_string_get = $_GET['$id_string'];
    // // $action_get = $_GET['$action'];

    // // echo $id_string_get . "<br>";
    // // echo $action_get;

    // $sql = "SELECT * FROM ingredients WHERE ing_id in ('$id_sql')";
    // echo "<br>" . $sql . "<br>";
    // $query = mysqli_query($connection, $sql); // 1 เมนู มีวัตถุดิบไรบ้างที่ใช้

    // $priceperdish = 0;

    // while($row = mysqli_fetch_assoc($query)){ // loop for คำนวณราคาแต่ละจาน
    //     // echo "<br>" . $row["ing_id"] . "<br>";
    //     // echo $row["ing_name"] . "<br>";
    //     // echo $row["ing_quantity"] . "<br>";
    //     // echo $row["price"] . "<br> ";
    //     $priceperdish += $row["price"];
        
    // }
    // $item = [ //เก็บเมนูแต่ละการเก็บเข้าตะกร้า
    //     'id' => $id_send,
    //     'noodle' => $noodle,
    //     'soup' => $soup,
    //     'meat' => $meat,
    //     'spicy' => $spicy,
    //     'topping' => $topping,
    //     'priceperdish' => $priceperdish,
    //     'quantity' => 1
    // ];
?>

<?php 
    $order = 1;
    //สำหรับตะกร้า
    //add to cart
    // if($act=='add' && !empty($id_send))
	// {
	// 	if(isset($_SESSION['cart'][$id_send]))
	// 	{
	// 		$_SESSION['cart'][$id_send]['quantity'] ++; //หากเจอสินค้านี้ ให้เพิ่มจำนวนสินค้า
	// 	}
	// 	else
	// 	{
    //         $_SESSION['cart'][$id_send] = $item;
	// 		// $_SESSION['cart'][]['quantity'] = 1; //หากยังไม่มี ให้เริ่มที่ 1
	// 	}
	// }

    // if(isset($_GET['act'])){ //remove
    //     $id_send_get = $_GET['id_send'];
    //     $act_get = $_GET['act'];
    // }

    // // remove from cart
	// if($act_get=='remove' && !empty($id_send_get))  //ยกเลิกการสั่งซื้อ
	// {
    //     echo "Remove Success !@!";
	// 	unset($_SESSION['cart'][$id_send_get]);
    //     header("location:cart.php");
	// }

    // // //update cart
	// if($act_get =='update') //แก้ไข
	// {
	// 	$amount_array = $_POST['amount'];
	// 	foreach($amount_array as $id_string_get=>$amount) // amount จำนวนจานที่่สั่ง มีหลายหลายการ เลยต้องวนลูป
	// 	{
	// 		$_SESSION['cart'][$id_string_get]['quantity'] = $amount;
	// 	}
	// }
?>

<?php 
    //เปลี่ยนภาษา
    if(isset($_GET['lang'])){
        $_SESSION['lang'] = $_GET['lang'];
        if($_SESSION['lang'] == "en"){
            $title = "Order &nbsp; Cart";

            $noOrder = "No Order Now";
            $cancel = "Cancel";
            $checkout = "Check out";
            $totalprice = "Total &nbsp; Price";
            $priceperdish = "Price";
        }
        else if($_SESSION['lang'] == "th"){
            $title = "ตะกร้าสินค้า";

            $noOrder = "ยังไม่มีการสั่งอาหาร";
            $cancel = "ยกเลิกสินค้า";
            $checkout = "ยืนยันสินค้า";
            $totalprice = "ราคารวม";
            $priceperdish = "ราคา";
        }
    }
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Ramen Restaurant</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->

    <style>
        /* a{
            text-decoration: none;
        }
        body{
            background-color: #ececec;
        } */
    </style>

</head>

<body onload="startTime()">
    
    <!-- header -->
    <div class="header-container">
        <div class="logo">
            <a href="index.php">
                <img src="Images/iconRamen.png" alt="">
            </a>
        </div>
        <div class="title">
            <h3><?php echo $title ;?></h3>
        </div>
        <div class="language">
            <div class="lang-thai">
                <a href="?lang=th"><img src="Images/Thaiflag.jpg" alt=""></a>
            </div>
            <div class="lang-eng">
                <a href="?lang=en"><img src="Images/Engflag.png" alt=""></a>
            </div>
        </div>
        <div class="time">
            <div id='txt'></div>
        </div>
    </div>

    <div class="container-2">
        <!-- body -->
        <div class="content-container">
            <center>
                <!-- 1 รายการ -->
                <!-- <form id="frmcart" name="frmcart" method="post" action="updateprice.php?act=update"> -->
        <!-- //variable
        <?php $total=0; ?>

        <?php if(!empty($_SESSION['cart'])): ?> <-- //เช็คว่า มีตะกร้าไหม $_SESSION['cart'] => มี = ต้องมีสินค้า -->
    <!--{ -->
            <?php foreach($_SESSION['cart'] as $id_send=>$eachitem): ?>  <!-- วนข้อมูลในตะกร้า -->
        <!--{ -->
                <?php 
                    $count_ing_use = count($eachitem['id_arr']);
                    // echo "key $id_send : priceperdish = $eachitem[priceperdish] : quantity = $eachitem[quantity] : ing amount use = $count_ing_use<br>";   
                    for( $i=0 ; $i< $count_ing_use ; $i++){
                        $ing = $eachitem['id_arr'][$i];
                        // echo "ing_id use : $ing  <br>"; 
                    }
                                        
                    $sum = $eachitem['priceperdish'] * $eachitem['quantity'];
                    $total += $sum;
                ?>

                <?php 
                    //เปลี่ยนภาษา
                    if(isset($_GET['lang'])){
                        $_SESSION['lang'] = $_GET['lang'];
                        if($_SESSION['lang'] == "en"){
                            
                            $noodle = "";
                            if($eachitem["noodle"] == "Ramen"){
                                $noodle = "Ramen";
                            }
                            elseif($eachitem["noodle"] == "Udon"){
                                $noodle = "Udon";
                            }
                            elseif($eachitem["noodle"] == "Soba"){
                                $noodle = "Soba";
                            }
                            elseif($eachitem["noodle"] == "Somen"){
                                $noodle = "Somen";
                            }
                            elseif($eachitem["noodle"] == "Shirataki"){
                                $noodle = "Shirataki";
                            }

                            $soup = "";
                            if($eachitem["soup"] == "Tonkotsu"){
                                $soup = "Tonkotsu";
                            }
                            elseif($eachitem["soup"] == "Miso"){
                                $soup = "Miso";
                            }
                            elseif($eachitem["soup"] == "Shoyu"){
                                $soup = "Shoyu";
                            } 

                            $meat = "";
                            if($eachitem["meat"] == "Chicken"){
                                $meat = "Chicken";
                            }
                            elseif($eachitem["meat"] == "Pork"){
                                $meat = "Pork";
                            }
                            elseif($eachitem["meat"] == "Beef"){
                                $meat = "Beef";
                            } 

                            $spicy = "";
                            if($eachitem["spicy"] == "Mild"){
                                $spicy = "Mild";
                            }
                            elseif($eachitem["spicy"] == "Spicy"){
                                $spicy = "Spicy";
                            }
                            elseif($eachitem["spicy"] == "Hot"){
                                $spicy = "Hot";
                            } 

                            $topping = $eachitem["topping"]; 

                        }
                        else if($_SESSION['lang'] == "th"){

                            $noodle = "";
                            if($eachitem["noodle"] == "Ramen"){
                                $noodle = "เส้นราเมง";
                            }
                            elseif($eachitem["noodle"] == "Udon"){
                                $noodle = "เส้นอูด้ง";
                            }
                            elseif($eachitem["noodle"] == "Soba"){
                                $noodle = "เส้นโซบะ";
                            }
                            elseif($eachitem["noodle"] == "Somen"){
                                $noodle = "เส้นโซเมง";
                            }
                            elseif($eachitem["noodle"] == "Shirataki"){
                                $noodle = "เส้นชิราตากิ";
                            }
    
                            $soup = "";
                            if($eachitem["soup"] == "Tonkotsu"){
                                $soup = "ทงคตสึ";
                            }
                            elseif($eachitem["soup"] == "Miso"){
                                $soup = "มิโซะ";
                            }
                            elseif($eachitem["soup"] == "Shoyu"){
                                $soup = "โชยุ";
                            } 
    
                            $meat = "";
                            if($eachitem["meat"] == "Chicken"){
                                $meat = "เนื้อไก่";
                            }
                            elseif($eachitem["meat"] == "Pork"){
                                $meat = "เนื้อหมู";
                            }
                            elseif($eachitem["meat"] == "Beef"){
                                $meat = "เนื้อวัว";
                            } 
    
                            $spicy = "";
                            if($eachitem["spicy"] == "Mild"){
                                $spicy = "เผ็ดน้อย";
                            }
                            elseif($eachitem["spicy"] == "Spicy"){
                                $spicy = "เผ็ดปกติ";
                            }
                            elseif($eachitem["spicy"] == "Hot"){
                                $spicy = "เผ็ดมาก";
                            } 
    
                            $topping = $eachitem["topping"]; // keep value of topping eng for change to thai
                            if(str_contains($topping,"Boiled egg") == true){
                                $topping = str_ireplace("Boiled egg","ไข่ต้ม",$topping);
                            }
                            if(str_contains($topping,"Shashu") == true){
                                $topping = str_ireplace("Shashu","หมูชาชู",$topping);
                            }
                            if(str_contains($topping,"Menma") == true){
                                $topping = str_ireplace("Menma","เมนมะ",$topping);
                            }
                            if(str_contains($topping,"Mushroom") == true){
                                $topping = str_ireplace("Mushroom","เห็ด",$topping);
                            }
                            if(str_contains($topping,"Narutomaki") == true){
                                $topping = str_ireplace("Narutomaki","ลูกชิ้นนารูโตะ",$topping);
                            }
                            if(str_contains($topping,"Cabbage") == true){
                                $topping = str_ireplace("Cabbage","กะหล่ำปลี",$topping);
                            }
                            if(str_contains($topping,"Wakame") == true){
                                $topping = str_ireplace("Wakame","สาหร่ายวากาเมะ",$topping);
                            }

                        }
                    }
                    
                ?>

            <div class="cart-container" >
                <div class="order-detail-container" >
                    <div class="order" >
                        <img src="Images/Ramen-full.png" alt="">
                    </div>
                    <div class="detail">
                        <b> <?php echo "#".$order++ . " - " . $noodle ." ". $soup ?></b><br>
                        <?php 
                            echo "( $noodle $soup $meat $spicy $topping )";
                        ?>
                        <!-- ( Ramen, Miso, Pork, Mild, Boiled egg, Menma, Wakame ) -->
                    </div>
                </div>
                <div class="under-detail" ;>
                    <div class="order-price" >
                        <?php echo $priceperdish ; ?> &nbsp;&nbsp;<?php echo number_format($eachitem['priceperdish'],2) ?> ฿
                    </div>
                    <!-- style="border: 2px solid aqua"; -->
                    <div class="add-del" ;>
                        <!-- + -->
                        <a href="plus.php?id_send=<?php echo $id_send ;?>&act=<?php echo "plus" ;?>">
                            <i class="uil uil-plus-circle"></i>
                        </a>
                        <!-- quantity -->
                        <span class="order-count" ><?php echo $eachitem['quantity']; ?></span>
                        <!-- - -->
                        <a href="decrease.php?id_send=<?php echo $id_send ;?>&act=<?php echo "decrease" ;?>"> 
                            <i class="uil uil-minus-circle"></i>
                        </a> 
                        &ensp; 
                        <!-- remove -->
                        <a href='removeitem.php?id_send=<?php echo $id_send ;?>&act=<?php echo "remove" ;?> '>
                            <i class="uil uil-trash-alt" id="trash"></i>
                        </a>
                    </div>
                </div>
            </div>
            
        <!-- } -->
            <?php endforeach; ?>
        <?php else: ?>
    <!-- else{ -->
            <div class='alert123'>
                <b><?php echo $noOrder; ?></b>
            </div>
    <!-- } -->
        <?php endif; ?>
        <!-- //keep totalprice in session -->
        <?php $_SESSION['totalprice'] = $total; ?>
        
        
    <!-- </form> -->
    <!-- <div style="border: 1px solid black; justify-content: space-between;"> -->
        
    <!-- </div> -->

            <!-- เพิ่ม รายการอาหาร -->
            <div class="con-ordering">
                <?php if($_SESSION['lang'] == "en"):?>
                    <a href="menu.php?lang=en"><i class="uil uil-plus-circle"></i></a>
                <?php else:?>
                    <a href="menu.php?lang=th"><i class="uil uil-plus-circle"></i></a>
                <?php endif;?>
            </div>
        </center>

            
        <?php
            // echo "<br>SESSION : <br><pre>";
            // print_r($_SESSION);
            // echo "</pre> <br>";
        ?>

            <div class="cart-total">
                <?php echo $totalprice ; ?> (฿) - <?php echo number_format($total,2); ?> <br>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div class="footer-container">
        <div class="return">
            <div class="footer-text">
                <a href="index.php">
                    <input type="reset" value="<?php echo $cancel; ?>" name="return" id="rtn-2">
                </a>
            </div>
        </div>
        <div class="checkout">
            <div class="footer-text">
            <?php if(empty($_SESSION['cart'])){ ?>
                <input type="submit" name="Submit2" value="<?php echo $checkout; ?>" disabled onclick="window.location='eatwhere.php';">    
            <?php }else{ ?>
                <?php if($_SESSION['lang'] == "en"):?>
                    <input type="submit" name="Submit2" value="<?php echo $checkout; ?>" onclick="window.location='eatwhere.php?lang=en';">
                <?php else:?>
                    <input type="submit" name="Submit2" value="<?php echo $checkout; ?>" onclick="window.location='eatwhere.php?lang=th';"> 
                <?php endif;?>    
            <?php } ?>
            </div>
        </div>
    </div>
    
    <script src="app.js"></script>
</body>
</html>