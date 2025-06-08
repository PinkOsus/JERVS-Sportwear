<?php
include('../parts/sidebar.php');
include('../../config/database.php');
include('../../Controller/sessioncheck.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Members | JERVS Admin</title>
    <link rel="stylesheet" href="../assets/stylesheet/dashboard.css" />
    <link rel="stylesheet" href="../assets/stylesheet/add-member.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="../assets/img/logo-1.png" type="image/x-icon">
</head>

<body>
    <div class="container">
        <main class="main-content">
            <div class="fashion-header">
                <h1><i class="fas fa-user-plus"></i> Member Management</h1>
                <p>Add and manage your team members</p>
            </div>
            
            <button id="openAddMemberBtn" class="fashion-btn primary">
                <i class="fas fa-plus"></i> Add New Member
            </button>
            <button id="openDelMemberBtn" class="fashion-btn primary">
                <i class="fas fa-plus"></i> Delete Member
            </button>
            <!-- ADD BUTTON -->
            <div class="fashion-modal" id="addMemberPanel">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2><i class="fas fa-user-edit"></i> Add New Member</h2>
                        <button class="close-btn" onclick="closeModal()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <form id="addUserForm" class="fashion-form">
                        <div class="form-group">
                            <label><i class="fas fa-user"></i> Username</label>
                            <input type="text" name="username" required placeholder="Enter unique username" />
                            <div class="input-decoration"></div>
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-id-card"></i> Full Name</label>
                            <input type="text" name="fullname" required placeholder="Member's full name" />
                            <div class="input-decoration"></div>
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" required placeholder="member@example.com" />
                            <div class="input-decoration"></div>
                        </div>
                        
                        <div class="form-group">
                            <label><i class="fas fa-lock"></i> Password</label>
                            <div class="password-wrapper">
                                <input type="password" name="password" required placeholder="Create secure password" />
                                <button type="button" class="toggle-password"><i class="fas fa-eye"></i></button>
                            </div>
                            <div class="input-decoration"></div>
                            <div class="password-strength"></div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="fashion-btn success">
                                <i class="fas fa-user-plus"></i> Add Member
                            </button>
                            <button type="button" class="fashion-btn danger" onclick="closeModal()">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </div>
                        
                        <div id="addUserMessage" class="message-box"></div>
                    </form>
                </div>
            </div>
            <!-- DELETING MEMBER -->
            <div class="fashion-modal" id="delMemberPanel">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2><i class="fas fa-user-edit"></i> Delete Member</h2>
                        <button class="close-btn" onclick="closeModal()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <table>
                        <thead>
                            <tr>
                                <th> Username</th>
                                <th> Name</th>
                                <th> Option </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $delStmt = 'SELECT * FROM member_tbl';

                                $delResult = $conn->query($delStmt);

                                if ($delResult && $delResult->num_rows > 0){
                                    while($row = $delResult->fetch_assoc()){
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($row['member_user']) .'</td>';
                                        echo '<td>' . htmlspecialchars($row['member_fullname']) .'</td>';
                                        echo '<td>
                                                <form id="delMemForm">
                                                <input type="hidden" name="username" value="' . htmlspecialchars($row['member_user']) . '">
                                                <button type="submit" class-delete-btn>Delete</button>
                                              </td>';
                                        echo '</tr>';
                                    }
                                }else{
                                    echo '<tr><td colspan="4">No login records found.</td></tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                    <div id="showDelmsg"></div><!-- paayos ng div natoh like paalign ng message nya-->
                </div>
            </div>
            <!-- SHOW LOGIN LOGS OF THE MEMBER-->
            <div class="show-login-logs">
                <h2>Member Logs</h2>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Login Time</th>
                                <th>IP Addresss</th>
                                <th>User Agent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $stmt = 'SELECT l.login_time, l.ip_address, l.user_agent, m.member_user
                                         FROM login_logs l
                                         JOIN member_tbl m ON l.member_id = m.member_id
                                         ORDER BY l.login_time DESC LIMIT 20';
                                
                                $result = $conn->query($stmt);

                                if($result && $result->num_rows>0){
                                    while($row = $result->fetch_assoc()){
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($row['member_user']) .'</td>';
                                        echo '<td>' . htmlspecialchars($row['login_time']) .'</td>';
                                        echo '<td>' . htmlspecialchars($row['ip_address']) .'</td>';
                                        echo '<td>' . htmlspecialchars($row['user_agent']) .'</td>';
                                        echo '</tr>';
                                    }
                                }else{
                                    echo '<tr><td colspan="4">No login records found.</td></tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script src="../script/add-member.js"></script>
</body>
</html>