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

function editThoughtCount($sql_conn, $user_id, $field, $value) {
    if(!$sql_conn) {
        array_push($_SESSION['ErrorsToShow'], "We are having trouble accessing our database.  Please try again.");
    } 
    
    $sql = "UPDATE thought_tracker SET $field = '$value' WHERE (user_id_thought_tracker='$user_id')";
    
    //Make query and get result
    $result = mysqli_query($sql_conn, $sql);
}

function insertThought($sql_conn, $user_id, $thought, $new_value) { 
    //Check the connection
    if(!$sql_conn) {
        array_push($_SESSION['ErrorsToShow'], "We are having trouble accessing our database.  Please try again.");
    } 
    
    //Insert tracked entries into database
    //Perform a search to see if there is already an entry in our database
        $sql = "SELECT * FROM thought_tracker WHERE user_id_thought_tracker='$user_id'";

        //Make query and get result
        $result = mysqli_query($sql_conn, $sql);
        
        if(mysqli_num_rows($result) < 1) {
            //If there is more than one entry, insert tracker into entry
            $sql = "INSERT INTO thought_tracker(user_id_thought_tracker) VALUES ('$user_id')";
		$result = mysqli_query($sql_conn, $sql);
	}
}

function trackThought($sql_conn, $user_id, $thought, $new_value) {
    //Check the connection
    if(!$sql_conn) {
        array_push($_SESSION['ErrorsToShow'], "We are having trouble accessing our database.  Please try again.");
    } else {
        
        //Perform a search to see if there is already an entry in our database
        $sql = "SELECT * FROM thought_tracker WHERE user_id_thought_tracker='$user_id'";

        //Make query and get result
        $result = mysqli_query($sql_conn, $sql);
        
        if(mysqli_num_rows($result) > 1) {
            //If there is more than one entry, this is not good.  Show an error and return false
            array_push($_SESSION['ErrorsToShow'], "Too many logs found in our query, please try again.");
            return false;
        } else if(mysqli_num_rows($result) == 1) {
            //Found one result, we can move on as normal
            $continue = true;
        } else {
            //No results found, create a new entry in our database
            $sql = "INSERT INTO thought_tracker(user_id_thought_tracker) VALUES ('$user_id')";
            if(mysqli_query($sql_conn, $sql)) {
                //success
                $continue = true;
            }
        }  
        
        //If there is an entry in our database for us to change, do so here
        if(isset($continue) && $continue == true) {
        
            //Update the table row
            $sql = "UPDATE thought_tracker SET $thought = '$new_value' WHERE user_id_thought_tracker = '$user_id'";

            //Make query and get result
            $result = mysqli_query($sql_conn, $sql);
        }
    }
}

function insertJournalEntry($sql_conn, $user_id, $affirmations, $gratitude, $just_write, $journal_date) { 
    //Check the connection
    if(!$sql_conn) {
        array_push($_SESSION['ErrorsToShow'], "We are having trouble accessing our database.  Please try again.");
    } 

    //Insert journal entries into database
    $sql = "INSERT INTO journal_entries(user_id_journal, daily_affirmations, gratitude_journal, just_write, journal_date) VALUES ('$user_id', '$affirmations', '$gratitude', '$just_write', '$journal_date')";
}

function pullJournalEntry($sql_conn, $user_id) {
    if(!$sql_conn) {
        array_push($_SESSION['ErrorsToShow'], "We are having trouble accessing our database.  Please try again.");
    } 

    //Perform a search to see if there is already an entry in our database
    $sql = "SELECT * FROM journal_entries WHERE user_id_journal='$user_id'";

     //Make query and get result
     $result = mysqli_query($sql_conn, $sql);

     //Show result
     $_SESSION['journal_entries'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function editJournalEntry($sql_conn, $user_id, $journal_date, $field, $value) {
    if(!$sql_conn) {
        array_push($_SESSION['ErrorsToShow'], "We are having trouble accessing our database.  Please try again.");
    } 
    
    $sql = "UPDATE journal_entries SET $field = '$value' WHERE (user_id_journal='$user_id') AND (journal_date='$journal_date')";
    
    //Make query and get result
    $result = mysqli_query($sql_conn, $sql);
}

function pullSingleJournalEntryByDate($sql_conn, $user_id, $journal_date) {
    if(!$sql_conn) {
        array_push($_SESSION['ErrorsToShow'], "We are having trouble accessing our database.  Please try again.");
    } 

    //Perform a search to see if there is already an entry in our database
    $sql = "SELECT * FROM journal_entries WHERE (user_id_journal='$user_id') AND (journal_date='$journal_date')";

    $result = mysqli_query($sql_conn, $sql);
    if(mysqli_num_rows($result) == 1) {
        $_SESSION['journal_entry'] = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];
    } else {
        array_push($_SESSION['ErrorsToShow'], "Error fetching journal entries.  Please try again.");
    }
}

function checkJournalEntryExistsByDate($sql_conn, $user_id, $journal_date) {
    if(!$sql_conn) {
        array_push($_SESSION['ErrorsToShow'], "We are having trouble accessing our database.  Please try again.");
    } 

    //Perform a search to see if there is already an entry in our database
    $sql = "SELECT * FROM journal_entries WHERE (user_id_journal='$user_id') AND (journal_date='$journal_date')";

     //Make query and get result
     $result = mysqli_query($sql_conn, $sql);

     //Show result
     $TempJournalArray = mysqli_fetch_all($result, MYSQLI_ASSOC);
     if(count($TempJournalArray) > 0) {
         return true;
     } else {
         return false;
     }
}

function editJournalEntry($sql_conn, $user_id, $journal_date, $field, $value) {
    if(!$sql_conn) {
        array_push($_SESSION['ErrorsToShow'], "We are having trouble accessing our database.  Please try again.");
    } 
    
    $sql = "UPDATE journal_entries SET $field = '$value' WHERE (user_id_journal='$user_id') AND (journal_date='$journal_date')";
    
    //Make query and get result
    $result = mysqli_query($sql_conn, $sql);
}

?>
