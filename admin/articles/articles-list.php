<?php
session_start();
require_once("../config/dbConnect.php");



/*文章分類*/
$sqlArcCategory = "SELECT * FROM `articles_category`";
$resultArcCategory = $conn->query($sqlArcCategory);
$arcCategoryRows = $resultArcCategory->fetch_all(MYSQLI_ASSOC);


/*默認總筆數*/
$baseSql = "SELECT articles.*, articles_category.name AS category_name FROM articles 
JOIN articles_category ON articles.category_id = articles_category.id
WHERE valid=1
";
/* 條件總筆數 */
// 檢查是否有特定條件，例如搜索
if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sqlTotal = $baseSql . "AND (title LIKE '%$search%' OR content LIKE '%$search%')";
    // 其他條件類似地添加到這裡


} elseif (isset($_GET["status"]) && isset($_GET["arcCategory"])) {
    $status = $_GET["status"];
    $arcCategory = $_GET["arcCategory"];

    // // 文章分類 (靜態)
    // switch ($status) {
    //     case '1':
    //     case '2':
    //     case '3':
    //         $categorySql = "AND articles.category_id = $arcCategory";
    //         break;
    //     default:
    //         $categorySql = "AND  articles.category_id IN ('1', '2', '3')";
    //         break;
    // }

    // // 现在 $categorySql 包含了基于 GET 参数的正确 SQL 条件

    // 文章分類（動態）
    $categorySql = ""; // 初始化 SQL 条件为空

    // 检查是否有 arcCategory GET 参数
    if (isset($_GET["arcCategory"]) && $_GET["arcCategory"] != '') {
        $arcCategory = $_GET["arcCategory"];
        $validCategories = array_column($arcCategoryRows, 'id'); // 获取所有有效的类别 ID

        // 检查 GET 参数中的类别是否有效
        if (in_array($arcCategory, $validCategories)) {
            $categorySql = "AND articles.category_id = $arcCategory ";
        } else {
            // 如果提供的类别 ID 无效，可以选择设置一个默认条件或返回错误
            // 这里我们选择返回所有类别
            $categorySql = "AND articles.category_id IN ('" . implode("', '", $validCategories) . "')";
        }
    } else {
        // 如果没有提供 arcCategory 参数，也可以选择设置一个默认条件
        $categorySql = "";
    }

    // 现在 $categorySql 包含了基于 GET 参数的正确 SQL 条件



    //$status
    switch ($status) {
        case '已發布':
        case '待發布':
        case '已下架':
            $statusSql = "AND articles.status = '$status'";
            break;
        default:
            $statusSql = "AND  articles.status IN ('已發布', '待發布', '已下架')";
            break;
    }

    $sqlTotal = $baseSql . $statusSql . $categorySql;
} else {
    // 如果沒有特殊條件，使用基本 SQL
    $sqlTotal = $baseSql;
}


$resultTotal = $conn->query($sqlTotal);
$totalArticleCount = $resultTotal->num_rows;



/*頁碼資料 每頁幾份資料*/
$perPage = isset($_GET['perPage']) ? $_GET['perPage'] : 3;


// 頁碼  ******
$totalPage = ceil($totalArticleCount / $perPage);
// 起始頁
$startPage = 0;

/*status資料*/








