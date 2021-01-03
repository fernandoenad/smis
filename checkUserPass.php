<?php
session_start();
require('maincore.php');

$user_pass = trim($_POST['user_pass']);
$user_pass = substr(md5($user_pass),0,50);
$admin_user = $_SESSION["user_name"];
if($_SESSION["user_role"]==0){
	$query = dbquery("SELECT stud_password FROM student WHERE (stud_lrn = '$admin_user' AND stud_password = '$user_pass')");
}
else {
	$query = dbquery("SELECT user_pass FROM users WHERE (user_name = '$admin_user' AND user_pass = '$user_pass')");
}
$num = dbrows($query);

echo $num;
?>
