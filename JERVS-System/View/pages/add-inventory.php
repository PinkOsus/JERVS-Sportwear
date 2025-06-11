<?php 
include('../parts/sidebar.php');
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
    <link rel="stylesheet" href="../assets/stylesheet/add-inventory.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="content">
    <div class="header">
        <h1>Inventory Management</h1>
        <div class="action-buttons">
            <a href="add_product.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Product
            </a>
            <button class="btn btn-secondary" id="exportBtn">
                <i class="fas fa-file-export"></i> Export
            </button>
        </div>
    </div>

    <div class="inventory-container">
        <div class="inventory-summary">
            <div class="summary-card">
                <div class="summary-icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="summary-content">
                    <h3>Total Products</h3>
                    <!-- <p><?php echo count($products); ?></p> -->
                </div>
            </div>
            <div class="summary-card">
                <div class="summary-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="summary-content">
                    <h3>Low Stock</h3>
                    <!-- <p>
                        <?php 
                        $lowStockCount = 0;
                        foreach($products as $product) {
                            if($product['stock'] < 10) $lowStockCount++;
                        }
                        echo $lowStockCount;
                        ?>
                    </p> -->
                </div>
            </div>
            <div class="summary-card">
                <div class="summary-icon">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="summary-content">
                    <h3>Categories</h3>
                    <p>
                        //<?php
                        // $categoryQuery = "SELECT COUNT(DISTINCT category) as count FROM products";
                        // $categoryResult = mysqli_query($connection, $categoryQuery);
                        // $categoryCount = mysqli_fetch_assoc($categoryResult)['count'];
                        // echo $categoryCount;
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="inventory-table-container">
            <div class="table-header">
                <h2>Product List</h2>
                <div class="search-filter">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="productSearch" placeholder="Search products...">
                    </div>
                    <select id="categoryFilter">
                        <option value="">All Categories</option>
                        <!-- <?php
                        $categoriesQuery = "SELECT DISTINCT category FROM products";
                        $categoriesResult = mysqli_query($connection, $categoriesQuery);
                        while($category = mysqli_fetch_assoc($categoriesResult)) {
                            echo "<option value='{$category['category']}'>{$category['category']}</option>";
                        }
                        ?> -->
                    </select>
                </div>
            </div>

            <table class="inventory-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Unit Cost</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <?php foreach($products as $product): ?>
                    <tr>
                        <td>
                            <div class="product-info">
                                <?php if(!empty($product['image_url'])): ?>
                                <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['product_name']; ?>" class="product-image">
                                <?php else: ?>
                                <div class="product-image placeholder">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <?php endif; ?>
                                <div class="product-details">
                                    <strong><?php echo htmlspecialchars($product['product_name']); ?></strong>
                                    <small><?php echo htmlspecialchars($product['product_code']); ?></small>
                                </div>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($product['category']); ?></td>
                        <td>
                            <span class="stock-level <?php echo $product['stock'] < 10 ? 'low' : ($product['stock'] < 20 ? 'medium' : 'high'); ?>">
                                <?php echo $product['stock']; ?>
                            </span>
                        </td>
                        <td>₱<?php echo number_format($product['unit_cost'], 2); ?></td>
                        <td>₱<?php echo number_format($product['selling_price'], 2); ?></td>
                        <td>
                            <span class="status-badge <?php echo $product['is_active'] ? 'active' : 'inactive'; ?>">
                                <?php echo $product['is_active'] ? 'Active' : 'Inactive'; ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btn-action edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn-action delete" title="Delete" data-id="<?php echo $product['id']; ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <a href="view_product.php?id=<?php echo $product['id']; ?>" class="btn-action view" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?> -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../script/inventory.js"></script>
</body>
</html>