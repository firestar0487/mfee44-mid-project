<?php
require_once("dbConnect.php");
$sql="SELECT * FROM articles";
$result=$conn->query($sql);
$rows=$result->fetch_all(MYSQLI_ASSOC);
var_dump($rows);

?>