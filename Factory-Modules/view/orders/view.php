<?php
include('../../config/database.php');
include('../../Controller/sessioncheckup.php');

// if(isset($_GET['id'])){
//     $id = $_GET['id'];
//     $stmt = $conn->prepare('SELECT * FROM orders_tbl WHERE id = ?');
//     $stmt->bind_param('i', $id);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $order = $result->fetch_assoc();
//     $stmt->close();

//     if(!$order){
//         echo '<script>alert("Order not found");window.location="order-production.php";</script>';
//         exit;
//     }
// }else{
//     echo '<script>alert("No order ID provided");window.location="order-production.php";</script>';
//     exit;
// }
// ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details | JERVS Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/universal.css">
    <link rel="stylesheet" href="../../assets/css/order.css">
    <link rel="icon" href="../../assets/img/logo-1.png" type="image/x-icon">
</head>
<body>
<?php include('../partials/sidebar.php'); ?>

<div class="main-wrapper">
    <main class="main-content">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="header-content">
                <h1 class="dashboard-title"><i class="fas fa-file-invoice"></i> Order Details</h1>
                <p class="dashboard-subtitle">View complete order information</p>
            </div>
            <div class="header-actions">
                <a href="order-production.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Production
                </a>
            </div>
        </div>

        <!-- Order Details Card -->
        <!-- <div class="sales-section">
            <div class="section-header">
                <h2 class="section-title">Order #<?= htmlspecialchars($order['id']) ?></h2> -->
                <!-- Status Badge (uncomment if you want to show status) -->
                <!-- <span class="status-badge <?= htmlspecialchars($order['current_phase']) ?>">
                    <?= htmlspecialchars(ucfirst($order['current_phase'])) ?>
                </span> -->
            </div>
            
            <!-- <div class="order-details-grid">
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
                    <div class="detail-value price">₱<?= number_format(htmlspecialchars($order['deposit']), 2) ?></div>
                </div>
                
                <div class="detail-group">
                    <label>Total Price</label>
                    <div class="detail-value price">₱<?= number_format(htmlspecialchars($order['total_price']), 2) ?></div>
                </div>
                
                <?php $balance = $order['total_price'] - $order['deposit'] ?>
                <div class="detail-group">
                    <label>Balance</label>
                    <div class="detail-value price">₱<?= number_format($balance, 2) ?></div>
                </div>
                
                <div class="detail-group full-width">
                    <label>Additional Details</label>
                    <div class="detail-value"><?= htmlspecialchars($order['order_details']) ?: 'No additional details' ?></div>
                </div>
                
                <div class="detail-group">
                    <label>Production Stage</label>
                    <div class="detail-value">
                        <span class="status-badge <?= htmlspecialchars($order['current_phase']) ?>">
                            <?= htmlspecialchars(ucfirst($order['current_phase'])) ?>
                        </span>
                    </div>
                </div>
                
                <div class="detail-group">
                    <label>Last Updated</label>
                    <div class="detail-value"><?= htmlspecialchars($order['last_updated']) ?></div>
                </div>
            </div> -->
            
            <div class="form-buttons">
                <a href="edit.php?id=<?= $order['id'] ?>" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Order
                </a>
                <a href="order-production.php" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Close
                </a>
            </div>
        </div>
    </main>
</div>
</body>
</html>