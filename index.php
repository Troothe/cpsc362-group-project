<?php
session_start();
include('PHP/functions.php');
include('PHP/startup.php');

//Detect login button press by user
if(isset($_POST['login_button'])) {
    
    $email_attempt = isset($_POST['email']) ? $_POST['email'] : '';
    $pw_attempt = isset($_POST['password']) ? $_POST['password'] : '';
    
    attemptLogin($sql_conn, $email_attempt, $pw_attempt);
    
}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/login_new.css">
  </head>
  <body>
    <div class="wrapper">
      <div class="title"> 
	  <img src="Images/MH.jpg" style="width: 130px">
	  </div>
      <form method="post" action="">
        <div class="field">
          <input type="text" name="email" value="<?php echo (isset($_POST['email']) ? $_POST['email'] : ''); ?>" required />
          <label>Email Address</label>
        </div>
        <div class="field">
          <input type="password" name="password" required>
          <label>Password</label>
        </div>
        <!-- 
        <div class="content">
          <div class="checkbox">
            <input type="checkbox" id="remember-me">
            <label for="remember-me">Remember me</label>
          </div>
          <div class="pass-link"><a href="#">Forgot password?</a></div>
        </div>
        -->
        <div class="field">
          <input type="submit" value="Login" name="login_button" style="margin-top: 0px;">
        </div>
        <div class="signup-link">Not a member? <a href="create_account.php">Signup now</a></div>
      </form>
    </div>
<div class="fixed-header">
        <div class="container">
            
               <span id="relief">Relief</span> <span class="a">LOGIN</span>
            	
        </div>
    </div>
     
    <div class="fixed-footer">
        <div class="container"></div>        
    </div>

        
        <!-- Add jquery and javascript files being used -->
        <script src="JS/jquery-3.2.1.min.js"></script>
        <script src="JS/universal.js?nocache=<?php echo microtime(); ?>"></script>
    </body>
</html>
