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
<br><br>
<table border="0" cellspacing="0" cellpadding="0" width="750">
	<tr>
		<td width="60" valign="top"><img src="./assets/images/deped_logo.png" width="80"></td>
		<td align="center" valign="top">
		Republic of the Philippines<br>
		Department of Education<br>
		<?php echo $current_school_region;?><br>
		<strong>Division of <?php echo $current_school_division;?></strong><br>
		<strong>DISTRICT OF <?php echo strtoupper($current_school_district);?></strong><br><br>
		<strong><?php echo $current_school_name;?></strong><br>
		<i><?php echo $current_school_address;?></i><br>
		<h2>CLASS LIST </h2>
		School Year <?php echo $current_sy;?>-<?php echo $current_sy+1;?>, <?php echo ($current_sem==1?"First":"Second");?> Semester<br>
		<?php 
		$checkLevel = dbquery("select * from section where (section_name='".$_GET['classProfile']."' and section_sy='".$_GET['enrol_sy']."')");
		$dataLevel = dbarray($checkLevel);
		?>
		<u><h1><?php echo "Grade ".$dataLevel['section_level']." - ".$_GET['classProfile'];?></h1></u>
		</td>
		<td width="60" valign="top"><img src="./assets/images/sanhs_logo.png" width="80"></td>
	</tr>
</table>
<?php
$resultTeacher = dbquery("SELECT * FROM section INNER JOIN users ON section.section_adviser=users.user_no WHERE (section_name='".$_GET['classProfile']."' AND section_sy='".$_GET['enrol_sy']."')");
$dataTeacher = dbarray($resultTeacher);
?>
	
<table border="0" cellspacing="0" cellpadding="0" width="750">
<tr>
<?php
$result= dbquery("SELECT * FROM studenroll INNER JOIN student ON studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='MALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
$rows = dbrows($result);
?>
<td valign="top" width="375">Males (<?php echo  $rows; ?>)
<table border="0" cellspacing="0" cellpadding="1" width="100%">
	<tr>
		<th width="1%">#</th>
		<th width="35%">FULLNAME</th>
		<th>Birthday</th>
		<th>Ht</th>
		<th>Wt</th>		
		<th>LRN / Stud No</th>
	</tr>
	<?php
	$i=1;
	while($data = dbarray($result)){
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".($data['stud_mname']=="-"?"":substr($data['stud_mname'],0,1).".")); ?></td>
		<td align="center"><?php echo $data['stud_bdate'];?></td>
		<td align="center"><?php echo number_format($data['enrol_height'],1);?></td>	
		<td align="center"><?php echo number_format($data['enrol_weight'],1);?></td>			
		<td align="center"><strong><?php echo $data['stud_lrn'];?> / <?php echo $data['stud_no'];?></strong></td>
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
<td valign="top" width="375">Females (<?php echo  $rows; ?>)
<table border="0" cellspacing="0" cellpadding="1" width="100%">
	<tr>
		<th width="1%">#</th>
		<th width="38%">FULLNAME</th>
		<th>Birthday</th>
		<th>Ht</th>
		<th>Wt</th>
		<th>LRN / Stud No</th>
	</tr>
	<?php
	$i=1;
	while($data = dbarray($result)){
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".($data['stud_mname']=="-"?"":substr($data['stud_mname'],0,1).".")); ?></td>
		<td align="center"><?php echo $data['stud_bdate'];?></td>
		<td align="center"><?php echo number_format($data['enrol_height'],1);?></td>	
		<td align="center"><?php echo number_format($data['enrol_weight'],1);?></td>	
		<td align="center"><strong><?php echo $data['stud_lrn'];?> / <?php echo $data['stud_no'];?></strong></td>
	</tr>
	<?php 
	$i++;
	} ?>
</table>
</td>
</tr>
</table>
<br>
<table border="0" cellspacing="0" cellpadding="0" width="800">
	<tr>
		<td width="30%"></td>
		<td></td>
		<td width="30%">Prepared by:<br><br><br></td>
	</tr>
	<tr>
		<?php
		$checkUser = dbquery("SELECT * FROM users WHERE user_no='".$dataTeacher['user_no']."'");
		$dataUser = dbarray($checkUser );
		?>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"><b><?php echo strtoupper($dataUser['user_fullname']);?></b><br>Class Adviser</td>
		
	</tr>	
	<tr>
		<td width="30%">Approval Recommended:<br><br><br></td>
		<td></td>
		<td width="30%"><br><br></td>
	</tr>	
	<tr>
		<td align="center"><b><?php echo strtoupper($current_principal);?></b><br>School Principal</td>
		<td align="center"></td>
		<td align="center"></td>
		
	</tr>	
	<tr>
		<td width="30%"><br><br><br>Contents Noted:<br><br><br></td>
		<td></td>
		<td width="30%"><br><br><br>Approved:<br><br><br></td>
	</tr>	
	<tr>
		<td align="center"><b><?php echo strtoupper($current_psds);?></b><br>Public Schools District Supervisor</td>
		<td align="center"></td>
		<td align="center"><b><?php echo strtoupper($current_superintendent);?></b><br>Schools Division Superintendent</td>
		
	</tr>	
	<tr>
		<?php
		$checkUser = dbquery("SELECT * FROM users WHERE user_name='".$_SESSION["user_name"]."'");
		$dataUser = dbarray($checkUser );
		?>
		<td colspan="3"></td>
	</tr>			
</table>