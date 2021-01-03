<?php
session_start();
require ('maincore.php');

if(isset($_GET['save']) && $_GET['save']="Yes"){
	$updateSALN = dbquery("update teachsaln set teachSaln_networth='".$_POST['teachSaln_networth']."', teachSaln_status='3', teachSaln_moduser='".$_SESSION["userid"]."', teachSaln_moddatetime=NOW() where teachSaln_no='".$_POST['teachSaln_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']."&done=yes");
}

if(isset($_GET['deleteCont']) && $_GET['deleteCont']="yes"){
	$updateSALN = dbquery("delete from teachercontacts where teachCont_no='".$_GET['id']."'");
	$updateSALN = dbquery("update teachsaln set teachSaln_status='2', teachSaln_moduser='".$_SESSION["userid"]."', teachSaln_moddatetime=NOW() where teachSaln_no='".$_GET['edit']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['deleteSALN']) && $_GET['deleteSALN']="yes"){
	$updateSALN = dbquery("delete from  teachsalndetails where teachSalnDet_no='".$_GET['id']."'");
	$updateSALN = dbquery("update teachsaln set teachSaln_status='2', teachSaln_moduser='".$_SESSION["userid"]."', teachSaln_moddatetime=NOW() where teachSaln_no='".$_GET['edit']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['resetSALN']) && $_GET['resetSALN']="yes"){
	$updateSALN = dbquery("update teachsaln set teachSaln_status='2', teachSaln_networth='0.00', teachSaln_moduser='".$_SESSION["userid"]."', teachSaln_moddatetime=NOW() where teachSaln_no='".$_GET['edit']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['editFileType']) && $_GET['editFileType']="yes"){
	$updateSALN = dbquery("update teachsaln set teachSaln_status='2', teachSaln_filetype='".$_GET['value']."', teachSaln_moduser='".$_SESSION["userid"]."', teachSaln_moddatetime=NOW() where teachSaln_no='".$_GET['edit']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['recycleSALN']) && $_GET['recycleSALN']="yes"){
	$checkSALN=dbquery("select * from teachsaln where teachSaln_no='".$_GET['saln_no']."'");
	$dataSALN=dbarray($checkSALN);
	$insertSALN=dbquery("insert into teachsaln(teachSaln_no,teachSaln_teach_no,teachSaln_filetype,teachSaln_issueyear,teachSaln_status,teachSaln_reguser,teachSaln_regdatetime,teachSaln_moduser,teachSaln_moddatetime) values ('','".$dataSALN['teachSaln_teach_no']."','".$dataSALN['teachSaln_filetype']."','".$_GET['year']."','2','".$dataSALN['teachSaln_teach_no']."',NOW(),'".$dataSALN['teachSaln_teach_no']."',NOW())");
	$checkSALNno=dbquery("select teachSaln_no from teachsaln where teachSaln_teach_no='".$dataSALN['teachSaln_teach_no']."' and teachSaln_issueyear='".$_GET['year']."'");
	$dataSALNno=dbarray($checkSALNno);
	$checkSALNdet=dbquery("select * from  teachsalndetails where teachSalnDet_teachSaln_no='".$_GET['saln_no']."'");
	while($dataSALNdet=dbarray($checkSALNdet)){
		$inserNewSALNdet=dbquery("insert into teachsalndetails(teachSalnDet_no,teachSalnDet_teachSaln_no,teachSalnDet_type,teachSalnDet_details,teachSalnDet_cost) values('','".$dataSALNno['teachSaln_no']."','".$dataSALNdet['teachSalnDet_type']."','".$dataSALNdet['teachSalnDet_details']."','".$dataSALNdet['teachSalnDet_cost']."')");
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
	

?>