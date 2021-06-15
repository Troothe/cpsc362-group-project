<?php

session_start();
include('PHP/functions.php');
include('PHP/startup.php');


//Detect create account button press by user
if(isset($_POST['create_account_button'])) {
    
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $pw = isset($_POST['password']) ? $_POST['password'] : '';
    $pw_confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : '';
    
    createAccount($sql_conn, $email, $pw, $pw_confirm);
    
}


?>
<!doctype html>
<html>
    <head>
        <!-- Include CSS files for styling -->
        <link rel="stylesheet" type="text/css" href="CSS/universal.css?nocache=<?php echo microtime(); ?>">
        <link rel="stylesheet" type="text/css" href="CSS/headers_and_footers.css?nocache=<?php echo microtime(); ?>">
        <link rel="stylesheet" type="text/css" href="CSS/login.css?nocache=<?php echo microtime(); ?>">
        <title>Create Account</title>
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
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
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
                    <td></td>
                    <td><p class="CreateAccountInputTag">Confirm Password</p></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="password" name="password_confirm" required/></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td><td><input type="submit" value="Create Account" name="create_account_button" /></td><td></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="padding-top: 30px; font-size: 11pt;"><a href="index.php">Or login to an existing account</a></td>
                    <td></td>
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