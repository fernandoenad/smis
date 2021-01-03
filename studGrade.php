<?php
session_start();
require('maincore.php');
$checkStudent = dbquery("SELECT * FROM student INNER JOIN studenroll on student.stud_no=studenroll.enrol_stud_no WHERE (student.stud_no='".$_GET['stud_no']."' AND enrol_sy='".$_GET['enrol_sy']."')");
$dataStudent = dbarray($checkStudent );
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
		font-size: 0.7em;
	} 
	
	td {
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.8em;		
	}
	</style>
</head>	
<table border="0" cellspacing="0" cellpadding="0" width="1000">
	<tr>
		<td width="47%" align="left" valign="top">
			<h3 align="center">REPORT ON ATTENDANCE</h3>
			<table border="1" cellspacing="0" cellpadding="0" width="95%">
				<tr height="30">
					<th></th>
					<th width="7%">Jun</th>
					<th width="7%">Jul</th>
					<th width="7%">Aug</th>
					<th width="7%">Sep</th>
					<th width="7%">Oct</th>
					<th width="7%">Nov</th>
					<th width="7%">Dec</th>
					<th width="7%">Jan</th>
					<th width="7%">Feb</th>
					<th width="7%">Mar</th>
					<th width="7%">Apr</th>
					<th width="10%">Total</th>
				</tr>
				<?php
				$checkAtt1 = dbquery("SELECT * FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$_GET['enrol_sy']."')");
				$dataAtt1 = dbarray($checkAtt1);
				$dataAtt1 = (isset($dataAtt1) ? $dataAtt1 : array("sch_m1"=>0, "sch_m2"=>0, "sch_m3"=>0, "sch_m4"=>0, "sch_m5"=>0, "sch_m6"=>0, "sch_m7"=>0, "sch_m8"=>0, "sch_m9"=>0, "sch_m10"=>0, "sch_m11"=>0, "sch_m12"=>0));
				?>
				<tr height="45">
					<td>No. of school days</td>
					<td align="center" valign="middle"><?php echo ($dataAtt1['sch_m1']==0?"":$dataAtt1['sch_m1']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt1['sch_m2']==0?"":$dataAtt1['sch_m2']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt1['sch_m3']==0?"":$dataAtt1['sch_m3']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt1['sch_m4']==0?"":$dataAtt1['sch_m4']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt1['sch_m5']==0?"":$dataAtt1['sch_m5']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt1['sch_m6']==0?"":$dataAtt1['sch_m6']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt1['sch_m7']==0?"":$dataAtt1['sch_m7']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt1['sch_m8']==0?"":$dataAtt1['sch_m8']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt1['sch_m9']==0?"":$dataAtt1['sch_m9']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt1['sch_m10']==0?"":$dataAtt1['sch_m10']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt1['sch_m11']==0?"":$dataAtt1['sch_m11']);?></td>
					<?php
					$checkSchoolDays = dbquery("SELECT (sch_m1 + sch_m2 + sch_m3 + sch_m4 + sch_m5 + sch_m6 + sch_m7 + sch_m8 + sch_m9 + sch_m10 + sch_m11 + sch_m12) as total FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$_GET['enrol_sy']."')");
					$dataSchoolDays = dbarray($checkSchoolDays)
					?>
					<td align="center" valign="middle"><?php echo ($dataSchoolDays['total']==0?"":$dataSchoolDays['total']);?></td>
				</tr>
				<?php
				$checkAtt2 = dbquery("SELECT * FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$_GET['stud_no']."')");
				$dataAtt2 = dbarray($checkAtt2);
				$dataAtt2 = (isset($dataAtt2) ? $dataAtt2 : array("sch_m1"=>0, "sch_m2"=>0, "sch_m3"=>0, "sch_m4"=>0, "sch_m5"=>0, "sch_m6"=>0, "sch_m7"=>0, "sch_m8"=>0, "sch_m9"=>0, "sch_m10"=>0, "sch_m11"=>0, "sch_m12"=>0));
				?>
				<tr height="45">
					<td>No. of days present</td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m1']==0?"":$dataAtt2['sch_m1']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m2']==0?"":$dataAtt2['sch_m2']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m3']==0?"":$dataAtt2['sch_m3']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m4']==0?"":$dataAtt2['sch_m4']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m5']==0?"":$dataAtt2['sch_m5']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m6']==0?"":$dataAtt2['sch_m6']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m7']==0?"":$dataAtt2['sch_m7']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m8']==0?"":$dataAtt2['sch_m8']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m9']==0?"":$dataAtt2['sch_m9']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m10']==0?"":$dataAtt2['sch_m10']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m11']==0?"":$dataAtt2['sch_m11']);?></td>
					<?php
					$checkPresent = dbquery("SELECT (sch_m1 + sch_m2 + sch_m3 + sch_m4 + sch_m5 + sch_m6 + sch_m7 + sch_m8 + sch_m9 + sch_m10 + sch_m11 + sch_m12) as total FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$_GET['stud_no']."')");
					$dataPresent = dbarray($checkPresent)
					?>
					<td align="center" valign="middle"><?php echo ($dataStudent['enrol_status1']!="PROMOTED"?"":$dataPresent['total']);?></td>
				</tr>
				<tr height="45">
					<td>No. of days absent</td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m1']==0?"":$dataAtt1['sch_m1']-$dataAtt2['sch_m1']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m2']==0?"":$dataAtt1['sch_m2']-$dataAtt2['sch_m2']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m3']==0?"":$dataAtt1['sch_m3']-$dataAtt2['sch_m3']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m4']==0?"":$dataAtt1['sch_m4']-$dataAtt2['sch_m4']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m5']==0?"":$dataAtt1['sch_m5']-$dataAtt2['sch_m5']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m6']==0?"":$dataAtt1['sch_m6']-$dataAtt2['sch_m6']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m7']==0?"":$dataAtt1['sch_m7']-$dataAtt2['sch_m7']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m8']==0?"":$dataAtt1['sch_m8']-$dataAtt2['sch_m8']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m9']==0?"":$dataAtt1['sch_m9']-$dataAtt2['sch_m9']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m10']==0?"":$dataAtt1['sch_m10']-$dataAtt2['sch_m10']);?></td>
					<td align="center" valign="middle"><?php echo ($dataAtt2['sch_m11']==0?"":$dataAtt1['sch_m11']-$dataAtt2['sch_m11']);?></td>
					<td align="center" valign="middle"><?php echo ($dataStudent['enrol_status1']!="PROMOTED"?"":$dataSchoolDays['total']-$dataPresent['total']);?></td>
				</tr>
			</table><br><br><br>

			<table border="0" cellspacing="0" cellpadding="0" width="70%" align="center">
				<tr>
					<td colspan="2" align="center"><strong>PARENT/GUARDIAN'S SIGNATURE</strong></td>
				</tr>
				<tr>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>1<sup>st</sup> Quarter</td><td>____________________________________</td>
				</tr>
				<tr>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>2<sup>nd</sup> Quarter</td><td>____________________________________</td>
				</tr>
				<tr>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>3<sup>rd</sup> Quarter</td><td>____________________________________</td>
				</tr>
				<tr>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>4<sup>th</sup> Quarter</td><td>____________________________________</td>
				</tr>
			</table>
		</td>
		<td width="6%" align="left" valign="top"></td>
		<td width="47%" align="left" valign="top">
			<small><em>DepEd FORM 138</em></small><br>
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td width="20%" align="center" valign="top"><img src="./assets/images/deped_word.png" width="70"></td>
					<td width="60%" align="center" valign="top">
						<font style="font-family: Old English Text MT">Republic of the Philippines</font><br>
						Department of Education<br>
						<?php echo $current_school_region;?><br>
						Division of <?php echo $current_school_division;?><br>
						District of <?php echo $current_school_district;?><br>
					</td>
					<td width="20%" align="center" valign="top"><img src="./assets/images/sanhs_logo.png" width="60"></td>
				</tr>	
				<tr>
					<td colspan="3" align="center" valign="top">
						<strong><strong><?php echo strtoupper($current_school_name);?></strong></strong><br>
						<strong>School ID: <?php echo "(".$current_school_code.")";?></strong><br>
						<em><?php echo $current_school_address;?></em>			
					</td>
				</tr>
			</table><br><br><br><br>
			<!-- <center><img src="./assets/images/students/<?php echo $_GET['stud_no'];?>.jpg" width="60" style="border: 1px solid black"></center>-->
			
			<table border="0" cellspacing="0" cellpadding="0" width="95%">	
				<tr>
					<td width="19%">LRN: </td>
					<td colspan="4" style="border-bottom: 1px solid black"><strong><?php echo $dataStudent['stud_lrn'];?><strong></td>
				</tr>
				<tr>
					<td width="19%">Name: </td>
					<td colspan="4" style="border-bottom: 1px solid black"><strong><?php echo $dataStudent['stud_lname'].", ".$dataStudent['stud_fname']." ".($dataStudent['stud_xname']==""?"":$dataStudent['stud_xname'])." ".($dataStudent['stud_mname']=="-"?"":$dataStudent['stud_mname']);?><strong></td>
				</tr>
				<tr>
					<?php
					$checkBOSY = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
					$dataBOSY = dbarray($checkBOSY);
					$date1 = strtotime($dataBOSY['settings_bosy']);
					$date2 = strtotime($dataStudent['stud_bdate']);
					$time_difference = $date1 - $date2;
					$seconds_per_year = 60*60*24*365;
					$years = $time_difference / $seconds_per_year;
					?>
					<td>Age: </td>
					<td width="18%" style="border-bottom: 1px solid black"><strong><?php echo substr($years,0,2);?></td>
					<td width="18%" align="right">Sex:&nbsp;&nbsp;&nbsp;</td>
					<td style="border-bottom: 1px solid black"><strong><?php echo $dataStudent['stud_gender'];?></strong></td>
				</tr>
				<tr>
					<td>Grade: </td>
					<td style="border-bottom: 1px solid black"><strong><?php echo $dataStudent['enrol_level'];?></td>
					<td align="right">Section:&nbsp;&nbsp;&nbsp;</td>
					<td style="border-bottom: 1px solid black"><strong><?php echo $dataStudent['enrol_section'];?></strong></td>
				</tr>
				<tr>
					<td>School Year: </td>
					<td style="border-bottom: 1px solid black"><strong><?php echo $dataStudent['enrol_sy'];?>-<?php echo $dataStudent['enrol_sy']+1;?></strong></td>
					<td colspan="2"></td>
				</tr>
				<?php
				if($dataStudent['enrol_level']>10){
				?>
				<tr>
					<td>Track/Strand: </td>
					<td style="border-bottom: 1px solid black" colspan="3"><strong><?php echo $dataStudent['enrol_track']." - ".$dataStudent['enrol_strand'];?></td>
				</tr>
				<?php
				} 
				else {
					echo "<br>";
				}
				?>
			</table>
			
			<p align="justify">
			Dear Parent:<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This report card shows the ability and progress your child has made in the different learning areas as well as his/her core values.<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The school welcomes you, should you desire to know more about your child's progress.
			</p>
			
			<table border="0" cellspacing="0" cellpadding="0" width="100%">	
				<tr>
					<td width="47%" align="left" valign="top"><br><br><strong><?php echo $current_principal;?></strong><br>School Head/In-Charge</td>
					<td width="6%" align="left" valign="top"></td>
					<?php
					$checkAdviser=dbquery("select * from section inner join users on section_adviser=user_no where (section_name='".$dataStudent['enrol_section']."' and section_sy='".$_GET['enrol_sy']."')");
					$dataAdviser=dbarray($checkAdviser);
					?>
					<td width="47%" align="right" valign="top"><strong><?php echo $dataAdviser['user_fullname'];?><br></strong>Adviser</td>
				</tr>
			</table><br>
			
			<table border="0" cellspacing="0" cellpadding="0" width="100%">	
				<tr style="background-color: lightgray">
					<td colspan="4" align="center"><strong>Certificate of Transfer</strong></td>
				</tr>
				<tr>
					<td width="22%" align="left" valign="top">Admitted to Grade: </td>
					<td width="15%" align="left" valign="top" style="border-bottom: 1px solid black"></td>
					<td width="15%" align="right" valign="top">Section:</td>
					<td width="30%" align="right" valign="top" style="border-bottom: 1px solid black"></td>
				</tr>
				<tr>
					<td colspan="2" width="22%" align="left" valign="top">Eligibility for Admission to Grade: </td>
					<td colspan="2" width="15%" align="right" valign="top" style="border-bottom: 1px solid black"></td>
				</tr>
				<tr>
					<td colspan="4" width="22%" align="left" valign="top">Approved: </td>
				</tr>
			</table><br>
			
			<table border="0" cellspacing="0" cellpadding="0" width="100%">		
				<tr>
					<td width="47%" align="center" valign="top"><strong><?php echo $current_principal;?></strong><br>School Head/In-Charge</td>
					<td width="6%" align="left" valign="top"></td>
					<td width="47%" align="center" valign="top"><strong><?php echo $dataAdviser['user_fullname'];?></strong><br>Adviser</td>
				</tr>
			</table><br>
			
			<table border="0" cellspacing="0" cellpadding="0" width="100%">	
				<tr style="background-color: lightgray">
					<td colspan="4" align="center"><strong>Cancellation of Eligibility to Transfer</strong></td>
				</tr>
				<tr>
					<td width="20%" align="left" valign="top">Admitted in: </td>
					<td colspan="3" align="left" valign="top" style="border-bottom: 1px solid black"></td>
				</tr>
				<tr>
					<td align="left" valign="top">Date:</td>
					<td colspan="2" align="left" valign="top" style="border-bottom: 1px solid black"></td>
					<td align="right" valign="top"></td>
				</tr>
				<tr>
					<td colspan="3" align="left" valign="top"></td>
					<td width="50%" align="center" valign="top"><br>_____________________________<br>School Head/In-Charge</td>
				</tr>
			</table><br>
		</td>
	</tr>
