<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>店家_客戶明細</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .header {     /* 背景 */
            background-color: rgb(223, 107, 29);
            height: 80px;
            width: 100%;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
            font-size: 1.5em; 
            font-weight: bold;
            padding-left: 20px; 
            box-sizing: border-box;
        }
        .container {
            padding: 20px;
        }
        .search-bar {
            width: 75%;
            margin: 20px auto;
            display: flex;
            justify-content: center;
        }
        .search-bar input {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        table {
            width: 75%;
            margin: 0 auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .back {
            position: fixed;
            top: 20px;
            right: 40px;
        }
    </style>
</head>
<body>
    <div class="header">客戶明細</div>
    <a class="back" href="main.html"><img width="50" height="50" src="./image/home.png" alt="返回首頁"></a>
    <div class="container">

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "1114576";
    $dbname = "sa";

    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $id = $_GET ["id"];

    $sql = "SELECT * FROM cart WHERE id = '$id'";
    $stmt = $pdo->query($sql);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>商品</th>";
    echo "<th>數量</th>";
    echo "<th>價格</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . $row['product'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    ?>
</body>
</html>