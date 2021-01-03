<?php
require('maincore.php');
$resultStudent = dbquery("SELECT * FROM student INNER JOIN studcontacts ON student.stud_no=studcontacts.studCont_stud_no WHERE student.stud_no='".$_GET['grade_stud_no']."'");
$dataStudent = dbarray($resultStudent);
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<style>
	table {
	
	}
	
	th{
		height: 13px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.6em;
	} 
	
	td {
		height: 13px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.55em;		
	}
	input {
		height: 15px;
		text-decoration: strong;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.8em;			
	}
	</style>
</head>	
	<table border="0" cellspacing="0" cellpadding="0" width="780">
		<tr>
			<td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td>
			<td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td colspan="2" align="right"><b>SF10-SHS</b></td>
		</tr>	
		<tr align="center">
			<td colspan="3" rowspan="2" align="left"><img src="./assets/images/deped_logo.png" width="80"></td>
			<td colspan="8">REPUBLIC OF THE PHILIPPPINES<br>DEPARTMENT OF EDUCATION</td>
			<td colspan="3" rowspan="2" align="right">
			<img src="./assets/images/deped_word.png" alt="" style="max-width:140px" border="0"/><br>
			</td>
		</tr>
		<tr>
			<td colspan="8" align="center" valign="middle"><h2>SENIOR HIGH SCHOOL STUDENT PERMANENT RECORD</h2></td>
		<tr>
	</table>
	<table border="0" cellspacing="0" cellpadding="0" width="780">	
		<tr>
			<td width="7%"></td><td width="5%"></td><td width="7%"></td><td width="6%"></td><td width="9%"></td><td width="7%"></td><td width="5%"></td>
			<td width="5%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="10%"></td>
		</tr>		
		<tr  bgcolor="gray">
			<td colspan="14" align="center"><b>LEARNER'S INFORMATION</b></td>
		</tr>	
		<tr>
			<td>LAST NAME: &nbsp; </td>
			<td colspan="3" style="border-bottom: 1px solid;"> <font size="2"><strong><?php echo strtoupper($dataStudent['stud_lname']);?></strong></td>
			<td colspan="2" align="right">FIRST NAME: &nbsp; &nbsp; </td>
			<td colspan="3" style="border-bottom: 1px solid;"> <font size="2"><strong><?php echo strtoupper($dataStudent['stud_fname']).($dataStudent['stud_xname']==""?"":", ".strtoupper($dataStudent['stud_xname']));?></strong></td>
			<td colspan="2" align="right">MIDDLE NAME: &nbsp; &nbsp; </td>
			<td colspan="3" style="border-bottom: 1px solid;"> <font size="2"><strong><?php echo strtoupper($dataStudent['stud_mname']);?></strong></td>	
		</tr>		
		<tr>
			<td>LRN: &nbsp; </td>
			<td colspan="2" style="border-bottom: 1px solid;"> <strong><?php echo $dataStudent['stud_lrn'];?></strong></td>
			<td colspan="3" align="right">Date of Birth (MM/DD/YYYY): &nbsp; &nbsp; </td>
			<td colspan="2" style="border-bottom: 1px solid;"> <strong><?php $phpdate = strtotime($dataStudent['stud_bdate']); echo $mysqldate = date('m/d/Y', $phpdate);?></strong></td>
			<td align="right">Sex: &nbsp; &nbsp; </td>
			<td style="border-bottom: 1px solid;"> <strong><?php echo $dataStudent['stud_gender'];?></strong></td>
			<td colspan="3" align="right">Date of SHS Admission (MM/DD/YYYY): &nbsp; &nbsp; </td>
			<?php
				$resultSHSAdm = dbquery("select * from studenroll where (enrol_stud_no='".$_GET['grade_stud_no']."' and enrol_level>10) limit 0,1");
				$dataSHSAdm = dbarray($resultSHSAdm );
			?>
			<td style="border-bottom: 1px solid;"> <strong><?php $phpdate = strtotime($dataSHSAdm['enrol_admitdate']); echo $mysqldate = date('m/d/Y', $phpdate);?></strong></td>	
		</tr>	
	</table>
	<table border="0" cellspacing="0" cellpadding="0" width="780">	
		<tr>
			<td width="7%"></td><td width="5%"></td><td width="7%"></td><td width="6%"></td><td width="9%"></td><td width="7%"></td><td width="5%"></td>
			<td width="5%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="10%"></td>
		</tr>		
		<tr  bgcolor="gray">
			<td colspan="14" align="center"><b>ELIGIBILITY FOR SHS ENROLMENT</b></td>
		</tr>	
		<?php
			$resultGradeSchool = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['grade_stud_no']."' AND enrol_level='10')");
			$dataGradeSchool = dbarray($resultGradeSchool);
		?>	
		<tr>
			<td colspan="4"><input type="checkbox" checked style="width: 10px; height: 10px;"> <?php echo $dataGradeSchool['enrol_eligibility'];?> *</td>
			<td colspan="2" align="right">Gen. Ave. / Rating:  &nbsp; &nbsp;</td>
			<td style="border-bottom: 1px solid; text-align: center"> <strong><?php echo round($dataGradeSchool['enrol_average'],0);?></strong></td>	
			<td colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date of Graduation/ Completion/ Assessment/ Examination (MM/DD/YYYY):  &nbsp;</td>
			<td colspan="2" style="border-bottom: 1px solid; text-align: center"> <strong><?php $phpdate = strtotime($dataGradeSchool['enrol_graddate']); echo $mysqldate = date('m/d/Y', $phpdate);?></strong></td>		
		</tr>	
		<tr>
			<td colspan="4" align="right">Name of School / Learning Center - Address:  &nbsp; &nbsp;</td>
			<?php
			$dataEnrollmentSchool = unserialize($dataGradeSchool['enrol_school']);
			?>
			<td colspan="10" style="border-bottom: 1px solid;"> <strong><?php echo strtoupper($dataEnrollmentSchool['1']);?> (<?php echo strtoupper($dataEnrollmentSchool['0']);?>) - <?php echo strtoupper($dataEnrollmentSchool['2']);?></strong></td>
		</tr>		
		<tr>
			<td width="7%"></td><td width="5%"></td><td width="7%"></td><td width="6%"></td><td width="9%"></td><td width="7%"></td><td width="5%"></td>
			<td width="5%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="10%"></td>
		</tr>		
		<tr  bgcolor="gray">
			<td colspan="14" align="center"><b>SCHOLASTIC RECORD</b></td>
		</tr>		
	</table>
	<?php
	$resultForm137 = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['grade_stud_no']."' AND enrol_level>'10') ORDER BY enrol_level ASC");
	$rowCounter = 0;
	while($dataForm137 = dbarray($resultForm137)){
		$dataEnrollmentSchool = unserialize($dataForm137['enrol_school']);
		$enrol_sy = $dataForm137['enrol_sy'];
		$resultGradeOAll = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['grade_stud_no']."' and grade_sy='".$enrol_sy."') GROUP BY grade_sem ORDER BY grade_sem ASC, pros_sort ASC");
		while($dataGradeOAll = dbarray($resultGradeOAll)){
			
		?>
			<table border="0" cellspacing="0" cellpadding="0" width="780"><tr><td>
			<table border="0" cellspacing="1" cellpadding="0" width="780">
				<tr height="30">
					<td>
					SCHOOL: &nbsp;<u><strong><?php echo strtoupper($dataEnrollmentSchool['1']);?></strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					SCHOOL ID: &nbsp;<u><strong><?php echo $dataEnrollmentSchool['0'];?></strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					GRADE LEVEL: &nbsp;<u><strong><?php echo $dataForm137['enrol_level'];?></strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					S.Y.: &nbsp;<u><strong><?php echo round($dataForm137['enrol_sy'],0);?>-<?php echo round($dataForm137['enrol_sy'],0)+1;?></strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Semester: &nbsp;<u><strong><?php echo ($dataGradeOAll['grade_sem']==1?"First Semester":"Second Semester");?></strong></u><br>
					<?php
						$resultCheckSection = dbquery("select * from section where (section_name='".$dataForm137['enrol_section']."' and section_sy='".$dataForm137['enrol_sy']."')");
						$dataCheckSection = dbarray($resultCheckSection);
					?>
					TRACK/STRAND: &nbsp;<u><strong><?php echo (strtoupper($dataForm137['enrol_track'])==""?"<input type=\"text\" style=\"width: 120px; border: 0px; font-weight: bold !important; border-bottom: 1px solid black ; font-size: 10px; text-align: left;\">":strtoupper($dataForm137['enrol_track'])." - ".strtoupper($dataForm137['enrol_strand'])." (".strtoupper($dataForm137['enrol_combo']).")");?></strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php
					$checkAdviser = dbquery("SELECT * FROM users WHERE user_no='".$dataCheckSection['section_adviser']."'");
					$dataAdviser = dbarray($checkAdviser );
					?>
					SECTION: &nbsp;<u><strong><?php echo ($dataForm137['enrol_section']==""?"<input type=\"text\" style=\"width: 120px; border: 0px; font-weight: bold !important; border-bottom: 1px solid black ; font-size: 10px; text-align: left;\">":$dataForm137['enrol_section']);?></strong></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<!--ADVISER: &nbsp;<u><strong><?php echo ($dataAdviser['user_fullname']==""?"<input type=\"text\" style=\"width: 120px; border: 0px; font-weight: bold !important; border-bottom: 1px solid black ; font-size: 10px; text-align: left;\">":($dataAdviser['user_no']=="1"?"TBA":strtoupper($dataAdviser['user_fullname'])));?></strong></u> -->
					</td>
				</tr>
			<tr><td valign="top" colspan="2">
			<table border="1" cellspacing="0" cellpadding="1" width="780">

				<tr height="22" bgcolor="lightgray">
					<th rowspan="2" width="13%"><small>Indicate if Subject is CORE, APPLIED, or SPECIALIZED</small></th>
					<th rowspan="2">SUBJECTS</th>
					<th colspan="2" width="14%">Quarter</th>
					<th rowspan="2" width="8%">SEM FINAL GRADE</th>
					<th rowspan="2" width="7%">ACTION TAKEN</th>		
				</tr>
				<tr bgcolor="lightgray">
					<th width="7%">1</th>
					<th width="7%">2</th>
				</tr>
				<?php
				$prosTotal=0;
				$gradedUnits1=0;
				$gradedUnits2=0;
				$gradedUnitsqf=0;
				$countUnits=0;
				$resultGrade1 = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['grade_stud_no']."' and class.class_sy='".$dataForm137['enrol_sy']."' and grade_sem='".$dataGradeOAll['grade_sem']."') ORDER BY grade_sem ASC, pros_sort ASC");
				$counter=0;
				$aveQ1=0;
				$aveQ2=0;
				$aveQf=0;
				while($dataGrade1 = dbarray($resultGrade1)){
				?>
				<tr height="17">
					<td><?php echo ($dataGrade1['pros_track']=="SHS GENERAL"?"CORE":($dataGrade1['pros_track']=="SHS APPLIED"?"APPLIED":"SPECIALIZED"));?></td>
					<td><?php echo $dataGrade1['pros_desc']; ?> </td>
						<td align="center"><?php echo ($dataGrade1['grade_q1']==0?"-":$dataGrade1['grade_q1']); ?></td>
					<td align="center"><?php echo ($dataGrade1['grade_q2']==0?"-":$dataGrade1['grade_q2']); ?></td>
					<td align="center"><?php echo ($dataGrade1['grade_final']==0 || $dataGrade1['grade_q2']==0 ?"-":$dataGrade1['grade_final']); ?></td>
					<td align="center"><?php echo ($dataGrade1['grade_final']==0 || $dataGrade1['grade_q2']==0 ?"-":($dataGrade1['grade_final']>=74.5?"PASSED":"FAILED"));?></td>
				</tr>
				<?php 
				$countUnits+=$dataGrade1['pros_unit'];
				$aveQ1 += ($dataGrade1['grade_q1']*$dataGrade1['pros_unit']);
				$aveQ2 += ($dataGrade1['grade_q2']*$dataGrade1['pros_unit']);
				$aveQf += ($dataGrade1['grade_final']*$dataGrade1['pros_unit']);
				if($dataGrade1['grade_q1']<60){
					$gradedUnits1+=0;
				} else {
					$gradedUnits1+=$dataGrade1['pros_unit'];
				}
				if($dataGrade1['grade_q2']<60){
					$gradedUnits2+=0;
				}else {
					$gradedUnits2+=$dataGrade1['pros_unit'];
				}
				if($dataGrade1['grade_final']<60){
					$gradedUnitsqf+=0;
				}
				else {
					$gradedUnitsqf+=$dataGrade1['pros_unit'];
				}
				$counter++;
				} 
				if($countUnits==0){
					$countUnits=1;
				}
				while($counter<=9){
					echo "<tr  height=\"17\" align=\"center\"><td align=\"left\">-x-0-x-</td><td align=\"left\">-x-NOTHING FOLLOWS-x-</td><td>-x-0-x-</td><td>-x-0-x-</td><td>-x-0-x-</td><td>-x-0-x-</td></tr>";
					$counter++;
				}
				?>
				<tr height="20">
					<td height="0" align="right" colspan="4" bgcolor="lightgray"><strong>General Average for the Semester</strong></td>
					<td align="center"><strong><?php echo (($countUnits!=$gradedUnits1 || $countUnits!=$gradedUnits2)?"-":round($aveQf/$countUnits,0));?></strong></td>
					<td align="center"><strong></strong></td>
				</tr>
			</table>
			</td>
			</tr>
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr><td width="8%" align="right">REMARKS &nbsp;</td><td colspan="3" style="BORDER-BOTTOM: black solid 1px"> <input type="text" style="width: 550px; border: 0px; font-weight: bold !important; font-size: 10px" value="<?php echo ($dataForm137['enrol_status1']=="PROMOTED"?$dataForm137['enrol_status2']:"NONE");?>" placeholder=""></td></tr>
					</table>		
				</td>
			</tr>
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr><td width="33%">Prepared by:</td><td width="33%">Certified True and Correct:</td><td width="33%">Date Checked (MM/DD/YYYY):</td></tr>
					<tr height="25" valign="bottom"><td align="center"><strong><?php echo ($dataAdviser['user_fullname']==""?"<input type=\"text\" style=\"width: 120px; border: 0px; font-weight: bold !important; border-bottom: 1px solid black ; font-size: 10px; text-align: left;\">":strtoupper($dataAdviser['user_fullname']));?></strong><br>Class Adviser</td><td align="center"><strong><?php echo strtoupper($current_registrar);?></strong><br>School Registrar</td><td align="center"><u><strong><?php echo ($countUnits!=$gradedUnits1?"________________":date('m/d/Y',  strtotime($dataForm137['enrol_updatedate']))); ?></u></strong><br>&nbsp;</td></tr>
					</table>		

						<table width="100%" border="1" cellspacing="0" cellpadding="1">
						<tr height="22">
						<?php
								$resultGrade1 = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['grade_stud_no']."' and class.class_sy='".$dataForm137['enrol_sy']."' and grade_sem='".$dataGradeOAll['grade_sem']."' and grade_remedialgrade>=60) ORDER BY grade_sem ASC, pros_sort ASC");
								$dataRemedial = dbarray($resultGrade1);
								$fulltext = (isset($dataRemedial['grade_notes']) ? $dataRemedial['grade_notes'] : "");
								$len = strlen($fulltext);
								$pos_from = strpos($fulltext,"From:");
								$pos_from = $pos_from+5;
								$from = substr($fulltext,$pos_from,10);
								$pos_to= strpos($fulltext,"To:");
								$pos_to = $pos_to+3;
								$to = substr($fulltext,$pos_to,10);
								$pos_from = strpos($fulltext,"From:");
								$school = trim(substr($fulltext,0,$pos_from));				
						?>
							<td colspan="6">
							REMEDIAL CLASSES
							Conducted from (MM/DD/YYYY): &nbsp;<u><strong><?php echo ($from==""?"______":date('m-d-Y',strtotime($from)));?></strong></u> &nbsp;&nbsp;
							to (MM/DD/YYYY): &nbsp;<u><strong><?php echo ($to==""?"______":date('m-d-Y',strtotime($to)));?></strong></u> &nbsp;&nbsp;
							SCHOOL: &nbsp;<u><strong><?php echo ($school==""?"______________________________________":$school);?></strong></u> &nbsp;&nbsp;
							SCHOOL ID: &nbsp;<u><strong><?php echo ($dataRemedial['grade_no']==""?"___________":$current_school_code);?></strong></u><br>
							</td>
						</tr>
						<tr bgcolor="lightgray">
							<th width="13%"><small>Indicate if Subject is CORE, APPLIED, or SPECIALIZED</small></th>
							<th>SUBJECTS</th>
							<th width="10%">SEM FINAL GRADE</th>
							<th width="10%">REMEDIAL CLASS MARK</th>
							<th width="10%">RECOMPUTED FINAL GRADE</th>
							<th width="10%">ACTION TAKEN</th>
						</tr>
						<?php
							$x=0;
							$resultRemedial1 = dbquery("select * from  grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no where (grade_stud_no='".$_GET['grade_stud_no']."' and grade_remedialgrade>=60 and grade_sem='".$dataGradeOAll['grade_sem']."' and grade_sy='".$dataGradeOAll['grade_sy']."') order by pros_sort asc");
							$countRemedial1 = dbrows($resultRemedial1);
							while($dataRemedial1 = dbarray($resultRemedial1)){
						?>
							<tr height="17">
								<td><?php echo ($dataRemedial1['pros_track']=="SHS GENERAL"?"CORE":($dataRemedial1['pros_track']=="SHS APPLIED"?"APPLIED":"SPECIALIZED"));?></td>
								<td><?php echo $dataRemedial1['pros_desc']; ?> </td>
								<td align="center"><?php echo ($dataRemedial1['grade_final']==0?"-":$dataRemedial1['grade_final']); ?></td>
								<td align="center"><?php echo ($dataRemedial1['grade_remedialgrade']==0?"-":$dataRemedial1['grade_remedialgrade']); ?></td>
								<td align="center"><?php echo ($dataRemedial1['grade_recomputedfinalgrade']==0?"-":$dataRemedial1['grade_recomputedfinalgrade']); ?></td>						
								<td align="center"><?php echo ($dataRemedial1['grade_finalremarks']==0?"FAILED":"PASSED");?></td>
							</tr>
							<?php	
							$x++;
							}
							while($x<3){
								echo "<tr height=\"17\" align=\"center\"><td align=\"left\"></td><td align=\"left\"></td><td></td><td></td><td></td><td></td></tr>";
								$x++;
							}
							?>
						</table>
						<table width="780" border="0">
							<tr>
								<td width="13%">Name Adviser/Registrar:</td>
								<td width="48%" colspan="3"  align="left"><b><?php echo ($countRemedial1>0?$current_registrar:"______________________________________");?></b></td>
								<td width="13%" align="right">Signature:</td>
								<td style="border-bottom: 1px solid;"> </td>		
							</tr>			
						</table>
				</td>
			</tr>
			</table>
			</td></tr>
			</table>
			<?php
			$rowCounter++;		
			if($rowCounter==2){
				?><br>
				<table width="780">
					<tr>
						<td align="left"><strong><i>Form 137 for <strong><?php echo strtoupper($dataStudent['stud_lname'].", ".$dataStudent['stud_fname']." ".$dataStudent['stud_xname']." ".$dataStudent['stud_mname']);?> (<?php echo $dataStudent['stud_lrn'];?>)</strong></i></strong></td>
						<td align="right"><strong><i>FORM 137-SHS</strong></i></strong></td>
					</tr>
				</table>	
			
				<?php
				}
		}
	}	
			if($rowCounter<2){
				?>
				<br>
				<table width="780">
					<tr>
						<td align="left"><strong><i>Form 137 for <strong><?php echo strtoupper($dataStudent['stud_lname'].", ".$dataStudent['stud_fname']." ".$dataStudent['stud_xname']." ".$dataStudent['stud_mname']);?> (<?php echo $dataStudent['stud_lrn'];?>)</strong></i></strong></td>
						<td align="right"><strong><i>FORM 137-SHS</strong></i></strong></td>
					</tr>
				</table>
				<?php
			}
			while($rowCounter<4){
				blankSheet();
				$rowCounter++;
			}
		

	
	function blankSheet(){
?>
		<table border="0" cellspacing="0" cellpadding="0" width="780"><tr><td>
		<table border="0" cellspacing="1" cellpadding="0" width="780">
			<tr height="35">
				<td>
				SCHOOL: &nbsp;<u><strong>_____________________________</strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				SCHOOL ID: &nbsp;<u><strong>________</strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				GRADE LEVEL: &nbsp;<u><strong>________</strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				S.Y.: &nbsp;<u><strong>________</strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Semester: &nbsp;<u><strong>________</strong></u><br>
				TRACK/STRAND: &nbsp;<u><strong>______________________________________________</strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				SECTION: &nbsp;<u><strong>________________</strong></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<!-- ADVISER: &nbsp;<u><strong>_____________________</strong></u> -->
				</td>
			</tr>
		<tr><td valign="top" colspan="2">
		<table border="1" cellspacing="0" cellpadding="1" width="100%">

			<tr height="20" bgcolor="lightgray">
				<th rowspan="2" width="13%"><small>Indicate if Subject is CORE, APPLIED, or SPECIALIZED</small></th>
				<th rowspan="2">SUBJECTS</th>
				<th colspan="2" width="14%">Quarter</th>
				<th rowspan="2" width="8%">SEM FINAL GRADE</th>
				<th rowspan="2" width="7%">ACTION TAKEN</th>		
			</tr>
			<tr bgcolor="lightgray">
				<th width="7%">1</th>
				<th width="7%">2</th>
			</tr>
			<?php
			$counter = 1;
			while($counter<=9){
				echo "<tr  height=\"18\" align=\"center\"><td align=\"left\"></td><td align=\"left\"></td><td></td><td></td><td></td><td></td></tr>";
				$counter++;
			}
			?>
			<tr>
				<td height="0" align="right" colspan="4" bgcolor="lightgray"><strong>General Average for the Semester</strong></td>
				<td align="center"><strong></strong></td>
				<td align="center"><strong></strong></td>
			</tr>
		</table>
		</td>
		</tr>
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td width="8%" align="right">REMARKS &nbsp;</td><td colspan="3" style="BORDER-BOTTOM: black solid 1px"></td></tr>
				</table>		
			</td>
		</tr>
		<tr>
			<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td width="33%">Prepared by:</td><td width="33%">Certified True and Correct:</td><td width="33%">Date Checked (MM/DD/YYYY):</td></tr>
			<tr height="30" valign="bottom"><td align="center"><u><strong>_____________________________</u></strong><br>Signature of Adviser over Printed Name</td><td align="center"><u><strong>____________________________________________</u></strong><br>Signature of Authorized Person over Printed Name, Designation</td><td align="center"><u><strong>_____________________________	</u></strong><br>&nbsp;</td></tr>
			</table>	

				<table width="100%" border="1" cellspacing="0" cellpadding="1">
				<tr height="22">
					<td colspan="6">
					REMEDIAL CLASSES
					Conducted from (MM/DD/YYYY): &nbsp;<u><strong>______</strong></u> &nbsp;&nbsp;
					to (MM/DD/YYYY): &nbsp;<u><strong>______</strong></u> &nbsp;&nbsp;
					SCHOOL: &nbsp;<u><strong>______________________________________</strong></u> &nbsp;&nbsp;
					SCHOOL ID: &nbsp;<u><strong>___________</strong></u><br>
					</td>
				</tr>
				<tr bgcolor="lightgray">
					<th width="13%"><small>Indicate if Subject is CORE, APPLIED, or SPECIALIZED</small></th>
					<th>SUBJECTS</th>
					<th width="10%">SEM FINAL GRADE</th>
					<th width="10%">REMEDIAL CLASS MARK</th>
					<th width="10%">RECOMPUTED FINAL GRADE</th>
					<th width="10%">ACTION TAKEN</th>
				</tr>
				<?php
					$x=0;
					while($x<3){
						echo "<tr align=\"center\"><td align=\"left\"></td><td align=\"left\"></td><td></td><td></td><td></td><td></td></tr>";
						$x++;
					}
					?>
				</table>
				<table width="780" border="0">
					<tr>
						<td width="18%">Name of Teacher/Adviser:</td>
						<td colspan="3" style="border-bottom: 1px solid;" align="center"><b></b></td>
						<td width="13%" align="right">Signature:</td>
						<td style="border-bottom: 1px solid;"> </td>		
					</tr>			
				</table>	
		</td>
		</tr>
		</table>
		</td></tr>
		</table>
		<?php
		}
		?>
	
	<hr>
	<table width="780" border="0">
	<tr>
		<td width="15%">Track/Strand Accomplished: </td>
		<?php
		$resultForm137 = dbquery("SELECT * FROM studenroll INNER JOIN section ON enrol_section=section_name WHERE (enrol_stud_no='".$_GET['grade_stud_no']."' AND enrol_level=12)");
		$dataForm137 = dbarray($resultForm137)
		?>
		<td width="48%" style="border-bottom: 1px solid;"><input type="text" style="width: 300px; border: 0px; font-weight: bold !important; font-size: 8px; text-align: left;" value="<?php echo $dataForm137['enrol_track'];?> - <?php echo $dataForm137['enrol_strand'];?>"></td>
		<td align="right">SHS General Average: </td>
		<?php
		$resultAverage = dbquery("select * from grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no where (grade_stud_no='".$_GET['grade_stud_no']."' and pros_level>10)");
		$totalunits = 0;
		$totalgrades = 0;
		while($dataAverage = dbarray($resultAverage)){
			$subgrades = ($dataAverage['grade_recomputedfinalgrade']>0 || $dataAverage['grade_recomputedfinalgrade']!=NULL?$dataAverage['grade_recomputedfinalgrade']:$dataAverage['grade_final']);
			$totalunits = $totalunits + ($subgrades<60?0:$dataAverage['pros_unit']);
			$totalgrades = $totalgrades + ($subgrades<60?0:($subgrades*$dataAverage['pros_unit']));
		}
		$totalunits = ($totalunits==0?1:$totalunits);
		$average = round($totalgrades/$totalunits,0);

		?>
		
		<td width="14%" align="center" style="border-bottom: 1px solid;"><input type="text" style="width: 70px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value="<?php echo ($dataForm137['enrol_status2']=="GRADUATED"?$average:"");?>"></td>
	</tr>
	<tr height="17">
		<td>Awards/Honors Received:</td>
		<td style="border-bottom: 1px solid;"><input type="text" style="width: 300px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: left;" value="<?php echo $dataForm137['enrol_gradawards'];?>"></td>
		<td align="center">Date of SHS Graduation (MM/DD/YYYY): </td>
		<td align="center" style="border-bottom: 1px solid;"><input type="text" style="width: 70px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: left;" value="<?php echo ($dataForm137['enrol_status2']=="GRADUATED"?date('m/d/Y',  strtotime($dataForm137['enrol_graddate'])):"");?>"></td>
	</tr>
	<tr>
		<td colspan="2" align="left"><br>Certified by:<br>
			<table width="100%"  cellpadding="0" cellspacing="0">
				<tr>
					<td width="65%" align="center"><input type="text" style="width: 200px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value="<?php echo strtoupper($current_principal);?>"><br>Signature of School Head over Printed Name</td>
					<td align="center"><input type="text" style="width: 65px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: left;" value="<?php echo ($dataForm137['enrol_status2']=="GRADUATED"?date('m/d/Y',  strtotime($dataForm137['enrol_graddate'])):"____________");?>"><br>Date</td>
				</tr>
				<tr>
					<td colspan="2" style="border-bottom: 1px solid; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;">
					<strong>NOTE:</strong><br><small>
					<i>
					&nbsp;&nbsp;&nbsp;This permanent record or photocopy of this permanent record that bears the seal of the school and the original signature in ink
					of the School Head shall be considered valid for all legal purposes. Any erasure or alteration made on this copy should be validated
					by the School Head.
					<br>
					&nbsp;&nbsp;&nbsp;If the student transfers to another school, the originating school should produce one (1) certified true copy of this permanent
					record for safekeeping. The receiving school shall continue filling up the original form.
					<br>
					&nbsp;&nbsp;&nbsp;Upon graduation, the school from which the student graduated should keep the original form and produce one (1) certified true 
					copy for the Division Office.
					</i></small>
					</td>
				</tr>
			</table>
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td width="60%" align="left">Purpose: <input type="text" style="width: 400px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: left;" value="Further studies."><br>
					Date Issued (MM/DD/YYYY): <input type="text" style="width: 65px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: left;" value="<?php echo date('m/d/Y');?>">
					</td>
				</tr>
				<tr>
					<td width="60%" align="left"></td>
				</tr>
			</table>
		</td>
		<td colspan="2" style="border-left: 1px solid;" valign="top"><br>Place School Seal Here:</th>
	</tr>
	</table>
