<?php
$servername = "localhost";
$username = "root";
$password = "1114576";
$dbname = "sa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
$sql = "SELECT * FROM menu";
$result = $conn->query($sql);

$menu = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $menu[] = [
            'category' => $row["category"],
            'name' => $row["name"],
            'price' => $row["price"],
            'image_path' => $row["image_path"]
        ];
    }
}

$conn->close();

echo json_encode(['menu' => $menu], JSON_UNESCAPED_UNICODE);
?>