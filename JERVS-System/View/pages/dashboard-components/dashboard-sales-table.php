<!-- Recent Sales Section -->
<div class="sales-section">
  <div class="section-header">
    <h2 class="section-title">Recent Sales</h2>
  </div>
  <table class="sales-table">
    <thead>
      <tr>
        <th><input type="checkbox" id="selectAll" /></th>
        <th>Order Name</th>
        <th>Quantity</th>
        <th>Order Price</th>
        <th>Unit Cost</th>
        <th>Completion Date</th>
        <th><form id="printForm" action="print.php" method="POST" target="_blank">
        <button type="submit" class="btn-action">
          <i class="fas fa-print"></i> Print Selected
        </button></th>
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
            <td><input type="checkbox" class="rowCheckbox" name="sales_ids[]" value="<?= $row['sales_id'] ?>"></td>
            <td><?= htmlspecialchars($row['order_name']) ?></td>
            <td><?= htmlspecialchars($row['qty']) ?></td>
            <td>₱<?= number_format($row['total_price'], 2) ?></td>
            <td>₱<?= htmlspecialchars($unitCost) ?> </td>
            <td><?= htmlspecialchars($row['date_completed']) ?></td>
            
          </tr>
        <?php endwhile ?>
      <?php else: ?>
        <tr><td colspan="6" style="text-align: center;">No sales records found.</td></tr>
      <?php endif ?>
    </tbody>
  </table>
  </form>
</div>
<script>
document.getElementById('selectAll').addEventListener('change', function () {
    const isChecked = this.checked;
    document.querySelectorAll('.rowCheckbox').forEach(cb => {
      cb.checked = isChecked;
    });
  });
</script>