<?php
$servername = "localhost";
$username = "root";
$password = "1114576";
$dbname = "sa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$category = $_POST['category'];
$itemName = $_POST['itemName'];
$itemPrice = $_POST['itemPrice'];
$target_dir = "./image/";
$target_file = $target_dir . basename($_FILES["itemImage"]["name"]);

$conn->set_charset("utf8");
$sql = "SELECT * FROM menu WHERE name='$itemName'";
$result = $conn->query($sql);
if ($result->num_rows === 0) {
    //if (move_uploaded_file($_FILES["itemImage"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO menu (category, name, price, image_path)
                VALUES ('$category', '$itemName', '$itemPrice', '$target_file')";
    
        if ($conn->query($sql) === TRUE) {
            echo "新記錄創建成功";
            header('Location: menu.html');
            exit();
        } else {
            echo "錯誤: " . $sql . "<br>" . $conn->error;
        }
    //} else {
    //    echo "上傳圖片失敗。";
    //}
}
$conn->close();
?>