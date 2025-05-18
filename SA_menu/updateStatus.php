<?php
$servername = "localhost";
$username = "root"; // 根據實際情況修改
$password = "1114576"; // 根據實際情況修改
$dbname = "sa"; // 修改為你的數據庫名稱

// 創建連接
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 獲取JSON數據
$data = json_decode(file_get_contents('php://input'), true);
$status = $data['status'];

// 更新數據庫
$sql = "UPDATE busy SET status='$status' WHERE id=1"; // 修改為你的表名和條件

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>