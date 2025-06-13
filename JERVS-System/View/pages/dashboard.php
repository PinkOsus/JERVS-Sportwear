<?php
    include('../../config/database.php');
    include('../../Controller/sessioncheck.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>New Sale</title>
  <link rel="stylesheet" href="../assets/stylesheet/dashboard.css">
  <link rel="stylesheet" href="../assets/stylesheet/sales.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <?php include('../parts/sidebar.php'); ?>
  <div class="main-wrapper">
    <main class="main-content">
      <div class="dashboard-container">
        <div class="sales-grid">
          <!-- Left Column - Sales Table -->
          <div class="sales-form-container">
            <nav class="breadcrumb">Table &gt; Dashboard</nav>
            <h1>Table</h1><br><br>
            <p>On going</p>
          </div>
          
          <!-- Right Column - Sales Analytics -->
           <!-- This is Sample only -->
          <div class="sales-analytics-container">
            <h2>Monthly Sales Performance</h2>
            <div class="chart-container">
              <canvas id="salesChart"></canvas>
            </div>
            
            <div class="sales-summary">
              <div class="summary-card">
                <h3>This Month</h3>
                <p class="amount">₱25,480</p>
                <p class="change positive">↑ 12% from last month</p>
              </div>
              <div class="summary-card">
                <h3>Last Month</h3>
                <p class="amount">₱22,750</p>
                <p class="change negative">↓ 5% from previous</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
  <script src="../script/sales.js"></script>
  <script src="../script/sidebar.js"></script> <!-- Added sidebar.js -->
</body>
</html>