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
            <nav class="breadcrumb">Sales &gt; Dashboard</nav>
            <h1>Sales</h1><br><br>
            <h2> Completed Orders </h2>
            <table>
              <thead>
                <tr>
                  <th> Order Name </th>
                  <th> Quantity </th>
                  <th> Order Price</th>
                  <th> Completion Date </th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $stmt = "SELECT * FROM sales_tbl";
                  
                  $result = $conn->query($stmt);
                ?>
                <?php if($result && $result->num_rows>0): ?>
                  <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                      <td><?= htmlspecialchars($row['order_name']) ?></td>
                      <td><?= htmlspecialchars($row['qty']) ?></td>
                      <td><?= htmlspecialchars($row['total_price']) ?></td>
                      <td><?= htmlspecialchars($row['date_completed']) ?></td>
                    </tr>
                  <?php endwhile ?>
                <?php else: ?>
                  <tr><td colspan="4">No login records found.</td></tr>
                <?php endif ?>
              </tbody>
            </table>
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
                <p id="thisMonthAmount" class="amount"></p>
                <p id="thisMonthChange" class="change positive"></p>
              </div>
              <div class="summary-card">
                <h3>Last Month</h3>
                <p id="lastMonthAmount" class="amount"></p>
                <p id="lastMonthChange" class="change negative"></p>
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