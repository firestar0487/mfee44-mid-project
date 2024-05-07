<?php
require_once("../config/dbConnect.php");




// 設定每頁顯示幾筆資料，目前在第幾頁，從第幾筆資料開始
$perPage = 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $perPage;

// 設定排序
$order = isset($_GET["order"]) ? $_GET["order"] : "ASC";
$col = isset($_GET["col"]) ? $_GET["col"] : "id";


// query course_status category start_date end_date 排列組合，產生對應的sql，並計算總筆數
if (isset($_GET["query"]) && isset($_GET["category"]) && isset($_GET["course_status"]) && isset($_GET["start_date"]) && isset($_GET["end_date"])) {
  $query = $_GET["query"];
  $status = $_GET["course_status"];
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  $category = $_GET["category"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值，則開始日期等於現在時間
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  $base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
	JOIN teacher ON teacher.id = course.teacher_id
	JOIN state ON state.id = course.state_id
	JOIN category ON category.id = course.category_id
	WHERE course.name LIKE '%$query%'
	AND course.start_date >= '$start_date'
	AND course.end_date <= '$end_date'
	AND course.category_id = '$category'
	AND course.valid = 1";
  if ($status == "all") {
    $sql = $base_sql . " ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql)->num_rows;
  } else if ($status == "enrolling") {
    $sql = $base_sql . " AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()")->num_rows;
  } else if ($status == "in_progress") {
    $sql = $base_sql . " AND course.start_date <= NOW()
		AND course.end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.start_date <= NOW()
		AND course.end_date >= NOW()")->num_rows;
  } else if ($status == "finished") {
    $sql = $base_sql . " AND course.end_date < NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.end_date < NOW()")->num_rows;
  } else if ($status == "future") {
    $sql = $base_sql . " AND course.registration_start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date > NOW()")->num_rows;
  } else if ($status == "about_to_start") {
    $sql = $base_sql . " AND course.registration_end_date < NOW()
		AND course.start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_end_date < NOW()
		AND course.start_date > NOW()")->num_rows;
  }
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["query"]) && isset($_GET["category"]) && isset($_GET["course_status"])) {
  $query = $_GET["query"];
  $status = $_GET["course_status"];
  $category = $_GET["category"];
  $base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
	JOIN teacher ON teacher.id = course.teacher_id
	JOIN state ON state.id = course.state_id
	JOIN category ON category.id = course.category_id
	WHERE course.name LIKE '%$query%'
	AND course.category_id = '$category'
	AND course.valid = 1";
  if ($status == "all") {
    $sql = $base_sql . " ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql)->num_rows;
  } else if ($status == "enrolling") {
    $sql = $base_sql . " AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()")->num_rows;
  } else if ($status == "in_progress") {
    $sql = $base_sql . " AND course.start_date <= NOW()
		AND course.end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.start_date <= NOW()
		AND course.end_date >= NOW()")->num_rows;
  } else if ($status == "finished") {
    $sql = $base_sql . " AND course.end_date < NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.end_date < NOW()")->num_rows;
  } else if ($status == "future") {
    $sql = $base_sql . " AND course.registration_start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date > NOW()")->num_rows;
  } else if ($status == "about_to_start") {
    $sql = $base_sql . " AND course.registration_end_date < NOW()
		AND course.start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_end_date < NOW()
		AND course.start_date > NOW()")->num_rows;
  }
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["query"]) && isset($_GET["category"]) && isset($_GET["start_date"]) && isset($_GET["end_date"])) {
  $query = $_GET["query"];
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  $category = $_GET["category"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值，則開始日期等於現在時間
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  $base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
	JOIN teacher ON teacher.id = course.teacher_id
	JOIN state ON state.id = course.state_id
	JOIN category ON category.id = course.category_id
	WHERE course.name LIKE '%$query%'
	AND course.start_date >= '$start_date'
	AND course.end_date <= '$end_date'
	AND course.category_id = '$category'
	AND course.valid = 1";
  $sql = $base_sql . " ORDER BY $col $order LIMIT $offset,$perPage";
  $totalRows = $conn->query($base_sql)->num_rows;
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["query"]) && isset($_GET["course_status"]) && isset($_GET["start_date"]) && isset($_GET["end_date"])) {
  $query = $_GET["query"];
  $status = $_GET["course_status"];
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值，則開始日期等
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  $base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
	JOIN teacher ON teacher.id = course.teacher_id
	JOIN state ON state.id = course.state_id
	JOIN category ON category.id = course.category_id
	WHERE course.name LIKE '%$query%'
	AND course.start_date >= '$start_date'
	AND course.end_date <= '$end_date'
	AND course.valid = 1";
  if ($status == "all") {
    $sql = $base_sql . " ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql)->num_rows;
  } else if ($status == "enrolling") {
    $sql = $base_sql . " AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()")->num_rows;
  } else if ($status == "in_progress") {
    $sql = $base_sql . " AND course.start_date <= NOW()
		AND course.end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.start_date <= NOW()
		AND course.end_date >= NOW()")->num_rows;
  } else if ($status == "finished") {
    $sql = $base_sql . " AND course.end_date < NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.end_date < NOW()")->num_rows;
  } else if ($status == "future") {
    $sql = $base_sql . " AND course.registration_start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date > NOW()")->num_rows;
  } else if ($status == "about_to_start") {
    $sql = $base_sql . " AND course.registration_end_date < NOW()
		AND course.start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_end_date < NOW()
		AND course.start_date > NOW()")->num_rows;
  }
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["category"]) && isset($_GET["course_status"]) && isset($_GET["start_date"]) && isset($_GET["end_date"])) {
  $status = $_GET["course_status"];
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  $category = $_GET["category"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值，則開始日期等於現在時間
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  $base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
	JOIN teacher ON teacher.id = course.teacher_id
	JOIN state ON state.id = course.state_id
	JOIN category ON category.id = course.category_id
	WHERE course.start_date >= '$start_date'
	AND course.end_date <= '$end_date'
	AND course.category_id = '$category'
	AND course.valid = 1";
  if ($status == "all") {
    $sql = $base_sql . " ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql)->num_rows;
  } else if ($status == "enrolling") {
    $sql = $base_sql . " AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()")->num_rows;
  } else if ($status == "in_progress") {
    $sql = $base_sql . " AND course.start_date <= NOW()
		AND course.end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.start_date <= NOW()
		AND course.end_date >= NOW()")->num_rows;
  } else if ($status == "finished") {
    $sql = $base_sql . " AND course.end_date < NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.end_date < NOW()")->num_rows;
  } else if ($status == "future") {
    $sql = $base_sql . " AND course.registration_start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date > NOW()")->num_rows;
  } else if ($status == "about_to_start") {
    $sql = $base_sql . " AND course.registration_end_date < NOW()
		AND course.start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_end_date < NOW()
		AND course.start_date > NOW()")->num_rows;
  }
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["query"]) && isset($_GET["category"])) {
  $query = $_GET["query"];
  $category = $_GET["category"];
  $base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
	JOIN teacher ON teacher.id = course.teacher_id
	JOIN state ON state.id = course.state_id
	JOIN category ON category.id = course.category_id
	WHERE course.name LIKE '%$query%'
	AND course.category_id = '$category'
	AND course.valid = 1";
  $sql = $base_sql . " ORDER BY $col $order LIMIT $offset,$perPage";
  $totalRows = $conn->query($base_sql)->num_rows;
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["query"]) && isset($_GET["course_status"])) {
  $query = $_GET["query"];
  $status = $_GET["course_status"];
  $base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
	JOIN teacher ON teacher.id = course.teacher_id
	JOIN state ON state.id = course.state_id
	JOIN category ON category.id = course.category_id
	WHERE course.name LIKE '%$query%'
	AND course.valid = 1";
  if ($status == "all") {
    $sql = $base_sql . " ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql)->num_rows;
  } else if ($status == "enrolling") {
    $sql = $base_sql . " AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()")->num_rows;
  } else if ($status == "in_progress") {
    $sql = $base_sql . " AND course.start_date <= NOW()
		AND course.end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.start_date <= NOW()
		AND course.end_date >= NOW()")->num_rows;
  } else if ($status == "finished") {
    $sql = $base_sql . " AND course.end_date < NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.end_date < NOW()")->num_rows;
  } else if ($status == "future") {
    $sql = $base_sql . " AND course.registration_start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date > NOW()")->num_rows;
  } else if ($status == "about_to_start") {
    $sql = $base_sql . " AND course.registration_end_date < NOW()
		AND course.start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_end_date < NOW()
		AND course.start_date > NOW()")->num_rows;
  }
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["query"]) && isset($_GET["start_date"]) && isset($_GET["end_date"])) {
  $query = $_GET["query"];
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值，則開始日期等於現在時間
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  $base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.name LIKE '%$query%'
AND course.start_date >= '$start_date'
AND course.end_date <= '$end_date'
AND course.valid = 1";
  $sql = $base_sql . " ORDER BY $col $order LIMIT $offset,$perPage";
  $totalRows = $conn->query($base_sql)->num_rows;
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["category"]) && isset($_GET["course_status"])) {
  $status = $_GET["course_status"];
  $category = $_GET["category"];
  $base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.category_id = '$category'
AND course.valid = 1";
  if ($status == "all") {
    $sql = $base_sql . " ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql)->num_rows;
  } else if ($status == "enrolling") {
    $sql = $base_sql . " AND course.registration_start_date <= NOW()
AND course.registration_end_date >= NOW()
ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date <= NOW()
AND course.registration_end_date >= NOW()")->num_rows;
  } else if ($status == "in_progress") {
    $sql = $base_sql . " AND course.start_date <= NOW()
AND course.end_date >= NOW()
ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.start_date <= NOW()
AND course.end_date >= NOW()")->num_rows;
  } else if ($status == "finished") {
    $sql = $base_sql . " AND course.end_date < NOW()
ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.end_date < NOW()")->num_rows;
  } else if ($status == "future") {
    $sql = $base_sql . " AND course.registration_start_date > NOW()
ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date > NOW()")->num_rows;
  } else if ($status == "about_to_start") {
    $sql = $base_sql . " AND course.registration_end_date < NOW()
AND course.start_date > NOW()
ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_end_date < NOW()
AND course.start_date > NOW()")->num_rows;
  }
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["category"]) && isset($_GET["start_date"]) && isset($_GET["end_date"])) {
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  $category = $_GET["category"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值，則開始日期等於現在時間
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  $base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.start_date >= '$start_date'
AND course.end_date <= '$end_date'
AND course.category_id = '$category'
AND course.valid = 1";
  $sql = $base_sql . " ORDER BY $col $order LIMIT $offset,$perPage";
  $totalRows = $conn->query($base_sql)->num_rows;
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["course_status"]) && isset($_GET["start_date"]) && isset($_GET["end_date"])) {
  $status = $_GET["course_status"];
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值，則開始日期等於現在時間
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  $base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.start_date >= '$start_date'
AND course.end_date <= '$end_date'
AND course.valid = 1";
  if ($status == "all") {
    $sql = $base_sql . " ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql)->num_rows;
  } else if ($status == "enrolling") {
    $sql = $base_sql . " AND course.registration_start_date <= NOW()
AND course.registration_end_date >= NOW()
ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date <= NOW()
AND course.registration_end_date >= NOW()")->num_rows;
  } else if ($status == "in_progress") {
    $sql = $base_sql . " AND course.start_date <= NOW()
AND course.end_date >= NOW()
ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.start_date <= NOW()
AND course.end_date >= NOW()")->num_rows;
  } else if ($status == "finished") {
    $sql = $base_sql . " AND course.end_date < NOW()
ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.end_date < NOW()")->num_rows;
  } else if ($status == "future") {
    $sql = $base_sql . " AND course.registration_start_date > NOW()
ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date > NOW()")->num_rows;
  } else if ($status == "about_to_start") {
    $sql = $base_sql . " AND course.registration_end_date < NOW()
AND course.start_date > NOW()
ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_end_date < NOW()
AND course.start_date > NOW()")->num_rows;
  }
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["query"])) {
  $query = $_GET["query"];
  $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.name LIKE '%$query%'
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
  $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'")->num_rows;
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["category"])) {
  $category = $_GET["category"];
  $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.category_id = '$category'
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
  $totalRows = $conn->query("SELECT * FROM course WHERE category_id = '$category'")->num_rows;
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["course_status"])) {
  $status = $_GET["course_status"];
  if ($status == "all") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
    $totalRows = $conn->query("SELECT * FROM course")->num_rows;
    $totalPages = ceil($totalRows / $perPage);
  } else if ($status == "enrolling") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.registration_start_date <= NOW()
