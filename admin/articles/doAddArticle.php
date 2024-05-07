<?php
session_start();
require_once("../config/dbConnect.php");

if (!isset($_POST["title"])) {
    echo "請循正常管道進入";
    die;
};


$title = $_POST["title"];
$description = $_POST["description"];
$category = $_POST["category"];
$author = $_POST["author"];
$status = $_POST["status"];
$content = $_POST["content"];
$publishDate = date("Y-m-d H:i:s");
$createdDate = date("Y-m-d H:i:s");


$filename = $_FILES["img"]["name"] ?: '404.jpg';


if (empty($title) || empty($description) || empty($author)  || empty($status) || empty($filename) || empty($category) || empty($content)) {
    echo "請輸入完所有資料與圖片";
    die;
}

// 圖片上傳 （完成）
if ($_FILES["img"]["error"] == 0) {
    // 獲取文件擴展名
    $ext = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
    // 生成時間戳記文件名
    $timestamp = time();
    $newFilename = "image_" . $timestamp . "." . $ext;
    if (move_uploaded_file($_FILES["img"]["tmp_name"], "images/" .  $newFilename)) {
        // echo "上傳成功" 寫入SQL;
        $filename = $newFilename;
    } else {
        echo "上傳失敗";
    }
}

$sql = "INSERT INTO articles(title,meta_description,author,category_id,content,main_image,publish_date,created_at,status) VALUES('$title','$description','$author','$category','$content','$filename','$publishDate','$createdDate','$status')";

if ($conn->query($sql) === TRUE) {
    echo "新資料輸入完成";
    $last_id = $conn->insert_id;
    $data = [
        "status" => 1,
        "message" => "新增成功<br>最後一筆為序號【" . $last_id . "】",
    ];
    $_SESSION["requestArticle"] = $data;
    // echo "最後一筆為序號" . $last_id;
} else {
    $data = [
        "status" => 0,
        "message" => "新增資料錯誤"
    ];
    $_SESSION["requestArticle"] = $data;
    // echo "新增資料錯誤";
}



$conn->close();
// 提交完資料，回到articles-list頁面查看
header("location: article.php?id=$last_id");


// hashtag （未完成）