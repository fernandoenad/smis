<?php
session_start();
require ('maincore.php');

if(isset($_POST['submit'])){
	$password= substr(md5($_POST['user_pass2']),0,50);
	if($_SESSION["user_role"]==0){
		$resultChangefullname = dbquery("UPDATE student SET stud_password='".$password."' WHERE stud_lrn='".$_POST['user_name']."'");
		//$_SESSION["user_fullname"] = $_POST['user_fullname'];
		$_SESSION["user_pass"] = $_POST['user_pass'];
		header("Location: logout.php?username=".$_POST['user_name']);
	}
	else{
		$resultChangefullname = dbquery("UPDATE users SET user_pass='".$password."' WHERE user_name='".$_POST['user_name']."'");
		// $_SESSION["user_fullname"] = $_POST['user_fullname'];
		$_SESSION["user_pass"] = $_POST['user_pass'];
		header("Location: logout.php?username=".$_POST['user_name']);
	}
	
}

if(isset($_GET['resetPass']) && $_GET['resetPass']=="Yes"){
	$password = substr(md5("P@ssw0rd"),0,50);
	$result1 = dbquery("update users set user_status='1', user_pass='".$password."' WHERE user_no='".$_GET['user_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['deactivateUser']) && $_GET['deactivateUser']=="Yes"){
	$result1 = dbquery("update teacher set teach_status='0', teach_lastmod_user_no='".$_SESSION["userid"]."', teach_lastmoddatetime=NOW() WHERE teach_no='".$_GET['user_no']."'");
	$result1 = dbquery("update users set user_status='0' WHERE user_no='".$_GET['user_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
	
}

if(isset($_GET['reactivateTeacher']) && $_GET['reactivateTeacher']=="Yes"){
	$result1 = dbquery("update teacher set teach_status='1', teach_lastmod_user_no='".$_SESSION["userid"]."', teach_lastmoddatetime=NOW() WHERE teach_no='".$_GET['teach_no']."'");
	$result1 = dbquery("update users set user_status='1' WHERE user_no='".$_GET['teach_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['deactivateTeacher']) && $_GET['deactivateTeacher']=="Yes"){
	$result1 = dbquery("update teacher set teach_status='0', teach_lastmod_user_no='".$_SESSION["userid"]."', teach_lastmoddatetime=NOW() WHERE teach_no='".$_GET['teach_no']."'");
	$result1 = dbquery("update users set user_status='0' WHERE user_no='".$_GET['teach_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['deleteUser']) && $_GET['deleteUser']=="Yes"){
	$result1 = dbquery("DELETE FROM users WHERE user_no='".$_GET['user_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

?>