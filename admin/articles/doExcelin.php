<?php
session_start();
//... 前面的檔案上傳檢查代碼

// 連接資料庫
require_once("../config/dbConnect.php");


if (isset($_POST["submit"])) {
    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        $csvMimes = array('text/csv', 'text/plain', 'application/csv', 'text/comma-separated-values', 'application/excel', 'application/vnd.ms-excel', 'application/vnd.msexcel', 'text/anytext');
        if (in_array($_FILES['file']['type'], $csvMimes)) {
            $file = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($file);

            // 開始事務
            $conn->begin_transaction();

            $uploadSuccess = true; // 用於追蹤上傳是否成功

            while (($column = fgetcsv($file)) !== FALSE) {
                // 根據 CSV 文件的列賦值（跳過 id）
                $title = $column[1];
                $meta_description = $column[2];
                $author = $column[3];
                $status = $column[4];
                $category_id = $column[5];
                $tags_id = $column[6];
                $content = $column[7];
                $main_image = $column[8];
                $publish_date = $column[9];
                $update_date = $column[10];
                $created_at = $column[11];
                $valid = $column[12];



                $stmt = $conn->prepare("INSERT INTO articles (title, meta_description, author, status, category_id, tags_id, content, main_image, publish_date, update_date, created_at, valid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssiisssssi", $title, $meta_description, $author, $status, $category_id, $tags_id, $content, $main_image, $publish_date, $update_date, $created_at, $valid);

                if (!$stmt->execute()) {
                    echo "錯誤: " . $stmt->error;
                    $uploadSuccess = false;
                    break; //停止處理剩餘記錄
                }
            }

            $stmt->close();
            fclose($file);

            // 檢查是否有錯誤發生
            if ($uploadSuccess) {
                $conn->commit(); // 如果一切順利，提交事務
                $data = [
                    "status" => 1,
                    "message" => "文件上傳並處理成功！"
                ];
                $_SESSION["requestArticle"] = $data;
                // echo "文件上傳並處理成功！";
            } else {
                $conn->rollback(); // 如果出現錯誤，回滾事務
                $data = [
                    "status" => 0,
                    "message" => "文件處理失敗，所有更改已撤銷"
                ];
                $_SESSION["requestArticle"] = $data;
                // echo "文件處理失敗，所有更改已撤銷。";
            }
        } else {
            $data = [
                "status" => 0,
                "message" => "檔案格式不正確。"
            ];
            $_SESSION["requestArticle"] = $data;
            // echo "檔案格式不正確。";
        }
    } else {
        $data = [
            "status" => 0,
            "message" => "沒有檔案被上傳。"
        ];
        $_SESSION["requestArticle"] = $data;
        // echo "沒有檔案被上傳。";
    }
}


$conn->close();
header("location: articles-list.php");