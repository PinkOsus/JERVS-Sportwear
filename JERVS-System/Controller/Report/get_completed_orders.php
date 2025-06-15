<?php
    include('../../config/database.php');
    header('Content-Type: application/json');

    $stmt = "SELECT COUNT(*) AS total_orders FROM sales_tbl";
    $result = $conn->query($stmt);

    if($result && $row=$result->fetch_assoc()){
        echo json_encode([
            'success' => true,
            'total_orders' => $row['total_orders'] ?? 0
        ]);
    }else{
        echo json_encode([
            'success' => false,
            'message' => 'Failed to fetch total_orders'
        ]);
    }
?>