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
			<h3>San Agustin National High School<br>Master Grading Sheet<br>
			SY: <?php echo $_GET['enrol_sy']; ?>-<?php echo $_GET['enrol_sy']+1; ?> / Section: <?php echo $_GET['classProfile']; ?>
			<br>Adviser: <u><?php echo $dataTeacher['user_fullname']; ?></u>	
			<br>Quarter: _________</h3>

		</td>
		<td width="10%"><img src="./assets/images/sanhs_logo.png" width="50"></td>
	</tr>
</table>
<table border="1" cellspacing="0" cellpadding="1" width="800">
	<tr>
		<th width="1%">#</th>
		<th width="20%">NAME</th>
		<th width="8%">___</th>
		<th width="8%">___</th>
		<th width="8%">___</th>
		<th width="8%">___</th>
		<th width="8%">___</th>
		<th width="8%">___</th>
		<th width="8%">___</th>
		<th width="8%">___</th>
		<th width="8%">Average</th>
		<th>Remarks</th>
	</tr>
	<?php
	$i=1;
	$MLEi=0;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no INNER JOIN studcontacts ON student.stud_no=studCont_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='MALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="20">
		<td><?php echo $i;?></td>
		<td><?php echo $data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname'];?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="center"></td>
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
		<td><?php echo $data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname'];?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="center"></td>
	</tr>
	<?php 
	$i++;
	} ?>
</table><br>
