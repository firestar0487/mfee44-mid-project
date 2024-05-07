<?php
session_start();
require_once("../config/dbConnect.php");



if (!isset($_POST["id"])) {
    echo "請循正常管道進入此頁";
    exit;
}



$id = $_POST["id"];
$title = $_POST["title"];
$description = $_POST["description"];
$author = $_POST["author"];
$status = $_POST["status"];
$category = $_POST["category"];
$content = $_POST["content"];
$updateDate = date("Y-m-d H:i:s");

// 抓取id的默認圖片
$sqlMainImg = "SELECT main_image FROM articles WHERE valid=1 AND id=$id";
$resultMainImg = $conn->query($sqlMainImg);
$mainImag = $resultMainImg->fetch_assoc();

$filename = $mainImag['main_image']; // 預設為原圖片
$filename = $_FILES["img"]["name"] ?  $_FILES["img"]["name"] : $mainImag['main_image'];



// 圖片上傳 （完成）
if ($_FILES["img"]["error"] == 0) {

    // 獲取文件擴展名
    $ext = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
    // 生成時間戳記文件名
    $timestamp = time();
    $newFilename = "image_" . $timestamp . "." . $ext;
    // 若沒有傳新圖，就默認原來的圖
    $filename = $newFilename;
    if (move_uploaded_file($_FILES["img"]["tmp_name"], "images/" . $newFilename)) {
        // 若沒有傳新圖，就默認原來的圖
        $filename = $newFilename;
    } else {
        echo "上傳失敗";
    }
}


$sql = "UPDATE articles SET title='$title', meta_description='$description', author='$author',status='$status',category_id='$category',content='$content',main_image='$filename',update_date='$updateDate' WHERE id=$id";

// 確認是否更新成功
if ($conn->query($sql) === TRUE) {
    $data = [
        "status" => 1,
        "message" => "修改成功",
    ];
    $_SESSION["requestArticle"] = $data;
    // $_SESSION["requestArticle"] = "更新成功";
} else {
    $data = [
        "status" => 0,
        "message" => "修改失敗",
    ];
    $_SESSION["requestArticle"] = $data;
    // $_SESSION["message"] = "更新資料錯誤: " . $conn->error;
}

$conn->close();
// 處理完畢回到user-list.php
header("location: article.php?id=$id");
