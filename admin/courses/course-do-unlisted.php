<?php
require_once("../config/dbConnect.php");

if (!isset($_GET["id"])) {
  echo "無法取得id";
  exit();
}
$id = $_GET["id"];
$sql = "UPDATE course SET valid=0, state_id=2 WHERE id=$id";
$conn->query($sql);
$conn->close();
header("Location: ./course.php");
