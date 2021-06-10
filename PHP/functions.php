<?php

function attemptLogin($sql_conn, $email, $password) {
    //Check the connection
    if(!$sql_conn) {
        array_push($_SESSION['ErrorsToShow'], "We are having trouble accessing our database.  Please try again.");
    } else {
        $emailAttempt = $email;
        $pwAttempt = md5($password);
        
        $sql = "SELECT * FROM users WHERE (email='$emailAttempt') AND (password='$pwAttempt')";

        //Make query and get result
        $result = mysqli_query($sql_conn, $sql);
        
        if(mysqli_num_rows($result) > 1) {
            //should not get here. Only possible if multiple accounts with same login credentials
            array_push($_SESSION['ErrorsToShow'], "Multiple accounts with the same email detected");
            return false;
        } else if(mysqli_num_rows($result) == 1) {
            //found results
            $_SESSION['user'] = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];
            header("location: home.php");
        } else {
            //no results
            array_push($_SESSION['ErrorsToShow'], "Invalid email or passord, please try again");
            return false;
        }
    }
}

function createAccount($sql_conn, $email, $password, $password_confirm) {
    if(empty($email) || empty($password) || empty($password_confirm)) {
        $CreateAccountError = "You are missing required fields";
        return false;
    } else if($password != $password_confirm) {
        array_push($_SESSION['ErrorsToShow'], "Your passwords do not match");
        return false;
    } else if(strlen($password) < 6) {
        array_push($_SESSION['ErrorsToShow'], "Your password must be at least six characters long");
        return false;
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($_SESSION['ErrorsToShow'], "Invalid email address");
        return false;
    } else {
        //Check the connection
        if(!$sql_conn) {
            array_push($_SESSION['ErrorsToShow'], "We are having trouble accessing our data.  Please try again.");
        } else {
            $email_check = $email;
            //Check if the email address already exists in the database
            $sql = "SELECT * FROM users WHERE (email='$email_check')";
            $result = mysqli_query($sql_conn, $sql);

            if(mysqli_num_rows($result) > 0) {
                array_push($_SESSION['ErrorsToShow'], "Email address entered is already associated with an account");
                return false;
            } else {
                //Create the account record
                $email = mysqli_real_escape_string($sql_conn, $email);
                $password = mysqli_real_escape_string($sql_conn, $password);

                $sql = "INSERT INTO users(email, password) VALUES ('$email', MD5('$password'))";

                if(mysqli_query($sql_conn, $sql)) {
                    //success
                    $pwAttempt = md5($password);
                    $emailAttempt = $email;
                    $sql = "SELECT * FROM users WHERE (email='$emailAttempt') AND (password='$pwAttempt')";
                    $result = mysqli_query($sql_conn, $sql);
                    if(mysqli_num_rows($result) == 1) {
                        $_SESSION['user'] = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];
                        header("location: home.php");
                    } else {
                        array_push($_SESSION['ErrorsToShow'], "Unable to add account.");
                        return false;
                    }
                } else {
                    array_push($_SESSION['ErrorsToShow'], "Unable to add account.");
                    return false;
                }
            }
        }
    }
}

?>
