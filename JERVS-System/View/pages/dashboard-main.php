<?php
    include('../parts/sidebar.php');
    include('../../config/database.php');
    include('../../Controller/sessioncheck.php');
?>

 <!-- Main Content -->
 <main class="main-content">
            <header class="main-header">
                <button id="sidebarToggle" class="sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1>Dashboard Overview</h1>
                <div class="header-actions">
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                </div>
            </header>

            <div class="dashboard-content">
                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #e3f2fd;">
                            <i class="fas fa-shopping-cart" style="color: #1976d2;"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Today's Sales</h3>
                            <h2>₱135,000</h2>
                            <p>Up 12% from yesterday</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #e8f5e9;">
                            <i class="fas fa-chart-line" style="color: #388e3c;"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Total Profit</h3>
                            <h2>₱1,056,000</h2>
                            <p>This month</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon" style="background-color: #fff3e0;">
                            <i class="fas fa-exclamation-triangle" style="color: #ffa000;"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Low Stock Alerts</h3>
                            <h2>7 Items</h2>
                            <p>Restock needed</p>
                        </div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="chart-section">
                    <div class="section-header">
                        <h2>Profit Trend</h2>
                        <select class="time-filter">
                            <option>Last 7 Days</option>
                            <option>Last 30 Days</option>
                            <option>This Month</option>
                            <option>This Year</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <!-- Chart would be rendered here with Chart.js or similar -->
                        <div class="chart-placeholder">
                            <p>Profit trend chart would display here</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Sales Table -->
                <div class="table-section">
                    <div class="section-header">
                        <h2>Recent Sales</h2>
                        <button class="view-all-btn">View All</button>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Product</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2024-06-10</td>
                                    <td>Jersey - Home Blue</td>
                                    <td>₱2,700.00</td>
                                    <td><span class="status-badge completed">Completed</span></td>
                                    <td><button class="action-btn"><i class="fas fa-ellipsis-v"></i></button></td>
                                </tr>
                                <tr>
                                    <td>2024-06-10</td>
                                    <td>Shorts - Away White</td>
                                    <td>₱1,680.00</td>
                                    <td><span class="status-badge completed">Completed</span></td>
                                    <td><button class="action-btn"><i class="fas fa-ellipsis-v"></i></button></td>
                                </tr>
                                <tr>
                                    <td>2024-06-09</td>
                                    <td>Jersey - Away Red</td>
                                    <td>₱2,700.00</td>
                                    <td><span class="status-badge pending">Pending</span></td>
                                    <td><button class="action-btn"><i class="fas fa-ellipsis-v"></i></button></td>
                                </tr>
                                <tr>
                                    <td>2024-06-09</td>
                                    <td>Shorts - Home Blue</td>
                                    <td>₱1,680.00</td>
                                    <td><span class="status-badge completed">Completed</span></td>
                                    <td><button class="action-btn"><i class="fas fa-ellipsis-v"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>