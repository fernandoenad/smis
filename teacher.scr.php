<?php
session_start();
require('maincore.php');
if(isset($_GET['saveTeacher']) && $_GET['saveTeacher']=="Yes"){
	$result1 = dbquery("INSERT INTO teacher (teach_no, teach_id, teach_lname, teach_fname, teach_mname, teach_xname, teach_gender, teach_bdate, teach_residence, teach_tin, teach_dialect, teach_ethnicity, teach_cstatus, teach_create_user_no, teach_cretedatetime, teach_status) VALUES ('','".$_POST['teach_id']."','".mb_strtoupper($_POST['stud_lname'],'UTF-8')."','".mb_strtoupper($_POST['stud_fname'],'UTF-8')."','".mb_strtoupper($_POST['stud_mname'],'UTF-8')."','".$_POST['stud_xname']."','".$_POST['stud_gender']."','".$_POST['stud_bdate']."','".$_POST['stud_residence']."','-','-','-','".$_POST['stud_cstatus']."','".$_SESSION["userid"]."', NOW(), '1')");			
	$result2 = dbquery("SELECT * FROM teacher WHERE teach_id='".$_POST['teach_id']."'");
	$data1 = dbarray($result2);
	header("Location: ./admin.scr.php?NewUser1=Yes&teach_no=".$data1['teach_no']);
	
}

if(isset($_GET['updateTeacher']) && $_GET['updateTeacher']=="Yes"){
	$result1 = dbquery("UPDATE teacher SET teach_id='".$_POST['teach_id']."', teach_lname='".strtoupper($_POST['stud_lname'])."', teach_fname='".strtoupper($_POST['stud_fname'])."', teach_mname='".strtoupper($_POST['stud_mname'])."', teach_xname='".$_POST['stud_xname']."', teach_gender='".$_POST['stud_gender']."', teach_bdate='".$_POST['stud_bdate']."', teach_residence='".$_POST['stud_residence']."', teach_tin='".$_POST['teach_tin']."', teach_dialect='".$_POST['teach_dialect']."', teach_ethnicity='".$_POST['teach_ethnicity']."', teach_cstatus='".$_POST['teach_cstatus']."', teach_lastmod_user_no='".$_SESSION["userid"]."', teach_lastmoddatetime=NOW() WHERE teach_no='".$_POST['teach_no']."'");	
	$result2 = dbquery("SELECT * FROM teacher WHERE teach_no='".$_POST['teach_no']."'");
	$data1 = dbarray($result2);
	$fullname = strtoupper($_POST['stud_fname']." ".($_POST['stud_mname']=="-"?"-":substr($_POST['stud_mname'],0,1)).". ".$_POST['stud_lname'].($_POST['stud_xname']!=""?", ".$_POST['stud_xname']:""));
	$updateUser = dbquery("update users set user_fullname='".$fullname."' where user_no='".$_POST['teach_no']."'");
	header("Location: ./?page=teacher&showProfile=".$data1['teach_no']."&tab=info");
}

if(isset($_GET['saveResidence']) && $_GET['saveResidence']=="Yes"){
	$result1 = dbquery("INSERT INTO dropdowns (field_no, field_category, field_name) VALUES ('','RESIDENCE','".strtoupper($_POST['residence'])."')");
	header("Location: ".$_SERVER['HTTP_REFERER']);
	
}

if(isset($_GET['deleteLog']) && $_GET['deleteLog']=="Yes"){
	$result1 = dbquery("delete from checkinout where (USERID='".$_GET['teach_no']."' and CHECKTIME='".$_GET['checktime']."' and CHECKTYPE='".$_GET['checktype']."' )");
	header("Location: ".$_SERVER['HTTP_REFERER']);
	
}

if(isset($_GET['deleteUser']) && $_GET['deleteUser']=="Yes"){
	$result1 = dbquery("delete from teacher where teach_no='".$_GET['teach_no']."'");
	$result1 = dbquery("delete from teachercontacts where teachCont_teach_no='".$_GET['teach_no']."'");
	$result1 = dbquery("delete from users where user_no='".$_GET['teach_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
	
}

?>