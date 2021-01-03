<?php
include('maincore.php');

$username = trim(strtolower($_POST['stud_lrn']));
$username = mysqli_real_escape_string($conn, $username);

$query = dbquery("SELECT stud_lrn FROM student WHERE stud_lrn = '$username' LIMIT 2");
$num = dbrows($query);

echo $num;
?>
