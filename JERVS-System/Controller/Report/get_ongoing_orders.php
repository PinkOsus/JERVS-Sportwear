<?php
    include('../../config/database.php');
    header('Content-Type: application/json');

    $stmt = "SELECT COUNT(*) AS total_ongoing_orders FROM orders_tbl";
    $result = $conn->query($stmt);

    if($result && $row=$result->fetch_assoc()){
        echo json_encode([
            'success' => true,
            'total_ongoing' => $row['total_ongoing_orders'] ?? 0
        ]);
    }else{
        echo json_encode([
            'success' => false,
            'message' => 'Failed to fetch total_orders'
        ]);
    }
?>