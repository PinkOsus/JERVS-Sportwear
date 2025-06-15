<?php
    header('Content-Type: application/json');
    include('../../config/database.php');

    $thisMonth = (int)date('m');
    $lastMonth = $thisMonth === 1 ? 12 : $thisMonth - 1;
    $year = (int)date('Y');
    $lastMonthYear = $thisMonth === 1 ? $year - 1: $year;

    $stmt = "SELECT MONTH(date_completed) AS month, SUM(total_price) AS total, COUNT(*) AS transaction_total
             FROM sales_tbl
             WHERE (YEAR(date_completed) = $year AND MONTH(date_completed) = $thisMonth)
             OR
             (YEAR(date_completed) = $lastMonthYear AND MONTH(date_completed) = $lastMonth)
             GROUP BY MONTH(date_completed)";
    
    $result = $conn->query($stmt);
    $data = [
        'this_month' => [
            'transactions' => 0,
            'total_sales' => 0
        ],
        'last_month' => [
            'transactions' => 0,
            'total_sales' => 0
        ]
    ];

    if($result){
        while($row = $result->fetch_assoc()){
            $month = (int)$row['month'];
            if($month == $thisMonth){
                $data['this_month']['transactions'] = (int)$row['transaction_count'];
                $data['this_month']['total_sales'] = (float)$row['total'];
            }elseif($month == $lastMonth){
                $data['last_month']['transactions'] = (int)$row['transaction_count'];
                $data['last_month']['total_sales'] = (float)$row['total'];
            }
        }
    }

    echo json_encode($data);
?>