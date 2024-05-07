<?php

require_once("../config/dbConnect.php");


if (!isset($_POST["coupon_name"])) {
    echo "請循正常管道進入";
    die;
}

$coupon_name = $_POST["coupon_name"];
$coupon_code = $_POST["coupon_code"];
$coupon_valid = $_POST["coupon_valid"];
$discount_type = $_POST["discount_type"];
$discount_value = $_POST["discount_value"];
$max_usage = $_POST["max_usage"];
$price_min = $_POST["price_min"];
$usage_restrictions = $_POST["usage_restrictions"];
$start_at = $_POST["start_at"];
$end_at = $_POST["end_at"];
$created_at = date('Y-m-d H:i:s');
$updated_at = date('Y-m-d H:i:s');


$query = "SELECT COUNT(*) FROM coupon WHERE coupon_code = '$coupon_code'";
$result = $conn->query($query);
$count = $result->fetch_assoc()['COUNT(*)'];

if ($count > 0) {
    // 優惠碼存在，可以根據需要進行操作
    echo 'exists';
}

if (empty($coupon_name) || empty($coupon_code) || empty($coupon_valid) || empty($discount_value) || empty($max_usage) || empty($price_min) || empty($start_at) || empty($end_at)) {
    echo "請輸入資料";
    die;
}

$sql = "INSERT INTO coupon(coupon_name, coupon_code, coupon_valid, discount_type, discount_value, max_usage, price_min, usage_restrictions, start_at, end_at, created_at, updated_at)
VALUES ('$coupon_name' , '$coupon_code' , '$coupon_valid', '$discount_type', '$discount_value', '$max_usage', '$price_min', '$usage_restrictions', '$start_at', '$end_at', '$created_at', '$updated_at')";
if ($conn->query($sql) === TRUE) {
    echo "新增資料完成, ";
    $last_id = $conn->insert_id;
    echo "最新一筆為序號" . $last_id;
} else {
    echo "新增資料錯誤: " . $conn->error;
}
$conn->close();
header("location: coupon-list.php");
