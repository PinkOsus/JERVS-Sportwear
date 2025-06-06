<?php
    header('Content-Type: application/json');
    error_reporting(0);
    include('../config/database.php');

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST['password'];
    //finding the user
    $stmt = $conn->prepare('SELECT * FROM admin_tbl WHERE admin_user = ? AND admin_pass = ?');
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    //if the user is found we succesfully login to dashboard
    if($user){
        session_start();
        $_SESSION['admin'] = $user['admin_id'];
        echo json_encode(['success' => true]);
    }else{
        echo json_encode(['success' => false, 'message' => 'Invalid password or username']);
    }

    $stmt->close();
?>