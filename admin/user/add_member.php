<?php require_once("../config/dbConnect.php");
?>

<!DOCTYPE html>
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
    <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../user/css/style.css">







</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
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






            <!-- 會員管理 -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#users" aria-expanded="true" aria-controls="users">
                    <i class="bi bi-people-fill"></i>
                    <span>會員資料管理</span>
                </a>
                <div id="users" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="members_list.php">會員資料</a>
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
                        <a class="collapse-item" href="＃">所有商品</a>
                    </div>
                </div>
            </li>
            <!-- 訂單管理 -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#order" aria-expanded="true" aria-controls="order">
                    <i class="bi bi-bag-fill"></i>
                    <span>訂單管理</span>
                </a>
                <div id="order" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="＃">訂單列表</a>
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
                        <a class="collapse-item" href="＃">課程清單</a>
                        <a class="collapse-item" href="＃">新增課程</a>
                        <a class="collapse-item" href="＃">下架課程</a>
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
                        <a class="collapse-item" href="＃">所有文章</a>
                        <a class="collapse-item" href="＃">新增文章</a>
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
                        <a class="collapse-item" href="＃">優惠卷列表</a>
                        <a class="collapse-item" href="＃">新增列表</a>
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


            <!-- End of Topbar -->

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

                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- DataTales Example -->
                        <form action="do_add_member.php" method="post">
                            <div class="shadow mb-4 p-4">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="members_list.php">首頁</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">新增會員資訊</li>
                                    </ol>
                                </nav>
                                <div class="form-group mt-3">
                                    <label for="name">姓名</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email">電子郵件</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password">密碼</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="birthday">生日</label>
                                    <input type="date" name="birthday" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="number">電話號碼</label>
                                    <input type="tel" name="number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="address">地址</label>
                                    <input type="text" name="address" class="form-control">
                                </div>
                                <div class="mt-3">
                                    <input type="submit" class="btn btn-primary" name="add_member" value="新增">
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

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