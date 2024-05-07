<?php
// restore_member.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("../config/dbConnect.php");


if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $member_id = $_GET['id'];


    $restore_query = "UPDATE `user` SET deleted_at = NULL WHERE id = $member_id";


    $result = mysqli_query($conn, $restore_query);

    if ($result) {

        header("Location: members_list.php");
        exit();
    } else {

        die("還原失敗：" . mysqli_error($conn));
    }
}
