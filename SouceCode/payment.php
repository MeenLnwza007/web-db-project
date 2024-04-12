<?php 
    session_start();
    require('backend/dbconnect.php');

    if(isset($_GET['payment_method'])){
        $_SESSION['payment_method'] = $_GET['payment_method'];
    }
    

    $order =1;

    // echo "<br> Session <br><pre>";
    // echo print_r($_SESSION);
    // echo "</pre>";

    //เปลี่ยนภาษา
    if(isset($_GET['lang'])){
        $_SESSION['lang'] = $_GET['lang'];
        if($_SESSION['lang'] == "en"){
            $title = "Payment";

            $noOrder = "No Order Now !!!";
            $cancel = "Cancel";
            $checkout = "Check out";
            $totalprice = "Total &nbsp; Price";
            $priceperdish = "Unit Price";

            $tb_orderdetail = "Order details";
            $unit = "Baht";
            $tb_qty = "Amount";
            $price = "Price";
            $scan = "Scan for pay";

            $banknote = "Insert banknote for pay";
            $ty = "Thank you";
            $confirm = "Confirm";
            $return = "Go Back";


        }
        else if($_SESSION['lang'] == "th"){
            
            $title = "การชำระเงิน";
            

            $noOrder = "ยังไม่มีการสั่งอาหาร !!!";
            $cancel = "ยกเลิกสินค้า";
            $checkout = "ยืนยันสินค้า";
            $totalprice = "ราคารวม";
            $priceperdish = "ราคาต่อหน่วย";

            $unit = "บาท";
            
            $price = "ราคา";
            $tb_orderdetail = "รายการที่สั่ง";
            $tb_qty = "จำนวน";

            $scan = "สแกนเพื่อจ่าย";

            $banknote = "ใส่เงินเพื่อจ่าย";
            $ty = "ขอบคุณที่อุดหนุน";
    
            $return = "ย้อนกลับ";
            
            $confirm = "ยืนยันการชำระเงิน";


        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment | Ramen Restaurant</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- CSS Boostrap5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        #pay{
            text-align: center;
        }
        table{
            box-shadow: 0 10px 20px #c6c6c6;
            border-radius: 10px;
        }
        .container{
            margin-top: 50px;
        }
        body{
            background-color: #ececec;
        } 
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
                <h3><?php echo $title;?></h3>
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

        <div class="container">
        <table class="table table-light">
            <thead>
                <tr class="table-dark" align="center">
                    <th scope="col">#</th>
                    <th scope="col"><?php echo $tb_orderdetail; ?></th>
                    <th scope="col"><?php echo $priceperdish; ?></th>
                    <th scope="col"><?php echo $tb_qty; ?></th>
                    <!-- <th scope="col">เพิ่ม-ลด</th> -->
                    <th scope="col"><?php echo $price; ?></th>
                    <!-- <th scope="col">ลบ</th> -->
                </tr>
            <?php
            //variable
                $total=0;
                $name = "";
                // $order_name = array($id_send => $name); //สร้าง string arr เก็บชื่อสินค้า
                // var_dump($order_name);
                
                if(!empty($_SESSION['cart'])) //เช็คว่า มีตะกร้าไหม $_SESSION['cart'] --> มี = ต้องมีสินค้า
                {
                    foreach($_SESSION['cart'] as $id_send=>$eachitem) //วนข้อมูลในตะกร้า
                    {
                        // หาวัตถุดิบ ที่ใช้ในตาราง
                        // $sql = "SELECT * FROM ingredients WHERE ing_id in ('$id_sql')";
                        // echo $sql . "<br>";
                        // $query = mysqli_query($connection, $sql); // 1 เมนู มีวัตถุดิบไรบ้างที่ใช้

                        // $priceperdish = 0;

                        // while($row = mysqli_fetch_assoc($query)){ // loop for คำนวณราคาแต่ละจาน
                        //     // echo "<br>" . $row["ing_id"] . "<br>";
                        //     // echo $row["ing_name"] . "<br>";
                        //     // echo $row["ing_quantity"] . "<br>";
                        //     // echo $row["price"] . "<br> ";
                        //     $name .= $row["ing_name"] . " ";
                        //     $priceperdish += $row["price"];
                            
                        // }
                        // $item = [ //เก็บเมนูแต่ละการเก็บเข้าตะกร้า
                        //     'id' => $id_send,
                        //     'noodle' => $noodle,
                        //     'soup' => $soup,
                        //     'meat' => $meat,
                        //     'topping' => $topping,
                        //     'priceperdish' => $priceperdish
                        // ];

                        

                        // echo "SESSION now : <br><pre>";
                        // print_r($_SESSION);
                        // echo "</pre> <br>";
                        // $order_name["id_send"] = $name;
                        // echo "<br>" . $order_name['id_send'];
                        // echo $priceperdish ."<br>";

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
                        
                        
                        // echo "key $id_send : priceperdish = $eachitem[priceperdish] : quantity = $eachitem[quantity]<br>";                        
                        $sum = $eachitem['priceperdish'] * $eachitem['quantity'];
                        $total += $sum;
                        echo "<tr>";
                        echo "<td scope='row' align='center' width='75px'>". $order++ . "</td>";
                        echo "<td width='550px'> <b>" . $noodle . " " . $soup . "</b> " . $meat . " " . $spicy . " " . $topping . "</td>";
                        echo "<td align='center'>" .number_format($eachitem['priceperdish'],2) . "</td>";
                        echo "<td align='center'>";  
                        // echo "<input type='number' min='1' name='amount[$id_send]' value='$eachitem[quantity]' size='2'/></td>"; //amount = จำนวนที่สั่งซื้อ
                        echo "$eachitem[quantity]"; //amount = จำนวนที่สั่งซื้อ
                        // echo "<td align='center'>
                        //             <a href='plus.php?id_send=$id_send&act=plus' class='btn btn-outline-primary'>+ </a>
                        //             <a href='decrease.php?id_send=$id_send&act=decrease' class='btn btn-outline-primary'>- </a>
                        //         </td>";
                        
                        echo "<td width='93' align='center'>".number_format($sum,2)."</td>";
                        
                        //remove product
                        // echo "<td width='46' align='center'>
                        //     <a href='removeitem.php?id_send=$id_send&act=remove'>ลบ</a>
                        //     </td>";
                        echo "</tr>";
                    }
                    echo "<tr>";
                    echo "<td colspan='3'  align='right'><b>$totalprice</b></td>";
                    echo "<td colspan='2' align='center' >"."<b>".number_format($total,2). " $unit</b>"."</td>";
                    // echo "<td align='left' ></td>";
                    // echo "<td align='left' ></td>";
                    echo "</tr>";

                    //--------------------
                }
                else{
                    echo "<div class='alert alert-warning' role='alert' style='margin-top: 50px'>";
                    echo "<b>ยังไม่มีการสั่งอาหาร !!!</b>";
                    echo "</div> ";
                }
            ?>

        </table>
        
    <!-- </form> -->
    <!-- <div style="border: 1px solid black; justify-content: space-between;"> -->
        <!-- <a href="menu.php">กลับหน้ารายการสินค้า</a> -->
        <!-- <input type="submit" name="button" value="อัพเดทราคาใหม่"> -->
        <!-- <input type="button" name="btncancel" value="ยกเลิกการสั่งซื้อ" onclick="window.location='destroy.php';">  
        <input type="button" name="Submit2" value="สั่งซื้อ" onclick="window.location='eatwhere.php';">   -->
    <!-- </div> -->
    <?php  
        //show 

        // echo "<br>SESSION : <br><pre>";
        // print_r($_SESSION);
        // echo "</pre> <br>";
        // $count = count($_SESSION['cart']);
        // echo $count; 
    ?>        

    <!-- qrcode -->
    <?php if($_SESSION['payment_method'] == "QR Code"){ ?>
            <!-- // echo "<img src='https://image.makewebcdn.com/makeweb/m_1920x0/pv2YlulDi/260860/qr_code_1.jpg?v=202311151122' alt='' width='250px'>"; -->
            <center>
            <div class="qrcode">
                    <center><img src="Images/myqr.jpg" alt="" style="height: 450px"></center><br>
                    <span class="qrtext"> <?php echo $scan; ?><br><?php echo $ty; ?> </span><br>
                    <div class="pay">
                        <input type="text" name="pay" id="pay" value=" <?php echo number_format($_SESSION['totalprice'],2); ?>" disabled>
                    </div>
                </div>
            </center>
    <!-- } -->
    <?php }else{ ?>
        <center>
        <div class="cash">
                <center><img src="Images/cash2.png" alt="" style="height: 300px;"></center>
                <span class="qrtext"> <?php echo $banknote; ?><br><?php echo $ty; ?> </span><br><br>
                <div class="pay">
                    <input type="text" name="pay" id="pay" value=" <?php echo number_format($_SESSION['totalprice'],2); ?>" disabled>
                </div>
            </div>
        </center>
    <?php } ?>
        


                
            </center>
        </div>
    </div>

        <!-- footer -->
        <div class="footer-container">
            <div class="return">
                <div class="footer-text">
                    <?php if($_SESSION['lang'] == "en"):?>
                        <a href="selectpayment.php?lang=en">
                            <input type="reset" value="<?php echo $return;?>" name="return" id="rtn-3">
                        </a>
                    <?php else:?>
                        <a href="selectpayment.php?lang=th">
                            <input type="reset" value="<?php echo $return;?>" name="return" id="rtn-3">
                        </a>
                    <?php endif;?>
                </div>
            </div>
            <div class="confirm-receipt">
                <div class="footer-text">
                    <?php if($_SESSION['lang'] == "en"):?>
                        <a href="receipt.php?lang=en&act=fordb">
                            <input type="submit" value="<?php echo $confirm;?>" id="sbm-3">
                        </a>
                    <?php else:?>
                        <a href="receipt.php?lang=th&act=fordb">
                            <input type="submit" value="<?php echo $confirm;?>" id="sbm-3">
                        </a>
                    <?php endif;?>
                </div>
            </div>
        </div>
    <script src="app.js"></script>
</body>
</html>