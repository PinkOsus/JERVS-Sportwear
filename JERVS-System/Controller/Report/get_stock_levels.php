<?php
    include('../../config/database.php');
    header('Content-Type: application/json');

    $data = ['success' => false, 'stock_data' => []];

    $stmt = "SELECT item_name, qty FROM inventory_tbl ORDER BY item_name ASC";
    $result = $conn->query($stmt);

    if($result && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data['stock_data'][] = [
                'name' => $row['item_name'],
                'quantity' => (int)$row['qty']
            ];
        }
        $data['success'] = true;
    }else{
        $data = [
            'success' => false,
            'message' => 'No inventory data found'
        ];
    }

    echo json_encode($data);
?>