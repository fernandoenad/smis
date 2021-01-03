<?php
session_start();
require('maincore.php');
$checkSection = dbquery("SELECT * FROM teacher WHERE teach_no='".$_GET['teach_no']."'");
$dataSection = dbarray($checkSection );
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
		font-size: 0.9em;
	} 
	
	td {
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.7em;		
	}
	</style>
</head>
<br>
<table border="0" cellspacing="0" cellpadding="0" width="800">
	<tr>
		<td width="60" valign="top"><img src="./assets/images/deped_logo.png" width="80"></td>
		<td align="center" valign="top">
		Republic of the Philippines<br>
		Department of Education<br>
		<?php echo $current_school_region;?><br>
		<strong>Division of <?php echo $current_school_division;?></strong><br>
		<strong>DISTRICT OF <?php echo strtoupper($current_school_district);?></strong><br><br>
		<strong><?php echo strtoupper($current_school_name);?></strong><br>
		<i><?php echo $current_school_address;?></i><br>
		<h2>TEACHER'S PROGRAM </h2>
		School Year <?php echo $current_sy;?>-<?php echo $current_sy+1;?>, <?php echo ($current_sem==1?"First":"Second");?> Semester<br>
		<u><h1</h1></u>
		</td>
		<td align="right">

		
		</td>
		<td width="60" valign="top"><img src="./assets/images/sanhs_logo.png" width="80"></td>
	</tr>
</table>	
		
<hr>

<div class="table-responsive">
	<table width="800" border="1" cellspacing="0" class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
		<thead>
			<tr height="28" bgcolor="gray">
				<th align="left" width="12%"><u>Time</th>
				<th align="left" width="8%"><u>Days</th>
				<th align="left" width="12%"><u><small>No. Of Mins. per Week</small></th>
				<th align="left"><u>Subject</th>
				<th align="left" width="11%"><u>Section</th>
				<th align="left" width="18%"><u>Room</th>
			</tr>
		</thead>
		<tbody> 
			<?php
				$checkAdvisory = dbquery("select * from section where (section_adviser='".$_GET['teach_no']."' and section_sy='".$current_sy."')");
				$countAdvisory = dbrows($checkAdvisory);
				$dataAdvisory = dbarray($checkAdvisory);
				
			?>
			<tr height="25" bgcolor="lightgray">
				<td>***</td>
				<td>***</td>
				<td>***</td>
				<td>Morning Ceremonies / Supervisory Activities</td>
				<td>***</td>
				<td>***</td>
			</tr>
		<?php
		/***
		$resultGrade = dbquery("SELECT * FROM grade INNER JOIN class on grade_class_no=class_no inner join prospectus ON class.class_pros_no=prospectus.pros_no inner join section on class_section_no=section_no WHERE (class_user_name='".$_GET['teach_no']."' and class_sy='".$current_sy."') GROUP BY class_no ORDER BY pros_sem ASC, class_timeslots ASC, pros_sort ASC");
		
		if($dataSection['section_level']<11){
			$resultGrade = dbquery("SELECT * FROM class INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no inner join section on class_section_no=section_no WHERE (class_user_name='".$_GET['teach_no']."' and class_sy='".$current_sy."') ORDER BY pros_sem ASC, class_timeslots ASC, pros_sort ASC");
		}
		else {
			$term = ($current_sem=="1"?"1":"2");
			$resultGrade = dbquery("SELECT * FROM class INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no inner join section on class_section_no=section_no WHERE (class_user_name='".$_GET['teach_no']."' and class_sy='".$current_sy."' and pros_sem='".$term."') ORDER BY pros_sem ASC, class_timeslots ASC, pros_sort ASC");
		}
		***/
		$resultGrade = dbquery("SELECT * FROM class inner join prospectus ON class.class_pros_no=prospectus.pros_no inner join section on class_section_no=section_no WHERE (class_user_name='".$_GET['teach_no']."' and class_sy='".$current_sy."') GROUP BY class_no ORDER BY pros_sem ASC, class_timeslots ASC, pros_sort ASC");
		
		$countHours = 0;
		while($dataGrade = dbarray($resultGrade)){
		if(substr($dataGrade['pros_title'],0,3)!="***"){
		if ($dataGrade['class_sem']=="12" || $dataGrade['class_sem']==$current_sem){
		
		?>													
			<tr height="25">
				<td><?php echo $dataGrade['class_timeslots']; ?></td>
				<td><?php echo $dataGrade['class_days']; ?></td>
				<td><?php echo $dataGrade['pros_hoursPerWk']*60; ?></td>
				<td>(<?php echo strtoupper(strtolower($dataGrade['pros_title'])); ?>) <?php echo ucwords(strtolower($dataGrade['pros_desc'])); ?></td>		
				<td><?php echo $dataGrade['section_name']; ?></td>
				<td><?php echo $dataGrade['class_room']; ?></td>
			</tr>
		<?php 
			$countHours+=$dataGrade['pros_hoursPerWk'];
		} }}?>	
		<!--
			<?php
		//	if($countAdvisory>0){
		//		$countHours+=300;
			?>
			<tr bgcolor="pink" height="25">
				<td>***</td>
				<td>MTWThF</td>
				<td>300</td>
				<td>Remedial / Homeroom</td>
				<td><?php echo ($dataAdvisory['section_name']==""?"***":$dataAdvisory['section_name']);?></td>	
				<td><?php echo ($dataAdvisory['section_name']==""?"***":$dataAdvisory['section_name']);?></td>					
			</tr>
			<?php
			//}
			?>
			-->
		</tbody>
	</table>
