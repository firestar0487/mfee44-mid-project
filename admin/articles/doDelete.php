<?php
require_once("../config/dbConnect.php");

session_start();

if (isset($_SESSION['previousUrl'])) {
    $previousUrl = $_SESSION['previousUrl'];
} else {
    $previousUrl = 'articles-list.php';
}


if (!isset($_GET["id"])) {
    echo "請循正常管道進路";
    exit;
}
$id = $_GET["id"];

// 透過valid值去軟刪除
$sql = "UPDATE articles  SET  valid='0' WHERE id=$id";
// echo $sql;
// exit;

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "刪除資料錯誤: " . $conn->error;
}
$conn->close();

header("location:" . $previousUrl);
