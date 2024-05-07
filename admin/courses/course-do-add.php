<?php
require_once("../config/dbConnect.php");


// 判斷少了哪些欄位
if (!isset($_POST["id"])) {
  echo "無法取得id";
} elseif (!isset($_POST["name"])) {
  echo "無法取得name";
} elseif (!isset($_POST["state_id"])) {
  echo "無法取得state_id";
} elseif (!isset($_POST["category_id"])) {
  echo "無法取得category_id";
} elseif (!isset($_POST["teacher_id"])) {
  echo "無法取得teacher_id";
} elseif (!isset($_POST["about"])) {
  echo "無法取得about";
} elseif (!isset($_POST["image"])) {
  echo "無法取得image";
} elseif (!isset($_POST["minute"])) {
  echo "無法取得minute";
} elseif (!isset($_POST["num_of_student"])) {
  echo "無法取得num_of_student";
} elseif (!isset($_POST["price"])) {
  echo "無法取得price";
} elseif (!isset($_POST["start_date"])) {
  echo "無法取得start_date";
} elseif (!isset($_POST["end_date"])) {
  echo "無法取得end_date";
} elseif (!isset($_POST["registration_start_date"])) {
  echo "無法取得registration_start_date";
} elseif (!isset($_POST["registration_end_date"])) {
  echo "無法取得registration_end_date";
} elseif (!isset($_POST["start_time"])) {
  echo "無法取得start_time";
} elseif (!isset($_POST["end_time"])) {
  echo "無法取得end_time";
} elseif (!isset($_POST["place_id"])) {
  echo "無法取得place_id";
}


  $id = $_POST["id"];
  $name = $_POST["name"];
  $state_id = $_POST["state_id"];
  $category_id = $_POST["category_id"];
  $teacher_id = $_POST["teacher_id"];
  $about = $_POST["about"];
  $image = $_FILES['image']['name'];
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

$sql = "INSERT INTO course (id, name, state_id, category_id, teacher_id, about, image, minute, num_of_student, price, start_date, end_date, registration_start_date, registration_end_date, start_time, end_time, place_id,valid) VALUES ('$id', '$name', '$state_id', '$category_id', '$teacher_id', '$about', '$image', '$minute', '$num_of_student', '$price', '$start_date', '$end_date', '$registration_start_date', '$registration_end_date', '$start_time', '$end_time', '$place_id',$valid)";

if ($conn->query($sql)) {
  header("Location: ./course.php");
} else {
  echo "failed, sql: $sql";
}
