<!-- 篩選和搜尋 (無分頁和排序)V-->
<!-- 排序 V-->
<!-- 分頁 V-->

<!-- 清除篩選和排序 V-->
<!-- 編輯鈕 V-->

<?php
require_once("../config/dbConnect.php");
session_start();

$sqlTotal = "SELECT * FROM orderlist";
$resultTotal = $conn->query($sqlTotal);
$totalOrder = $resultTotal->num_rows;
$perPage = 5;
$pageCount = ceil($totalOrder / $perPage);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; //設定初始 page=1
$order = isset($_GET['order']) ? (int)$_GET['order'] : 5; //設定初始 order=5

//進入網頁預設page=1、order=5

if (isset($_GET["searchcol"]) && isset($_GET["searchtxt"])) {
    $searchcol = $_GET["searchcol"];
    $searchtxt = $_GET["searchtxt"];
    //     篩選和搜尋 先不做page和order
    //     $order = $_GET["order"];

    //   switch ($order) {
    //     case 1:
    //       $orderSql = "orderlist.totalprice ASC";
    //       break;
    //     case 2:
    //       $orderSql = "orderlist.totalprice DESC";
    //       break;
    //     case 3:
    //       $orderSql = "orderlist.created_at ASC";
    //       break;
    //     case 4:
    //       $orderSql = "orderlist.created_at DESC";
    //       break;
    //     case 5:
    //       $orderSql = "orderlist.id ASC";
    //       break;
    //   }

    $sql = "SELECT orderlist.*, orderliststatus.status FROM orderlist JOIN orderliststatus ON orderlist.order_status = orderliststatus.id WHERE $searchcol LIKE'%$searchtxt%' ";
} elseif (isset($_GET["page"]) && isset($_GET["order"])) {
    $page = $_GET["page"];
    $startItem = ($page - 1) * $perPage;
    $order = $_GET["order"];

    switch ($order) {
        case 1:
            $orderSql = "orderlist.totalprice ASC";
            break;
        case 2:
            $orderSql = "orderlist.totalprice DESC";
            break;
        case 3:
            $orderSql = "orderlist.created_at ASC";
            break;
        case 4:
            $orderSql = "orderlist.created_at DESC";
            break;
        case 5:
            $orderSql = "orderlist.id ASC";
            break;
    }

    $sql = "SELECT orderlist.*, orderliststatus.status FROM orderlist JOIN orderliststatus ON orderlist.order_status = orderliststatus.id ORDER BY $orderSql  LIMIT $startItem,$perPage ";
    ///


} else {
    $startItem = ($page - 1) * $perPage;
    $sql = "SELECT orderlist.*, orderliststatus.status FROM orderlist JOIN orderliststatus ON orderlist.order_status = orderliststatus.id ORDER BY orderlist.id ASC LIMIT $startItem, $perPage ";
}



