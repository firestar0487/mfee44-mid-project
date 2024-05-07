<?php
require_once("../config/dbConnect.php");


if (!isset($_GET["coupon_id"])) {
    echo "請循正常管道進入此頁";
    exit;
}

$coupon_id = $_GET["coupon_id"];

$sql = "UPDATE coupon SET coupon_valid='-1' WHERE coupon_id=$coupon_id";
// echo $sql;
// exit;

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

$conn->close();

header("location:coupon-list.php");
