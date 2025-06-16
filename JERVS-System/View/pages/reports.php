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
    <link rel="stylesheet" href="../assets/stylesheet/reports.css">
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
                <button class="btn btn-primary" id="exportReportBtn">
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
                        <span class="metric-title">Total Revenue</span>
                        <span class="metric-value" id="totalRevenue">₱45,200</span>
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <span class="metric-title">Items Sold</span>
                        <span id="ordersCompleted" class="metric-value">317</span>
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <span class="metric-title">Pending Orders</span>
                        <span id="ongoingOrders" class="metric-value">42</span>
                    </div>
                </div>
            </div>

            <!-- Charts Row - Side by Side -->
            <div class="charts-row">
                <!-- Sales Analytics Chart -->
                <div class="chart-section">
                    <div class="chart-header">
                        <h2 class="chart-title">Sales Analytics</h2>
                        <select id="timeRange" class="form-control" style="width: auto;">
                            <option value="30">Last 30 Days</option>
                            <option value="90">Last 90 Days</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>

                <!-- Inventory Status Chart -->
                <div class="chart-section">
                    <div class="chart-header">
                        <h2 class="chart-title">Inventory Status</h2>
                        <select class="form-control" style="width: auto;">
                            <option>Current</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="../script/report-sample.js"></script>
    <script src="../script/export-report.js"></script>
</body>
</html>