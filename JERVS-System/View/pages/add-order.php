<?php
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
    <?php include('../parts/sidebar.php'); ?>
    <div class="main-wrapper">
        <main class="main-content">
        <button id="openAddOrderBtn">Add Order Member</button>
            <button onclick="location.reload()">🔄 Refresh Table</button>
            <!-- ADDING ORDER -->
            <div class="add-order-panel" id="addOrder">
                <h2>Add New Order</h2>
                <form id="addOrderForm">
                    <label>Order:</label>
                    <input type="text" name="item" required />

                    <label>Initial Deposit</label>
                    <input type="number" name="deposit" required/>
                    
                    <label> Quantity</label>
                    <input type="number" name="qty" required>

                    <label>Total price</label>
                    <input type="number" name="tPrice" required>

                    <label> Additional Info </label>
                    <textarea name="addInfo" id="add-Info"></textarea>

                    <select name="production_stage" required>
                        <option value="">-- Choose Stage --</option>
                        <option value="start">Start</option>
                        <option value="ready">Ready</option>
                    </select>

                    <div class="form-buttons">
                        <button type="submit">Add Order</button>
                        <button type="button" onclick="document.getElementById('addOrder').style.display='none'">✖ Close</button>
                    </div>
                    <div id="addOrderMessage"></div>
                </form>
            </div>
            <!-- SHOWING ORDER -->
            <div class="show-order">
                <h2>Orders</h2>
                <div class="table-response">
                    <table>
                        <thead>
                            <tr>
                                <th>Order name</th>
                                <th>Quantity</th>
                                <th>Initial Deposit</th>
                                <th>Total Price</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $stmt = 'SELECT * FROM orders_tbl';
                                
                                $result = $conn->query($stmt);
                            ?>
                            <?php if($result && $result->num_rows>0):?>
                                <?php while($row = $result->fetch_assoc()):
                                    $balance = $row['total_price']-$row['deposit'];
                                ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['item_name']) ?></td>
                                        <td><?= htmlspecialchars($row['qty']) ?></td>
                                        <td><?= htmlspecialchars($row['deposit']) ?></td>
                                        <td><?= htmlspecialchars($row['total_price']) ?></td>
                                        <td><?= htmlspecialchars($balance)?></td>
                                        <td><?= htmlspecialchars($row['current_phase']) ?></td>
                                        <td><?= htmlspecialchars($row['last_updated']) ?></td>
                                        <td>
                                            <form action="../../Controller/Order-Management/edit.php" method="get" style="display:inline;">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id'])?>">
                                                <button type="submit">EDIT</button>
                                            </form>

                                            <form action="../../Controller/Order-Management/view-details.php" method="get" style="display:inline;">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id'])?>">
                                                <button type="submit">VIEW DETAILS</button>
                                            </form>

                                            <form action="../../Controller/Order-Management/delete.php" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id'])?>">
                                                <button type="submit">DELETE</button>
                                            </form>

                                            <form action="../../Controller/Order-Management/done.php" method="post" style="display:inline;">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id'])?>">
                                                <button type="submit">DONE</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile ?>
                            <?php else:?>
                                <tr><td colspan="8">No login records found.</td></tr>
                            <?php endif?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script src="../script/add-order.js"></script>
</body>
</html>