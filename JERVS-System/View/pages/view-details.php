<?php
    include('../../config/database.php');
    include('../../Controller/sessioncheck.php');

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
    <title>Order Details | JERVS Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../View/assets/stylesheet/dashboard.css">
    <link rel="stylesheet" href="../../View/assets/stylesheet/sidebar.css">
    <link rel="stylesheet" href="../../View/assets/stylesheet/globals.css">
    <link rel="stylesheet" href="../../View/assets/stylesheet/order-management-css/order-details.css">
    <link rel="icon" href="../../View/assets/img/logo-1.png" type="image/x-icon">
</head>
<body>
<?php include('../../View/parts/sidebar.php'); ?>

<div class="main-wrapper">
    <main class="main-content">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="header-content">
                <h1 class="dashboard-title"><i class="fas fa-file-invoice"></i> Order Details</h1>
                <p class="dashboard-subtitle">View complete order information</p>
            </div>
        </div>

        <!-- Order Details Card -->
        <div class="metric-card">
            <div class="chart-header">
                <h2 class="chart-title">Order #<?= htmlspecialchars($order['id']) ?></h2>
            </div>
            
            <?php if($order): ?>
            <div class="order-details-grid">
                <div class="detail-group">
                    <label>Order Name</label>
                    <div class="detail-value"><?= htmlspecialchars($order['item_name']) ?></div>
                </div>
                
                <div class="detail-group">
                    <label>Quantity</label>
                    <div class="detail-value"><?= htmlspecialchars($order['qty']) ?></div>
                </div>
                
                <div class="detail-group">
                    <label>Initial Deposit</label>
                    <div class="detail-value">₱<?= number_format(htmlspecialchars($order['deposit']), 2) ?></div>
                </div>
                
                <div class="detail-group">
                    <label>Total Price</label>
                    <div class="detail-value">₱<?= number_format(htmlspecialchars($order['total_price']), 2) ?></div>
                </div>
                
                <?php $balance = $order['total_price'] - $order['deposit'] ?>
                <div class="detail-group">
                    <label>Balance</label>
                    <div class="detail-value">₱<?= number_format($balance, 2) ?></div>
                </div>
                
                <div class="detail-group full-width">
                    <label>Additional Details</label>
                    <div class="detail-value"><?= htmlspecialchars($order['order_details']) ?: 'No additional details' ?></div>
                </div>
            </div>
            
            <div class="form-buttons">
                <a href="../../View/pages/add-order.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Orders
                </a>
            </div>
            <?php endif; ?>
        </div>
    </main>
</div>
</body>
<script src="../../View/script/sidebarjs/sidebar.js"></script>
</html>