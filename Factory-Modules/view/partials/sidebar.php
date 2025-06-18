<?php
// Get the current page filename
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JERVS Admin Panel</title>
    <link rel="stylesheet" href="../../assets/css/sidebar/sidebar.css">
    <link rel="stylesheet" href="../../assets/css/sidebar/sidebar-overlay.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/globals.css">
    <link rel="icon" href="../../assets/img/logo-1.png" type="image/x-icon">
</head>
<body>

    <!-- Hamburger Menu Toggle -->
    <button id="sidebarToggle" class="sidebar-toggle">
    <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar">

        <!-- Brand Section -->
        <div class="brand">
            <div class="logo">
                <img src="../../assets/img/logo-1.png" alt="JERVS Logo">
            </div>
            <h2 class="brand-name">JERVS Sportswear</h2>
        </div>

        <!-- Navigation Menu -->
        <nav class="nav-menu">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="../inventory/inventory.php" class="nav-link <?= ($current_page == 'inventory.php') ? 'active' : '' ?>">
                        <i class="fas fa-box nav-icon"></i>
                        <span class="nav-text">Inventory</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../orders/order.php" class="nav-link <?= ($current_page == 'order.php') ? 'active' : '' ?>">
                        <i class="fas fa-shopping-cart nav-icon"></i>
                        <span class="nav-text">Orders</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- User Profile Section -->
        <div class="user-profile">
            <div class="profile-content">
                <div class="avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="profile-info">
                    <h3 class="profile-name">Factory Panel</h3>
                    <p class="profile-role">Member</p>
                </div>
            </div>
            <a href="../../Controller/logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sign Out</span>
            </a>
        </div>
        
    </div>
    <script src="../../assets/js/sidebar.js"></script>
</body>
</html>