<?php
session_start();
require('maincore.php');

if(isset($_GET['NewApp']) && $_GET['NewApp']=="Yes"){
	$NewApp = dbquery("insert into missinglogs (ml_no, ml_userid, ml_checkdate, ml_checktime, ml_checktype, ml_reason, ml_apply_user_no, ml_apply_regdatetime) values ('','".$_POST['USERID']."','".$_POST['dateapp']."','".$_POST['timeapp']."','".$_POST['CHECKTYPE']."','".$_POST['reason']."','".$_SESSION["userid"]."',NOW())");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['changeState']) && $_GET['changeState']=="Yes"){
	$toState = ($_GET['state']=="In"?"I":"O");
	$NewApp = dbquery("update checkinout set CHECKTYPE='".$toState."' where (USERID='".$_GET['userid']."' and CHECKTIME='".$_GET['checktime']."' and CHECKTYPE='".$_GET['checktype']."')");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['deleteApp']) && $_GET['deleteApp']=="Yes"){
	$NewApp = dbquery("delete from missinglogs where ml_no='".$_GET['ml_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['approve']) && $_GET['approve']=="Yes"){
	$reason = $_POST['ml_reason']." / ".($_POST['action']=="approve"?"<font color=blue>APPROVED</font>":"<font color=red>DISAPPROVED</font>");
	if($_POST['action']=="approve"){
		$NewApp = dbquery("update missinglogs set ml_approve_user_no='".$_SESSION["userid"]."', ml_approve_regdatetime=NOW(), ml_reason='$reason' where ml_no='".$_POST['ml_no']."'");
		$checkML = dbquery("select * from missinglogs where ml_no='".$_POST['ml_no']."'");
		$dataML = dbarray($checkML);
		 $CHECKTIME = $dataML['ml_checkdate']." ".$dataML['ml_checktime'];
		$insertLog = dbquery("insert into checkinout (USERID,CHECKTIME,CHECKTYPE) values('".$dataML['ml_userid']."','$CHECKTIME','".$dataML['ml_checktype']."')");
	}
	else{
		$NewApp = dbquery("update missinglogs set ml_approve_user_no='-".$_SESSION["userid"]."', ml_approve_regdatetime=NOW(), ml_reason='$reason' where ml_no='".$_POST['ml_no']."'");
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
	
}

if(isset($_GET['MassApprove']) && $_GET['MassApprove']=="Yes"){
	$approveItems = $_POST['approve'];
	for($i=0; $i<sizeof($approveItems);$i++){
		$NewApp = dbquery("update missinglogs set ml_approve_user_no='".$_SESSION["userid"]."', ml_approve_regdatetime=NOW(), ml_reason='via Mass Approval' where ml_no='".$approveItems[$i]."'");
		$checkML = dbquery("select * from missinglogs where ml_no='".$approveItems[$i]."'");
		$dataML = dbarray($checkML);
		$CHECKTIME = $dataML['ml_checkdate']." ".$dataML['ml_checktime'];
		$insertLog = dbquery("insert into checkinout (USERID,CHECKTIME,CHECKTYPE) values('".$dataML['ml_userid']."','$CHECKTIME','".$dataML['ml_checktype']."')");
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
	
}

if(isset($_GET['MassDisapprove']) && $_GET['MassDisapprove']=="Yes"){
	$approveItems = $_POST['approve'];
	for($i=0; $i<sizeof($approveItems);$i++){
		$reason = "<font color=red>DISAPPROVED</font> via Mass Disapprove";
		$NewApp = dbquery("update missinglogs set ml_approve_user_no='-".$_SESSION["userid"]."', ml_approve_regdatetime=NOW(), ml_reason='$reason' where ml_no='".$approveItems[$i]."'");
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
	
}

if(isset($_GET['MassDelete']) && $_GET['MassDelete']=="Yes"){
	$approveItems = $_POST['approve'];
	for($i=0; $i<sizeof($approveItems);$i++){
		$NewApp = dbquery("delete from missinglogs where ml_no='".$approveItems[$i]."'");
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
	
}
?>
