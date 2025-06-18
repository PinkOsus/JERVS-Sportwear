<?php
include('../../config/database.php');
include('../../Controller/sessioncheck.php');

if (!isset($_POST['sales_ids']) || !is_array($_POST['sales_ids'])) {
    echo '<script>alert("No sales selected");window.close();</script>';
    return;
}

$sales_ids = array_map('intval', $_POST['sales_ids']); // sanitize

// Build dynamic placeholders (?, ?, ?) for prepared statement
$placeholders = implode(',', array_fill(0, count($sales_ids), '?'));

$stmt = $conn->prepare("SELECT * FROM sales_tbl WHERE sales_id IN ($placeholders)");
$stmt->bind_param(str_repeat('i', count($sales_ids)), ...$sales_ids);
$stmt->execute();
$result = $stmt->get_result();

$sales = [];
while ($row = $result->fetch_assoc()) {
    $sales[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Receipt | JERVS Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../View/assets/stylesheet/dashboard.css">
    <link rel="stylesheet" href="../../View/assets/stylesheet/sidebar.css">
    <link rel="stylesheet" href="../assets/stylesheet/resibo.css">
    <link rel="icon" href="../../View/assets/img/logo-1.png" type="image/x-icon">
</head>
<body>
    <?php include('../parts/sidebar.php'); ?>
    <div class="receipt-container">
        <div class="header">
            <div class="business-name">JERVS SPORTSWEAR SHOP</div>
            <div class="business-info">Giongco Prop P. Burgos St., Kanluran, Rosario, Cavite</div>
            <div class="business-info">Proprietor: JOHN JERVIE R. BARREDO – Prop.</div>
            <div class="business-info">TIN (Non-VAT): 395-640-724-00000</div>
        </div>

        <div class="invoice-title">OFFICIAL RECEIPT</div>

        <!-- Sales Type -->
        <div class="form-section">
            <div class="form-row">
                <div class="form-label">Sales Type:</div>
                <div class="form-value">
                    <input type="checkbox" class="checkbox"> CASH SALES
                    <input type="checkbox" class="checkbox" style="margin-left: 20px;"> CHARGE SALES
                </div>
            </div>
            <div class="form-row">
                <div class="form-label">Date:</div>
                <div class="form-value"><?= date('Y - m - d') ?></div>
            </div>
            <div class="form-row">
                <div class="form-label">Invoice Number:</div>
                <div class="form-value"></div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="form-section">
            <div class="form-row">
                <div class="form-label">Sold to:</div>
                <div class="form-value"></div>
            </div>
            <div class="form-row">
                <div class="form-label">Registered Name:</div>
                <div class="form-value">John Jervie R. Barredo</div>
            </div>
            <div class="form-row">
                <div class="form-label">TIN:</div>
                <div class="form-value">395 - 640 - 724 - 00000</div>
            </div>
            <div class="form-row">
                <div class="form-label">Business Address:</div>
                <div class="form-value"></div>
            </div>
        </div>

        <!-- Item Table -->
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>QTY.</th>
                    <th>UNIT PRICE</th>
                    <th>AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale): ?>
                <?php $unitCost = (int)($sale['total_price'] / $sale['qty']); ?>
                <tr>
                    <td><?= htmlspecialchars($sale['order_name']) ?></td>
                    <td><?= $sale['qty'] ?></td>
                    <td>₱<?= number_format($unitCost, 2) ?></td>
                    <td>₱<?= number_format($sale['total_price'], 2) ?></td>
                <?php endforeach; ?>
                </tr>
            </tbody>
        </table>

        <!-- Financial Summary -->
        <div class="form-section">
            <div class="form-row">
                <div class="form-label">
                    <input type="checkbox" class="checkbox"> Received the amount of:
                </div>
                <div class="form-value"><?= number_format(array_sum(array_column($sales, 'total_price')), 2) ?></div>
            </div>
            <div class="form-row">
                <div class="form-label">Total Sales:</div>
                <div class="form-value">₱<?= number_format(array_sum(array_column($sales, 'total_price')), 2) ?></div>
            </div>
            <div class="form-row">
                <div class="form-label">Less: Discount (SC/PWD/NAAC/MOC/SP):</div>
                <div class="form-value"></div>
            </div>
            <div class="form-row">
                <div class="form-label">Less: Withholding Tax:</div>
                <div class="form-value"></div>
            </div>
            <div class="form-row total-row">
                <div class="form-label">TOTAL AMOUNT DUE:</div>
                <div class="form-value">₱<?= number_format(array_sum(array_column($sales, 'total_price')), 2) ?></div>
            </div>
        </div>

        <!-- Discount Fields -->
        <div class="form-section">
            <div class="form-row">
                <div class="form-label">SC/PWD/NAAC/MOV/Solo Parent ID No.:</div>
                <div class="form-value"></div>
            </div>
            <div class="form-row">
                <div class="form-label">SC/PWD/NAAC/MOV Signature:</div>
                <div class="form-value"></div>
            </div>
        </div>

        <!-- Footer Notes -->
        <div class="footer">
            <div>7 Days Return Policy Only</div>
        </div>

        <!-- Signature Field -->
        <div class="signature-line">CASHIER/AUTHORIZED PERSON</div>
    </div>

    <div class="print-button">
        <button onclick="window.print()">
            <i class="fas fa-print"></i> Print Receipt
        </button>
    </div>

    <script>
        Auto-print option ()
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>