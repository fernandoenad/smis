<?php
session_start();
require('maincore.php');
if(isset($_GET['saveStudent']) && $_GET['saveStudent']=="Yes"){
	
	$result1 = dbquery("INSERT INTO student (stud_no, stud_lrn, stud_lname, stud_fname, stud_mname, stud_xname, stud_gender, stud_bdate, stud_residence, stud_religion, stud_dialect, stud_ethnicity, stud_cct, stud_create_user_id, stud_creaatedatetime) VALUES ('','".$_POST['stud_lrn']."','".strtoupper($_POST['stud_lname'])."','".strtoupper($_POST['stud_fname'])."','".strtoupper($_POST['stud_mname'])."','".$_POST['stud_xname']."','".$_POST['stud_gender']."','".$_POST['stud_bdate']."','".$_POST['stud_residence']."','-','-','-','".$_POST['stud_cct']."','".$_SESSION["userid"]."', NOW())");			
	$result2 = dbquery("SELECT * FROM student WHERE stud_lrn='".$_POST['stud_lrn']."'");
	$data1 = dbarray($result2);
	$insertContact = dbquery("INSERT INTO studcontacts (studCont_no, studCont_stud_no, studCont_stud_glname, studCont_stud_gfname, studCont_stud_gmname, studCont_stud_grelation, studCont_stud_gcontact, studCont_stud_flname, studCont_stud_ffname, studCont_stud_fmname, studCont_stud_mlname, studCont_stud_mfname, studCont_stud_mmname) VALUES ('','".$data1['stud_no']."','-','-','-','PARENT','-','-','-','-','-','-','-')");
	$password = substr(md5("P@ssw0rd"),0,50);
	$updateAccess = dbquery("update student set stud_username='".$data1['stud_no']."', stud_password='".$password."' where stud_no='".$data1['stud_no']."'");
	if($earlyregistrationOn==true){
		header("Location: ./?page=student&searchStudent=".$data1['stud_no']."");
	}
	else{
		header("Location: ./?page=student&showProfile=".$data1['stud_no']."&tab=history");
	}
}

if(isset($_GET['saveStudentER']) && $_GET['saveStudentER']=="Yes"){
	
	$result1 = dbquery("INSERT INTO studenter (stud_no, stud_lrn, stud_lname, stud_fname, stud_mname, stud_xname, stud_gender, stud_bdate, stud_residence, stud_religion, stud_dialect, stud_ethnicity, stud_cct, stud_create_user_id, stud_creaatedatetime) VALUES ('','".$_POST['stud_lrn']."','".strtoupper($_POST['stud_lname'])."','".strtoupper($_POST['stud_fname'])."','".strtoupper($_POST['stud_mname'])."','".$_POST['stud_xname']."','".$_POST['stud_gender']."','".$_POST['stud_bdate']."','".$_POST['stud_residence']."','-','-','-','".$_POST['stud_cct']."','".$_SESSION["userid"]."', NOW())");			
	$result2 = dbquery("SELECT * FROM studenter WHERE stud_lrn='".$_POST['stud_lrn']."'");
	$data1 = dbarray($result2);
	header("Location: ./?page=student&showProfileER=".$data1['stud_no']."&tab=history");
}

if(isset($_GET['updateStudent']) && $_GET['updateStudent']=="Yes"){
	$result1 = dbquery("UPDATE student SET stud_lrn='".$_POST['stud_lrn']."', stud_lname='".strtoupper($_POST['stud_lname'])."', stud_fname='".strtoupper($_POST['stud_fname'])."', stud_mname='".strtoupper($_POST['stud_mname'])."', stud_xname='".$_POST['stud_xname']."', stud_gender='".$_POST['stud_gender']."', stud_bdate='".$_POST['stud_bdate']."', stud_residence='".$_POST['stud_residence']."', stud_religion='".$_POST['stud_religion']."', stud_dialect='".$_POST['stud_dialect']."', stud_ethnicity='".$_POST['stud_ethnicity']."', stud_cct='".$_POST['stud_cct']."', stud_lastmod_user_id='".$_SESSION["userid"]."', stud_lastmoddatetime=NOW() WHERE stud_no='".$_POST['stud_no']."'");	
	$result2 = dbquery("SELECT * FROM student WHERE stud_no='".$_POST['stud_no']."'");
	$data1 = dbarray($result2);
	
	$checkContact = dbquery("SELECT * FROM studcontacts WHERE studCont_stud_no='".$_POST['stud_no']."'");
	$checkContactrows = dbrows($checkContact);
	if($checkContactrows){
		$updateContact = dbquery("UPDATE studcontacts SET studCont_stud_glname='".$_POST['stud_gua_lname']."', studCont_stud_gfname='".strtoupper($_POST['stud_gua_fname'])."', studCont_stud_gmname='".strtoupper($_POST['stud_gua_mname'])."', studCont_stud_grelation='".$_POST['stud_gua_rel']."', studCont_stud_gcontact='".$_POST['stud_gua_contact']."', studCont_stud_flname='".strtoupper($_POST['stud_fat_lname'])."', studCont_stud_ffname='".strtoupper($_POST['stud_fat_fname'])."', studCont_stud_fmname='".strtoupper($_POST['stud_fat_mname'])."', studCont_stud_mlname='".strtoupper($_POST['stud_mot_lname'])."', studCont_stud_mfname='".strtoupper($_POST['stud_mot_fname'])."', studCont_stud_mmname='".strtoupper($_POST['stud_mot_mname'])."' WHERE studCont_stud_no='".$_POST['stud_no']."'");
	}
	else{
		$insertContact = dbquery("INSERT INTO studcontacts (studCont_no, studCont_stud_no, studCont_stud_glname, studCont_stud_gfname, studCont_stud_gmname, studCont_stud_grelation, studCont_stud_gcontact, studCont_stud_flname, studCont_stud_ffname, studCont_stud_fmname, studCont_stud_mlname, studCont_stud_mfname, studCont_stud_mmname) VALUES ('','".$_POST['stud_no']."','".strtoupper($_POST['stud_gua_lname'])."','".strtoupper($_POST['stud_gua_fname'])."','".strtoupper($_POST['stud_gua_mname'])."','".$_POST['stud_gua_rel']."','".$_POST['stud_gua_contact']."','".strtoupper($_POST['stud_fat_lname'])."','".strtoupper($_POST['stud_fat_fname'])."','".strtoupper($_POST['stud_fat_mname'])."','".strtoupper($_POST['stud_mot_lname'])."','".strtoupper($_POST['stud_mot_fname'])."','".strtoupper($_POST['stud_mot_mname'])."')");

	}
	if($earlyregistrationOn==true){
		header("Location: ./?page=student&earlyRegistration&er_level=all");
	}
	else{
		header("Location: ./?page=student&showProfile=".$data1['stud_no']."&tab=history");
	}
}

if(isset($_GET['saveResidence']) && $_GET['saveResidence']=="Yes"){
	$result1 = dbquery("INSERT INTO dropdowns (field_no, field_category, field_name) VALUES ('','RESIDENCE','".strtoupper($_POST['residence'])."')");
	header("Location: ".$_SERVER['HTTP_REFERER']);
	
}

if(isset($_GET['resetPass']) && $_GET['resetPass']=="Yes"){
	$password = substr(md5("P@ssw0rd"),0,50);
	$result1 = dbquery("update student set stud_password='".$password."', stud_lastmod_user_id='".$_SESSION["userid"]."', stud_lastmoddatetime=NOW(), stud_status='1' WHERE stud_no='".$_GET['stud_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
	
}

?>