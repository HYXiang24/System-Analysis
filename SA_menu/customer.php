<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>店家_顧客管理</title>
    <style type="text/css">
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
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 10px;
            width: 200px;
            margin-right: 10px;
        }

        button {
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .back {
            position: fixed;
            top: 20px;
            right: 40px;
        }
    </style>
</head>

<body>
    <div class="header">
        顧客管理
    </div>
    <a class="back" href="main.html"><img width="50" height="50" src="./image/home.png" alt="返回首頁"></a>
    <form action="./customer.php" method="get" id="blacklistForm">
        <label for="phoneNumber">手機號碼:</label>
        <input type="text" id="phoneNumber" name="phoneNumber" required>
        <button type="submit">切換黑、白名單</button>
    </form>
    <h2>黑名單</h2>
    <!--
    <table id="blacklistTable">
        <thead>
            <tr>
                <th>手機號碼</th>
            </tr>
        </thead>
        <tbody>
            黑名單項目將插入這裡 -->
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "1114576";
    $dbname = "sa";

    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    if (isset($_GET["phoneNumber"]) && !empty($_GET["phoneNumber"])) {
        // 防止 SQL 注入攻擊
        $phoneNumber = filter_var($_GET["phoneNumber"], FILTER_SANITIZE_STRING); 
    
        // 查詢數據庫當前 isBlockList 的值
        $sql = "SELECT isBlockList FROM customer WHERE phone_number = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$phoneNumber]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // 根據當前 isBlockList 的值設定新的值
        if ($result && $result['isBlockList'] == 1) {
            $newIsBlockList = 0;
        } else {
            $newIsBlockList = 1;
        }
    
        // 更新數據庫
        $sql = "UPDATE customer SET isBlockList = ? WHERE phone_number = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$newIsBlockList, $phoneNumber]);

        //清除頁面緩存
        header("Location: " . $_SERVER['PHP_SELF']); 
    }
    
    
    $sql = "SELECT phone_number FROM customer
            WHERE isBlockList = 1";
    $stmt = $pdo->query($sql);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>手機號碼</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . $row['phone_number'] . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

    echo "<h2>白名單</h2>";
    $sql = "SELECT phone_number FROM customer
            WHERE isBlockList = 0";
    $stmt = $pdo->query($sql);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>手機號碼</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . $row['phone_number'] . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    ?>
    </tbody>
    </table>

    <!--<script>
        document.getElementById('blacklistForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const phoneNumber = document.getElementById('phoneNumber').value;
            if (phoneNumber) {
                addPhoneNumberToBlacklist(phoneNumber);
                document.getElementById('phoneNumber').value = ''; // 清空輸入框
            }
        });

        function addPhoneNumberToBlacklist(phoneNumber) {
            const tableBody = document.getElementById('blacklistTable').querySelector('tbody');
            const newRow = document.createElement('tr');
            const newCell = document.createElement('td');
            newCell.textContent = phoneNumber;
            newRow.appendChild(newCell);
            tableBody.appendChild(newRow);
        }
    </script>-->
</body>