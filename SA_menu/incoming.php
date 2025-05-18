<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>店家_進貨管理</title>
    <style type="text/css">
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
            display: flex;
            padding: 20px;
        }

        .form-container {
            width: 40%;
            margin-right: 20px;
        }

        .form-container label {
            display: block;
            margin: 10px 0 5px;
        }

        .form-container input,
        .form-container select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .form-container input[type="submit"] {
            background-color: rgb(223, 107, 29);
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1em;
        }

        .table-container {
            width: 60%;
            margin-left: 20px;
        }

        table {
            width: 100%;
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

        .action-buttons {
            display: flex;
            justify-content: center;
        }

        .action-buttons button {
            margin: 0 5px;
            padding: 5px 10px;
            cursor: pointer;
            border: none;
            background-color: #d87c0b;
            color: white;
        }

        .total-table-container {
            padding: 20px;
        }

        .back {
            position: fixed;
            top: 20px;
            right: 40px;
        }
    </style>
</head>
<?php
$servername = "localhost";
$username = "root";
$password = "1114576";
$dbname = "sa";

$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

if (isset($_GET["deleteName"]) && !empty($_GET["deleteName"])) {
    $deleteName = filter_var($_GET["deleteName"], FILTER_SANITIZE_STRING);
    $sql = "DELETE FROM food WHERE name = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$deleteName]);
    //清除頁面緩存
    header("Location: " . $_SERVER['PHP_SELF']);
}

if (isset($_GET["foodName"]) && !empty($_GET["foodName"]) && isset($_GET["addNumber"]) && !empty($_GET["addNumber"])) {
    // 防止 SQL 注入攻擊
    $foodName = filter_var($_GET["foodName"], FILTER_SANITIZE_STRING);
    $addNumber = filter_var($_GET["addNumber"], FILTER_SANITIZE_STRING);

    $sql = "SELECT name FROM food WHERE name = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$foodName]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($result && $result['name'] == $foodName) {
        $sql = "UPDATE food SET quantity = ? WHERE name = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$addNumber, $foodName]);

    } else {
        $sql = "INSERT INTO food(name, quantity) VALUE(?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$foodName, $addNumber]);
    }

    //清除頁面緩存
    header("Location: " . $_SERVER['PHP_SELF']);

}

?>

<body>

    <div class="header">進貨管理</div>
    <a class="back" href="main.html"><img width="50" height="50" src="./image/home.png" alt="返回首頁"></a>
    <div class="container">
        <div class="form-container">
            <form id="addIngredientForm">
                <!--<label for="ingredientType">選擇食材種類：</label>
                <select name="ingredientType" id="ingredientType">
                    <option value="麵包">麵包</option>
                    <option value="蔬菜">蔬菜</option>
                    <option value="肉類">肉類</option>
                    <option value="其他">其他</option>
                </select>-->
                <form action="./incoming.php" method="get">
                    <label for="foodName">食材名稱：</label>
                    <input type="text" name="foodName" id="foodName" required>

                    <label for="addNumber">修改數量：</label>
                    <input type="number" name="addNumber" id="addNumber" min="0" required>

                    <!--<label for="addDate">新增日期：</label>
                <input type="date" name="addDate" id="addDate" required>
                -->
                    <button type="submit"
                        style="background-color: #f0a500; color: white; border: none; padding: 10px 20px; font-size: 16px; cursor: pointer; border-radius: 5px;">新增</button>
                </form>
                <br><br>
                <form action="./incoming.php" method="get">
                    <label for="deleteName">刪除食材：</label>

                    <input type="text" name="deleteName" id="foodName" required>

                    <!--<label for="addDate">新增日期：</label>
                <input type="date" name="addDate" id="addDate" required>
                -->
                    <button type="submit"
                        style="background-color: red; color: white; border: none; padding: 10px 20px; font-size: 16px; cursor: pointer; border-radius: 5px;">刪除</button>
                </form>
                </>
        </div>
        <div class="table-container">
            <br><br>
            <?php
            //$servername = "localhost";
            //$username = "s1114580";
            //$password = "1114580";
            //$dbname = "sa";

            //$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $sql = "SELECT name, quantity FROM food";
            $stmt = $pdo->query($sql);

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>食材名稱</th>";
            echo "<th>庫存數量</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            foreach ($results as $row) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";


            ?>
        </div>
    </div>
    <div>

    </div>
    <!--<div class="total-table-container">
        <h2>食材名稱庫存總數量</h2>
        <table id="totalInventoryTable">
            <thead>
                <tr>
                    <th>食材名稱</th>
                    <th>庫存總數量</th>
                </tr>
            </thead>
            <tbody>-->
    <!-- Total inventory rows will be inserted here -->
    <!--</tbody>
        </table>
    </div>-->

    <!--<script>
        document.getElementById('addIngredientForm').addEventListener('submit', function(event) {
            event.preventDefault(); 

            // get 表單資料
            const ingredientType = document.getElementById('ingredientType').value;
            const foodName = document.getElementById('foodName').value;
            const addNumber = parseInt(document.getElementById('addNumber').value, 10);
            const addDate = document.getElementById('addDate').value;

            // build new list
            const table = document.getElementById('inventoryTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();

            const cell1 = newRow.insertCell(0);
            const cell2 = newRow.insertCell(1);
            const cell3 = newRow.insertCell(2);
            const cell4 = newRow.insertCell(3);
            const cell5 = newRow.insertCell(4);

            cell1.textContent = foodName;
            cell2.textContent = ingredientType;
            cell3.textContent = addNumber;
            cell4.textContent = addDate;
            cell5.innerHTML = `
                <div class="action-buttons">
                    <button onclick="editRow(this)">修改</button>
                    <button onclick="deleteRow(this)">刪除</button>
                </div>
            `;

            updateTotalInventory(foodName, addNumber);

            // reset表單
            document.getElementById('addIngredientForm').reset();
        });

        function deleteRow(button) {
            const row = button.closest('tr');
            const foodName = row.cells[0].textContent;
            const quantity = parseInt(row.cells[2].textContent, 10);
            row.remove();
            updateTotalInventory(foodName, -quantity);
        }

        function editRow(button) {
            const row = button.closest('tr');
            const cells = row.getElementsByTagName('td');

            const foodName = cells[0].textContent;
            const ingredientType = cells[1].textContent;
            const addNumber = cells[2].textContent;
            const addDate = cells[3].textContent;

            document.getElementById('foodName').value = foodName;
            document.getElementById('ingredientType').value = ingredientType;
            document.getElementById('addNumber').value = addNumber;
            document.getElementById('addDate').value = addDate;

            
            row.remove();
            updateTotalInventory(foodName, -parseInt(addNumber, 10));
        }

        function updateTotalInventory(foodName, quantityChange) {
            const totalTable = document.getElementById('totalInventoryTable').getElementsByTagName('tbody')[0];
            let rowFound = false;

            for (let row of totalTable.rows) {
                if (row.cells[0].textContent === foodName) {
                    const currentQuantity = parseInt(row.cells[1].textContent, 10);
                    const newQuantity = currentQuantity + quantityChange;

                    if (newQuantity > 0) {
                        row.cells[1].textContent = newQuantity;
                    } else {
                        row.remove();
                    }
                    rowFound = true;
                    break;
                }
            }

            if (!rowFound && quantityChange > 0) {
                const newRow = totalTable.insertRow();
                const cell1 = newRow.insertCell(0);
                const cell2 = newRow.insertCell(1);
                cell1.textContent = foodName;
                cell2.textContent = quantityChange;
            }
        }
    </script>-->
</body>

</html>