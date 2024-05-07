<?php
require_once("../config/dbConnect.php");

var_dump($_POST);
$name = $_POST["name"];
$brand_id = $_POST['brand_id'];
$nib_id = $_POST['nib_id'];
$color = $_POST['color'];
$price = $_POST['price'];
$image = $_FILES['image']['name'];

$sql = "SELECT brand_name FROM brand WHERE id=$brand_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$brand_name = $row["brand_name"];
// if(isset($_GET["brand_id"])){
//     $brand_id=$_GET["brand_id"];
//     $sql = "SELECT fountain_pen.*
//     JOIN brand ON fountain_pen.brand_id = brand.id
//     WHERE brand_id=$brand_id";
// }

move_uploaded_file($_FILES['image']['tmp_name'], "./image/" . $brand_name . "/" . $_FILES['image']['name']);
$sql = "INSERT INTO fountain_pen (name, brand_id, nib_id,color,price,image) 
VALUES ('$name', '$brand_id', '$nib_id', '$color', '$price', '$image')";

if ($conn->query($sql) === TRUE) {
    echo "新資料輸入成功";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

header("Location: ./tables.php");
