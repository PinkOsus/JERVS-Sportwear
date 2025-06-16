<?php
    include('../../config/database.php');
    header('Content-Type: application/json');

    $days = isset($_GET['days']) ? intval($_GET['days']) : 30;

    $query = "SELECT order_name, SUM(qty) AS total_qty
             FROM sales_tbl
             WHERE date_completed >= DATE_SUB(CURDATE(), INTERVAL ? DAY)
             GROUP BY order_name
             ORDER BY total_qty DESC
             LIMIT 5";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $days);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = ['labels' => [], 'data' => []];

    while($row = $result->fetch_assoc()){
        $data['labels'][] = $row['order_name'];
        $data['data'][] = $row['total_qty'];
    }

    echo json_encode($data);
?>