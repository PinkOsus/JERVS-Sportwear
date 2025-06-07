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
    <title>Add Members</title>
    <link rel="stylesheet" href="../assets/stylesheet/dashboard.css" />
</head>

<body>
    <div class="container">
        <main class="main-content">
            <button id="openAddMemberBtn">+ Add Member</button>
            <div class="add-user-panel" id="addMemberPanel" style="display: none;">
                <h2>Add New Member</h2>
                <form id="addUserForm">
                    <label>Username:</label>
                    <input type="text" name="username" required />

                    <label>Full name: </label>
                    <input type="text" name="fullname" required />

                    <label>Email:</label>
                    <input type="email" name="email" required />

                    <label>Password:</label>
                    <input type="password" name="password" required />

                    <button type="submit">Add Member</button>
                    <button type="button" onclick="document.getElementById('addMemberPanel').style.display='none'">✖ Close</button>
                    <div id="addUserMessage"></div>
                </form>
            </div>
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