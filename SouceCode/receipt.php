<?php 
    session_start();
    require('backend/dbconnect.php');

    $ordernumber =1;

    // echo "<br> Session <br><pre>";
    // echo print_r($_SESSION);
    // echo "</pre>";

    if(isset($_GET['act'])){
        $act = $_GET['act'];
        $_SESSION['fordb'] = $_GET['act'];
        $eatwhere = $_SESSION['eatwhere'];
        
        //insert ใส่ตาราง payments ว่าจ่ายแล้ว
        $sql_payment = "INSERT INTO `payments`(`payment_method`, `total_price`, `paid_status`) VALUES ('$_SESSION[payment_method]','$_SESSION[totalprice]','Success Paid')";
        $result_payment = mysqli_query($connection,$sql_payment);
        // if($result_payment){
        //     echo "Insert payment Success <br>";
        // }
        // else{
        //     echo "Fail <br>";
        // }

        //fetch payment มา ใช้
        $query = "SELECT * FROM payments ORDER BY payment_id DESC LIMIT 1";
        $fetch_payment = mysqli_query($connection,$query);
        $payment = mysqli_fetch_assoc($fetch_payment);
        // echo "<br> Payment : $payment[payment_id] | $payment[payment_method] | $payment[total_price] | $payment[paid_status]<br>" ;



        //insert queue in database
        $sql_customer = "INSERT INTO `customers`(`eatwhere`) VALUES ('$eatwhere')";
        // echo "$sql_customer <br>";
        $result_customer = mysqli_query($connection,$sql_customer);
        // if($result_customer){
        //     echo "Insert customer Success <br>";
        // }
        // else{
        //     echo "Fail <br>";
        // }
        

        // สำหรับ นำมา เก็บ ค่า คิวลูกค้า
        $query = "SELECT * FROM customers ORDER BY queue DESC LIMIT 1";
        $fetch_customer = mysqli_query($connection,$query);
        $customer = mysqli_fetch_assoc($fetch_customer);
        // echo " <br> Customer : $customer[queue] | $customer[order_date] | $customer[eatwhere] <br>" ;


        //insert รายการอาหาร ใส่ ตาราง orders ว่าลูกค้าสั่งไรบ้าง
        foreach($_SESSION['cart'] as $id_send=>$eachitem){ //วนข้อมูลในตะกร้า
            $sql_orders = "INSERT INTO `orders`(`quantity`, `priceperdish`, `queue`, `payment_id`) 
                            VALUES ('$eachitem[quantity]','$eachitem[priceperdish]','$customer[queue]','$payment[payment_id]')";
            mysqli_query($connection,$sql_orders);
        }
        

        //สำหรับ นำค่า order_id ตาราง orders มาใช้ต่อที่ order_ingredient
        $sql_fetch_orders = "SELECT * FROM orders WHERE queue = $customer[queue] ORDER BY order_id ASC";
        $fetch_orders = mysqli_query($connection,$sql_fetch_orders);

        
        foreach ($_SESSION['cart'] as $id_send=>$eachitem) { //วนลูปตามจำนวนอาหารที่สั่ง
            $count_ing_use = count($eachitem['id_arr']); //นับจำนวน วัตถุดิบที่ใช้
            $order = mysqli_fetch_assoc($fetch_orders); // เอา order_id จานที่ 1 , 2 , 3
            // echo "key $id_send : priceperdish = $eachitem[priceperdish] : quantity = $eachitem[quantity] : ing amount use = $count_ing_use<br>";   
            for( $i=0 ; $i< $count_ing_use ; $i++){
                $ing_used = $eachitem['id_arr'][$i];
                $quantity_used = $eachitem['quantity'];

                // ดู จำนวนสินค้า
                $sql = "SELECT * FROM ingredients WHERE ing_id = $ing_used";
                $result_ing = mysqli_query($connection, $sql);
                $fetch_ing = mysqli_fetch_assoc($result_ing);

                //ตัด stock
                if($fetch_ing['ing_quantity'] - $quantity_used >= 0){
                    $sql_stock = "UPDATE ingredients SET ing_quantity = $fetch_ing[ing_quantity] - $quantity_used 
                    WHERE ing_id = $ing_used";
                    mysqli_query($connection,$sql_stock);
                }

                //เพิ่มข้อมูลลงตาราง order_ingre_used
                $sql = "INSERT INTO `order_ingre_used`(`order_id`, `ing_id`) VALUES ('$order[order_id]','$ing_used')";
                mysqli_query($connection,$sql);
                
            }
        }
    }
    // echo "<br> ROW <br><pre>";
    // echo print_r($row);
    // echo "</pre>";
    if(isset($_SESSION['fordb'])){ // $_SESSION['fordb'] เอาไว้สำหรับ เมื่อเปลี่ยนภาษาหน้าเว็บ จะไม่ทำการ เพิ่มข้อมูลลง db

        // echo "<br> SESSION <br><pre>";
        // echo print_r($_SESSION);
        // echo "</pre>";

        //insert ใส่ตาราง payments ว่าจ่ายแล้ว
        // $sql_payment = "INSERT INTO `payments`(`payment_method`, `total_price`, `paid_status`) VALUES ('$_SESSION[payment_method]','$_SESSION[totalprice]','Success Paid')";
        // $result_payment = mysqli_query($connection,$sql_payment);
        // if($result_payment){
        //     echo "Insert payment Success <br>";
        // }
        // else{
        //     echo "Fail <br>";
        // }

        //fetch payment มา ใช้
        $query = "SELECT * FROM payments ORDER BY payment_id DESC LIMIT 1";
        $fetch_payment = mysqli_query($connection,$query);
        $payment = mysqli_fetch_assoc($fetch_payment);
        // echo "<br> Payment : $payment[payment_id] | $payment[payment_method] | $payment[total_price] | $payment[paid_status]<br>" ;



        //insert queue in database
        // $sql_customer = "INSERT INTO `customers`(`eatwhere`) VALUES ('$eatwhere')";
        // echo "$sql_customer <br>";
        // $result_customer = mysqli_query($connection,$sql_customer);
        // if($result_customer){
        //     echo "Insert customer Success <br>";
        // }
        // else{
        //     echo "Fail <br>";
        // }
        

        // สำหรับ นำมา เก็บ ค่า คิวลูกค้า
        $query = "SELECT * FROM customers ORDER BY queue DESC LIMIT 1";
        $fetch_customer = mysqli_query($connection,$query);
        $customer = mysqli_fetch_assoc($fetch_customer);
        // echo " <br> Customer : $customer[queue] | $customer[order_date] | $customer[eatwhere] <br>" ;


        //insert รายการอาหาร ใส่ ตาราง orders ว่าลูกค้าสั่งไรบ้าง
        // foreach($_SESSION['cart'] as $id_send=>$eachitem){ //วนข้อมูลในตะกร้า
        //     $sql_orders = "INSERT INTO `orders`(`noodle`, `soup`, `meat`, `spicy`, `topping`, `quantity`, `priceperdish`, `queue`, `payment_id`) 
        //         VALUES ('$eachitem[noodle]','$eachitem[soup]','$eachitem[meat]','$eachitem[spicy]','$eachitem[topping]',
        //                 '$eachitem[quantity]','$eachitem[priceperdish]','$customer[queue]','$payment[payment_id]')";
        //     mysqli_query($connection,$sql_orders);
        // }
        

        //สำหรับ นำค่า order_id ตาราง orders มาใช้ต่อที่ order_ingredient
        $sql_fetch_orders = "SELECT * FROM orders WHERE queue = $customer[queue] ORDER BY order_id ASC";
        $fetch_orders = mysqli_query($connection,$sql_fetch_orders);

        
        foreach ($_SESSION['cart'] as $id_send=>$eachitem) { //วนลูปตามจำนวนอาหารที่สั่ง
            $count_ing_use = count($eachitem['id_arr']); //นับจำนวน วัตถุดิบที่ใช้
            $order = mysqli_fetch_assoc($fetch_orders); // เอา order_id จานที่ 1 , 2 , 3
            // echo "key $id_send : priceperdish = $eachitem[priceperdish] : quantity = $eachitem[quantity] : ing amount use = $count_ing_use<br>";   
            for( $i=0 ; $i< $count_ing_use ; $i++){
                $ing_used = $eachitem['id_arr'][$i];
                $quantity_used = $eachitem['quantity'];

                // ดู จำนวนสินค้า
                $sql = "SELECT * FROM ingredients WHERE ing_id = $ing_used";
                $result_ing = mysqli_query($connection, $sql);
                $fetch_ing = mysqli_fetch_assoc($result_ing);

                //ตัด stock
                // if($fetch_ing['ing_quantity'] - $quantity_used >= 0){
                //     $sql_stock = "UPDATE ingredients SET ing_quantity = $fetch_ing[ing_quantity] - $quantity_used 
                //     WHERE ing_id = $ing_used";
                //     mysqli_query($connection,$sql_stock);
                // }
                
            }
        }
    }
