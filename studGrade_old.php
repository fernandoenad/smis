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
		font-size: 0.6em;
	} 
	
	td {
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.7em;		
	}
	</style>
</head>	
<table border="0" cellspacing="0" cellpadding="0" width="800">
	<tr>
		<td width="60" valign="top"><img src="./assets/images/sanhs_logo.png" width="50"></td>
		<td align="left" valign="top">
		<strong><?php echo $current_school_name;?></strong><br>
		<?php echo $current_school_address;?>
		<h4>Student Grade Slip<br>
		School Year <?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?>, <?php echo ($_GET['enrol_sem']=="1"?"First Semester":($_GET['enrol_sem']=="2"?"Second Semester":"Full Year"));?> 
		</h4>
		</td>
		<td align="right">
		
		</td>
		<td align="center"><img src="./barcodeapp/barcode.php?text=<?php echo $_GET['stud_no']; ?>" alt="testing" /><br>Student No.: <?php echo $_GET['stud_no']; ?>
		</td>
	</tr>
</table>	
<table border="0" cellspacing="2	" cellpadding="0" width="800">
	<tr>
		<td width="16%" align="right">Learner's Ref. No. (LRN):</td>
		<td> <b><?php echo $dataStudent['stud_lrn'];?></td>
		<td width="12%" align="right"></td>
		<td width="15%"></td>
	</tr>
	<tr>
		<td align="right">Student Fullname:</td>
		<td> <b><?php echo strtoupper($dataStudent['stud_lname']);?>, <?php echo strtoupper($dataStudent['stud_fname']);?> <?php echo strtoupper($dataStudent['stud_xname']);?> <?php echo strtoupper($dataStudent['stud_mname']);?></td>
		<td align="right">Level / Sec.:</td>
		<td align="left"> <b><?php echo $dataStudent['enrol_level'];?> / <?php echo $dataStudent['enrol_section'];?></td>
	</tr>	
	<?php
	if($dataStudent['enrol_level']>10){
	?>
	<tr>
		<td align="right">Track/Strand & Combo: </td>
		<td> <b><small><?php echo strtoupper($dataStudent['enrol_track']);?> / <?php echo strtoupper($dataStudent['enrol_strand']);?> - <?php echo strtoupper($dataStudent['enrol_combo']);?></small></td>
		<td align="right"></td>
		<td align="left"> </td>
	</tr>
	<?php
	}
	?>
