<?php
    include('../../config/database.php');
    include('../sessioncheck.php');
    include('../../View/parts/sidebar.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $stmt = $conn->prepare('SELECT * FROM orders_tbl WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $order = $result->fetch_assoc();
        $stmt->close();

        if(!$order){
            echo '<script> alert("Order not found");</script>';
        }
    }else{
        echo '<script> alert("No order ID provided");</script>';
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viewing</title>
    <link rel="stylesheet" href="../../View/assets/stylesheet/sidebar.css" />
    <link rel="stylesheet" href="../../View/assets/stylesheet/add-order.css" />
    <link rel="stylesheet" href="../../View/assets/stylesheet/order-management-css/view-details.css">
</head>
<body>
<div class="container">
    <main class="main-content">
        <h1>Order Details</h1>

        <?php if($order): ?>
            <div class="order-details">
                <p><strong>Order ID:</strong> <span><?= htmlspecialchars($order['id']) ?></span></p>
                <p><strong>Order Name:</strong> <span><?= htmlspecialchars($order['item_name']) ?></span></p>
                <p><strong>Order Quantity:</strong> <span><?= htmlspecialchars($order['qty']) ?></span></p>
                <?php $balance = $order['total_price'] - $order['deposit'] ?>
                <p><strong>Order Balance:</strong> <span><?= htmlspecialchars($balance) ?></span></p>
                <p><strong>Order Initial Deposit:</strong> <span><?= htmlspecialchars($order['deposit']) ?></span></p>
                <p><strong>Order Total Price:</strong> <span><?= htmlspecialchars($order['total_price']) ?></span></p>
                <p><strong>Order Details:</strong> <span><?= htmlspecialchars($order['order_details']) ?></span></p>
            </div>
            <button type="button" onclick="window.location.href='../../View/pages/add-order.php'">Back</button>
        <?php endif ?>
    </main>
</div>
</body>
</html>