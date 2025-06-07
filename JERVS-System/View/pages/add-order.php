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
    <title>Document</title>
    <link rel="stylesheet" href="../assets/stylesheet/dashboard.css" />
</head>
<body>
    <div class="container">
        <main class="main-content">
            <button id="openAddOrderBtn">Add Order Member</button>
            <button onclick="location.reload()">🔄 Refresh Table</button>
            <div class="add-order-panel" id="addOrder">
                <h2>Add New Order</h2>
                <form id="addOrderForm">
                    <label>Item:</label>
                    <input type="text" name="item" required />

                    <label>Initial Deposit</label>
                    <input type="number" name="deposit" required/>
                    
                    <select name="production_stage" required>
                        <option value="">-- Choose Stage --</option>
                        <option value="start">Start</option>
                    </select>

                    <button type="submit">Add Order</button>
                    <button type="button" onclick="document.getElementById('addMemberPanel').style.display='none'">✖ Close</button>
                    <div id="addOrderMessage"></div>
                </form>
            </div>
            <div class="show-order">
                <h2>Orders</h2>
                <div class="table-response">
                    <table>
                        <thead>
                            <tr>
                                <th>Order name</th>
                                <th>Deposit</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $stmt = 'SELECT * FROM orders_tbl';
                                
                                $result = $conn->query($stmt);

                                if($result && $result->num_rows>0){
                                    while($row = $result->fetch_assoc()){
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($row['item_name']) .'</td>';
                                        echo '<td>' . htmlspecialchars($row['deposit']) .'</td>';
                                        echo '<td>' . htmlspecialchars($row['current_phase']) .'</td>';
                                        echo '<td>' . htmlspecialchars($row['last_updated']) .'</td>';
                                        echo '<td> <a  type="button" href=""> EDIT </a>';
                                        echo '<a  type="button" href="">DELETE </a> </td>';
                                        echo '</tr>';
                                    }
                                }else{
                                    echo '<tr><td colspan="4">No login records found.</td></tr>';
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