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
<!doctype html>
<html>
    <head>
        <!-- Include CSS files for styling -->
        <link rel="stylesheet" type="text/css" href="CSS/universal.css?nocache=<?php echo microtime(); ?>">
        <link rel="stylesheet" type="text/css" href="CSS/headers_and_footers.css?nocache=<?php echo microtime(); ?>">
        <link rel="stylesheet" type="text/css" href="CSS/login.css?nocache=<?php echo microtime(); ?>">
        <title>Login</title>
    </head>
    <body>
        <!-- Add our header to the page -->
        <?php include("HeadersAndFooters/plain_header.php"); ?>
        
        
        <!-- Show our login form.  Submit data to PHP for authentication -->
        <?php
        echo '
        <form method="post" action="">
            <table class="CreateAccountTable">
                <tr>
                    <td width="50px"></td>
                    <td></td>
                    <td width="50px"></td>
                </tr>
                ' . (isset($CreateAccountError) ? '<tr><td></td><td style="color: red; padding-bottom: 30px; font-size: 12pt; font-weight: bold;">' . $CreateAccountError . '</td><td></td></tr>' : '') . '
                <tr>
                    <td></td>
                    <td><p class="CreateAccountInputTag">Email</p></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="text" name="email" value="' . (isset($_POST['email']) ? $_POST['email'] : '') . '" required /></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><p class="CreateAccountInputTag">Password</p></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="password" name="password" required /></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td><td><input type="submit" value="Login" name="login_button" /></td><td></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: 10px; font-size: 11pt;"><p class="or-separator">OR</P></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td><td style="padding-top: 10px;"><a href="create_account.php"><button type="button" class="SubmitButtonLogin">Create An Account</button></a></td><td></td>
                </tr>
            </table>
        </form>
        ';
        
        ?>
        
        <!-- Add jquery and javascript files being used -->
        <script src="JS/jquery-3.2.1.min.js"></script>
        <script src="JS/universal.js?nocache=<?php echo microtime(); ?>"></script>
    </body>
</html>