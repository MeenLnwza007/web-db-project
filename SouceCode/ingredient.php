<?php 
    session_start();
    require('backend/dbconnect.php');

?>

<?php 
    //แปลภาษา
    if(isset($_GET['lang'])){
        $_SESSION['lang'] = $_GET['lang'];
        if($_SESSION['lang'] == "en"){
            $title = "Admin Ramen Server";
            $ingdetail = "Ingredient details";

            $ingpage = "Ingredient";
            $logoutbtn = "Logout";

            $tbheader1 = "ING_id";
            $tbheader2 = "ING_name";
            $tbheader3 = "ING_quantity";
            $tbheader4 = "Price";
            $tbheader5 = "ING_type";
            $tbheader6 = "Update Quantity";
            $return = "Go Back";
            $updatebtn = "Update";
        }
        
        else if($_SESSION['lang'] == "th"){
            
            
            $title = "ส่วนจัดการหลังร้าน";
            $ingdetail = "รายการวัตถุดิบ";
            $ingpage = "เช็ควัตถุดิบ";

            
            $return = "ย้อนกลับ";

           
            $updatebtn = "เพิ่ม";

            
            $tbheader1 = "รหัสวัตถุดิบ";
            $tbheader2 = "ชื่อวัตถุดิบ";
            $tbheader3 = "จำนวนที่เหลือ";
            $tbheader4 = "ราคา";
            $tbheader5 = "ประเภทวัตถุดิบ";
            $tbheader6 = "เพิ่มจำนวนวัตถุดิบ";
 

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
            $sql = "SELECT * FROM ingredients ORDER BY ing_type ASC";
            $result = mysqli_query($connection,$sql);
            $ing = mysqli_fetch_all($result, MYSQLI_ASSOC);
            // var_dump($rows);

            $countData = mysqli_num_rows($result); //นับว่ามีข้อมูลกี่ตัว
            // echo "$countData";

            $ingNumber = 1;

            // echo "<br> ing <br><pre>";
            // echo print_r($ing);
            // echo "</pre>";
            
            ?>
    
    <div class="container" >
        <h1 class="text-center" style="padding-bottom: 50px;"><?php echo $ingdetail;?></h1>
            <!-- footer -->
            <div class="footer-container">
                <div class="return">
                    <div class="footer-text">
                        <?php if($_SESSION['lang'] == "en"):?>
                        <a href="backstore.php?lang=en">
                            <input type="reset" value="<?php echo $return;?>" name="return" id="rtn-3">
                        </a>
                        <?php else:?>
                        <a href="backstore.php?lang=th">
                            <input type="reset" value="<?php echo $return;?>" name="return" id="rtn-3">
                        </a>
                        <?php endif;?>
                    </div>
                </div>
        </div>
        <br>
            <?php if($countData > 0): ?>
                <table class="table table-bordered">
                    <thead >
                        <tr align="center" class="table-dark" >
                            <th><?php echo $tbheader1; ?></th>
                            <th><?php echo $tbheader2; ?></th>
                            <th><?php echo $tbheader3; ?></th>
                            <th><?php echo $tbheader4; ?></th>
                            <th><?php echo $tbheader5; ?></th>
                            <!-- <th>OrderDATE</th> -->
                            <!-- <th>PAYMENTID</th> -->
                            <th style="width: 400px;"><?php echo $tbheader6; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($ing as $eachitem): ?> 

                        <?php 
                            //เปลี่ยนภาษา
                            if(isset($_GET['lang'])){
                                $_SESSION['lang'] = $_GET['lang'];
                                if($_SESSION['lang'] == "en"){

                                    if($eachitem["ing_name"] == "Ramen"){
                                        $ing_name = "Ramen";
                                    }
                                    elseif($eachitem["ing_name"] == "Udon"){
                                        $ing_name = "Udon";
                                    }
                                    elseif($eachitem["ing_name"] == "Soba"){
                                        $ing_name = "Soba";
                                    }
                                    elseif($eachitem["ing_name"] == "Somen"){
                                        $ing_name = "Somen";
                                    }
                                    elseif($eachitem["ing_name"] == "Shirataki"){
                                        $ing_name = "Shirataki";
                                    }
                                    elseif($eachitem["ing_name"] == "Tonkotsu"){
                                        $ing_name = "Tonkotsu";
                                    }
                                    elseif($eachitem["ing_name"] == "Miso"){
                                        $ing_name = "Miso";
                                    }
                                    elseif($eachitem["ing_name"] == "Shoyu"){
                                        $ing_name = "Shoyu";
                                    } 
                                    elseif($eachitem["ing_name"] == "Chicken"){
                                        $ing_name = "Chicken";
                                    }
                                    elseif($eachitem["ing_name"] == "Pork"){
                                        $ing_name = "Pork";
                                    }
                                    elseif($eachitem["ing_name"] == "Beef"){
                                        $ing_name = "Beef";
                                    } 
                                    if($eachitem["ing_name"] == "Mild"){
                                        $ing_name = "Mild";
                                    }
                                    elseif($eachitem["ing_name"] == "Spicy"){
                                        $ing_name = "Spicy";
                                    }
                                    elseif($eachitem["ing_name"] == "Hot"){
                                        $ing_name = "Hot";
                                    } 

                                    elseif($eachitem["ing_name"] == "Boiled egg"){
                                        $ing_name = "Boiled egg";
                                    }
                                    elseif($eachitem["ing_name"] == "Shashu"){
                                        $ing_name = "Shashu";
                                    } 
                                    elseif($eachitem["ing_name"] == "Menma"){
                                        $ing_name = "Menma";
                                    }
                                    elseif($eachitem["ing_name"] == "Mushroom"){
                                        $ing_name = "Mushroom";
                                    }
                                    elseif($eachitem["ing_name"] == "Narutomaki"){
                                        $ing_name = "Narutomaki";
                                    } 
                                    elseif($eachitem["ing_name"] == "Cabbage"){
                                        $ing_name = "Cabbage";
                                    }
                                    elseif($eachitem["ing_name"] == "Wakame"){
                                        $ing_name = "Wakame";
                                    }

                                    //type
                                    if($eachitem["ing_type"] == "meat"){
                                        $ing_type = "meat";
                                    }
                                    elseif($eachitem["ing_type"] == "noodle"){
                                        $ing_type = "noodle";
                                    }
                                    elseif($eachitem["ing_type"] == "soup"){
                                        $ing_type = "soup";
                                    }
                                    elseif($eachitem["ing_type"] == "spicy"){
                                        $ing_type = "spicy";
                                    }
                                    elseif($eachitem["ing_type"] == "topping"){
                                        $ing_type = "topping";
                                    }


                                }
                                else if($_SESSION['lang'] == "th"){
                                    
                                    if($eachitem["ing_name"] == "Ramen"){
                                        $ing_name = "เส้นราเมง";
                                    }
                                    elseif($eachitem["ing_name"] == "Udon"){
                                        $ing_name = "เส้นอูด้ง";
                                    }
                                    elseif($eachitem["ing_name"] == "Soba"){
                                        $ing_name = "เส้นโซบะ";
                                    }
                                    elseif($eachitem["ing_name"] == "Somen"){
                                        $ing_name = "เส้นโซเมง";
                                    }
                                    elseif($eachitem["ing_name"] == "Shirataki"){
                                        $ing_name = "เส้นชิราตากิ";
                                    }
                                    elseif($eachitem["ing_name"] == "Tonkotsu"){
                                        $ing_name = "ทงคตสึ";
                                    }
                                    elseif($eachitem["ing_name"] == "Miso"){
                                        $ing_name = "มิโซะ";
                                    }
                                    elseif($eachitem["ing_name"] == "Shoyu"){
                                        $ing_name = "โชยุ";
                                    } 
                                    elseif($eachitem["ing_name"] == "Chicken"){
                                        $ing_name = "เนื้อไก่";
                                    }
                                    elseif($eachitem["ing_name"] == "Pork"){
                                        $ing_name = "เนื้อหมู";
                                    }
                                    elseif($eachitem["ing_name"] == "Beef"){
                                        $ing_name = "เนื้อวัว";
                                    } 
                                    elseif($eachitem["ing_name"] == "Mild"){
                                        $ing_name = "เผ็ดน้อย";
                                    }
                                    elseif($eachitem["ing_name"] == "Spicy"){
                                        $ing_name = "เผ็ดปกติ";
                                    }
                                    elseif($eachitem["ing_name"] == "Hot"){
                                        $ing_name = "เผ็ดมาก";
                                    } 
                                    
                                    elseif($eachitem["ing_name"] == "Boiled egg"){
                                        $ing_name = "ไข่ต้ม";
                                    }
                                    elseif($eachitem["ing_name"] == "Shashu"){
                                        $ing_name = "หมูชาชู";
                                    } 
                                    elseif($eachitem["ing_name"] == "Menma"){
                                        $ing_name = "เมนมะ";
                                    }
                                    elseif($eachitem["ing_name"] == "Mushroom"){
                                        $ing_name = "เห็ด";
                                    }
                                    elseif($eachitem["ing_name"] == "Narutomaki"){
                                        $ing_name = "ลูกชิ้นนารูโตะ";
                                    } 
                                    elseif($eachitem["ing_name"] == "Cabbage"){
                                        $ing_name = "กะหล่ำปลี";
                                    }
                                    elseif($eachitem["ing_name"] == "Wakame"){
                                        $ing_name = "สาหร่ายวากาเมะ";
                                    }

                                    //type
                                    if($eachitem["ing_type"] == "meat"){
                                        $ing_type = "เนื้อสัตว์";
                                    }
                                    elseif($eachitem["ing_type"] == "noodle"){
                                        $ing_type = "เส้น";
                                    }
                                    elseif($eachitem["ing_type"] == "soup"){
                                        $ing_type = "น้ำซุป";
                                    }
                                    elseif($eachitem["ing_type"] == "spicy"){
                                        $ing_type = "ระดับความเผ็ด";
                                    }
                                    elseif($eachitem["ing_type"] == "topping"){
                                        $ing_type = "ท็อปปิ้ง";
                                    }
                                }
                            }
                        ?>

                        <tr align="center">
                            <td> <?php echo $ingNumber++; ?> </td>

                            <td> <?php echo $ing_name;?> </td>

                            <td> <?php echo $eachitem["ing_quantity"]; ?> </td>
                        
                            <td> <?php echo $eachitem["price"]; ?> </td>

                            <?php if($eachitem["ing_type"] == "noodle"){?>

                                <td style="background-color: lightgoldenrodyellow;"> <?php echo $ing_type; ?> </td>

                            <?php }elseif($eachitem["ing_type"] == "soup"){?>

                                <td style="background-color: #c1e0fb;"> <?php echo $ing_type; ?> </td>
                                
                            <?php }elseif($eachitem["ing_type"] == "meat"){?>

                                <td style="background-color: #fbcbdf;"> <?php echo $ing_type; ?> </td>

                            <?php }elseif($eachitem["ing_type"] == "spicy"){?>

                                <td style="background-color: #fbadad;"> <?php echo $ing_type; ?> </td>

                            <?php }elseif($eachitem["ing_type"] == "topping"){?>

                                <td style="background-color: #f9a986"> <?php echo $ing_type; ?> </td>

                            <?php }?>
                            
                            <td align="center" >
                            <!-- onclick="return confirm('คุณต้องการลบข้อมูลจริงหรือไม่')" -->
                                <form action="update_ing_quantity.php?ing_id=<?php echo $eachitem["ing_id"];?>" method="POST">
                                    <input type="hidden" name="ing_id" value="<?php echo $eachitem["ing_id"];?>">
                                    <input type="number" name="qty">
                                    <button class="btn btn-warning"><?php echo $updatebtn;?></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class='alert123'>
                    <b>ไม่มีวัตถุดิบในฐานข้อมูล !!!</b>
                </div>            
            <?php endif; ?>
        </div>

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

    <script src="app.js"></script>
</body>
</html>

<?php mysqli_close($connection); ?>