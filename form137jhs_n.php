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
			<td width="7%">SF10-JHS</td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td>
			<td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td colspan="2" align="right"><b></b></td>
		</tr>	
		<tr align="center">
			<td colspan="3" rowspan="2" align="left"><img src="./assets/images/deped_logo.png" width="80"></td>
			<td colspan="8">Republic of the Philippines<br>Department of Education</td>
			<td colspan="3" rowspan="2" align="right">
			<img src="./assets/images/deped_word.png" alt="" style="max-width:140px" border="0"/><br>
			</td>
		</tr>
		<tr>
			<td colspan="8" align="center" valign="middle"><h3>Learner's Permanent Academic Record for Junior High School (SF10-JHS)</h3><i>(Formerly Form 137)</i></td>
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
			<td style="border-bottom: 1px solid;" > <strong><?php echo $dataStudent['stud_gender'];?></strong></td>
			<td colspan="3" ></td>
			<!--<td colspan="3" align="right">Date of SHS Admission (MM/DD/YYYY): &nbsp; &nbsp; </td> 
			<?php
				$resultSHSAdm = dbquery("select * from studenroll where (enrol_stud_no='".$_GET['grade_stud_no']."' and enrol_level>10) limit 0,1");
				$dataSHSAdm = dbarray($resultSHSAdm );
			?>
			<td style="border-bottom: 1px solid;"> <strong><?php $phpdate = strtotime($dataSHSAdm['enrol_admitdate']); echo $mysqldate = date('m/d/Y', $phpdate);?></strong></td>-->	
		</tr>	
	</table>
	<table border="0" cellspacing="0" cellpadding="0" width="780">	
		<tr>
			<td width="7%"></td><td width="5%"></td><td width="7%"></td><td width="6%"></td><td width="9%"></td><td width="7%"></td><td width="5%"></td>
			<td width="5%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="10%"></td>
		</tr>		
		<tr  bgcolor="gray">
			<td colspan="14" align="center"><b>ELIGIBILITY FOR JHS ENROLMENT</b></td>
		</tr>	
		<?php
			$resultGradeSchool = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['grade_stud_no']."' AND enrol_level='6')");
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
			<td colspan="6" align="right">Name of School / Testing Center - School ID (Except ALS & PEPT) - Address:  &nbsp; &nbsp;</td>
			<?php
			$dataEnrollmentSchool = unserialize($dataGradeSchool['enrol_school']);
			?>
			<td colspan="8" style="border-bottom: 1px solid;"> <strong><?php echo strtoupper($dataEnrollmentSchool['1']);?> - <?php echo strtoupper($dataEnrollmentSchool['0']);?> - <?php echo strtoupper($dataEnrollmentSchool['2']);?></strong></td>
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
	$resultForm137 = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['grade_stud_no']."' AND enrol_level>'6' and enrol_level<'11') ORDER BY enrol_level ASC, enrol_sy asc");
	$rowCounter = 0;
	$enrol_status2="";
	while($dataForm137 = dbarray($resultForm137)){
		$dataEnrollmentSchool = unserialize($dataForm137['enrol_school']);
		$enrol_sy = $dataForm137['enrol_sy'];
		$enrol_status2 = $dataForm137['enrol_status2'];
		$resultGradeOAll = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['grade_stud_no']."' and grade_sy='".$enrol_sy."') GROUP BY grade_sem ORDER BY grade_sem ASC, pros_sort ASC");
		while($dataGradeOAll = dbarray($resultGradeOAll)){

		?>
			<table border="0" cellspacing="0" cellpadding="0" width="780"><tr><td>
			<table border="0" cellspacing="1" cellpadding="0" width="780">
				<tr height="30">
					<td>
					School: &nbsp;<u><strong><?php echo $dataEnrollmentSchool['1'];?></strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					School ID: &nbsp;<u><strong><?php echo $dataEnrollmentSchool['0'];?></strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					District: &nbsp;<u><strong><?php echo ($dataEnrollmentSchool['0']==$current_school_code?$current_school_district:"<input type=\"text\" style=\"width: 65px; border: 0px; font-weight: bold !important; border-bottom: 1px solid black ; font-size: 10px; text-align: left;\">");?></strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Division: &nbsp;<u><strong><?php echo ($dataEnrollmentSchool['0']==$current_school_code?$current_school_division:"<input type=\"text\" style=\"width: 65px; border: 0px; font-weight: bold !important; border-bottom: 1px solid black ; font-size: 10px; text-align: left;\">");?></strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Region: &nbsp;<u><strong><?php echo $current_school_reg_code;?></strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
					Classified as Grade: &nbsp;<u><strong><?php echo ($dataForm137['enrol_level']!=""?$dataForm137['enrol_level']:"<input type=\"text\" style=\"width: 65px; border: 0px; font-weight: bold !important; border-bottom: 1px solid black ; font-size: 10px; text-align: left;\">");?></strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Section: &nbsp;<u><strong><?php echo ($dataForm137['enrol_section']==""?"<input type=\"text\" style=\"width: 65px; border: 0px; font-weight: bold !important; border-bottom: 1px solid black ; font-size: 10px; text-align: left;\">":$dataForm137['enrol_section']);?></strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					School Year: &nbsp;<u><strong><?php echo round($dataForm137['enrol_sy'],0);?>-<?php echo round($dataForm137['enrol_sy'],0)+1;?></strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php
					$resultCheckSection = dbquery("select * from section where (section_name='".$dataForm137['enrol_section']."' and section_sy='".$dataForm137['enrol_sy']."')");
					$dataCheckSection = dbarray($resultCheckSection);
					$checkAdviser = dbquery("SELECT * FROM users WHERE user_no='".$dataCheckSection['section_adviser']."'");
					$dataAdviser = dbarray($checkAdviser );
					?>
					Name of Adviser/Teacher: &nbsp;<u><strong><?php echo ($dataAdviser['user_fullname']==""?"<input type=\"text\" style=\"width: 120px; border: 0px; font-weight: bold !important; border-bottom: 1px solid black ; font-size: 10px; text-align: left;\">":($dataAdviser['user_no']=="1"?"TBA":strtoupper($dataAdviser['user_fullname'])));?></strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
					Signature: &nbsp;<u><strong>_____________________</strong></u> 	
					</td>
				</tr>
			<tr><td valign="top" colspan="2">
			<table border="1" cellspacing="0" cellpadding="1" width="780">

				<tr height="22" bgcolor="lightgray">
					<th rowspan="2">LEARNING AREAS</small></th>
					<th colspan="4" width="14%">Quarterly Rating</th>
					<th rowspan="2" width="12%">FINAL RATING</th>
					<th rowspan="2" width="20%">REMARKS</th>		
				</tr>
				<tr bgcolor="lightgray">
					<th width="7%">1</th>
					<th width="7%">2</th>
					<th width="7%">3</th>
					<th width="7%">4</th>
				</tr>
				<?php
				$prosTotal=0;
				$gradedUnits1=0;
				$gradedUnits2=0;
				$gradedUnits3=0;
				$gradedUnits4=0;
				$gradedUnitsqf=0;
				$countUnits=0;
				$resultGrade1 = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['grade_stud_no']."' and class.class_sy='".$dataForm137['enrol_sy']."' and grade_sem='".$dataGradeOAll['grade_sem']."') ORDER BY grade_sem ASC, pros_sort ASC");
				$counter=0;
				$aveQ1=0;
				$aveQ2=0;
				$aveQ3=0;
				$aveQ4=0;
				$aveQf=0;
				while($dataGrade1 = dbarray($resultGrade1)){
				?>
				<tr height="17">
					<td><?php echo $dataGrade1['pros_desc']; ?> </td>
					<td align="center"><?php echo ($dataGrade1['grade_q1']==0?"-":$dataGrade1['grade_q1']); ?></td>
					<td align="center"><?php echo ($dataGrade1['grade_q2']==0?"-":$dataGrade1['grade_q2']); ?></td>
					<td align="center"><?php echo ($dataGrade1['grade_q3']==0?"-":$dataGrade1['grade_q3']); ?></td>
					<td align="center"><?php echo ($dataGrade1['grade_q4']==0?"-":$dataGrade1['grade_q4']); ?></td>
					<td align="center"><?php echo ($dataGrade1['grade_final']==0 || $dataGrade1['grade_q2']==0 || $dataGrade1['grade_q3']==0 || $dataGrade1['grade_q4']==0?"-":$dataGrade1['grade_final']); ?></td>
					<td align="center"><?php echo ($dataGrade1['grade_final']==0 || $dataGrade1['grade_q2']==0 || $dataGrade1['grade_q3']==0 || $dataGrade1['grade_q4']==0?"-":($dataGrade1['grade_remarks']==1?"PASSED":"FAILED"));?></td>
				</tr>
				<?php 
				$countUnits+=$dataGrade1['pros_unit'];
				$aveQ1 += ($dataGrade1['grade_q1']*$dataGrade1['pros_unit']);
				$aveQ2 += ($dataGrade1['grade_q2']*$dataGrade1['pros_unit']);
				$aveQ3 += ($dataGrade1['grade_q3']*$dataGrade1['pros_unit']);
				$aveQ4 += ($dataGrade1['grade_q4']*$dataGrade1['pros_unit']);
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
				if($dataGrade1['grade_q3']<60){
					$gradedUnits3+=0;
				} else {
					$gradedUnits3+=$dataGrade1['pros_unit'];
				}
				if($dataGrade1['grade_q4']<60){
					$gradedUnits4+=0;
				} else {
					$gradedUnits4+=$dataGrade1['pros_unit'];
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
				while($counter<=13){
					echo "<tr  height=\"17\" align=\"center\"><td align=\"left\">-x-NOTHING FOLLOWS-x-</td><td>-x-0-x-</td><td>-x-0-x-</td><td>-x-0-x-</td><td>-x-0-x-</td><td>-x-0-x-</td><td>-x-0-x-</td></tr>";
					$counter++;
				}
				?>
				<tr height="20">
					<td height="0" align="right"  bgcolor="lightgray"></td>
					<td height="0" align="center" colspan="4" bgcolor="lightgray"><strong>General Average</strong></td>
					<td align="center"><strong><?php echo (($countUnits!=$gradedUnits1 || $countUnits!=$gradedUnits2 || $countUnits!=$gradedUnits3 || $countUnits!=$gradedUnits4)?"-":round($aveQf/$countUnits,0));?></strong></td>
					<td align="center"><strong></strong></td>
				</tr>
			</table>
			</td>
			</tr>
			<tr>
				<td>
						<table width="100%" border="1" cellspacing="0" cellpadding="1">
						<tr height="22">
						<?php
								$resultGrade1 = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['grade_stud_no']."' and class.class_sy='".$dataForm137['enrol_sy']."' and grade_sem='".$dataGradeOAll['grade_sem']."' and grade_remedialgrade>=60) ORDER BY grade_sem ASC, pros_sort ASC");
								$dataRemedial = dbarray($resultGrade1);
								$fulltext = $dataRemedial['grade_notes'];
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
							<td>
							REMEDIAL CLASSES
							</td>
							<td colspan="5">
							Conducted from (MM/DD/YYYY): &nbsp;<u><strong><?php echo ($from==""?"________":date('m-d-Y',strtotime($from)));?></strong></u> &nbsp;&nbsp;
							to (MM/DD/YYYY): &nbsp;<u><strong><?php echo ($to==""?"________":date('m-d-Y',strtotime($to)));?></strong></u> &nbsp;&nbsp;
							</td>
						</tr>
						<tr bgcolor="lightgray">
							<th>Learning Areas</th>
							<th width="15%">Final Rating</th>
							<th width="15%">Remedial Class Mark</th>
							<th width="15%">Recomputed Final Grade</th>
							<th width="15%">Remarks</th>
						</tr>
						<?php
							$x=0;
							$resultRemedial1 = dbquery("select * from  grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no where (grade_stud_no='".$_GET['grade_stud_no']."' and grade_remedialgrade>=60 and grade_sem='".$dataGradeOAll['grade_sem']."' and grade_sy='".$dataGradeOAll['grade_sy']."') order by pros_sort asc");
							$countRemedial1 = dbrows($resultRemedial1);
							while($dataRemedial1 = dbarray($resultRemedial1)){
						?>
							<tr height="17">
								<td><?php echo $dataRemedial1['pros_desc']; ?> </td>
								<td align="center"><?php echo ($dataRemedial1['grade_final']==0?"-":$dataRemedial1['grade_final']); ?></td>
								<td align="center"><?php echo ($dataRemedial1['grade_remedialgrade']==0?"-":$dataRemedial1['grade_remedialgrade']); ?></td>
								<td align="center"><?php echo ($dataRemedial1['grade_recomputedfinalgrade']==0?"-":$dataRemedial1['grade_recomputedfinalgrade']); ?></td>						
								<td align="center"><?php echo ($dataRemedial1['grade_finalremarks']==0?"FAILED":"PASSED");?></td>
							</tr>
							<?php	
							$x++;
							}
							while($x<2){
								echo "<tr height=\"17\" align=\"center\"><td align=\"left\"></td><td align=\"left\"></td><td></td><td></td><td></td></tr>";
								$x++;
							}
							?>
						</table>
				</td>
			</tr>
			</table>
			</td></tr>
			</table>
			<?php
			$rowCounter++;		
		}
	}	
			if($rowCounter<4){
			while($rowCounter<4){
				if($rowCounter==2){
				?><br><br>
				<table width="780">
					<tr>
						<td align="left"><strong><i>SF10-JHS</i></strong></td>
						<td align="right"><strong><i>Page 2 of __</strong></i></strong></td>
					</tr>
				</table>	
			
				<?php
				}
				blankSheet();
				$rowCounter++;
			}
		}
	
	function blankSheet(){
?>
		<table border="0" cellspacing="0" cellpadding="0" width="780"><tr><td>
		<table border="0" cellspacing="1" cellpadding="0" width="780">
			<tr height="35">
				<td><br>
					School: &nbsp;<u><strong>___________________________</strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					School ID: &nbsp;<u><strong>____________</strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					District: &nbsp;<u><strong>____________</strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Division: &nbsp;<u><strong>____________</strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Region: &nbsp;<u><strong>____________</strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
					Classified as Grade: &nbsp;<u><strong>___</strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Section: &nbsp;<u><strong>_____________</strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					School Year: &nbsp;<u><strong>_________</strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Name of Adviser/Teacher: &nbsp;<u><strong>_____________________</strong></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
					Signature: &nbsp;<u><strong>____________________</strong></u> 
				</td>
			</tr>
		<tr><td valign="top" colspan="2">
		<table border="1" cellspacing="0" cellpadding="1" width="780">

				<tr height="22" bgcolor="lightgray">
					<th rowspan="2">LEARNING AREAS</small></th>
					<th colspan="4" width="14%">Quarterly Rating</th>
					<th rowspan="2" width="12%">FINAL RATING</th>
					<th rowspan="2" width="20%">REMARKS</th>		
				</tr>
				<tr bgcolor="lightgray">
					<th width="7%">1</th>
					<th width="7%">2</th>
					<th width="7%">3</th>
					<th width="7%">4</th>
				</tr>
				<?php
				$counter = 0;
				while($counter<=14){
					echo "<tr  height=\"17\" align=\"center\"><td align=\"left\"></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
					$counter++;
				}
				?>
				<tr height="20">
					<td height="0" align="right"  bgcolor="lightgray"></td>
					<td height="0" align="center" colspan="4" bgcolor="lightgray"><strong>General Average</strong></td>
					<td align="center"><strong></strong></td>
					<td align="center"><strong></strong></td>
				</tr>
			</table>
		</td>
		</tr>

		<tr>
			<td>
				<table width="100%" border="1" cellspacing="0" cellpadding="1">
						<tr height="22">
							<td>
							REMEDIAL CLASSES
							</td>
							<td colspan="5">
							Conducted from (MM/DD/YYYY): &nbsp;<u><strong>________</strong></u> &nbsp;&nbsp;
							to (MM/DD/YYYY): &nbsp;<u><strong>________</strong></u> &nbsp;&nbsp;
							</td>
						</tr>
						<tr bgcolor="lightgray">
							<th>Learning Areas</th>
							<th width="15%">Final Rating</th>
							<th width="15%">Remedial Class Mark</th>
							<th width="15%">Recomputed Final Grade</th>
							<th width="15%">Remarks</th>
						</tr>
						<?php
							$x=0;
							while($x<2){
								echo "<tr height=\"17\" align=\"center\"><td align=\"left\"></td><td align=\"left\"></td><td></td><td></td><td></td></tr>";
								$x++;
							}
							?>
						</table>
		</td>
		</tr>
		</table>
		</td></tr>
		</table>
		<?php
		}
		?>
	<table width="780" border="0">
		<tr><td>For Transfer Out /JHS Completer Only</td></tr>
	</table>
	<?php
		$resultForm137 = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['grade_stud_no']."' AND enrol_level<='".$current_school_maxlevel."') ORDER BY enrol_sy desc");
		$dataEnroll = dbarray($resultForm137);	

	?>
	<table width="780" border="1" cellpadding="0" cellspacing="0">
		<tr><td>
			<table width="100%">
				<tr><td align="center"><h2>CERTIFICATION</h2></td></tr>
				<tr><td align="left">I CERTIFY that this is a true record of <strong><u><?php echo strtoupper($dataStudent['stud_fname']." ".($dataStudent['stud_mname']=="-"?"":$dataStudent['stud_mname'])." ".$dataStudent['stud_lname']." ".$dataStudent['stud_xname']);?></u></strong> with LRN <strong><u><?php echo $dataStudent['stud_lrn'];?></u></strong> and that he/she is  eligible for admission to <u><input type="text" style="width: 50px; border: 0px; font-weight: bold !important; font-size: 10px"" value="Grade <?php echo ($dataEnroll['enrol_status2']=="PROMOTED"?($dataEnroll['enrol_level']+1).".":$dataEnroll['enrol_level'].".");?>"></u></td></tr>
				<tr><td align="left">Name of School: <strong><u><?php echo $current_school_name;?></u></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; School ID: <strong><u><?php echo $current_school_code;?></u></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Last School Year Attended: <strong><u><?php echo $dataEnroll['enrol_sy'];?>-<?php echo $dataEnroll['enrol_sy']+1;?></u></strong></td></tr>
				<tr><td align="left"></td></tr>
				<tr><td align="left">
				<table width="100%">
					<tr>
						<td align="center"><input type="text" style="width: 65px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: left;" value="<?php echo date('m/d/Y');?>"><br>Date</td>
						<td align="center"><strong><?php echo $current_principal;?></strong><br>School Principal</td>
						<td align="center"><br>(Affix School Seal here)</td>
					</tr>
				</table>
			</td></tr>
	</table>
	



