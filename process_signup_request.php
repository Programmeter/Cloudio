<?php

error_reporting(E_COMPILE_ERROR);

include_once "functions.php";
include_once "mysql_connect.php";

?>

<html lang="en-us">

<head>
    <title>Cloudio - Signup</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0"/>
</head>

<body>
<div class="login-container">
    <img src="img/logo.svg" class="logo" alt="LOCALHOST"/>

    <form action="process_signup_request.php" method="post">

        <!--USERNAME INPUT-->
        <input type="text" class="input" name="text_username_signup" placeholder="Username">

        <!--PASSWORD INPUT-->
        <input type="password" class="input" name="text_password_signup" placeholder="Password">

        <!--CONFIRM PASSWORD INPUT-->
        <input type="password" class="input" name="text_confirm_password" placeholder="Confirm password">

        <!--SIGN UP BUTTON-->
        <button type="submit" class="button-login" name="submit_signup">Create account</button>
    </form>
    
    <?php
    
    if (checkSignup() === false) {
        
        $username_signup = $_POST["text_username_signup"];
        $password_signup = $_POST["text_password_signup"];
        $password_hashed = hash("sha256", $password_signup);
        
        $query_create_user = "INSERT INTO user_accounts (username, password) VALUES ('$username_signup', '$password_hashed')";
        $db->query($query_create_user);
        
        mkdir("user_folders/".$username_signup);
        chmod("user_folders/".$username_signup, 0755);
        
        echo '<div style = "font-size: 12px; font-family: Arial; color: green; float: left; margin-left: 1px;">
                <label style="vertical-align: middle;">Created account! Redirecting...</label>
          </div>';
        
        # Redirect to index
        echo '<meta http-equiv="refresh" content="2; url=index.php">';
    } else {
        
        $error = checkSignup();
        
        if (is_string($error)) {
            echo '<div style = "font-size: 12px; font-family: Arial; color: red; float: left;">
                  <img src="img/error_icon.svg" alt="ERROR ICON" style="width: 15px; height: 15px; vertical-align: middle; margin-left: 3px; margin-right: 3px;">
                  <label style="vertical-align: middle;">'.$error.'</label>
          </div>';
        }
    }
    
    ?>

</div>
</body>
</html>