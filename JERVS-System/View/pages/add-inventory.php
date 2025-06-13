<?php 
include('../../config/database.php');
include('../../Controller/sessioncheck.php');

// Fetch products from database
// $query = "SELECT * FROM products ORDER BY product_name ASC";
// $result = mysqli_query($connection, $query);
// $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
            <form id="addProductForm" action="../../Controller/Product-Management/add_product.php" method="POST">
                <label>Product Name:</label>
                <input type="text" name="product_name" required />

                <label>Category:</label>
                <input type="text" name="category" required />
                
                <label>Stock Quantity</label>
                <input type="number" name="stock" required>

                <label>Unit Cost</label>
                <input type="number" name="unit_cost" step="0.01" required>

                <label>Selling Price</label>
                <input type="number" name="selling_price" step="0.01" required>

                <label>Product Description</label>
                <textarea name="description"></textarea>

                <div class="form-buttons">
                    <button type="submit">Save Product</button>
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
                            <th>Unit Cost</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <?php foreach($products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['product_name']) ?></td>
                            <td><?= htmlspecialchars($product['category']) ?></td>
                            <td>
                                <span class="stock-level <?= $product['stock'] < 10 ? 'low' : ($product['stock'] < 20 ? 'medium' : 'high') ?>">
                                    <?= $product['stock'] ?>
                                </span>
                            </td>
                            <td>₱<?= number_format($product['unit_cost'], 2) ?></td>
                            <td>₱<?= number_format($product['selling_price'], 2) ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="edit_product.php?id=<?= $product['id'] ?>" class="btn-action edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="../../Controller/Product-Management/delete_product.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                        <button type="submit" class="btn-action delete" title="Delete" onclick="return confirm('Are you sure you want to delete this product?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?> -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
<script src="../script/inventory.js"></script>
</body>
</html>