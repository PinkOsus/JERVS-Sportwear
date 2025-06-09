<?php
    include('../parts/sidebar.php');
    include('../../config/database.php');
    include('../../Controller/sessioncheck.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>System Settings | JERVS Admin Panel</title>
  <link rel="stylesheet" href="../assets/stylesheet/settings.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <div class="settings-container">
    <main class="settings-main-content">
      <div class="settings-header">
        <nav class="settings-breadcrumb">
          <a href="#">System</a> &gt; <span>Settings</span>
        </nav>
        <h1 class="settings-title">System Settings</h1>
      </div>

      <div class="settings-tabs">
        <button class="tab-btn active" data-tab="business-info">
          <i class="fas fa-store"></i> Business Info
        </button>
        <button class="tab-btn" data-tab="preferences">
          <i class="fas fa-cog"></i> Preferences
        </button>
      </div>

      <!-- Business Info Tab -->
      <section id="business-info" class="settings-section active">
        <div class="section-header">
          <h2><i class="fas fa-store"></i> Business Information</h2>
          <p>Update your business details</p>
        </div>
        
        <div class="form-content">
          <div class="form-group">
            <label>Business Name</label>
            <input type="text" placeholder="Your business name">
          </div>
          
          <div class="form-group">
            <label>Owner Name</label>
            <input type="text" placeholder="Business owner name">
          </div>
          
          <div class="form-group">
            <label>Address</label>
            <textarea placeholder="Business address" rows="3"></textarea>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label>Contact Number</label>
              <input type="tel" placeholder="Phone number">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" placeholder="Business email">
            </div>
          </div>
          
          <div class="form-group">
            <label>Business Logo</label>
            <div class="file-upload">
              <input type="file" id="logo-upload" accept="image/*" hidden>
              <label for="logo-upload" class="btn btn-outline">
                <i class="fas fa-upload"></i> Choose File
              </label>
              <span class="file-name">No file selected</span>
            </div>
            <div class="logo-preview"></div>
          </div>
          
          <button class="btn btn-success">
            <i class="fas fa-save"></i> Save Business Info
          </button>
        </div>
      </section>

      <!-- Preferences Tab -->
      <section id="preferences" class="settings-section">
        <div class="section-header">
          <h2><i class="fas fa-cog"></i> System Preferences</h2>
          <p>Configure system behavior</p>
        </div>
        
        <div class="form-content">
          <div class="form-row">
            <div class="form-group">
              <label>IDK WHAT ILALAGAY</label>
              <select>
                <option value="PHP">IDK WHAT ILALAGAY</option>
                <option value="USD">IDK WHAT ILALAGAY</option>
              </select>
            </div>
            <div class="form-group">
              <label>IDK WHAT ILALAGAY</label>
              <input type="number" value="12" step="0.1" min="0" max="30">
            </div>
          </div>
          
          <div class="form-group">
            <label>IDK WHAT ILALAGAY</label>
            <input type="number" value="10" min="1" placeholder="Default: 10">
            <p class="form-hint">IDK WHAT ILALAGAY</p>
          </div>
          
          <div class="form-group">
            <label>Color Theme</label>
            <div class="theme-options">
              <button class="theme-option active" data-theme="light">
                <i class="fas fa-sun"></i> Light Mode
              </button>
              <button class="theme-option" data-theme="dark">
                <i class="fas fa-moon"></i> Dark Mode
              </button>
            </div>
          </div>
          
          <button class="btn btn-success">
            <i class="fas fa-save"></i> Save Preferences
          </button>
        </div>
      </section>
    </main>
  </div>

  <script src="../script/settings.js"></script>
</body>
</html>