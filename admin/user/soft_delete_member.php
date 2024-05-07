<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("../config/dbConnect.php");

if (isset($_GET['id'])) {
    $member_id = $_GET['id'];

    // 假設user表中有一個名為deleted_at的欄位
    $soft_delete_query = "UPDATE `user` SET deleted_at = NOW() WHERE id = $member_id";

    $result = mysqli_query($conn, $soft_delete_query);

    if (!$result) {
        die("軟刪除失敗：" . mysqli_error($conn));
    } else {
        echo "軟刪除成功";

        // 重定向到首頁或其他頁面
        header("Location: members_list.php");
        exit();
    }
}
