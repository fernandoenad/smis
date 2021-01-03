<?php
// Start the session
session_start();
require('maincore.php');

if(isset($_GET['DeleteAnec']) && $_GET['DeleteAnec']=="Yes"){
	$result1 = dbquery("DELETE FROM anecdotal WHERE anec_no='".$_GET['anec_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['NewAnec']) && $_GET['NewAnec']=="Yes"){
	$result1 = dbquery("INSERT INTO anecdotal (anec_no, anec_stud_no, anec_date, anec_desc, anec_details, anec_user_name) VALUES ('','".$_POST['anec_stud_no']."','".$_POST['anec_date']."','".$_POST['anec_desc']."','".$_POST['anec_details']."','".$_SESSION["user_name"]."')");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['UpdateAnec']) && $_GET['UpdateAnec']=="Yes"){
	$details = $_POST['anec_details']."*** Entry edited by ".$_SESSION["user_name"]." at ".date("Y-m-d h:i:sa")."***";
	$result1 = dbquery("UPDATE anecdotal SET anec_desc='".$_POST['anec_desc']."', anec_details='".$details."' WHERE anec_no='".$_POST['anec_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['Credentials']) && $_GET['Credentials']=="Yes"){
	$anec_details  = $_POST['anec_details'];
	for($i=0; $i<sizeof($anec_details);$i++){
		$details =  $details.$anec_details[$i].", ";
	}
	$details = ".".substr($details,0,strlen($details)-2)." - ".$_SESSION["user_name"]." on ".date("M-d-Y h:ia");
	$result1 = dbquery("UPDATE student SET stud_credentials='".$details."' WHERE stud_no='".$_POST['stud_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>