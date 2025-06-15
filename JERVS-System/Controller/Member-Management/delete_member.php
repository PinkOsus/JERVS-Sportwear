<?php
    header('Content-Type: application/json');
    include('../../config/database.php');

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])){
        $username = $_POST['username'];

        $stmt = $conn->prepare('DELETE FROM member_tbl WHERE member_user = ?');
        $stmt->bind_param('s', $username);

        if($stmt->execute()){
            echo json_encode(['success' => true]);
        }else{
            echo json_encode(['success' => false, 'message' => 'Failed to delete member']);
        }

        $stmt->close();
    }else {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
    }
?>