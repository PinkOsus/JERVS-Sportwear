<?php
    header('Content-Type: application/json');
    error_reporting(0);
    include('../config/database.php');

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST['password'];
    //verify
    if (!$username || !$password) {
        echo json_encode(['success' => false, 'message' => 'Email and password required']);
        exit;
    }
    //finding the user if it exists
    $stmt = $conn->prepare('SELECT * FROM member_tbl WHERE member_user = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['member_pass'])) {
        //if Successful login — record the log
            $ip = $_SERVER['REMOTE_ADDR'];
            $user_agent = $_SERVER['HTTP_USER_AGENT'];

            $logStmt = $conn->prepare('INSERT INTO login_logs (member_id, ip_address, user_agent) VALUES (?, ?, ?)');
            $logStmt->bind_param('iss', $member_id, $ip, $user_agent);
            $logStmt->execute();
            $logStmt->close();

            // Set session or token
            $_SESSION['member_id'] = $user['member_id'];
            $_SESSION['username'] = $user['member_user'];

            echo json_encode(['success' => true, 'message' => 'Login successful']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Incorrect password']);
        }
    }
    $stmt->close();
?>
