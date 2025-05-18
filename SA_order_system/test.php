<?php
$servername = "localhost";
$username = "root";
$password = "1114576";
$dbname = "sa";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 獲取菜單
    $stmt = $conn->prepare("SELECT category, name, price FROM menu");
    $stmt->execute();
    $menu = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 獲取食材剩餘數量
    $stmt = $conn->prepare("SELECT name, quantity FROM food");
    $stmt->execute();
    $ingredients = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $ingredients_map = [];
    foreach ($ingredients as $ingredient) {
        $ingredients_map[$ingredient['name']] = $ingredient['quantity'];
    }

    // 獲取每個菜品所需的食材數量
    $stmt = $conn->prepare("SELECT name, composition, quantity FROM menu_composition");
    $stmt->execute();
    $compositions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $compositions_map = [];
    foreach ($compositions as $composition) {
        if (!isset($compositions_map[$composition['composition']])) {
            $compositions_map[$composition['composition']] = [];
        }
        $compositions_map[$composition['composition']][] = [
            'name' => $composition['name'],
            'quantity' => $composition['quantity']
        ];
    }

    // 將數據組合在一起
    $menu_with_ingredients = [];
    foreach ($menu as $menu_item) {
        $menu_item_name = $menu_item['name'];
        $required_ingredients = $compositions_map[$menu_item_name] ?? [];
        $sufficient = true;
        foreach ($required_ingredients as $ingredient) {
            if ($ingredients_map[$ingredient['name']] < $ingredient['quantity']) {
                $sufficient = false;
                break;
            }
        }
        $menu_item['sufficient'] = $sufficient;
        $menu_with_ingredients[] = $menu_item;
    }

    header('Content-Type: application/json');
    echo json_encode(['menu' => $menu_with_ingredients]);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
