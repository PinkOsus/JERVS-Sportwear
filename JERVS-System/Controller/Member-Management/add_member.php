<?php
    header('Content-Type: application/json');
    include('../../config/database.php');

    $username = trim($_POST['username'] ?? '');
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    //validate infos
    if(!$username || !$fullname || !$email || !$password){
        echo json_encode(['success' => false, 'message' => 'Please fill all of the input field']);
        exit;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo json_encode(['success' => false, 'message' => 'Invalid Email']);
        exit;
    }
    //check if the username already exist
    $checkStmt = $conn->prepare('SELECT member_id FROM member_tbl WHERE member_user = ? OR member_email = ?');
    $checkStmt->bind_param('ss', $username, $email);
    $checkStmt->execute();
    $checkStmt->store_result();

    if($checkStmt->num_rows > 0){
        echo json_encode(['success' => false, 'message' => 'Username or Email already exists']);
        $checkStmt->close();
        exit;
    }
    //final process/saving to database
    $hashpass = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare('INSERT INTO member_tbl(member_user, member_fullname, member_email, member_pass) VALUES (?,?,?,?)');
    $stmt->bind_param('ssss', $username, $fullname, $email, $hashpass);

    if($stmt->execute()){
        echo json_encode(['success' => true]);
    }else{
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
    }

    $stmt->close();
?>