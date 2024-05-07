<?php
$servername = "localhost";
$susername = "admin";
$password = "12345";
$dbname = "product";

$conn = new mysqli($servername,$susername,$password,$dbname);

// if ($conn->connect_error) {
//     die("連線失敗" . $conn->connect_error);
// }else{
//     echo "資料庫連線成功";
// }