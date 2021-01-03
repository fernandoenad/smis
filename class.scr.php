<?php
require('maincore.php');

if(isset($_GET['DeleteClass']) && $_GET['DeleteClass']=="Yes"){
	$result1 = dbquery("DELETE FROM section WHERE section_no='".$_GET['section_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['NewClass']) && $_GET['NewClass']=="Yes"){
	$result1 = dbquery("INSERT INTO section (section_no, section_name, section_sy, section_level, section_track, section_cap, section_adviser) VALUES ('','".strtoupper($_POST['section_name'])."', '".$_POST['enrol_sy']."','".$_POST['section_level']."', '".$_POST['section_track_strand']."', '".$_POST['section_cap']."', '".$_POST['section_adviser']."')");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['UpdateClass']) && $_GET['UpdateClass']=="Yes"){
	$result1 = dbquery("UPDATE section SET section_name='".strtoupper($_POST['section_name'])."', section_level='".$_POST['section_level']."', section_track='".$_POST['section_track_strand']."', section_cap='".$_POST['section_cap']."', section_adviser='".$_POST['section_adviser']."' WHERE section_no='".$_POST['section_no']."'");	
	$result2 = dbquery("UPDATE studenroll SET enrol_section='".strtoupper($_POST['section_name'])."' where (enrol_section='".$_POST['section_name_old']."' and enrol_sy='".$current_sy."')");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

?>