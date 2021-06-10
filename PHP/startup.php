<?php

$_SESSION['ErrorsToShow'] = array();

$mysql_server = 'localhost';
$mysql_account = 'test_account';
$mysql_pw = '12345';
$mysql_db = 'cpsc_362';

$sql_conn = mysqli_connect($mysql_server, $mysql_account, $mysql_pw, $mysql_db);

?>