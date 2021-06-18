<?php
$link = mysqli_connect('localhost','test_account','12345','cpsc_362');

if(!$link) {
	echo 'Connection failed';
        die('Could not connect: '. mysql_error());
}
echo 'Connected successfully<p>';

$user_id = $POST_['uid'];

$query = "SELECT J.daily_affirmations, J.gratitude_journal, J.just_write
                        FROM journal_entries J
                        WHERE J.user_id_journal =" .$_POST["uid"];
$result = $link->query($query);
echo "User journal entries: ".$_POST["journal_args"],"<br>";
while($row = $result->fetch_assoc()){
        printf("Daily Affirmations: %s<br>\n", $row["daily_affirmations"]);
        printf("Gratitude Journal: %s<br>\n", $row["gratitude_journal"]);
        printf("Just Write: %s<br>\n\n\n", $row["just_write"]);
}
?>