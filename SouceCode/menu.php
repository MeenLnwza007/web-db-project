<?php 
    session_start();
    require("backend/dbconnect.php");

    //count จำนวนสินค้าที่มีในตะกร้า
    // $sql = "SELECT * FROM orders";
    // $result = mysqli_query($connection,$sql);

    // echo "<br> Session <br><pre>";
    // echo print_r($_SESSION);
    // echo "</pre>";

    $countorder = 0;
    $total = 0;
    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $id_send=>$eachitem){
            $countorder += $eachitem['quantity'];
            $total += $eachitem['priceperdish'] * $eachitem['quantity'];
        }
    }
    
    // if($result){
    //     // var_dump($countorder);
    //     echo $countorder;
    // }else{
    //     echo mysqli_error($connection);
    // }

    // $sql = "SELECT * FROM ingredients";
    // $result_ing = mysqli_query($connection, $sql);
    // $fetch_ing = mysqli_fetch_all($result_ing,MYSQLI_ASSOC);

    // echo "<br> Session <br><pre>";
    // echo print_r($fetch_ing);
    // echo "</pre>";
?>

<?php 
    //เปลี่ยนภาษา
    if(isset($_GET['lang'])){
        $_SESSION['lang'] = $_GET['lang'];
        if($_SESSION['lang'] == "en"){
            $title = "Choose &nbsp; Your &nbsp; Ingredients";

            $filterNoodle = "Noodles";
            $filterSoup = "Soup";
            $filterMeat = "Meat";
            $filterSpicy = "Spicy";
            $filterTopping = "Topping";
            $filterAdmin = "Login For Admin";

            $noodle1 = "Ramen";
            $noodle2 = "Udon";
            $noodle3 = "Soba";
            $noodle4 = "Somen";
            $noodle5 = "Shirataki";

            $soup1 = "Tonkotsu";
            $soup2 = "Miso";
            $soup3 = "Shoyu";

            $meat1 = "Chicken";
            $meat2 = "Pork";
            $meat3 = "Beef";

            $spicy1 = "Mild";
            $spicy2 = "Spicy";
            $spicy3 = "Hot";

            $topping1 = "Boiled egg";
            $topping2 = "Shashu";
            $topping3 = "Menma";
            $topping4 = "Mushroom";
            $topping5 = "Narutomaki";
            $topping6 = "Cabbage";
            $topping7 = "Wakame";

            $total1 = "Total";

            $return = "Clear";
            $confirm = "Confirm";
        }
        else if($_SESSION['lang'] == "th"){
            $title = "โปรดเลือกส่วนประกอบ";

            $filterNoodle = "เส้น";
            $filterSoup = "น้ำซุป";
            $filterMeat = "เนื้อสัตว์";
            $filterSpicy = "ระดับความเผ็ด";
            $filterTopping = "ท็อปปิ้ง";
            $filterAdmin = "เข้าสู่ระบบแอดมิน";

            $noodle1 = "เส้นราเมง";
            $noodle2 = "เส้นอูด้ง";
            $noodle3 = "เส้นโซบะ";
            $noodle4 = "เส้นโซเมน";
            $noodle5 = "เส้นชิราตากิ";

            $soup1 = "ทงคตสึ";
            $soup2 = "มิโซะ";
            $soup3 = "โชยุ";

            $meat1 = "เนื้อไก่";
            $meat2 = "เนื้อหมู";
            $meat3 = "เนื้อวัว";

            $spicy1 = "เผ็ดน้อย";
            $spicy2 = "เผ็ดกลาง";
            $spicy3 = "เผ็ดมาก";

            $topping1 = "ไข่ต้ม";
            $topping2 = "หมูชาชู";
            $topping3 = "เมนมะ";
            $topping4 = "เห็ด";
            $topping5 = "ลูกชิ้นนารูโตะ";
            $topping6 = "กะหล่ำปลี";
            $topping7 = "สาหร่ายวากาเมะ";

            $total1 = "ราคารวม";

            $return = "เคลียร์";
            $confirm = "ยืนยันการเลือก";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu | Ramen Restaurant</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
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
                <h3> <?php echo $title ;?></h3>
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

    <form action="add.php" method="POST">
        <input type="hidden" name="act" value="add">
        <div class="container-1">
            <!-- sidebar -->
            <div class="sidebar-container">
                <nav>
                    <div class="tab">
                        <ul class="filter-container">
                            <li class="filter">
                                <a href="#noodles"> <?php echo $filterNoodle ;?> </a>
                            </li>
                            <li class="filter">
                                <a href="#soup"> <?php echo $filterSoup ;?> </a>
                            </li>
                            <li class="filter">
                                <a href="#soup"> <?php echo $filterMeat ;?> </a>
                            </li>
                            <li class="filter">
                                <a href="#soup"> <?php echo $filterSpicy ;?> </a>
                            </li>
                            <li class="filter">
                                <a href="#soup"> <?php echo $filterTopping ;?> </a>
                            </li>
                            ---------
                            <li class="filter" >
                            <?php if($_SESSION['lang'] == "en"):?>
                                <a href="login.php?lang=en"> <?php echo $filterAdmin ;?> </a>
                            <?php else:?>
                                <a href="login.php?lang=th"> <?php echo $filterAdmin ;?> </a>
                            <?php endif;?>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
    
            <!-- content -->
            <div class="content-container">
                <!-- noodles -->
                <div id="noodles">
                    <div class="ingredients-container">
                        <div class="item">
                            <div class="util">
                                <input type="radio" id="rdh1" name="noodle" value="Ramen" required>
                                <label for="rdh1">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Ramen-noodles.png" alt="">
                            <div class="describe">
                            <?php echo $noodle1 ;?> <br> 10 ฿
                            </div>
                        </div>
                        <div class="item">
                            <div class="util">
                                <input type="radio" name="noodle" value="Udon" id="rdh2">
                                <label for="rdh2">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Udon-noodles.png" alt="">
                            <div class="describe">
                            <?php echo $noodle2 ;?> <br> 10 ฿
                            </div>
                        </div>
                        <div class="item">
                            <div class="util">
                                <input type="radio" name="noodle" value="Soba" id="rdh3">
                                <label for="rdh3">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Soba-noodles.png" alt="">
                            <div class="describe">
                            <?php echo $noodle3 ;?> <br> 10 ฿
                            </div>
                        </div>
                        <div class="item">
                            <div class="util">
                                <input type="radio" name="noodle" value="Somen" id="rdh4">
                                <label for="rdh4">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Somen-noodles.png" alt="">
                            <div class="describe">
                            <?php echo $noodle4 ;?> <br> 10 ฿
                            </div>
                        </div>
                        <div class="item">
                            <div class="util">
                                <input type="radio" name="noodle" value="Shirataki" id="rdh5">
                                <label for="rdh5">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Shirataki-noodles.png" alt="">
                            <div class="describe">
                            <?php echo $noodle5 ;?> <br> 10 ฿
                            </div>
                        </div>
                    </div>
                </div>

                <!-- soup -->
                <div id="soup">
                    <div class="ingredients-container">
                        <div class="item">
                            <div class="util">
                                <input type="radio" name="soup" value="Tonkotsu" required id="rdh6">
                                <label for="rdh6">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Tonkotsu-soup.png" alt="">
                            <div class="describe">
                            <?php echo $soup1 ;?> <br> 30 ฿
                            </div>
                        </div>
                        <div class="item">
                            <div class="util">
                                <input type="radio" name="soup" value="Miso" id="rdh7">
                                <label for="rdh7">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Miso-soup.png" alt="">
                            <div class="describe">
                            <?php echo $soup2 ;?> <br> 30 ฿
                            </div>
                        </div>
                        <div class="item">
                            <div class="util">
                                <input type="radio" name="soup" value="Shoyu" id="rdh8">
                                <label for="rdh8">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Shoyu-soup.png" alt="">
                            <div class="describe">
                            <?php echo $soup3 ;?> <br> 30 ฿
                            </div>
                        </div>
                    </div>
                </div>

                <!-- meat -->
                <div id="meat">
                    <div class="ingredients-container">
                        <div class="item">
                            <div class="util">
                                <input type="radio" name="meat" id="rdh9" value="Chicken" required>
                                <label for="rdh9">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Chicken-meat.png" alt="">
                            <div class="describe">
                                <br> <?php echo $meat1 ;?> <br> 5 ฿
                            </div>
                        </div>
                        <div class="item">
                            <div class="util">
                                <input type="radio" name="meat" id="rdh10" value="Pork">
                                <label for="rdh10">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Pork-meat.png" alt="">
                            <div class="describe">
                                <br> <?php echo $meat2 ;?> <br> 5 ฿
                            </div>
                        </div>
                        <div class="item">
                            <div class="util">
                                <input type="radio" name="meat" id="rdh11" value="Beef">
                                <label for="rdh11">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Beef-meat.png" alt="">
                            <div class="describe">
                                <br> <?php echo $meat3 ;?> <br> 10 ฿
                            </div>
                        </div>
                    </div>
                </div>

                <!-- spicy -->
                <div id="spicy">
                    <div class="ingredients-container">
                        <div class="item">
                            <div class="util">
                                <input type="radio" name="spicy" id="rdh12" value="Mild" required>
                                <label for="rdh12">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Mild-spice.png" alt="">
                            <div class="describe">
                                <br> <?php echo $spicy1 ;?> <br> 0 ฿
                            </div>
                        </div>
                        <div class="item">
                            <div class="util">
                                <input type="radio" name="spicy" id="rdh13" value="Spicy"> 
                                <label for="rdh13">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Spicy-spice.png" alt="">
                            <div class="describe">
                                <br> <?php echo $spicy2 ;?> <br> 0 ฿
                            </div>
                        </div>
                        <div class="item">
                            <div class="util">
                                <input type="radio" name="spicy" id="rdh14" value="Hot">
                                <label for="rdh14">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Hot-spice.png" alt="">
                            <div class="describe">
                                <br> <?php echo $spicy3 ;?> <br> 0 ฿
                            </div>
                        </div>
                    </div>
                </div>

                <!-- topping -->
                <div id="topping">
                    <div class="ingredients-container">
                        <div class="item">
                            <div class="util">
                                <input type="checkbox" name="toppings[]" value="Boiled egg" id="cbh1">
                                <label for="cbh1">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Boilegg.png" alt="">
                            <div class="describe">
                                <br> <?php echo $topping1 ;?> <br> 10 ฿
                            </div>
                        </div>
                        <div class="item">
                            <div class="util">
                                <input type="checkbox" name="toppings[]" value="Shashu" id="cbh2">
                                <label for="cbh2">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Shashu.png" alt="">
                            <div class="describe">
                                <br> <?php echo $topping2 ;?> <br> 25 ฿
                            </div>
                        </div>
                        <div class="item">
                            <div class="util">
                                <input type="checkbox" name="toppings[]" value="Menma" id="cbh3">
                                <label for="cbh3">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Menma.png" alt="">
                            <div class="describe">
                                <br> <?php echo $topping3 ;?> <br> 20 ฿
                            </div>
                        </div>
                        <div class="item">
                            <div class="util">
                                <input type="checkbox" name="toppings[]" value="Mushroom" id="cbh4">
                                <label for="cbh4">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Mushroom.png" alt="">
                            <div class="describe">
                                <br> <?php echo $topping4 ;?> <br> 10 ฿
                            </div>
                        </div>
                        <div class="item">
                            <div class="util">
                                <input type="checkbox" name="toppings[]" value="Narutomaki" id="cbh5">
                                <label for="cbh5">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Narutomaki.png" alt="">
                            <div class="describe">
                                <br> <?php echo $topping5 ;?> <br> 10 ฿
                            </div>
                        </div>
                        <div class="item">
                            <div class="util">
                                <input type="checkbox" name="toppings[]" value="Cabbage" id="cbh6">
                                <label for="cbh6">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Cabbages.png" alt="">
                            <div class="describe">
                                <br> <?php echo $topping6 ;?> <br> 10 ฿
                            </div>
                        </div>
                        <div class="item">
                            <div class="util">
                                <input type="checkbox" name="toppings[]" value="Wakame" id="cbh7">
                                <label for="cbh7">
                                    <i class="uil uil-heart" aria-hidden="true"></i>
                                </label>
                            </div>
                            <img src="Images/Wakame.png" alt="">
                            <div class="describe">
                                <br> <?php echo $topping7 ;?> <br> 10 ฿
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>

            <!-- footer -->
            <div class="footer-container">
                <div class="return">
                    <div class="footer-text">
                        <a href="index.php">
                            <input type="reset" value="<?php echo $return; ?>" name="cancel" id="rtn-1">
                        </a>
                    </div>
                </div>
                <div class="confirm">
                    <div class="util-cart">
                    <?php if($_SESSION['lang'] == "en"):?>
                        <a href="cart.php?lang=en">
                            <i class="uil uil-shopping-cart-alt"></i>
                        </a>
                    <?php else:?>
                        <a href="cart.php?lang=th">
                            <i class="uil uil-shopping-cart-alt"></i>
                        </a>   
                    <?php endif;?>
                        <span class="cart-number"> <?php echo $countorder; ?>  </span>
                        <div class="total"> (<?php echo $total1; ?> <?php echo number_format($total,2) ?> ฿) </div>
                    </div>
                    <div class="footer-text">
                        <input type="submit" value="<?php echo $confirm; ?>" name="submit" id="sbm-1">
                    </div>
                </div>
            </div>
        </form>
    <script src="app.js"></script>
</body>

</html>

<?php 
    mysqli_close($connection);
?>