<?php

error_reporting(E_COMPILE_ERROR);

require_once "functions.php";

session_start();

if (isset($_SESSION["user"])) {
    echo '<meta http-equiv="refresh" content="0; url=website.php">';
}

?>

<html lang="en-us">

<head>
    <title>Cloudio - Login</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0"/>
</head>

<body>
<div class="login-container">

    <img src="img/logo.svg" class="logo" alt="LOCALHOST LOGO"/>

    <form action="index.php" method="post">

        <!--USERNAME INPUT-->
        <input type="text" class="input" name="text_username_login" placeholder="Username">

        <!--PASSWORD INPUT-->
        <input type="password" class="input" name="text_password_login" placeholder="Password">

        <!--LOG IN BUTTON-->
        <button type="submit" class="button-login" name="submit_login">Log in</button>
    </form>

    <!--SIGN UP BUTTON-->
    <form action="process_signup_request.php" method="post">
        <button type="submit" class="button-signup" name="submit_signup_redirect">
            Sign up
        </button>
    </form>
    
    <?php
    
    if (checkLogin()) {
        
        $_SESSION["user"] = $_POST["text_username_login"];
        
        echo '<div style = "font-size: 12px; font-family: arial; color: green; float: left; margin-left: 1px;">
                  <label style="vertical-align: middle;">Logged in! Redirecting...</label>
              </div>';
        
        # Redirect to website
        echo '<meta http-equiv="refresh" content="2; url=website.php">';
        
    } else {
        if (isset($_POST["submit_login"])) {
            echo '<div style = "font-size: 12px; font-family: arial; color: red; float: left;">
                        <img src="img/error_icon.svg" alt="ERROR ICON" style="width: 15px; height: 15px; vertical-align: middle; margin-left: 3px; margin-right: 3px;">
                        <label style="vertical-align: middle;">Username or password incorrect</label>
                  </div>';
        }
    }
    
    ?>

</div>
</body>
</html>