</div><hr>
<table border="0" cellspacing="0" cellpadding="0" width="800">
	<tr>
		<td width="30%" align="right" valign="top">
		Average No. of Minutes/Day:<br>
		Total No. Hours/Week: 
		</td>
		<td valign="top">
		<?php
		echo "&nbsp;&nbsp; <u><b>".(($countHours*60)/5)."</b></u><br>";
		echo "&nbsp;&nbsp; <u><b>".(($countHours*60)/60)."</b></u>";
		?>
		</td>
		<td width="30%">Prepared by:<br><br><br></td>
	</tr>
	<tr>
		<td align="center" valign="top">
		</td>
		<td align="center"></td>
		<td align="center"><b><?php echo strtoupper($dataSection['teach_fname']." ".($dataSection['teach_mname']=="-"?"":substr($dataSection['teach_mname'],0,1)).". ".$dataSection['teach_lname']." ".$dataSection['teach_xname']);?></b><br>Teacher</td>
		
	</tr>	
	<tr>
		<td width="30%">Approval Recommended:<br><br><br></td>
		<td></td>
		<td width="30%"><br><br></td>
	</tr>	
	<tr>
		<td align="center"><b><?php echo strtoupper($current_principal);?></b><br>School Principal</td>
		<td align="center"></td>
		<td align="center" valign="top">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<?php
				$checkAppoint = dbquery("select * from teacherappointments where teacherappointments_teach_no='".$_GET['teach_no']."' order by teacherappointments_date desc");
				$dataAppoint = dbarray($checkAppoint);
				$checkAppoint1 = dbquery("select * from teacherappointments where teacherappointments_teach_no='".$_GET['teach_no']."' order by teacherappointments_date asc");
				$dataAppoint1 = dbarray($checkAppoint1);
				$checkAppoint2 = dbquery("select * from teacherappointments where (teacherappointments_teach_no='".$_GET['teach_no']."' and teacherappointments_active='1')");
				$dataAppoint2 = dbarray($checkAppoint2);
				
				$time_difference =  strtotime(date("Y-m-d")) - strtotime($dataAppoint1['teacherappointments_date']);
				$years = (int) ($time_difference / (60*60*24*365));
				$checkEducTer1 = dbquery("select * from teacher_ebackground where (eback_teach_no='".$_GET['teach_no']."' and eback_level='TERTIARY')");
				$dataEducTer1 = dbarray($checkEducTer1);
				$checkEducTer2 = dbquery("select * from teacher_ebackground where (eback_teach_no='".$_GET['teach_no']."' and eback_level='MASTERAL')");
				$dataEducTer2 = dbarray($checkEducTer2);
				?>
				<tr><td width="45%" align="right">Position:</td><td style="border-bottom: solid 1px; text-align: center"><b><?php echo $dataAppoint2['teacherappointments_position'];?></b></td></tr>
				<tr><td align="right">C.S. Status:</td><td style="border-bottom: solid 1px; text-align: center"><b><small><?php echo ucwords($dataAppoint2['teacherappointments_status']);?></small></b></td></tr>
				<tr><td align="right">Major:</td><td style="border-bottom: solid 1px; text-align: center"><b><small><small><?php echo strtoupper($dataEducTer1['eback_major']);?></small></small></b></td></tr>
				<tr><td align="right">Employee No.:</td><td style="border-bottom: solid 1px; text-align: center"><b><?php echo $dataSection['teach_id'];?></b></td></tr>
				<tr><td align="right">TIN No.:</td><td style="border-bottom: solid 1px; text-align: center"><b><?php echo $dataSection['teach_tin'];?></b></td></tr>
				<tr><td align="right">M.A. Units:</td><td style="border-bottom: solid 1px; text-align: center"><b><?php echo ($dataEducTer2['eback_units']==100?"GRADUATED":$dataEducTer2['eback_units']);?></b></td></tr>
				<tr><td align="right">C.S. Eligibility:</td><td style="border-bottom: solid 1px; text-align: center"><b>LET</b></td></tr>
				<tr><td align="right">Teaching Experience:</td><td style="border-bottom: solid 1px; text-align: center"><b><?php echo $years;?></b></td></tr>
				<?php
				$designations="";
				$checkDesignations = dbquery("select * from teacherappointments where (teacherappointments_teach_no='".$_GET['teach_no']."' and teacherappointments_item_no='ANCILLARY')");	
				while($dataDesignations=dbarray($checkDesignations)){
					$designations.=$dataDesignations['teacherappointments_position'].", ";
				}
				?>
				<tr><td align="right">Ancillary Works:</td><td style="border-bottom: solid 1px; text-align: center"><b><small><?php echo strtoupper(substr($designations,0,strlen($designations)-2));?></small></b></td></tr>
			</table>
		</td>
		
	</tr>	
	<tr>
		<td width="30%"><br><br><br>Contents Noted:<br><br><br></td>
		<td></td>
		<td width="30%"><br><br><br>Approved:<br><br><br></td>
	</tr>	
	<tr>
		<td align="center" valign="top"><b><?php echo strtoupper($current_psds);?></b><br>Public Schools District Supervisor</td>
		<td align="center"></td>
		<td align="center"><br><br><b><?php echo strtoupper($current_superintendent);?></b><br>Schools Division Superintendent</td>
		
	</tr>	
	<tr>
		<?php
		$checkUser = dbquery("SELECT * FROM users WHERE user_name='".$_SESSION["user_name"]."'");
		$dataUser = dbarray($checkUser );
		?>
		<td colspan="3"></td>
	</tr>			
</table>	