<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JERVS Admin Panel</title>
    <link rel="stylesheet" href="../assets/stylesheet/sidebar-css/style.css">
    <link rel="stylesheet" href="../assets/stylesheet/sidebar-css/sidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="fashion-sidebar">
            <div class="brand-header">
                <div class="logo">
                    <i class="fas fa-tshirt"></i>
                </div>
                <h2>JERVS ADMIN</h2>
            </div>
            
            <nav class="fashion-nav">
                <ul>
                    <!-- Sales Module -->
                    <li class="nav-item with-submenu">
                        <a href="#" class="nav-link">
                            <span class="icon"><i class="fas fa-shopping-cart"></i></span>
                            <span class="link-text">Sales</span>
                            <span class="submenu-toggle"><i class="fas fa-chevron-down"></i></span>
                        </a>
                        <ul class="submenu">
                            <li><a href="#"><i class="fas fa-plus-circle"></i> Add Sale</a></li>
                            <li><a href="#"><i class="fas fa-history"></i> Sales History</a></li>
                            <li><a href="#"><i class="fas fa-users"></i> Customers</a></li>
                            <li><a href="#"><i class="fas fa-receipt"></i> Receipts/Invoices</a></li>
                        </ul>
                    </li>
                    
                    <!-- Inventory Module -->
                    <li class="nav-item with-submenu">
                        <a href="#" class="nav-link">
                            <span class="icon"><i class="fas fa-boxes"></i></span>
                            <span class="link-text">Inventory</span>
                            <span class="submenu-toggle"><i class="fas fa-chevron-down"></i></span>
                        </a>
                        <ul class="submenu">
                            <li><a href="#"><i class="fas fa-cubes"></i> Materials</a></li>
                            <li><a href="#"><i class="fas fa-arrow-down"></i> Material In</a></li>
                            <li><a href="#"><i class="fas fa-arrow-up"></i> Material Out</a></li>
                            <li><a href="#"><i class="fas fa-exchange-alt"></i> Transactions</a></li>
                        </ul>
                    </li>
                    
                    <!-- Members Module -->
                    <li class="nav-item with-submenu">
                        <a href="#" class="nav-link">
                            <span class="icon"><i class="fas fa-users"></i></span>
                            <span class="link-text">Members</span>
                            <span class="submenu-toggle"><i class="fas fa-chevron-down"></i></span>
                        </a>
                        <ul class="submenu">
                            <li><a href="#"><i class="fas fa-list"></i> Member List</a></li>
                            <li><a href="#"><i class="fas fa-user-plus"></i> Add New Member</a></li>
                        </ul>
                    </li>
                    
                    <!-- Orders Module -->
                    <li class="nav-item with-submenu">
                        <a href="#" class="nav-link">
                            <span class="icon"><i class="fas fa-clipboard-list"></i></span>
                            <span class="link-text">Orders</span>
                            <span class="submenu-toggle"><i class="fas fa-chevron-down"></i></span>
                        </a>
                        <ul class="submenu">
                            <li><a href="#"><i class="fas fa-file-purchase"></i> Purchase Orders</a></li>
                            <li><a href="#"><i class="fas fa-file-invoice-dollar"></i> Sales Orders</a></li>
                            <li><a href="#"><i class="fas fa-truck"></i> Suppliers/Customers</a></li>
                            <li><a href="#"><i class="fas fa-archive"></i> Order History</a></li>
                        </ul>
                    </li>
                    
                    <!-- Reports Module -->
                    <li class="nav-item with-submenu">
                        <a href="#" class="nav-link">
                            <span class="icon"><i class="fas fa-chart-bar"></i></span>
                            <span class="link-text">Reports</span>
                            <span class="submenu-toggle"><i class="fas fa-chevron-down"></i></span>
                        </a>
                        <ul class="submenu">
                            <li><a href="#"><i class="fas fa-box-open"></i> Inventory Reports</a></li>
                            <li><a href="#"><i class="fas fa-chart-line"></i> Sales Reports</a></li>
                            <li><a href="#"><i class="fas fa-exchange-alt"></i> Transaction History</a></li>
                        </ul>
                    </li>
                    
                    <!-- Settings Module -->
                    <li class="nav-item with-submenu">
                        <a href="#" class="nav-link">
                            <span class="icon"><i class="fas fa-cog"></i></span>
                            <span class="link-text">Settings</span>
                            <span class="submenu-toggle"><i class="fas fa-chevron-down"></i></span>
                        </a>
                        <ul class="submenu">
                            <li><a href="#"><i class="fas fa-tags"></i> Material Categories</a></li>
                            <li><a href="#"><i class="fas fa-ruler"></i> Units of Measurement</a></li>
                            <li><a href="#"><i class="fas fa-bell"></i> Reorder Level</a></li>
                            <li><a href="#"><i class="fas fa-sliders-h"></i> System Preferences</a></li>
                            <li><a href="#"><i class="fas fa-database"></i> Backup & Restore</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            
            <div class="user-profile">
                <div class="avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="profile-info">
                    <h3>Admin User</h3>
                    <p>Administrator</p>
                </div>
                <a href="../../Controller/logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </aside>
    </div>

    <script src="../script/sidebarjs/sidebar.js"></script>
</body>
</html>