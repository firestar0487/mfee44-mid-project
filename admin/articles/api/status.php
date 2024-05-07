<?php
require_once("../../config/dbConnect.php");


// 測試api 撈取單個使用者

if (!isset($_POST["id"])) {
    var_dump($_POST["id"]);
    // echo "請循正常管道進入";
    $data = [
        "status" => 0,
        "message" => "請循正常管道進入"
    ];
    echo json_encode($data);
    exit;
}

$id = $_POST["id"];
$status = $_POST["status"];



$sql = "UPDATE articles SET status='$status' WHERE id=$id AND valid=1;";



// 確認是否更新成功
if ($conn->query($sql) === TRUE) {
    $data = [
        "status" => 1,
        "message" => "更改成功"
    ];
    echo json_encode($data);
    exit;
} else {
    // echo "更新資料錯誤: " . $conn->error;
    $data = [
        "status" => 0,
        "message" => "更改失敗" . $conn->error
    ];
    echo json_encode($data);
}

$conn->close();
