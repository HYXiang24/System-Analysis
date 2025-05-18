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

        .header {
            /* 背景 */
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

        th,
        td {
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

        .left {
            width: 60%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .right {
            width: 40%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .flex-container {
            display: flex;
            justify-content: space-between;
        }

        .form-btn {
            background-color: rgb(223, 107, 29);
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .form-btn-red {
            background-color: red;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .form-btn:hover {
            background-color: rgb(240, 131, 58);
        }

        .form-btn-red:hover {
            background-color: rgb(255, 105, 97);
        }
    </style>
</head>

<body>

    <div class="header">客戶明細</div>
    <a class="back" href="main.html"><img width="50" height="50" src="./image/home.png" alt="返回首頁"></a>
    <div class="container">

        <form action="./detail_more.php" method="get">
            <div class="search-bar">
                <input type="text" name="id" id="searchInput" onkeyup="filterTable()" placeholder="請輸入訂單編號查詢...">
                <button type="submit">搜尋</button>
            </div>
        </form>
        <div class="flex-container">
            <div class="left">
                <h2>進行中訂單</h2>

                <?php
                $servername = "localhost";
                $username = "root";
                $password = "1114576";
                $dbname = "sa";

                $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                if (isset($_GET["orderId"]) && !empty($_GET["orderId"])) {
                    //移入歷史訂單
                    $orderId = $_GET["orderId"];
                    $sql = "UPDATE c_order SET isCheck = 1 WHERE id = $orderId";
                    $stmt = $pdo->query($sql);
                    /*
                    //扣除庫存
                    $sql = "SELECT product, quantity FROM cart WHERE id = '$orderId'";
                    $stmt = $pdo->query($sql);
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    //雙重回圈讀取資料並修改數量
                    foreach ($results as $result) {
                        $fname = $result["product"];
                        $fquantity = $result["quantity"];
                        $sql = "SELECT composition, quantity FROM menu_composition WHERE name = '$fname'";
                        $stmt = $pdo->query($sql);
                        $results2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($results2 as $result2) {
                            $fname2 = $result2["composition"];
                            $fquantity2 = $result2["quantity"];
                            $sql = "UPDATE food SET quantity = quantity - ('$fquantity' * '$fquantity2') WHERE name = '$fname2' ";
                            $stmt = $pdo->query($sql);
                        }
                    }
                    */
                    //清除頁面緩存
                    header("Location: " . $_SERVER['PHP_SELF']);
                }
                $sql = "SELECT * FROM c_order ORDER BY time";
                $stmt = $pdo->query($sql);

                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>訂單編號</th>";
                echo "<th>訂單時間</th>";
                echo "<th>總金額</th>";
                echo "<th>電話</th>";
                echo "<th>訂單細節</th>";
                echo "<th>完成訂單</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                foreach ($results as $row) {
                    if ($row["isCheck"] == 0) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['time'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>" . $row['phone_number'] . "</td>";
                        echo "<td><form action='./detail_more.php' method='get'><input type='hidden' name='id' value='" . $row['id'] . "'><input type='submit' class='form-btn' value='訂單細節'></form></td>";
                        echo "<td><form action='./detail.php' method='get'><input type='hidden' name='orderId' value='" . $row['id'] . "'><input type='submit' class='form-btn-red' value='標記為歷史訂單'></form></td>";
                        echo "</tr>";
                    }
                }

                echo "</tbody>";
                echo "</table>";
                ?>
            </div>
            <div class="right">
                <h2>歷史訂單</h2>
                <?php
                $sql = "SELECT * FROM c_order ORDER BY time";
                $stmt = $pdo->query($sql);

                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>訂單編號</th>";
                echo "<th>訂單時間</th>";
                echo "<th>訂單金額</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                foreach ($results as $row) {
                    if ($row["isCheck"] == 1) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['time'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </div>
        </div>


</body>

</html>