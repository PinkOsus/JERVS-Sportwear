<?php
include('../parts/sidebar.php');
include('../../config/database.php');
include('../../Controller/sessioncheck.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/stylesheet/dashboard.css" />
</head>
<body>
    <div class="container">
        <main class="main-content">
            <button id="openAddOrderBtn">Add Order Member</button>
            <div class="add-member-panel" id="addOrder">
                <h2>Add New Order</h2>
                <form id="addUserForm">
                    <label>Item:</label>
                    <input type="text" name="item" required />

                    <label>Initial Deposit</label>
                    <input type="number" required/>

                    <button type="submit">Add Order</button>
                    <button type="button" onclick="document.getElementById('addMemberPanel').style.display='none'">✖ Close</button>
                    <div id="addUserMessage"></div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>