// search功能
if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $sql = "SELECT articles.*, articles_category.name AS category_name FROM articles 
    JOIN articles_category ON articles.category_id = articles_category.id
    WHERE (title LIKE '%$search%' OR content LIKE '%$search%') AND valid=1";
} elseif (isset($_GET["page"]) && isset($_GET["order"]) && isset($_GET["perPage"]) && isset($_GET["status"]) && isset($_GET["arcCategory"]) && !isset($_GET["search"])) {
    // 當前頁碼
    $page = $_GET["page"];
    // 升冪降冪
    $order = $_GET["order"];
    // status狀態
    $status = $_GET["status"];
    // arcCategory 分類
    $arcCategory = $_GET["arcCategory"];

    // 每頁資料件數
    $perPage = $_GET["perPage"];
    $startPage = ($page - 1) * $perPage;
    $totalPage = ceil($totalArticleCount / $perPage);

    // 文章分類
    $categorySql = ""; // 初始化 SQL 条件为空

    // 检查是否有 arcCategory GET 参数
    if (isset($_GET["arcCategory"]) &&  $arcCategory != '') {
        $arcCategory = $_GET["arcCategory"];
        $validCategories = array_column($arcCategoryRows, 'id'); // 获取所有有效的类别 ID

        // 检查 GET 参数中的类别是否有效
        if (in_array($arcCategory, $validCategories)) {
            $categorySql = "AND articles.category_id = $arcCategory ";
        } else {
            // 如果提供的类别 ID 无效，可以选择设置一个默认条件或返回错误
            // 这里我们选择返回所有类别
            $categorySql = "AND articles.category_id IN ('" . implode("', '", $validCategories) . "')";
        }
    } else {
        // 如果没有提供 arcCategory 参数，也可以选择设置一个默认条件
        $categorySql = "";
    }

    // 现在 $categorySql 包含了基于 GET 参数的正确 SQL 条件




    //$status
    switch ($status) {
        case '已發布':
        case '待發布':
        case '已下架':
            $statusSql = "AND articles.status = '$status'";
            break;
        default:
            $statusSql = "AND  articles.status IN ('已發布', '待發布', '已下架')";
            break;
    }

    //order
    switch ($order) {
        case '1':
            $orderSql = "id ASC";
            break;
        case '2':
            $orderSql = "id DESC";
            break;
        case '3':
            $orderSql = "created_at ASC";
            break;
        case '4':
            $orderSql = "created_at DESC";
            break;
        case '5':
            $orderSql = "update_date ASC";
            break;
        case '6':
            $orderSql = "update_date DESC";
            break;
        default:
            $orderSql = "name DESC";
            break;
    }
    $sql = "SELECT articles.*, articles_category.name AS category_name FROM articles 
    JOIN articles_category ON articles.category_id = articles_category.id
    WHERE valid=1  $statusSql  $categorySql
    ORDER BY $orderSql  LIMIT    $startPage, $perPage ";
} else {
    // 頁面初始值 添加ui的當前默認active樣式與設定頁碼的默認頁數
    $order = 1; //影響升冪＆降冪 ＵＩ
    $page = 1; //影響頁碼ＵＩ
    $status = '全部'; //默認status
    $arcCategory = 0; //默認arcCategory

    $sql = "SELECT articles.*, articles_category.name AS category_name FROM articles 
    JOIN articles_category ON articles.category_id = articles_category.id
    WHERE valid=1
    ORDER BY id ASC LIMIT $startPage,$perPage
    ";
}

$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

//狀態分類
$sqlStatus = "SELECT DISTINCT status FROM articles WHERE status IN ('已發布', '待發布','已下架')";
$resultStatus = $conn->query($sqlStatus);
$statusRows = $resultStatus->fetch_all(MYSQLI_ASSOC);



// 透過session紀錄當前網址
// 1.獲取當前url網址與變數
$currentUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$_SESSION['previousUrl'] = $currentUrl;




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

