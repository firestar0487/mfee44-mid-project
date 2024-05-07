<?php
require_once("../config/dbConnect.php");


if (isset($_GET["id"])) {
  $id = $_GET["id"];
} else {
  $id = "1";
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

?>


<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
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
            <form action="course-do-update.php" method="post">
              <div class="d-flex justify-content-center">
                <?php if ($rows[0]["valid"] == 1) : ?>
                  <a class="btn btn-primary mb-3 text-center" href="course.php"><i class="fa-solid fa-arrow-left"></i> 返回</a>
                <?php else : ?>
                  <a class="btn btn-primary mb-3 text-center" href="course-unlisted.php"><i class="fa-solid fa-arrow-left"></i> 返回</a>
                <?php endif; ?>
              </div>

              <div class="card shadow " style="width: 35rem;margin:auto;">
                <div class="ratio ratio-16x9">
                  <img src="./image/<?php echo $rows[0]["image"] ?>" class="card-img-top" style="object-fit:cover; width:100%">
                </div>
                <div class="card-body">
                  <div class="m-1">
                    <label class="form-label">課程名稱</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $rows[0]["name"] ?>" readonly>
                  </div>
                  <div class="row">
                    <div class="col-2 m-1">
                      <label class="form-label">ID</label>
                      <input type="text" class="form-control" id="id" name="id" value="<?php echo $rows[0]["id"] ?>" readonly>
                    </div>
                    <div class="col-3 m-1">
                      <label class="form-label">狀態</label>
                      <!-- input readonly -->
                      <input type="text" class="form-control" id="state_id" name="state_id" value="<?php echo $rows[0]["state_name"] ?>" readonly>
                    </div>
                    <div class="col-3 m-1">
                      <label class="form-label">老師</label>
                      <input type="text" class="form-control" id="teacher_id" name="teacher_id" value="<?php echo $rows[0]["teacher_name"] ?>" readonly>
                    </div>
                    <div class="col-3 m-1">
                      <label class="form-label">類別</label>
                      <input type="text" class="form-control" id="category_id" name="category_id" value="<?php echo $rows[0]["category_name"] ?>" readonly>
                    </div>
                  </div>
                  <div class="m-1">
                    <label class="form-label">關於</label>
                    <textarea class="form-control" id="about" rows="4" name="about" readonly><?php echo $rows[0]["about"] ?></textarea>
                  </div>
                  <div class="row">
                    <div class="col-4 m-1">
                      <label class="form-label">價錢</label>
                      <input readonly type="text" class="form-control" id="price" value="<?php echo $rows[0]["price"] ?>" name="price" require>
                    </div>
                    <div class="col-3 m-1">
                      <label class="form-label">人數</label>
                      <input readonly type="text" class="form-control" id="num_of_student" value="<?php echo $rows[0]["num_of_student"] ?>" name="num_of_student" require>
                    </div>
                    <div class="col-3 m-1">
                      <label class="form-label">時長(分鐘)</label>
                      <input readonly type="text" class="form-control" id="minute" value="<?php echo $rows[0]["minute"] ?>" name="minute" require>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-5 m-1">
                      <label class="form-label">開課日期</label>
                      <input readonly type="date" class="form-control" id="start_date" value="<?php echo $rows[0]["start_date"] ?>" name="start_date" require>
                    </div>
                    <div class="col-5 m-1">
                      <label class="form-label">結束日期</label>
                      <input readonly type="date" class="form-control" id="end_date" value="<?php echo $rows[0]["end_date"] ?>" name="end_date" readonly>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-5 m-1">
                      <label class="form-label">報名開始日期</label>
                      <input readonly type="date" class="form-control" id="registration_start_date" value="<?php echo $rows[0]["registration_start_date"] ?>" name="registration_start_date" require>
                    </div>
                    <div class="col-5 m-1">
                      <label class="form-label">報名結束日期</label>
                      <input readonly type="date" class="form-control" id="registration_end_date" value="<?php echo $rows[0]["registration_end_date"] ?>" name="registration_end_date" require>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-5 m-1">
                      <label class="form-label">上課時間</label>
                      <input readonly type="time" class="form-control" id="class_time" value="<?php echo $rows[0]["start_time"] ?>" name="start_time" require>
                    </div>
                    <div class="col-5 m-1">
                      <label class="form-label">下課時間</label>
                      <input readonly type="time" class="form-control" id="end_time" value="<?php echo $rows[0]["end_time"] ?>" name="end_time" readonly>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-5 m-1">
                      <label class="form-label">課程圖片</label>
                      <input readonly type="text" class="form-control" id="image" value="<?php echo $rows[0]["image"] ?>" name="image">
                    </div>
                    <div class="col-5 m-1">
                      <label class="form-label">上課地點</label>
                      <input readonly type="text" class="form-control" id="location" value="<?php echo $rows[0]["place_id"] ?>" name="place_id" require>
                    </div>
                  </div>
                  <div class="m-1 my-3">
                    <!-- 連結編輯 -->
                    <a class="btn btn-success" href="course-edit.php?id=<?php echo $rows[0]["id"] ?>">編輯</a>

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

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>







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

</body>

</html>