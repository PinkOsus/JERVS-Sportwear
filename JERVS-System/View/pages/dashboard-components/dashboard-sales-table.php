<!-- Recent Sales Section -->
<div class="sales-section">
  <div class="section-header">
    <h2 class="section-title">Recent Sales</h2>
  </div>
  <table class="sales-table">
    <thead>
      <tr>
        <th>Order Name</th>
        <th>Quantity</th>
        <th>Order Price</th>
        <th>Completion Date</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $stmt = "SELECT * FROM sales_tbl ORDER BY date_completed DESC LIMIT 10";
        $result = $conn->query($stmt);
      ?>
      <?php if($result && $result->num_rows>0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['order_name']) ?></td>
            <td><?= htmlspecialchars($row['qty']) ?></td>
            <td>₱<?= number_format($row['total_price'], 2) ?></td>
            <td><?= htmlspecialchars($row['date_completed']) ?></td>
          </tr>
        <?php endwhile ?>
      <?php else: ?>
        <tr><td colspan="4" style="text-align: center;">No sales records found.</td></tr>
      <?php endif ?>
    </tbody>
  </table>
</div>