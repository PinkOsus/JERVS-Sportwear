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
    $stmt->store_result();

    if($stmt->num_rows == 1){
        $stmt->bind_result($member_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
        //if Successful login — record the log
            $ip = $_SERVER['REMOTE_ADDR'];
            $user_agent = $_SERVER['HTTP_USER_AGENT'];

            $logStmt = $conn->prepare('INSERT INTO login_logs (member_id, ip_address, user_agent) VALUES (?, ?, ?)');
            $logStmt->bind_param('iss', $member_id, $ip, $user_agent);
            $logStmt->execute();
            $logStmt->close();

            // Set session or token
            $_SESSION['member_id'] = $member_id;

            echo json_encode(['success' => true, 'message' => 'Login successful']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Incorrect password']);
        }
    }
    $stmt->close();
?>
