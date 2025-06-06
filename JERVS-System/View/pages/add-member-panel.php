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
        </main>
    </div>
    <script src="../script/add-member.js"></script>
</body>

</html>