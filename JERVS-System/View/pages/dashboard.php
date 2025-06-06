<?php
    include('../parts/sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>New Sale</title>
  <link rel="stylesheet" href="../assets/stylesheet/dashboard.css" />
</head>
<body>
  <div class="container">

    <main class="main-content">
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
    </main>
  </div>
</body>
</html>
