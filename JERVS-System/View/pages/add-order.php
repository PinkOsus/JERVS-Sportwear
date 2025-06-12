<?php
include('../parts/sidebar.php');
include('../../config/database.php');
include('../../Controller/sessioncheck.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add orders | JERVS Admin</title>
    <link rel="stylesheet" href="../assets/stylesheet/add-order.css" />
</head>
<body>
    <div class="container">
        <main class="main-content"><br><br>
            <button id="openAddOrderBtn">Add Order Member</button>
            <button onclick="location.reload()">🔄 Refresh Table</button>
            
            <!-- ADDING ORDER -->
            <div class="add-order-panel" id="addOrderPanel">
                <h2>Add New Order</h2>
                <form id="addOrderForm">
                    <div>
                        <label>Item Name:</label>
                        <input type="text" name="item" required />
                    </div>
                    
                    <div>
                        <label>Quantity:</label>
                        <input type="number" name="qty" required min="1">
                    </div>
                    
                    <div>
                        <label>Initial Deposit:</label>
                        <input type="number" name="deposit" required step="0.01" min="0">
                    </div>
                    
                    <div>
                        <label>Total Price:</label>
                        <input type="number" name="tPrice" required step="0.01" min="0">
                    </div>
                    
                    <div>
                        <label>Status:</label>
                        <select name="production_stage" required>
                            <option value="">-- Choose Stage --</option>
                            <option value="start">Start</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    
                    <div>
                        <label>Additional Info:</label>
                        <textarea name="addInfo" id="add-Info"></textarea>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit">Add Order</button>
                        <button type="button" id="closeAddOrderBtn">✖ Close</button>
                    </div>
                    <div id="addOrderMessage"></div>
                </form>
            </div>
            
            <!-- SHOWING ORDER -->
            <div class="show-order">
                <h2>Orders</h2>
                <div class="table-response">
                    <table id="ordersTable">
                        <thead>
                            <tr>
                                <th>Order name</th>
                                <th>Quantity</th>
                                <th>Initial Deposit</th>
                                <th>Total Price</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $stmt = 'SELECT * FROM orders_tbl ORDER BY last_updated DESC';
                                $result = $conn->query($stmt);

                                if($result && $result->num_rows>0){
                                    while($row = $result->fetch_assoc()){
                                        $balance = $row['total_price']-$row['deposit'];
                                        $lastUpdated = date('M d, Y h:i A', strtotime($row['last_updated']));

                                        echo '<tr data-id="'.$row['id'].'">';
                                        echo '<td>' . htmlspecialchars($row['item_name']) .'</td>';
                                        echo '<td>' . htmlspecialchars($row['qty']) .'</td>';
                                        echo '<td>' . number_format($row['deposit'], 2) .'</td>';
                                        echo '<td>' . number_format($row['total_price'], 2) .'</td>';
                                        echo '<td>' . number_format($balance, 2) .'</td>';
                                        echo '<td>' . htmlspecialchars($row['current_phase']) .'</td>';
                                        echo '<td>' . htmlspecialchars($lastUpdated) .'</td>';
                                        echo '<td class="action-buttons">
                                                <button class="edit-btn" data-id="'.$row['id'].'">EDIT</button>
                                                <button class="view-btn" data-id="'.$row['id'].'">VIEW</button>
                                                <button class="delete-btn" data-id="'.$row['id'].'">DELETE</button>
                                                <button class="done-btn" data-id="'.$row['id'].'">DONE</button>
                                            </td>';
                                        echo '</tr>';
                                    }
                                }else{
                                    echo '<tr><td colspan="8">No orders found.</td></tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script src="../script/add-order.js"></script>
</body>
</html>