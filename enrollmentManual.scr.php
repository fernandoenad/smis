<?php
require ("maincore.php");						
if(isset($_GET['Enroll']) && $_GET['Enroll']=="Yes"){
	$resultCheckClass = dbquery("SELECT * FROM section WHERE (section_no='".$_GET['section_no']."' AND section_sy='".$current_sy."')");
	$dataCheckClass = dbarray($resultCheckClass);
	
	$resultPros = dbquery("SELECT * FROM class INNER JOIN prospectus ON class_pros_no=pros_no WHERE (class_sy='".$current_sy."' AND class_section_no='".$dataCheckClass['section_no']."' AND class_no='".$_GET['class_no']."')");
	$dataPros = dbarray($resultPros);
	
	$resultStudents = dbquery("SELECT * FROM studenroll WHERE (enrol_section='".$dataCheckClass['section_name']."' AND enrol_sy='".$current_sy."' and enrol_stud_no NOT IN (select grade_stud_no from grade where (grade_sy='".$current_sy."' and grade_class_no='".$_GET['class_no']."')))");
	while($dataStudents = dbarray($resultStudents)){
		$cur_sem = ($dataPros['pros_level']>10?$current_sem:"12");
		$resultEnroll = dbquery("INSERT INTO grade (grade_no, grade_sy, grade_sem, grade_class_no, grade_stud_no) VALUES ('','".$current_sy."', '".$cur_sem."','".$dataPros['class_no']."','".$dataStudents['enrol_stud_no']."')");
	}

	header("Location: ./?page=schedule&enrol_sy=".$current_sy."&classProfile=".$dataCheckClass['section_name']."&section_no=".$dataCheckClass['section_no']);
}
?>