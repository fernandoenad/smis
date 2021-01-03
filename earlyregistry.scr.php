<?php
session_start();
require('maincore.php');

if(isset($_GET['update']) && $_GET['update']=="Yes"){
	$result1 = dbquery("UPDATE earlyregistry SET er_level='".$_POST['er_level']."', er_disability='".$_POST['er_disability']."', er_prevschool='".$_POST['er_prevschool']."', er_creds='".$_POST['er_creds']."', er_remarks='".$_POST['er_remarks']."', er_lastmoddatetime=NOW(), er_lastmod_user_no='".$_SESSION["userid"]."' WHERE er_no='".$_POST['er_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['save']) && $_GET['save']=="Yes"){
	$result1 = dbquery("INSERT INTO earlyregistry (er_no, er_stud_no, er_sy, er_level, er_disability, er_prevschool, er_creds, er_remarks, er_lastmoddatetime, er_lastmod_user_no) VALUES ('','".$_POST['er_stud_no']."','".$_POST['er_sy']."','".$_POST['er_level']."','".$_POST['er_disability']."','".$_POST['er_prevschool']."','".$_POST['er_creds']."','".$_POST['er_remarks']."',NOW(),'".$_SESSION["userid"]."')");	
	header("Location: ".$_SERVER['HTTP_REFERER']."&earlyregistered=yes");
	//header("Location: ./?page=student&earlyRegistration&er_level=".$_POST['er_level']."");
}

if(isset($_GET['unregister']) && $_GET['unregister']=="Yes"){
	$result1 = dbquery("delete from earlyregistry WHERE er_no='".$_GET['er_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>