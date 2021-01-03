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
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.6em;
	} 
	
	td {
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.5em;		
	}
	</style>
</head>	
<?php
$resultTeacher = dbquery("SELECT * FROM section INNER JOIN users ON section.section_adviser=users.user_name WHERE section_name='".$_GET['classProfile']."'");
$dataTeacher = dbarray($resultTeacher);
?>
<table border="0" cellspacing="0" cellpadding="0" width="750">
	<tr>
		<td width="60"><img src="./assets/images/sanhs_logo.png" width="50"></td>
		<td align="left" valign="top">
		<strong>San Agustin National High School</strong><br>
		San Agustin, Sagbayan, Bohol
		</td>
	</tr>
</table>	
<h3>Class List for Section <?php echo $_GET['classProfile'];?> / <?php echo $dataTeacher['user_fullname']; ?></h3>
<table border="0" cellspacing="0" cellpadding="0" width="750">
<tr>
<?php
$result= dbquery("SELECT * FROM studenroll INNER JOIN student ON studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='MALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
$rows = dbrows($result);
?>
<td valign="top">Males (<?php echo  $rows; ?>)
<table border="1" cellspacing="0" cellpadding="1" width="100%">
	<tr>
		<th>#</th>
		<th>FULLNAME</th>
		<th>Previous School</th>
	</tr>
	<?php
	$i=1;
	while($data = dbarray($result)){
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname'];?></td>
		<td><?php 
		$resultRemarks = dbquery("SELECT * FROM studenroll WHERE enrol_stud_no='".$data['stud_no']."' ORDER BY enrol_sy DESC");
		$count = 1;
		while($dataRemarks = dbarray($resultRemarks)){
			if($count==2)
				echo $dataRemarks['enrol_school'];
			$count++;
		}
		?>
		</td>
	</tr>
	<?php 
	$i++;
	} ?>
</table>
</td>
<td>&nbsp;</td>
<?php
$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='FEMALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
$rows = dbrows($result);
?>
<td valign="top">Females (<?php echo  $rows; ?>)
<table border="1" cellspacing="0" cellpadding="1" width="100%">
	<tr>
		<th>#</th>
		<th>FULLNAME</th>
		<th>Previous School</th>
	</tr>
	<?php
	$i=1;
	while($data = dbarray($result)){
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname'];?></td>
		<td><?php 
		$resultRemarks = dbquery("SELECT * FROM studenroll WHERE enrol_stud_no='".$data['stud_no']."' ORDER BY enrol_sy DESC");
		$count = 1;
		while($dataRemarks = dbarray($resultRemarks)){
			if($count==2)
				echo $dataRemarks['enrol_school'];
			$count++;
		}
		?>
		</td>
	</tr>
	<?php 
	$i++;
	} ?>
</table>
</td>
</tr>
</table>
<br>
<table border="0" cellspacing="0" cellpadding="0" width="750">
	<tr>
		<td>Prepared by: <br><br><br><br><strong><?php echo $current_registrar; ?></strong><br>School Registrar</td>
		<td>Approved by: <br><br><br><br><strong><?php echo $current_principal; ?></strong><br>School Principal</td>
	</tr>
</table>