</table>	
<hr>
<?php
$resultEnrol = dbquery("SELECT * FROM studenroll WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_stud_no='".$_GET['stud_no']."')");
$dataEnroll = dbarray($resultEnrol);
$resultSectionName = dbquery("SELECT * FROM section WHERE (section_name='".$dataEnroll['enrol_section']."' AND section_sy='".$_GET['enrol_sy']."')");
$dataSectionName = dbarray($resultSectionName);
$checkUser = dbquery("SELECT * FROM users WHERE user_no='".$dataSectionName['section_adviser']."'");
$dataUser = dbarray($checkUser );
?>
<div class="table-responsive">
	<table width="800" class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
		<thead>
			<tr>
				<th align="left" width="20%"><u>Code</th>
				<th align="left"><u>Descriptive Title</th>
				<th align="left" width="3%"><u>Units</th>
				<th align="left" width="3%"><u>Q1</th>
				<th align="left" width="3%"><u>Q2</th>
				<th align="left" width="3%"><u>Q3</th>	
				<th align="left" width="3%"><u>Q4</th>
				<th align="left" width="5%"><u>Finals</th>
				<th align="left" width="7%"><u>Remarks</th>
				<th align="left" width="13%"><u>Teacher</th>				
			</tr>
		</thead>
		<tbody> 
		<?php
		if($dataEnroll['enrol_level']>10){
			$sem = $_GET['enrol_sem'];
		}
		else{
			$sem = 12;
		}
		$resultGrade = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['stud_no']."' and grade.grade_sy='".$_GET['enrol_sy']."' and pros_sem='".$sem."') ORDER BY grade_sem ASC, pros_sort ASC");
		$countUnits=0;
		$aveQ1=0;
		$aveQ2=0;
		$aveQ3=0;
		$aveQ4=0;
		$aveQf=0;
		while($dataGrade = dbarray($resultGrade)){
		?>													
			<tr>
				<?php
					$resultClassName = dbquery("select * from section where (section_no='".$dataGrade['class_section_no']."')");
					$dataClassName = dbarray($resultClassName);
				?>
				<td><?php echo $dataGrade['pros_title']; ?> (<?php echo $dataClassName['section_name']; ?>)</td>
				<td><?php echo substr(ucwords(strtolower($dataGrade['pros_desc'])),0,45); ?>...</td>
				<td><?php echo number_format($dataGrade['pros_unit'],2); ?></td>
				<td><?php echo ($dataGrade['grade_q1']<60?"-":$dataGrade['grade_q1']); 
				$aveQ1 += ($dataGrade['grade_q1']*$dataGrade['pros_unit']);?></td>
				<td><?php echo ($dataGrade['grade_q2']<60?"-":$dataGrade['grade_q2']); 
				$aveQ2 += ($dataGrade['grade_q2']*$dataGrade['pros_unit']);?></td>
				<td><?php echo ($dataGrade['grade_q3']<60?"-":$dataGrade['grade_q3']); 
				$aveQ3 += ($dataGrade['grade_q3']*$dataGrade['pros_unit']);?></td>
				<td><?php echo ($dataGrade['grade_q4']<60?"-":$dataGrade['grade_q4']); 
				$aveQ4 += ($dataGrade['grade_q4']*$dataGrade['pros_unit']);?></td>
				<?php
				$resultEnrolInfo = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['stud_no']."' AND enrol_sy='".$current_sy."')");
				$dataEnrolInfo = dbarray($resultEnrolInfo);
				?>
				<td><strong>
				<?php 
				if($dataGrade['pros_level']<11 && ($dataGrade['grade_q1']<60 || $dataGrade['grade_q2']<60 || $dataGrade['grade_q3']<60 || $dataGrade['grade_q4']<60)){
					echo "-";
					$remarks = "-";
				}
				else if($dataGrade['pros_level']>10 && ($dataGrade['grade_q1']<60 || $dataGrade['grade_q2']<60)){
					echo "-";
					$remarks = "-";
				}
				else {
					echo $dataGrade['grade_final'];
					$remarks = ($dataGrade['grade_final']>=75?"PASSED":"FAILED");
				}
				$aveQf += ($dataGrade['grade_final']*$dataGrade['pros_unit']);?></strong></td>
				<td><?php echo $remarks; ?></td>
				<?php
				$checkTeacher = dbquery("SELECT * FROM teacher WHERE teach_no='".$dataGrade['class_user_name']."'");
				$dataTeacher = dbarray($checkTeacher);
				?>
				<td><?php echo ($dataGrade['class_user_name']=="1"?"TBA":strtoupper($dataTeacher['teach_lname'].", ".substr($dataTeacher['teach_fname'],0,1).".")); ?></td>
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
			<td></td>
			<td align="right"><b>Total Units / Gen. Ave.</b></td>
			<td><b><?php echo round($countUnits,4);?></b></td>
			<?php
			if($countUnits==0){
				$countUnits=1;
			}
			?>
		<td align="left"><b><?php echo $q1=($countUnits!=$gradedUnits1?"-":round($aveQ1/$countUnits,0));?></b></td>
		<td align="left"><b><?php echo $q2=($countUnits!=$gradedUnits2?"-":round($aveQ2/$countUnits,0));?></b></td>
		<td align="left"><b><?php echo $q3=($countUnits!=$gradedUnits3?"-":round($aveQ3/$countUnits,0));?></b></td>
		<td align="left"><b><?php echo $q4=($countUnits!=$gradedUnits4?"-":round($aveQ4/$countUnits,0));?></b></td>
		<?php
		$resultEnrolInfo = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['stud_no']."' AND enrol_sy='".$current_sy."')");
		$dataEnrolInfo = dbarray($resultEnrolInfo);
		?>
		<td align="left"><strong><strong>
		<?php 
		if($pros_level<11 && ($q1=="-" || $q2=="-"|| $q3=="-" || $q4=="-")){
			echo "-";
		}
		else if($pros_level>10 && ($q1=="-" || $q2=="-")){
			echo "-";
		}
		else {
			echo round($aveQf/$countUnits,0);
		} 	
		
		?></strong></strong></td>
		<td align="left"><strong></strong></td>
		</tr>
		</tbody>
	</table>
