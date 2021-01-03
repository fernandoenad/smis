<?php
// Start the session
session_start();
require('maincore.php');

if(isset($_GET['DeleteAnec']) && $_GET['DeleteAnec']=="Yes"){
	$result1 = dbquery("DELETE FROM teacherids WHERE teacherids_no='".$_GET['anec_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['NewAnec']) && $_GET['NewAnec']=="Yes"){
	$result1 = dbquery("INSERT INTO teacherids (teacherids_no, teacherids_teach_no, teacherids_id, teacherids_details, teacherids_date_issued, teacherids_place_issued) VALUES ('','".$_POST['anec_stud_no']."','".$_POST['anec_desc']."','".$_POST['anec_details']."','".$_POST['anec_date']."', '".$_POST['anec_place']."')");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['UpdateAnec']) && $_GET['UpdateAnec']=="Yes"){
	$result1 = dbquery("UPDATE teacherids SET teacherids_id='".$_POST['anec_desc']."', teacherids_details='".$_POST['anec_details']."', teacherids_date_issued='".$_POST['anec_date']."', teacherids_place_issued='".$_POST['anec_place']."' WHERE teacherids_no='".$_POST['anec_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['UpdateBiometricID']) && $_GET['UpdateBiometricID']=="Yes"){
	$result1 = dbquery("UPDATE teacher SET teach_bio_no='".$_POST['teach_bio_no']."' WHERE teach_no='".$_POST['teach_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>