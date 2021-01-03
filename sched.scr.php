<?php
// Start the session
session_start();
require('maincore.php');

if(isset($_GET['DeleteSched']) && $_GET['DeleteSched']=="Yes"){
	$result1 = dbquery("DELETE FROM class WHERE class_no='".$_GET['class_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['NewSched']) && $_GET['NewSched']=="Yes"){
	$result1 = dbquery("INSERT INTO class (class_no, class_sy, class_sem, class_pros_no,  class_section_no, class_timeslots, class_days, class_room, class_user_name) VALUES ('','".$_POST['class_sy']."', '".$_POST['class_sem']."','".$_POST['class_pros_no']."', '".$_POST['class_section_no']."', '".$_POST['class_timeslots']."', '".$_POST['class_days']."', '".$_POST['class_room']."', '".$_POST['class_user_name']."')");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['UpdateSched']) && $_GET['UpdateSched']=="Yes"){
	$result1 = dbquery("UPDATE class SET class_timeslots='".$_POST['class_timeslots']."', class_days='".$_POST['class_days']."', class_room='".$_POST['class_room']."', class_sem='".$_POST['class_sem']."', class_user_name='".$_POST['class_user_name']."' WHERE class_no='".$_POST['class_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}


if(isset($_GET['MassSched']) && $_GET['MassSched']=="Yes"){		
	$resultSchedule = dbquery("SELECT * FROM section WHERE (section_no='".$_GET['section_no']."' AND section_sy='".$current_sy."')");
	$dataSchedule = dbarray($resultSchedule);
	$checkSem = dbquery("SELECT * FROM settings WHERE settings_sy='".$current_sy."'");
	$dataSem = dbarray($checkSem);
							
	if($dataSchedule['section_level']>10){
		$exclude_sem = ($current_sem==1?2:1);
		$resultPros = dbquery("SELECT * FROM prospectus WHERE (pros_sem!='".$exclude_sem."' AND pros_level='".$dataSchedule['section_level']."' AND pros_curr='".$dataSem['settings_pros']."' and pros_part='1' AND pros_no NOT IN (SELECT class_pros_no FROM class WHERE class_section_no='".$dataSchedule['section_no']."' AND class_sy='".$current_sy."')) ORDER BY pros_sort ASC");
		$class_sem = $dataSem['settings_sem'];
	}
	else{
		$resultPros = dbquery("SELECT * FROM prospectus WHERE (pros_level='".$dataSchedule['section_level']."' AND pros_curr='".$dataSem['settings_pros']."' and pros_part='1' AND pros_no NOT IN (SELECT class_pros_no FROM class WHERE class_section_no='".$dataSchedule['section_no']."' AND class_sy='".$current_sy."')) ORDER BY pros_sort ASC");
		$class_sem = 12;
	}
	
	while($dataPros = dbarray($resultPros)){
	
	if($dataPros['pros_track']=="JHS GENERAL" || $dataPros['pros_track']=="SHS APPLIED" || $dataPros['pros_track']=="SHS GENERAL" || $dataPros['pros_track']==$dataSchedule['section_track']){
		$insertQ= dbquery("insert into class (class_sy, class_sem, class_pros_no, class_section_no, class_timeslots, class_days, class_room, class_user_name) values ('".$current_sy."', '".$class_sem."','".$dataPros['pros_no']."', '".$dataSchedule['section_no']."', '00:00-00:00','MTWThF', '".$dataSchedule['section_name']."', '1')");
		// echo $dataPros['pros_title']."<br>";
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
	
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>