<?php
    include('../config/database.php');

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])){
        $user_id = $_POST['id'];

        $stmt = $conn->prepare('DELETE FROM inventory_tbl WHERE id = ?');
        $stmt->bind_param('s', $user_id);

        if($stmt->execute()){
            echo '<script>alert("Product/Material succesfully deleted");window.location.href="../view/inventory/inventory.php";</script>';
        }else{
            echo '<script>alert("Product/Material unsuccesfull");window.location.href="../view/inventory/inventory.php";</script>';
        }
    }else{
        echo '<script>alert("Something wrong happened");window.location.href="../view/inventory/inventory.php";</script>';
    }
?>