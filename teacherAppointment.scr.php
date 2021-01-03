<?php
// Start the session
session_start();
require('maincore.php');

if(isset($_GET['DeleteAnec']) && $_GET['DeleteAnec']=="Yes"){
	$result0 = dbquery("select * FROM teacherappointments WHERE (teacherappointments_no='".$_GET['anec_no']."')");
	$dresult0 = dbarray($result0);
	$appointmentTeachNo=$dresult0['teacherappointments_teach_no'];	
	$appointmentApp=$dresult0['teacherappointments_item_no'];	
	$result1 = dbquery("DELETE FROM teacherappointments WHERE teacherappointments_no='".$_GET['anec_no']."'");	
	if($appointmentApp=="ANCILLARY"){}
	else {
		$checkRecent = dbquery("select * from teacherappointments where (teacherappointments_teach_no='".$appointmentTeachNo."' and teacherappointments_item_no!='ANCILLARY') order by teacherappointments_date desc");
		$dataRecent = dbarray($checkRecent);
		$appointmentNo = $dataRecent['teacherappointments_no'];		
		$result3 = dbquery("UPDATE teacherappointments SET teacherappointments_active='0' where teacherappointments_teach_no='".$result0['teacherappointments_teach_no']."'");	
		$result4 = dbquery("UPDATE teacherappointments SET teacherappointments_active='1' WHERE teacherappointments_no='".$appointmentNo."'");	
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['NewAnec']) && $_GET['NewAnec']=="Yes"){
	$result1 = dbquery("INSERT INTO teacherappointments(teacherappointments_no, teacherappointments_teach_no, teacherappointments_item_no, teacherappointments_position, teacherappointments_date, teacherappointments_fdaydate, teacherappointments_status, teacherappointments_funding) VALUES ('','".$_POST['anec_stud_no']."','".$_POST['anec_item']."','".$_POST['anec_position']."','".$_POST['anec_date']."', '".$_POST['anec_fdaydate']."', '".$_POST['anec_status']."', '".$_POST['anec_funding']."')");	
	if($_POST['anec_item']=="ANCILLARY"){}
	else {
		$result2 = dbquery("update teacher set teach_teacher='".$_POST['teach_teacher']."' where teach_no='".$_POST['anec_stud_no']."'");
		$checkRecent = dbquery("select * from teacherappointments where (teacherappointments_teach_no='".$_POST['anec_stud_no']."' and teacherappointments_item_no!='ANCILLARY') order by teacherappointments_date desc");
		$dataRecent = dbarray($checkRecent);
		$appointmentNo = $dataRecent['teacherappointments_no'];		
		$result3 = dbquery("UPDATE teacherappointments SET teacherappointments_active='0' where teacherappointments_teach_no='".$_POST['anec_stud_no']."'");	
		$result4 = dbquery("UPDATE teacherappointments SET teacherappointments_active='1' WHERE teacherappointments_no='".$appointmentNo."'");	
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
	
}

if(isset($_GET['UpdateAnec']) && $_GET['UpdateAnec']=="Yes"){
	$result1 = dbquery("UPDATE teacherappointments SET teacherappointments_item_no='".$_POST['anec_item']."', teacherappointments_position='".$_POST['anec_position']."', teacherappointments_date='".$_POST['anec_date']."', teacherappointments_fdaydate='".$_POST['anec_fdaydate']."', teacherappointments_status='".$_POST['anec_status']."', teacherappointments_funding='".$_POST['anec_funding']."' WHERE teacherappointments_no='".$_POST['anec_no']."'");	
	if($_POST['anec_item']=="ANCILLARY"){}
	else {
		$result2 = dbquery("update teacher set teach_teacher='".$_POST['teach_teacher']."' where teach_no='".$_POST['anec_stud_no']."'");	
		$checkRecent = dbquery("select * from teacherappointments where (teacherappointments_teach_no='".$_POST['anec_stud_no']."' and teacherappointments_item_no!='ANCILLARY') order by teacherappointments_date desc");
		$dataRecent = dbarray($checkRecent);
		$appointmentNo = $dataRecent['teacherappointments_no'];		
		$result3 = dbquery("UPDATE teacherappointments SET teacherappointments_active='0' where teacherappointments_teach_no='".$_POST['anec_stud_no']."'");	
		$result4 = dbquery("UPDATE teacherappointments SET teacherappointments_active='1' WHERE teacherappointments_no='".$appointmentNo."'");	
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['UpdateActive']) && $_GET['UpdateActive']=="Yes"){
	$result1 = dbquery("UPDATE teacherappointments SET teacherappointments_active='0' where teacherappointments_teach_no='".$_GET['teacherappointments_teach_no']."'");	
	$result2 = dbquery("UPDATE teacherappointments SET teacherappointments_active='".$_GET['value']."' WHERE teacherappointments_no='".$_GET['teacherappointments_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>