?>

<?php 
    //แปลภาษา
    if(isset($_GET['lang'])){
        $_SESSION['lang'] = $_GET['lang'];
        if($_SESSION['lang'] == "en"){
            $title = "Order &nbsp; Receipt";

            $order_no = "Order No.";

            $ty = "Thank you for coming";
            $enjoy = "Enjoy your meal ♡";

            $datetime = "Date & Time";
            $eatwhere = "Type";
            $payment_method = "Payment Method";
            $totalprice = "Total &nbsp; Price";

            $eatwherereal = "";
            if($customer['eatwhere'] == "Take away"){
                $eatwherereal = "Take away";
            }
            elseif($customer['eatwhere'] == "Dine-in"){
                $eatwherereal = "Dine-in";
            }
            

            $saypayment = "";
            if($payment['payment_method'] == "Cash"){
                $saypayment = "Cash";
            }
            elseif($payment['payment_method'] == "QR Code"){
                $saypayment = "QR CODE";
            }
            
            $finishbtn = "Success";
        }
        else if($_SESSION['lang'] == "th"){

            $title = "ใบเสร็จอาหาร";
            $order_no = "หมายเลขคำสั่งซื้อ";

            
            $datetime = "วันเวลาสั่งซื้อ";
            $eatwhere = "ประเภท";
        
            $payment_method = "วิธีการชำระเงิน";

            
            $finishbtn = "เสร็จสิ้น";
            
            $ty = "ขอบคุณที่อุดหนุน";
            $enjoy = "ขอให้ทานให้อร่อยค่ะ ♡";
            $totalprice = "ราคารวม";

            $eatwherereal = "";
            if($customer['eatwhere'] == "Take away"){
                $eatwherereal = "สั่งกลับบ้าน";
            }
            elseif($customer['eatwhere'] == "Dine-in"){
                $eatwherereal = "ทานที่ร้าน";
            }

            $saypayment = "";
            if($payment['payment_method'] == "Cash"){
                $saypayment = "เงินสด";
            }
            elseif($payment['payment_method'] == "QR Code"){
                $saypayment = "คิวอาร์โค้ด";
            }
        }

        // echo "Payment !!!!!!!!!!!!!!!! : " . $saypayment;
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt | Ramen Restaurant</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body{
            background-color: #ececec;
        }
        /* td{
            border: 2px solid black;
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
                <h3><?php echo $title; ?></h3>
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

    <!-- body -->
    <div class="container" id="receipt-container">
            <!-- style="border: 2px solid red;" -->
            <div class="cardheader">
                <center>
                    <b> <?php echo $order_no ;?> </b><br>
                    <b style="font-size: 30px;"> <?php echo $customer['queue']; ?> </b><br>
                    Ramen Rajai - Restaurant<br>
                    Tel. 077-837-9855<br>
                    ________________________________<br>
                </center>
            </div>
            <!-- style="border: 2px solid rgb(70, 8, 240);" -->
            <div class="cardbody">
                <?php echo $datetime;?> : <?php echo $customer['order_date']; ?><br>
                <?php echo $eatwhere;?> : <?php echo $eatwherereal; ?> <br>
                <?php echo $payment_method;?> : <?php echo $saypayment; ?>
                <center>
                    ________________________________<br>
                </center>
            </div>
            <div class="cardorderlist">

                <table id="tb_receipt">
        
                    <!-- loop พิมพ์รายการอาหาร -->
                    <?php foreach($_SESSION['cart'] as $id_send=>$eachitem): ?>  <!-- วนข้อมูลในตะกร้า -->
                    <!--{ -->
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
                    

                    <tr>
                        <td class="td_receipt" id="td_receipt-qty">
                            <?php echo $eachitem['quantity']; ?>
                        </td>
                        <td class="td_receipt" id="td_receipt-order">
                            <b><?php echo $noodle ." ". $soup; ?><br></b>
                            ( <?php echo $noodle ." ". $soup ." ". $meat ." ". $spicy ." ". $topping; ?> )
                        </td>

                        <?php          
                            $sum = $eachitem['priceperdish'] * $eachitem['quantity'];
                        ?>
                        <td align="right" class="td_receipt" id="td_receipt-price">
                            <?php echo number_format($sum,2) ?> ฿
                        
                        </td>
                    <?php endforeach; ?>
                    </tr>


                    <!-- tail -->
                    <tr>
                        <td colspan="2" align="right" id="td-totalprice">
                           <b><?php echo $totalprice;?></b> 
                        </td>
                        <td>
                            <?php echo number_format($_SESSION['totalprice'],2);?> ฿
                        </td>
                    </tr>
                </table>
            </div>
            <!-- style="border: 5px solid green; " -->
            <center>
                ________________________________<br>
            </center>
            <div class="cardfooter">
                
                <center>
                    <?php echo $ty;?> <br>
                    <?php echo $enjoy;?>
                </center>
            </div>
        </div>

        <!-- footer -->
        <div class="footer-container" id="btn-receipt">
            <div class="success">
                <a href="index.php">
                    <input type="submit" value="<?php echo $finishbtn ; ?>" id="sbm-4">
                </a>
            </div>
        </div>
    <script src="app.js"></script>
</body>
</html>