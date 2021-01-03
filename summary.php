<?php
require('maincore.php');
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<style>
	table {
	
	}
	
	th{
		height: 12px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.6em;
	} 
	
	td {
		height: 12px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.5em;		
	}
	</style>	
</head>
<?php
$resultTeacher = dbquery("SELECT * FROM section INNER JOIN users ON section.section_adviser=users.user_no WHERE (section_name='".$_GET['classProfile']."' AND section_sy='".$_GET['enrol_sy']."')");
$dataTeacher = dbarray($resultTeacher);
?>
<table border="0" cellspacing="0" cellpadding="1" width="800">
	<tr>
		<td width="10%" align="right"><img src="./assets/images/deped_logo.png" width="50"></td>
		<td align="center" valign="top">
			<h3><?php echo $current_school_name;?><br>Class Summary<br>
			SY: <?php echo $_GET['enrol_sy']; ?>-<?php echo $_GET['enrol_sy']+1; ?> / Section: <?php echo $_GET['classProfile']; ?>
			<br>Adviser: <u><?php echo strtoupper($dataTeacher['user_fullname']); ?></u> </h3>

		</td>
		<td width="10%"><img src="./assets/images/sanhs_logo.png" width="50"></td>
	</tr>
</table>
<table border="1" cellspacing="0" cellpadding="1" width="800">
	<tr>
		<th width="1%">#</th>
		<th width="25%">NAME</th>
		<th>Previous School</th>
		<th width="20%">Notes</th>
		<th width="10%">Status</th>
		<th width="20%">Remarks</th>
	</tr>
	<?php
	$i=1;
	$MLEi=0;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no INNER JOIN studcontacts ON student.stud_no=studCont_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='MALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="20">
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
		<td>
		<?php 
		
		$resultRemarks = dbquery("SELECT * FROM studenroll WHERE enrol_stud_no='".$data['stud_no']."' ORDER BY enrol_sy DESC");
		$count = 1;
		while($dataRemarks = dbarray($resultRemarks)){
			$dataEnrollmentSchool = unserialize($dataRemarks['enrol_school']);
			if($count==2)
				echo strtoupper($dataEnrollmentSchool['1']);
			$count++;
		}
		?>
		</td>
		<td><?php echo strtoupper($data['enrol_remarks']);?>
		
		
		</td>
		<td align="center"><?php echo ($data['enrol_status2']=="IRREGULAR"?"CONDITIONAL":strtoupper($data['enrol_status2']));?></td>
		<td></td>
	</tr>
	<?php 
	$i++;
	} ?>
	<tr height="20">
		<td>#</td>
		<td>#</td>
		<td>#</td>
		<td>#</td>
		<td>#</td>
		<td>#</td>
	</tr>	
	<?php
	$i=1;
	$FLEi=0;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no INNER JOIN studcontacts ON student.stud_no=studCont_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='FEMALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="20">
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
		<td>
		<?php 
		
		$resultRemarks = dbquery("SELECT * FROM studenroll WHERE enrol_stud_no='".$data['stud_no']."' ORDER BY enrol_sy DESC");
		$count = 1;
		while($dataRemarks = dbarray($resultRemarks)){
			$dataEnrollmentSchool = unserialize($dataRemarks['enrol_school']);
			if($count==2)
				echo strtoupper($dataEnrollmentSchool['1']);
			$count++;
		}
		?>
		</td>
		<td><?php echo strtoupper($data['enrol_remarks']);?></td>
		<td align="center"><?php echo ($data['enrol_status2']=="IRREGULAR"?"CONDITIONAL":strtoupper($data['enrol_status2']));?></td>
		<td></td>
	</tr>
	<?php 
	$i++;
	} ?>
</table><br>

<table width="250" border="1" cellpadding="0" cellspacing="0" align="center">
	<tr height="20"><th colspan="4">SUMMARY TABLE</th></tr>
	<tr height="30"><th width="10%">STATUS</th><th width="6%">MALE</th><th width="5%">FEMALE</th><th width="5%">TOTAL</th></tr>
		<?php
		$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' or studenroll.enrol_status2='GRADUATED') AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
		$rowCountSYM = dbrows($resultCountSYM);
		$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' or studenroll.enrol_status2='GRADUATED')  AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
		$rowCountSYF = dbrows($resultCountSYF);	
		?>
	<tr height="30" align="center"><th>PROMOTED</th><td><font size="2"><?php echo $rowCountSYM;?></td><td><font size="2"><?php echo $rowCountSYF;?></td><td><font size="2"><?php echo $rowCountSYM+$rowCountSYF; ?></td><tr>
		<?php
		$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
		$rowCountSYM = dbrows($resultCountSYM);
		$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
		$rowCountSYF = dbrows($resultCountSYF);	
		?>
	<tr height="30" align="center"><th>*Conditional</th><td><font size="2"><?php echo $rowCountSYM;?></td><td><font size="2"><?php echo $rowCountSYF;?></td><td><font size="2"><?php echo $rowCountSYM+$rowCountSYF; ?></td><tr>
		<?php
		$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
		$rowCountSYM = dbrows($resultCountSYM);
		$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
		$rowCountSYF = dbrows($resultCountSYF);	
		?>
	<tr height="30" align="center"><th>RETAINED</th><td><font size="2"><?php echo $rowCountSYM;?></td><td><font size="2"><?php echo $rowCountSYF;?></td><td><font size="2"><?php echo $rowCountSYM+$rowCountSYF; ?></td><tr>
</table><br>

<table width="800">
			<?php 
			$checkDetails = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
			$dataDetails = dbarray($checkDetails);
			?>
	<tr>
		<td>Prepared by:<br><br><br><strong><?php echo strtoupper($dataTeacher['user_fullname']); ?></strong><br>Class Adviser</td>
		<td>Noted by:<br><br><br><strong><?php echo strtoupper($dataDetails['settings_registrar']);	?></strong><br>School Registrar</td>
		<td>Attested by:<br><br><br><strong><?php echo strtoupper($dataDetails['settings_principal']);	?></strong><br>School Principal</td>
	</tr>
</table>
