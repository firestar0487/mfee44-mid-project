<?php
require_once("../config/dbConnect.php");


if (isset($_GET["brand_id"])) {
    $brand_id = $_GET["brand_id"];
    $sql = "SELECT fountain_pen.*, fountain_nib.nib AS fountain_nib, brand.brand_name AS brand_name, color_category.color AS color_name FROM fountain_pen
    JOIN brand ON fountain_pen.brand_id = brand.id
    JOIN fountain_nib ON fountain_pen.nib_id = fountain_nib.id
    JOIN color_category ON fountain_pen.color = color_category.id
    WHERE brand_id=$brand_id AND valid=1";
} elseif (isset($_GET["nib_id"])) {
    $nib_id = $_GET["nib_id"];
    $sql = "SELECT fountain_pen.*, fountain_nib.nib AS fountain_nib, brand.brand_name AS brand_name, color_category.color AS color_name  FROM fountain_pen
    JOIN brand ON fountain_pen.brand_id = brand.id
    JOIN fountain_nib ON fountain_pen.nib_id = fountain_nib.id
    JOIN color_category ON fountain_pen.color = color_category.id
    WHERE nib_id=$nib_id AND valid=1";
} elseif (isset($_GET["color_category"])) {
    $color_category = $_GET["color_category"];
    $sql = "SELECT fountain_pen.*, fountain_nib.nib AS fountain_nib, brand.brand_name AS brand_name, color_category.color AS color_name FROM fountain_pen
    JOIN brand ON fountain_pen.brand_id = brand.id
    JOIN fountain_nib ON fountain_pen.nib_id = fountain_nib.id
    JOIN color_category ON fountain_pen.color = color_category.id
    WHERE fountain_pen.color=$color_category AND valid=1 ";
} else {
    $sql = "SELECT fountain_pen.*, fountain_nib.nib AS fountain_nib, brand.brand_name AS brand_name, color_category.color AS color_name FROM fountain_pen
    JOIN brand ON fountain_pen.brand_id = brand.id
    JOIN fountain_nib ON fountain_pen.nib_id = fountain_nib.id
    JOIN color_category ON fountain_pen.color = color_category.id
    WHERE valid=1";
}

// if{

// }else{
//     $sql = "SELECT fountain_pen.*, brand.brand_name AS brand_name FROM fountain_pen
//     JOIN brand ON fountain_pen.nib_id = nib.id";
// }

