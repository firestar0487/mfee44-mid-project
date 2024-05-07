<?php
require_once("../config/dbConnect.php");


$sqlTotal = "SELECT *,
CASE coupon_valid
    WHEN 1 THEN '已啟用'
    WHEN 0 THEN '已停用'
END AS coupon_status
FROM coupon
WHERE coupon_valid >= 0";

$resultTotal = $conn->query($sqlTotal);
$totalUser = $resultTotal->num_rows;
$perPage = 6;
//無條件進位相除結果, 計算出總頁數
$pageCount = ceil($totalUser / $perPage);


if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT *,
    CASE coupon_valid
        WHEN 1 THEN '已啟用'
        WHEN 0 THEN '已停用'
    END AS coupon_status FROM coupon WHERE (coupon_name LIKE '%$search%' OR usage_restrictions = '$search') AND coupon_valid >= 0";
} elseif (isset($_GET["page"]) && isset($_GET["order"])) {
    $page = $_GET["page"];
    $order = $_GET["order"];
    switch ($order) {
        case 1:
            $orderSql = "coupon_id ASC";

            break;
        case 2:
            $orderSql = "coupon_id DESC";

            break;
        case 3:
            $orderSql = "start_at ASC";

            break;
        case 4:
            $orderSql = "updated_at DESC";

            break;
    }

    $startItem = ($page - 1) * $perPage;

    $sql = "SELECT *,
    CASE coupon_valid
        WHEN 1 THEN '已啟用'
        WHEN 0 THEN '已停用'
    END AS coupon_status FROM coupon WHERE coupon_valid >= 0  ORDER BY $orderSql LIMIT $startItem,$perPage";
} elseif (isset($_GET["status1"])) {
    $couponStatus = $_GET['status1'];

    $sql = "SELECT *,
    CASE coupon_valid
        WHEN 1 THEN '已啟用'
        WHEN 0 THEN '已停用'
    END AS coupon_status FROM coupon WHERE coupon_valid = 1";
} elseif (isset($_GET["status2"])) {
    $couponStatus = $_GET['status2'];

    $sql = "SELECT *,
    CASE coupon_valid
        WHEN 1 THEN '已啟用'
        WHEN 0 THEN '已停用'
    END AS coupon_status FROM coupon WHERE coupon_valid = 0";
} else {
    $page = 1;
    $order = 1;
    $sql = "SELECT *,
    CASE coupon_valid
        WHEN 1 THEN '已啟用'
        WHEN 0 THEN '已停用'
    END AS coupon_status FROM coupon WHERE coupon_valid >= 0  ORDER BY coupon_id ASC LIMIT 0,$perPage";
}

