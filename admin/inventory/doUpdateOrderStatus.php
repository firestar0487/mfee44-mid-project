<?php
require_once("../config/dbConnect.php");
session_start();

if(!isset($_POST["id"])||!isset($_POST["status"])){
    echo"請從正常管道進入";
    die;
}

$id=$_POST["id"];//用於指定對何筆資料做編輯
$status=$_POST["status"];//即將要寫進的值
$sql="UPDATE orderlist SET order_status='$status' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    $data = [
        "status" => 1,
        "message" => "更新成功",
    ];
    $_SESSION["requestInventory"] = $data;
    // echo "更新成功";
   } else {
    $data = [
        "status" => 1,
        "message" => "更新資料錯誤: " . $conn->error,
    ];
    $_SESSION["requestInventory"] = $data;
    // echo "更新資料錯誤: " . $conn->error;
   }


   $conn->close();
   header("Location:orderdetail.php?id=$id")
?>