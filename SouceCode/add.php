<?php 
    session_start();
    require("backend/dbconnect.php");

    if(isset($_POST["submit"])){
        $noodle = $_POST["noodle"];
        $soup = $_POST["soup"];
        $meat = $_POST["meat"]; 
        $spicy = $_POST["spicy"];
        if(isset($_POST['toppings'])){
            $toppings = $_POST["toppings"];
            // var_dump($toppings);
            $topping = implode("," , $toppings);
        }
        $act = $_POST["act"];
        
        include("createid.php");
    }

    // echo "<pre>";
    // print_r($toppings);
    // echo "</pre> <br>";

    // echo "<pre>";
    // print_r($topping);
    // echo "</pre> <br>";      
    

    // $id_string_get = $_GET['$id_string'];
    // $action_get = $_GET['$action'];

    // echo $id_string_get . "<br>";
    // echo $action_get;

    $sql = "SELECT * FROM ingredients WHERE ing_id in ('$id_sql')";
    echo "<br>" . $sql . "<br>";
    $query = mysqli_query($connection, $sql); // 1 เมนู มีวัตถุดิบไรบ้างที่ใช้

    $priceperdish = 0;

    while($row = mysqli_fetch_assoc($query)){ // loop for คำนวณราคาแต่ละจาน
        // echo "<br>" . $row["ing_id"] . "<br>";
        // echo $row["ing_name"] . "<br>";
        // echo $row["ing_quantity"] . "<br>";
        // echo $row["price"] . "<br> ";
        $priceperdish += $row["price"];
        
    }
    $item = [ //เก็บเมนูแต่ละการเก็บเข้าตะกร้า
        'id' => $id_send,
        'noodle' => $noodle,
        'soup' => $soup,
        'meat' => $meat,
        'spicy' => $spicy,
        'topping' => $topping,
        'priceperdish' => $priceperdish,
        'quantity' => 1,
        'id_arr' => $id_arr
    ];

    if($act=='add' && !empty($id_send))
	{
		if(isset($_SESSION['cart'][$id_send]))
		{
			$_SESSION['cart'][$id_send]['quantity'] ++; //หากเจอสินค้านี้ ให้เพิ่มจำนวนสินค้า
		}
		else
		{
            $_SESSION['cart'][$id_send] = $item;
			// $_SESSION['cart'][]['quantity'] = 1; //หากยังไม่มี ให้เริ่มที่ 1
		}
	}

    if($_SESSION['lang'] == "en"){
        header("location:cart.php?lang=en");
    }
    else{
        header("location:cart.php?lang=th");
    }

?>