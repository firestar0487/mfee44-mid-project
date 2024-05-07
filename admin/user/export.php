<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("../config/dbConnect.php");

$output = "";

if (isset($_POST['submit'])) {
    $sql = "SELECT * FROM `user`";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        // Output Excel header
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=reports.xls');
        header('Cache-Control: max-age=0');

        $output .= '<table class="table" border="1">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Birthday</th>
                            <th>Number</th>
                            <th>Address</th>
                        </tr>';

        while ($row = mysqli_fetch_array($res)) {
            $output .= '<tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['name'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['password'] . '</td>
                            <td>' . $row['birthday'] . '</td>
                            <td>' . $row['number'] . '</td>
                            <td>' . $row['address'] . '</td>
                        </tr>';
        }

        $output .= '</table>';

        echo $output;
        exit(); // 確保輸出後終止腳本的執行
    } else {
        echo 'no data found';
    }
}
?>


