<?php
$servername = "localhost";
$username = "root";
$password = "1114576";
$dbname = "sa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$itemclass = $_POST['itemclass'];
$itemname = $_POST['itemname'];
$itemPrice = $_POST['itemPrice'];

$conn->set_charset("utf8");
$sql = "UPDATE menu SET price = '$itemPrice' WHERE name = '$itemname'";
$result = $conn->query($sql);
$conn->close();
header('Location: menu.html');
exit();
?>