<?php
session_start();
require('maincore.php');

$admin_pword = trim($_POST['admin_pword']);
$admin_pword = substr(md5($admin_pword),0,50);
$query = dbquery("SELECT user_pass FROM users WHERE (user_role = '1' AND user_pass = '".$admin_pword."')");
$num = dbrows($query);

echo $num;
?>
