<?php
require('../maincore.php');
$updateStudEnroll1 = dbquery("ALTER TABLE  `studenroll` CHANGE  `enrol_school`  `enrol_school` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");
$checkSchoolEntries = dbquery("select * from studenroll");
while($dataSchoolEntries = dbarray($checkSchoolEntries)){
	$SchoolDetails = array("000000",$dataSchoolEntries['enrol_school'],"-");
	$SchoolDetails_string = mysql_escape_string(serialize($SchoolDetails));
	$updateSchool = dbquery("update studenroll set enrol_school='".$SchoolDetails_string."' where enrol_no='".$dataSchoolEntries['enrol_no']."'");
}

header("Location: ".$_SERVER['HTTP_REFERER']."&installed=dbu_enr_tbl");

?>


