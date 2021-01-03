<?php
include('maincore.php');

$username = trim(strtolower($_POST['teach_id']));
$username = mysqli_real_escape_string($conn, $username);

$query = dbquery("SELECT teach_id FROM teacher WHERE teach_id = '$username' LIMIT 2");
$num = dbrows($query);

echo $num;
?>
