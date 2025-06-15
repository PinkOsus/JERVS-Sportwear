<?php
include('../../config/database.php');
include('../../Controller/sessioncheck.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Management | JERVS Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/stylesheet/dashboard.css">
    <link rel="icon" href="../assets/img/logo-1.png" type="image/x-icon">
</head>
<body>
<?php include('../parts/sidebar.php'); ?>

<div class="main-wrapper">
    <main class="main-content">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="header-content">
                <h1 class="dashboard-title"><i class="fas fa-users"></i> Member Management</h1>
                <p class="dashboard-subtitle">Add and manage your team members</p>
            </div><br>
            <div class="header-actions">
                <button id="openAddMemberBtn" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Member
                </button>
            </div>
        </div>

        <!-- ADD MEMBER PANEL -->
        <div class="metric-card" id="addMemberPanel" style="display: none;">
            <div class="chart-header">
                <h2 class="chart-title"><i class="fas fa-user-plus"></i> Add New Member</h2>
            </div>
            <form id="addUserForm" method="POST" action="../../Controller/add_member.php">
                <div class="form-group"><br><br>
                    <label>Username:</label>
                    <input type="text" name="username" class="form-control" required placeholder="Enter unique username" />
                </div>

                <div class="form-group">
                    <label>Full Name:</label>
                    <input type="text" name="fullname" class="form-control" required placeholder="Member's full name" />
                </div>
                
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" required placeholder="member@example.com" />
                </div>

                <div class="form-group">
                    <label>Password:</label>
                    <div style="position: relative;">
                        <input type="password" name="password" class="form-control" required placeholder="Create secure password" />
                        <button type="button" class="toggle-password" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer;">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn btn-primary">Add Member</button>
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('addMemberPanel').style.display='none'">✖ Close</button>
                </div>
                <div id="addUserMessage"></div>
            </form>
        </div>

        <!-- MEMBER LIST TABLE -->
        <div class="sales-section">
            <div class="section-header">
                <h2 class="section-title">Member List</h2>
            </div>
            <div class="table-responsive">
                <table class="sales-table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $stmt = 'SELECT * FROM member_tbl';
                            $result = $conn->query($stmt);

                            if ($result && $result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($row['member_user']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['member_fullname']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['member_email']) . '</td>';
                                    echo '<td>
                                            <div class="action-buttons">
                                                <form action="../../Controller/delete_member.php" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this member?\');">
                                                    <input type="hidden" name="username" value="' . htmlspecialchars($row['member_user']) . '">
                                                    <button type="submit" class="btn-action delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                          </td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="4">No members found.</td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- MEMBER LOGS SECTION -->
        <div class="sales-section">
            <div class="section-header">
                <h2 class="section-title">Member Login Logs</h2>
            </div>
            <div class="table-responsive">
                <table class="sales-table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Login Time</th>
                            <th>IP Address</th>
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

                            if($result && $result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($row['member_user']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['login_time']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['ip_address']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['user_agent']) . '</td>';
                                    echo '</tr>';
                                }
                            } else {
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