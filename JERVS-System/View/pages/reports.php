<?php
include('../../config/database.php');
include('../../Controller/sessioncheck.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports | JERVS Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/stylesheet/dashboard.css">
    <link rel="icon" href="../assets/img/logo-1.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php include('../parts/sidebar.php'); ?>
    
    <div class="main-wrapper">
        <main class="main-content">
            <!-- Dashboard Header -->
            <div class="dashboard-header">
                <div class="header-content">
                    <h1 class="dashboard-title"><i class="fas fa-chart-bar"></i> Business Reports</h1>
                    <p class="dashboard-subtitle">Analytics and performance metrics</p>
                </div><br>
                <div class="header-actions">
                    <button class="btn btn-primary">
                        <i class="fas fa-download"></i> Export Report
                    </button>
                    <select class="form-control" style="width: auto; display: inline-block;">
                        <option>June 2025</option>
                        <option>May 2025</option>
                        <option>April 2025</option>
                    </select>
                </div>
            </div>

            <!-- Metrics Grid -->
            <div class="metrics-grid">
                <div class="metric-card">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="metric-title">Total Revenue</div>
                    </div>
                    <div class="metric-value">₱45,200</div>
                    <div class="metric-change positive">
                        <i class="fas fa-arrow-up"></i> 12% from last month
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="metric-title">Items Sold</div>
                    </div>
                    <div class="metric-value">317</div>
                    <div class="metric-change positive">
                        <i class="fas fa-arrow-up"></i> 8% from last month
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="metric-title">Pending Orders</div>
                    </div>
                    <div class="metric-value">42</div>
                    <div class="metric-change neutral">
                        <i class="fas fa-equals"></i> Same as last month
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="chart-section">
                <div class="chart-header">
                    <h2 class="chart-title">Sales Analytics</h2>
                    <select class="form-control" style="width: auto;">
                        <option>Last 30 Days</option>
                        <option>Last 90 Days</option>
                    </select>
                </div>
                <div class="chart-container">
                    <canvas id="barChart"></canvas>
                </div>
            </div>

            <div class="chart-section">
                <div class="chart-header">
                    <h2 class="chart-title">Inventory Status</h2>
                    <select class="form-control" style="width: auto;">
                        <option>Current</option>
                        <option>30 Day Trend</option>
                    </select>
                </div>
                <div class="chart-container">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </main>
    </div>

    <script src="../script/report-sample.js"></script>
</body>
</html>