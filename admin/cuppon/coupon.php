<?php
if (!isset($_GET["coupon_id"])) {
    header("location: coupon-list.php");
}

$coupon_id = $_GET["coupon_id"];

require_once("../config/dbConnect.php");

$sql = "SELECT *,
CASE coupon_valid
    WHEN 1 THEN '已啟用'
    WHEN 0 THEN '已停用'
END AS coupon_status FROM coupon WHERE coupon_id=$coupon_id AND coupon_valid >= 0";

$result = $conn->query($sql);
$userCount = $result->num_rows;

$row = $result->fetch_assoc();

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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

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
                        <a class="collapse-item" href="＃">會員資料</a>
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
                        <a class="collapse-item" href="coupon-list.php">優惠卷列表</a>
                        <a class="collapse-item" href="add-coupon.php">新增優惠券</a>
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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 text-center">優惠券詳細資料</h1>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="container-fluid">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <div class="py-2">
                                                    <a class="btn btn-info text-white" href="coupon-list.php" title="回優惠券列表"><i class="fas fa-arrow-circle-left"></i></a>
                                                </div>
                                                <?php if ($userCount == 0) : ?>
                                                    <h1>使用者不存在</h1>
                                                <?php else : ?>
                                                    <table class="table table-bordered">

                                                        <tr>
                                                            <th class="col-6">優惠券名稱</th>
                                                            <td class="col-6"><?= $row["coupon_name"] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>優惠券代碼</th>
                                                            <td><?= $row["coupon_code"] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>優惠券狀態</th>
                                                            <td><?= $row["coupon_status"] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>折扣方式</th>
                                                            <td><?= $row["discount_type"] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>優惠券面額</th>
                                                            <td>
                                                                <?php
                                                                if ($row["discount_type"] === '百分比') {
                                                                    echo $row["discount_value"] . '%';
                                                                } else {
                                                                    echo $row["discount_value"] . '元';
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>創建時間</th>
                                                            <td><?= $row["created_at"] ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th>開始時間</th>
                                                            <td><?= $row["start_at"] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>結束時間</th>
                                                            <td><?= $row["end_at"] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>最後更新時間</th>
                                                            <td><?= $row["updated_at"] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>最低消費金額</th>
                                                            <td><?= $row["price_min"] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>可使用次數</th>
                                                            <td><?= $row["max_usage"] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>優惠券使用品牌</th>
                                                            <td><?= $row["usage_restrictions"] ?></td>
                                                        </tr>
                                                    </table>
                                                    <div class="pb-2">
                                                        <a class="btn btn-info text-white" href="coupon-edit.php?coupon_id=<?= $row["coupon_id"] ?>" title="修改資料"><i class="fas fa-edit"></i></i></a>
                                                    </div>
                                                <?php endif; ?>
                                            </table>
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
                                <span>Copyright &copy; Your Website 2021</span>
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
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/datatables-demo.js"></script>

</body>

</html>