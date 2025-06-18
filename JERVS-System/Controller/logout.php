<?php
    session_start();
    
    unset($_SESSION['admin_id']);
    echo '<script> alert("Logging Out"); </script>';

    header('Location: ../View/pages/index.php');
    exit;
?>