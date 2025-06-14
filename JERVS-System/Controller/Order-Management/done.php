<?php
    include('../../config/database.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $orderID = $_POST['id'];

        //get the order details
        $stmt = $conn->prepare('SELECT * FROM orders_tbl WHERE id = ?');
        $stmt->bind_param('i', $orderID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $order = $result->fetch_assoc();

            $payment = $order['deposit'];
            $total_price = $order['total_price'];
            $phase = $order['current_phase'];

            //validation
            if ($payment < $total_price) {
                echo '<script>alert("Order still have a balance"); window.history.back();</script>';
                exit();
            }

            if (strtolower($phase) != 'ready') {
                echo '<script>alert("Order is not yet ready"); window.history.back();</script>';
                exit();
            }

            //check if the product is in the inventory
            $inventoryStmt = $conn->prepare('SELECT qty FROM inventory_tbl WHERE item_name = ?');
            $inventoryStmt->bind_param('s', $order['item_name']);
            $inventoryStmt->execute();
            $inventoryResult = $inventoryStmt->get_result();

            if ($inventoryResult && $inventoryResult->num_rows > 0) {
                $inventory = $inventoryResult->fetch_assoc();
                $currentQty = $inventory['qty'];

                // Decrease quantity
                $newQty = $currentQty - $order['qty'];
                if ($newQty < 0) {
                    $newQty = 0; // Prevent negative stock
                }

                $updateStmt = $conn->prepare('UPDATE inventory_tbl SET qty = ? WHERE item_name = ?');
                $updateStmt->bind_param('is', $newQty, $order['item_name']);
                $updateStmt->execute();
            }

            //if it pass the validation insert it to the sales table
            $insertStmt = $conn->prepare('INSERT INTO sales_tbl(order_name, qty, total_price, date_completed) VALUES(?,?,?, CURDATE())');
            $insertStmt->bind_param('sid', $order['item_name'], $order['qty'], $order['total_price']);

            if ($insertStmt->execute()) {
                $deleteStmt = $conn->prepare('DELETE FROM orders_tbl WHERE id = ?');
                $deleteStmt->bind_param('i', $orderID);
                $deleteStmt->execute();

                echo '<script>alert("Order successfully completed and added to monthly sales."); window.location.href="../../View/pages/add-order.php";</script>';
            } else {
                echo '<script>alert("Failed to move order to sales."); window.history.back();</script>';
            }
        } else {
            echo '<script>alert("Invalid request."); window.history.back();</script>';
        }
}
