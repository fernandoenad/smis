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
<table border="0" cellspacing="0" cellpadding="0" width="750">
	<tr>
		<td width="60"><img src="./assets/images/sanhs_logo.png" width="50"></td>
		<td align="left" valign="top">
		<strong><?php echo $current_school_name;?></strong><br>
		<?php echo $current_school_address;?>
		<h3>Year Level Masterlist<br>
		</h3>
		</td>
	</tr>
</table>	
<h3>Student List for Grade <?php echo $_GET['classProfile'];?> / SY <?php echo $_GET['enrol_sy'];?> - <?php echo $_GET['enrol_sy']+1;?></h3>

<table border="1" cellspacing="0" cellpadding="1" width="1135">
	<tr height="25">
		<th width="3%">#</th>
		<th width="20%">FULLNAME</th>
		<th width="2%">Gender</th>
		<th width="6%">Birthday</th>
		<th width="20%">Current Address</th>
		<th width="10%">Contact #</th>
		<th width="15%">Class / Section</th>
		<th>Remarks</th>
		<th width="5%">Gen. Ave.</th>
	</tr>
	<?php
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student ON studenroll.enrol_stud_no=student.stud_no INNER JOIN studcontacts ON student.stud_no=studcontacts.studCont_stud_no WHERE (enrol_status1!='INACTIVE' AND enrol_section!='' AND enrol_level='".$_GET['classProfile']."' AND enrol_sy='".$_GET['enrol_sy']."' AND stud_gender='MALE') ORDER BY stud_lname ASC, stud_fname ASC");
	$rows = dbrows($result);
	$i=1;
	while($data = dbarray($result)){
	?>
	<tr height="25">
		<td><?php echo $i; ?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
		<td><?php echo substr($data['stud_gender'],0,1);?></td>
		<td><?php echo $data['stud_bdate'];?></td>
		<td><?php echo $data['stud_residence'];?></td>
		<td><?php echo $data['studCont_stud_gcontact'];?></td>
		<td><?php echo $data['enrol_section']?></td>
		<td><?php echo strtoupper($data['enrol_remarks']); ?> </td> 
		<td><?php echo number_format($data['enrol_average'],3); ?> </td>
	</tr>
	<?php 
	$i++;
	} ?>
	<tr height="25">
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
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student ON studenroll.enrol_stud_no=student.stud_no INNER JOIN studcontacts ON student.stud_no=studcontacts.studCont_stud_no WHERE (enrol_status1!='INACTIVE' AND enrol_section!='' AND enrol_level='".$_GET['classProfile']."' AND enrol_sy='".$_GET['enrol_sy']."' AND stud_gender='FEMALE') ORDER BY stud_lname ASC, stud_fname ASC");
	$rows = dbrows($result);
	$i=1;
	while($data = dbarray($result)){
	?>
	<tr height="25">
		<td><?php echo $i; ?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
		<td><?php echo substr($data['stud_gender'],0,1);?></td>
		<td><?php echo $data['stud_bdate'];?></td>
		<td><?php echo $data['stud_residence'];?></td>
		<td><?php echo $data['studCont_stud_gcontact'];?></td>
		<td><?php echo $data['enrol_section']?></td>
		<td><?php echo strtoupper($data['enrol_remarks']); ?> </td> 
		<td><?php echo number_format($data['enrol_average'],3); ?> </td>
	</tr>
	<?php 
	$i++;
	} ?>
</table>
<br>
<table border="0" cellspacing="0" cellpadding="0" width="1135">
	<tr>
		<td>Prepared by: <br><br><br><br><strong><?php echo $current_registrar; ?></strong><br>School Registrar</td>
		<td>Approved by: <br><br><br><br><strong><?php echo $current_principal; ?></strong><br>School Principal</td>
	</tr>
</table>