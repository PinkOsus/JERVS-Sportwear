<?php
    include('../../config/database.php');
    include('../sessioncheck.php');
    include('../../View/parts/sidebar.php');

    //for updating
    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $id = $_POST['id'];
        $item = $_POST['item'];
        $deposit = $_POST['deposit'];
        $qty = $_POST['qty'];
        $total_price = $_POST['tPrice'];
        $addInfo = $_POST['addInfo'];

        $stmt = $conn->prepare('UPDATE orders_tbl SET item_name = ?, deposit = ?, qty = ?, total_price = ?, order_details = ?, last_updated = NOW() WHERE id=?');
        $stmt->bind_param('siidsi', $item, $deposit, $qty, $total_price, $addInfo, $id);

        if($stmt->execute()){
            header('Location: ../../View/pages/add-order.php?success=1');
            exit;
        }else{
            echo '<script> alert("Failed to update the record");window.location.reload(); </script>';
        }
        $stmt->close();
    }
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $stmt = $conn->prepare('SELECT * FROM orders_tbl WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $order = $result->fetch_assoc();
        $stmt->close();

        if(!$order){
            echo '<script> alert("Order not found");</script>';
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
    <title>Editing</title>
    <link rel="stylesheet" href="../../View/assets/stylesheet/sidebar.css" />
    <link rel="stylesheet" href="../../View/assets/stylesheet/add-order.css" />
</head>
<body>
    <div class="container">
        <main class="main-content">
            <h2>Edit Order</h2>
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?= htmlspecialchars($order['id']) ?>">

                <label>Order:</label>
                <input type="text" name="item" value="<?= htmlspecialchars($order['item_name']) ?>" required>

                <label>Initial Deposit</label>
                <input type="number" name="deposit" value="<?= htmlspecialchars($order['deposit']) ?>" required>

                <label>Quantity</label>
                <input type="number" name="qty" value="<?= htmlspecialchars($order['qty']) ?>" required>

                <label>Total Price</label>
                <input type="number" name="tPrice" value="<?= htmlspecialchars($order['total_price']) ?>" required>

                <label>Additional Info</label>
                <textarea name="addInfo"><?= htmlspecialchars($order['order_details']) ?></textarea>

                <br><br>
                <button type="submit">Save Changes</button>
                <a href="../../View/pages/add-order.php"><button type="button">Cancel</button></a>
            </form>
        </main>
    </div>
</body>
</html>