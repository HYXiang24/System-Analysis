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

// 獲取資料
$sql = "SELECT `status` FROM busy WHERE id=1"; // 修改為你的表名和條件
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 取得資料
    $row = $result->fetch_assoc();
    $value = $row['status'];
} else {
    $value = null;
}
$conn->close();

// 返回JSON格式的數據
header('Content-Type: application/json');
echo json_encode(['status' => $value]);
?>