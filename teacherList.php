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

if ($_GET['display']=="teaching")
		$filter =" WHERE teach_status='1' AND teach_teacher='1'";
	else if ($_GET['display']=="nonteaching")
		$filter =" WHERE teach_status='1' AND teach_teacher='0'";
	else if ($_GET['display']=="all")
		$filter =" WHERE teach_status='1'";
	else if ($_GET['display']=="nonactive")
		$filter =" WHERE teach_status='0'";
	else 
		$filter =" WHERE teach_status='1'";
		
$result = dbquery("SELECT * FROM teacher $filter ORDER BY teach_lname ASC, teach_fname ASC");
$dataTeacher = dbarray($result);
?>
<table border="0" cellspacing="0" cellpadding="0" width="1200">
	<tr>
		<td width="60" valign="top"><img src="./assets/images/sanhs_logo.png" width="50"></td>
		<td align="left" valign="top">
		<strong><?php echo $current_school_name;?></strong><br>
		<?php echo $current_school_address;?>
		<h4>School Year <?php echo $current_sy; ?>-<?php echo $current_sy+1; ?>, <?php echo ($current_sem==1?"First":"Second");?> Semester<br>
		Staff List 
		<?php
		if ($_GET['display']=="teaching")
			echo " (Teaching Personnel)";
		else if ($_GET['display']=="nonteaching")
			echo " (Non-Teaching Personnel)";
		else if ($_GET['display']=="all")
			echo " (All Active Personnel)";
		else if ($_GET['display']=="nonactive")
			echo " (Non-Active Personnel)";
		else 
			echo " (All Active Personnel)";
		?>
		<br>School Principal: <?php echo $current_principal;?></h4>

		</td>
	</tr>
</table>	

<table border="1" cellspacing="0" cellpadding="0" width="1200">
	<thead>
		<tr align="left">
			<th width="2%">#</th>
			<th width="5%">DepEd ID</th>
			<th>Teacher</th>
			<th width="4%">Gender</th>
			<th width="6%">Birthday</th>
			<th width="15%">Address</th>
			<th width="6%">Contact</th>
			<th width="5%">Position</th>
			<th width="10%">IDs</th>
			<th width="15%">Educ'nl Backgrnds</th>
			<th width="15%">Appointments & Designation </th>
			<th width="15%">Schedule </th>
		</tr>
	</thead>
	<tbody>
	<?php
	if (dbrows($result)) {
		$i=1;											
		while ($data = dbarray($result)) {
	?>
		<tr>
			<td class="text-right"><?php echo $i; ?></td>
			<td><?php echo ($data['teach_id']<1200000?"NEW HIRE":$data['teach_id']); ?></td>
			<td><small><?php echo strtoupper($data['teach_lname']).", ".strtoupper($data['teach_fname'])." ".strtoupper($data['teach_xname'])." ".strtoupper($data['teach_mname']); ?></small></td>
			<td><small><?php echo $data['teach_gender']; ?></small></td>
			<?php
				$selectAppointments = dbquery("SELECT * FROM teacherappointments WHERE teacherappointments_teach_no='".$data['teach_no']."' ORDER BY teacherappointments_date DESC LIMIT 1");
				$rowAppointments = dbarray($selectAppointments);
			?>
			<td><small>
			<?php 
				$phpdate = strtotime($data['teach_bdate']);
				echo $mysqldate = date('F d, Y', $phpdate);
			?>
			</small></td>
			<td><small><?php echo $data['teach_residence'];?></small></td>
			<td><small><?php echo $data['teach_dialect'];?></small></td>
			<td><small><?php echo $rowAppointments['teacherappointments_position'];?></small></td>
			<?php 
			$value="";
			$checkIDS=dbquery("select * from teacherids where teacherids_teach_no='".$data['teach_no']."'");
			while($dataIDS = dbarray($checkIDS)){ $value.=$dataIDS['teacherids_id'].": ".$dataIDS['teacherids_details']."<br>";}
			?>
			<td><small><?php echo strtoupper($value);?></small></td>
			<?php 
			$value="";
			$checkIDS=dbquery("select * from teacher_ebackground where 	eback_teach_no='".$data['teach_no']."'");
			while($dataIDS = dbarray($checkIDS)){ $value.=$dataIDS['eback_level'].": ".$dataIDS['eback_degree']."<br>";}
			?>
			<td><small><?php echo strtoupper($value);?></small></td>
			<?php 
			$value="";
			$checkIDS=dbquery("select * from section where 	(section_adviser='".$data['teach_no']."' and section_sy='".$current_sy."')");
			while($dataIDS = dbarray($checkIDS)){ $value.=$dataIDS['section_level']."- ".$dataIDS['section_name']."<br>";}
			$checkIDS=dbquery("select * from teacherappointments where 	(teacherappointments_teach_no='".$data['teach_no']."' and teacherappointments_item_no='ANCILLARY' and teacherappointments_funding='0')");
			while($dataIDS = dbarray($checkIDS)){ $value.=$dataIDS['teacherappointments_position']."<br>";}
			?>
			<td><small><?php echo strtoupper($value);?></small></td>
			<?php 
			$value="";
			$checkIDS=dbquery("select * from class inner join prospectus on class_pros_no=pros_no where (class_user_name='".$data['teach_no']."' and class_sy='".$current_sy."')");
			while($dataIDS = dbarray($checkIDS)){ $value.=$dataIDS['pros_title'].": ".$dataIDS['class_timeslots']." ".$dataIDS['class_days']."<br>";}
			?>
			<td><small><?php echo strtoupper($value);?></small></td>
		</tr>
	<?php
		$i++;
		}	
	}
	?>
		<tr> <td colspan="7" align="center">

		</td></tr>
	</tbody>
</table>
