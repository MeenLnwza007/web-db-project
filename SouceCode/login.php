<?php 
    //แปลภาษา
    if(isset($_GET['lang'])){
        $_SESSION['lang'] = $_GET['lang'];
        if($_SESSION['lang'] == "en"){
            $title = "Login &nbsp; For &nbsp; Admin";
            $username = "Admin username";
            $password = "Password";
            $loginbtn = "Login";
        }
        else if($_SESSION['lang'] == "th"){
            
            $title = "เข้าสู่ระบบแอดมิน";

            $username = "ชื่อบัญชี";

            $password = "รหัสผ่าน";
            $loginbtn = "เข้าสู่ระบบ";


        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login For Admin</title>
    <link rel="stylesheet" href="style.css">
    <!-- CSS Boostrap5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body{
            background-color: #ececec;
        }
        table{
            /* border: 5px solid salmon; */
            margin: 15px auto;
            width: 90%;
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

    
    <div class="container" style="border: 5px solid #cfcfcf; width: 550px; margin-top: 100px; box-shadow: 0 10px 20px #c6c6c6;
        border-radius: 10px; background-color: white; ">
        <table align="center">
                <form 
                action="
                <?php if($_SESSION['lang'] == "en"):?>
                    backstore.php?lang=en
                <?php else:?>
                    backstore.php?lang=th
                <?php endif;?> "
                method="POST">
                    <tr>
                        <td>
                            <div class="mb-3">
                                <?php echo $username;?>
                                <input type="text" name="username" class="form-control"  aria-describedby="emailHelp">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="mb-3">
                                <?php echo $password;?>
                                <input type="password" name="password" class="form-control" >
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <button type="submit" name="login" class="btn btn-primary" style="align-content: right;"><?php echo $loginbtn;?></button>
                        </td>
                    </tr>
                </form>
           
        </table>
    </div>
    <script src="app.js"></script>
</body>

</html>