<?php
// Start the session
session_start();
// remove all session variables
session_unset(); 
// destroy the session 
session_destroy(); 

setcookie("freichat_user", "LOGGED_IN", time()-3600, "/"); 
header("Location: login.php?username=".$_GET['username']);
?>