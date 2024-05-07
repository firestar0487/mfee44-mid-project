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
    <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">優惠券日期有誤</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    開始日期不能小於結束日期
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
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

                        <!-- log out -->
                        <form class="form-inline ml-auto" action="doMemberLogout.php" method="post"> <button type="submit" class="btn btn-danger">登出</button></form>


                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800 text-center">新增優惠券</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-sm-8">
                                    <div class="py-2 ">
                                        <a class="btn btn-info text-white" href="coupon-list.php" title="回優惠券列表"><i class="fas fa-arrow-left"></i></a>
                                    </div>

                                    <form action="doAddCoupon.php" method="post" id="couponForm">
                                        <div class="row mb-3">
                                            <label for="coupon_name" class="col-sm-12 col-form-label">優惠券名稱:</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="coupon_name" name="coupon_name" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="coupon_code" class="col-sm-12 col-form-label">優惠券代碼</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="coupon_code" name="coupon_code" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3 mx-0">
                                            <button class="btn btn-primary" type="button" onclick="generateRandomString()">生成隨機優惠碼</button>
                                        </div>
                                        <p>(可自定義10位大小英文數字混雜字元)</p>

                                        <div class="row mb-3 ">
                                            <label for="coupon_valid" class="col-sm-12 col-form-label">優惠券狀態:</label>
                                            <div class="form-check col-sm-12 mx-2 mb-1">
                                                <input class="form-check-input" type="radio" name="coupon_valid" id="coupon_valid1" value="1" checked>
                                                <label class="coupon_valid" for="coupon_valid1">可使用</label>
                                            </div>
                                            <div class="form-check col-sm-12 mx-2">
                                                <input class="form-check-input" type="radio" name="coupon_valid" id="coupon_valid2" value="0">
                                                <label class="coupon_valid" for="coupon_valid2">停用</label>
                                            </div>
                                        </div>

                                        <div class="row mb-3 ">
                                            <label for="discount_type" class="col-sm-12 col-form-label">折扣方式:</label>
                                            <div class="form-check col-sm-12 mx-2 mb-1">
                                                <input class="form-check-input" type="radio" name="discount_type" id="discount_type1" value="百分比" checked>
                                                <label class="discount_type" for="discount_type1">百分比</label>
                                            </div>
                                            <div class="form-check col-sm-12 mx-2">
                                                <input class="form-check-input" type="radio" name="discount_type" id="discount_type2" value="金額">
                                                <label class="form-check-label" for="discount_type2">金額</label>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="discount_value" class="col-sm-12 col-form-label">折扣百分比/金額</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="discount_value" name="discount_value" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="max_usage" class="col-sm-12 col-form-label">可使用次數</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="max_usage" name="max_usage" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="price_min" class="col-sm-12 col-form-label">最低消費金額</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="price_min" name="price_min" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">

                                            <label for="start_at" class="col-12 col-form-label">優惠券開始時間:</label>
                                            <input type="datetime-local" class="form-control" id="start_at" name="start_at" required>
                                            <label for="end_at" class="col-12 col-form-label">優惠券到期時間:</label>
                                            <input type="datetime-local" class="form-control" id="end_at" name="end_at" required>

                                        </div>

                                        <div class="row mb-3">
                                            <p>優惠券使用條件</p>
                                            <select class="form-control col-sm-12 col-form-label" aria-label=".form-select-sm example" id="usage_restrictions" name="usage_restrictions">
                                                <option disabled selected>請選擇使用限制</option>
                                                <option value="SHEAFFER">SHEAFFER</option>
                                                <option value="PELIKAN">PELIKAN</option>
                                                <option value="MONTBLANC">MONTBLANC</option>
                                                <option value="PILOT">PILOT</option>
                                                <option value="WATERMAN">WATERMAN</option>
                                                <option value="PARKER">PARKER</option>
                                                <option value="TWSBI">TWSBI</option>
                                                <option value="LAMY">LAMY</option>
                                                <option value="KAWECO">KAWECO</option>
                                                <option value="SAILOR">SAILOR</option>
                                                <option value="全站">全站</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-info text-white" type="submit" id="submitBtn">送出</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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

        <script>
            function generateRandomString() {
                const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                let randomString = '';

                for (let i = 0; i < 10; i++) {
                    const randomIndex = Math.floor(Math.random() * characters.length);
                    randomString += characters.charAt(randomIndex);
                }

                document.getElementById('coupon_code').value = randomString;
            }
        </script>

        <script>
            document.getElementById('submitBtn').addEventListener('click', function(event) {

                var startDate = document.getElementById('start_at').value;
                var endDate = document.getElementById('end_at').value;
                var usageRestrictionsValue = document.getElementById('usage_restrictions').value;

                if (startDate > endDate) {

                    $('#alertModal').modal('show');
                    event.preventDefault();
                }
                if (usageRestrictionsValue === "請選擇使用限制") {
                    event.preventDefault(); // 阻止表单提交
                    document.getElementById('usage_restrictions').setCustomValidity('請選擇使用限制'); // 设置自定义验证消息
                    document.getElementById('usage_restrictions').focus(); // 将焦点设置到下拉框
                } else {
                    // 如果下拉框有选择其他值，清除自定义验证消息
                    document.getElementById('usage_restrictions').setCustomValidity('');
                }
            });
        </script>

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