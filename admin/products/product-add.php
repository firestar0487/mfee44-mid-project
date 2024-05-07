<?php
require_once("../config/dbConnect.php");

$brandSql = "SELECT* FROM brand";
$brandResult = $conn->query($brandSql);
$brandRows = $brandResult->fetch_all(MYSQLI_ASSOC);


$color_categorySql = "SELECT* FROM color_category";
$color_categoryResult = $conn->query($color_categorySql);
$color_categoryRows = $color_categoryResult->fetch_all(MYSQLI_ASSOC);

$fountain_nibSql = "SELECT* FROM fountain_nib";
$fountain_nibResult = $conn->query($fountain_nibSql);
$fountain_nibRows = $fountain_nibResult->fetch_all(MYSQLI_ASSOC);
?>


<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <?php

  ?>
</head>

<body>
  <div class="container">
    <form action="doAddProduct.php" method="post" enctype="multipart/form-data">
      <a class="btn btn-primary mb-3" href="tables.php">返回<i class="fa-solid fa-arrow-right-to-bracket" title="返回"></i></a>
      <h1>
        新增商品
      </h1>
      <div class="card shadow" style="width: 35rem;">
        <div class="card-body">
          <div class="m-1">
            <label for="name" class="form-label">產品名稱</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="row">

            <div class="col-3 m-1">
              <label class="form-label">品牌</label>
              <!-- <select class="form-select" name="state_id" id="state_id" 
              aria-label="Default select example">
              <div class="dropdown"> -->
              <select class="form-select" aria-label="Default select example" name="brand_id">
                <?php foreach ($brandRows as $brandRow) : ?>
                  <option value="<?= $brandRow["id"] ?>"><?= $brandRow["brand_name"] ?></option>
                <?php endforeach; ?>
              </select>

            </div>
          </div>

          <div class="col-3 m-1">
            <label class="form-label">筆尖</label>
            <select class="form-select" id="nib_id" name="nib_id">
              <?php foreach ($fountain_nibRows as $fountain_nibRow) : ?>
                <option value="<?= $fountain_nibRow["id"] ?>"><?= $fountain_nibRow["nib"] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-3 m-1">
            <label class="form-label">顏色</label>
            <select class="form-select" id="color" name="color">
              <?php foreach ($color_categoryRows as $color_categoryRow) : ?>
                <option value="<?= $color_categoryRow["id"] ?>"><?= $color_categoryRow["color"] ?></option>
              <?php endforeach; ?>
              <!-- <inp ut type="text" class="form-control" id="color" name="color" required> -->
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-4 m-1">
            <label class="form-label">價錢</label>
            <input type="text" class="form-control" id="price" name="price" required>
          </div>
        </div>

        <div class="row">
          <div class="col-5 m-1">
            <label class="form-label">新增圖片</label>
            <input type="file" class="form-control" id="img" name="image" accept=".jpg , .jpeg" required>
          </div>
        </div>

        <div class="m-1 my-3">
          <button class="btn btn-success" type="submit" href="doAddProduct.php">新增商品</button>
          <a class="btn btn-danger  ms-2" href="tables.php">取消</a>
        </div>

      </div>

  </div>

  </form>
  </div>



  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>

</html>