<?php
include('../parts/sidebar.php');
include('../../config/database.php');
include('../../Controller/sessioncheck.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports | JERVS Admin</title>
    
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="dashboard-container">
    <h1>THIS IS A SAMPLE ONLY</h1>
    <h1>Clothing Business Report - June 2025</h1>

    <div class="stats">
      <div class="stat-box">
        <h2>₱45,200</h2>
        <p>Total Revenue</p>
      </div>
      <div class="stat-box">
        <h2>317</h2>
        <p>Items Sold</p>
      </div>
      <div class="stat-box">
        <h2>42</h2>
        <p>Pending Orders</p>
      </div>
    </div>

    <div class="charts">
      <div class="chart-box">
        <h3>Sales by Category</h3>
        <canvas id="barChart"></canvas>
      </div>

      <div class="chart-box">
        <h3>Stock Level by Item Type</h3>
        <canvas id="pieChart"></canvas>
      </div>
    </div>
  </div>

  <script src="../script/report-sample.js"></script>
</body>
</html>