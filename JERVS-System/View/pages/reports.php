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
    <link rel="stylesheet" href="../assets/stylesheet/add-order.css">
    <link rel="stylesheet" href="../assets/stylesheet/reports.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php include('../parts/sidebar.php'); ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="report-container">
                <div class="report-header">
                    <h1>Clothing Business Report - June 2025</h1>
                    <div class="report-actions">
                        <button class="btn btn-primary">
                            <i class="fas fa-download"></i> Export Report
                        </button>
                        <select class="time-period">
                            <option>June 2025</option>
                            <option>May 2025</option>
                            <option>April 2025</option>
                        </select>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-content">
                            <h3>Total Revenue</h3>
                            <h2>₱45,200</h2>
                            <p class="positive">↑ 12% from last month</p>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-content">
                            <h3>Items Sold</h3>
                            <h2>317</h2>
                            <p class="positive">↑ 8% from last month</p>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-content">
                            <h3>Pending Orders</h3>
                            <h2>42</h2>
                            <p class="neutral">→ Same as last month</p>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>

                <div class="charts-container">
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3>Sales by Category</h3>
                            <select class="chart-filter">
                                <option>Last 30 Days</option>
                                <option>Last 90 Days</option>
                            </select>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>

                    <div class="chart-card">
                        <div class="chart-header">
                            <h3>Stock Level by Item Type</h3>
                            <select class="chart-filter">
                                <option>Current</option>
                                <option>30 Day Trend</option>
                            </select>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="../script/report-sample.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>