AND course.registration_end_date >= NOW()
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
    $totalRows = $conn->query("SELECT * FROM course WHERE registration_start_date <= NOW()
AND registration_end_date >= NOW()")->num_rows;
    $totalPages = ceil($totalRows / $perPage);
  } else if ($status == "in_progress") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.start_date <= NOW()
AND course.end_date >= NOW()
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
    $totalRows = $conn->query("SELECT * FROM course WHERE start_date <= NOW()
AND end_date >= NOW()")->num_rows;
    $totalPages = ceil($totalRows / $perPage);
  } else if ($status == "finished") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.end_date < NOW()
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
    $totalRows = $conn->query("SELECT * FROM course WHERE end_date < NOW()")->num_rows;
    $totalPages = ceil($totalRows / $perPage);
  } else if ($status == "future") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.registration_start_date > NOW()
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
    $totalRows = $conn->query("SELECT * FROM course WHERE registration_start_date > NOW()")->num_rows;
    $totalPages = ceil($totalRows / $perPage);
  } else if ($status == "about_to_start") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
		JOIN teacher ON teacher.id = course.teacher_id
		JOIN state ON state.id = course.state_id
		JOIN category ON category.id = course.category_id
		WHERE course.registration_end_date < NOW()
		AND course.start_date > NOW()
		AND course.valid = 1
		ORDER BY $col $order
		LIMIT $offset,$perPage
		";
    $totalRows = $conn->query("SELECT * FROM course WHERE registration_end_date < NOW()
		AND start_date > NOW()")->num_rows;
    $totalPages = ceil($totalRows / $perPage);
  }
} else if (isset($_GET["start_date"]) && isset($_GET["end_date"])) {
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值，則開始日期等於現在時間
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.start_date >= '$start_date'
AND course.end_date <= '$end_date'
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
  $totalRows = $conn->query("SELECT * FROM course WHERE start_date >= '$start_date'
AND end_date <= '$end_date'")->num_rows;
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["query"]) && isset($_GET["course_status"]) && isset($_GET["category"])) {
  $query = $_GET["query"];
  $status = $_GET["course_status"];
  $category = $_GET["category"];
  $base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
		JOIN teacher ON teacher.id = course.teacher_id
		JOIN state ON state.id = course.state_id
		JOIN category ON category.id = course.category_id
		WHERE course.name LIKE '%$query%'
		AND course.category_id = '$category'
		AND course.valid = 1";
  if ($status == "all") {
    $sql = $base_sql . " ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql)->num_rows;
  } else if ($status == "enrolling") {
    $sql = $base_sql . " AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()")->num_rows;
  } else if ($status == "in_progress") {
    $sql = $base_sql . " AND course.start_date <= NOW()
		AND course.end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.start_date <= NOW()
		AND course.end_date >= NOW()")->num_rows;
  } else if ($status == "finished") {
    $sql = $base_sql . " AND course.end_date < NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.end_date < NOW()")->num_rows;
  } else if ($status == "future") {
    $sql = $base_sql . " AND course.registration_start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date > NOW()")->num_rows;
  } else if ($status == "about_to_start") {
    $sql = $base_sql . " AND course.registration_end_date < NOW()
		AND course.start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_end_date < NOW()
		AND course.start_date > NOW()")->num_rows;
  }
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["query"]) && isset($_GET["course_status"]) && isset($_GET["start_date"]) && isset($_GET["end_date"]) && isset($_GET["category"])) {
  $query = $_GET["query"];
  $status = $_GET["course_status"];
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  $category = $_GET["category"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值，則開始日期等於現在時間
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  $base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
		JOIN teacher ON teacher.id = course.teacher_id
		JOIN state ON state.id = course.state_id
		JOIN category ON category.id = course.category_id
		WHERE course.name LIKE '%$query%'
		AND course.start_date >= '$start_date'
		AND course.end_date <= '$end_date'
		AND course.category_id = '$category'
		AND course.valid = 1";
  if ($status == "all") {
    $sql = $base_sql . " ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql)->num_rows;
  } else if ($status == "enrolling") {
    $sql = $base_sql . " AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()")->num_rows;
  } else if ($status == "in_progress") {
    $sql = $base_sql . " AND course.start_date <= NOW()
		AND course.end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.start_date <= NOW()
		AND course.end_date >= NOW()")->num_rows;
  } else if ($status == "finished") {
    $sql = $base_sql . " AND course.end_date < NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.end_date < NOW()")->num_rows;
  } else if ($status == "future") {
    $sql = $base_sql . " AND course.registration_start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date > NOW()")->num_rows;
  } else if ($status == "about_to_start") {
    $sql = $base_sql . " AND course.registration_end_date < NOW()
		AND course.start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_end_date < NOW()
		AND course.start_date > NOW()")->num_rows;
  }
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["query"]) && isset($_GET["start_date"]) && isset($_GET["end_date"]) && isset($_GET["category"])) {
  $query = $_GET["query"];
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  $category = $_GET["category"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值，則開始日期等於現在時間
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  $base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
		JOIN teacher ON teacher.id = course.teacher_id
		JOIN state ON state.id = course.state_id
		JOIN category ON category.id = course.category_id
		WHERE course.name LIKE '%$query%'
		AND course.start_date >= '$start_date'
		AND course.end_date <= '$end_date'
		AND course.category_id = '$category'
		AND course.valid = 1";
  $sql = $base_sql . " ORDER BY $col $order LIMIT $offset,$perPage";
  $totalRows = $conn->query($base_sql)->num_rows;
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["course_status"]) && isset($_GET["start_date"]) && isset($_GET["end_date"]) && isset($_GET["category"])) {
  $status = $_GET["course_status"];
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  $category = $_GET["category"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  $base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
		JOIN teacher ON teacher.id = course.teacher_id
		JOIN state ON state.id = course.state_id
		JOIN category ON category.id = course.category_id
		WHERE course.start_date >= '$start_date'
		AND course.end_date <= '$end_date'
		AND course.category_id = '$category'
		AND course.valid = 1";
  if ($status == "all") {
    $sql = $base_sql . " ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql)->num_rows;
  } else if ($status == "enrolling") {
    $sql = $base_sql . " AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()")->num_rows;
  } else if ($status == "in_progress") {
    $sql = $base_sql . " AND course.start_date <= NOW()
		AND course.end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.start_date <= NOW()
		AND course.end_date >= NOW()")->num_rows;
  } else if ($status == "finished") {
    $sql = $base_sql . " AND course.end_date < NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.end_date < NOW()")->num_rows;
  } else if ($status == "future") {
    $sql = $base_sql . " AND course.registration_start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_start_date > NOW()")->num_rows;
  } else if ($status == "about_to_start") {
    $sql = $base_sql . " AND course.registration_end_date < NOW()
		AND course.start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query($base_sql . " AND course.registration_end_date < NOW()
		AND course.start_date > NOW()")->num_rows;
  }
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["query"]) && isset($_GET["course_status"]) && isset($_GET["start_date"]) && isset($_GET["end_date"])) {
  $query = $_GET["query"];
  $status = $_GET["course_status"];
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  $base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
		JOIN teacher ON teacher.id = course.teacher_id
		JOIN state ON state.id = course.state_id
		JOIN category ON category.id = course.category_id
		WHERE course.name LIKE '%$query%'
		AND course.start_date >= '$start_date'
		AND course.end_date <= '$end_date'
		AND course.valid = 1";
  if ($status == "all") {
    $sql = $base_sql . " ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
		AND start_date >= '$start_date'
		AND end_date <= '$end_date'")->num_rows;
  } else if ($status == "enrolling") {
    $sql = $base_sql . " AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
		AND start_date >= '$start_date'
		AND end_date <= '$end_date'
		AND registration_start_date <= NOW()
		AND registration_end_date >= NOW()")->num_rows;
  } else if ($status == "in_progress") {
    $sql = $base_sql . " AND course.start_date <= NOW()
		AND course.end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
		AND start_date >= '$start_date'
		AND end_date <= '$end_date'
		AND start_date <= NOW()
		AND end_date >= NOW()")->num_rows;
  } else if ($status == "finished") {
    $sql = $base_sql . " AND course.end_date < NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
		AND start_date >= '$start_date'
		AND end_date <= '$end_date'
		AND end_date < NOW()")->num_rows;
  } else if ($status == "future") {
    $sql = $base_sql . " AND course.registration_start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
		AND start_date >= '$start_date'
		AND end_date <= '$end_date'
		AND registration_start_date > NOW()")->num_rows;
  } else if ($status == "about_to_start") {
    $sql = $base_sql . " AND course.registration_end_date < NOW()
		AND course.start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
		AND start_date >= '$start_date'
		AND end_date <= '$end_date'
		AND registration_end_date < NOW()
		AND start_date > NOW()")->num_rows;
  }
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["query"]) && isset($_GET["course_status"]) && isset($_GET["category"])) {
  $query = $_GET["query"];
  $status = $_GET["course_status"];
  $category = $_GET["category"];
  $base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
		JOIN teacher ON teacher.id = course.teacher_id
		JOIN state ON state.id = course.state_id
		JOIN category ON category.id = course.category_id
		WHERE course.name LIKE '%$query%'
		AND course.category_id = '$category'
		AND course.valid = 1";
  if ($status == "all") {
    $sql = $base_sql . " ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
		AND category_id = '$category'")->num_rows;
  } else if ($status == "enrolling") {
    $sql = $base_sql . " AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
		AND category_id = '$category'
		AND registration_start_date <= NOW()
		AND registration_end_date >= NOW()")->num_rows;
  } else if ($status == "in_progress") {
    $sql = $base_sql . " AND course.start_date <= NOW()
		AND course.end_date >= NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
		AND category_id = '$category'
		AND start_date <= NOW()
		AND end_date >= NOW()")->num_rows;
  } else if ($status == "finished") {
    $sql = $base_sql . " AND course.end_date < NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
		AND category_id = '$category'
		AND end_date < NOW()")->num_rows;
  } else if ($status == "future") {
    $sql = $base_sql . " AND course.registration_start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
		AND category_id = '$category'
		AND registration_start_date > NOW()")->num_rows;
  } else if ($status == "about_to_start") {
    $sql = $base_sql . " AND course.registration_end_date < NOW()
		AND course.start_date > NOW()
		ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
		AND category_id = '$category'
		AND registration_end_date < NOW()
		AND start_date > NOW()")->num_rows;
  }
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["query"]) && isset($_GET["start_date"]) && isset($_GET["end_date"])) {
  $query = $_GET["query"];
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
		JOIN teacher ON teacher.id = course.teacher_id
		JOIN state ON state.id = course.state_id
		JOIN category ON category.id = course.category_id
		WHERE course.name LIKE '%$query%'
		AND course.start_date >= '$start_date'
		AND course.end_date <= '$end_date'
		AND course.valid = 1
		ORDER BY $col $order
		LIMIT $offset,$perPage
		";
  $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
		AND start_date >= '$start_date'
		AND end_date <= '$end_date'")->num_rows;
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["query"]) && isset($_GET["course_status"])) {
  $query = $_GET["query"];
  $status = $_GET["course_status"];
  $base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.name LIKE '%$query%'
AND course.valid = 1";
  if ($status == "all") {
    $sql = $base_sql . " ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'")->num_rows;
  } else if ($status == "enrolling") {
    $sql = $base_sql . " AND course.registration_start_date <= NOW()
AND course.registration_end_date >= NOW()
ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
AND registration_start_date <= NOW()
AND registration_end_date >= NOW()")->num_rows;
  } else if ($status == "in_progress") {
    $sql = $base_sql . " AND course.start_date <= NOW()
AND course.end_date >= NOW()
ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
AND start_date <= NOW()
AND end_date >= NOW()")->num_rows;
  } else if ($status == "finished") {
    $sql = $base_sql . " AND course.end_date < NOW()
ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
AND end_date < NOW()")->num_rows;
  } else if ($status == "future") {
    $sql = $base_sql . " AND course.registration_start_date > NOW()
ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
AND registration_start_date > NOW()")->num_rows;
  } else if ($status == "about_to_start") {
    $sql = $base_sql . " AND course.registration_end_date < NOW()
AND course.start_date > NOW()
ORDER BY $col $order LIMIT $offset,$perPage";
    $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
AND registration_end_date < NOW()
AND start_date > NOW()")->num_rows;
  }
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["query"]) && isset($_GET["category"])) {
  $query = $_GET["query"];
  $category = $_GET["category"];
  $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.name LIKE '%$query%'
AND course.category_id = '$category'
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
  $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'
AND category_id = '$category'")->num_rows;
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["query"])) {
  $query = $_GET["query"];
  $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.name LIKE '%$query%'
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
  $totalRows = $conn->query("SELECT * FROM course WHERE name LIKE '%$query%'")->num_rows;
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["course_status"]) && isset($_GET["start_date"]) && isset($_GET["end_date"])) {
  $status = $_GET["course_status"];
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  if ($status == "all") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
		JOIN teacher ON teacher.id = course.teacher_id
		JOIN state ON state.id = course.state_id
		JOIN category ON category.id = course.category_id
		WHERE course.start_date >= '$start_date'
		AND course.end_date <= '$end_date'
		AND course.valid = 1
		ORDER BY $col $order
		LIMIT $offset,$perPage
		";
    $totalRows = $conn->query("SELECT * FROM course WHERE start_date >= '$start_date'
		AND end_date <= '$end_date'")->num_rows;
  } else if ($status == "enrolling") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
		JOIN teacher ON teacher.id = course.teacher_id
		JOIN state ON state.id = course.state_id
		JOIN category ON category.id = course.category_id
		WHERE course.start_date >= '$start_date'
		AND course.end_date <= '$end_date'
		AND course.registration_start_date <= NOW()
		AND course.registration_end_date >= NOW()
		AND course.valid = 1
		ORDER BY $col $order
		LIMIT $offset,$perPage
		";
    $totalRows = $conn->query("SELECT * FROM course WHERE start_date >= '$start_date'
		AND end_date <= '$end_date'
		AND registration_start_date <= NOW()
		AND registration_end_date >= NOW()")->num_rows;
  } else if ($status == "in_progress") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
		JOIN teacher ON teacher.id = course.teacher_id
		JOIN state ON state.id = course.state_id
		JOIN category ON category.id = course.category_id
		WHERE course.start_date >= '$start_date'
		AND course.end_date <= '$end_date'
		AND course.start_date <= NOW()
		AND course.end_date >= NOW()
		AND course.valid = 1
		ORDER BY $col $order
		LIMIT $offset,$perPage
		";
    $totalRows = $conn->query("SELECT * FROM course WHERE start_date >= '$start_date'
		AND end_date <= '$end_date'
		AND start_date <= NOW()
		AND end_date >= NOW()")->num_rows;
  } else if ($status == "finished") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
		JOIN teacher ON teacher.id = course.teacher_id
		JOIN state ON state.id = course.state_id
		JOIN category ON category.id = course.category_id
		WHERE course.start_date >= '$start_date'
		AND course.end_date <= '$end_date'
		AND course.end_date < NOW()
		AND course.valid = 1
		ORDER BY $col $order
		LIMIT $offset,$perPage
		";
    $totalRows = $conn->query("SELECT * FROM course WHERE start_date >= '$start_date'
		AND end_date <= '$end_date'
		AND end_date < NOW()")->num_rows;
  } else if ($status == "future") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
		JOIN teacher ON teacher.id = course.teacher_id
		JOIN state ON state.id = course.state_id
		JOIN category ON category.id = course.category_id
		WHERE course.start_date >= '$start_date'
		AND course.end_date <= '$end_date'
		AND course.registration_start_date > NOW()
		AND course.valid = 1
		ORDER BY $col $order
		LIMIT $offset,$perPage
		";
    $totalRows = $conn->query("SELECT * FROM course WHERE start_date >= '$start_date'
		AND end_date <= '$end_date'
		AND registration_start_date > NOW()")->num_rows;
  } else if ($status == "about_to_start") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
		JOIN teacher ON teacher.id = course.teacher_id
		JOIN state ON state.id = course.state_id
		JOIN category ON category.id = course.category_id
		WHERE course.start_date >= '$start_date'
		AND course.end_date <= '$end_date'
		AND course.registration_end_date < NOW()
		AND course.start_date > NOW()
		AND course.valid = 1
		ORDER BY $col $order
		LIMIT $offset,$perPage
		";
    $totalRows = $conn->query("SELECT * FROM course WHERE start_date >= '$start_date'
		AND end_date <= '$end_date'
		AND registration_end_date < NOW()
		AND start_date > NOW()")->num_rows;
  }
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["course_status"]) && isset($_GET["category"])) {
  $status = $_GET["course_status"];
  $category = $_GET["category"];
  if ($status == "all") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.category_id = '$category'
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
    $totalRows = $conn->query("SELECT * FROM course WHERE category_id = '$category'")->num_rows;
  } else if ($status == "enrolling") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.category_id = '$category'
