<?php
require('maincore.php');

$checkAnec = dbquery("SELECT * FROM  `anecdotal` WHERE  `anec_desc` LIKE  '-'");
while($dataAnec = dbarray($checkAnec)){
	$updateStud = dbquery("update student set stud_credentials='".$dataAnec['anec_details']."' where stud_no='".$dataAnec['anec_stud_no']."'");
	echo "success";
}

?>