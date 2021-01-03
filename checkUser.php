<?php
include('maincore.php');

$username = trim(strtolower($_POST['stud_lrn']));
$username = mysql_escape_string($username);

$query = dbquery("SELECT user_name FROM users WHERE user_name = '$username' LIMIT 2");
$num = dbrows($query);

echo $num;
?>
