<?php
require_once("../config/dbConnect.php");


if (!isset($_POST["coupon_name"])) {
    echo "請循正常管道進入此頁";
    exit;
}
$coupon_id = $_POST["coupon_id"];
$coupon_name = $_POST["coupon_name"];
$coupon_valid = $_POST["coupon_valid"];
$discount_type = $_POST["discount_type"];
$discount_value = $_POST["discount_value"];
$max_usage = $_POST["max_usage"];
$price_min = $_POST["price_min"];
$usage_restrictions = $_POST["usage_restrictions"];
$start_at = $_POST["start_at"];
$end_at = $_POST["end_at"];
$updated_at = date('Y-m-d H:i:s');

// if(empty($coupon_name) || empty($coupon_code) || empty($coupon_valid)|| empty($discount_value)|| empty($max_usage) || empty($price_min) || empty($start_at)|| empty($end_at)){
//     echo "請輸入資料";
//     die;
// }

$sql = "UPDATE coupon SET coupon_name='$coupon_name', coupon_valid='$coupon_valid' , discount_type='$discount_type', discount_value='$discount_value', max_usage='$max_usage', price_min='$price_min', usage_restrictions='$usage_restrictions', start_at='$start_at' , end_at='$end_at', updated_at='$updated_at' WHERE coupon_id=$coupon_id";

if ($conn->query($sql) === TRUE) {
    echo "更新成功 ";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

$conn->close();
header("location: coupon-list.php");