$result = $conn->query($sql);

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
                        <form class="form-inline ml-auto" action="doMemberLogout.php" method="post"> <button type="submit" class="btn btn-danger">登出</button></form>


                    </ul>

                </nav>
                <!-- End of Topbar -->





                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 text-center">優惠券列表</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <?php
                                    $userCount = $result->num_rows;
                                    ?>
                                    <div class="py-2 d-flex justify-content-between align-items-center">
                                        <div><?php
                                                if (isset($_GET["search"])) :
                                                ?>
                                                <a class="btn btn-info text-white" href="coupon-list.php" title="回使用者列表"><i class="fas fa-arrow-circle-left"></i></a>
                                                搜尋<?= $_GET["search"] ?>的結果共 <?= $userCount ?> 筆
                                            <?php
                                                elseif (isset($_GET["status1"]) || isset($_GET["status2"])) :
                                            ?>
                                                共 <?= $userCount ?> 筆
                                            <?php else : ?>
                                                共 <?= $totalUser ?> 筆
                                            <?php endif;
                                            ?>
                                        </div>
                                        <a class="btn btn-info text-white" href="add-coupon.php" title="新增優惠券"><i class="fas fa-plus-square"></i></a>
                                    </div>
                                    <div class="py-2">
                                        <form action="">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="搜尋名稱或條件" name="search">
                                                <button class="btn btn-info text-white" type="submit" id=""><i class="fas fa-search"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    <?php if (!isset($_GET["search"])) : ?>
                                        <div class="pb-2 d-flex justify-content-end orders">
                                            <div class="btn-group mx-2">
                                                <a class="btn btn-info text-white <?php if ($order == 'all') echo "active" ?>" href="coupon-list.php?status=all">全部 </a>
                                                <a class="btn btn-info text-white <?php if ($order == 'enabled') echo "active" ?>" href="coupon-list.php?status1">已啟用 </a>
                                                <a class="btn btn-info text-white <?php if ($order == 'disabled') echo "active" ?>" href="coupon-list.php?status2">已停用 </a>
                                            </div>

                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="orderDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    排序方式
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="orderDropdown">
                                                    <a class="dropdown-item <?php if ($order == 1) echo "active" ?>" href="coupon-list.php?page=<?= $page ?>&order=1">依ID遞增</a>
                                                    <a class="dropdown-item <?php if ($order == 2) echo "active" ?>" href="coupon-list.php?page=<?= $page ?>&order=2">依ID遞減</a>
                                                    <a class="dropdown-item <?php if ($order == 3) echo "active" ?>" href="coupon-list.php?page=<?= $page ?>&order=3">依優惠開始時間</a>
                                                    <a class="dropdown-item <?php if ($order == 4) echo "active" ?>" href="coupon-list.php?page=<?= $page ?>&order=4">依最後更新時間</a>
                                                </div>
                                            </div>



                                        </div><!-- orders -->
                                    <?php endif; ?>
                                    <div>
                                        <?php
                                        $rows = $result->fetch_all(MYSQLI_ASSOC);
                                        // var_dump($rows);
                                        ?>
                                    </div>
                                    <?php if ($userCount > 0) : ?>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>優惠券名稱</th>
                                                    <th>代碼</th>
                                                    <th>狀態</th>
                                                    <th>折扣方式</th>
                                                    <th>折扣面額</th>
                                                    <th>最低消費金額</th>
                                                    <th>開始日期</th>
                                                    <th>到期日期</th>
                                                    <th>最後更新時間</th>
                                                    <th>可用次數</th>
                                                    <th>使用品牌</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($rows as $row) : ?>
                                                    <tr>
                                                        <td><?= $row["coupon_id"] ?></td>
                                                        <td><?= $row["coupon_name"] ?></td>
                                                        <td><?= $row["coupon_code"] ?></td>
                                                        <td><?= $row["coupon_status"] ?></td>
                                                        <td><?= $row["discount_type"] ?></td>
                                                        <td> <?php
                                                                if ($row["discount_type"] === '百分比') {
                                                                    echo $row["discount_value"] . '%';
                                                                } else {
                                                                    echo $row["discount_value"] . '元';
                                                                }
                                                                ?></td>
                                                        <td><?= $row["price_min"] . ' 元' ?></td>
                                                        <td><?= $row["start_at"] ?></td>
                                                        <td><?= $row["end_at"] ?></td>
                                                        <td><?= $row["updated_at"] ?></td>
                                                        <td><?= $row["max_usage"] ?></td>
                                                        <td><?= $row["usage_restrictions"] ?></td>
                                                        <td>
                                                            <a class="btn btn-info text-white" href="coupon.php?coupon_id=<?= $row["coupon_id"] ?>" title="詳細資料"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                            </tbody>
                                        </table>
                                        <?php if (!isset($_GET["search"]) && !isset($_GET["status1"]) && !isset($_GET["status2"])) : ?>
                                            <div class="py-2">
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination">
                                                        <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                                            <li class="page-item <?php
                                                                                    if ($page == $i) echo "active";
                                                                                    ?>"><a class="page-link" href="coupon-list.php?page=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a></li>
                                                        <?php endfor; ?>
                                                    </ul>
                                                </nav>
                                            </div>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        查無結果
                                    <?php endif; ?>
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