<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 確認表單是否已經提交

    // 處理檔案上傳
    if (isset($_FILES["file"])) {
        $file = $_FILES["file"];

        // 確認檔案類型為 CSV
        $fileType = pathinfo($file["name"], PATHINFO_EXTENSION);
        if ($fileType != "csv") {
            die("只允許上傳 CSV 檔案。");
        }

        // 檔案存儲目錄
        $targetDir = __DIR__ . "/useruploads/";

        // 生成新的檔案名稱，避免重複
        $targetFile = $targetDir . basename($file["name"]);

        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            // 處理 CSV 檔案內容
            if (is_file($targetFile)) {
                $csvData = array_map("str_getcsv", file($targetFile));
                $header = array_shift($csvData); // 移除 CSV 標題行

                // 這裡可以建立資料庫連接
                require_once("../config/dbConnect.php");

                if ($conn->connect_error) {
                    die("資料庫連接失敗：" . $conn->connect_error);
                }

                // 使用 prepared statements 插入資料
                $sql = "INSERT INTO user (id, name, email, password, birthday, number, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssss", $id, $name, $email, $password, $birthday, $number, $address);

                // 遍歷 CSV 行，插入資料庫
                foreach ($csvData as $row) {
                    // 檢查 CSV 行的元素數量
                    if (count($row) === 7) {
                        list($id, $name, $email, $password, $birthday, $number, $address) = $row;

                        // 使用 prepared statements 插入資料
                        $stmt->execute();

                        if ($stmt->error) {
                            echo "插入資料失敗：" . $stmt->error;
                        }
                    } else {
                        echo "CSV 行的元素數量不正確。";
                    }
                }

                $stmt->close();
                $conn->close();
                // header("Location:members_list.php");
                echo "<script>alert('檔案已成功上傳並匯入到資料庫。'); window.history.back();</script>";
                echo "檔案已成功上傳並匯入到資料庫。";
            } else {
                echo "無法讀取檔案。";
            }
        } else {
            echo "上傳檔案失敗。";
        }
    } else {
        echo "沒有選擇檔案。";
    }
}
