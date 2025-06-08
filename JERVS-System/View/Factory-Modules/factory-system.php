<?php
include('../../config/database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PROCESS</title>
</head>
<body>
  <div class="show-order">
    <h2>Orders</h2>
    <div class="table-response">
      <table>
        <thead>
          <tr>
            <th>Order name</th>
            <th>Deposit</th>
            <th>Status</th>
            <th>Last Updated</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $stmt = 'SELECT * FROM orders_tbl';

          $result = $conn->query($stmt);

          if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '<tr>';
              echo '<form method="POST">';
              echo '<td>' . htmlspecialchars($row['item_name']) . '</td>';
              echo '<td>' . htmlspecialchars($row['deposit']) . '</td>';
              echo '<td>';
              echo '<select name="current_phase">';
              $options = ['start', 'printing', 'heatpress', 'sewing', 'ready'];
              foreach ($options as $opt) {
                $selected = ($row['current_phase'] === $opt) ? 'selected' : '';
                echo "<option value=\"$opt\" $selected>" . ucfirst(str_replace('_', ' ', $opt)) . "</option>";
              }
              echo '</select>';
              echo '</td>';
              echo '<td>' . htmlspecialchars($row['last_updated']) . '</td>';
              echo '<td>';
              echo '<input type="hidden" name="order_id" value="' . intval($row['id']) . '" />';
              echo '<button type="submit">Save</button>';
              echo '</td>';
              echo '</form>';
              echo '</tr>';
            }
          } else {
            echo '<tr><td colspan="4">No login records found.</td></tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <a href="../../Controller/factory_logout.php">LOGOUT</a>
</body>
</html>
<?php
  if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['current_phase'])){
    $order_id = intval($_POST['order_id']);
    $new_phase = $_POST['current_phase'];

    $valid_phases = ['start', 'printing', 'heatpress', 'sewing', 'ready'];
    if(in_array($new_phase, $valid_phases)){
      $stmt = $conn->prepare('UPDATE orders_tbl SET current_phase = ?, last_updated = NOW() WHERE id = ?');
      $stmt->bind_param('ss', $new_phase, $order_id);
      $stmt->execute();
      $stmt->close();

      header("Location: factory-system.php");
      exit;
    }
  }
?>