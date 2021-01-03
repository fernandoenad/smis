<?php
session_start();
require('maincore.php');

if(isset($_GET['SaveGradeHist']) && $_GET['SaveGradeHist']=="Yes"){
	$resultClassSection = dbquery("SELECT * FROM section WHERE (section_level='".$_GET['enrol_level']."') LIMIT 1");
	$dataClassSection = dbarray($resultClassSection);
	
	$resultClassEnroll = dbquery("SELECT * FROM class WHERE (class_sy='".$_GET['enrol_sy']."' AND class_section_no='". $dataClassSection['section_no']."')");
	while ($dataClassEnroll = dbarray($resultClassEnroll)){
		$resultGradeEnroll = dbquery("INSERT INTO grade (grade_no, grade_sy, grade_class_no, grade_stud_no) VALUES ('','".$_GET['enrol_sy']."','".$dataClassEnroll['class_no']."','".$_GET['enrol_stud_no']."')");
	}

	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['SaveGradeHistTI']) && $_GET['SaveGradeHistTI']=="Yes"){
	$resultClassSection = dbquery("SELECT * FROM section WHERE (section_level='".$_GET['enrol_level']."') LIMIT 1");
	$dataClassSection = dbarray($resultClassSection);
	
	$resultClassEnroll = dbquery("SELECT * FROM class WHERE (class_sy='".$_GET['enrol_sy']."' AND class_section_no='". $dataClassSection['section_no']."')");
	while ($dataClassEnroll = dbarray($resultClassEnroll)){
		$resultGradeEnroll = dbquery("INSERT INTO grade (grade_no, grade_sy, grade_class_no, grade_stud_no) VALUES ('','".$_GET['enrol_sy']."','".$dataClassEnroll['class_no']."','".$_GET['enrol_stud_no']."')");
	}

	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['DeleteGradeHist']) && $_GET['DeleteGradeHist']=="Yes"){
	$resultClassSection = dbquery("DELETE FROM grade WHERE (grade_sy='".$_GET['enrol_sy']."' AND grade_stud_no='".$_GET['enrol_stud_no']."')");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['UpdateGrades']) && $_GET['UpdateGrades']=="Yes"){
	$grade_no = $_POST['grade_no'];
	$grade_q1 = $_POST['grade_q1'];
	$grade_q2 = $_POST['grade_q2'];
	$grade_q3 = $_POST['grade_q3'];
	$grade_q4 = $_POST['grade_q4'];
	$grade_final = $_POST['grade_final'];
	$grade_remarks = $_POST['grade_remarks'];
	$count_grade_no = count($_POST['grade_no']);
	for($i=0; $i<$count_grade_no; $i++){
		$_no = mysql_escape_string($grade_no[$i]);
		$_q1 = mysql_escape_string($grade_q1[$i]);
		$_q2 = mysql_escape_string($grade_q2[$i]);
		$_q3 = mysql_escape_string($grade_q3[$i]);
		$_q4 = mysql_escape_string($grade_q4[$i]);
		$_final = mysql_escape_string($grade_final[$i]);
		$_remarks = mysql_escape_string($grade_remarks[$i]);
		$result1 = dbquery("UPDATE grade SET grade_q1='".$_q1."', grade_q2='".$_q2."', grade_q3='".$_q3."', grade_q4='".$_q4."', grade_final='".$_final."', grade_remarks='".$_remarks."' WHERE grade_no='".$_no."'");	
	}
	
	$ctr=0;
	$sumGrade=0;
	if($grade_q1>=60){
		$sumGrade = $sumGrade + $grade_q1;
		$ctr++;
	}
	if($grade_q2>=60){
		$sumGrade = $sumGrade + $grade_q2;
		$ctr++;
	}
	if($grade_q3>=60){
		$sumGrade = $sumGrade + $grade_q3;
		$ctr++;
	}
	if($grade_q4>=60){
		$sumGrade = $sumGrade + $grade_q4;
		$ctr++;
	}
	if($ctr>0){
		$_final = $sumGrade/$ctr;	
		$_remarks = ($_final<75?0:1);
	}
	else{
		$_final = "";	
		$_remarks = 0;
	}
	
	$result1 = dbquery("UPDATE grade SET grade_final='".$_final."', grade_remarks='".$_remarks."' WHERE grade_no='".$_no."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

?>