$result = $conn->query($sql); // $conn->query($sql);丟出指令 給資料庫, result是儲存結果
$count = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC); //轉換成可用格式
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
    <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <style>
        .object-fit-cover {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .row_buttom {
            display: flex;

        }

        /* .dropdown {
            position: ;
        } */
    </style>

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
                        <form class="form-inline ml-auto" action="doMemberLogout.php" method="post">
                            <button type="submit" class="btn btn-danger">登出</button>
                        </form>





                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">



                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary">產品資料</h4>

                            <div class="row_buttom">
                                <div class="dropdown"><a class="btn btn-secondary" href="tables.php">全部商品</a></div>
                                <div class="dropdown mx-2">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        品牌
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="tables.php?brand_id=1">sheaffer</a>
                                        <a class="dropdown-item" href="tables.php?brand_id=2">pelikan</a>
                                        <a class="dropdown-item" href="tables.php?brand_id=3">montblanc</a>
                                        <a class="dropdown-item" href="tables.php?brand_id=4">PILOT</a>
                                        <a class="dropdown-item" href="tables.php?brand_id=5">WATERMAN</a>
                                        <a class="dropdown-item" href="tables.php?brand_id=6">PARKER</a>
                                        <a class="dropdown-item" href="tables.php?brand_id=7">TWSBI</a>
                                        <a class="dropdown-item" href="tables.php?brand_id=8">LAMY</a>
                                        <a class="dropdown-item" href="tables.php?brand_id=9">KAWECO</a>
                                        <a class="dropdown-item" href="tables.php?brand_id=10">SAILOR</a>
                                    </div>
                                </div>
                                <div class="dropdown mx-2">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        筆尖
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="tables.php?nib_id=1">B</a>
                                        <a class="dropdown-item" href="tables.php?nib_id=2">M</a>
                                        <a class="dropdown-item" href="tables.php?nib_id=3">F</a>
                                        <a class="dropdown-item" href="tables.php?nib_id=4">EF</a>
                                        <a class="dropdown-item" href="tables.php?nib_id=5">MF</a>
                                    </div>
                                </div>
                                <div class="dropdown mx-2">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        顏色
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="tables.php?color_category=1">黑</a>
                                        <a class="dropdown-item" href="tables.php?color_category=2">白</a>
                                        <a class="dropdown-item" href="tables.php?color_category=3">銀</a>
                                        <a class="dropdown-item" href="tables.php?color_category=4">灰</a>
                                        <a class="dropdown-item" href="tables.php?color_category=5">紅</a>
                                        <a class="dropdown-item" href="tables.php?color_category=6">藍灰</a>
                                        <a class="dropdown-item" href="tables.php?color_category=7">棕</a>
                                        <a class="dropdown-item" href="tables.php?color_category=8">紫</a>
                                        <a class="dropdown-item" href="tables.php?color_category=9">淺藍</a>
                                        <a class="dropdown-item" href="tables.php?color_category=10">粉</a>
                                        <a class="dropdown-item" href="tables.php?color_category=11">藍</a>
                                        <a class="dropdown-item" href="tables.php?color_category=12">綠</a>
                                        <a class="dropdown-item" href="tables.php?color_category=13">透明</a>
                                        <a class="dropdown-item" href="tables.php?color_category=14">黑綠</a>
                                        <a class="dropdown-item" href="tables.php?color_category=15">黑紅</a>
                                        <a class="dropdown-item" href="tables.php?color_category=16">黑藍</a>
                                        <a class="dropdown-item" href="tables.php?color_category=17">黑銀</a>
                                        <a class="dropdown-item" href="tables.php?color_category=18">多彩</a>
                                        <a class="dropdown-item" href="tables.php?color_category=19">黑金</a>
                                        <a class="dropdown-item" href="tables.php?color_category=20">金</a>
                                        <a class="dropdown-item" href="tables.php?color_category=21">黃</a>
                                        <a class="dropdown-item" href="tables.php?color_category=22">青銅</a>
                                        <a class="dropdown-item" href="tables.php?color_category=23">黑鉻</a>
                                    </div>




                                </div>
                                <div class="dropdown mx-2"><a class="btn btn-secondary" href="product-add.php">增加商品</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>商品編號</th>
                                            <th>縮圖</th>
                                            <th>品牌</th>
                                            <th>產品名稱</th>
                                            <th>筆尖</th>
                                            <th>顏色</th>
                                            <th>價格</th>
                                            <th>功能</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>商品編號</th>
                                            <th>品牌</th>
                                            <th>產品名稱</th>
                                            <th>價格</th>
                                            <th>功能</th>
                                        </tr>
                                    </tfoot> -->
                                    <tbody>
                                        <?php foreach ($rows as $row) : ?>
                                            <tr>
                                                <td>
                                                    <?= $row["id"] ?>
                                                </td>
                                                <td><img class="object-fit-cover" src="./image/<?= $row["brand_name"] ?>/<?= $row["image"] ?>" alt="">
                                                </td>
                                                <td>
                                                    <?= $row["brand_name"] ?>
                                                </td>
                                                <td>
                                                    <?= $row["name"] ?>
                                                </td>
                                                <td>
                                                    <?= $row["fountain_nib"] ?>
                                                </td>
                                                <td>
                                                    <?= $row["color_name"] ?>
                                                </td>
                                                <td>
                                                    <?= $row["price"] ?>
                                                </td>
                                                <td>
                                                    <!-- <a href="product-info.php?id=<?= $row["id"] ?>">查看</a> -->

                                                    <a class="btn btn-success btn-icon-split mx-2" href="doOnProduct.php?id=<?= $row["id"] ?>">上架</a>
                                                    <a class="btn btn-danger btn-icon-split mx-2" href="doOffProduct.php?id=<?= $row["id"] ?>">下架</a>
                                                    
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

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