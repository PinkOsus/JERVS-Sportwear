<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JERVS Admin Panel</title>
    <link rel="stylesheet" href="../assets/stylesheet/sidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Toggle Button (place this in your main header) -->
    <button id="sidebarToggle" class="sidebar-toggle">
        ☰
    </button>

    <!-- Fashion Sidebar -->
    <aside class="fashion-sidebar">
        <div class="brand-header">
            <div class="logo-stitch"></div>
            <h2>JERVS ADMIN</h2>
            <div class="hanger-icon">🧥</div>
        </div>
        
        <nav class="fashion-nav">
            <ul>
                <li class="active">
                    <a href="../pages/dashboard.php">
                        <span class="icon">👗</span>
                        <span class="link-text">Sales</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">📦</span>
                        <span class="link-text">Inventory</span>
                    </a>
                </li>
                <li>
                    <a href="../pages/add-member-panel.php">
                        <span class="icon">👥</span>
                        <span class="link-text">Members</span>
                    </a>
                </li>
                <li>
                    <a href="../pages/add-order.php">
                        <span class="icon">📝</span>
                        <span class="link-text">Orders</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">📊</span>
                        <span class="link-text">Reports</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">⚙️</span>
                        <span class="link-text">Settings</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div class="user-profile">
            <div class="profile-content">
                <div class="avatar" style="background-color: #2d4263;"></div>
                <div class="profile-info">
                    <h3>Admin Panel</h3>
                    <p>Account Name</p>
                </div>
                <a href="../../Controller/logout.php" class="logout-btn">
                    <span class="icon">🚪</span>
                    <span>Sign Out</span>
                </a>
            </div>
        </div>
    </aside>

    <!-- Overlay for mobile -->
    <div class="sidebar-overlay"></div>

    <!-- Main Content -->
    <main class="main-content">
        <h1>Dashboard</h1>
        <p>What's next ????</p>
    </main>

    <script src="../script/sidebar-Toggle-func.js"></script>
</body>
</html>
