<?php
    session_start();
    session_unset();
    session_destroy();

    echo '<script> alert("Logging Out"); </script>';

    header('Location: ../View/Factory-Modules/factory-login-panel.php');
    exit;
?>