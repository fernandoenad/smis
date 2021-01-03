<?php
require('maincore.php');

if(isset($_GET['Delete']) && $_GET['Delete']="Yes"){
	$deletePros = dbquery("DELETE FROM prospectus WHERE pros_no='".$_GET['No']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['Update']) && $_GET['Update']="Yes"){
	$updatePros = dbquery("UPDATE prospectus SET pros_title='".$_POST['code']."', pros_desc='".$_POST['title']."', pros_cutoff='".$_POST['cutoff']."', pros_prereq='".$_POST['prereq']."', pros_unit='".$_POST['unit']."', pros_hoursPerWk='".$_POST['hours']."', pros_level='".$_POST['level']."', pros_sem='".$_POST['term']."', pros_sort='".$_POST['sort']."', pros_track='".$_POST['track']."', pros_part='".$_POST['part']."' WHERE pros_no='".$_POST['no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['Add']) && $_GET['Add']="Yes"){
	$addPros = dbquery("INSERT INTO prospectus (pros_no, pros_level, pros_track, pros_title, pros_desc, pros_cutoff, pros_prereq, pros_unit, pros_hoursPerWk, pros_curr, pros_sem, pros_sort, pros_part) VALUES ('', '".$_POST['level']."', '".$_POST['track']."', '".$_POST['code']."', '".$_POST['title']."', '".$_POST['cutoff']."', '".$_POST['prereq']."', '".$_POST['unit']."', '".$_POST['hours']."', '".$_POST['curr']."', '".$_POST['term']."', '".$_POST['sort']."','0')");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>