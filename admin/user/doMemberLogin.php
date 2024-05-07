<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once("../config/dbConnect.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $account = $_POST["account"];
    $password = $_POST["password"];

    // 在 PHP 中使用 SHA2 函數進行密碼哈希
    $hashed_password = hash('sha256', $password);

    $sql = "SELECT * FROM administrator WHERE account = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $account, $hashed_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['account'] = $account;
        header("Location: members_list.php");
        exit();
    } else {
        echo 'Login failed';
    }

    $stmt->close();
}

$conn->close();