AND course.registration_start_date <= NOW()
AND course.registration_end_date >= NOW()
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
    $totalRows = $conn->query("SELECT * FROM course WHERE category_id = '$category'
AND registration_start_date <= NOW()
AND registration_end_date >= NOW()")->num_rows;
  } else if ($status == "in_progress") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.category_id = '$category'
AND course.start_date <= NOW()
AND course.end_date >= NOW()
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
    $totalRows = $conn->query("SELECT * FROM course WHERE category_id = '$category'
AND start_date <= NOW()
AND end_date >= NOW()")->num_rows;
  } else if ($status == "finished") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.category_id = '$category'
AND course.end_date < NOW()
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
    $totalRows = $conn->query("SELECT * FROM course WHERE category_id = '$category'
AND end_date < NOW()")->num_rows;
  } else if ($status == "future") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.category_id = '$category'
AND course.registration_start_date > NOW()
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
    $totalRows = $conn->query("SELECT * FROM course WHERE category_id = '$category'
AND registration_start_date > NOW()")->num_rows;
  } else if ($status == "about_to_start") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.category_id = '$category'
AND course.registration_end_date < NOW()
AND course.start_date > NOW()
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
    $totalRows = $conn->query("SELECT * FROM course WHERE category_id = '$category'
AND registration_end_date < NOW()
AND start_date > NOW()")->num_rows;
  }
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["course_status"])) {
  $status = $_GET["course_status"];
  if ($status == "all") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
    $totalRows = $conn->query("SELECT * FROM course")->num_rows;
  } else if ($status == "enrolling") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id

