<?php
    include('../../config/database.php');

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])){
        $user_id = $_POST['id'];

        $stmt = $conn->prepare('DELETE FROM orders_tbl WHERE id = ?');
        $stmt->bind_param('s', $user_id);

        if($stmt->execute()){
            echo '<script>alert("Order succesfully deleted");window.location.href="../../View/pages/add-order.php";</script>';
        }else{
            echo '<script>alert("Order deletion unsuccesfull");window.location.href="../../View/pages/add-order.php";</script>';
        }
    }else{
        echo '<script>alert("Something wrong happened");window.location.href="../../View/pages/add-order.php";</script>';
    }
?>