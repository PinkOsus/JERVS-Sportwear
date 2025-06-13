<?php
    include('../../config/database.php');

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])){
        $orderID = $_POST['id'];

        //get the order details
        $stmt = $conn->prepare('SELECT * FROM orders_tbl WHERE id = ?');
        $stmt->bind_param('i', $orderID);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result && $result->num_rows > 0){
            $order = $result->fetch_assoc();

            $payment = $order['deposit'];
            $total_price = $order['total_price'];
            $phase = $order['current_phase'];

            //validation
            if($payment < $total_price){
                echo '<script>alert("Order still have a balance"); window.history.back();</script>';
                exit();
            }

            if(strtolower($phase) != 'ready'){
                echo '<script>alert("Order is not yet ready"); window.history.back();</script>';
                exit();
            }

            //if it pass the validation insert it to the sales table
            $insertStmt = $conn->prepare('INSERT INTO sales_tbl(order_name, qty, total_price, date_completed) VALUES(?,?,?, CURDATE())');
            $insertStmt->bind_param('sid', $order['item_name'], $order['qty'], $order['total_price']);

            if($insertStmt->execute()){
                $deleteStmt = $conn->prepare('DELETE FROM orders_tbl WHERE id = ?');
                $deleteStmt->bind_param('i', $orderID);
                $deleteStmt->execute();

                echo '<script>alert("Order successfully completed and added to monthly sales."); window.location.href="../../View/pages/add-order.php";</script>';
            }else{
                echo '<script>alert("Failed to move order to sales."); window.history.back();</script>';
            }
        }else{
            echo '<script>alert("Invalid request."); window.history.back();</script>';
        }
    }
?>