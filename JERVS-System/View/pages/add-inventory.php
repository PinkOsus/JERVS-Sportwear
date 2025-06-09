<!-- Need help here to connect the database -->
<?php 
include('../parts/sidebar.php');
include('../../config/database.php');
include('../../Controller/sessioncheck.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List | JERVS Admin</title>
    <link rel="stylesheet" href="../assets/stylesheet/add-inventory.css">
</head>
<body>
<div class="content"><br><br><br><br>
    <h1>NEED HELP HERE</h1>
    <h2>Product List</h2>
    <a href="add_product.php" class="btn-add">Add New Product</a>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Unit Cost</th>
                <th>Selling Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- NEED HELP HERE THERE'S AN ERROR -->
            <?php $products = getProducts(); ?>
            <?php while ($row = $products->fetch_assoc()): ?>
            <tr>
                <td><?= $row['product_name'] ?></td>
                <td><?= $row['category'] ?></td>
                <td><?= $row['stock'] ?></td>
                <td>₱<?= number_format($row['unit_cost'], 2) ?></td>
                <td>₱<?= number_format($row['selling_price'], 2) ?></td>
                <td>
                    <a href="edit_product.php?id=<?= $row['id'] ?>" class="btn-edit">✏️</a>
                    <a href="product_list.php?delete=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Delete this product?')">🗑️</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>