<?php
// Start the session
session_start();
require('maincore.php');

if(isset($_GET['DeleteAnec']) && $_GET['DeleteAnec']=="Yes"){
	$result1 = dbquery("DELETE FROM anecdotal WHERE anec_no='".$_GET['anec_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['NewAnec']) && $_GET['NewAnec']=="Yes"){
	$result1 = dbquery("INSERT INTO anecdotal (anec_no, anec_stud_no, anec_date, anec_desc, anec_details, anec_counselor) VALUES ('','".$_POST['anec_stud_no']."',CURDATE(),'".$_POST['anec_desc']."','".$_POST['anec_details']."','".$_SESSION["user_name"]."')");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['UpdateAnec']) && $_GET['UpdateAnec']=="Yes"){
	$details = $_POST['anec_details']."*** Entry edited by ".$_SESSION["user_name"]." at ".date("Y-m-d h:i:sa")."***";
	$result1 = dbquery("UPDATE anecdotal SET anec_desc='".$_POST['anec_desc']."', anec_details='".$details."' WHERE anec_no='".$_POST['anec_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>