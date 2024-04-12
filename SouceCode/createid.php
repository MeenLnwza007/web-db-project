<?php
    require("backend/dbconnect.php");
//code สำหรับการสร้าง รหัสสินค้า
    $sql1 = "SELECT * FROM ingredients ORDER BY ing_id ASC";
    $result_ing = mysqli_query($connection,$sql1);
    // $rows = mysqli_fetch_all($result_ing, MYSQLI_ASSOC);
    // $rows = mysqli_fetch_assoc($result_ing);
    // echo "<pre>";
    // print_r($rows);
    // echo "</pre> <br>";
    $id_arr = array();
    while($rows = mysqli_fetch_array($result_ing)){
        if($noodle == $rows["ing_name"]){
            array_push($id_arr,$rows["ing_id"]);
        }
        if($soup == $rows["ing_name"]){
            array_push($id_arr,$rows["ing_id"]);
        }
        if($meat == $rows["ing_name"]){
            array_push($id_arr,$rows["ing_id"]);
        }
        if($spicy == $rows["ing_name"]){
            array_push($id_arr,$rows["ing_id"]);
        }
        if(str_contains($topping,$rows["ing_name"]) == true){
            array_push($id_arr,$rows["ing_id"]);
        }
    }
    
    // echo $id . "<br>"; //ได้ id สำหรับแต่ละ เมนูแล้ว
    // echo "<pre>";
    // print_r($id);
    // echo "</pre> <br>";  
    // $id_arr = explode(" ",$id);
    // print_r($id_arr) ;
    echo "<pre>";
    print_r($id_arr);
    echo "</pre> <br>";
    // เปลี่ยน array เป็น string
    $id_send = implode("-",$id_arr);
    echo "<br> id_send :" . $id_send; // 1-9-12-15-18-19
    $id_sql = implode("','",$id_arr);
    echo "<br> id_sql :" . $id_sql; //1','8','11','14','17','18','19','20','21','22','23

?>