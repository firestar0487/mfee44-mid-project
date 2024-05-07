<?php
require_once("../db_connect.php");


$sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.id=$id
AND course.valid = 1
";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($rows);
$conn->close();

?>