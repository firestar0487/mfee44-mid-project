<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("../config/dbConnect.php");

if (isset($_POST['export'])) {
    $sql = "SELECT * FROM `articles_example`";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        // 设置CSV文件的头部信息
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment;filename=example.csv');
        header('Cache-Control: max-age=0');

        // 打开PHP输出流作为输出CSV的文件
        $output = fopen('php://output', 'w');

        // 写入CSV列标题
        fputcsv($output, array('id', 'title', 'meta_description', 'author', 'status', 'category_id', 'tags_id', 'content', 'main_image', 'publish_date', 'update_date', 'created_at', 'valid'));

        // 从数据库中获取数据并写入CSV
        while ($row = mysqli_fetch_array($res)) {
            fputcsv($output, array($row['id'], $row['title'], $row['meta_description'], $row['author'], $row['status'], $row['category_id'], $row['tags_id'], $row['content'], $row['main_image'], $row['publish_date'], $row['update_date'], $row['created_at'], $row['valid']));
        }

        fclose($output);
        exit(); // 确保输出后终止脚本的执行
    } else {
        echo 'no data found';
    }
}
