<?php
// member_details.php
require_once("../config/dbConnect.php");


// 檢查是否收到會員ID
if (isset($_GET['id'])) {
    $member_id = $_GET['id'];

    // 使用會員ID查詢會員詳細資訊
    $query = "SELECT * FROM `user` WHERE id = $member_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // 如果查詢成功，顯示會員詳細資訊
        if ($row = mysqli_fetch_assoc($result)) {
?>
            <!DOCTYPE html>
            <html lang="en">
            <html lang="en">

            <head>

                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <meta name="description" content="">
                <meta name="author" content="">

                <title>墨韻雅筆</title>

                <!-- Custom fonts for this template -->
                <link href="../public/css/sb-admin-2.css" rel="stylesheet" type="text/css">
                <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

                <!-- Custom styles for this template -->
                <link href="../public/css/sb-admin-2.min.css" rel="stylesheet">
                <!-- Custom styles for this page -->
                <link href="../public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
                <link rel="stylesheet" href="../user/css/style.css">
                <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
               
              


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
                                    <a class="collapse-item" href="../courses/course.php">課程清單</a>
                                    <a class="collapse-item" href="../courses/course-add.php">新增課程</a>
                                    <a class="collapse-item" href="../courses/course-unlisted.php">下架課程</a>
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
                        <!-- Content Wrapper -->
                        <div id="content-wrapper" class="d-flex flex-column">

                            <!-- Main Content -->
                            <div id="content">
                                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                                    <!-- 左側 Navbar 部分 -->
                                    <!-- ... -->


                                    <ul class="navbar-nav ml-auto">

                                        <li class="nav-item">
                                            <span class="nav-link text-warning">歡迎，<?php echo $username; ?></span>
                                        </li>
                                        <li class="nav-item">
                                            <form class="form-inline ml-auto" action="doMemberLogout.php" method="post">
                                                <button type="submit" class="btn btn-danger">登出</button>
                                            </form>
                                        </li>
                                    </ul>
                                </nav>
                                <div class="container-fluid">
                                    <div class="shadow mb-4">
                                        <div class="card">
                                            <div class="card-header py-3 d-flex justify-content-between">
                                                <nav aria-label="breadcrumb">
                                                    <ol class="breadcrumb m-0">
                                                        <li class="breadcrumb-item"><a href="members_list.php">首頁</a></li>
                                                        <li class="breadcrumb-item active" aria-current="page">會員詳細資訊</li>
                                                    </ol>
                                                </nav>
                                            </div>
                                            <div class="card-body">
                                                <div class="container mt-4">
                                                    <h2 class="mb-4">會員詳細資訊</h2>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <p class="card-text"><strong>ID:</strong> <?php echo $row['id']; ?></p>
                                                                    <p class="card-text"><strong>姓名:</strong> <?php echo $row['name']; ?></p>
                                                                    <p class="card-text"><strong>電子郵件:</strong> <?php echo $row['email']; ?></p>
                                                                    <p class="card-text"><strong>密碼:</strong> <?php echo $row['password']; ?></p>
                                                                    <p class="card-text"><strong>生日:</strong> <?php echo $row['birthday']; ?></p>
                                                                    <p class="card-text"><strong>電話號碼:</strong> <?php echo $row['number']; ?></p>
                                                                    <p class="card-text"><strong>地址:</strong> <?php echo $row['address']; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <!-- 在 member_details.php 中 -->
                                                            <a href="edit_member.php?id=<?php echo $member_id; ?>" class="btn btn-warning mt-3">修改資料</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <footer class="sticky-footer bg-white">
                                    <div class="container my-auto">
                                        <div class="copyright text-center my-auto">
                                            <span>Copyright &copy; Your Website 2020</span>
                                        </div>
                                    </div>
                                </footer>
                                <!-- End of Footer -->

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
    <script src="../public/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../public/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../public/js/demo/datatables-demo.js"></script>


            </body>

            </html>
<?php
        } else {
            echo "找不到該會員的詳細資訊。";
        }
    } else {
        echo "查詢失敗：" . mysqli_error($conn);
    }
} else {
    echo "缺少會員ID。";
}
?>