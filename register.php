<?php
require 'function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
      
    <div class="container">
       <div class="box">
        <div class="header">
            <header><img src="images/logo.png" alt=""></header>
            <p>Sign up to Gear Arena</p>
        </div>
        <form action="function.php" method="POST">
            <div class="input-box">
                <label for="username">Username</label>
                <input type="username" class="input-field" name="username" required>
                <i class="bx bx-envelope"></i>
            </div>
            <div class="input-box">
                <label for="email">Email</label>
                <input type="email" class="input-field" name="email" required>
                <i class="bx bx-envelope"></i>
            </div>
            <div class="input-box ">
                <label for="pass">Password</label>
                <input type="password" class="input-field" name="pass" required>
                <i class="bx bx-lock"></i>
            </div>
            <div class="input-box ">
                <label for="conpass">Confirm Password</label>
                <input type="password" class="input-field" name="conpass" required>
                <i class="bx bx-lock"></i>
            </div>
            <div class="input-box">
                <input type="submit" class="input-submit" value="SIGN UP" name="signup">
            </div>
        </form>
        <div class="bottom">
            <span><a href="login.php">Sign in</a></span>
        </div>
        
       </div>
       <div class="wrapper"></div>
    </div>
    <script>
        $(".toggle-password").click(function() {

$(this).toggleClass("fa-eye fa-eye-slash");
var input = $($(this).attr("toggle"));
if (input.attr("type") == "password") {
  input.attr("type", "text");
} else {
  input.attr("type", "password");
}
});
</script>
</body>
</html>

