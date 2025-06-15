<?php
    include('../../config/database.php');
    header('Content-Type: application/json');

    $stmt = "SELECT SUM(total_price) AS total_revenue FROM sales_tbl";
    $result = $conn->query($stmt);

    if($result && $row = $result->fetch_assoc()){
        echo json_encode([
            'success' => true,
            'total_revenue' => $row['total_revenue'] ?? 0
        ]); 
    }else{
        echo json_encode([
            'success' => false,
            'message' => 'Failed to fetch total_revenue'
        ]); 
    }
?>