<?php
include('../../config/database.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemName = $_POST['item'];
    $quantity = $_POST['qty'];
    $deposit = $_POST['deposit'];
    $totalPrice = $_POST['tPrice'];
    $additionalInfo = $_POST['addInfo'];
    $productionStage = $_POST['production_stage'];
    
    // Calculate balance
    $balance = $totalPrice - $deposit;
    
    // Insert into database
    $stmt = $conn->prepare("INSERT INTO orders_tbl (item_name, qty, deposit, total_price, balance, current_phase, additional_info) 
                           VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sidddss", $itemName, $quantity, $deposit, $totalPrice, $balance, $productionStage, $additionalInfo);
    
    if ($stmt->execute()) {
        $orderId = $stmt->insert_id;
        
        // Get the newly created order
        $result = $conn->query("SELECT * FROM orders_tbl WHERE id = $orderId");
        $order = $result->fetch_assoc();
        
        echo json_encode([
            'success' => true,
            'order' => $order
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error adding order: ' . $conn->error
        ]);
    }
    
    $stmt->close();
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}