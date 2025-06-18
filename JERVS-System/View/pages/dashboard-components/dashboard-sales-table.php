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
        <th>Unit Cost</th>
        <th>Completion Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $stmt = "SELECT * FROM sales_tbl ORDER BY date_completed DESC LIMIT 10";
        $result = $conn->query($stmt);
      ?>
      <?php if($result && $result->num_rows>0): ?>
        <?php while($row = $result->fetch_assoc()): 
          $unitCost = (int)($row['total_price'] / $row['qty']);
        ?>
          <tr>
            <td><?= htmlspecialchars($row['order_name']) ?></td>
            <td><?= htmlspecialchars($row['qty']) ?></td>
            <td>₱<?= number_format($row['total_price'], 2) ?></td>
            <td>₱<?= htmlspecialchars($unitCost) ?> </td>
            <td><?= htmlspecialchars($row['date_completed']) ?></td>
            <td>
                <a href="print.php?sales_id=<?= $row['sales_id'] ?>" class="btn-action print" target="_blank">
                  <i class="fas fa-print"></i>
                </a>
            </td>
          </tr>
        <?php endwhile ?>
      <?php else: ?>
        <tr><td colspan="6" style="text-align: center;">No sales records found.</td></tr>
      <?php endif ?>
    </tbody>
  </table>
</div>