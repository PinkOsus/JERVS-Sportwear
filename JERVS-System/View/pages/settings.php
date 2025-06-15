<?php
    include('../../config/database.php');
    include('../../Controller/sessioncheck.php');
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
      <!-- Dashboard Header -->
      <div class="dashboard-header">
        <div class="header-content">
          <h1 class="dashboard-title"><i class="fas fa-cog"></i> System Settings</h1>
          <p class="dashboard-subtitle">Configure business and system preferences</p>
        </div>
      </div>

      <!-- Settings Tabs -->
      <div class="metric-card">
        <div class="settings-tabs">
          <button class="btn btn-tab active" data-tab="business-info">
            <i class="fas fa-store"></i> Business Info
          </button>
          <button class="btn btn-tab" data-tab="preferences">
            <i class="fas fa-palette"></i> Preferences
          </button>
          <button class="btn btn-tab" data-tab="receipt">
            <i class="fas fa-receipt"></i> Receipt Customization
          </button>
        </div>

        <!-- Business Info Tab -->
        <section id="business-info" class="settings-section active">
          <div class="chart-header">
            <h2 class="chart-title"><i class="fas fa-store"></i> Business Information</h2>
          </div>
          
          <form class="settings-form">
            <div class="form-group">
              <label>Business Name</label>
              <input type="text" class="form-control" placeholder="Your business name">
            </div>
            
            <div class="form-group">
              <label>Owner Name</label>
              <input type="text" class="form-control" placeholder="Business owner name">
            </div>
            
            <div class="form-group">
              <label>Address</label>
              <textarea class="form-control" placeholder="Business address" rows="3"></textarea>
            </div>
            
            <div class="form-row">
              <div class="form-group">
                <label>Contact Number</label>
                <input type="tel" class="form-control" placeholder="Phone number">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Business email">
              </div>
            </div>
            
            <div class="form-group">
              <label>Business Logo</label>
              <div class="file-upload-wrapper">
                <input type="file" id="logo-upload" accept="image/*" hidden>
                <label for="logo-upload" class="btn btn-secondary">
                  <i class="fas fa-upload"></i> Choose File
                </label>
                <span class="file-name">No file selected</span>
              </div>
              <div class="logo-preview mt-2"></div>
            </div>
            
            <div class="form-buttons">
              <button type="button" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Business Info
              </button>
            </div>
          </form>
        </section>

        <!-- Preferences Tab -->
        <section id="preferences" class="settings-section">
          <div class="chart-header">
            <h2 class="chart-title"><i class="fas fa-palette"></i> System Preferences</h2>
          </div>
          
          <form class="settings-form">
            <div class="form-group">
              <label>System Language</label>
              <select class="form-control">
                <option>English</option>
                <option>Filipino</option>
              </select>
            </div>
            
            <div class="form-group">
              <label>Date Format</label>
              <select class="form-control">
                <option>MM/DD/YYYY</option>
                <option>DD/MM/YYYY</option>
                <option>YYYY-MM-DD</option>
              </select>
            </div>
            
            <div class="form-group">
              <label>Color Theme</label>
              <div class="theme-options">
                <button type="button" class="btn btn-outline active" data-theme="light">
                  <i class="fas fa-sun"></i> Light Mode
                </button>
                <button type="button" class="btn btn-outline" data-theme="dark">
                  <i class="fas fa-moon"></i> Dark Mode
                </button>
              </div>
            </div>
            
            <div class="form-buttons">
              <button type="button" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Preferences
              </button>
            </div>
          </form>
        </section>

        <!-- Receipt Customization Tab -->
        <section id="receipt" class="settings-section">
          <div class="chart-header">
            <h2 class="chart-title"><i class="fas fa-receipt"></i> Receipt Customization</h2>
          </div>
          
          <form class="settings-form">
            <div class="form-group">
              <label>Receipt Header</label>
              <textarea class="form-control" rows="2" placeholder="Your business name or custom header text"></textarea>
            </div>
            
            <div class="form-group">
              <label>Receipt Footer</label>
              <textarea class="form-control" rows="2" placeholder="Thank you message or contact info"></textarea>
            </div>
            
            <div class="form-group">
              <label>Receipt Logo</label>
              <div class="file-upload-wrapper">
                <input type="file" id="receipt-logo-upload" accept="image/*" hidden>
                <label for="receipt-logo-upload" class="btn btn-secondary">
                  <i class="fas fa-upload"></i> Choose Logo
                </label>
                <span class="file-name">No file selected</span>
              </div>
              <div class="logo-preview mt-2"></div>
            </div>
            
            <div class="form-group">
              <label>Include in Receipt</label>
              <div class="checkbox-group">
                <label class="checkbox-container">
                  <input type="checkbox" checked> Business Address
                  <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                  <input type="checkbox" checked> Contact Information
                  <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                  <input type="checkbox" checked> Order Details
                  <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                  <input type="checkbox" checked> Payment Method
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            
            <div class="form-group">
              <label>Receipt Template</label>
              <div class="template-options">
                <div class="template-option active" data-template="simple">
                  <div class="template-preview simple-template"></div>
                  <span>Simple</span>
                </div>
                <div class="template-option" data-template="modern">
                  <div class="template-preview modern-template"></div>
                  <span>Modern</span>
                </div>
                <div class="template-option" data-template="classic">
                  <div class="template-preview classic-template"></div>
                  <span>Classic</span>
                </div>
              </div>
            </div>
            
            <div class="form-buttons">
              <button type="button" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Receipt Settings
              </button>
              <button type="button" class="btn btn-secondary">
                <i class="fas fa-print"></i> Print Test Receipt
              </button>
            </div>
          </form>
        </section>
      </div>
    </main>
  </div>

  <script src="../script/settings.js"></script>
</body>
</html>