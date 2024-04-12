<?php 
    session_start();
    require('backend/dbconnect.php');

    if(isset($_POST['login'])){
        if($_POST['username'] != "admin" || $_POST['password'] != "admin"){
            if($_SESSION['lang'] == "en"){
                header("location:login.php?lang=en");
            }
            else{
                header("location:login.php?lang=th");
            }
        }
    }


    //แปลภาษา
    if(isset($_GET['lang'])){
        $_SESSION['lang'] = $_GET['lang'];
        if($_SESSION['lang'] == "en"){
            $title = "Admin Ramen Server";
            $orderdetail = "Order details";

            $ingpage = "Ingredient";
            $logoutbtn = "Logout";

            $tbheader1 = "Queue";
            $tbheader2 = "OrderID";
            $tbheader3 = "Noodle";
            $tbheader4 = "Soup";
            $tbheader5 = "Meat";
            $tbheader6 = "Spicy";
            $tbheader7 = "Toppings";
            $tbheader8 = "Qty";
            $tbheader9 = "Date";
            $tbheader10 = "Status";
            $tbheader11= "C_Status";
            $serve_status = "Not Serve";
            $serve_status2 = "Served";
        }
        
        else if($_SESSION['lang'] == "th"){
            
            
            $title = "ส่วนจัดการหลังร้าน";
            $orderdetail = "รายการอาหารที่ลูกค้าสั่ง";
            $ingpage = "เช็ควัตถุดิบ";
            $logoutbtn = "ออกจากระบบ";
            
            $tbheader1 = "คิว";
            $tbheader2 = "รหัสสินค้า";
            $tbheader3 = "เส้น";
            $tbheader4 = "น้ำซุป";
            $tbheader5 = "เนื้อสัตว์";
            $tbheader6 = "ระดับความเผ็ด";
            $tbheader7 = "ท็อปปิ้ง";
            $tbheader8 = "จำนวน";
            $tbheader9 = "วัน-เวลาที่สั่ง";
            $tbheader10 = "สถานะ";
            $tbheader11= "เปลี่ยนสถานะ";
 
            $serve_status = "ยังไม่เสิร์ฟ";
            $serve_status2 = "เสิร์ฟแล้ว";
            
            
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backstore | Ramen Restaurant</title>
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
            margin: 0px;
            margin-left: auto;
            margin-right: auto;
            background-color: white;
        }
        .container{
            /* margin-top: 50px;
            margin-left: 50px;
            margin-right: auto; */
            /* border: 2px solid black; */
        }
        body{
            background-color: #ececec;
        }
        #tbback{
            margin: 0 50px;
            margin-bottom: 100px;
        }
        #tbheader{
            background-color: black;
            color: white;
        }
        td{
            border: 1px solid black;
            padding: 5px;
        }
        th{
            padding: 5px;
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
                <?php echo $title;?>
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

        <?php 
            $sql = "SELECT * FROM orders o JOIN customers c ON c.queue = o.queue ORDER BY serve_status ASC , o.queue ASC";
            $result = mysqli_query($connection,$sql);
            $order = mysqli_fetch_all($result, MYSQLI_ASSOC);
            // var_dump($rows);

            $countData = mysqli_num_rows($result); //นับว่ามีข้อมูลกี่ตัว
            // echo "$countData";

            $orderNumber = 1;

            // echo "<br> Order <br><pre>";
            // echo print_r($order);
            // echo "</pre>";
            
            ?>
    
    
    
    <div class="container" style="margin-top:50px; margin-left: auto; margin-right: auto; text-align: center;">
        <h1 class="text-center" style="padding-bottom: 50px;"><?php echo $orderdetail;?></h1>

        <!-- footer -->
        <div class="footer-container">
            <div class="return">
                <div class="footer-text">
                    <a href="index.php">
                        <input type="reset" value="<?php echo $logoutbtn;?>" name="return" id="rtn-3">
                    </a>
                </div>
            </div>
            <div class="confirm-receipt">
                <div class="footer-text">
                <?php if($_SESSION['lang'] == "en"):?>
                    <a href="ingredient.php?lang=en">
                        <input type="submit" value="<?php echo $ingpage;?>" id="sbm-3">
                    </a>
                    <?php else:?>
                        <a href="ingredient.php?lang=th">
                            <input type="submit" value="<?php echo $ingpage;?>" id="sbm-3">
                        </a>
                    <?php endif;?>
                </div>
            </div>
            
            <br>
        </div>
    </div>
    
        <div id="tbback">
            <?php if($countData > 0): ?>
                <table id="tbback1">
                    <thead style="height: 50px;">
                        <tr align="center" id="tbheader">
                            <th style="width: auto;"><?php echo $tbheader1;?></th>
                            <th style="width: auto;"><?php echo $tbheader2;?></th>
                            <th style="width: auto"><?php echo $tbheader3;?></th>
                            <th style="width: auto"><?php echo $tbheader4;?></th>
                            <th style="width: auto"><?php echo $tbheader5;?></th>
                            <th style="width: auto"><?php echo $tbheader6;?></th>
                            <th id="top" style="width: 35%"><?php echo $tbheader7;?></th>
                            <!-- <th>OrderDATE</th> -->
                            <!-- <th>PAYMENTID</th> -->
                            <th style="width: auto"><?php echo $tbheader8;?></th>
                            <th style="width: auto"><?php echo $tbheader9;?></th>
                            <th style="width: auto"><?php echo $tbheader10;?></th>
                            <th style="width: auto"><?php echo $tbheader11;?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($order as $eachitem): ?> 

                        <tr align="center">
                            <td> <?php echo $eachitem['queue']; ?> </td>

                            <td> <?php echo $eachitem['order_id']; ?> </td>
                        <!-- loop สำหรับการนำค่าวัตถุที่ใช้มาแสดงผล -->
                        
                            <?php 
                            //sql สำหรับดึงข้อมูลมา
                            $sql = "SELECT * FROM order_ingre_used od 
                                    JOIN orders o ON o.order_id = od.order_id
                                    JOIN customers c ON c.queue = o.queue
                                    JOIN ingredients ing ON ing.ing_id = od.ing_id
                                    WHERE od.order_id = $eachitem[order_id]";

                            $result = mysqli_query($connection,$sql);
                            // $fetch_order_ingre_used = mysqli_fetch_assoc($result);
                            $fetch_order_ingre_used = mysqli_fetch_all($result,MYSQLI_ASSOC);
                            // echo "<pre>";
                            // print_r($fetch_order_ingre_used);
                            // echo "</pre>";

                            // foreach($fetch_order_ingre_used as $eachdetail){
                            //     echo "$eachdetail[ing_id] = $eachdetail[ing_name] <br>";
                            // }

                            //เปลี่ยนภาษา
                            $noodle = "";
                            $soup = "";
                            $meat = "";
                            $spicy = "";
                            $_SESSION['topping'] = [];      
                            if(isset($_GET['lang'])){
                                $_SESSION['lang'] = $_GET['lang'];
                                
                                if($_SESSION['lang'] == "en"){
                                    foreach($fetch_order_ingre_used as $eachdetail){
                                        //NOODLE
                                        if($eachdetail["ing_id"] == "1"){
                                            $noodle = $eachdetail["ing_name"];
                                        }
                                        elseif($eachdetail["ing_id"] == "4"){
                                            $noodle = $eachdetail["ing_name"];
                                        }
                                        elseif($eachdetail["ing_id"] == "5"){
                                            $noodle = $eachdetail["ing_name"];
                                        }
                                        elseif($eachdetail["ing_id"] == "6"){
                                            $noodle = $eachdetail["ing_name"];
                                        }
                                        elseif($eachdetail["ing_id"] == "7"){
                                            $noodle = $eachdetail["ing_name"];
                                        }

                                        //SOUP
                                        if($eachdetail["ing_id"] == "8"){
                                            $soup = $eachdetail["ing_name"];
                                        }
                                        elseif($eachdetail["ing_id"] == "9"){
                                            $soup = $eachdetail["ing_name"];
                                        }
                                        elseif($eachdetail["ing_id"] == "10"){
                                            $soup = $eachdetail["ing_name"];
                                        } 

                                        //MEAT
                                        if($eachdetail["ing_id"] == "11"){
                                            $meat = $eachdetail["ing_name"];
                                        }
                                        elseif($eachdetail["ing_id"] == "12"){
                                            $meat = $eachdetail["ing_name"];
                                        }
                                        elseif($eachdetail["ing_id"] == "13"){
                                            $meat = $eachdetail["ing_name"];
                                        } 

                                        //SPICY
                                        if($eachdetail["ing_id"] == "14"){
                                            $spicy = $eachdetail["ing_name"];
                                        }
                                        elseif($eachdetail["ing_id"] == "15"){
                                            $spicy = $eachdetail["ing_name"];
                                        }
                                        elseif($eachdetail["ing_id"] == "16"){
                                            $spicy = $eachdetail["ing_name"];
                                        } 
        
                                        //TOPPING
                                        if($eachdetail["ing_id"] == "17"){
                                            array_push($_SESSION['topping'],$eachdetail["ing_name"]);
                                        }
                                        elseif($eachdetail["ing_id"] == "18"){
                                            array_push($_SESSION['topping'],$eachdetail["ing_name"]);
                                        }
                                        elseif($eachdetail["ing_id"] == "19"){
                                            array_push($_SESSION['topping'],$eachdetail["ing_name"]);
                                        }
                                        elseif($eachdetail["ing_id"] == "20"){
                                            array_push($_SESSION['topping'],$eachdetail["ing_name"]);
                                        }
                                        elseif($eachdetail["ing_id"] == "21"){
                                            array_push($_SESSION['topping'],$eachdetail["ing_name"]);
                                        }
                                        elseif($eachdetail["ing_id"] == "22"){
                                            array_push($_SESSION['topping'],$eachdetail["ing_name"]);
                                        } 
                                        elseif($eachdetail["ing_id"] == "23"){
                                            array_push($_SESSION['topping'],$eachdetail["ing_name"]);
                                        } 
                                
                                    }
                                }

                                //convert topping array to string
                                $topping = implode(", ",$_SESSION['topping']);
                                // echo "aaa topping : $topping";

                                // echo "<pre>";
                                // print_r($_SESSION);
                                // echo "</pre>";

                                if($_SESSION['lang'] == "th"){
                                    foreach($fetch_order_ingre_used as $eachdetail){
                                        //NOODLE
                                        if($eachdetail["ing_id"] == "1"){
                                            $noodle = "เส้นราเมง";
                                        }
                                        elseif($eachdetail["ing_id"] == "4"){
                                            $noodle = "เส้นอูด้ง";
                                        }
                                        elseif($eachdetail["ing_id"] == "5"){
                                            $noodle = "เส้นโซบะ";
                                        }
                                        elseif($eachdetail["ing_id"] == "6"){
                                            $noodle = "เส้นโซเมง";
                                        }
                                        elseif($eachdetail["ing_id"] == "7"){
                                            $noodle = "เส้นชิราตากิ";
                                        }

                                        //SOUP
                                        if($eachdetail["ing_id"] == "8"){
                                            $soup = "ทงคตสึ";
                                        }
                                        elseif($eachdetail["ing_id"] == "9"){
                                            $soup = "มิโซะ";
                                        }
                                        elseif($eachdetail["ing_id"] == "10"){
                                            $soup = "โชยุ";
                                        } 

                                        //MEAT
                                        if($eachdetail["ing_id"] == "11"){
                                            $meat = "เนื้อไก่";
                                        }
                                        elseif($eachdetail["ing_id"] == "12"){
                                            $meat = "เนื้อหมู";
                                        }
                                        elseif($eachdetail["ing_id"] == "13"){
                                            $meat = "เนื้อวัว";
                                        } 

                                        //SPICY
                                        if($eachdetail["ing_id"] == "14"){
                                            $spicy = "เผ็ดน้อย";
                                        }
                                        elseif($eachdetail["ing_id"] == "15"){
                                            $spicy = "เผ็ดปกติ";
                                        }
                                        elseif($eachdetail["ing_id"] == "16"){
                                            $spicy = "เผ็ดมาก";
                                        } 
        
                                        //TOPPING
                                        if($eachdetail["ing_id"] == "17"){
                                            array_push($_SESSION['topping'],$eachdetail["ing_name"]);
                                        }
                                        elseif($eachdetail["ing_id"] == "18"){
                                            array_push($_SESSION['topping'],$eachdetail["ing_name"]);
                                        }
                                        elseif($eachdetail["ing_id"] == "19"){
                                            array_push($_SESSION['topping'],$eachdetail["ing_name"]);
                                        }
                                        elseif($eachdetail["ing_id"] == "20"){
                                            array_push($_SESSION['topping'],$eachdetail["ing_name"]);
                                        }
                                        elseif($eachdetail["ing_id"] == "21"){
                                            array_push($_SESSION['topping'],$eachdetail["ing_name"]);
                                        }
                                        elseif($eachdetail["ing_id"] == "22"){
                                            array_push($_SESSION['topping'],$eachdetail["ing_name"]);
                                        } 
                                        elseif($eachdetail["ing_id"] == "23"){
                                            array_push($_SESSION['topping'],$eachdetail["ing_name"]);
                                        } 

                                        $topping = implode(", ",$_SESSION['topping']);
                                        // echo "asdasd topping : $topping";

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
                                // echo "topping : $topping";
                            }

                            
                        ?>

                            <td> <?php echo $noodle?> </td>

                            <td> <?php echo $soup; ?> </td>

                            <td> <?php echo $meat; ?> </td>

                            <td> <?php echo $spicy; ?> </td>

                            <td align="left"> <?php echo $topping; ?> </td>




                            <td>
                                <?php echo $eachitem["quantity"]; ?>
                            </td>

                            <td>
                                <?php echo $eachitem["order_date"]; ?>
                            </td>

                            <?php if($eachitem['serve_status'] == "Not Serve"){ ?>
                                <td style="background-color: antiquewhite;">
                                    <?php echo $serve_status ; ?>
                                </td>
                            <?php }else{?> 
                                <td style="background-color: lightgreen;">
                                    <?php echo $serve_status2 ; ?>
                                </td>
                            <?php }?>
                            
                            <td align="center">
                            <!-- onclick="return confirm('คุณต้องการลบข้อมูลจริงหรือไม่')" -->
                                <a href="changestatus.php?order_id=<?php echo $eachitem['order_id'] ;?>  " class="btn btn-danger">Served</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <center>
                    <div class='alert123'>
                        <b>ยังไม่มีการสั่งอาหาร </b>
                    </div> 
                </center>           
            <?php endif; ?>

            </table>
        </div>   
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

    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php mysqli_close($connection); ?>