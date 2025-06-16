<?php
session_start();

if (isset($_SESSION['member'])) {
  header("Location: factory-system.php");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../JERVS-System/View/assets/stylesheet/globals.css" />
    <link rel="stylesheet" href="../JERVS-System/View/assets/stylesheet/index.css" />
    <title>JERVS Sportwear - Login</title>
    <link rel="icon" href="../assets/img/logo-1.png" type="image/x-icon">
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
              
              <form id="loginForm">
                <div class="email-form">
                  <label class="text-wrapper-3">Username</label>
                  <div class="div-wrapper">
                    <input type="text" class="text-wrapper-2" name="username" placeholder="Enter your username" />
                  </div>
                </div>
                
                <div class="password-form">
                  <label class="text-wrapper-5">Password</label>
                  <div class="password-field">
                    <input type="password" class="text-wrapper-4" name="password" placeholder="**********" />
                    <button type="button" class="toggle-password">
                      <i class="fas fa-eye-slash"></i>
                    </button>
                  </div>
                </div>
                
                <div class="overlap-group-wrapper">
                  <button type="submit" class="overlap-group">
                    <span class="text-wrapper">Log in</span>
                  </button>
                </div>
                <div id="message"></div>
              </form>
            </div>

            <img class="right-side" src="../assets/img/right-side.png" alt="Decorative background" />
            <img class="img" src="../assets/img/logo-2.png" />
          </div>
        </div>
      </div>
    </div>
    <script src="./script/factory-login.js"></script>
  </body>
</html>