<?php
session_start();
require_once("../config/dbConnect.php");


$id = $_GET["id"];
$sql = "SELECT orderlist.*, orderliststatus.status FROM orderlist JOIN orderliststatus ON orderlist.order_status = orderliststatus.id WHERE orderlist.id='$id' ";

$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>訂單明細</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Custom fonts for this template -->
    <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../public/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="../public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto mt-3 mr-3">

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
                <!-- Begin Page Content -->
                <div class="container">

                    <div class="mx-auto mt-5">
                        <?php foreach ($rows as $row) : ?>
                            <h1 class="h3 text-dark text-left">訂單明細</h1>
                            <div class="row justify-content-start">

                                <ul class="list-group text-dark ">
                                    <li class="list-group-item ">

                                        <form action="doUpdateOrderStatus.php" method="post" class="row align-items-center">
                                            <div class="mx-1">訂單狀態</div>
                                            <select class="mx-1" name="status" id="status">

                                                <?php
                                                $sqlo = "SELECT * FROM orderliststatus"; //先拉另一組關聯的資料
                                                $resulto = $conn->query($sqlo);
                                                $rowos = $resulto->fetch_all(MYSQLI_ASSOC);
                                                ?>
                                                <?php foreach ($rowos as $rowo) : ?>
                                                    <option value="<?= $rowo["id"] ?>" <?php if ($rowo["id"] == $row["order_status"]) echo "selected"; ?>>
                                                        <?= $rowo["status"] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>

                                            <button class="btn btn-success btn-circle mx-1" type="submit" id="" name="id" value='<?= $row["id"] ?>'><i class="fa-solid fa-arrow-rotate-right"></i></button>
                                        </form>
                                    </li>

                                </ul>
                            </div>

                            <div class="row">
                                <ul class="list-group text-dark flex-fill">
                                    <li class="list-group-item">訂單編號<i class="fa-solid fa-arrow-right-long"></i><?= $row["id"] ?></li>
                                    <li class="list-group-item">會員名稱<i class="fa-solid fa-arrow-right-long"></i><?= $row["user_name"] ?></li>
                                    <li class="list-group-item">商品名稱<i class="fa-solid fa-arrow-right-long"></i><?= $row["product_name"] ?></li>
                                    <li class="list-group-item">商品單價<i class="fa-solid fa-arrow-right-long"></i><?= $row["product_price"] ?></li>
                                    <li class="list-group-item">下訂數量<i class="fa-solid fa-arrow-right-long"></i><?= $row["count"] ?></li>
                                </ul>
                                <ul class="list-group text-dark flex-fill">
                                    <li class="list-group-item">訂單總價<i class="fa-solid fa-arrow-right-long"></i><?= $row["totalprice"] ?></li>
                                    <li class="list-group-item">付款方式<i class="fa-solid fa-arrow-right-long"></i><?= $row["payment_method"] ?></li>
                                    <li class="list-group-item">配送方式<i class="fa-solid fa-arrow-right-long"></i><?= $row["shipping_method"] ?></li>
                                    <li class="list-group-item">收件地址<i class="fa-solid fa-arrow-right-long"></i><?= $row["recipient_address"] ?></li>
                                    <li class="list-group-item">訂單成立時間<i class="fa-solid fa-arrow-right-long"></i><?= $row["created_at"] ?></li>
                                </ul>
                            </div>



                        <?php endforeach; ?>
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
<script>

<?php
if (isset($_SESSION['requestInventory'])) {
    if ($_SESSION['requestInventory']['status'] == 1) {
        echo "alert(". json_encode($_SESSION['requestInventory']['message']) .");";
     
    } elseif ($_SESSION['requestInventory']['status'] == 0) {
        echo "alert(". json_encode($_SESSION['requestInventory']['message']) .");";
    }
    unset($_SESSION['requestInventory']);
}
?>


        
    </script>

</body>

</html>