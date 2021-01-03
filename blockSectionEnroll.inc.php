<?php
require('maincore.php');
$checkStudent = dbquery("SELECT * FROM student INNNER JOIN studenroll ON stud_no=enrol_stud_no  WHERE (stud_no='".$_GET['stud_no']."' AND enrol_sy='".$current_sy."')");
$dataStudent = dbarray($checkStudent);
$resultCheckClass = dbquery("SELECT * FROM section WHERE (section_name='".$dataStudent['enrol_section']."' AND section_sy='".$current_sy."')");
$dataCheckClass = dbarray($resultCheckClass);
$resultPros = dbquery("SELECT * FROM class WHERE (class_sy='".$current_sy."' AND class_section_no='".$dataCheckClass['section_no']."')");
while($dataPros = dbarray($resultPros)){
	$resultEnroll = dbquery("INSERT INTO grade (grade_no, grade_sy, grade_class_no, grade_stud_no) VALUES ('','".$current_sy."','".$dataPros['class_no']."','".$_GET['stud_no']."')");
}	

header("Location: ".$_SERVER['HTTP_REFERER']);
?>