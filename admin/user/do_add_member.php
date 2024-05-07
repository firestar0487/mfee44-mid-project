<?php
require_once("../config/dbConnect.php");

if (isset($_POST['add_member'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birthday = $_POST['birthday'];
    $number = $_POST['number'];
    $address = $_POST['address'];

    if ($name == "" || empty($name)) {
        header('location:add_member.php?message=You need to fill in the first name');
    } else {
        $query = "insert into `user` (`name`, `email`, `password`, `birthday`, `number`, `address`)
            values ('$name', '$email', '$password', '$birthday', '$number', '$address')";


        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query Failed" . mysqli_error($conn));
        } else {
            echo "<script>alert('新增會員資料成功'); window.location='add_member.php';</script>";
        }
    }
}
