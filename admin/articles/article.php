<?php
session_start();
require_once("../config/dbConnect.php");
// 若url沒有GET參數就導回user-list.php
if (!isset($_GET["id"])) {
    header("location:articles-list.php");
}

if (isset($_SESSION['previousUrl'])) {
    $previousUrl = $_SESSION['previousUrl'];
} else {
    $previousUrl = 'articles-list.php';
}





/*  從url得到的GET參數 並進行定義，讓資料導向指定id的該組資料*/
$id = $_GET["id"];


// 單篇文章
$sqlarticle = "SELECT articles.*, 
articles_category.name AS category_name 
FROM 
articles 
JOIN 
articles_category ON articles.category_id = articles_category.id
WHERE 
articles.id = $id
";

$result = $conn->query($sqlarticle);
$articleRow = $result->fetch_assoc();

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

    <!-- Custom fonts for this template-->
    <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../public/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- BS-icon &article.css -->
    <?php include("../articles/css/articleCss.php"); ?>

</head>

<body id="page-top" class="fade-in-section">
    <!-- 提交修改結果彈窗 -->
    <div class="alert info-box card">
        操作结果
    </div>
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

                        <!-- Nav Item - User Information -->
                        <!-- log out -->
                        <form class="form-inline ml-auto" action="doMemberLogout.php" method="post"> <button type="submit" class="btn btn-danger">登出</button></form>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between">
                        <h1 class="h3 mb-2 text-gray-800 active">查看文章</h1>
                        <div class="m-2">
                            <a class="btn btn-success" href="<?= $previousUrl ?>" title="返回文章管理">返回</a>

                            <a class="btn btn-warning" href="article-edit.php?id=<?= $articleRow["id"] ?>">修改</a>
                        </div>
                    </div>


                    <!-- 发布文章 -->
                    <div class="card">
                        <!-- <div class="title">
                            <span>文章</span>
                        </div> -->
                        <div class="body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">id</th>
                                        <td><?= $articleRow["id"] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">標題</th>
                                        <td><?= $articleRow["title"] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">Meta描述</th>
                                        <td><?= $articleRow["meta_description"] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">文章分類</th>
                                        <td><?= $articleRow["category_name"] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">發布狀態</th>
                                        <td><?= $articleRow["status"] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">作者</th>
                                        <td><?= $articleRow["author"] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="text-nowrap">發布日期</th>
                                        <td><?= $articleRow["publish_date"] ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="col-2">
                                            <div class="cover">
                                                <label for="img">封面：</label>
                                                <div class="coverImg ">
                                                    <img class="object-fit-cover" src="../articles/images/<?= $articleRow["main_image"] ?>" alt="">
                                                </div>
                                            </div>
                                        </th>
                                        <td class="col-10">
                                            <div>
                                                <label for=""><b>內容：</b></label>
                                                <div class="messageBox default-text p-3"><?= $articleRow["content"] ?></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
    <script src="../public/vendor/jquery/jquery.min.js"></script>
    <script src="../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../public/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../public/js/demo/chart-area-demo.js"></script>
    <script src="../public/js/demo/chart-pie-demo.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    <script>
        // 後端SESSION信息處理
        function myAlert(isSuccess, msg) {
            const myAlert = document.querySelector('.alert')
            myAlert.classList.add(isSuccess ? 'border-bottom-success' : 'border-bottom-danger')
            myAlert.innerHTML = isSuccess ? `
    <div class="card">        
    <span><i class="bi bi-check-lg mx-2"></i>${msg}</span>     
    </div>
     ` : `<span><i class="bi bi-x-lg mx-2"></i>${msg}</span>`
            myAlert.classList.add('show')

            setTimeout(() => {
                myAlert.classList.remove(isSuccess ? 'border-bottom-success' : 'border-bottom-danger')
                myAlert.innerHTML = ''
                myAlert.classList.remove('show')
            }, 1500)

        }



        <?php
        // 确保 requestArticle 的 status 键存在
        if (isset($_SESSION['requestArticle'])) {
            if ($_SESSION['requestArticle']['status'] == 1) {
                // 如果状态为 1，显示成功消息
                echo "myAlert(true, " . json_encode($_SESSION['requestArticle']['message']) . ");";
            } elseif ($_SESSION['requestArticle']['status'] == 0) {
                // 如果状态为 0，显示失败消息
                echo "myAlert(false, " . json_encode($_SESSION['requestArticle']['message']) . ");";
            }
            // 在任何一种情况下，清除 session 中的 requestArticle
            unset($_SESSION['requestArticle']);
        }
        ?>
    </script>

</body>

</html>