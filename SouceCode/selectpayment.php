<?php 
    session_start();
    require("backend/dbconnect.php");

    if(isset($_GET['eatwhere'])){
        $_SESSION['eatwhere'] = $_GET['eatwhere'];
    }

    //เปลี่ยนภาษา
    if(isset($_GET['lang'])){
        $_SESSION['lang'] = $_GET['lang'];
        if($_SESSION['lang'] == "en"){
            $title = "Payment";

            $headertitle = "Payment Method";

            $cash = "Cash";
            $qrcode = "QR Code";
            $return = "Go Back";
        }
        else if($_SESSION['lang'] == "th"){

            $title = "การชำระเงิน";

            $headertitle = "ช่องทางชำระเงิน";

            $cash = "เงินสด";
            $qrcode = "คิวอาร์โค้ด";

            $return = "ย้อนกลับ";
        }
    }

    // echo "<br> Session <br><pre>";
    // echo print_r($_SESSION);
    // echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment | Ramen Restaurant</title>
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
                                <a href="payment.php?lang=en&payment_method=Cash">
                                    <img src="Images/cash.png" alt="">
                                    <div class="textpop">
                                    <?php echo $cash; ?>
                                    </div>
                                </a>
                            <?php else:?>
                                <a href="payment.php?lang=th&payment_method=Cash">
                                    <img src="Images/cash.png" alt="">
                                    <div class="textpop">
                                    <?php echo $cash; ?>
                                    </div>
                                </a>
                            <?php endif;?>
                        </div>
                        <div class="takeaway">
                            <?php if($_SESSION['lang'] == "en"):?>
                                <a href="payment.php?lang=en&payment_method=QR Code">
                                    <img src="Images/qr-code.png" alt="">
                                    <div class="textpop">
                                    <?php echo $qrcode; ?>
                                    </div>
                                </a>
                            <?php else:?>
                                <a href="payment.php?lang=th&payment_method=QR Code">
                                    <img src="Images/qr-code.png" alt="">
                                    <div class="textpop">
                                    <?php echo $qrcode; ?>
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
                    <a href="eatwhere.php?lang=en">
                        <input type="reset" value="<?php echo $return; ?>" name="cancel" id="rtn-5">
                    </a>
                <?php else:?>
                    <a href="eatwhere.php?lang=th">
                        <input type="reset" value="<?php echo $return; ?>" name="cancel" id="rtn-5">
                    </a>
                <?php endif;?>
            </div>
        </div>
    </div>

    <script src="app.js"></script>
</body>
</html>