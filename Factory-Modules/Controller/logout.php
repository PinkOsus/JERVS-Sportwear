<?php
    session_start();
    session_unset();
    session_destroy();

    echo '<script> alert("Logging Out"); </script>';

    header('Location: ../view/auth/index.php');
    exit;
?>