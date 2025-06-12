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
</head>
<body>
    <div class="container">
        <main class="main-content">
            <h1>Order Details</h1>

            <?php if($order): ?>
                <div class="order-details">
                    <p><strong>Order ID: <?= htmlspecialchars($order['id']) ?> </strong></p>
                    <p><strong>Order Name: <?= htmlspecialchars($order['item_name']) ?> </strong></p>
                    <p><strong>Order Quantity: <?= htmlspecialchars($order['qty']) ?> </strong></p>
                    <?php $balance = $order['total_price'] -  $order['deposit'] ?>
                    <p><strong>Order Balance: <?= htmlspecialchars($balance) ?> </strong></p>
                    <p><strong>Order Initial Deposit: <?= htmlspecialchars($order['deposit']) ?> </strong></p>
                    <p><strong>Order Total Price: <?= htmlspecialchars($order['total_price']) ?> </strong></p>
                    <p><strong>Order Details: <?= htmlspecialchars($order['order_details']) ?> </strong></p>
                </div>
                <a href="../../View/pages/add-order.php"><button type="button">Back</button></a>
            <?php else: ?>
            <?php endif ?>
        </main>
    </div>
</body>
</html>