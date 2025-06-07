<?php
session_start();

if (isset($_SESSION['member'])) {
  header("Location: factory-system.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JERVS SPORTWEAR Member Login</title>
  <link rel="stylesheet" href="../assets/stylesheet/index.css">
</head>

<body>
  <div class="login-container">
    <div class="login-card">
      <div class="login-left">
        <div class="logo-top">
          <img src="logo.png" alt="Logo" />
        </div>
        <h2>JERVS SPORTWEAR</h2>
        <p class="subtitle">Start Your Own Brand!</p>

        <form class="login-form" id="loginForm-Member">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Enter your username">

          <label for="password">Password</label>
          <div class="password-wrapper">
            <input type="password" id="password" name="password" placeholder="********">
            <span class="toggle-password">👁️</span>
          </div>

          <button type="submit" class="login-btn">Log In</button>
          <div id="message"></div>
        </form>
      </div>

      <div class="login-right">
        <img src="basketball.png" alt="Basketball Player" />
        <div class="logo-bottom">
          <img src="logo.png" alt="Logo" />
        </div>
      </div>
    </div>
  </div>
  <script src="script/factory-login.js"></script>
</body>

</html>