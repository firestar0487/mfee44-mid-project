<?php
require_once("../config/dbConnect.php");

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


    <!-- Custom styles for this page -->
    <link href="../public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../public/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="../public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../user/css/style.css">



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

            <!-- Main Content -->
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- 左側 Navbar 部分 -->
                    <!-- ... -->


                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <span class="text-warning mr-4">歡迎，<?php echo $username; ?></span>
                        </li>
                        <li class="nav-item">
                            <form class="form-inline ml-auto" action="doMemberLogout.php" method="post">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger">登出</button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </nav>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between bg-primary text-white">
                            <h2 class="m-0 font-weight-bold">會員資料</h2>
                            <a href="add_member.php" class="btn btn-primary ml-auto">新增+</a>
                            <button onclick="showUploadModal()" class="btn btn-primary">匯入+</button>
                            <form action="export.php" method="post">
                                <input type="submit" name="submit" value="匯出" class="btn btn-primary ml-auto">
                            </form>
                        </div>

                        <div id="uploadModal">
                            <h2>匯入檔案</h2>
                            <form action="import.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="file">選擇 CSV 檔案：</label>
                                    <input type="file" name="file" accept=".csv">
                                </div>
                                <input type="submit" value="上傳檔案" class="btn btn-primary">
                            </form>
                            <button onclick="hideUploadModal()" class="btn btn-primary">取消</button>
                        </div>
                        <div class="mt-4">
                            <form class="form-inline" method="GET" action="">
                                <?php
                                $searchTerm = '';
                                ?>
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="search" class="sr-only">搜尋會員：</label>
                                    <!-- 使用 Bootstrap 的 form-control 類別來設置樣式 -->
                                    <input type="text" name="search" id="search" class="form-control" placeholder="輸入會員名稱或其他條件" value="<?php echo $searchTerm; ?>">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">搜尋</button>
                                <!-- <div>
                                    <a href="?sort=<?= $sort === 'ASC' ? 'DESC' : 'ASC' ?>&page=<?= $page ?>" class="btn btn-primary text-decoration-none text-light">
                                        Name
                                        <?php if ($sort === 'ASC') : ?>
                                            <i class="bi bi-sort-down"></i>
                                        <?php else : ?>
                                            <i class="bi bi-sort-up"></i>
                                        <?php endif; ?>
                                    </a>
                                </div> -->
                            </form>
                        </div>
                        <?php
                        $recordsPerPage = 10;
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $offset = ($page - 1) * $recordsPerPage;
                        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
                        $whereClause = '';
                        if (!empty($searchTerm)) {
                            $whereClause = " WHERE `id` LIKE '%$searchTerm%' OR `name` LIKE '%$searchTerm%' OR `email` LIKE '%$searchTerm%'";
                        }

                        $totalRecordsQuery = "SELECT COUNT(*) as total FROM `user`" . $whereClause;
                        $totalRecordsResult = mysqli_query($conn, $totalRecordsQuery);
                        $totalRecordsRow = mysqli_fetch_assoc($totalRecordsResult);
                        $totalRecords = $totalRecordsRow['total'];

                        $totalPages = ceil($totalRecords / $recordsPerPage);

                        $query = "SELECT * FROM `user`" . $whereClause . " LIMIT $offset, $recordsPerPage";
                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            die("查詢失敗：" . mysqli_error($conn));
                        } else {
                        ?>
                            <table class="table table-hover table-bordered table-striped mt-4">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>帳號狀態</th>
                                        <th>Update</th>
                                        <th>Delete/Restore</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                                        // 有搜尋關鍵字，顯示搜尋結果
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            // 檢查該行資料是否包含搜尋關鍵字
                                            if (stripos($row['name'], $_GET['search']) !== false || stripos($row['email'], $_GET['search']) !== false) {
                                    ?>
                                                <tr>
                                                    <td><?= $row['id'] ?></td>
                                                    <td><?= $row['name'] ?></td>
                                                    <td><?= $row['email'] ?></td>
                                                    <td><span class="<?= $row['deleted_at'] ? 'text-danger' : 'text-success' ?>">
                                                            <?= $row['deleted_at'] ? '已鎖定' : '未鎖定' ?>
                                                        </span></td>
                                                    <td><a href="member_details.php?id=<?php echo $row['id']; ?>" class="btn btn-success">資料詳情</a></td>
                                                    <td>
                                                        <?php if ($row['deleted_at'] !== null) : ?>
                                                            <!-- 如果會員狀態為已鎖定，生成 "Restore" 按鈕 -->
                                                            <a href="restore_member.php?id=<?php echo $row['id']; ?>" class="btn btn-warning" onclick="return confirm('確定要還原這個會員嗎？')">Restore</a>
                                                        <?php else : ?>
                                                            <!-- 如果會員狀態不是已鎖定，生成 "Delete" 按鈕 -->
                                                            <a href="soft_delete_member.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('確定要刪除這個會員嗎？')">Delete</a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                        }
                                    } else {
                                        // 沒有搜尋關鍵字，顯示所有資料
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            // 直接在 HTML 中嵌入 PHP，以動態生成資料
                                            ?>
                                            <tr>
                                                <td><?= $row['id'] ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['email'] ?></td>
                                                <td><span class="<?= $row['deleted_at'] ? 'text-danger' : 'text-success' ?>">
                                                        <?= $row['deleted_at'] ? '已鎖定' : '未鎖定' ?>
                                                    </span></td>
                                                <td><a href="member_details.php?id=<?php echo $row['id']; ?>" class="btn btn-success">資料詳情</a></td>
                                                <td>
                                                    <?php if ($row['deleted_at'] !== null) : ?>
                                                        <!-- 如果會員狀態為已鎖定，生成 "Restore" 按鈕 -->
                                                        <a href="restore_member.php?id=<?php echo $row['id']; ?>" class="btn btn-warning" onclick="return confirm('確定要還原這個會員嗎？')">Restore</a>
                                                    <?php else : ?>
                                                        <!-- 如果會員狀態不是已鎖定，生成 "Delete" 按鈕 -->
                                                        <a href="soft_delete_member.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('確定要刪除這個會員嗎？')">Delete</a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                    <?php }
                                    }
                                    ?>
                                </tbody>
                            </table>



                            <nav aria-label="Page navigation" class="d-flex justify-content-center">
                                <ul class="pagination">
                                    <?php if ($page > 1) : ?>
                                        <li class="page-item"><a class="page-link" href="members_list.php?page=<?php echo $page - 1; ?>">Previous</a></li>
                                    <?php endif; ?>

                                    <?php
                                    for ($i = 1; $i <= $totalPages; $i++) {
                                        $activeClass = ($i == $page) ? 'active' : '';

                                        // 顯示 "..." 以便在頁碼過多時進行省略
                                        if ($i > 3 && $i < $page - 1) {
                                            echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
                                        }

                                        echo "<li class='page-item $activeClass'><a class='page-link' href='members_list.php?page=$i'>$i</a></li>";

                                        if ($i < $totalPages - 2 && $i > $page + 1) {
                                            echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
                                        }
                                    }
                                    ?>

                                    <?php if ($page < $totalPages) : ?>
                                        <li class="page-item"><a class="page-link" href="members_list.php?page=<?php echo $page + 1; ?>">Next</a></li>
                                    <?php endif; ?>
                                </ul>
                            </nav>

                        <?php
                        }
                        ?>

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
        // 顯示匯入窗口
        function showUploadModal() {
            document.getElementById("uploadModal").style.display = "block";
        }

        // 隱藏匯入窗口
        function hideUploadModal() {
            document.getElementById("uploadModal").style.display = "none";
        }
    </script>

</body>

</html>