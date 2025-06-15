<?php 
include('../../config/database.php');
include('../../Controller/sessioncheck.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List | JERVS Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/stylesheet/dashboard.css">
    <link rel="icon" href="../assets/img/logo-1.png" type="image/x-icon">
</head>
<body>
<?php include('../parts/sidebar.php'); ?>

<div class="main-wrapper">
    <main class="main-content">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="header-content">
                <h1 class="dashboard-title"><i class="fas fa-boxes"></i> Product Management</h1>
                <p class="dashboard-subtitle">Manage your inventory materials, and products stocks</p>
            </div><br>
            <div class="header-actions">
                <button id="openAddProductBtn" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Product
                </button>
            </div>
        </div>

        <!-- ADD PRODUCT PANEL -->
        <div class="metric-card" id="addProductPanel" style="display: none;">
            <div class="chart-header">
                <h2 class="chart-title">Add New Product</h2>
            </div>
            <form id="addProductForm" method="POST" action="../../Controller/Product-Management/add_prod.php">
                <div class="form-group"><br><br>
                    <label>Product Name:</label>
                    <input type="text" name="product_name" class="form-control" required />
                </div>

                <div class="form-group">
                    <label>Category:</label>
                    <select name="category" class="form-control" required>
                        <option value="">-- Choose Category --</option>
                        <option value="product">Product</option>
                        <option value="materials">Materials</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Stock Quantity</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Product Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn btn-primary">Add to inventory</button>
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('addProductPanel').style.display='none'">✖ Close</button>
                </div>
                <div id="addProductMessage"></div>
            </form>
        </div>

        <!-- PRODUCT LIST TABLE -->
        <div class="sales-section">
            <div class="section-header">
                <h2 class="section-title">Product List</h2>
            </div>
            <div class="table-responsive">
                <table class="sales-table">
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
                                    <td>
                                        <div class="action-buttons">
                                            <a href="edit-product.php?id=<?= $row['id'] ?>" class="btn-action edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="../../Controller/Product-Management/delete_prod.php" method="POST" onsubmit="return confirm('Are you sure?');">
                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                <button type="submit" class="btn-action delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile ?>
                        <?php else: ?>
                            <tr><td colspan="5">No inventory item records found.</td></tr>
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