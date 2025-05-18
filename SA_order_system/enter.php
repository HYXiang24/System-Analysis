<?php
// 開始 session
session_start();

// 資料庫連接參數
$servername = "localhost";
$username = "root";
$password = "1114576";
$dbname = "sa";

// 創建連接
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 檢查表單提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];

    // 防止 SQL 注入
    $phone = mysqli_real_escape_string($conn, $phone);

    // 查詢有沒有該用戶
    $sql = "SELECT * FROM customer WHERE phone_number = '$phone'";
    $result = $conn->query($sql);
    if ($result->num_rows === 0) {
        $sql = "INSERT INTO customer(phone_number) values ('$phone')";
        if ($conn->query($sql) === TRUE) {
            echo "新記錄創建成功";
            $_SESSION['phone'] = "$phone";
            header("Location: order.html");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $sql = "SELECT isBlockList FROM customer WHERE phone_number = '$phone'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
 
        if ($row['isBlockList'] == 1) {
            echo '
            <script>
            alert("你已被店家設爲黑名單，禁止點餐！");
            window.location.href = "enter.html";
            </script>
            ';

        } else {
            $_SESSION['phone'] = "$phone";
            header("Location: order.html");
            exit;
        }
    }
}

// 關閉連接
$conn->close();
?>