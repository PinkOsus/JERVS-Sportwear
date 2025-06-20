<?php
    header('Content-Type: application/json');
    include('../config/database.php');

    $item_name = htmlspecialchars(trim($_POST['item'] ?? ''));
    $deposit = floatval($_POST['deposit']);
    $total_price = floatval($_POST['tPrice']);
    $qty = floatval($_POST['qty']);
    $addInfo = htmlspecialchars(trim($_POST['addInfo'] ?? ''));
    $progress = htmlspecialchars(trim($_POST['production_stage'] ?? ''));
    $printing_method = htmlspecialchars(trim($_POST['material']));
    $garment_type = htmlspecialchars(trim($_POST['garment_type']));
    $addMaterials = ucfirst(htmlspecialchars(trim($_POST['addMaterials'])));
    $pickup_date = htmlspecialchars(trim($_POST['pickup_date']));
    $force = isset($_POST['force']) && $_POST['force'] === 'true';
    //validate input
    if(!$item_name || $deposit <= 0 || !$progress){
        echo json_encode(['success' => false, 'message' => 'Please fill out all of the fields']);
        exit;
    }
    //check the inventory
    $alertMessage = null;
    $inventoryStmt = $conn->prepare("SELECT qty FROM inventory_tbl WHERE item_name = ?");
    $inventoryStmt->bind_param("s", $addMaterials);
    $inventoryStmt->execute();
    $inventoryResult = $inventoryStmt->get_result();

    if ($inventoryResult->num_rows > 0) {
        $inventoryRow = $inventoryResult->fetch_assoc();
        $currentStock = intval($inventoryRow['qty']);

        if ($currentStock >= $qty) {
            // Sufficient stock, subtract it
            $newStock = $currentStock - $qty;
            $updateStockStmt = $conn->prepare("UPDATE inventory_tbl SET qty = ? WHERE item_name = ?");
            $updateStockStmt->bind_param("is", $newStock, $addMaterials);
            $updateStockStmt->execute();
            $updateStockStmt->close();
        } else {
            // Not enough stock, confirm with user first
            if (!$force) {
                echo json_encode([
                    'success' => false,
                    'confirm' => true,
                    'message' => "⚠ Not enough stock for '$addMaterials'. Only $currentStock available. Do you want to continue?"
                ]);
                exit;
            } else {
                $alertMessage = "⚠ Proceeded even though stock is insufficient for '$addMaterials'.";
            }
        }
    } else {
        // Material not found in inventory
        if (!$force) {
            echo json_encode([
                'success' => false,
                'confirm' => true,
                'message' => "⚠ Material '$addMaterials' not found in inventory. Proceed anyway?"
            ]);
            exit;
        } else {
            $alertMessage = "⚠ Proceeded even though '$addMaterials' was not found in inventory.";
        }
    }

    $inventoryStmt->close();
    //saving order to database;
    $stmt = $conn->prepare('INSERT INTO orders_tbl(item_name, deposit, current_phase, total_price, qty, order_details, garment_type, printing_method, pickup_date, add_materials) VALUES (?,?,?,?,?,?,?,?,?,?)');
    $stmt->bind_param('ssssssssss', $item_name, $deposit, $progress, $total_price, $qty, $addInfo,$garment_type, $printing_method, $pickup_date, $addMaterials);
    
    if($stmt->execute()){
        echo json_encode(['success' => true]);
    }else{
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
    }

    $stmt->close();
?>