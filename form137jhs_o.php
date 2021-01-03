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
		<td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td>
	</tr>
	<tr align="center">
		<td colspan="2" rowspan="5"><img src="./assets/images/deped_logo.png" width="65"></td>
		<td colspan="10">Republic of the Philippines</td>
		<?php
		$student_image = "./assets/images/students/".$_GET['grade_stud_no'].".jpg";
		$no_image = "./assets/images/noimage.jpg";
		?>
		<td colspan="2" rowspan="5"><img src="<?php echo (file_exists($student_image) ? $student_image : $no_image); ?>" alt="" style="max-width:80px" border="1"/><br>
		Student No.:<?php echo $_GET['grade_stud_no'];?></td>
	</tr>
	<tr align="center">
		<td colspan="10">Department of Education</td>
	</tr>
	<tr align="center">
		<td colspan="10"><?php echo $current_school_region;?></td>
	</tr>
	<tr align="center">
		<td colspan="10">Division of <?php echo $current_school_division;?></td>
	</tr>
	<tr>
		<td colspan="10" align="center"><h2>SECONDARY STUDENT'S PERMANENT RECORD</h2></td>
	</tr>	
	<tr>
		<td colspan="2"><i>DepED Form 137-A</i></td>
		<td colspan="10" align="center"><h3><u><?php echo strtoupper($current_school_name);?></u> <br><?php echo $current_school_address;?><br>email: <?php echo $current_school_email;?> | contact: <?php echo $current_school_contact;?></h3></td>
		<td colspan="2"></td>
	<tr>	
	<tr>
		<td>LRN:</td>
		<td colspan="3" style="border-bottom: 1px solid;"><strong> <?php echo $dataStudent['stud_lrn'];?></strong></td>
		<td colspan="10"></td>
	<tr>
	<tr>
		<td>Name:</td>
		<td colspan="5" style="border-bottom: 1px solid;"> <strong><?php echo strtoupper($dataStudent['stud_lname'].", ".$dataStudent['stud_fname']." ".$dataStudent['stud_xname']." ".$dataStudent['stud_mname']);?></strong></td>
		<td colspan="2" align="right">Date of Birth: &nbsp;</td>
		<td colspan="4" style="border-bottom: 1px solid;"> <strong><?php $phpdate = strtotime($dataStudent['stud_bdate']); echo $mysqldate = date('F d, Y', $phpdate);?></strong></td>
		<td align="right">Sex: &nbsp;</td>
		<td style="border-bottom: 1px solid;"><strong><?php echo $dataStudent['stud_gender'];?></strong></td>
	<tr>
	<tr>
		<td colspan="2">Place of Birth</td>
		<td colspan="7" style="border-bottom: 1px solid;"> <strong><input type="text" style="width: 340px; border: 0px; font-weight: bold !important; font-size: 10px" value="" placeholder=""></strong></td>
		<td colspan="5"></td>
	<tr>	
	<tr>
		<td colspan="2">Parent or Guardian:</td>
		<td colspan="7" style="border-bottom: 1px solid;"> <strong><?php echo strtoupper(($dataStudent['studCont_stud_ffname']=="-"?$dataStudent['studCont_stud_mfname']:$dataStudent['studCont_stud_ffname'])." ".($dataStudent['studCont_stud_fmname']=="-"?$dataStudent['studCont_stud_mmname']:$dataStudent['studCont_stud_fmname'])." ".($dataStudent['studCont_stud_flname']=="-"?$dataStudent['studCont_stud_mlname']:$dataStudent['studCont_stud_flname']));?></strong></td>
		<td></td>
		<td colspan="2" align="right" >Occupation: &nbsp;</td>
		<td colspan="2" style="border-bottom: 1px solid;"> <input type="text" style="width: 95px; border: 0px; font-weight: bold !important; font-size: 10px" value="" placeholder=""></td>
	<tr>	
	<tr>
		<td colspan="3">Address of Parent or Guardian:</td>
		<td colspan="6" style="border-bottom: 1px solid;"> <strong><?php echo $dataStudent['stud_residence'];?></strong></td>
		<td colspan="6"></td>
	<tr>
	<?php
		$resultGradeSchool = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['grade_stud_no']."' AND enrol_level='6')");
		$dataGradeSchool = dbarray($resultGradeSchool);
	?>	
	<tr>
		<td colspan="4">Elementary School Course Completed (School):</td>
		<?php $dataEnrollmentSchool = unserialize($dataGradeSchool['enrol_school']);?>
		<td colspan="5" style="border-bottom: 1px solid;"> <strong><?php echo strtoupper($dataEnrollmentSchool['1']);?></strong></td>
		<td align="right">Year: &nbsp;</td>
		<td style="border-bottom: 1px solid;" width="10%"> <strong><?php echo $dataGradeSchool['enrol_sy'];?>-<?php echo $dataGradeSchool['enrol_sy']+1;?></strong></td>
		<td colspan="2" align="right">Gen. Ave.: &nbsp;</td>
		<td style="border-bottom: 1px solid;" align="center"> <strong><?php echo ($dataGradeSchool['enrol_average']==0?" <input type=\"text\" style=\"width: 45px; border: 0px; font-weight: bold !important; font-size: 10px\" value=\"\">":round($dataGradeSchool['enrol_average'],0));?></strong></td>
	<tr>		
