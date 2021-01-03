<?php
session_start();
require('maincore.php');
if(isset($_GET['assess']) && $_GET['assess']=="Yes"){
	$checkAssessment = dbquery("SELECT * FROM bill_bills WHERE bill_sy='".$current_sy."'");
	while ($dataAssessment = dbarray($checkAssessment)){
		$insertAssessment = dbquery("INSERT INTO bill_assessment (ass_no, ass_bill_no, ass_sy, ass_stud_no, ass_amount, ass_remarks) VALUES ('', '".$dataAssessment['bill_no']."', '".$current_sy."', '".$_GET['stud_no']."', '".$dataAssessment['bill_amount']."', 'c/o ".$current_user ."')");
	
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['Recycle']) && $_GET['Recycle']=="Yes"){
	$recycle_sy = $current_sy-1;
	$checkAssessment = dbquery("SELECT * FROM bill_bills WHERE bill_sy='".$recycle_sy."'");
	while ($dataAssessment = dbarray($checkAssessment)){
		$insertAssessment = dbquery("INSERT INTO bill_bills (bill_no, bill_category, bill_sy, bill_desc, bill_amount, bill_prio) VALUES ('', '".$dataAssessment['bill_category']."', '".$current_sy."', '".$dataAssessment['bill_desc']."', '".$dataAssessment['bill_amount']."', '".$dataAssessment['bill_prio']."')");
	
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['MassAssess']) && $_GET['MassAssess']=="Yes"){
	$checkUnAssessed = dbquery("SELECT * FROM studenroll WHERE (enrol_sy='".$current_sy."' AND enrol_section!='' AND enrol_stud_no NOT IN (SELECT (ass_stud_no) FROM bill_assessment where ass_sy='".$current_sy."'))");
	while($dataUnAssessed = dbarray($checkUnAssessed)){
		$checkAssessment = dbquery("SELECT * FROM bill_bills WHERE bill_sy='".$current_sy."'");
		while ($dataAssessment = dbarray($checkAssessment)){
			$insertAssessment = dbquery("INSERT INTO bill_assessment (ass_no, ass_bill_no, ass_sy, ass_stud_no, ass_amount, ass_remarks) VALUES ('', '".$dataAssessment['bill_no']."', '".$current_sy."', '".$dataUnAssessed['enrol_stud_no']."', '".$dataAssessment['bill_amount']."', 'c/o ".$current_user ."')");
		
		}
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['BillAssess']) && $_GET['BillAssess']=="Yes"){
	$checkUnAssessed = dbquery("SELECT * FROM studenroll WHERE (enrol_sy='".$current_sy."' AND enrol_section!='' AND enrol_stud_no NOT IN (SELECT (ass_stud_no) FROM bill_assessment where ass_bill_no='".$_GET['bill_no']."'))");
	while($dataUnAssessed = dbarray($checkUnAssessed)){
		$checkAssessment = dbquery("SELECT * FROM bill_bills WHERE bill_no='".$_GET['bill_no']."'");
		while ($dataAssessment = dbarray($checkAssessment)){
			$insertAssessment = dbquery("INSERT INTO bill_assessment (ass_no, ass_bill_no, ass_sy, ass_stud_no, ass_amount, ass_remarks) VALUES ('', '".$dataAssessment['bill_no']."', '".$current_sy."', '".$dataUnAssessed['enrol_stud_no']."', '".$dataAssessment['bill_amount']."', 'c/o ".$current_user ."')");
		
		}
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

?>