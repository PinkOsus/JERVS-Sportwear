<?php
include('../../config/database.php');
include('../../Controller/sessioncheck.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management | JERVS Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/stylesheet/dashboard.css">
    <link rel="stylesheet" href="../assets/stylesheet/order-management-css/order-management.css">
    <link rel="icon" href="../assets/img/logo-1.png" type="image/x-icon">
</head>
<body>
<?php include('../parts/sidebar.php'); ?>

<div class="main-wrapper">
    <main class="main-content">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="header-content">
                <h1 class="dashboard-title"><i class="fas fa-shopping-cart"></i> Order Management</h1>
                <p class="dashboard-subtitle">Manage and track customer orders</p>
            </div><br>
            <div class="header-actions">
                <button id="openAddOrderBtn" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Order
                </button>
                <button onclick="location.reload()" class="btn btn-secondary">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
            </div>
        </div>

        <!-- ADD ORDER PANEL -->
        <div class="metric-card" id="addOrder" style="display: none;">
            <div class="chart-header">
                <h2 class="chart-title"><i class="fas fa-cart-plus"></i> Add New Order</h2>
            </div>
            <form id="addOrderForm" method="POST" action="../../Controller/Order-Management/add_order.php">
                <div class="form-group"><br><br>
                    <label>Order Name:</label>
                    <input list="inventory-list" type="text" name="item" id="itemInput" class="form-control" required />
                    <datalist id="inventory-list">
                        <?php
                        $inventoryStmt = 'SELECT item_name FROM inventory_tbl';
                        $result = $conn->query($inventoryStmt);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . htmlspecialchars($row['item_name'], ENT_QUOTES) . "'>";
                        }
                        ?>
                    </datalist>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Printing Method</label>
                        <select id="materialSelect" class="form-control" name="material">
                            <option value="none">None</option>
                            <option value="sublimation">Sublimation</option>
                            <option value="mesh">Mesh</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Garment Type</label>
                        <select id="typeSelect" class="form-control" name="garment_type">
                            <option value="jersey">Jersey</option>
                            <option value="tshirt">T-Shirt</option>
                            <option value="short">Short</option>
                            <option value="hoodie">Hoodie</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Select Additional Materials</label><br>
                    <?php
                    $materialQuery = "SELECT id, item_name, price FROM inventory_tbl WHERE categ = 'materials'";
                    $result = $conn->query($materialQuery);

                    if ($result && $result->num_rows > 0):
                        while ($row = $result->fetch_assoc()):
                            $id = $row['id'];
                            $name = htmlspecialchars($row['item_name']);
                            $price = (float)$row['price'];
                    ?>
                        <label>
                            <input type="radio" name="addMaterials" class="material-radio" data-price="<?= $price ?>" value="<?= $name ?>"> <?= $name ?> (₱<?= number_format($price, 2) ?>)
                        </label>
                    <?php
                        endwhile;
                    else:
                        echo "No materials found.";
                    endif;
                    ?>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Initial Deposit</label>
                        <input type="number" name="deposit" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="qty" id="qtyInput" class="form-control" required />
                    </div>
                </div>

                <div class="form-group">
                    <label>Estimated Total Price (Auto-Calculated)</label>
                    <input type="text" id="ghostTotal" class="form-control" placeholder="Auto-calculated..." readonly />
                </div>

                <div class="form-group">
                    <label>Total Price</label>
                    <input type="number" name="tPrice" id="tPriceInput" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Additional Info</label>
                    <textarea name="addInfo" class="form-control" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label>Enter pick-up date</label>
                    <input type="date" name="pickup_date" id="pickupDate" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Production Stage</label>
                    <select name="production_stage" class="form-control" required>
                        <option value="">-- Choose Stage --</option>
                        <option value="start">Start</option>
                        <option value="ready">Ready</option>
                    </select>
                </div>
                
                <div class="form-buttons">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Order
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('addOrder').style.display='none'">
                        <i class="fas fa-times"></i> Close
                    </button>
                </div>
                <div id="addOrderMessage" class="message-box"></div>
            </form>
        </div>

        <!-- ORDERS TABLE -->
        <div class="sales-section">
            <div class="section-header">
                <h2 class="section-title"><i class="fas fa-list"></i> Orders List</h2>
            </div>
            <div class="table-responsive">
                <table class="sales-table">
                    <thead>
                        <tr>
                            <th>Order Name</th>
                            <th>Quantity</th>
                            <th>Deposit</th>
                            <th>Total Price</th>
                            <th>Balance</th>
                            <th>Status</th>
                            <th>Date Started</th>
                            <th>Last Updated</th>
                            <th>Pick up Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $stmt = 'SELECT * FROM orders_tbl ORDER BY date_created';
                            $result = $conn->query($stmt);
                        ?>
                        <?php if($result && $result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()):
                                $balance = $row['total_price'] - $row['deposit'];
                                if($balance < 0){
                                    $balance = 0;
                                }
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['item_name']) ?></td>
                                    <td><?= htmlspecialchars($row['qty']) ?></td>
                                    <td>₱<?= number_format(htmlspecialchars($row['deposit']), 2) ?></td>
                                    <td>₱<?= number_format(htmlspecialchars($row['total_price']), 2) ?></td>
                                    <td>₱<?= number_format($balance, 2) ?></td>
                                    <td>
                                        <span class="status-badge <?= htmlspecialchars($row['current_phase']) ?>">
                                            <?= htmlspecialchars(ucfirst($row['current_phase'])) ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($row['date_created']) ?></td>
                                    <td><?= htmlspecialchars($row['last_updated']) ?></td>
                                    <td><?= htmlspecialchars($row['pickup_date']) ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn-action edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="view-details.php?id=<?= $row['id'] ?>" class="btn-action view">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="../../Controller/Order-Management/delete.php" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline;">
                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                <button type="submit" class="btn-action delete"<?= ($row['current_phase'] === 'printing' || $row['current_phase'] === 'heatpress' || $row['current_phase'] === 'sewing' || $row['current_phase'] === 'ready') ? 'disabled' : '' ?>>
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            <?php if($row['current_phase'] !== 'done'): ?>
                                            <form action="../../Controller/Order-Management/done.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                <button type="submit" class="btn-action done">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile ?>
                        <?php else: ?>
                            <tr><td colspan="8">No orders found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
<script src="../script/add-order.js"></script>
</body>
</html>