<?php 
include('../../config/database.php');
include('../../Controller/sessioncheck.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List | JERVS Admin</title>
    <link rel="stylesheet" href="../assets/stylesheet/add-order.css">
    <link rel="stylesheet" href="../assets/stylesheet/inventory-management-css/stock-lvl-colors.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<?php include('../parts/sidebar.php'); ?>
<div class="main-wrapper">
    <main class="main-content">
        <div class="header">
            <h1>Product Management</h1>
            <div class="action-buttons">
                <button id="openAddProductBtn" class="btn-primary">
                    <i class="fas fa-plus"></i> Add New Product
                </button>
                <!-- <button class="btn-secondary" id="exportBtn">
                    <i class="fas fa-file-export"></i> Export
                </button> -->
            </div>
        </div>

        <!-- ADD PRODUCT PANEL -->
        <div class="add-order-panel" id="addProductPanel">
            <h2>Add New Product</h2>
            <form id="addProductForm" method="POST" action="../../Controller/Product-Management/add_prod.php">
                <label>Product Name:</label>
                <input type="text" name="product_name" required />

                <label>Category:</label>
                <select name="category" required>
                        <option value="">-- Choose Category --</option>
                        <option value="product">Product</option>
                        <option value="materials">Materials</option>
                </select>
                
                <label>Stock Quantity</label>
                <input type="number" name="stock" required>

                <label>Product Description</label>
                <textarea name="description"></textarea>

                <div class="form-buttons">
                    <button type="submit">Add to inventory</button>
                    <button type="button" onclick="document.getElementById('addProductPanel').style.display='none'">✖ Close</button>
                </div>
                <div id="addProductMessage"></div>
            </form>
        </div>

        <!-- PRODUCT LIST TABLE -->
        <div class="show-order">
            <h2>Product List</h2>
            <div class="table-response">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                            $stmt = "SELECT * FROM inventory_tbl LIMIT 20";

                            $result = $conn->query($stmt);
                        ?>
                        <?php if($result && $result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['item_name']) ?></td>
                                    <td><?= htmlspecialchars($row['categ']) ?></td>
                                    <td><?= htmlspecialchars($row['qty']) ?></td>
                                    <td><?= htmlspecialchars($row['descrip']) ?></td>

                                    <form action="../../Controller/Product-Management/delete_prod.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id'])?>">
                                                <button type="submit">DELETE</button>
                                    </form>
                                </tr>
                            <?php endwhile ?>
                        <?php else: ?>
                            <tr><td colspan="4">No inventory item records found.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
<script src="../script/inventory.js"></script>
</body>
</html>