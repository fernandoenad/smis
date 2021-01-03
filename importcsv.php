<?php
session_start();
require ('maincore.php');
$file = "backupdb/checkinout.csv";
$handle = fopen($file, "r");
for($i=0; $row=fgetcsv($handle); ++$i){
	$checkTeacher = dbquery("SELECT teach_bio_no FROM teacher WHERE teach_no='".$row[0]."'");
	$dataTeacher = dbarray($checkTeacher);
	$insertCheckInOut = dbquery("INSERT INTO checkinout(USERID,CHECKTIME,CHECKTYPE,VERIFYCODE,SENDORID,Memoinfo,WorkCode,sn,UserExtFmt) VALUES('".$dataTeacher['teach_bio_no']."', '".$row[1]."', '".$row[2]."', '0', '0', '', '0', '0', '0')");
}
fclose($handle);
unlink($file);
header("Location: ".$_SERVER['HTTP_REFERER']);
?>