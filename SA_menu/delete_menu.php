<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "1114576";
$dbname = "sa";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

$itemId = $_POST['id'];

// 創建 SQL 語句以刪除對應的項目
$sql = "DELETE FROM menu WHERE name = '$itemId'";

if ($conn->query($sql) === TRUE) {
  echo "項目成功刪除";
} else {
  echo "錯誤：" . $conn->error;
}

// 關閉連接
$conn->close();

?>