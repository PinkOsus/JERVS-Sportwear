<?php
// receipt_customization.php - Simple version
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_receipt'])) {
    // Process form submission
    $business_name = $_POST['business_name'];
    $header_text = $_POST['header_text'];
    $footer_text = $_POST['footer_text'];
    $include_contact = isset($_POST['include_contact']) ? 1 : 0;
    
    // Here you would save to database
    // $stmt = $conn->prepare("UPDATE receipt_settings SET ...");
    // $stmt->execute([...]);
    
    echo '<div class="alert success">Receipt settings saved!</div>';
}
?>
<link rel="stylesheet" href="../View/assets/stylesheet/resibo.css">
<div class="simple-receipt-form">
    <h3><i class="fas fa-receipt"></i> Receipt Customization</h3>
    
    <form method="POST">
        <div class="form-group">
            <label>Business Name</label>
            <input type="text" name="business_name" class="form-control" 
                   value="<?= htmlspecialchars($settings['business_name'] ?? '') ?>" required>
        </div>
        
        <div class="form-group">
            <label>Header Text</label>
            <textarea name="header_text" class="form-control" rows="2"><?= 
                htmlspecialchars($settings['header_text'] ?? 'Thank you for your purchase!') 
            ?></textarea>
        </div>
        
        <div class="form-group">
            <label>Footer Text</label>
            <textarea name="footer_text" class="form-control" rows="2"><?= 
                htmlspecialchars($settings['footer_text'] ?? 'Visit us again!') 
            ?></textarea>
        </div>
        
        <div class="form-group">
            <label class="checkbox-label">
                <input type="checkbox" name="include_contact" <?= 
                    ($settings['include_contact'] ?? true) ? 'checked' : '' 
                ?>>
                Include Contact Information
            </label>
        </div>
        
        <div class="form-buttons">
            <button type="submit" name="save_receipt" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Settings
            </button>
        </div>
    </form>
</div>