$result = $conn->query($sql);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>訂單列表</title>
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

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto mt-3">

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


            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800 text-center mt-2">訂單列表</h1>
            <p class="mb-4"></p>

            <!-- DataTales Example -->
            <div class="card shadow ">
                <form method="get" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="row align-items-center" id="dad">
                        <select class="custom-select mt-3 mx-3" name="searchcol" id="searchcol">
                            <option value="orderlist.id">id(訂單編號)</option>
                            <option value="orderlist.user_name">會員名稱</option>
                            <option value="orderliststatus.status">訂單狀態</option>
                        </select>
                        <div class="input-group mt-3 mx-3" id="inputTxt">
                            <input name="searchtxt" type="text" class="form-control bg-light border-0 small" placeholder="搜尋..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                        <div class="input-group mt-3 mx-3" id="refe">
                            <div class="input-group">
                                <a class="btn btn-info" role="button" href="orderlist.php">
                                    清除篩選和排序
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-2 mt-3 align-items-center">

                        <?php //如果不存在搜尋條件的話
                        if (isset($_GET["searchcol"]) && isset($_GET["searchtxt"])) {
                            $sql = "SELECT orderlist.*, orderliststatus.status FROM orderlist JOIN orderliststatus ON orderlist.order_status = orderliststatus.id WHERE $searchcol LIKE'%$searchtxt%' ";
                            $sresult = $conn->query($sql);
                            $stotalOrder = $sresult->num_rows;
                            echo "共$stotalOrder 筆訂單";
                        } else {
                            echo "共$totalOrder 筆訂單";
                        }

                        ?>
                        <?php if (!isset($_GET["searchcol"]) && !isset($_GET["searchtxt"])) : ?>
                            <div class="pb-2 d-flex justify-content-end orders">
                                <div class="mx-3">
                                    <a class="btn btn-primary text-white <?php
                                                                            if ($order == 1) echo "active"
                                                                            ?>" href="orderlist.php?page=<?= $page ?>&order=1">金額<i class="fa-solid fa-arrow-down-short-wide"></i></a>
                                    <a class="btn btn-primary text-white <?php
                                                                            if ($order == 2) echo "active"
                                                                            ?>" href="orderlist.php?page=<?= $page ?>&order=2">金額<i class="fa-solid fa-arrow-up-wide-short"></i></a>
                                    <a class="btn btn-primary text-white <?php
                                                                            if ($order == 3) echo "active"
                                                                            ?>" href="orderlist.php?page=<?= $page ?>&order=3">訂單成立時間<i class="fa-solid fa-arrow-down-short-wide"></i></a>
                                    <a class="btn btn-primary text-white <?php
                                                                            if ($order == 4) echo "active"
                                                                            ?>" href="orderlist.php?page=<?= $page ?>&order=4">訂單成立時間<i class="fa-solid fa-arrow-up-wide-short"></i></a>
                                </div>
                            </div><!-- orders -->
                        <?php endif; ?>
                    </div>
                </form>
                <div class="card-body pt-1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover " id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>id</th>
                                    <th>會員名稱</th>
                                    <th>商品名稱</th>
                                    <th>下訂數量</th>
                                    <th>總金額</th>
                                    <th>訂單成立時間</th>
                                    <th>訂單狀態</th>
                                    <th>訂單詳情與更動</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($totalOrder > 0) ?>
                                <?php $rows = $result->fetch_all(MYSQLI_ASSOC); ?>
                                <?php foreach ($rows as $row) : ?>
                                    <tr>
                                        <td><?= $row["id"] ?></td>
                                        <td><?= $row["user_name"] ?></td>
                                        <td><?= $row["product_name"] ?></td>
                                        <td><?= $row["count"] ?></td>
                                        <td><?= $row["totalprice"] ?></td>
                                        <td><?= $row["created_at"] ?></td>
                                        <td><?= $row["status"] ?></td>
                                        <td><a href="orderdetail.php?id=<?= $row["id"] ?>" role="button" class="btn btn-info"><i class="fas fa-info-circle"></i></a></td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if (!isset($_GET["searchcol"]) && !isset($_GET["searchtxt"])) : ?>
                    <div class="pagination mb-5 mx-auto">
                        <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                            <li class="paginate_button page-item ">
                                <a class="page-link" href="orderlist.php?page=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
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
        const searchcol = document.getElementById("searchcol"); //取得想監聽的元素

        const inputTxt = document.getElementById("inputTxt"); //取得舊元素

        const newSelect = document.createElement('select'); //建立新元素
        const newOption1 = document.createElement('option');
        const newOption2 = document.createElement('option');
        const newOption3 = document.createElement('option');
        const newOption4 = document.createElement('option');
        const newOption5 = document.createElement('option');
        const newOption6 = document.createElement('option');
        const newOption7 = document.createElement('option');
        const newButton = document.createElement('button');


        newSelect.setAttribute('name', 'searchtxt'); //替新元素select加入屬性
        newSelect.setAttribute('class', 'custom-select mt-3 mx-3');

        newButton.setAttribute('type', 'submit'); //替新button加入屬性
        newButton.setAttribute('class', 'btn btn-primary mt-3');
        newButton.textContent = "送出",

            newOption1.setAttribute('value', "待付款"); //將新元素option元素加入屬性
        newOption2.setAttribute('value', "待出貨");
        newOption3.setAttribute('value', "配送中");
        newOption4.setAttribute('value', "待收貨");
        newOption5.setAttribute('value', "已完成");
        newOption6.setAttribute('value', "不成立");
        newOption7.setAttribute('value', "退貨/退款");

        newOption1.textContent = '待付款'; //將新option元素加入內容
        newOption2.textContent = '待出貨';
        newOption3.textContent = '配送中';
        newOption4.textContent = '待收貨';
        newOption5.textContent = '已完成';
        newOption6.textContent = '不成立';
        newOption7.textContent = '退貨/退款';

        newSelect.appendChild(newOption1); //在新select內加入子元素新option
        newSelect.appendChild(newOption2);
        newSelect.appendChild(newOption3);
        newSelect.appendChild(newOption4);
        newSelect.appendChild(newOption5);
        newSelect.appendChild(newOption6);
        newSelect.appendChild(newOption7);




        searchcol.addEventListener("change", function() {
            const searchcolValue = searchcol.value;
            if (searchcolValue == "orderliststatus.status") {
                inputTxt.replaceWith(newSelect);
                const dadele = document.getElementById('dad'); // 替換為實際的父元素 ID
                const referenceElement = document.getElementById('refe'); // 替換為實際的參考元素 ID
                dadele.insertBefore(newButton, referenceElement); // 在 referenceElement 之前插入新元素
            } else {
                newSelect.replaceWith(inputTxt);
            }
        });
    </script>

</body>

</html>