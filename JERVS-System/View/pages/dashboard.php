<?php
    include('../parts/sidebar.php');
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
  <div class="container">
    <main class="main-content">
      <div class="sales-grid">
        <!-- Left Column - Sales Form -->
        <div class="sales-form-container">
          <nav class="breadcrumb">Sales &gt; Add Sale</nav>
          <h1>New Sale</h1>

          <section class="form-section">
            <h2>Product Selection</h2>
            <input type="text" placeholder="Search or select product" class="product-input"/>

            <div class="sale-details">
              <div>
                <label>Quantity</label>
                <input type="number" placeholder="Enter quantity"/>
              </div>
              <div>
                <label>Unit Price</label>
                <input type="text" placeholder="Auto-filled" disabled/>
              </div>
              <div>
                <label>Total Price</label>
                <input type="text" placeholder="Calculated" disabled/>
              </div>
            </div>
            <button class="btn add-btn">Add to Cart</button>
          </section>

          <section class="cart-section">
            <h2>Cart</h2>
            <table>
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Qty</th>
                  <th>Unit Price</th>
                  <th>Total</th>
                  <th>Remove</th>
                </tr>
              </thead>
              <tbody>
              <!-- Dynamically add rows here -->
              </tbody>
            </table>
            <button class="btn checkout-btn">Checkout</button>
          </section>
        </div>

        <!-- Right Column - Sales Analytics -->
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
    </main>
  </div>
  
  <script src="../script/sales.js"></script>
</body>
</html>