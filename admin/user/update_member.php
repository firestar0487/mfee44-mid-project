<?php
// update_member.php
require_once("../config/dbConnect.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 確保你有收到會員ID和其他需要更新的資料
    $member_id = $_POST['id'];
    $new_password = $_POST['password'];
    $new_number = $_POST['number'];
    $new_address = $_POST['address'];

    // 執行更新資料的 SQL 查詢
    $query = "UPDATE `user` SET password = '$new_password', number = '$new_number', address = '$new_address' WHERE id = $member_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>alert("資料更新成功。");</script>';
        echo '<script>window.history.go(-1);</script>';
        exit();
    } else {
        echo "資料更新失敗：" . mysqli_error($conn);
    }
} else {
    echo "無效的請求方法。";
}
