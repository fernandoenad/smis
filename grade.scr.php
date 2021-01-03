<?php
require('maincore.php');


if(isset($_GET['deleteGrade']) && $_GET['deleteGrade']=="Yes"){
	$result1 = dbquery("DELETE FROM grade WHERE grade_no='".$_GET['grade_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['NewGrade']) && $_GET['NewGrade']=="Yes"){
	$resultInsertGrade = dbquery("INSERT INTO grade (grade_no, grade_sy, grade_class_no, grade_stud_no) VALUES ('','".$current_sy."','".$_POST['class_no']."','".$_POST['stud_no']."')");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>