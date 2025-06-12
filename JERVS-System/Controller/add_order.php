<?php
    header('Content-Type: application/json');
    include('../config/database.php');

    $item_name = htmlspecialchars(trim($_POST['item'] ?? ''));
    $deposit = floatval($_POST['deposit']);
    $total_price = floatval($_POST['tPrice']);
    $qty = floatval($_POST['qty']);
    $addInfo = htmlspecialchars(trim($_POST['addInfo'] ?? ''));
    $progress = htmlspecialchars(trim($_POST['production_stage'] ?? ''));
    //validate input
    if(!$item_name || $deposit <= 0 || !$progress){
        echo json_encode(['success' => false, 'message' => 'Please fill out all of the fields']);
        exit;
    }
    //saving to database;
    $stmt = $conn->prepare('INSERT INTO orders_tbl(item_name, deposit, current_phase, total_price, qty, order_details) VALUES (?,?,?,?,?,?)');
    $stmt->bind_param('ssssss', $item_name, $deposit, $progress, $total_price, $qty, $addInfo);

    if($stmt->execute()){
        echo json_encode(['success' => true]);
    }else{
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
    }

    $stmt->close();
?>