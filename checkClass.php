<?php
include('maincore.php');

$username = trim(strtolower($_POST['teach_id']));
$username = mysql_escape_string($username);

$query = dbquery("SELECT section_name FROM section WHERE (section_name = '$username' and section_sy='".$current_sy."') LIMIT 2");
$num = dbrows($query);

echo $num;
?>
