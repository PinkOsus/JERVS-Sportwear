<?php
    session_start();
    
    unset($_SESSION['admin']);
    echo '<script> alert("Logging Out"); </script>';

    header('Location: ../View/pages/index.php');
    exit;
?>