</table><br>
<?php
$resultForm137 = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['grade_stud_no']."' AND enrol_level BETWEEN '7' and '10') ORDER BY enrol_sy asc, enrol_level ASC");
$i=0;
$enrol_level=0;
$enrol_status2="";
while($dataForm137 = dbarray($resultForm137)){
$enrol_level=$dataForm137['enrol_level'];
$enrol_status2 = $dataForm137['enrol_status2'];
$i++;
?>
<table border="1" cellspacing="0" cellpadding="1" width="780">
	<tr>
		<td colspan="14">
			<table border="0" width="100%">
				<tr>
					<td>CLASSIFIED AS</td>
					<td>Total number of years of school to date: <strong><input type="text" style="width: 50px; border: 0px; font-weight: bold !important; font-size: 10px" value="<?php echo ($dataForm137['enrol_schoolyears']==""?$dataForm137['enrol_level']:$dataForm137['enrol_schoolyears']);?>"></strong></td>
					<?php
					$checkAdviser = dbquery("SELECT * FROM section INNER JOIN users ON section_adviser=user_no WHERE (section_name='".$dataForm137['enrol_section']."' AND section_sy='".$dataForm137['enrol_sy']."')");
					$dataAdviser = dbarray($checkAdviser);
					?>
					<td width="35%">Adviser: <strong><?php echo ($dataAdviser['user_fullname']==""?"System Generated":strtoupper($dataAdviser['user_fullname']));?></strong></td>
				</tr>
				<tr>
					<td>GRADE: <strong><?php echo ($dataForm137['enrol_level']);?></strong></td>
					<?php $dataEnrollmentSchool = unserialize($dataForm137['enrol_school']);?>
					<td>School: <strong><?php echo strtoupper($dataEnrollmentSchool['1']);?></strong></td>
					<td>School Year: <strong><?php echo $dataForm137['enrol_sy'];?>-<?php echo $dataForm137['enrol_sy']+1;?></strong></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th width="5%" rowspan="2">LEVEL</th>
		<th rowspan="2" colspan="3" width="40%">SUBJECTS</th>
		<th width="12%" rowspan="2" colspan="2">UNIT(S)</th>
		<th width="26%" colspan="4">GRADING PERIOD/TERM</th>		
		<th width="12%" rowspan="2" colspan="2">FINAL GRADE</th>
		<th width="13%" rowspan="2" colspan="2">REMARKS</th>
	</tr>
	<tr>
		<th>1</th>
		<th>2</th>
		<th>3</th>
		<th>4</th>
	</tr>
	<?php
	$prosTotal=0;
	$gradedUnits1=0;
	$gradedUnits2=0;
	$gradedUnits3=0;
	$gradedUnits4=0;
	$countUnits=0;
	$counter=0;
	$aveQ1 = 0;
	$aveQ2 = 0;
	$aveQ3 = 0;
	$aveQ4 = 0;	
	$aveQf=0;
	$gradedUnitsqf=0;
	$resultGrade1 = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['grade_stud_no']."' and class.class_sy='".$dataForm137['enrol_sy']."') ORDER BY grade_sem ASC, pros_sort ASC");
	
	while($dataGrade1 = dbarray($resultGrade1)){
	?>
	<tr height="19">
		<td align="center"><?php echo $dataForm137['enrol_level']; ?></td> 
		<td colspan="3"><?php echo $dataGrade1['pros_desc']; ?></td>
		<td align="center" colspan="2"><?php echo $dataGrade1['pros_unit']; ?></td>
		<td align="center"><?php echo ($dataGrade1['grade_q1']==0?"-":$dataGrade1['grade_q1']); ?></td>
		<td align="center"><?php echo ($dataGrade1['grade_q2']==0?"-":$dataGrade1['grade_q2']); ?></td>
		<td align="center"><?php echo ($dataGrade1['grade_q3']==0?"-":$dataGrade1['grade_q3']); ?></td>
		<td align="center"><?php echo ($dataGrade1['grade_q4']==0?"-":$dataGrade1['grade_q4']); ?></td>
		<td align="center" colspan="2"><?php echo ($dataGrade1['grade_final']==0?"-":$dataGrade1['grade_final']); ?></td>
		<td align="center" colspan="2"><?php echo ($dataGrade1['grade_final']==0?"-":($dataGrade1['grade_remarks']==1?"PASSED":"FAILED"));?></td>
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
	}else {
		$gradedUnits3+=$dataGrade1['pros_unit'];
	}
	if($dataGrade1['grade_q4']<60){
		$gradedUnits4+=0;
	}else {
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
	while($counter<=12){
		echo "<tr  height=\"17\" align=\"center\"><td align=\"center\">-x-0-x-</td><td align=\"left\" colspan=\"3\">-x-NOTHING FOLLOWS-x-</td><td colspan=\"2\">-x-0-x-</td><td>-x-0-x-</td><td>-x-0-x-</td><td>-x-0-x-</td><td >-x-0-x-</td><td colspan=\"2\">-x-0-x-</td><td colspan=\"2\">-x-0-x-</td></tr>";
		$counter++;
	}
	
	
	?>
	<tr >
		<td colspan="4" height="0" align="right" bgcolor="lightgray"><strong>General Average for the School Year</strong></td>
		<td colspan="2" align="center"><strong><?php echo round($countUnits/1.0,2); ?></strong></td>
		<td align="center" colspan="4"></td>
		<?php 
			$resultEnrolInfo = dbquery("select * from studenroll where (enrol_stud_no='".$_GET['grade_stud_no']."' and enrol_sy='".$dataForm137['enrol_sy']."')");
			$dataEnrolInfo = dbarray($resultEnrolInfo);
		?>
		<td colspan="2" align="center"><strong><strong><?php echo (($countUnits!=$gradedUnits1 || $countUnits!=$gradedUnits2 || $countUnits!=$gradedUnits3 || $countUnits!=$gradedUnits4)?"-":round($aveQf/$countUnits,0));?></strong></strong></td>
		<td colspan="4" align="center"><strong><small><?php echo ($dataEnrolInfo['enrol_status2']=="IRREGULAR"?"CONDITIONAL":$dataEnrolInfo['enrol_status2']);?></small></strong></td>
	
	</tr>
	<tr align="center">
		<th colspan="2">Attendance</th>
		<th width="5%">Jun</th>
		<th width="5%">Jul</th>
		<th width="5%">Aug</th>
		<th width="5%">Sep</th>
		<th width="5%">Oct</th>
		<th width="5%">Nov</th>
		<th width="5%">Dec</th>
		<th width="5%">Jan</th>
		<th width="5%">Feb</th>
		<th width="5%">Mar</th>
		<th width="5%">Apr</th>
		<th width="5%">Total</th>
	</tr>
	<?php
	$checkAtt = dbquery("SELECT * FROM school_days WHERE (sch_stud_no='".$dataForm137['enrol_sy']."' AND sch_sy='".$dataForm137['enrol_sy']."') ORDER BY sch_sy DESC");
	$dataAtt = dbarray($checkAtt);
	?>
	<tr align="center">
		<td colspan="2">Days of School</td>
		<td><?php echo number_format($dataAtt['sch_m1'],2);?></td>
		<td><?php echo number_format($dataAtt['sch_m2'],2);?></td>
		<td><?php echo number_format($dataAtt['sch_m3'],2);?></td>
		<td><?php echo number_format($dataAtt['sch_m4'],2);?></td>
		<td><?php echo number_format($dataAtt['sch_m5'],2);?></td>
		<td><?php echo number_format($dataAtt['sch_m6'],2);?></td>
		<td><?php echo number_format($dataAtt['sch_m7'],2);?></td>
		<td><?php echo number_format($dataAtt['sch_m8'],2);?></td>
		<td><?php echo number_format($dataAtt['sch_m9'],2);?></td>
		<td><?php echo number_format($dataAtt['sch_m10'],2);?></td>
		<td><?php echo number_format($dataAtt['sch_m11'],2);?></td>
		<td><?php echo number_format(($dataAtt['sch_m1']+$dataAtt['sch_m2']+$dataAtt['sch_m3']+$dataAtt['sch_m4']+$dataAtt['sch_m5']+$dataAtt['sch_m6']+$dataAtt['sch_m7']+$dataAtt['sch_m8']+$dataAtt['sch_m9']+$dataAtt['sch_m10']+$dataAtt['sch_m11']+$dataAtt['sch_m12']),2);?></td>
	</tr>	
	<tr align="center">
	<?php
	$checkAtt = dbquery("SELECT * FROM school_days WHERE (sch_stud_no='".$_GET['grade_stud_no']."' AND sch_sy='".$dataForm137['enrol_sy']."') ORDER BY sch_sy DESC");
	$dataAtt = dbarray($checkAtt);
	?>	
	
		<td colspan="2">Days Present</td>
		<td><?php echo ($dataAtt['sch_m1']==0?"-":number_format($dataAtt['sch_m1'],2));?></td>
		<td><?php echo ($dataAtt['sch_m2']==0?"-":number_format($dataAtt['sch_m2'],2));?></td>
		<td><?php echo ($dataAtt['sch_m3']==0?"-":number_format($dataAtt['sch_m3'],2));?></td>
		<td><?php echo ($dataAtt['sch_m4']==0?"-":number_format($dataAtt['sch_m4'],2));?></td>
		<td><?php echo ($dataAtt['sch_m5']==0?"-":number_format($dataAtt['sch_m5'],2));?></td>
		<td><?php echo ($dataAtt['sch_m6']==0?"-":number_format($dataAtt['sch_m6'],2));?></td>
		<td><?php echo ($dataAtt['sch_m7']==0?"-":number_format($dataAtt['sch_m7'],2));?></td>
		<td><?php echo ($dataAtt['sch_m8']==0?"-":number_format($dataAtt['sch_m8'],2));?></td>
		<td><?php echo ($dataAtt['sch_m9']==0?"-":number_format($dataAtt['sch_m9'],2));?></td>
		<td><?php echo ($dataAtt['sch_m10']==0?"-":number_format($dataAtt['sch_m10'],2));?></td>
		<td><?php echo ($dataAtt['sch_m11']==0?"-":number_format($dataAtt['sch_m11'],2));?></td>
		<td><?php echo number_format(($dataAtt['sch_m1']+$dataAtt['sch_m2']+$dataAtt['sch_m3']+$dataAtt['sch_m4']+$dataAtt['sch_m5']+$dataAtt['sch_m6']+$dataAtt['sch_m7']+$dataAtt['sch_m8']+$dataAtt['sch_m9']+$dataAtt['sch_m10']+$dataAtt['sch_m11']+$dataAtt['sch_m12']),2);?></td>
	</tr>
	<tr>
		<td colspan="14">Lacks/Advance Units in: 
			<?php 
			if($dataEnrolInfo['enrol_status2']=="PROMOTED"){
			?>
			<input type="text" style="width: 585px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: left;" value="<?php echo ($dataEnrolInfo['enrol_graddate']!="0000-00-00"?"Graduated on ".date('F d, Y', strtotime($dataEnrolInfo['enrol_graddate'])):strtoupper($dataEnrolInfo['enrol_remarks']));?>">
			<?php
			}
			else if($dataEnrolInfo['enrol_status2']=="TRANSFERRED OUT"){
			?>
			<input type="text" style="width: 585px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: left;" value="<?php echo ($dataEnrolInfo['enrol_graddate']!="0000-00-00"?"Transferred Out on ".date('F d, Y', strtotime($dataEnrolInfo['enrol_graddate'])):strtoupper($dataEnrolInfo['enrol_remarks']));?>">
			<?php
			}
			else{
			?>
			<input type="text" style="width: 585px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: left;" value="<?php echo strtoupper($dataEnrolInfo['enrol_remarks']);?>">
			<?php
			}
			?>
		</td>
	</tr>
</table><br>


<?php 
	if($i==2){
		?>
		<table border="0" cellspacing="0" cellpadding="0" width="780">
			<tr>
				<td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td>
				<td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td>
			</tr>
			<tr>
				<td colspan="2" rowspan="3" align="center">Not Valid Without<br>School Seal</td>
				<td rowspan="3" align="center"></td>
				<td colspan="5">Accomplished by:</td>
				<td colspan="6">Checked by:</td>
			</tr>	
			<tr>
				<td colspan="5" align="center"><strong><?php echo strtoupper($current_registrar);?></strong><br>School Registrar</td>
				<td colspan="6" align="center"><strong><?php echo strtoupper($current_principal);?></strong><br>School Principal</td>
			</tr>	
			<tr>
				<td colspan="14" align="center"></td>
			</tr>
			<tr>
				<td colspan="14" align="center"></td>
			</tr>
			
				<?php
				$resultStudent = dbquery("SELECT * FROM student INNER JOIN studcontacts ON student.stud_no=studcontacts.studCont_stud_no WHERE student.stud_no='".$_GET['grade_stud_no']."'");
				$dataStudent = dbarray($resultStudent);
				?>
				<td align="left" colspan="7"><strong><i>Form 137 for <strong><?php echo $dataStudent['stud_lname'].", ".$dataStudent['stud_fname']." ".$dataStudent['stud_xname']." ".$dataStudent['stud_mname'];?> (<?php echo $dataStudent['stud_lrn'];?>)</strong></i></strong></td>
				<td align="right" colspan="7"><strong><i>FORM 137-JHS</strong></i></strong></td>
			</tr>	
			<tr>
				<td colspan="14" align="center"></td>
			<tr>

		</table>
		<?php
	}

} 
	while($i<4){
			blanksheet();
			$i++;
	
	if($i==2){
		?>
		<table border="0" cellspacing="0" cellpadding="0" width="780">
			<tr>
				<td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td>
				<td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td>
			</tr>
			<tr>
				<td colspan="2" rowspan="3" align="center">Not Valid Without<br>School Seal</td>
				<td rowspan="3" align="center"></td>
				<td colspan="5">Accomplished by:</td>
				<td colspan="6">Checked by:</td>
			</tr>	
			<tr>
				<td colspan="5" align="center"><strong><?php echo $current_registrar;?></strong><br>School Registrar</td>
				<td colspan="6" align="center"><strong><?php echo $current_principal;?></strong><br>School Principal</td>
			</tr>	
			<tr>
				<td colspan="14" align="center"></td>
			</tr>
			<tr>
				<td colspan="14" align="center"></td>
			</tr>
			<tr>
				<td colspan="14" align="center"></td>
			</tr>
			<tr>
			
				<?php
				$resultStudent = dbquery("SELECT * FROM student INNER JOIN studcontacts ON student.stud_no=studcontacts.studCont_stud_no WHERE student.stud_no='".$_GET['grade_stud_no']."'");
				$dataStudent = dbarray($resultStudent);
				?>
				<td align="left" colspan="7"><strong><i>Form 137 for <strong><?php echo $dataStudent['stud_lname'].", ".$dataStudent['stud_fname']." ".$dataStudent['stud_xname']." ".$dataStudent['stud_mname'];?> (<?php echo $dataStudent['stud_lrn'];?>)</strong></i></strong></td>
				<td align="right" colspan="7"><strong><i>FORM 137-JHS</strong></i></strong></td>
			</tr>	
			<tr>
				<td colspan="14" align="center"></td>
			<tr>

		</table>
		<?php
	}	
	
	}