</div>
<table width="800" class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
													<thead>
														<tr>
													<th width="5%">-</th>
													<th width="5%">First Day</th>
													<th width="3%">Jun</th>
													<th width="3%">Jul</th>
													<th width="3%">Aug</th>
													<th width="3%">Sep</th>
													<th width="3%">Oct</th>
													<th width="3%">Nov</th>
													<th width="3%">Dec</th>
													<th width="3%">Jan</th>
													<th width="3%">Feb</th>
													<th width="3%">Mar</th>
													<th width="3%">Apr</th>
													<th width="3%">May</th>
													<th width="3%">Total</th>

												</tr>
											</thead>
											<tbody> 
												<?php
												$checkAtt = dbquery("SELECT * FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$_GET['stud_no']."')");
												$dataAtt = dbarray($checkAtt);
												?>
												<tr align="center">
													<td>Days Present</td>
													<td><?php echo $dataAtt['sch_firstday'];?></td>
													<td><?php echo ($dataAtt['sch_m1']==0?"-":$dataAtt['sch_m1']);?></td>
													<td><?php echo ($dataAtt['sch_m2']==0?"-":$dataAtt['sch_m2']);?></td>
													<td><?php echo ($dataAtt['sch_m3']==0?"-":$dataAtt['sch_m3']);?></td>
													<td><?php echo ($dataAtt['sch_m4']==0?"-":$dataAtt['sch_m4']);?></td>
													<td><?php echo ($dataAtt['sch_m5']==0?"-":$dataAtt['sch_m5']);?></td>
													<td><?php echo ($dataAtt['sch_m6']==0?"-":$dataAtt['sch_m6']);?></td>
													<td><?php echo ($dataAtt['sch_m7']==0?"-":$dataAtt['sch_m7']);?></td>
													<td><?php echo ($dataAtt['sch_m8']==0?"-":$dataAtt['sch_m8']);?></td>
													<td><?php echo ($dataAtt['sch_m9']==0?"-":$dataAtt['sch_m9']);?></td>
													<td><?php echo ($dataAtt['sch_m10']==0?"-":$dataAtt['sch_m10']);?></td>
													<td><?php echo ($dataAtt['sch_m11']==0?"-":$dataAtt['sch_m11']);?></td>
													<td><?php echo ($dataAtt['sch_m12']==0?"-":$dataAtt['sch_m12']);?></td>
													<?php
													$checkPresent = dbquery("SELECT (sch_m1 + sch_m2 + sch_m3 + sch_m4 + sch_m5 + sch_m6 + sch_m7 + sch_m8 + sch_m9 + sch_m10 + sch_m11 + sch_m12) as total FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$_GET['stud_no']."')");
													$dataPresent = dbarray($checkPresent)
													?>
													<td><?php echo $dataPresent['total'];?></td>
												</tr>
												<?php
												$checkAtt = dbquery("SELECT * FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$_GET['enrol_sy']."')");
												$dataAtt = dbarray($checkAtt)
												?>
												<tr align="center">
													<td>School Days</td>
													<td><?php echo $dataAtt['sch_firstday'];?></td>
													<td><?php echo ($dataAtt['sch_m1']==0?"-":$dataAtt['sch_m1']);?></td>
													<td><?php echo ($dataAtt['sch_m2']==0?"-":$dataAtt['sch_m2']);?></td>
													<td><?php echo ($dataAtt['sch_m3']==0?"-":$dataAtt['sch_m3']);?></td>
													<td><?php echo ($dataAtt['sch_m4']==0?"-":$dataAtt['sch_m4']);?></td>
													<td><?php echo ($dataAtt['sch_m5']==0?"-":$dataAtt['sch_m5']);?></td>
													<td><?php echo ($dataAtt['sch_m6']==0?"-":$dataAtt['sch_m6']);?></td>
													<td><?php echo ($dataAtt['sch_m7']==0?"-":$dataAtt['sch_m7']);?></td>
													<td><?php echo ($dataAtt['sch_m8']==0?"-":$dataAtt['sch_m8']);?></td>
													<td><?php echo ($dataAtt['sch_m9']==0?"-":$dataAtt['sch_m9']);?></td>
													<td><?php echo ($dataAtt['sch_m10']==0?"-":$dataAtt['sch_m10']);?></td>
													<td><?php echo ($dataAtt['sch_m11']==0?"-":$dataAtt['sch_m11']);?></td>
													<td><?php echo ($dataAtt['sch_m12']==0?"-":$dataAtt['sch_m12']);?></td>
													<?php
													$checkSchoolDays = dbquery("SELECT (sch_m1 + sch_m2 + sch_m3 + sch_m4 + sch_m5 + sch_m6 + sch_m7 + sch_m8 + sch_m9 + sch_m10 + sch_m11 + sch_m12) as total FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$_GET['enrol_sy']."')");
													$dataSchoolDays = dbarray($checkSchoolDays)
													?>
													<td><?php echo ($dataSchoolDays['total']==0?"-":$dataSchoolDays['total']);?></td>
												</tr>
											</tbody>
											</table>
<hr>
<table border="0" cellspacing="0" cellpadding="0" width="800">
	<tr>
		<td width="40%"></td>
		<td></td>
		<td width="40%">Prepared by:<br><br><br></td>
	</tr>
	<tr>
		<?php
		$checkUser = dbquery("SELECT * FROM users WHERE user_name='".$_SESSION["user_name"]."'");
		$dataUser = dbarray($checkUser );
		?>
		<td colspan="2"><br> *** <?php echo date("M d, Y - D / h:i:s A");?> / <?php echo strtoupper($dataUser['user_fullname']);?> ***</td>
		<td align="center"><b><?php echo strtoupper($current_registrar);?></b><br>School Registrar</td>
	</tr>	
	<?php
		$checkUser = dbquery("SELECT * FROM users WHERE user_name='".$_SESSION["user_name"]."'");
		$dataUser = dbarray($checkUser );
		?>		
</table>	

