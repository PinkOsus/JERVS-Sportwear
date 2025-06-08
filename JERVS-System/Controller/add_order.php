<?php
    header('Content-Type: application/json');
    error_reporting(0);
    include('../config/database.php');

    $item_name = htmlspecialchars(trim($_POST['item'] ?? ''));
    $deposit = floatval($_POST['deposit']);
    $progress = htmlspecialchars(trim($_POST['production_stage'] ?? ''));
    //validate input
    if(!$item_name || $deposit <= 0 || !$progress){
        echo json_encode(['success' => false, 'message' => 'Please fill out all of the fields']);
        exit;
    }
    //saving to database;
    $stmt = $conn->prepare('INSERT INTO orders_tbl(item_name, deposit, current_phase) VALUES (?,?,?)');
    $stmt->bind_param('sss', $item_name, $deposit, $progress);

    if($stmt->execute()){
        echo json_encode(['success' => true]);
    }else{
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
    }

    $stmt->close();
?>