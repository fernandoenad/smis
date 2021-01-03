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
		height: 12px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.6em;
	} 
	
	td {
		height: 12px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.7em;		
	}
	</style>	
</head>
<?php
$resultTeacher = dbquery("SELECT * FROM section INNER JOIN users ON section.section_adviser=users.user_no WHERE (section_name='".$_GET['classProfile']."' AND section_sy='".$_GET['enrol_sy']."')");
$dataTeacher = dbarray($resultTeacher);
?>
<table border="0" cellspacing="0" cellpadding="0" width="800">
	<tr>
		<td width="60" valign="top"><img src="./assets/images/deped_logo.png" width="60"></td>
		<td align="center" valign="top">
		<strong><?php echo strtoupper($current_school_name);?></strong><br>
		<i><?php echo $current_school_address;?></i><br>
		<?php 
		$checkLevel = dbquery("select * from section where (section_name='".$_GET['classProfile']."' and section_sy='".$_GET['enrol_sy']."')");
		$dataLevel = dbarray($checkLevel);
		?>
		<h2>SUMMARY OF GRADES for <?php echo "Grade ".$dataLevel['section_level']." - ".$_GET['classProfile'];?></h2>
		School Year <?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?>, <?php echo ($_GET['term']=="grade_q1"?"First":($_GET['term']=="grade_q2"?"First":($_GET['term']=="grade_q3"?"Second":($_GET['term']=="grade_q4"?"Second":($_GET['term']=="grade_sem1"?"First":"Second")))));?> Semester 
		- <?php echo ($_GET['term']=="grade_q1"?"First Quarter/Midterms":($_GET['term']=="grade_q2"?"Second Quarter/Finals":($_GET['term']=="grade_q3"?"Third Quarter/Midterms":($_GET['term']=="grade_q4"?"Fourth Quarter/Finals":"Average"))));?> <br><br>
		</td>
		<td align="right">

		
		</td>
		<td width="60" valign="top"><img src="./assets/images/sanhs_logo.png" width="60"></td>
	</tr>
