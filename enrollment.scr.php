<?php
session_start();
require('maincore.php');

if(isset($_GET['UpdateHistoryEnroll']) && $_GET['UpdateHistoryEnroll']=="Yes"){
	$schoolDetails = array($_POST['enrol_school_id'],$_POST['enrol_school_name'],$_POST['enrol_school_address']);
	$schoolDetails_string = mysqli_real_escape_string($conn, serialize($schoolDetails));
	$result1 = dbquery("UPDATE studenroll SET enrol_sy='".$_POST['enrol_sy']."', enrol_school='".$schoolDetails_string."', enrol_level='".$_POST['enrol_level']."', enrol_section='".$_POST['enrol_section']."', enrol_status1='".$_POST['enrol_status1']."', enrol_status2='".$_POST['enrol_status2']."', enrol_schoolyears='".$_POST['enrol_schoolyears']."', enrol_remarks='".$_POST['enrol_remarks']."', enrol_average='".$_POST['enrol_average']."', enrol_eligibility='".$_POST['enrol_eligibility']."', enrol_graddate='".$_POST['enrol_graddate']."', enrol_username='".$_SESSION["userid"]."', enrol_updatedate=NOW(), enrol_track='".$_POST['enrol_track']."', enrol_strand='".$_POST['enrol_strand']."', enrol_combo='".$_POST['enrol_combo']."', enrol_schoolyears='".$_POST['enrol_schoolyears']."' WHERE enrol_no='".$_POST['enrol_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['saveEnrolHist']) && $_GET['saveEnrolHist']=="Yes"){
	$schoolDetails = array($_POST['enrol_school_id'],$_POST['enrol_school_name'],$_POST['enrol_school_address']);
	$schoolDetails_string = mysqli_real_escape_string($conn, serialize($schoolDetails));
	$result1 = dbquery("INSERT INTO studenroll (enrol_no, enrol_stud_no, enrol_sy, enrol_school, enrol_level, enrol_section, enrol_height, enrol_weight, enrol_status1, enrol_status2, enrol_remarks, enrol_average, enrol_eligibility, enrol_graddate, enrol_admitdate, enrol_username, enrol_updatedate, enrol_track, enrol_strand, enrol_combo, enrol_schoolyears) VALUES ('','".$_POST['enrol_stud_no']."','".$_POST['enrol_sy']."','".$schoolDetails_string."','".$_POST['enrol_level']."','".$_POST['enrol_section']."','".$_POST['enrol_height']."','".$_POST['enrol_weight']."','".$_POST['enrol_status1']."','".$_POST['enrol_status2']."','".$_POST['enrol_remarks']."','".$_POST['enrol_average']."','".$_POST['enrol_eligibility']."','".$_POST['enrol_graddate']."',NOW(),'".$_SESSION["userid"]."',NOW(), '".$_POST['enrol_track']."', '".$_POST['enrol_strand']."', '".$_POST['enrol_combo']."','".$_POST['enrol_schoolyears']."')");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['UpdateEnroll']) && $_GET['UpdateEnroll']=="Yes"){
	$schoolDetails = array($current_school_code,$current_school_full,$current_school_address);
	$schoolDetails_string = mysqli_real_escape_string($conn, serialize($schoolDetails));
	$resultSY = dbquery("SELECT * FROM studenroll WHERE enrol_no='".$_POST['enrol_no']."'");
	$dataSY = dbarray($resultSY);
	$current_section = $dataSY['enrol_section'];
	if($_POST['enrol_level']==10){
		$enrol_eligibility = "Junior High School Completer";
		
	}
	$result1 = dbquery("UPDATE studenroll SET enrol_school='".$schoolDetails_string."', enrol_schoolyears='".$_POST['enrol_schoolyears']."', enrol_level='".$_POST['enrol_level']."', enrol_section='".$_POST['enrol_section']."', enrol_height='".$_POST['enrol_height']."', enrol_weight='".$_POST['enrol_weight']."', enrol_status1='".$_POST['enrol_status1']."', enrol_status2='".$_POST['enrol_status2']."', enrol_remarks='".$_POST['enrol_remarks']."', enrol_average='".$_POST['enrol_average']."', enrol_username='".$_SESSION["userid"] ."',enrol_updatedate=NOW(), enrol_gradawards='".$_POST['enrol_gradawards']."', enrol_graddate='".$_POST['enrol_graddate']."', enrol_eligibility='".$enrol_eligibility."', enrol_track='".$_POST['enrol_track']."', enrol_strand='".$_POST['enrol_strand']."', enrol_combo='".$_POST['enrol_combo']."'  WHERE enrol_no='".$_POST['enrol_no']."'");	
	
	if($current_section!=$_POST['enrol_section']){
		$resultUnenroll = dbquery("DELETE FROM grade WHERE (grade_stud_no='".$_POST['enrol_stud_no']."' AND grade_sy='".$dataSY['enrol_sy']."')");

		$resultCheckClass = dbquery("SELECT * FROM section WHERE (section_name='".$_POST['enrol_section']."' AND section_sy='".$current_sy."')");
		$dataCheckClass = dbarray($resultCheckClass);
		$resultPros = dbquery("SELECT * FROM class WHERE (class_sy='".$current_sy."' AND class_section_no='".$dataCheckClass['section_no']."')");
		while($dataPros = dbarray($resultPros)){
			$cur_sem = ($_POST['enrol_level']>10?$current_sem:12);
			$resultEnroll = dbquery("INSERT INTO grade (grade_no, grade_sy, grade_sem, grade_class_no, grade_stud_no) VALUES ('','".$current_sy."','".$cur_sem."','".$dataPros['class_no']."','".$_POST['enrol_stud_no']."')");
		}	
	}

	header("Location: ".$_SERVER['HTTP_REFERER']);
}


if(isset($_GET['Enroll']) && $_GET['Enroll']=="Yes"){
	$schoolDetails = array($current_school_code,$current_school_full,$current_school_address);
	$schoolDetails_string = mysqli_real_escape_string($conn, serialize($schoolDetails));
	$result1 = dbquery("INSERT INTO studenroll (enrol_no, enrol_stud_no, enrol_sy, enrol_school, enrol_level, enrol_section, enrol_height, enrol_weight, enrol_status1, enrol_status2, enrol_remarks, enrol_average, enrol_admitdate, enrol_username, enrol_updatedate, enrol_track, enrol_strand, enrol_combo, enrol_schoolyears, enrol_ti) VALUES ('','".$_POST['enrol_stud_no']."','".$current_sy."','".$schoolDetails_string."','".$_POST['enrol_level']."','".$_POST['enrol_section']."','".$_POST['enrol_height']."','".$_POST['enrol_weight']."','".$_POST['enrol_status1']."','".$_POST['enrol_status2']."','".$_POST['enrol_remarks']."','".$_POST['enrol_average']."',NOW(),'".$_SESSION["userid"]."',NOW(),'".$_POST['enrol_track']."', '".$_POST['enrol_strand']."', '".$_POST['enrol_combo']."', '".$_POST['enrol_schoolyears']."', '".$_POST['ti_status']."')");	
	if(!$result1){
		echo mysql_error();
	}
	$resultCheckClass = dbquery("SELECT * FROM section WHERE (section_name='".$_POST['enrol_section']."' AND section_sy='".$current_sy."')");
	if(!$resultCheckClass){
		echo mysql_error();
	}
	$dataCheckClass = dbarray($resultCheckClass);
	// echo $dataCheckClass['section_no'];
	$cur_sem = ($_POST['enrol_level']>10?$current_sem:12);
	$resultPros = dbquery("SELECT * FROM class inner join prospectus on class_pros_no=pros_no WHERE (class_sy='".$current_sy."' and class_sem='".$cur_sem."' AND class_section_no='".$dataCheckClass['section_no']."')");
	if(!$resultPros){
			echo mysql_error();
	}
	while($dataPros = dbarray($resultPros)){
		//echo $dataPros['class_pros_no'];
		$resultEnroll = dbquery("INSERT INTO grade (grade_no, grade_sy, grade_sem, grade_class_no, grade_stud_no) VALUES ('','".$current_sy."','".$cur_sem."','".$dataPros['class_no']."','".$_POST['enrol_stud_no']."')");
		if(!$resultEnroll){
			echo mysql_error();
		}
	}

	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['UnEnroll']) && $_GET['UnEnroll']=="Yes"){
	$resultSY = dbquery("SELECT * FROM studenroll WHERE enrol_no='".$_POST['enrol_no']."'");
	$dataSY = dbarray($resultSY);

	$result1 = dbquery("DELETE FROM studenroll WHERE enrol_no='".$_POST['enrol_no']."'");
	$resultUnenroll = dbquery("DELETE FROM grade WHERE (grade_stud_no='".$_POST['enrol_stud_no']."' AND grade_sy='".$dataSY['enrol_sy']."')");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['Reset']) && $_GET['Reset']=="Yes"){
	$result1 = dbquery("UPDATE studenroll SET enrol_status1='ENROLLED', enrol_status2='REGULAR', enrol_average='', enrol_username='".$_SESSION["userid"] ."',enrol_updatedate=NOW(), enrol_gradawards='', enrol_graddate='' WHERE enrol_no='".$_GET['enrol_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>