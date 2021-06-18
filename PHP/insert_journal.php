<?php
$link = mysqli_connect('localhost','test_account','12345','cpsc_362');

if(!$link) {
	echo 'Connection failed';
        die('Could not connect: '. mysql_error());
}
echo 'Connected successfully<p>';

$user_id = $POST_['uid'];
$daily_affirmations = $_POST['affirmation'];
$gratitude_journal = $_POST['gratitude'];
$just_write = $_POST['write'];

$insert_journal_entries = "INSERT INTO journal_entries(daily_affirmations, gratitude_journal, just_write)
                        VALUES ('$daily_affirmations, $gratitude_journal, $just_write);"
mysqli_query($conn, $insert_journal_entries);
?>