?>

<table border="0" cellspacing="0" cellpadding="0" width="780">
	<tr>
		<td width="15%"></td><td width="15%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td>
		<td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="3" align="center">Not Valid Without<br>School Seal</td>
		<td rowspan="3" align="center"></td>
		<td colspan="5">Accomplished by:</td>
		<td colspan="6">Checked & Attested by:<br><br></td>
	</tr>	
	<tr>
		<td colspan="5" align="center"><strong><?php echo strtoupper($current_registrar);?></strong><br>School Registrar</td>
		<td colspan="6" align="center"><strong><?php echo strtoupper($current_principal);?></strong><br>School Principal</td>
	</tr>	
	<tr>
		<td colspan="5" align="center"></td>
		<td colspan="6" align="center"></td>
	</tr>
</table><hr>
<table border="0" cellspacing="0" cellpadding="0" width="780">
	<tr>
		<td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td>
		<td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td>
	</tr>
	<tr bgcolor="lightgray">
		<td colspan="14" align="center"><strong>CERTIFICATE OF TRANSFER</strong></td>
	</tr>
	<tr>
		<td colspan="14"><strong>To Whom It May Concern:</strong></td>
	</tr>
	<tr>
		<td colspan="14"></td>
	</tr>	
	<tr>
		<td colspan="14">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I hereby certify that this is the true record of <strong><?php echo strtoupper($dataStudent['stud_lname'].", ".$dataStudent['stud_fname']." ".$dataStudent['stud_xname']." ".$dataStudent['stud_mname']);?></strong> and <?php echo ($dataStudent['stud_gender']=="MALE"?"he":"she");?> is eligible for admission to <input type="text" style="width: 50px; border: 0px; font-weight: bold !important; font-size: 10px"" value="Grade <?php echo ($enrol_status2=="PROMOTED"?$enrol_level+1:$enrol_level);?>">. 
		This is to certify further that this student has no money or property accountability in the school.</td>
	</tr>		
	<tr>
		<td colspan="14"></td>
	</tr>
	<tr>
		<td colspan="14">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Issued on the <b><?php echo date("d");?><sup><?php echo date("S");?></b></sup> day of <b><?php echo date("F");?></b>, <b><?php echo date("Y");?></b> at <?php echo $current_school_full;?>, <?php echo $current_school_address;?>.</td>
	</tr>	
	<tr>
		<td colspan="14"></td>
	</tr>
	<tr>
		<td colspan="9"></td>
		<td colspan="5" align="center"><strong><?php echo strtoupper($current_principal);?></strong><br>School Principal</td>
	</tr>		
