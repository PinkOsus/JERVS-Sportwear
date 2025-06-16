<?php
    header('Content-Type: application/json');
    error_reporting(0);
    include('../config/database.php');

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST['password'];

    //finding the user
    $stmt = $conn->prepare('SELECT * FROM member_tbl WHERE member_user = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    //if the user is found we succesfully login to dashboard
    if($user && password_verify($password, $user['member_pass'])){
        session_start();
        $_SESSION['member'] = $user['member_id'];
        echo json_encode(['success' => true]);
    }else{
        echo json_encode(['success' => false, 'message' => 'Invalid password or username']);
    }

    $stmt->close();
?>