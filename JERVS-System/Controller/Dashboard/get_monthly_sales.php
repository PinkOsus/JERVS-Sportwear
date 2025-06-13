<?php
    header('Content-Type: application/json');
    include('../../config/database.php');

    $monthlySales = array_fill(1, 12, 0);

    $stmt = "SELECT MONTH(date_completed) AS salesmonth, SUM(total_price) AS total
             FROM sales_tbl
             WHERE YEAR(date_completed) = YEAR(CURDATE())
             GROUP BY MONTH(date_completed)";
    
    $result = $conn->query($stmt);

    if($result){
        while($row = $result->fetch_assoc()){
            $month = (int)$row['salesmonth'];
            $total = (float)$row['total'];
            $monthlySales[$month] = $total;
        }
    }

    echo json_encode(array_values($monthlySales));
?>