</table>	
<table border="1" cellspacing="0" cellpadding="1" width="800">
	<tr>
		<th width="1%">#</th>
		<th width="11%">NAME OF LEARNERS</th>
	<?php
		$resultSection = dbquery("SELECT * FROM section WHERE (section_name='".$_GET['classProfile']."' AND section_sy='".$_GET['enrol_sy']."')");
		$dataSection = dbarray($resultSection);
		if($dataSection['section_level']>10){
			if($_GET['term']=="grade_q1" || $_GET['term']=="grade_q2" || $_GET['term']=="grade_sem1"){
				$active_sem = 1;
			}
			else if($_GET['term']=="grade_q3" || $_GET['term']=="grade_q4" || $_GET['term']=="grade_sem2"){
				$active_sem = 2;
			}
			else{
				$active_sem = "";
			}
		}
		else {
			$active_sem = 12;
		}
		
		$checkCourses = dbquery("SELECT * FROM class INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (class.class_sy='".$_GET['enrol_sy']."' AND class.class_section_no='".$dataSection['section_no']."' and class_sem='".$active_sem."') ORDER BY pros_sem ASC, pros_sort ASC");
		$countCourses = dbrows($checkCourses);
		while($dataCourses = dbarray($checkCourses)){
	?>
		<th width="1%"><?php echo $dataCourses['pros_title'];?></th>
	<?php
	}
	?>	
		<th width="1%">Ave.</th>
		<th width="1%">Rounded Ave.</th>
		<th width="1%">Remarks</th>
	</tr>
	<?php
	$i=1;
	$MLEi=0;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='MALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr>
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($data['stud_lname']);?>, <?php echo strtoupper($data['stud_fname']);?> <?php echo strtoupper(substr($data['stud_mname'],0,1));?></td>
		<?php
		$countUnits=0;
		$gradedUnits1=0;
		$aveQ1=0;
		$grade=0;
		if($dataSection['section_level']>10){
			if($_GET['term']=="grade_q1" || $_GET['term']=="grade_q2" || $_GET['term']=="grade_sem1"){
				$active_sem = 1;
			}
			else if($_GET['term']=="grade_q3" || $_GET['term']=="grade_q4" || $_GET['term']=="grade_sem2"){
				$active_sem = 2;
			}
			else{
				$active_sem = "";
			}
		}
		else {
			$active_sem = 12;
		}
		$resultGrade1 = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$data['stud_no']."' AND class.class_sy='".$data['enrol_sy']."' and class_sem='".$active_sem."') ORDER BY pros_sort ASC");
		$countGrade1 = dbrows($resultGrade1);
		$below80counter=0;
		$blankcountertotal=0;
		while($dataGrade1 = dbarray($resultGrade1)){
			if($countGrade1<$countCourses){
				$grade = "xxx";
			}
			else{
			$countUnits+=$dataGrade1['pros_unit'];
			if($_GET['term']=="grade_q1"){
				$grade = $dataGrade1['grade_q1'];
				
			}
			else if($_GET['term']=="grade_q2"){
				$grade = $dataGrade1['grade_q2'];
			}
			else if($_GET['term']=="grade_q3" && $dataSection['section_level']>10){
				$grade = $dataGrade1['grade_q1'];
			}
			else if($_GET['term']=="grade_q3"){
				$grade = $dataGrade1['grade_q3'];
			}
			else if($_GET['term']=="grade_q4" && $dataSection['section_level']>10){
				$grade = $dataGrade1['grade_q2'];
			}
			else if($_GET['term']=="grade_q4"){
				$grade = $dataGrade1['grade_q4'];
			}
			else {
				$grade = $dataGrade1['grade_final'];
			}
			
			$blankcounter=0;
			if($dataGrade1['grade_q1']>=60 && $dataGrade1['pros_unit']>0){
				$blankcounter++;
			}
			if($dataGrade1['grade_q2']>=60 && $dataGrade1['pros_unit']>0){
				$blankcounter++;
			}
			if($dataGrade1['grade_q3']>=60 && $dataGrade1['pros_unit']>0){
				$blankcounter++;
			}
			if($dataGrade1['grade_q4']>=60 && $dataGrade1['pros_unit']>0){
				$blankcounter++;
			}
			$blankcountertotal = $blankcountertotal + $blankcounter; 
			
			$aveQ1 += ($grade*$dataGrade1['pros_unit']);
			if($grade<60){
				$gradedUnits1+=0;
			} 
			else {
				$gradedUnits1+=$dataGrade1['pros_unit'];
			}
			if(($dataGrade1['grade_q1']<75 || $dataGrade1['grade_q2']<75 || $dataGrade1['grade_q3']<75 || $dataGrade1['grade_q4']<75) && $dataGrade1['pros_unit']>0) { $below80counter++;}
			}
		?>
		<td align="center" <?php echo ($grade<60?"bgcolor=lightgray":"");?>><b><?php echo ($grade<75 && $dataGrade1['pros_unit']>0?"<font color=red>":"");?><?php echo ($grade<80 && $grade>=75 && $dataGrade1['pros_unit']>0?"<font color=blue>":"");?><?php echo ($countGrade1<$countCourses?"<font size=1 color=maroon>".$dataGrade1['pros_title']."</font><br><u>".$grade:($grade<60?"":($blankcounter<4?$grade:$grade)));?></td>
		<?php 
		} 
		
		?>
		<td align="center" bgcolor="yellow"><b><?php echo ($blankcountertotal>=($countUnits*4)?number_format($aveQ1/$countUnits,3):"");?></b></td>
		<td align="center" bgcolor="yellow"><b><?php echo ($blankcountertotal>=($countUnits*4)?round($aveQ1/$countUnits,0):"");?></b></td>
		<td align="left"
		<?php
		if($countUnits!=$gradedUnits1){
		}
		else{
			if(round($aveQ1/$countUnits,0)>=98 && $below80counter==0 && $blankcountertotal>=($countUnits*4)){
				echo " bgcolor=pink><b>Hghst Hnr";
			}
			else if(round($aveQ1/$countUnits,0)>=95 && $below80counter==0 && $blankcountertotal>=($countUnits*4)){
				echo " bgcolor=cyan><b>High Hnr";
			}
			else if(round($aveQ1/$countUnits,0)>=90 && $below80counter==0 && $blankcountertotal>=($countUnits*4)){
				echo " bgcolor=lightgreen><b>w/ Hnr";
			}
			else if(round($aveQ1/$countUnits,0)>=75 && $blankcountertotal>=($countUnits*4)){
				echo ">PASSED";
			}
			else if(round($aveQ1/$countUnits,0)==""){
				echo ">-";
			}
			else if(round($aveQ1/$countUnits,0)<75){
				echo "><font color=red>FAILED</font>";
			}
		}
		?>
		</td>
	</tr>
	<?php 
	$i++;
	} ?>
	<tr height="10" bgcolor="gray">
		<td>#</td>
		<td>#</td>
		<?php
		for ($n=1;$n<=$countCourses;$n++){
		?>
		<td>#</td>
		<?php
		}
		?>	
		<td>#</td>
		<td>#</td>
		<td>#</td>
	</tr>	
	<?php
	$i=1;
	$FLEi=0;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='FEMALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr>
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($data['stud_lname']);?>, <?php echo strtoupper($data['stud_fname']);?> <?php echo strtoupper(substr($data['stud_mname'],0,1));?></td>
		<?php
		$countUnits=0;
		$gradedUnits1=0;
		$aveQ1=0;
		$grade=0;
		if($dataSection['section_level']>10){
			if($_GET['term']=="grade_q1" || $_GET['term']=="grade_q2" || $_GET['term']=="grade_sem1"){
				$active_sem = 1;
			}
			else if($_GET['term']=="grade_q3" || $_GET['term']=="grade_q4" || $_GET['term']=="grade_sem2"){
				$active_sem = 2;
			}
			else{
				$active_sem = "";
			}
		}
		else {
			$active_sem = 12;
		}
		
		$resultGrade1 = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$data['stud_no']."' AND class.class_sy='".$data['enrol_sy']."' and class_sem='".$active_sem."') ORDER BY pros_sort ASC");
		$countGrade1 = dbrows($resultGrade1);
		$below80counter=0;
		$blankcountertotal=0;
		while($dataGrade1 = dbarray($resultGrade1)){
			$countUnits+=$dataGrade1['pros_unit'];
			if($_GET['term']=="grade_q1"){
				$grade = $dataGrade1['grade_q1'];
			}
			else if($_GET['term']=="grade_q2"){
				$grade = $dataGrade1['grade_q2'];
			}
			else if($_GET['term']=="grade_q3" && $dataSection['section_level']>10){
				$grade = $dataGrade1['grade_q1'];
			}
			else if($_GET['term']=="grade_q3"){
				$grade = $dataGrade1['grade_q3'];
			}
			else if($_GET['term']=="grade_q4" && $dataSection['section_level']>10){
				$grade = $dataGrade1['grade_q2'];
			}
			else if($_GET['term']=="grade_q4"){
				$grade = $dataGrade1['grade_q4'];
			}
			else{
				$grade = $dataGrade1['grade_final'];
			}
			
			$blankcounter=0;
			if($dataGrade1['grade_q1']>=60 && $dataGrade1['pros_unit']>0){
				$blankcounter++;
			}
			if($dataGrade1['grade_q2']>=60 && $dataGrade1['pros_unit']>0){
				$blankcounter++;
			}
			if($dataGrade1['grade_q3']>=60 && $dataGrade1['pros_unit']>0){
				$blankcounter++;
			}
			if($dataGrade1['grade_q4']>=60 && $dataGrade1['pros_unit']>0){
				$blankcounter++;
			}
			$blankcountertotal = $blankcountertotal + $blankcounter; 
			
			$aveQ1 += ($grade*$dataGrade1['pros_unit']);
			if($grade<60){
				$gradedUnits1+=0;
			} 
			else {
				$gradedUnits1+=$dataGrade1['pros_unit'];
			}
			if(($dataGrade1['grade_q1']<75 || $dataGrade1['grade_q2']<75 || $dataGrade1['grade_q3']<75 || $dataGrade1['grade_q4']<75) && $dataGrade1['pros_unit']>0) { $below80counter++;}
		?>
		<td align="center" <?php echo ($grade<60?"bgcolor=lightgray":"");?>><b><?php echo ($grade<75 && $dataGrade1['pros_unit']>0?"<font color=red>":"");?><?php echo ($grade<80 && $grade>=75 && $dataGrade1['pros_unit']>0?"<font color=blue>":"");?><?php echo ($countGrade1<$countCourses?"<font size=1 color=maroon>".$dataGrade1['pros_title']."</font><br><u>".$grade:($grade<60?"":($blankcounter<4?$grade:$grade)));?></td>
		<?php 
		} 
		
		?>
		<td align="center" bgcolor="yellow"><b><?php echo ($blankcountertotal>=($countUnits*4)?number_format($aveQ1/$countUnits,3):"");?></b></td>
		<td align="center" bgcolor="yellow"><b><?php echo ($blankcountertotal>=($countUnits*4)?round($aveQ1/$countUnits,0):"");?></b></td>
		<td align="left"
		<?php
		if($countUnits!=$gradedUnits1){
		}
		else{
			if(round($aveQ1/$countUnits,0)>=98 && $below80counter==0 && $blankcountertotal>=($countUnits*4)){
				echo " bgcolor=pink><b>Hghst Hnr";
			}
			else if(round($aveQ1/$countUnits,0)>=95 && $below80counter==0 && $blankcountertotal>=($countUnits*4)){
				echo " bgcolor=cyan><b>High Hnr";
			}
			else if(round($aveQ1/$countUnits,0)>=90 && $below80counter==0 && $blankcountertotal>=($countUnits*4)){
				echo " bgcolor=lightgreen><b>w/ Hnr";
			}
			else if(round($aveQ1/$countUnits,0)>=75 && $blankcountertotal>=($countUnits*4)){
				echo ">PASSED";
			}
			else if(round($aveQ1/$countUnits,0)==""){
				echo ">-";
			}
			else if(round($aveQ1/$countUnits,0)<75){
				echo "><font color=red>FAILED</font>";
			}
		}
		?>
		</td>
	</tr>
	<?php 
	$i++;
	} ?>

</table>
<table width="800">
	<tr>
		<td colspan="3"><i>Note: Students with a mark lower than 80 in any of the learning areas are disqualified from the honors list.<br>NE* Not Enrolled.</i></td>
	</tr>
	<tr>
		<td colspan="3"></td>
	</tr>
	<?php 
			$checkDetails = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
			$dataDetails = dbarray($checkDetails);
			?>
	<tr>
		<td>Prepared by:<br><br><br><strong><?php echo strtoupper($dataTeacher['user_fullname']); ?></strong><br>Class Adviser</td>
		<td>Noted by:<br><br><br><strong><?php echo strtoupper($dataDetails['settings_registrar']); ?></strong><br>School Registrar</td>
		<td>Attested by:<br><br><br><strong><?php echo strtoupper($dataDetails['settings_principal']); ?></strong><br>School Principal</td>
	</tr>
</table>