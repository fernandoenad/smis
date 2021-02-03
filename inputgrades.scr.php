<?php
require('maincore.php');
session_start();

if(isset($_GET['UpdateGrades']) && $_GET['UpdateGrades']=="Yes"){
	$grade_no = $_POST['grade_no'];
	$grade_q1 = $_POST['grade_q1'];
	$grade_q2 = $_POST['grade_q2'];
	$grade_q3 = $_POST['grade_q3'];
	$grade_q4 = $_POST['grade_q4'];
	//$grade_final = $_POST['grade_final'];
	//$grade_remarks = $_POST['grade_remarks'];
	$count_grade_no = count($_POST['grade_no']);
	for($i=0; $i<$count_grade_no; $i++){
		$_no = mysqli_real_escape_string($conn, $grade_no[$i]);
		$_q1 = mysqli_real_escape_string($conn, $grade_q1[$i]);
		$_q2 = mysqli_real_escape_string($conn, $grade_q2[$i]);
		$_q3 = mysqli_real_escape_string($conn, $grade_q3[$i]);
		$_q4 = mysqli_real_escape_string($conn, $grade_q4[$i]);
		//$_final = mysql_escape_string($grade_final[$i]);
		//$_remarks = mysql_escape_string($grade_remarks[$i]);
		$result1 = dbquery("UPDATE grade SET grade_q1='".$_q1."', grade_q2='".$_q2."', grade_q3='".$_q3."', grade_q4='".$_q4."' WHERE grade_no='".$_no."'");	
	
		$ctr=0;
		$sumGrade=0;
		if($_q1>=60){
			$sumGrade = $sumGrade + $_q1;
			$ctr++;
		}
		if($_q2>=60){
			$sumGrade = $sumGrade + $_q2;
			$ctr++;
		}
		if($_q3>=60){
			$sumGrade = $sumGrade + $_q3;
			$ctr++;
		}
		if($_q4>=60){
			$sumGrade = $sumGrade + $_q4;
			$ctr++;
		}
		if($ctr>0){
			$_final = $sumGrade/$ctr;	
			$_remarks = (round($_final,0)<74.5?0:1);
		}
		else{
			$_final = "";	
			$_remarks = 0;
		}
		
		$result1 = dbquery("UPDATE grade SET grade_final='".$_final."', grade_remarks='".$_remarks."', grade_lastuser_no='".$_SESSION["userid"]."', grade_lastupdated=NOW() WHERE grade_no='".$_no."'");	
	}
	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['UpdateStudentGrades']) && $_GET['UpdateStudentGrades']=="Yes"){
	$grade_no = $_POST['grade_no'];
	$grade_q1 = $_POST['grade_q1'];
	$grade_q2 = $_POST['grade_q2'];
	$grade_q3 = $_POST['grade_q3'];
	$grade_q4 = $_POST['grade_q4'];
	//$grade_final = $_POST['grade_final'];
	//$grade_remarks = $_POST['grade_remarks'];
		$_no = mysqli_real_escape_string($conn, $grade_no);
		$_q1 = mysqli_real_escape_string($conn,$grade_q1);
		$_q2 = mysqli_real_escape_string($conn,$grade_q2);
		$_q3 = mysqli_real_escape_string($conn,$grade_q3);
		$_q4 = mysqli_real_escape_string($conn,$grade_q4);
		//$_final = mysql_escape_string($grade_final);
		//$_remarks = mysql_escape_string($grade_remarks);
		$result1 = dbquery("UPDATE grade SET grade_q1='".$_q1."', grade_q2='".$_q2."', grade_q3='".$_q3."', grade_q4='".$_q4."', grade_final='".$_final."', grade_remarks='".$_remarks."' WHERE grade_no='".$_no."'");	

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
		$_remarks = (round($_final)<74.5?0:1);
	}
	else{
		$_final = "";	
		$_remarks = 0;
	}
	
		$result1 = dbquery("UPDATE grade SET grade_final='".$_final."', grade_remarks='".$_remarks."', grade_lastuser_no='".$_SESSION["userid"]."', grade_lastupdated=NOW() WHERE grade_no='".$_no."'");	
	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['UpdateRemedialGrades']) && $_GET['UpdateRemedialGrades']=="Yes"){
	$grade_no = $_POST['grade_no'];
	$grade_remedialgrade = $_POST['grade_remedialgrade'];
	$grade_recomputedfinalgrade = $_POST['grade_recomputedfinalgrade'];
	$grade_finalremarks = $_POST['grade_finalremarks'];
	$grade_notes = $_POST['grade_notes1']." From:".$_POST['grade_notes2']." To:".$_POST['grade_notes3'];

	$result1 = dbquery("UPDATE grade SET grade_remedialgrade='".$grade_remedialgrade."', grade_recomputedfinalgrade='".$grade_recomputedfinalgrade."', grade_finalremarks='".$grade_finalremarks."', grade_notes='".$grade_notes."' WHERE grade_no='".$grade_no."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

?>