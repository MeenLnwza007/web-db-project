<?php 
    session_start();
    //เปลี่ยนภาษา
    if(isset($_GET['lang'])){
        $_SESSION['lang'] = $_GET['lang'];
        if($_SESSION['lang'] == "en"){
            $title = "Checkout &nbsp; Counter";

            $headertitle = "Dinning &nbsp; location";

            $dinein = "Dine-in";
            $takeaway = "Take away";
            $return = "Go Back";
        }
        else if($_SESSION['lang'] == "th"){

            $title = "เคาน์เตอร์ชำระเงิน";

            $headertitle = "เลือกสถานที่รับประทาน";

            $dinein = "ทานที่ร้าน";
            $takeaway = "สั่งกลับบ้าน";

            $return = "ย้อนกลับ";
        }
    }
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Ramen Restaurant</title>
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
                <div class="basepop-container">
                    <div class="tabpop-container">
                        <span class="tabtext"> <?php echo $headertitle; ?> </span>
                    </div>
                    <div class="checkout-container">
                        <div class="dinein">
                        <?php if($_SESSION['lang'] == "en"):?>
                            <a href="selectpayment.php?lang=en&eatwhere=Dine-in">
                                <img src="Images/dine-in.png" alt="">
                                <div class="textpop">
                                    <?php echo $dinein; ?>
                                </div>
                            </a>
                        <?php else:?>
                            <a href="selectpayment.php?lang=th&eatwhere=Dine-in">
                                <img src="Images/dine-in.png" alt="">
                                <div class="textpop">
                                    <?php echo $dinein; ?>
                                </div>
                            </a>
                        <?php endif;?>
                        </div>
                        <div class="takeaway">
                        <?php if($_SESSION['lang'] == "en"):?>
                            <a href="selectpayment.php?lang=en&eatwhere=Take away">
                                <img src="Images/take-away.png" alt="">
                                <div class="textpop">
                                    <?php echo $takeaway; ?>
                                </div>
                            </a>
                        <?php else:?>
                            <a href="selectpayment.php?lang=th&eatwhere=Take away">
                                <img src="Images/take-away.png" alt="">
                                <div class="textpop">
                                    <?php echo $takeaway; ?>
                                </div>
                            </a>
                        <?php endif;?>
                        </div>
                    </div>
                </div>
            </center>
        </div>
    </div>

    <div class="footer-container">
        <div class="return">
            <div class="footer-text">
            <?php if($_SESSION['lang'] == "en"):?>
                <a href="cart.php?lang=en">
                    <input type="reset" value="<?php echo $return; ?>" name="cancel" id="rtn-4">
                </a>
            <?php else:?>
                <a href="cart.php?lang=th">
                    <input type="reset" value="<?php echo $return; ?>" name="cancel" id="rtn-4">
                </a>  
            <?php endif;?>
            </div>
        </div>
    </div>

    <script src="app.js"></script>
</body>
</html>