<?php
require_once("../config/dbConnect.php");


if (isset($_GET["id"])) {
  $id = $_GET["id"];
} else {
  echo "無法取得id";
  // 跳回course.php
  header("Location: course.php");
}

$sql = "SELECT course.*, teacher.name AS teacher_name, state.name AS state_name, category.name AS category_name FROM course
  JOIN teacher ON teacher.id = course.teacher_id
  JOIN state ON state.id = course.state_id
  JOIN category ON category.id = course.category_id
  WHERE course.id=$id
  ";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
// print_r($rows[0]["name"]);

$state_sql = "SELECT * FROM state";
$state_result = $conn->query($state_sql);
$state_rows = $state_result->fetch_all(MYSQLI_ASSOC);

$category_sql = "SELECT * FROM category";
$category_result = $conn->query($category_sql);
$category_rows = $category_result->fetch_all(MYSQLI_ASSOC);

$teacher_sql = "SELECT * FROM teacher";
$teacher_result = $conn->query($teacher_sql);
$teacher_rows = $teacher_result->fetch_all(MYSQLI_ASSOC);

if (!isset($_GET["img"])) {
  $img = $rows[0]["image"];
} else {
  $img = $_GET["img"];
}

?>


<!doctype html>
<html lang="en">

<head>
  <title>修改課程</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="">
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
            <div class="error-block text-center" style="position: fixed; top:60%; left:23%;width: 220px;background-color:lightpink; border-radius:10px">

            </div>
            <form action="course-do-update.php" method="post" enctype="multipart/form-data">
              <div class="d-flex justify-content-center">
                <div class="d-flex align-items-center">
                  <a class="btn btn-primary mb-2" href="course-info.php?id=<?= $rows[0]["id"] ?>"><i class="fa-solid fa-arrow-left" title="返回"></i></a>
                </div>
                <h1>
                  修改課程：
                  <?php echo $rows[0]["name"] ?>
                </h1>
              </div>

              <div class="card shadow" style="width: 35rem;margin:auto;">
                <div class="ratio ratio-16x9">
                  <img id="preview" src="./image/<?php echo $img ?>" class="card-img-top" style="object-fit:cover; width:100%">
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-5 m-1">
                      <label class="form-label">課程圖片</label>
                      <input type="file" class="form-control" id="img" value="<?php echo $rows[0]["image"] ?>" name="image">
                      <!-- old_image post hidden-->
                      <input type="hidden" name="old_image" value="<?php echo $rows[0]["image"] ?>">
                    </div>
                    <div class="col-5 m-1">
                      <label class="form-label">上課地點</label>
                      <input type="text" class="form-control" id="location" value="<?php echo $rows[0]["place_id"] ?>" name="place_id" required>
                    </div>
                  </div>
                  <div class="m-1">
                    <label class="form-label">課程名稱</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $rows[0]["name"] ?>" required>
                  </div>
                  <div class="row">
                    <div class="col-2 m-1">
                      <label class="form-label">ID</label>
                      <input type="text" class="form-control" id="id" name="id" value="<?php echo $rows[0]["id"] ?>" readonly>
                    </div>
                    <div class="col-3 m-1">
                      <label class="form-label">狀態</label>
                      <select class="form-select" name="state_id" id="state_id" aria-label="Default select example">
                        <?php foreach ($state_rows as $state_row) : ?>
                          <option value="<?php echo $state_row["id"] ?>" <?php if ($state_row["id"] == $rows[0]["state_id"]) echo 'selected'; ?>><?php echo $state_row["name"] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-3 m-1">
                      <label class="form-label">老師</label>
                      <select class="form-select" id="teacher_id" name="teacher_id">
                        <?php foreach ($teacher_rows as $teacher_row) : ?>
                          <option value="<?php echo $teacher_row["id"] ?>" <?php if ($teacher_row["id"] == $rows[0]["teacher_id"]) echo 'selected'; ?>>
                            <?php echo $teacher_row["name"] ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-3 m-1">
                      <label class="form-label">類別</label>
                      <select class="form-select" id="category_id" name="category_id">
                        <?php foreach ($category_rows as $category_row) : ?>
                          <option value="<?php echo $category_row["id"] ?>" <?php if ($category_row["id"] == $rows[0]["category_id"]) echo 'selected'; ?>><?php echo $category_row["name"] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="m-1">
                    <label class="form-label">關於</label>
                    <textarea class="form-control" id="about" rows="4" name="about" required><?php echo $rows[0]["about"] ?></textarea>
                  </div>
                  <div class="row">
                    <div class="col-4 m-1">
                      <label class="form-label">價錢</label>
                      <input type="text" class="form-control" id="price" value="<?php echo $rows[0]["price"] ?>" name="price" pattern="^([1-9][0-9]{0,4}|100000)$" placeholder="1~100000" required>
                    </div>
                    <div class="col-3 m-1">
                      <label class="form-label">人數</label>
                      <input type="text" class="form-control" id="num_of_student" value="<?php echo $rows[0]["num_of_student"] ?>" name="num_of_student" pattern="^([1-9][0-9]|100)$" placeholder="10~100" required>
                    </div>
                    <div class="col-3 m-1">
                      <label class="form-label">時長(分鐘)</label>
                      <input type="text" class="form-control" id="minute" value="<?php echo $rows[0]["minute"] ?>" name="minute" pattern="^([6-9][0-9]|[1-2][0-9]{2}|3[0-5][0-9]|360)$" placeholder="60~360" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-5 m-1">
                      <label class="form-label">開課日期</label>
                      <input type="date" class="form-control" id="start_date" value="<?php echo $rows[0]["start_date"] ?>" name="start_date" required>
                    </div>
                    <div class="col-5 m-1">
                      <label class="form-label">結束日期</label>
                      <input type="date" class="form-control" id="end_date" value="<?php echo $rows[0]["end_date"] ?>" name="end_date">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-5 m-1">
                      <label class="form-label">報名開始日期</label>
                      <input type="date" class="form-control" id="registration_start_date" value="<?php echo $rows[0]["registration_start_date"] ?>" name="registration_start_date" required>
                    </div>
                    <div class="col-5 m-1">
                      <label class="form-label">報名結束日期</label>
                      <input type="date" class="form-control" id="registration_end_date" value="<?php echo $rows[0]["registration_end_date"] ?>" name="registration_end_date" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-5 m-1">
                      <label class="form-label">上課時間</label>
                      <input type="time" class="form-control" id="class_time" value="<?php echo $rows[0]["start_time"] ?>" name="start_time" required>
                    </div>
                    <div class="col-5 m-1">
                      <label class="form-label">下課時間</label>
                      <input type="time" class="form-control" id="end_time" value="<?php echo $rows[0]["end_time"] ?>" name="end_time" readonly>
                    </div>
                  </div>

                  <div class="m-1 my-3 ">
                    <input id="edit-button" class="btn btn-success " type="submit" value="確認修改">
                    <a class="btn btn-danger  ms-2" href="course.php">取消</a>
                  </div>
                </div>

              </div>
            </form>
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

  <script>
    document.getElementById('img').addEventListener('change', function(e) {
      var file = e.target.files[0];
      var reader = new FileReader();

      reader.onloadend = function() {
        document.getElementById('preview').src = reader.result;
      }

      if (file) {
        reader.readAsDataURL(file);
      } else {
        document.getElementById('preview').src = "";
      }
    });

    let start_date = document.getElementById('start_date').value;
    let end_date = document.getElementById('end_date').value;
    let registration_start_date = document.getElementById('registration_start_date').value;
    let registration_end_date = document.getElementById('registration_end_date').value;
    let class_time = document.getElementById('class_time').value;
    let end_time = document.getElementById('end_time').value;
    let minute = document.getElementById('minute').value;
    addErrorBlock();
    // 在class error-block裡面加入錯誤訊息
    function addErrorBlock(error) {
      let errorBlock = document.querySelector('.error-block');
      let editButton = document.getElementById('edit-button');
      errorText = "";
      let errorMsgs = [{
          condition: start_date > end_date,
          msg: "<span style='color: red;'>*開課日期>結束日期</span><br>"
        },
        {
          condition: registration_start_date > registration_end_date,
          msg: "<span style='color: red;'>*報名開始日期>報名結束日期</span><br>"
        },
        {
          condition: registration_end_date > start_date,
          msg: "<span style='color: red;'>*報名結束日期>開課日期</span><br>"
        },
        {
          condition: registration_start_date > start_date,
          msg: "<span style='color: red;'>*報名開始日期>開課日期</span><br>"
        },
      ];

      errorMsgs.forEach(errorMsg => {
        if (errorMsg.condition && !errorBlock.innerHTML.includes(errorMsg.msg)) {
          errorText += errorMsg.msg;
        }
      });

      if (errorText != "") {
        errorBlock.style.display = "block";
        errorBlock.style.backgroundColor = "white";
        errorBlock.innerHTML = errorText;
        editButton.disabled = true;
      } else {
        editButton.disabled = false;
        errorBlock.innerHTML = "";
        errorBlock.style.display = "none";
      }
    }
    // input的監聽事件
    document.getElementById('start_date').addEventListener('change', function(e) {
      start_date = e.target.value;
      addErrorBlock();
    });
    document.getElementById('end_date').addEventListener('change', function(e) {
      end_date = e.target.value;
      addErrorBlock();
    });
    document.getElementById('registration_start_date').addEventListener('change', function(e) {
      registration_start_date = e.target.value;
      addErrorBlock();
    });
    document.getElementById('registration_end_date').addEventListener('change', function(e) {
      registration_end_date = e.target.value;
      addErrorBlock();
    });
    document.getElementById('class_time').addEventListener('change', function(e) {
      class_time = e.target.value;
      addErrorBlock();
    });
    document.getElementById('end_time').addEventListener('change', function(e) {
      end_time = e.target.value;
      addErrorBlock();
    });
    

    //下課時間等於上課時間+課程時長
    function setEndTime() {
      let classTime = document.getElementById('class_time');
      let endTime = document.getElementById('end_time');
      let minuteInput = document.getElementById('minute');
      let classTimeHour = parseInt(classTime.value);
      let classTimeMinute = parseInt(classTime.value.substring(3, 5));
      console.log(classTimeHour);
      console.log(classTimeMinute);
      let minuteInputValue = parseInt(minuteInput.value);
      let hour = Math.floor(minuteInputValue / 60); 
      let minute = minuteInputValue % 60;
      

      finalHour=classTimeHour + hour;
      finalMinute=classTimeMinute + minute;

      if(finalMinute>=60){
        finalMinute=finalMinute-60;
        finalHour=finalHour+1;
      }
      if(finalHour>=24){
        finalHour=finalHour-24;
      }
      hour=finalHour.toString().padStart(2, '0');
      minute=finalMinute.toString().padStart(2, '0');

      
      let endTimeValue = hour + ":" + minute + ":00";
      console.log(endTimeValue);
      endTime.value = endTimeValue;
      
    }
    
    document.getElementById('minute').addEventListener('change', function(e) {
      setEndTime();
    });
    document.getElementById('class_time').addEventListener('change', function(e) {
      setEndTime();
    });


  </script>

</body>

</html>