<?php
    include('../../config/database.php');
    include('../../Controller/sessioncheck.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Overview</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/stylesheet/dashboard.css">
  <link rel="stylesheet" href="../assets/stylesheet/dashboard-styles.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <?php include('../parts/sidebar.php'); ?>
  
  <div class="main-wrapper">
    <main class="main-content">
      <?php include('../pages/dashboard-components/dashboard-header.php'); ?>
      <?php include('../pages/dashboard-components/dashboard-metrics.php'); ?>
      <?php include('../pages/dashboard-components/dash-board-chart.php'); ?>
      <?php include('../pages/dashboard-components/dashboard-sales-table.php'); ?>
    </main>
  </div>

  <script src="../script/dashboard-script.js"></script>
  <script src="../script/sidebarjs/sidebar.js"></script>
</body>
</html>