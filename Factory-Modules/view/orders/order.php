<?php
include('../../config/database.php');
include('../../Controller/sessioncheckup.php');
  // session_start();

  // if(!isset($_SESSION['member'])){
  //   echo '<script> alert("You must be logged in to view this page");window.location="login.php"</script>';
  //   exit();
  // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Processing | JERVS Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/universal.css">
    <link rel="stylesheet" href="../../assets/css/order.css">
    <link rel="icon" href="../assets/img/logo-1.png" type="image/x-icon">
</head>
<body>
<?php include('../partials/sidebar.php'); ?>

<div class="main-wrapper">
    <main class="main-content">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="header-content">
                <h1 class="dashboard-title"><i class="fas fa-cogs"></i> Order Processing</h1>
                <p class="dashboard-subtitle">Track and update production stages</p>
            </div>
            <div class="header-actions">
                <button onclick="location.reload()" class="btn btn-secondary">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="sales-section">
            <div class="section-header">
                <h2 class="section-title"><i class="fas fa-list"></i> Production Queue</h2>
            </div>
            <div class="table-responsive">
                <table class="sales-table">
                    <thead>
                        <tr>
                            <th>Order name</th>
                            <th>Deposit</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <?php
                        $stmt = 'SELECT * FROM orders_tbl';
                        $result = $conn->query($stmt);

                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<form method="POST">';
                                echo '<td>' . htmlspecialchars($row['item_name']) . '</td>';
                                echo '<td>₱' . number_format(htmlspecialchars($row['deposit']), 2) . '</td>';
                                echo '<td>';
                                echo '<select name="current_phase" class="form-control">';
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
                                echo '<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>';
                                echo '</td>';
                                echo '</form>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">No orders in production.</td></tr>';
                        }
                        ?> -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['current_phase'])){
    $order_id = intval($_POST['order_id']);
    $new_phase = $_POST['current_phase'];

    $valid_phases = ['start', 'printing', 'heatpress', 'sewing', 'ready'];
    if(in_array($new_phase, $valid_phases)){
        $stmt = $conn->prepare('UPDATE orders_tbl SET current_phase = ?, last_updated = NOW() WHERE id = ?');
        $stmt->bind_param('si', $new_phase, $order_id);
        $stmt->execute();
        $stmt->close();

        header("Location: order.php");
        exit;
    }
}
?>