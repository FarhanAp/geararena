<?php
require 'function.php';

if(isset($_GET['user']))
{
    echo "<script>alert('wrong email or password')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
      
    <div class="container">
       <div class="box">
        <div class="header">
            <header><img src="images/logo.png" alt=""></header>
            <p>Log In to Gear Arena</p>
        </div>
        <form action="function.php" method="POST">
            <div class="input-box">
                <label for="email">Email</label>
                <input type="email" class="input-field" name="email" required>
                <i class="bx bx-envelope"></i>
            </div>
            <div class="input-box">
                <label for="pass">Password</label>
                <input type="password" class="input-field" name="pass" required>
                <i class="bx bx-lock"></i>
            </div>
            <div class="input-box">
                <input type="submit" class="input-submit" value="LOG IN" name="login">
            </div>
        </form>
        <div class="bottom">
            <span><a href="register.php">Sign Up</a></span>
            <span><a href="#">Forgot Password?</a></span>
        </div>
        
       </div>
       <div class="wrapper"></div>
    </div>
</body>
</html>