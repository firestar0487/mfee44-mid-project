<?php
require_once("../config/dbConnect.php");

var_dump($_GET);

$id = intval($_GET["id"]);

$sql = "UPDATE fountain_pen SET valid=0 WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "更新成功";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

header("Location: tables.php");