</table>	
<br>
<table border="0" cellspacing="0" cellpadding="0" width="1000">
	<tr>
		<td width="47%" align="left" valign="top">
			<h3 align="center">REPORT ON LEARNING PROGRESS AND ACHIEVEMENT</h3>
			<?php
			if($dataStudent['enrol_level']<11){
			?>
			<table border="1" cellspacing="0" cellpadding="0" width="100%">	
				<tr style="background-color: lightgray">
					<th rowspan="2">Learning Areas</th>
					<th width="30%" colspan="4">Quarter</th>
					<th width="10%" rowspan="2">Final Grade</th>
					<th width="12%" rowspan="2">Remarks</th>				
				</tr>
				<tr>
					<th width="7%">1</th>
					<th width="7%">2</th>
					<th width="7%">3</th>
					<th width="7%">4</th>				
				</tr>
				<?php
				$resultGrade = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['stud_no']."' and grade.grade_sy='".$_GET['enrol_sy']."' and class_sem='12') ORDER BY grade_sem ASC, pros_sort ASC");
				$countUnits=0;
				$aveQ1=0;
				$aveQ2=0;
				$aveQ3=0;
				$aveQ4=0;
				$aveQf=0;
				$gradedUnits1=0;
				$gradedUnits2=0;
				$gradedUnits3=0;
				$gradedUnits4=0;
				$gradedUnitsqf=0;
				while($dataGrade = dbarray($resultGrade)){
				?>
				<tr height="35">
					<td><?php echo ucwords(strtolower($dataGrade['pros_desc'])); ?></td>
					<td align="center"><?php echo ($dataGrade['grade_q1']<60?"":$dataGrade['grade_q1']); 
						$aveQ1 += ($dataGrade['grade_q1']*$dataGrade['pros_unit']);?></td>
					<td align="center"><?php echo ($dataGrade['grade_q2']<60?"":$dataGrade['grade_q2']); 
						$aveQ2 += ($dataGrade['grade_q2']*$dataGrade['pros_unit']);?></td>
					<td align="center"><?php echo ($dataGrade['grade_q3']<60?"":$dataGrade['grade_q3']); 
						$aveQ3 += ($dataGrade['grade_q3']*$dataGrade['pros_unit']);?></td>
					<td align="center"><?php echo ($dataGrade['grade_q4']<60?"":$dataGrade['grade_q4']); 
						$aveQ4 += ($dataGrade['grade_q4']*$dataGrade['pros_unit']);?></td>
					<?php
					$resultEnrolInfo = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['stud_no']."' AND enrol_sy='".$current_sy."')");
					$dataEnrolInfo = dbarray($resultEnrolInfo);
					?>	
					<td align="center"><strong>
						<?php 
						if($dataGrade['pros_level']<11 && ($dataGrade['grade_q1']<60 || $dataGrade['grade_q2']<60 || $dataGrade['grade_q3']<60 || $dataGrade['grade_q4']<60)){
							echo "";
							$remarks = "";
						}
						else if($dataGrade['pros_level']>10 && ($dataGrade['grade_q1']<60 || $dataGrade['grade_q2']<60)){
							echo "";
							$remarks = "";
						}
						else {
							echo $dataGrade['grade_final'];
							$remarks = ($dataGrade['grade_final']>=75?"Passed":"Failed");
						}
						$aveQf += ($dataGrade['grade_final']*$dataGrade['pros_unit']);?></strong></td>
						<td><?php echo $remarks; ?></td>
					</td>
				</tr>
				<?php 
				$countUnits+=$dataGrade['pros_unit'];
				if($dataGrade['grade_q1']<60){
					$gradedUnits1+=0;
				} else {
					$gradedUnits1+=$dataGrade['pros_unit'];
				}
				if($dataGrade['grade_q2']<60){
					$gradedUnits2+=0;
				}else {
					$gradedUnits2+=$dataGrade['pros_unit'];
				}
				if($dataGrade['grade_q3']<60){
					$gradedUnits3+=0;
				}else {
					$gradedUnits3+=$dataGrade['pros_unit'];
				}
				if($dataGrade['grade_q4']<60){
					$gradedUnits4+=0;
				}else {
					$gradedUnits4+=$dataGrade['pros_unit'];
				}
				if($dataGrade['grade_final']<60){
					$gradedUnitsqf+=0;
				}
				else {
					$gradedUnitsqf+=$dataGrade['pros_unit'];
				}
				$pros_level = $dataGrade['pros_level'];
				} 
				?>
				<tr>
					<td align="right"><b>Average&nbsp;</b></td>
					<?php
					if($countUnits==0){
						$countUnits=1;
					}
					?>
					<td align="center"><b><?php echo $q1=($countUnits!=$gradedUnits1?"":round($aveQ1/$countUnits,0));?></b></td>
					<td align="center"><b><?php echo $q2=($countUnits!=$gradedUnits2?"":round($aveQ2/$countUnits,0));?></b></td>
					<td align="center"><b><?php echo $q3=($countUnits!=$gradedUnits3?"":round($aveQ3/$countUnits,0));?></b></td>
					<td align="center"><b><?php echo $q4=($countUnits!=$gradedUnits4?"":round($aveQ4/$countUnits,0));?></b></td>
					<?php
					$resultEnrolInfo = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['stud_no']."' AND enrol_sy='".$_GET['enrol_sy']."')");
					$dataEnrolInfo = dbarray($resultEnrolInfo);
					?>
					<td align="center"><strong><strong>
					<?php 
					if($pros_level<11 && ($q1=="" || $q2==""|| $q3=="" || $q4=="")){
						echo "";
					}
					else if($pros_level>10 && ($q1=="" || $q2=="")){
						echo "";
					}
					else {
						echo round($aveQf/$countUnits,0);
					} 	
					
					?></strong></strong></td>
					<td align="left"><small><small><strong><?php echo ($dataEnrolInfo['enrol_status1']=="PROMOTED"?$dataEnrolInfo['enrol_status2']:"");?></strong></small></small></td>
				</tr>
			</table>
			<?php
			grade_desc();
			}
			else {
			?>
			<strong>First Semester</strong>
			<table border="1" cellspacing="0" cellpadding="0" width="100%">	
				<tr style="background-color: lightgray">
					<th rowspan="2">Learning Areas</th>
					<th width="20%" colspan="2">Quarter</th>
					<th width="15%" rowspan="2">Semester Final Grade</th>
				</tr>
				<tr>
					<th width="10%">1</th>
					<th width="10%">2</th>			
				</tr>			
			<?php
				$resultGrade = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['stud_no']."' and grade.grade_sy='".$_GET['enrol_sy']."' and class_sem='1') ORDER BY grade_sem ASC, pros_sort ASC");
				$rowGrade = dbrows($resultGrade);
				$countUnits=0;
				$aveQ1=0;
				$aveQ2=0;
				$aveQ3=0;
				$aveQ4=0;
				$aveQf=0;
				$gradedUnits1=0;
				$gradedUnits2=0;
				$gradedUnits3=0;
				$gradedUnits4=0;
				$gradedUnitsqf=0;
				while($dataGrade = dbarray($resultGrade)){
					if($dataGrade['pros_track']=="SHS GENERAL"){
						$bgcolor="";
					}
					elseif($dataGrade['pros_track']=="SHS APPLIED"){
						$bgcolor="#D3D3D3";
					}
					else{
						$bgcolor="#C0C0C0";
					}
					
				?>
				<tr style="background-color: <?php echo $bgcolor;?>" height="18">
					<td><small><?php echo (strlen($dataGrade['pros_desc'])>50?substr(ucwords(strtolower($dataGrade['pros_desc'])),0,49)."...":$dataGrade['pros_desc']); ?></small></td>
					<td align="center"><small><?php echo ($dataGrade['grade_q1']<60?"":$dataGrade['grade_q1']); 
						$aveQ1 += ($dataGrade['grade_q1']*$dataGrade['pros_unit']);?></small></td>
					<td align="center"><small><?php echo ($dataGrade['grade_q2']<60?"":$dataGrade['grade_q2']); 
						$aveQ2 += ($dataGrade['grade_q2']*$dataGrade['pros_unit']);?></small></td>
					<?php
					$resultEnrolInfo = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['stud_no']."' AND enrol_sy='".$_GET['enrol_sy']."')");
					$dataEnrolInfo = dbarray($resultEnrolInfo);
					?>	
					<td align="center"><small><strong>
						<?php 
						if($dataGrade['pros_level']<11 && ($dataGrade['grade_q1']<60 || $dataGrade['grade_q2']<60 || $dataGrade['grade_q3']<60 || $dataGrade['grade_q4']<60)){
							echo "";
							$remarks = "";
						}
						else if($dataGrade['pros_level']>10 && ($dataGrade['grade_q1']<60 || $dataGrade['grade_q2']<60)){
							echo "";
							$remarks = "";
						}
						else {
							echo $dataGrade['grade_final'];
							$remarks = ($dataGrade['grade_final']>=75?"Passed":"Failed");
						}
						$aveQf += ($dataGrade['grade_final']*$dataGrade['pros_unit']);?></strong></small></td>
					</td>
				</tr>
				<?php 
				$countUnits+=$dataGrade['pros_unit'];
				if($dataGrade['grade_q1']<60){
					$gradedUnits1+=0;
				} else {
					$gradedUnits1+=$dataGrade['pros_unit'];
				}
				if($dataGrade['grade_q2']<60){
					$gradedUnits2+=0;
				}else {
					$gradedUnits2+=$dataGrade['pros_unit'];
				}
				if($dataGrade['grade_q3']<60){
					$gradedUnits3+=0;
				}else {
					$gradedUnits3+=$dataGrade['pros_unit'];
				}
				if($dataGrade['grade_q4']<60){
					$gradedUnits4+=0;
				}else {
					$gradedUnits4+=$dataGrade['pros_unit'];
				}
				if($dataGrade['grade_final']<60){
					$gradedUnitsqf+=0;
				}
				else {
					$gradedUnitsqf+=$dataGrade['pros_unit'];
				}
				$pros_level = $dataGrade['pros_level'];
				} 
				if($rowGrade<12){
					for($i=$rowGrade;$i<12;$i++){
						echo "<tr height=\"18\"><td><small><small></small></small></td><td></td><td></td><td></td></tr>";
					}
				}
				?>
				<tr>
					<td align="right"><small><b>Average&nbsp;</b></small></td>
					<?php
					if($countUnits==0){
						$countUnits=1;
					}
					?>
					<td align="center"><small><b><?php echo $q1=($countUnits!=$gradedUnits1?"":round($aveQ1/$countUnits,0));?></b></small></td>
					<td align="center"><small><b><?php echo $q2=($countUnits!=$gradedUnits2?"":round($aveQ2/$countUnits,0));?></b></small></td>
					<?php
					$resultEnrolInfo = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['stud_no']."' AND enrol_sy='".$_GET['enrol_sy']."')");
					$dataEnrolInfo = dbarray($resultEnrolInfo);
					?>
					<td align="center"><small><strong><strong>
					<?php 
					if($pros_level<11 && ($q1=="" || $q2==""|| $q3=="" || $q4=="")){
						echo "";
					}
					else if($pros_level>10 && ($q1=="" || $q2=="")){
						echo "";
					}
					else {
						echo round($aveQf/$countUnits,0);
					} 	
					
					?></strong></strong></small></td>
				</tr>
			</table><br>
			<table border="0" cellspacing="3" cellpadding="0" width="50%">
				<tr>
					<td width="30%"></td><td><small>Core Subjects</small></td>
				</tr>
				<tr>
					<td style="background-color: #D3D3D3"></td><td><small>Applied Subjects</small></td>
				</tr>
				<tr>
					<td style="background-color: #C0C0C0"></td><td><small>Specialization Subjects</small></td>
				</tr>
			</table><br>
			<strong>Second Semester</strong>
			<table border="1" cellspacing="0" cellpadding="0" width="100%">	
				<tr style="background-color: lightgray">
					<th rowspan="2">Learning Areas</th>
					<th width="20%" colspan="2">Quarter</th>
					<th width="15%" rowspan="2">Semester Final Grade</th>
				</tr>
				<tr>
					<th width="10%">3</th>
					<th width="10%">4</th>			
				</tr>			
			<?php
				$resultGrade = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['stud_no']."' and grade.grade_sy='".$_GET['enrol_sy']."' and class_sem='2') ORDER BY grade_sem ASC, pros_sort ASC");
				$rowGrade = dbrows($resultGrade);
				$countUnits=0;
				$aveQ1=0;
				$aveQ2=0;
				$aveQ3=0;
				$aveQ4=0;
				$aveQf=0;
				$gradedUnits1=0;
				$gradedUnits2=0;
				$gradedUnits3=0;
				$gradedUnits4=0;
				$gradedUnitsqf=0;
				while($dataGrade = dbarray($resultGrade)){
					if($dataGrade['pros_track']=="SHS GENERAL"){
						$bgcolor="";
					}
					elseif($dataGrade['pros_track']=="SHS APPLIED"){
						$bgcolor="#D3D3D3";
					}
					else{
						$bgcolor="#C0C0C0";
					}
					
				?>
				<tr style="background-color: <?php echo $bgcolor;?>" height="18">
					<td><small><?php echo (strlen($dataGrade['pros_desc'])>50?substr(ucwords(strtolower($dataGrade['pros_desc'])),0,49)."...":$dataGrade['pros_desc']); ?></small></td>
					<td align="center"><small><?php echo ($dataGrade['grade_q1']<60?"":$dataGrade['grade_q1']); 
						$aveQ1 += ($dataGrade['grade_q1']*$dataGrade['pros_unit']);?></small></td>
					<td align="center"><small><?php echo ($dataGrade['grade_q2']<60?"":$dataGrade['grade_q2']); 
						$aveQ2 += ($dataGrade['grade_q2']*$dataGrade['pros_unit']);?></small></td>
					<?php
					$resultEnrolInfo = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['stud_no']."' AND enrol_sy='".$_GET['enrol_sy']."')");
					$dataEnrolInfo = dbarray($resultEnrolInfo);
					?>	
					<td align="center"><small><strong>
						<?php 
						if($dataGrade['pros_level']<11 && ($dataGrade['grade_q1']<60 || $dataGrade['grade_q2']<60 || $dataGrade['grade_q3']<60 || $dataGrade['grade_q4']<60)){
							echo "";
							$remarks = "";
						}
						else if($dataGrade['pros_level']>10 && ($dataGrade['grade_q1']<60 || $dataGrade['grade_q2']<60)){
							echo "";
							$remarks = "";
						}
						else {
							echo $dataGrade['grade_final'];
							$remarks = ($dataGrade['grade_final']>=75?"Passed":"Failed");
						}
						$aveQf += ($dataGrade['grade_final']*$dataGrade['pros_unit']);?></strong></small></td>
					</td>
				</tr>
				
				<?php 
				$countUnits+=$dataGrade['pros_unit'];
				if($dataGrade['grade_q1']<60){
					$gradedUnits1+=0;
				} else {
					$gradedUnits1+=$dataGrade['pros_unit'];
				}
				if($dataGrade['grade_q2']<60){
					$gradedUnits2+=0;
				}else {
					$gradedUnits2+=$dataGrade['pros_unit'];
				}
				if($dataGrade['grade_q3']<60){
					$gradedUnits3+=0;
				}else {
					$gradedUnits3+=$dataGrade['pros_unit'];
				}
				if($dataGrade['grade_q4']<60){
					$gradedUnits4+=0;
				}else {
					$gradedUnits4+=$dataGrade['pros_unit'];
				}
				if($dataGrade['grade_final']<60){
					$gradedUnitsqf+=0;
				}
				else {
					$gradedUnitsqf+=$dataGrade['pros_unit'];
				}
				$pros_level = $dataGrade['pros_level'];
				} 		
				if($rowGrade<12){
					for($i=$rowGrade;$i<12;$i++){
						echo "<tr height=\"18\"><td></td><td></td><td></td><td></td></tr>";
					}
				}
				?>
				<tr>
					<td align="right"><small><b>Average&nbsp;</b></small></td>
					<?php
					if($countUnits==0){
						$countUnits=1;
					}
					?>
					<td align="center"><small><b><?php echo $q1=($countUnits!=$gradedUnits1?"":round($aveQ1/$countUnits,0));?></b></small></td>
					<td align="center"><small><b><?php echo $q2=($countUnits!=$gradedUnits2?"":round($aveQ2/$countUnits,0));?></b></small></td>
					<?php
					$resultEnrolInfo = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['stud_no']."' AND enrol_sy='".$_GET['enrol_sy']."')");
					$dataEnrolInfo = dbarray($resultEnrolInfo);
					?>
					<td align="center"><small><strong><strong>
					<?php 
					if($pros_level<11 && ($q1=="" || $q2==""|| $q3=="" || $q4=="")){
						echo "";
					}
					else if($pros_level>10 && ($q1=="" || $q2=="")){
						echo "";
					}
					else {
						echo round($aveQf/$countUnits,0);
					} 	
					
					?></strong></strong></small></td>
				</tr>
			</table>
			<br>
			<?php
			if($rowGrade!=0){
			?>
			<table border="0" cellspacing="3" cellpadding="0" width="50%">
				<tr>
					<td width="30%"></td><td><small>Core Subjects</small></td>
				</tr>
				<tr>
					<td style="background-color: #D3D3D3"></td><td><small>Applied Subjects</small></td>
				</tr>
				<tr>
					<td style="background-color: #C0C0C0"></td><td><small>Specialization Subjects</small></td>
				</tr>
			</table>
			<?php	
			}
			}
			?>
			
		</td>
		<td width="6%" align="left" valign="top"></td>
		<td width="47%" align="left" valign="top">
			<?php
			$checkCoreVal = dbquery("select * from student_corevalues where coreval_stud_no='".$_GET['stud_no']."' and	coreval_enrol_sy='".$_GET['enrol_sy']."'");
			$dataCoreVal = dbarray($checkCoreVal);
			$dataCoreVal = (isset($dataCoreVal) ? $dataCoreVal : array(
				"coreval_q1"=>'a:4:{i:0;s:0:"";i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";}', 
				"coreval_q2"=>'a:4:{i:0;s:0:"";i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";}', 
				"coreval_q3"=>'a:4:{i:0;s:0:"";i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";}', 
				"coreval_q4"=>'a:4:{i:0;s:0:"";i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";}', 
				"coreval_q5"=>'a:4:{i:0;s:0:"";i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";}', 
				"coreval_q6"=>'a:4:{i:0;s:0:"";i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";}', 
				"coreval_q7"=>'a:4:{i:0;s:0:"";i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";}'));
			$coreval_q1 = unserialize($dataCoreVal['coreval_q1']);
			$coreval_q2 = unserialize($dataCoreVal['coreval_q2']);
			$coreval_q3 = unserialize($dataCoreVal['coreval_q3']);
			$coreval_q4 = unserialize($dataCoreVal['coreval_q4']);
			$coreval_q5 = unserialize($dataCoreVal['coreval_q5']);
			$coreval_q6 = unserialize($dataCoreVal['coreval_q6']);
			$coreval_q7 = unserialize($dataCoreVal['coreval_q7']);
			?>
			<h3 align="center">REPORT ON LEARNER'S OBSERVED VALUES</h3>
			<table border="1" cellspacing="0" cellpadding="0" width="100%">	
				<tr style="background-color: lightgray">
					<th width="25%" align="center" rowspan="2">Core Values</th>
					<th align="center" rowspan="2">Behavior Statements</th>
					<th align="center" colspan="4">Quarter</th>
				</tr>
				<tr>
					<th width="8%" align="center">1</th>
					<th width="8%" align="center">2</th>
					<th width="8%" align="center">3</th>
					<th width="8%" align="center">4</th>
				</tr>
				<tr height="50">
					<td align="left" rowspan="2">1. Maka-Diyos</td>
					<td align="left">Expresses one's spiritual beliefs while respecting the spiritual beliefs of others</td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q1['0']) ? $coreval_q1['0'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q1['1']) ? $coreval_q1['1'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q1['2']) ? $coreval_q1['2'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q1['3']) ? $coreval_q1['3'] : "");?></td>
				</tr>
				<tr height="50">
					<td align="left">Shows adherence to ethical principles by upholding truth</td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q2['0']) ? $coreval_q2['0'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q2['1']) ? $coreval_q2['1'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q2['2']) ? $coreval_q2['2'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q2['3']) ? $coreval_q2['3'] : "");?></td>
				</tr>
				<tr height="50">
					<td align="left" rowspan="2">2. Makatao</td>
					<td align="left">Is sensitive to individual, social, and cultural differences</td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q3['0']) ? $coreval_q3['0'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q3['1']) ? $coreval_q3['1'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q3['2']) ? $coreval_q3['2'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q3['3']) ? $coreval_q3['3'] : "");?></td>
				</tr>
				<tr height="50">
					<td align="left">Demonstrates contributions toward solidarity</td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q4['0']) ? $coreval_q4['0'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q4['1']) ? $coreval_q4['1'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q4['2']) ? $coreval_q4['2'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q4['3']) ? $coreval_q4['3'] : "");?></td>
				</tr>
				<tr height="50">
					<td align="left">3. Makakalikasan</td>
					<td align="left">Cares for the environment and utilizes resources wisely, judiciously, and economically</td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q5['0']) ? $coreval_q5['0'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q5['1']) ? $coreval_q5['1'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q5['2']) ? $coreval_q5['2'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q5['3']) ? $coreval_q5['3'] : "");?></td>
				</tr>
				<tr height="50">
					<td align="left" rowspan="2">4. Makabansa</td>
					<td align="left">Demonstrate pride in being a Filipino; exercises the rights and responsibilities of a Filipino citizen</td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q6['0']) ? $coreval_q6['0'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q6['1']) ? $coreval_q6['1'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q6['2']) ? $coreval_q6['2'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q6['3']) ? $coreval_q6['3'] : "");?></td>
				</tr>
				<tr height="50">
					<td align="left">Demonstrates appropriate behavior in carrying out activities in the school, community, and country</td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q7['0']) ? $coreval_q7['0'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q7['1']) ? $coreval_q7['1'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q7['2']) ? $coreval_q7['2'] : "");?></td>
					<td align="center" valign="middle"><?php echo (isset($coreval_q7['3']) ? $coreval_q7['3'] : "");?></td>
				</tr>
			</table><br>
			<strong>Observed Values</strong>
			<table border="0" cellspacing="0" cellpadding="0" width="50%">	
				<tr>
					<th width="35%">Marking</th><th align="left">Non-numerical Rating</th>
				</tr>
				<tr>
					<td align="center">AO</td><td>Always Observed</td>
				</tr>
				<tr>	
					<td align="center">SO</td><td>Sometimes Observed</td>
				</tr>
				<tr>	
					<td align="center">RO</td><td>Rarely Observed</td>
				</tr>
				<tr>	
					<td align="center">NO</td><td>Not Observed</td>
				</tr>
			</table>
			<?php
			if($dataStudent['enrol_level']>10){
				grade_desc();
			}
			?>
		</td>
	</tr>
</table>

<!-- grade desciptor -->
<?php
function grade_desc(){
?>	
	<br>
	<strong>Learner Progress and Achievement</strong>
	<table border="0" cellspacing="0" cellpadding="0" width="90%">	
		<tr>
			<th width="45%" align="left">Descriptors</th><th align="left">Grading Scale</th><th align="left">Remarks</th>
		</tr>
		<tr>	
			<td align="left">Outstanding</td><td>90-100</td><td>Passed</td>
		</tr>
		<tr>	
			<td align="left">Very Satisfactory</td><td>85-89</td><td>Passed</td>
		</tr>
		<tr>	
			<td align="left">Satisfactory</td><td>80-84</td><td>Passed</td>
		</tr>
		<tr>	
			<td align="left">Fairly Satisfactory</td><td>75-79</td><td>Passed</td>
		</tr>
		<tr>	
			<td align="left">Did Not Meet Expectations</td><td>Below 75</td><td>Failed</td>
		</tr>
	</table>
<?php	
}