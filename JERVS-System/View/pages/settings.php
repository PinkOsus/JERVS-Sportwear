<?php
    include('../../config/database.php');
    include('../../Controller/sessioncheck.php');
    
    // Handle password change
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
        $adminD = $_POST['id'];
        $username  = $_POST['admin'];
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Verify current password (you'll need to implement this)
        $stmt = $conn->prepare("SELECT admin_pass FROM admin_tbl WHERE admin_id = ?");
        $stmt->bind_param("i", $adminD);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result && $row = $result->fetch_assoc()) {
            $hashedPassword = $row['admin_pass'];
        } else {
            // Handle: admin not found
            die("Admin not found.");
        }

        if(!password_verify($current_password, $hashedPassword)){
          echo '<script>alert("Invalid current password");window.history.back();</script>';
          exit();
        }
        // Then update password if verification passes
        if($new_password === $confirm_password){
          $hashpass = password_hash($new_password, PASSWORD_DEFAULT);

          $updateStmt = $conn->prepare("UPDATE admin_tbl SET admin_user = ?, admin_pass = ? WHERE admin_id = ?");
          $updateStmt->bind_param('ssi', $username, $hashpass, $adminD);
          
          if($updateStmt->execute()){
            echo '<script>alert("Successfully changed admin information");window.location.href="settings.php";</script>';
            exit();
          }else{
            echo '<script>alert("An error Occured");window.history.back();</script>';
            exit();
          }
        }else {
            echo '<script>alert("New password and confirmation do not match");window.history.back();</script>';
            exit();
        }
    }

    //for displaying
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
      $sql = "SELECT * FROM admin_tbl";
      $result = $conn->query($sql);

      if ($result && $row = $result->fetch_assoc()) {
          $username = $row['admin_user'];
          $adminID = $row['admin_id'];
      } else {
          $username = null;
          $adminID = null;
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>System Settings | JERVS Admin Panel</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/stylesheet/dashboard.css">
  <link rel="stylesheet" href="../assets/stylesheet/settings.css">
  <link rel="icon" href="../assets/img/logo-1.png" type="image/x-icon">
</head>
<body>
  <?php include('../parts/sidebar.php'); ?>
  <div class="main-wrapper">
    <main class="main-content">
      <!-- dashboard heder -->
      <div class="dashboard-header">
        <div class="header-content">
          <h1 class="dashboard-title"><i class="fas fa-cog"></i> System Settings</h1>
          <p class="dashboard-subtitle">Configure system and admin settings</p>
        </div>
      </div>

      <!-- sittings tabs -->
      <div class="metric-card">
        <div class="settings-tabs">
          <button class="btn btn-tab active" data-tab="admin-settings">
            <i class="fas fa-user-shield"></i> Admin Settings
          </button>
        </div>

        <!-- admin sittings tab -->
        <section id="admin-settings" class="settings-section active">
          <div class="chart-header">
            <h2 class="chart-title"><i class="fas fa-user-shield"></i> Admin Account Settings</h2>
          </div>
          
          <form class="settings-form" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($adminID) ?>">

            <div class="form-group">
              <label>Current Username</label>
              <input type="text" class="form-control" name="admin" value="<?= htmlspecialchars($username) ?>" required>
            </div>
            
            <div class="form-group">
              <label>Current Password</label>
              <div class="password-field">
                <input type="password" name="current_password" class="form-control" placeholder="Current password" required>
                <button type="button" class="toggle-password"><i class="fas fa-eye"></i></button>
              </div>
            </div>
            
            <div class="form-group">
              <label>New Password</label>
              <div class="password-field">
                <input type="password" name="new_password" class="form-control" placeholder="New password" required>
                <button type="button" class="toggle-password"><i class="fas fa-eye"></i></button>
              </div>
            </div>
            
            <div class="form-group">
              <label>Confirm New Password</label>
              <div class="password-field">
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm new password" required>
                <button type="button" class="toggle-password"><i class="fas fa-eye"></i></button>
              </div>
            </div>
            
            <div class="form-buttons">
              <button type="submit" name="change_password" class="btn btn-primary">
                <i class="fas fa-save"></i> Update Password
              </button>
            </div>
          </form>
        </section>

        <!-- resibo customization tab -->
        <section id="receipt" class="settings-section">
          <?php include('../../Controller/resiboCustomized.php'); ?>
        </section>
      </div>
    </main>
  </div>
  <script src="../script/settings.js"></script>
  <script src="../script/reportToggle.js"></script>
</body>
</html>