<body id="page-top" class="fade-in-section ">
    <!-- bs 改變status modal -->
    <div class="alert info-box card">
        操作结果
    </div>
    <!-- status modal模組框 -->
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-warning" id="statusModalLabel">選擇狀態</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="statusForm">
                        <div class="form-group">
                            <label for="articleStatus" class="col-form-label">狀態:</label>
                            <select class="form-control" id="articleStatus" name="status">
                                <option value="" disabled selected>請選擇狀態</option>
                                <option value="已發布">已發布</option>
                                <option value="待發布">待發布</option>
                                <option value="已下架">已下架</option>
                                <!-- 其他選項 -->
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusModal" data-id=" " id="saveStatus">
                            保存更改
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- bs 刪除modal -->
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-danger" id="deleteModalLabel">注意</h3>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    是否確認要刪除？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">刪除</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- 刪除modal -->
    <!-- excel模態框 -->
    <div class="modal fade" id="excelModal" tabindex="-1" aria-labelledby="excelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="doExcelin.php" method="post" enctype="multipart/form-data">
                        <label for="formFile" class="form-label text-warning">請上傳【.csv檔案】</label>
                        <input class=" my-2" type="file" name="file" id="file">
                        <input class="btn btn-success" type="submit" value="上傳資料" name="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- excel模態框架 -->





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

                    <div class="">
                        <div class="d-flex align-items-center ">
                            <h1 class="h3 mt-1 text-gray-800 active text-nowrap ">所有文章</h1>
                            <div class="col-6">
                                <form action="articles-list.php">
                                    <div class="col-lg-12 col-md-8 col-sm-4">
                                        <div class="search-container ">
                                            <?php if (isset($_GET["search"])) : ?>
                                                <a href="articles-list.php" class="close-button">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            <?php endif; ?>
                                            <input type="text" class="search-input  " placeholder="<?php echo isset($_GET['search']) ? $_GET['search'] : '搜尋文章...'; ?>" name="search">
                                            <!-- <input type="hidden" name="order" value="1">
                                            <input type="hidden" name="page" value="1"> -->
                                            <button type="submit" class="search-button" title="搜尋">
                                                <i class="fas fa-search"></i>
                                            </button>

                                        </div>
                                    </div>
                                </form>
                            </div>

                            <?php $articleCount = $result->num_rows ?>
                            <?php if (isset($_GET["search"])) : ?>
                                <div class=" text-nowrap">共【<span class="text-warning px-2"><?= $articleCount ?></span>】筆</div>
                            <?php else : ?>
                                <div class=" text-nowrap">共【 <span class="text-warning"><?= $totalArticleCount ?></span> 】筆</div>
                            <?php endif ?>
                        </div>
                    </div>

                    <?php if ($result->num_rows > 0) : ?>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4 d-flex">
                            <?php if (!isset($_GET["search"])) : ?>
                                <!-- excel上傳 -->
                                <!-- 觸發模態框的按鈕 -->
                                <div class=" col-4 text-end d-flex">
                                    <div class="mr-1">
                                        <button type="button " class="btn btn-success " data-bs-toggle="modal" data-bs-target="#excelModal">
                                            上傳excel
                                        </button>
                                    </div>
                                    <form action="doExport.php" method="post">
                                        <input type="hidden" name="export">
                                        <button type="button " class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportModal">
                                            下載example
                                        </button>
                                    </form>
                                </div>
                                <!-- export下載 -->
                                <!-- 觸發模態框的按鈕 -->
                                <div class=" col-2 my-3 text-end">


                                </div>
                                <div class="card">
                                    <div class="body">
                                        <form action="" method="get" class="sel-form">
                                            <input type="hidden" name="order" value="1">
                                            <input type="hidden" name="page" value="1">
                                            <input type="hidden" name="perPage" value="<?= isset($_GET["perPage"]) ? $_GET["perPage"] : 3 ?>">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="d-flex mb-2">
                                                        <div class="form-check mr-2">
                                                            <input class="form-check-input" type="radio" name="status" value="全部" id="all" <?php if (!isset($_GET["status"]) || $status == '全部') echo "checked" ?>>
                                                            <label class="form-check-label" for="all">全部</label>
                                                        </div>
                                                        <div class="form-check mr-2">
                                                            <input class="form-check-input" type="radio" name="status" value="已發布" id="published" <?php if ($status == '已發布') echo "checked" ?>>
                                                            <label class="form-check-label" for="published">已發布</label>
                                                        </div>
                                                        <div class="form-check mr-2">
                                                            <input class="form-check-input" type="radio" name="status" value="待發布" id="publishing" <?php if ($status == '待發布') echo "checked" ?>>
                                                            <label class="form-check-label" for="publishing">待發布</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="status" value="已下架" id="unpublished" <?php if ($status == '已下架') echo "checked" ?>>
                                                            <label class="form-check-label" for="unpublished">已下架</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">

                                                    <label class="form-label">文章分類:</label>
                                                    <select class="form-select btn btn-primary" name="arcCategory">
                                                        <option value="0" <?php if ($arcCategory == 0) echo "selected" ?>>選擇文章分類</option>
                                                        <?php foreach ($arcCategoryRows as $arcCategoryRow) : ?>
                                                            <option value="<?= $arcCategoryRow['id'] ?>" <?php if ($arcCategory == $arcCategoryRow["id"]) echo "selected" ?>><?= $arcCategoryRow['name'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>

                                                    <button type="submit" class="btn btn-primary  sel-btn">篩選</button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php endif ?>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered border-primary table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <?php if (!isset($_GET["search"])) : ?>
                                                <tr class="text-nowrap  text-center ">
                                                    <th><a href="articles-list.php?perPage=<?= $perPage ?>&page=<?= $page ?>&order=<?= $order % 2 == 0 ? 1 : 2 ?>&status=<?= $status ?>&arcCategory=<?= $arcCategory ?>" class="text-warning">id<i class="fas fa-sort px-1"></i></a></th>
                                                    <th>文章縮圖</th>
                                                    <th>標題</th>
                                                    <th>文章分類</th>
                                                    <th>作者</th>
                                                    <th>狀態</th>
                                                    <th><a href="articles-list.php?perPage=<?= $perPage ?>&page=<?= $page ?>&order=<?= $order % 2 == 0 ? 3 : 4 ?>&status=<?= $status ?>&arcCategory=<?= $arcCategory ?>" class="text-warning">創建日期<i class="fas fa-sort px-1"></i></a></th>
                                                    <th><a href="articles-list.php?perPage=<?= $perPage ?>&page=<?= $page ?>&order=<?= $order % 2 == 0 ? 5 : 6 ?>&status=<?= $status ?>&arcCategory=<?= $arcCategory ?>" class="text-warning ">修改日期<i class="fas fa-sort px-1"></i></a></th>
                                                    <th>操作</th>

                                                </tr>
                                            <?php else : ?>
                                                <tr class="text-center">
                                                    <th>id</th>
                                                    <th>文章縮圖</th>
                                                    <th>標題</th>
                                                    <th>文章分類</th>
                                                    <th>作者</th>
                                                    <th>狀態</th>
                                                    <th>創建日期</th>
                                                    <th>修改日期</th>
                                                    <th>操作</th>
                                                <?php endif ?>
                                                </tr>
                                        </thead>
                                        <tfoot>
                                            <tr class="text-center">
                                                <th>id</th>
                                                <th>文章縮圖</th>
                                                <th>標題</th>
                                                <th>文章分類</th>
                                                <th>作者</th>
                                                <th>狀態</th>
                                                <th>創建日期</th>
                                                <th>修改日期</th>
                                                <th>操作</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php foreach ($rows as $index => $article) :  ?>
                                                <tr class="text-nowrap">
                                                    <th><?= $article["id"] ?></th>
                                                    <th>
                                                        <div class="thumbnail border border-success">
                                                            <img class="object-fit-cover" src="../articles/images/<?= $article["main_image"] ?>" alt="">
                                                        </div>
                                                    </th>
                                                    <th class="text-wrap"><?= $article["title"] ?></th>
                                                    <th><?= $article["category_name"] ?></th>
                                                    <th><?= $article["author"] ?></th>
                                                    <!-- 分類 -->
                                                    <th>
                                                        <!-- 按鈕觸發模態框 -->
                                                        <?php switch ($article["status"]) {
                                                            case "待發布":

                                                                echo "<button type='button' class='statusBtn btn btn-warning' data-toggle='modal' data-target='#statusModal' data-id='" . $article["id"] . "'>待發布</button>";

                                                                break;
                                                            case "已下架":

                                                                echo "<button type='button' class='statusBtn btn btn-danger' data-toggle='modal' data-target='#statusModal' data-id='" . $article["id"] . "'>已下架";
                                                                break;
                                                            case "已發布":

                                                                echo "<button type='button' class='statusBtn btn btn-success' data-toggle='modal' data-target='#statusModal' data-id='" . $article["id"] . "'>已發布";
                                                                break;
                                                            default:
                                                                echo "<button type='button' class='statusBtn btn btn-warning' data-toggle='modal' data-target='#statusModal' data-id='" . $article["id"] . "'>待發布</button>";
                                                        } ?>
                                                        </button>

                                                    </th>
                                                    <th class="text-center"><?= date('Y-m-d H:i', strtotime($article["created_at"])) ?></th>
                                                    <th class="text-center">
                                                        <?php
                                                        echo date('Y-m-d H:i', strtotime($article["update_date"])) == '1900-01-01 00:00' ? "未修改" : date('Y-m-d H:i', strtotime($article["update_date"]));
                                                        ?>
                                                    </th>

                                                    <th class="d-flex flex-column"><a class="btn btn-warning " href="article-edit.php?id=<?= $article["id"] ?>" title="修改文章"><i class="fas fa-solid fa-pen"></i></a>
                                                        <a class="btn btn-success mt-1 " href="article.php?id=<?= $article["id"] ?>" title="查看文章"><i class="fas fa-solid fa-eye"></i></a>
                                                        <a class="btn btn-danger mt-1" title="刪除文章" data-bs-toggle="modal" data-bs-target="#deleteModal" id="deleteArticleBtn" data-id="<?= $article["id"] ?>"><i class="bi bi-trash-fill"></i></a>

                                                    </th>
                                                </tr>
                                            <?php endforeach  ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php if (!isset($_GET["search"])) : ?>
                                <div class="container">
                                    <div class="d-flex justify-content-center  ">
                                        <div class="px-3">
                                            <form method="get" action="">
                                                <select class="pagination  form-select text-center mt-1" aria-label="Default select example" id="perPageSelect">
                                                    <option class="" value="3" <?php echo isset($_GET["perPage"]) && $_GET["perPage"] == 3 ? 'selected' : '' ?>>3</option>
                                                    <option class="" value="5" <?php echo isset($_GET["perPage"]) && $_GET["perPage"] == 5 ? 'selected' : '' ?>>5</option>
                                                    <option class="" value="10" <?php echo isset($_GET["perPage"]) && $_GET["perPage"] == 10 ? 'selected' : '' ?>>10</option>
                                                </select>
                                            </form>
                                        </div>
                                        <!-- pagination -->

                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center">
                                                <li class="page-item">
                                                    <a class="page-link" href="articles-list.php?perPage=<?= $perPage ?>&page=<?= max(1, $page - 1) ?>&order=<?= $order ?>&status=<?= $status ?>&arcCategory=<?= $arcCategory ?>" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>

                                                <?php
                                                $maxPagesToShow = 5;
                                                $startPage = max(1, $page - floor($maxPagesToShow / 2));
                                                $endPage = min($totalPage, $startPage + $maxPagesToShow - 1);

                                                if ($endPage - $startPage < $maxPagesToShow - 1) {
                                                    $startPage = max(1, $endPage - $maxPagesToShow + 1);
                                                }

                                                for ($i = $startPage; $i <= $endPage; $i++) :
                                                ?>
                                                    <li class="page-item"><a class="page-link <?php if ($i == $page) echo "active bg-gradient-secondary text-gray-100"; ?>" href="articles-list.php?perPage=<?= $perPage ?>&page=<?= $i ?>&order=<?= $order ?>&status=<?= $status ?>&arcCategory=<?= $arcCategory ?>"><?= $i ?></a></li>
                                                <?php endfor ?>

                                                <li class="page-item">
                                                    <a class="page-link" href="articles-list.php?perPage=<?= $perPage ?>&page=<?= min($totalPage, $page + 1) ?>&order=<?= $order ?>&status=<?= $status ?>&arcCategory=<?= $arcCategory ?>" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>

                                    </div>

                                </div>

                            <?php endif ?>
                        </div>
                    <?php else : ?>
                        <div class="card mt-5 text-center">
                            <div class="card-body">
                                查無資料
                            </div>
                        </div>

                    <?php endif ?>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    <!-- Core plugin JavaScript-->
    <script src="../public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../public/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../public/js/demo/chart-area-demo.js"></script>
    <script src="../public/js/demo/chart-pie-demo.js"></script>

    <script>
        ;
        (function() {
            // ajax -status
            const saveStatus = document.querySelector("#saveStatus");
            const statusSelect = document.querySelector("#articleStatus");
            const statusBtns = document.querySelectorAll('.statusBtn');
            let userId, artucleStatus;


            // 抓取頁面中所有狀態顯示鈕 並添加點擊事件 將選到對應狀態鈕的使用者id定義值
            for (let i = 0; i < statusBtns.length; i++) {
                statusBtns[i].addEventListener('click', function() {
                    userId = this.dataset.id;
                })
            }
            // 點擊保存修改時 將id與status資料發給資料庫進行請求
            saveStatus.addEventListener('click', function() {

                artucleStatus = statusSelect.value;

                $.ajax({
                        method: "POST",
                        url: "/sql_project/admin/articles/api/status.php",
                        dataType: "json",
                        data: {
                            id: userId,
                            status: artucleStatus
                        }
                    })
                    .done(function(response) {
                        console.log(response);
                        let status = response.status;
                        if (status == 1) {
                            // alert(response.message)
                            statusAlert(true, response.message)
                        } else {
                            statusAlert(false, response.message)
                        }
                    }).fail(function(jqXHR, textStatus) {
                        console.log("Request failed: " + textStatus);

                    });

            })

            // ajax請求 status彈窗
            function statusAlert(isSuccess, msg) {
                const statusAlert = document.querySelector('.alert')
                statusAlert.classList.add(isSuccess ? 'border-bottom-success' : 'border-bottom-danger')
                statusAlert.innerHTML = isSuccess ? `
    <div class="card">        
    <span><i class="bi bi-check-lg mx-2"></i>${msg}</span>     
    </div>
     ` : `<span><i class="bi bi-x-lg mx-2"></i>${msg}</span>`
                statusAlert.classList.add('show')

                setTimeout(() => {
                    statusAlert.classList.remove(isSuccess ? 'border-bottom-success' : 'border-bottom-danger')
                    statusAlert.innerHTML = ''
                    statusAlert.classList.remove('show')
                    location.reload();
                }, 800)

            }
        })();;
        // 軟刪除 AJAX request
        (function() {
            // 取得文章刪除id 定向帶到doDelete.php
            const deleteArticleBtns = document.querySelectorAll('#deleteArticleBtn');
            const confirmDelete = document.querySelector('#confirmDelete');
            let id;

            for (let i = 0; i < deleteArticleBtns.length; i++) {
                deleteArticleBtns[i].addEventListener('click', function() {
                    id = this.dataset.id; // 直接使用this 拿 data-id的值

                });
            }

            confirmDelete.addEventListener('click', function() {
                // console.log(id);
                window.location.href = `doDelete.php?id=${id}`; // 替换成目標頁面的URL
            })
        })();
        (function() {
            // <select>
            const perPageSelect = document.querySelector('#perPageSelect');
            const params = new URLSearchParams(window.location.search);


            perPageSelect.addEventListener('change', function() {

                //perpage值
                const selectedValue = this.value;
                // 根據選項值構建跳转链接
                const link = `articles-list.php?perPage=${selectedValue}`;
                console.log(link);
                // 導航到連接
                window.location.href = link;
            });
        })();

        // 當跳轉到下一個頁面時，紀錄上一個頁面的url與所有get參數
        (function() {

            // 获取当前页面的URL
            var currentUrl = window.location.href;

            // 将当前URL保存到会话中
            sessionStorage.setItem('previousUrl', currentUrl);


        })();
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