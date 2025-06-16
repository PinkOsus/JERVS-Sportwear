<?php
    include('../../config/database.php');
    include('../../Controller/sessioncheck.php');
    
    // // Handle password change
    // if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    //     $current_password = $_POST['current_password'];
    //     $new_password = $_POST['new_password'];
    //     $confirm_password = $_POST['confirm_password'];
        
    //     // Verify current password (you'll need to implement this)
    //     // Then update password if verification passes
    // }
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
          <button class="btn btn-tab" data-tab="receipt">
            <i class="fas fa-receipt"></i> Receipt Customization
          </button>
        </div>

        <!-- admin sittings tab -->
        <section id="admin-settings" class="settings-section active">
          <div class="chart-header">
            <h2 class="chart-title"><i class="fas fa-user-shield"></i> Admin Account Settings</h2>
          </div>
          
          <form class="settings-form" method="POST">
            <div class="form-group">
              <label>Current Username</label>
              <input type="text" class="form-control" value="admin" reaquired>
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