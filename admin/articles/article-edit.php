<?php
session_start();
require_once("../config/dbConnect.php");

// 若url沒有GET參數就導回user-list.php
if (!isset($_GET["id"])) {
    // echo "請循正常管道進入此頁";
    header("location:articles-list.php");
    exit;
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

//所有文章分類
$sqlArcCategorys = "SELECT * FROM articles_category ORDER BY id ASC";
$resultArcCategorys = $conn->query($sqlArcCategorys);
$arcCategoryRows = $resultArcCategorys->fetch_all(MYSQLI_ASSOC);


// previousUrl

if (isset($_SESSION['previousUrl'])) {
    $previousUrl = $_SESSION['previousUrl'];
} else {
    $previousUrl = 'articles-list.php';
}
// echo  $previousUrl;

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
    <link href="../public/css/sb-admin-2.css" rel="stylesheet">
    <!-- BS-icon &article.css -->
    <?php include("../articles/css/articleCss.php"); ?>


</head>

<body id="page-top" class="fade-in-section">

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
                        <h1 class="h3 mb-2 text-gray-800 active">修改文章</h1>
                    </div>


                    <!-- 发布文章 -->
                    <div class="card">
                        <!-- <div class="title">
                            <span>文章</span>
                        </div> -->
                        <div class="body">
                            <form action="doUpdateArticle.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $articleRow["id"] ?>">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-nowrap">id</th>
                                            <td><?= $articleRow["id"] ?></td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap"> <label for="title">標題</label></th>
                                            <td><input type="text" class="form-control" id="title" name="title" value="<?php echo trim($articleRow["title"]); ?>" required></td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap"><label for="description">Meta描述</label></th>
                                            <td><input type="text" class="form-control" id="description" name="description" value="<?php echo trim($articleRow["meta_description"]); ?>" required></td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">
                                                <label for="category_id">文章分類</label>
                                            </th>
                                            <td>
                                                <select class="custom-select" id="category_id" name="category" required>

                                                    <?php foreach ($arcCategoryRows as $category) : ?>
                                                        <option value="<?= $category["id"] ?>" <?php if ($category["id"] == $articleRow["category_id"]) echo "selected"; ?>><?= $category["name"] ?></option>

                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap">
                                                <label for="status">發布狀態</label>
                                            </th>
                                            <td>
                                                <select class="custom-select" id="status" name="status" required>
                                                    <option value="已發布" <?php if ($articleRow["status"] == '已發布') echo "selected"; ?>>已發布</option>
                                                    <option value="待發布" <?php if ($articleRow["status"] == '待發布') echo "selected"; ?>>待發布</option>
                                                    <option value="已下架" <?php if ($articleRow["status"] == '已下架') echo "selected"; ?>>已下架</option>

                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-nowrap"><label for="author">作者</label></th>
                                            <td><input type="text" class="form-control" id="author" name="author" value="<?php echo trim($articleRow["author"]); ?>" required></td>
                                        </tr>

                                        <tr>
                                            <th class="text-nowrap">發布日期</th>
                                            <td><?= $articleRow["publish_date"] ?></td>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        <tr>
                                            <th class="col-2">
                                                <div class="cover">
                                                    <label for="img">新封面：</label>
                                                    <input class="img-file" type="file" name="img" id="img" hidden>
                                                    <div class="coverImg cursor">
                                                        <img class="object-fit-cover" id="imagePreview" src="../articles/images/<?= $articleRow['main_image'] ?>" alt="Image Preview" style="<?= $articleRow['main_image'] ? 'display: block;' : 'display: none;' ?>">
                                                    </div>
                                                </div>
                                            </th>

                                            <td class="col-10">
                                                <div class="messageBox " id="editor1"><?= $articleRow["content"] ?></div>
                                                <!-- html＆text標籤觀察窗口 可以將hidden設為text觀察 -->
                                                <input type="hidden" id="innerText" placeholder="innerText" value="">
                                                <input type="hidden" id="innerHTML" placeholder="innerHTML" value="<?= htmlspecialchars($articleRow["content"]) ?>" name="content">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <a href="<?= $previousUrl ?>" class="text-center btn btn-danger btn-md mx-auto">取消</a>
                                    <button type="submit" class="text-center btn btn-success btn-md mx-auto">修改</button>

                                </div>
                            </form>
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
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>


    <script>
        // 配置CKEditor物件 並加上主輸入框id
        CKEDITOR.replace('editor1', {
            toolbar: [{
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript']
                },
                {
                    name: 'links',
                    items: ['Link', 'Unlink']
                },
                {
                    name: 'paragraph',
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
                },
                {
                    name: 'document',
                    items: ['Source']
                }, {
                    name: 'styles',
                    items: ['Format', 'Font', 'FontSize']
                }, {
                    name: 'tools',
                    items: ['Maximize', 'ShowBlocks']
                }, {
                    name: 'colors',
                    items: ['TextColor', 'BGColor']
                }, {
                    name: 'insert',
                    items: ['HorizontalRule']
                },
            ],
            height: 500, //設置高
            // 其他配置...
            extraAllowedContent: 'img[src,alt,width,height]', // 允许 img 标签及其某些属性


        });

        //  監聽主輸入框事件
        CKEDITOR.instances.editor1.on('change', function() {
            let editorData = this.getData();

            // 使用document.querySelector獲取輸入框，並更新它們的值
            document.querySelector('#innerText').value = editorData.replace(/<[^>]*>?/gm, ''); // 移除HTML標簽以獲得純inneText
            document.querySelector('#innerHTML').value = editorData;
        });

        // 封面預覽事件
        (function() {

            // 1.當文件選擇變化時觸發預覽函式
            document.querySelector('#img').addEventListener('change', previewImageAndHideLabel);
            //  2.已有上傳的預覽圖片時，再點擊時，可以再次上傳新圖片去覆蓋
            document.querySelector('#imagePreview').addEventListener('click', triggerFileInput);


            // 1-1上傳預覽圖片並隱藏默認label
            function previewImageAndHideLabel() {
                const file = document.querySelector('#img').files[0];
                const preview = document.querySelector('#imagePreview');
                const label = document.querySelector('.place');

                // 如果有檔案
                if (file) {
                    // 上傳成功

                    // 新增 new FileReader() 物件 可以當成儲存上傳預覽圖片資料的物件
                    const reader = new FileReader();
                    reader.addEventListener('load', function(e) {
                        //result屬性 是上傳文件內容的 base64 編碼的數據 URL。
                        preview.src = e.target.result;
                        // 顯示預覽圖
                        preview.style.display = 'block';
                        // 隱藏label
                        label.style.display = 'none';
                    });
                    // FileReader 可以將這個文件讀取為一個 Data URL，該 URL 可直接設置為 <img> 元素的 src 屬性，從而在網頁上顯示該圖片。
                    reader.readAsDataURL(file);
                } else {
                    //上傳失敗
                    //上傳圖片失敗時 src為空值
                    preview.src = '';
                    //隱藏預覽窗口
                    preview.style.display = 'none';
                    //顯示默認label
                    label.style.display = 'block';
                }
            }
            // 2-1上傳圖片後的預覽窗點擊事件(就是可以再做一次上傳檔案），讓使用者可以重複上傳圖片
            function triggerFileInput() {
                document.querySelector('#img').click();
            }

        })()
    </script>

</body>

</html>