<?php
require_once("../config/dbConnect.php");

if (!isset($_GET["id"])) {
  echo "無法取得id";
  exit();
}
$id = $_GET["id"];
$sql = "DELETE FROM course WHERE id=$id";
$conn->query($sql);
$conn->close();
header("Location: ./course-unlisted.php");
