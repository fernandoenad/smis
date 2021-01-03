<?php
session_start();
require('maincore.php');



if(isset($_GET['save']) && $_GET['save']=="yes"){
	$searchStudent = $_POST['stud_no'];
	$selectStudent = dbquery("SELECT * FROM proposedsection WHERE (prop_sy='".$current_sy."' AND prop_lrn='".$searchStudent ."')");
	$countStudent = dbrows($selectStudent );
	if($countStudent<1){
		$insertProposedSection = dbquery("INSERT INTO proposedsection (prop_no, prop_sy, prop_lrn, prop_section, reg_userno, reg_datetime) VALUES ('', '".$current_sy."', '".$searchStudent."', '".$_POST['newsection']."', '".$_SESSION["userid"]."', NOW())");
	}	
	header("Location: ".$_SERVER['HTTP_REFERER']);
	
}

if(isset($_GET['delete']) && $_GET['delete']=="yes"){
	$deleteRegistrant = dbquery("delete from proposedsection where prop_no='".$_POST['prop_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
	
}
?>