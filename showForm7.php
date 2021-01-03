<?php
require('maincore.php');
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<style>
	.borderdraw {
		position:fixed;
		border-style:solid;
		height:0;
		line-height:0;
		width:0;
		z-index:-1;
	}

	.tag1{ z-index:9999;position:absolute;top:40px; }
	.tag2 { z-index:9999;position:absolute;left:40px; }
	.diag { position: relative; width: 50px; height: 50px; }
	.outerdivslant { position: absolute; top: 0px; left: 0px; border-color: transparent transparent transparent rgb(64, 0, 0); border-width: 50px 0px 0px 60px;}
	.innerdivslant {position: absolute; top: 1px; left: 0px; border-color: transparent transparent transparent #fff; border-width: 49px 0px 0px 59px;}                  

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
<table border="0" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<td width="10%" align="right"><img src="./assets/images/deped_logo.png" width="80"></td>
		<td align="center" valign="top">
			<strong><font size="+1">School Form 7 (SF 7)<br>  School Personnel Assignment List and Basic Profile</font></strong><br>
			<small><i>(This replaces Form 12-Monthly Status Report for Teachers, Form 19-Assignment List,<br>																		
						Form 29-Teacher Program and Form 31-Summary Information of Teachers)</i></small>
			<br><br>
			<table width="100%" border="0">
				<tr height="25">
					<td width="10%" align="right" ><font size="1">School ID &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_code;?></td>
					<td width="5%"></td>
					<td></td>
					<td width="8%" align="right"><font size="1">Region &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_reg_code;?></td>
					<td width="5%"></td>
					<td width="8%" align="right"><font size="1">Division &nbsp;</td>
					<td align="center" colspan="2" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_division;?></td>
					<td align="center">
						<font size="1">			
						<?php 
						// echo $mysqldate = date("F");
						?>
					</td>
				</tr>
				<tr height="25">
					<td align="right" border="1"><font size="1">School Name &nbsp;</td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_full;?></td>
					<td align="right"><font size="1">District &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_district;?></td>
					<td align="right" colspan="2"><font size="1">School Year</td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?></td>
				</tr>				
			</table>
		</td>
		<td width="10%"><img src="./assets/images/sanhs_logo.png" width="80"></td>
	</tr>
</table>

<table border="0" cellspacing="0" cellpadding="1" width="1135">
	<tr>
	<td valign="top">
		<table border="1" cellspacing="0" cellpadding="1">
			<tr>
				<th colspan="2">(A) Nationally-Funded Teaching & Teaching Related Items</th>
			</tr>
			<tr align="center">
				<td>Title of Plantilla Position <br>(as it appears  in the appointment document/PSIPOP)</td>
				<td>Number of Incumbent	</td>	
			</tr>
			<?php
			
			$checkPositions = dbquery("SELECT * FROM dropdowns where (field_category='POSITION' and field_name IN (select teacherappointments_position from teacherappointments order by teacherappointments_date desc)) order by field_name asc ");
			while($dataPositions = dbarray($checkPositions)){
				if(substr($dataPositions['field_ext'],0,1)=="1" && substr($dataPositions['field_name'],0,3)=="JHS" || substr($dataPositions['field_name'],0,2)=="ES"){
			?>
			<tr align="center">
				<td><?php echo substr($dataPositions['field_ext'],2);?></td>
				<?php
				$checkCount = dbquery("SELECT * from teacherappointments inner join teacher on teacherappointments_teach_no=teach_no where (teacherappointments_position='".$dataPositions['field_name']."' and teacherappointments_active='1' and teach_status='1')");
				$countCount = dbrows($checkCount);
				?>
				<td><?php echo $countCount;?></td>	
			</tr>
			<?php
				}
			}
			?>
			
		</table>
	</td>
	<td valign="top">
		<table border="1" cellspacing="0" cellpadding="1">
			<tr>
				<th colspan="2">(B) Nationally-Funded Non Teaching Items<br><br></th>
			</tr>
			<tr align="center">
				<td>Title of Plantilla Position <br>(as it appears  in the appointment document/PSIPOP)</td>
				<td>Number of Incumbent	</td>	
			</tr>
			<?php
			$checkNonTeach = dbquery("select * from iis_menu where (iis_menuparent_menu_no='100' or iis_menuparent_menu_no='200') order by iis_menuname asc");
			while($dataNonTeach=dbarray($checkNonTeach)){
			?>
				<tr align="center">
					<td><?php echo ($dataNonTeach['iis_menuname']);?></td>
					<td><?php echo ($dataNonTeach['iis_menusort']);?></td>	
				</tr>
			<?php
			}
			?>
			<!--
			<?php
			$checkPositions = dbquery("SELECT * FROM dropdowns where (field_category='POSITION' and field_name IN (select teacherappointments_position from teacherappointments order by teacherappointments_date desc)) order by field_name asc ");
			while($dataPositions = dbarray($checkPositions)){
				if(substr($dataPositions['field_ext'],0,1)=="0"){
			?>
			<tr align="center">
				<td><?php echo substr($dataPositions['field_ext'],2);?></td>
				<?php
				$checkCount = dbquery("SELECT * from teacherappointments where (teacherappointments_position='".$dataPositions['field_name']."' and teacherappointments_active='1')");
				$countCount = dbrows($checkCount);
				?>
				<td><?php echo $countCount;?></td>	
			</tr>
			<?php
				}
			}
			?>
			-->
		</table>	
	</td>
	<td width="50%" valign="top">
		<table border="1" cellspacing="0" cellpadding="1">
			<tr>
				<th colspan="5">(C ) Other Appointments and Funding Sources	<br><br></th>
			</tr>
			<tr align="center">
				<td rowspan="2" width="40%">Title of Designation<br>(as it appears in the contract/document: Teacher, Clerk, Security Guard, Driver etc.)</td>
				<td rowspan="2" width="20%">Appointment<br> (Contractual, Substitute, Volunteer,  others specify)	</td>	
				<td rowspan="2" width="20%">Fund Source<br>(SEF, PTA, NGO's  etc.)</td>
				<td colspan="2" width="20%">Number of Incumbent</td>
			</tr>
			<tr align="center">
				<td>Teaching</td>
				<td>Non-Teaching</td>	
			</tr>
			<?php
			$checkC = dbquery("select * from iis_page where iis_pagetitle like 'appoint_%' order by iis_pagetitle asc");
			while($dataCheckC=dbarray($checkC)){
			?>
			<tr align="center">
				<td><?php echo substr($dataCheckC['iis_pagetitle'],8);?></td>
				<td><?php echo $dataCheckC['iis_pagecontent'];?></td>	
				<td><?php 
					$fundsource= $dataCheckC['iis_page_menu_no'];
					switch ($fundsource){
						case 1: echo "MOOE"; break;
						case 2: echo "SEF"; break;
						case 3: echo "PTA"; break;
						case 4: echo "NGO"; break;
						case 5: echo "Others"; break;
					}
				
				?></td>	
				<td><?php echo (substr($dataCheckC['iis_pagetitle'],8)=="Teacher"?$dataCheckC['iis_page_user_no']:"");?></td>	
				<td><?php echo (substr($dataCheckC['iis_pagetitle'],8)=="Teacher"?"":$dataCheckC['iis_page_user_no']);?></td>	
			</tr>	
			<?php
			}
			?>
			<tr align="center">
				<td></td>
				<td></td>	
				<td></td>	
				<td></td>	
				<td></td>	
			</tr>
		</table>	
	</td>	
	</tr>
</table>

<table border="1" cellspacing="0" cellpadding="1" width="1135">
	<tr align="center">	
		<td rowspan="2" width="6%">Employee No. (or Tax Identification Number -T.I.N.)</td>
		<td rowspan="2">Name of School Personnel<br>(Arrange by Position, Descending)</td>
		<td rowspan="2" width="3%">Sex</td>
		<td rowspan="2" width="5%">Fund Source</td>
		<td rowspan="2" width="8%">Position/ Designation</td>
		<td rowspan="2" width="8%">Nature of Appointment/ Employment Status</td>
		<td colspan="3">EDUCATIONAL QUALIFICATION</td>
		<td rowspan="2" width="17%">Subject Taught (include Grade & Section), Advisory Class & Otder Ancillary Assignments</td>
		<td colspan="4">Daily Program (time duration)</td>
		<td rowspan="2" width="6%"><center>Remarks (For Detailed Items, Indicate name of school/office, For IP's -Ethnicity)</center>
	</td>
	</tr>	
	<tr align="center">	
		<td width="5%">Degree / Post Graduate</td>
		<td width="8%">Major/ Specialization
		<td width="6%">Minor
		<td width="4%">DAY (M/T/ W/TH/F)</td>
		<td width="4%">From (00:00)</td>
		<td width="4%">To (00:00)</td>
		<td width="4%">Total Actual Teaching Minutes per Week</td>
	</tr>	
	
	<?php
		$checkTeachers= dbquery("SELECT * FROM teacher inner join teacherappointments on teach_no=teacherappointments_teach_no WHERE (teach_teacher='1' and teach_status='1' and teacherappointments_active='1' and (teacherappointments_position like 'JHS%' or teacherappointments_position like 'ES%')) ORDER BY teach_lname ASC, teach_fname ASC");
		while($dataTeachers = dbarray($checkTeachers)){
			?>
	<tr>
		<td><?php echo $dataTeachers['teach_id'];?> </td>
		<td><?php echo strtoupper($dataTeachers['teach_lname']);?>, <?php echo strtoupper($dataTeachers['teach_fname']);?> <?php echo strtoupper($dataTeachers['teach_xname']);?> <?php echo substr(strtoupper($dataTeachers['teach_mname']),0,1);?></td>
		<td align="center"><?php echo substr($dataTeachers['teach_gender'],0,1);?></td>
		<?php
		$appoint = dbquery("select * from teacherappointments where (teacherappointments_teach_no='".$dataTeachers['teach_no']."' and teacherappointments_active='1') order by teacherappointments_date desc");
		$data = dbarray($appoint);
		?>
		<td><?php echo $data['teacherappointments_funding'];?></td>
		<td><?php echo $data['teacherappointments_position'];?></td>
		<td><?php echo $data['teacherappointments_status'];?></td>
		<?php
			$checkEduc = dbquery("SELECT * FROM teacher_ebackground WHERE eback_teach_no='".$dataTeachers['teach_no']."' ORDER BY eback_no ASC LIMIT 1");
			$dataEduc = dbarray($checkEduc);
		?>
		<td><?php echo strtoupper($dataEduc['eback_degree']);?></td>
		<td><?php echo strtoupper($dataEduc['eback_major']);?></td>
		<td><?php echo strtoupper($dataEduc['eback_minor']);?></td>
		<td colspan="5">
			<table border="1" cellspacing="0" cellpadding="1" width="100%">
			<!--
				<tr height="15">
					<td colspan="5" bgcolor="lightgray">Full Year / First Semester (SHS)</td>
				</tr>
			-->	
				<?php 
					$checkAdvisory = dbquery("SELECT * FROM section WHERE (section_sy='".$current_sy."' AND section_adviser='".$dataTeachers['teach_no']."')");
					$countAdvisory = dbrows($checkAdvisory);
					$checkAncillary= dbquery("SELECT * FROM teacherappointments WHERE (teacherappointments_item_no='ANCILLARY' and teacherappointments_teach_no	='".$dataTeachers['teach_no']."' and teacherappointments_funding='0')");
					$countAncillary = dbrows($checkAncillary);
					if($countAdvisory>0){
						$dataAdvisory = dbarray($checkAdvisory);
						$value = "<b>".$dataAdvisory['section_level']." - ".$dataAdvisory['section_name']." Adviser</b>";
						$hoursPerWeek1=5;
						?>
						<tr height="15">
							<td><?php echo strtoupper($value);?></td>
							<td width="12%">MTWThF</td>
							<td width="13%">--:--</td>
							<td width="13%">--:--</td>
							<td width="11%"><?php echo $hoursPerWeek1*60;?></td>
						</tr>
						<?php
					} else {
						$hoursPerWeek1=0;
					}
					if($countAncillary>0){
						$value = "";
						while($dataAncillary = dbarray($checkAncillary)){
							$value .= $dataAncillary['teacherappointments_position'].", ";
						}
						$hoursPerWeek2=5;
						?>
						<tr height="15">
							<td><b><?php echo strtoupper(substr($value,0,strlen($value)-2));?></b></td>
							<td width="12%">MTWThF</td>
							<td width="13%">--:--</td>
							<td width="13%">--:--</td>
							<td width="11%"><?php echo $hoursPerWeek2*60;?></td>
						</tr>
						<?php
					}
					else {
						$hoursPerWeek2=0;
					}
			
					$totalMinutes = 0;
					$checkAssignments = dbquery("SELECT * FROM class INNER JOIN prospectus ON class_pros_no=pros_no INNER JOIN section ON class_section_no=section_no WHERE (class_sy='".$_GET['enrol_sy']."' AND class_user_name='".$dataTeachers['teach_no']."' and (pros_sem='1' or pros_sem=12))");
					while($dataAssignments = dbarray($checkAssignments)){
					if(substr($dataAssignments['pros_title'],0,3)=="***"){}
					else{
					$totalMinutes = $totalMinutes + ($dataAssignments['pros_hoursPerWk']*60);
				?>
				<tr>
					<td><?php echo $dataAssignments['pros_title'];?> - <?php echo $dataAssignments['section_name'];?></td>
					<td width="12%"><?php echo $dataAssignments['class_days'];?></td>
					<td width="13%"><?php echo substr($dataAssignments['class_timeslots'],0,5);?></td>
					<td width="13%"><?php echo substr($dataAssignments['class_timeslots'],6,10);?></td>
					<td width="11%"><?php echo round($dataAssignments['pros_hoursPerWk']*60,0);?></td>
				</tr>
				<?php
					}
					}
					
				?>
				
				<tr>
					<td colspan="4" align="right">Ave.  Minutes per Day</td>
					<td width="11%"><b><?php echo round(($totalMinutes+(($hoursPerWeek1+$hoursPerWeek2)*60))/5,0);?></b></td>
				</tr>
			</table><br>
			<?php
			if($_GET['g1']>=11){
			?>
			<table border="1" cellspacing="0" cellpadding="1" width="100%">
				<tr height="15">
					<td colspan="5" bgcolor="lightgray">Second Semester</td>
				</tr>
				<?php 
					$checkAdvisory = dbquery("SELECT * FROM section WHERE (section_sy='".$current_sy."' AND section_adviser='".$dataTeachers['teach_no']."')");
					$countAdvisory = dbrows($checkAdvisory);
					$checkAncillary= dbquery("SELECT * FROM teacherappointments WHERE (teacherappointments_item_no='ANCILLARY' and teacherappointments_teach_no	='".$dataTeachers['teach_no']."' and teacherappointments_funding='0')");
					$countAncillary = dbrows($checkAncillary);
					if($countAdvisory>0){
						$dataAdvisory = dbarray($checkAdvisory);
						$value = "<b>".$dataAdvisory['section_level']." - ".$dataAdvisory['section_name']." Adviser</b>";
						$hoursPerWeek1=5;
						?>
						<tr height="15">
							<td><?php echo strtoupper($value);?></td>
							<td width="12%">MTWThF</td>
							<td width="13%">--:--</td>
							<td width="13%">--:--</td>
							<td width="11%"><?php echo $hoursPerWeek1*60;?></td>
						</tr>
						<?php
					} else {
						$hoursPerWeek1=0;
					}
					if($countAncillary>0){
						$value = "<b>";
						while($dataAncillary = dbarray($checkAncillary)){
							$value .= $dataAncillary['teacherappointments_position'].", ";
						}
						$value.="</b>";
						$hoursPerWeek2=5;
						?>
						<tr height="15">
							<td><?php echo strtoupper($value);?></td>
							<td width="12%">MTWThF</td>
							<td width="13%">--:--</td>
							<td width="13%">--:--</td>
							<td width="11%"><?php echo $hoursPerWeek2*60;?></td>
						</tr>
						<?php
					}
					else {
						$hoursPerWeek2=0;
					}
			
					$totalMinutes = 0;
					$checkAssignments = dbquery("SELECT * FROM class INNER JOIN prospectus ON class_pros_no=pros_no INNER JOIN section ON class_section_no=section_no WHERE (class_sy='".$_GET['enrol_sy']."' AND class_user_name='".$dataTeachers['teach_no']."' and (pros_sem='2'))");
					while($dataAssignments = dbarray($checkAssignments)){
					if(substr($dataAssignments['pros_title'],0,3)=="***"){}
					else{
					$totalMinutes = $totalMinutes + ($dataAssignments['pros_hoursPerWk']*60);
				?>
				<tr>
					<td><?php echo $dataAssignments['pros_title'];?> - <?php echo $dataAssignments['section_name'];?></td>
					<td width="12%"><?php echo $dataAssignments['class_days'];?></td>
					<td width="13%"><?php echo substr($dataAssignments['class_timeslots'],0,5);?></td>
					<td width="13%"><?php echo substr($dataAssignments['class_timeslots'],6,10);?></td>
					<td width="11%"><?php echo round($dataAssignments['pros_hoursPerWk']*60,0);?></td>
				</tr>
				<?php
					}
					}
					
				?>
				
				<tr>
					<td colspan="4" align="right">Ave.  Minutes per Day</td>
					<td width="11%"><b><?php echo round(($totalMinutes+(($hoursPerWeek1+$hoursPerWeek2)*60))/5,0);?></b></td>
				</tr>
			</table>
			<?php
				}
				?>
		</td>

		<td>-</td>
	</tr>
	<?php
		}
	?>
</table>
<br>
<table width="1135">
	<tr align="center" valign="">
		<td width="50%" align="left">
		<b>GUIDELINES:</b><br>
		1. This form shall be accomplished at the beginning of the school year by the school head.  In case of movement of teachers and other personnel during the school year, an updated Form 19 must be submitted to the Division Office.<br>												
		2. All school personnel, regardless of position/nature of appointment should be included in this form and  should be listed from the highest rank down to the lowest.<br>  												
		3. Please reflect subjects being taught and if teacher handling advisory class or  Ancillary Assignment.  Other administrative duties must also reported.<br>												
		4. Daily Program Column is for teaching personnel only.<br>	</td>
		<td>Prepared by: </td>
		<?php
		$checkSettings = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
		$dataSettings = dbarray($checkSettings);
		?>
		<td><u><b><?php echo strtoupper($dataSettings['settings_registrar']);?></u></b><br>SCHOOL REGISTRAR</td>
		<td>Submitted by:</td>
		<td><u><b><?php echo strtoupper($dataSettings['settings_principal']);?></u></b><br>SCHOOL HEAD</td>
	</tr>
</table>



