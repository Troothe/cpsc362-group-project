<?php

session_start();
include('PHP/functions.php');
include('PHP/startup.php');

?>

<!doctype html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="CSS/universal.css?nocache=<?php echo microtime(); ?>">
        <link rel="stylesheet" type="text/css" href="CSS/headers_and_footers.css?nocache=<?php echo microtime(); ?>">
        <link rel="stylesheet" type="text/css" href="CSS/login.css?nocache=<?php echo microtime(); ?>">
        <title>Login</title>
    </head>
    <body>
        <?php include("HeadersAndFooters/plain_header.php"); ?>
        
        <div style="width: 100%; text-align: center; font-size: 16pt;">
            <p>You are now logged in!  Navigation features will be added soon.</p>
            <br><br>
            <a href="index.php">Return to home page</a>
        </div>
        
        <script src="JS/jquery-3.2.1.min.js"></script>
        <script src="JS/universal.js?nocache=<?php echo microtime(); ?>"></script>
    </body>
</html>