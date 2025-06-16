<?php
    session_start();

    if (!isset($_SESSION['member'])) {
        echo '<script> alert("You must be logged in to view this page");window.location="index.php"</script>';
        exit();
    }
?>