<?php
session_start();

include('../../PHP/functions.php');
include('../../PHP/startup.php');

if(isset($_POST['UpdateJournal'])) {
    $field = isset($_POST['Field']) ? $_POST['Field'] : '';
    $value = isset($_POST['Value']) ? $_POST['Value'] : '';
    
    editJournalEntry($sql_conn, $_SESSION['user']['user_id'], $_SESSION['JournalDate'], $field, $value);
    
}

?>