<?php
$servername = "localhost";
$username = "O3ndlnosm";
$password = "zpg5jIVey";
$database = "sql-project";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
