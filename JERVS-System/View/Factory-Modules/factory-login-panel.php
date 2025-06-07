<?php
session_start();

if (isset($_SESSION['member'])) {
  header("Location: dashboard.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/stylesheet/index.css" />
    <link rel="stylesheet" href="../assets/stylesheet/globals.css" />
  </head>
  <body>
    <div class="box">
      <div class="log-in">
        <div class="overlap">
          <div class="div">
            <img class="logo" src="../assets/img/logo-1.png" />
            <div class="form-container">
              <div class="headline">
                <div class="overlap-3">
                  <h1 class="JERVS-sportwear">JERVS SPORTWEAR</h1>
                  <p class="text-wrapper-6">Start Your Own Brand!</p>
                </div>
              </div>
              
              <div class="email-form">
                <label class="text-wrapper-3">Username</label>
                <div class="div-wrapper">
                  <input type="text" class="text-wrapper-2" placeholder="Enter your username" />
                </div>
              </div>
              
              <div class="password-form">
                <label class="text-wrapper-5">Password</label>
                <div class="overlap-2">
                  <input type="password" class="text-wrapper-4" placeholder="**********" />
                  <img class="eye-off" src="../assets/img/eye-off.svg" alt="Toggle password visibility" />
                </div>
              </div>
              
              <div class="overlap-group-wrapper">
                <button class="overlap-group">
                  <span class="text-wrapper">Log in</span>
                </button>
              </div>
            </div>
            
            <img class="right-side" src="../assets/img/right-side.png" alt="Decorative background" />
            <img class="img" src="../assets/img/logo-2.png" />
          </div>
        </div>
      </div>
    </div>
  </body>
  <script src="../script/index.js"></script>
</html>