<br><br>

<table width="780">
	<tr>
		<td align="left" style="border-bottom: 1px solid;"><strong><i>ANNEX for <strong><?php echo $dataStudent['stud_lname'].", ".$dataStudent['stud_fname']." ".$dataStudent['stud_xname']." ".$dataStudent['stud_mname'];?> (<?php echo $dataStudent['stud_lrn'];?>)</strong></i></strong></td>
		<td align="right" style="border-bottom: 1px solid;"><strong><i>SF10-SHS</strong></i></strong></td>
	</tr>
	<tr>
		<td colspan="2"><br><b>ANNEX: LIST OF SUBJECTS TAKEN</b><br><i>Please check the subjects taken by the student</i></td>
	</tr>
	<tr>
		<td colspan="2"><b>CORE SUBJECTS (1,200 Hours)</b>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<?php
				$checkCore = dbquery("select * from prospectus where pros_track='SHS GENERAL' and pros_part='1' order by pros_title asc");
				while($dataCore=dbarray($checkCore)){
					if(substr($dataCore['pros_desc'],0,9)=="Immersion" || substr($dataCore['pros_desc'],0,4)=="Shop"){}
					else{
						$checkGrade = dbquery("select * from grade inner join class on grade_class_no=class_no inner join prospectus on class_pros_no=pros_no where (grade_stud_no='".$_GET['grade_stud_no']."' and pros_no='".$dataCore['pros_no']."')");
						$dataGrade = dbarray($checkGrade);
						$countGrade = dbrows($checkGrade);
						$grade_final = (isset($dataGrade['grade_final']) ? $dataGrade['grade_final'] : 0);
						?>
						<tr><td width="3%"><input type="checkbox" <?php echo ($countGrade>0 || $grade_final>=75?"checked disabled":"");?>></td><td><?php echo $dataCore['pros_desc'];?></td></tr>
						<?php
					}
				}
					?>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2"><b>APPLIED SUBJECTS (560 Hours)</b>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<?php
				$checkCore = dbquery("select * from prospectus where pros_track='SHS APPLIED' and pros_part='1' order by pros_title asc");
				while($dataCore=dbarray($checkCore)){
					$checkGrade = dbquery("select * from grade inner join class on grade_class_no=class_no inner join prospectus on class_pros_no=pros_no where (grade_stud_no='".$_GET['grade_stud_no']."' and pros_no='".$dataCore['pros_no']."')");
					$dataGrade = dbarray($checkGrade);
					$countGrade = dbrows($checkGrade);
					$grade_final = (isset($dataGrade['grade_final']) ? $dataGrade['grade_final'] : 0);
				?>
					<tr><td width="3%"><input type="checkbox" <?php echo ($countGrade>0 || $grade_final>=75?"checked disabled":"");?>></td><td><?php echo $dataCore['pros_desc'];?></td></tr>
				<?php
				}
				?>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2"><b>SPECIALIZED SUBJECTS (720 Hours Only)</b>
		<?php
		
		$checkEnrollment = dbquery("select * from studenroll where (enrol_stud_no='".$_GET['grade_stud_no']."') order by enrol_sy desc");
		$dataEnrollment = dbarray($checkEnrollment);
		$pros= substr($dataEnrollment['enrol_strand'],strlen($dataEnrollment['enrol_strand'])-2,strlen($dataEnrollment['enrol_strand']));
		?>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<?php
				$checkCore = dbquery("select * from prospectus where (pros_track LIKE '%$pros%' and pros_part='1') order by pros_title asc");
				while($dataCore=dbarray($checkCore)){
					$checkGrade = dbquery("select * from grade inner join class on grade_class_no=class_no inner join prospectus on class_pros_no=pros_no where (grade_stud_no='".$_GET['grade_stud_no']."' and pros_no='".$dataCore['pros_no']."')");
					$dataGrade = dbarray($checkGrade);
					$countGrade = dbrows($checkGrade);
					$grade_final = (isset($dataGrade['grade_final']) ? $dataGrade['grade_final'] : 0);
				?>
					<tr><td width="3%"><input type="checkbox" <?php echo ($countGrade>0 || $grade_final>=75?"checked disabled":"");?>></td><td><?php echo $dataCore['pros_desc'];?></td></tr>
				<?php
				}
				?>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2"><b>OTHER SUBJECTS</b>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<?php
				$checkCore = dbquery("select * from prospectus where pros_track='SHS GENERAL' and pros_part='1' and (pros_desc like '%Immersion%' OR pros_desc like '%shop%') order by pros_title asc");
				while($dataCore=dbarray($checkCore)){
					$checkGrade = dbquery("select * from grade inner join class on grade_class_no=class_no inner join prospectus on class_pros_no=pros_no where (grade_stud_no='".$_GET['grade_stud_no']."' and pros_no='".$dataCore['pros_no']."')");
					$dataGrade = dbarray($checkGrade);
					$countGrade = dbrows($checkGrade);
					$grade_final = (isset($dataGrade['grade_final']) ? $dataGrade['grade_final'] : 0);
				?>
					<tr><td width="3%"><input type="checkbox" <?php echo ($countGrade>0 || $grade_final>=75?"checked disabled":"");?>></td><td><?php echo $dataCore['pros_desc'];?></td></tr>
				<?php
				}
				?>
			</table><br>
		
		</td>
	</tr>
</table>
