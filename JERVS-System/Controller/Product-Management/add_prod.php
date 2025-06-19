<?php
    header('Content-Type: application/json');
    include('../../config/database.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $item_name = $_POST['product_name']?? null;
        $category = $_POST['category']?? null;
        $qty = $_POST['stock']?? null;
        $price = $_POST['product_price']?? null;
        $descrip = $_POST['description']?? null;

        if (!$item_name || !$category || !$qty) {
            echo json_encode(['success' => false, 'message' => 'Please fill out all of the fields']);
            exit;
        }

        $stmt = $conn->prepare('INSERT INTO inventory_tbl(item_name, categ, qty, descrip, price) VALUES(?,?,?,?,?)');
        $stmt->bind_param('ssisi', $item_name, $category, $qty, $descrip, $price);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    }
?>