</table>


<?php
function blanksheet(){
?>

<table border="1" cellspacing="0" cellpadding="1" width="780">
	<tr>
		<td colspan="14">
			<table border="0" width="100%">
				<tr>
					<td>CLASSIFIED AS</td>
					<td>Total number of years of school to date: <strong>____</strong></td>
					<td width="35%">Adviser: <strong>____________________________</strong></td>
				</tr>
				<tr>
					<td>GRADE: <strong>_____</strong></td>
					<td>School: <strong>_______________________________________</strong></td>
					<td>School Year: <strong>______________</strong></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th width="5%" rowspan="2">LEVEL</th>
		<th rowspan="2" colspan="3" width="40%">SUBJECTS</th>
		<th width="12%" rowspan="2" colspan="2">UNIT(S)</th>
		<th width="26%" colspan="4">GRADING PERIOD/TERM</th>		
		<th width="12%" rowspan="2" colspan="2">FINAL GRADE</th>
		<th width="13%" rowspan="2" colspan="2">REMARKS</th>
	</tr>
	<tr>
		<th>1</th>
		<th>2</th>
		<th>3</th>
		<th>4</th>
	</tr>
	<tr height="19">
		<td align="center"></td> 
		<td colspan="3"></td>
		<td align="center" colspan="2"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center" colspan="2"></td>
		<td align="center" colspan="2"></td>
	</tr>
	<?php 
	$countUnits=0;
	if($countUnits==0){
		$countUnits=1;
	}
	while($counter<=12){
		echo "<tr  height=\"17\" align=\"center\"><td align=\"center\"></td><td align=\"left\" colspan=\"3\"></td><td colspan=\"2\"></td><td></td><td></td><td></td><td></td><td colspan=\"2\"></td><td colspan=\"2\"></td></tr>";
		$counter++;
	}
		
	?>
	<tr >
		<td colspan="4" height="0" align="right" bgcolor="lightgray"><strong>General Average for the School Year</strong></td>
		<td colspan="2" align="center"><strong></strong></td>
		<td align="center" colspan="4"></td>
		<td colspan="2" align="center"><strong><strong></strong></strong></td>
		<td colspan="4" align="center"><strong></strong></td>
	
	</tr>
	<tr align="center">
		<th colspan="2">Attendance</th>
		<th width="5%">Jun</th>
		<th width="5%">Jul</th>
		<th width="5%">Aug</th>
		<th width="5%">Sep</th>
		<th width="5%">Oct</th>
		<th width="5%">Nov</th>
		<th width="5%">Dec</th>
		<th width="5%">Jan</th>
		<th width="5%">Feb</th>
		<th width="5%">Mar</th>
		<th width="5%">Apr</th>
		<th width="5%">Total</th>
	</tr>
	<tr align="center">
		<td colspan="2">Days of School</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>	
	<tr align="center">
		<td colspan="2">Days Present</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td colspan="14">Lacks/Advance Units in: 

		</td>
	</tr>
</table><br>

<?php
}

function footer(){
$selectGlobalSettings = dbquery("SELECT * FROM settings WHERE activated='1'");
$rowGlobalSettings = dbarray($selectGlobalSettings);
$current_registrar = strtoupper($rowGlobalSettings['settings_registrar']);
$current_principal = strtoupper($rowGlobalSettings['settings_principal']);

?>


<?php
}
?>