WHERE course.registration_start_date <= NOW()
AND course.registration_end_date >= NOW()
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
    $totalRows = $conn->query("SELECT * FROM course
WHERE registration_start_date <= NOW()
AND registration_end_date >= NOW()")->num_rows;
  } else if ($status == "in_progress") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.start_date <= NOW()
AND course.end_date >= NOW()
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
    $totalRows = $conn->query("SELECT * FROM course
WHERE start_date <= NOW()
AND end_date >= NOW()")->num_rows;
  } else if ($status == "finished") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.end_date < NOW()
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
    $totalRows = $conn->query("SELECT * FROM course
WHERE end_date < NOW()")->num_rows;
  } else if ($status == "future") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course

JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id

WHERE course.registration_start_date > NOW()
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
    $totalRows = $conn->query("SELECT * FROM course
WHERE registration_start_date > NOW()")->num_rows;
  } else if ($status == "about_to_start") {
    $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course

JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id

WHERE course.registration_end_date < NOW()
AND course.start_date > NOW()
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
    $totalRows = $conn->query("SELECT * FROM course
WHERE registration_end_date < NOW()
AND start_date > NOW()")->num_rows;
  }
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["start_date"]) && isset($_GET["end_date"]) && isset($_GET["category"])) {
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  $category = $_GET["category"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course

JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id

WHERE course.start_date >= '$start_date'
AND course.end_date <= '$end_date'
AND course.category_id = '$category'
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
  $totalRows = $conn->query("SELECT * FROM course
WHERE start_date >= '$start_date'
AND end_date <= '$end_date'

AND category_id = '$category'")->num_rows;
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["start_date"]) && isset($_GET["end_date"])) {
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course

JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id

WHERE course.start_date >= '$start_date'
AND course.end_date <= '$end_date'
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
  $totalRows = $conn->query("SELECT * FROM course
WHERE start_date >= '$start_date'
AND end_date <= '$end_date'")->num_rows;
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["category"])) {
  $category = $_GET["category"];
  $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course

JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id

WHERE course.category_id = '$category'
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
  $totalRows = $conn->query("SELECT * FROM course
WHERE category_id = '$category'")->num_rows;
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["start_date"])) {
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course

JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id

WHERE course.start_date >= '$start_date'
AND course.end_date <= '$end_date'
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
  $totalRows = $conn->query("SELECT * FROM course
WHERE start_date >= '$start_date'
AND end_date <= '$end_date'")->num_rows;
  $totalPages = ceil($totalRows / $perPage);
} else if (isset($_GET["end_date"])) {
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course

JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id

WHERE course.start_date >= '$start_date'
AND course.end_date <= '$end_date'
AND course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
  $totalRows = $conn->query("SELECT * FROM course
WHERE start_date >= '$start_date'

AND end_date <= '$end_date'")->num_rows;
  $totalPages = ceil($totalRows / $perPage);
} else {
  $sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.valid = 1
ORDER BY $col $order
LIMIT $offset,$perPage
";
  $totalRows = $conn->query("SELECT * FROM course")->num_rows;
  $totalPages = ceil($totalRows / $perPage);
}
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

// $result = $conn->query($sql);
// $rows = $result->fetch_all(MYSQLI_ASSOC);

// 如果有篩選條件，則產生篩選條件的sql字串
$base_sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
JOIN teacher ON teacher.id = course.teacher_id
JOIN state ON state.id = course.state_id
JOIN category ON category.id = course.category_id
WHERE course.valid = 1 AND course.state_id = 1";
if (isset($_GET["query"])) {
  $query = $_GET["query"];
  $base_sql .= " AND course.name LIKE '%$query%'";
}
if (isset($_GET["category"])) {
  $category = $_GET["category"];
  $base_sql .= " AND course.category_id = '$category'";
}
if (isset($_GET["start_date"]) && isset($_GET["end_date"])) {
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  if ($end_date == '') {
    //如果結束日期等於空值，則結束日期沒有限制
    $end_date = date("Y-m-d", strtotime($start_date . "+2 years"));
  } else {
    $end_date = $_GET['end_date'];
  }
  if ($start_date == '') {
    //如果開始日期等於空值
    $start_date = date("Y-m-d");
  }
  if ($start_date > $end_date) {
    header("Location: course.php");
  }
  $base_sql .= " AND course.start_date >= '$start_date'
  AND course.end_date <= '$end_date'";
}

if (isset($_GET["course_status"])) {
  $status = $_GET["course_status"];
  if ($status == "enrolling") {
    $base_sql .= " AND course.registration_start_date <= NOW()
    AND course.registration_end_date >= NOW()";
  } else if ($status == "in_progress") {
    $base_sql .= " AND course.start_date <= NOW()
    AND course.end_date >= NOW()";
  } else if ($status == "finished") {
    $base_sql .= " AND course.end_date < NOW()";
  } else if ($status == "future") {
    $base_sql .= " AND course.registration_start_date > NOW()";
  } else if ($status == "about_to_start") {
    $base_sql .= " AND course.registration_end_date < NOW()
    AND course.start_date > NOW()";
  }
}
$totalRows = $conn->query($base_sql)->num_rows;
$totalPages = ceil($totalRows / $perPage);


?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>課程管理</title>

  <!-- Custom fonts for this template-->
  <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../public/css/sb-admin-2.min.css" rel="stylesheet">
  <?php
  include("./css.php");
  ?>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">


      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../admin.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas  fa-pen-nib "></i>

        </div>
        <div class="sidebar-brand-text mx-3">墨韻雅筆</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">



      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->





      <!-- start copt -->
      <!-- 會員管理 -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#users" aria-expanded="true" aria-controls="users">
          <i class="bi bi-people-fill"></i>
          <span>會員資料管理</span>
        </a>
        <div id="users" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="../../admin/user/members_list.php">會員資料</a>
          </div>
        </div>
      </li>
      <!-- 產品列表 -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product" aria-expanded="true" aria-controls="product">
          <i class="fas fa-fw fa-wrench"></i>
          <span>產品列表</span>
        </a>
        <div id="product" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="../../admin/products/tables.php">所有商品</a>
          </div>
        </div>
      </li>
      <!-- 訂單管理 -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="../inventory/orderlist.php" data-toggle="collapse" data-target="#order" aria-expanded="true" aria-controls="order">
          <i class="bi bi-bag-fill"></i>
          <span>訂單管理</span>
        </a>
        <div id="order" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="../inventory/orderlist.php">訂單列表</a>
          </div>
        </div>
      </li>
      <!-- 課程管理 -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#course" aria-expanded="true" aria-controls="course">
          <i class="bi bi-book-fill"></i>
          <span>課程管理</span>
        </a>
        <div id="course" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="course.php">課程清單</a>
            <a class="collapse-item" href="course-add.php">新增課程</a>
            <a class="collapse-item" href="course-unlisted.php">下架課程</a>
          </div>
        </div>
      </li>
      <!-- 文章管理 -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#article" aria-expanded="true" aria-controls="article">
          <i class="bi bi-bookmarks-fill"></i>
          <span>文章管理</span>
        </a>
        <div id="article" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="../articles/articles-list.php">所有文章</a>
            <a class="collapse-item" href="../articles/add-article.php">新增文章</a>
          </div>
        </div>
      </li>
      <!-- 優惠卷管理 -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#coupon" aria-expanded="true" aria-controls="coupon">
          <i class="bi bi-ticket-perforated-fill"></i>
          <span>優惠卷管理</span>
        </a>
        <div id="coupon" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="../cuppon/coupon-list.php">優惠卷列表</a>
            <a class="collapse-item" href="../cuppon/add-coupon.php">新增優惠券</a>
          </div>
        </div>
      </li>

      <!-- end copy -->

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>


    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow py-2 px-3">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- log out -->
            <form class="form-inline ml-auto" action="doMemberLogout.php" method="post"> <button type="submit" class="btn btn-danger">登出</button></form>


          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="container">
            <div class="d-flex justify-content-between align-items-center">
              <h1 class="my-3 m-auto">課程管理</h1>

            </div>
            <div class="d-flex ms-2">
              <div class="me-2">
                <?php
                $params = $_GET;
                unset($params['query']);
                unset($params['page']);
                $href = "course.php"
                ?>
                <form action="<?= $href ?>" method="get" class="">
                  <div class="input-group mb-3 d-flex align-items-center">
                    <input type="text" name="query" class="border-0 bg-light" placeholder="搜尋關鍵字">
                    <span class="input-group-text ms-1 rounded px-2 py-0"><button type="submit" class="btn p-0 "><i class="fa-solid fa-magnifying-glass fa-sm"></i></button></span>
                    <p class="mb-0 d-inline ms-1">
                      <?php
                      if (isset($_GET["query"])) {
                        if ($_GET["query"] != '') {
                          echo "搜尋結果：" . $_GET["query"] . " ，共有 " . $totalRows . " 筆資料";
                        }
                      }
                      ?>
                    </p>
                    <?php
                    // Add a hidden input field for each $_GET parameter
                    foreach ($params as $key => $value) {
                      echo "<input type='hidden' name='" . htmlspecialchars($key) . "' value='" . htmlspecialchars($value) . "'>";
                    }
                    ?>
                  </div>
                </form>
              </div>
              <div class="" style="width: 110px;">
                <form action="course.php" method="GET" class="d-flex">
                  <?php
                  $status = isset($_GET['course_status']) ? $_GET['course_status'] : 'all';
                  ?>
                  <select name="course_status" id="course_status" class="form-select form-select-sm mt-0" onchange="this.form.submit()">
                    <option value="all" <?php if ($status == 'all') {
                                          echo 'selected';
                                        } ?>>全部狀態</option>
                    <option value="enrolling" <?php if ($status == 'enrolling') {
                                                echo 'selected';
                                              } ?>>報名中</option>
                    <option value="in_progress" <?php if ($status == 'in_progress') {
                                                  echo 'selected';
                                                } ?>>上課中</option>
                    <option value="finished" <?php if ($status == 'finished') {
                                                echo 'selected';
                                              } ?>>已結束</option>
                    <option value="future" <?php if ($status == 'future') {
                                              echo 'selected';
                                            } ?>>未開始</option>
                    <option value="about_to_start" <?php if ($status == 'about_to_start') {
                                                      echo 'selected';
                                                    } ?>>即將開課</option>
                  </select>
                  <?php
                  $params = $_GET;
                  unset($params['course_status']);
                  unset($params['page']);
                  // Add a hidden input field for each $_GET parameter
                  foreach ($params as $key => $value) {
                    echo "<input type='hidden' name='" . htmlspecialchars($key) . "' value='" . htmlspecialchars($value) . "'>";
                  }
                  ?>
                </form>
              </div>
              <div class="ms-2">
                <!--回到course.php的按鈕，只有在get有值的時候顯示 -->
                <?php
                if (isset($_GET["category"]) || isset($_GET["course_status"]) || isset($_GET["query"]) || isset($_GET['start_date']) || isset($_GET['end_date'])) :
                ?>
                  <a href="course.php" class="btn btn-secondary py-1"><i class="fa-solid fa-rotate-left"></i>清空篩選</a>
                <?php endif; ?>
              </div>
            </div>

            <div class="d-flex align-items-baseline ms-2">
              <div class="btn-group me-2" role="group">
                <!-- 如果有query course_status start_date end_date 排列組合，產生對應的href -->
                <?php
                if (isset($_GET["query"])) {
                  $query = $_GET["query"];
                  $query = "&query=" . $query;
                } else {
                  $query = "";
                }
                if (isset($_GET["course_status"])) {
                  $status = $_GET["course_status"];
                  $status = "&course_status=" . $status;
                } else {
                  $status = "";
                }
                if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
                  $start_date = $_GET['start_date'];
                  $end_date = $_GET['end_date'];
                  $start_date = "&start_date=" . $start_date;
                  $end_date = "&end_date=" . $end_date;
                } elseif (isset($_GET['start_date'])) {
                  $start_date = $_GET['start_date'];
                  $start_date = "&start_date=" . $start_date;
                  $end_date = "";
                } elseif (isset($_GET['end_date'])) {
                  $end_date = $_GET['end_date'];
                  $end_date = "&end_date=" . $end_date;
                  $start_date = "";
                } else {
                  $start_date = "";
                  $end_date = "";
                }
                $category = isset($_GET['category']) ? $_GET['category'] : '';
                ?>

                
                <a href="course.php?category=1<?= $query . $status . $start_date . $end_date ?>" class="btn btn-light border-secondary <?php if ($category == '1') echo 'active' ?>">文字</a>
                <a href="course.php?category=2<?= $query . $status . $start_date . $end_date ?>" class="btn btn-light border-secondary <?php if ($category == '2') echo 'active' ?>">繪畫</a>
              </div>
              <form action="course.php" method="get" id="dateForm" style="width: 450px;">
                <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fa-regular fa-calendar-check me-1"></i>開課日期</span>
                  <?php
                  $default_start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
                  ?>
                  <input type="date" class="form-control" name="start_date" onchange="submitForm()" value="<?php echo $default_start_date; ?>">
                  <span class="input-group-text">~</span>
                  <?php
                  $default_end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
                  ?>
                  <input type="date" class="form-control" name="end_date" onchange="submitForm()" value="<?php echo $default_end_date; ?>">
                </div>
                <?php
                $params = $_GET;
                unset($params['start_date']);
                unset($params['end_date']);
                unset($params['page']);
                // Add a hidden input field for each $_GET parameter
                foreach ($params as $key => $value) {
                  echo "<input type='hidden' name='" . htmlspecialchars($key) . "' value='" . htmlspecialchars($value) . "'>";
                }
                ?>
              </form>
              <div class="text-align ms-auto">
                <a class="btn btn-warning me-2" href="course-add.php"><i class="fa-solid fa-plus"></i>新增課程</a>
              </div>
            </div>

            <!-- 如果結束日期小於開始日期，如果結束日期等於空值還不要判斷，顯示錯誤字串，清空value值 -->
            <?php
            if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
              if ($_GET['end_date'] != '') {
                if ($_GET['end_date'] < $_GET['start_date']) {
                  echo "<p class='text-danger'>結束日期不可小於開始日期</p>";
                  $default_end_date = '';
                }
              }
            }

            ?>



            <div class="table-responsive">
              <table class="table ">
                <thead>
                  <?php
                  if (!isset($_GET["page"])) {
                    $page = 1;
                  }
                  if (isset($_GET["order"]) && isset($_GET["col"])) {
                    $order = $_GET["order"];
                    $pre_col = $_GET["col"];
                    if ($order == "DESC") {
                      $order = "ASC";
                    } else {
                      $order = "DESC";
                    }
                  } else {
                    $order = "DESC";
                  }
                  $params = $_GET; // Copy the $_GET array
                  unset($params['page']); // Remove the 'page' parameter
                  unset($params['order']); // Remove the 'order' parameter
                  unset($params['col']); // Remove the 'col' parameter
                  $href = "course.php?" . http_build_query($params); // Build the URL
                  ?>
                  <tr class="text-nowrap">
                    <th>
                    <th class="align-middle">ID
                      <a href="<?= $href ?>&page=<?= $page ?>&order=<?= $order ?>&col=id" class="btn"><i class="fa-solid fa-up-down"></i></a>

                    </th>
                    <th class="align-middle">狀態</th>
                    <th class="align-middle">名稱</th>
                    <th class="align-middle">老師</th>
                    <th class="align-middle">類別</th>
                    <th class="align-middle">時長
                      <a href="<?= $href ?>&page=<?= $page ?>&order=<?= $order ?>&col=minute" class="btn"><i class="fa-solid fa-up-down"></i></a>
                    </th>
                    <th class="align-middle">價錢
                      <a href="<?= $href ?>&page=<?= $page ?>&order=<?= $order ?>&col=price" class="btn"><i class="fa-solid fa-up-down"></i></a>
                    </th>
                    <th class="align-middle">人數
                      <a href="<?= $href ?>&page=<?= $page ?>&order=<?= $order ?>&col=num_of_student" class="btn"><i class="fa-solid fa-up-down"></i></a>
                    </th>
                    <th class="align-middle">開課日期
                      <a href="<?= $href ?>&page=<?= $page ?>&order=<?= $order ?>&col=start_date" class="btn"><i class="fa-solid fa-up-down"></i></a>
                    </th>
                    <th class="align-middle">報名日期
                      <a href="<?= $href ?>&page=<?= $page ?>&order=<?= $order ?>&col=registration_start_date" class="btn"><i class="fa-solid fa-up-down"></i></a>
                    </th>
                    <th>
                    <th class="align-middle">資訊</th>
                    </th>

                    <th class="align-middle">
                      <a href="course-unlisted.php" class="btn btn-danger " title="所有下架課程"><i class="fa-solid fa-list-ul"></i></a>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($rows as $row) : ?>
                    <tr>
                      <td></td>
                      <td class="align-middle"><?= $row["id"] ?></td>
                      <td class="align-middle">
                        <?php
                        // 1.報名中 2.上課中 3.已結束 4.未開始 5.等待開課
                        //如果現在時間大於報名開始時間，小於報名結束時間，則為報名中
                        //如果現在時間大於開課時間，小於結束時間，則為上課中
                        //如果現在時間大於結束時間，則為已結束
                        //如果現在時間小於報名開始時間，則為未開始
                        //如果現在時間大於報名結束時間，小於開課時間，則為等待開課
                        $now = date("Y-m-d H:i:s");
                        $registration_start_date = $row["registration_start_date"];
                        $registration_end_date = $row["registration_end_date"];
                        $start_date = $row["start_date"];
                        $end_date = $row["end_date"];
                        if ($now >= $registration_start_date && $now <= $registration_end_date) {
                          echo "<span class='badge bg-success'>報名中</span>";
                        } elseif ($now >= $start_date && $now <= $end_date) {
                          echo "<span class='badge bg-primary'>上課中</span>";
                        } elseif ($now > $end_date) {
                          echo "<span class='badge bg-secondary'>已結束</span>";
                        } elseif ($now < $registration_start_date) {
                          echo "<span class='badge bg-warning'>未開始</span>";
                        } elseif ($now > $registration_end_date && $now < $start_date) {
                          echo "<span class='badge bg-info'>即將開課</span>";
                        }
                        ?>
                      </td>
                      <td class="align-middle"><?= $row["name"] ?></td>
                      <td class="align-middle"><?= $row["teacher_name"] ?></td>
                      <td class="align-middle"><?= $row["category_name"] ?></td>
                      <td class="align-middle"><?= $row["minute"] ?>分鐘</td>
                      <td class="align-middle">$<?= $row["price"] ?></td>
                      <td class="align-middle">
                        <?= $row["num_of_student"] ?>人
                      </td>
                      <td class="align-middle">
                        <?= $row["start_date"] ?><br>
                        <?= $row["end_date"] ?>
                      </td>
                      <td class="align-middle">
                        <?= $row["registration_start_date"] ?><br>
                        <?= $row["registration_end_date"] ?>
                      </td>
                      <td>
                      <td class="align-middle">
                        <a href="course-info.php?id=<?= $row["id"] ?>" class="btn btn-info"><i class="fa-solid fa-info"></i></a>
                      </td>

                      <td class="align-middle">
                        <a href="course-do-unlisted.php?id=<?= $row["id"] ?>" title="下架課程" class="btn btn-danger"><i class="fa-solid fa-arrow-right-to-bracket fa-rotate-90"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>

              <!--產生對應的href -->
              <?php
              $params = $_GET;
              unset($params['page']);
              $href = "course.php?" . http_build_query($params)
              ?>
              <!-- 產生pagination -->
              <?php if ($totalPages > 1) : ?>
                <nav>
                  <ul class="pagination justify-content-center">
                    <li class="page-item">
                      <?php
                      $prevPage = $page - 1;
                      if ($prevPage < 1) {
                        $prevPage = 1;
                      }
                      ?>
                      <a class="page-link" href="<?= $href ?>&page=<?php echo $prevPage; ?>">Previous</a>
                    </li>

                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                      <li class="page-item <?php if ($page == $i) echo 'active' ?>"><a class="page-link" href="<?= $href ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php endfor; ?>

                    <li class="page-item">
                      <?php
                      $nextPage = $page + 1;
                      if ($nextPage > $totalPages) {
                        $nextPage = $totalPages;
                      }
                      ?>
                      <a class="page-link" href="<?= $href ?>&page=<?php echo $nextPage; ?>">Next</a>
                    </li>
                  </ul>
                </nav>
              <?php endif; ?>
            </div>
          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->



    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="../public/vendor/jquery/jquery.min.js"></script>
  <script src="../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../public/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../public/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../public/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../public/js/demo/chart-area-demo.js"></script>
  <script src="../public/js/demo/chart-pie-demo.js"></script>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    function submitForm() {
      document.getElementById('dateForm').submit();
    }
  </script>

</body>

</html>