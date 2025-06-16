<?php
    include('../../config/database.php');
    include('../../Controller/sessioncheck.php');

    //for updating
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $id = $_POST['id'];
        $item_name = $_POST['item'];
        $qty = $_POST['qty'];
        $category = $_POST['category'];
        $descrip = $_POST['description'];

        $stmt = $conn->prepare("UPDATE inventory_tbl SET item_name = ?, categ = ?, qty = ?, descrip = ? WHERE id = ?");
        $stmt->bind_param('ssisi', $item_name, $category, $qty, $descrip, $id);

        if($stmt->execute()){
            header('Location: ../../View/pages/add-inventory.php?success=1');
            exit;
        }else{
            echo '<script> alert("Failed to update the record");window.location.reload(); </script>';
        }
        $stmt->close();
    }

    //for displaying
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM inventory_tbl WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $item = $result->fetch_assoc();
        $stmt->close();

        if(!$item){
            echo '<script> alert("Order not found");window.history.back()</script>';
            exit;
        }
    }else{
        echo '<script> alert("No order ID provided");</script>';
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../View/assets/stylesheet/dashboard.css">
    <link rel="stylesheet" href="../../View/assets/stylesheet/order-management-css/edit.css">
    <link rel="stylesheet" href="../../View/assets/stylesheet/sidebar.css">
    <link rel="icon" href="../../View/assets/img/logo-1.png" type="image/x-icon">
</head>
<body>
<?php include('../../View/parts/sidebar.php'); ?>
    <div class="main-wrapper">
        <main class="main-content">
            <!-- Dashboard Header Edit this shi -->
            <div class="dashboard-header">
                <div class="header-content">
                    <h1 class="dashboard-title"><i class="fas fa-edit"></i> Edit Order</h1>
                    <p class="dashboard-subtitle">Update order details</p>
                </div>
            </div>

            <!-- and this shit -->
            <div class="metric-card">
            <div class="chart-header">
                <h2 class="chart-title">Inventory Item #<?= htmlspecialchars($item['id']) ?></h2>
            </div>
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
                
                <div class="form-group">
                    <label>Order Name:</label>
                    <input type="text" name="item" class="form-control" value="<?= htmlspecialchars($item['item_name']) ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="qty" class="form-control" value="<?= htmlspecialchars($item['qty']) ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <?php
                        $current = strtolower($item['categ']);
                        $options = ['product', 'materials'];
                    ?>
                    <label>Category:</label>
                    <select name="category" class="form-control" required>
                        <!-- Selected current category -->
                        <option value="<?= htmlspecialchars($current) ?>" selected><?= ucfirst($current) ?></option>

                        <!-- Other options (excluding current) -->
                        <?php foreach ($options as $opt): ?>
                            <?php if (strtolower($opt) !== $current): ?>
                                <option value="<?= htmlspecialchars($opt) ?>"><?= ucfirst($opt) ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Additional Info</label>
                    <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($item['descrip']) ?></textarea>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                    <a href="../../View/pages/add-inventory.php" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
        </main>
    </div>
</body>
</html>