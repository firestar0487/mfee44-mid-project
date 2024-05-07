<?php
require_once("../config/dbConnect.php");

if (!isset($_POST["id"])) {
  echo "無法取得id";
  exit();
}

$id = $_POST["id"];
$name = $_POST["name"];
$state_id = $_POST["state_id"];
$category_id = $_POST["category_id"];
$teacher_id = $_POST["teacher_id"];
$about = $_POST["about"];
$image = $_FILES['image']['name'];
$old_image = $_POST["old_image"];
$minute = $_POST["minute"];
$num_of_student = $_POST["num_of_student"];
$price = $_POST["price"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];
$registration_start_date = $_POST["registration_start_date"];
$registration_end_date = $_POST["registration_end_date"];
$start_time = $_POST["start_time"];
$end_time = $_POST["end_time"];
$place_id = $_POST["place_id"];

if ($image == "") {
  $image = $old_image;
}
if ($state_id == 1) {
  $valid = 1;
} else {
  $valid = 0;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $upload_dir = './image/';
    $upload_file = $upload_dir . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
      echo "檔案已成功上傳。";
    } else {
      echo "檔案上傳失敗。";
    }
  } else {
    echo "沒有選擇檔案，或檔案上傳出錯。";
  }
}
$sql = "UPDATE course SET
name='$name',
state_id='$state_id',
category_id='$category_id',
teacher_id='$teacher_id',
about='$about',
image='$image',
minute='$minute',
num_of_student='$num_of_student',
price='$price',
start_date='$start_date',
end_date='$end_date',
registration_start_date='$registration_start_date',
registration_end_date='$registration_end_date',
start_time='$start_time',
end_time='$end_time',
place_id='$place_id',
valid='$valid'
WHERE id='$id'
";
// echo $sql;
$conn->query($sql);
$conn->close();
header("Location: ./course.php");
