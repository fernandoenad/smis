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
		font-size: 0.6em;		
	}
	</style>	
</head>
<?php
$resultTeacher = dbquery("SELECT * FROM section INNER JOIN users ON section.section_adviser=users.user_no WHERE (section_name='".$_GET['classProfile']."' AND section_sy='".$_GET['enrol_sy']."')");
$dataTeacher = dbarray($resultTeacher);
?>
<table border="0" cellspacing="0" cellpadding="1" width="1500">
<tr>
		<td width="10%" align="right"><img src="./assets/images/deped_logo.png" width="80"></td>
		<td align="center" valign="top">
			<strong><font size="+1">FINAL GRADES AND GENERAL AVERAGE																																														</font></strong><br>
			<small><i>Prepared by: <b><?php echo $dataTeacher['user_fullname'];?></i></small>
			<br><br>
			<table width="100%" border="0">
				<tr height="25">
					<td width="10%" align="right" ><font size="1">Region &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_region;?></td>
					<td width="5%"></td>
					<td><font size="1"></td>
					<td width="8%" align="right"><font size="1">Division &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_division;?></td>
					<td width="5%"></td>
					<td width="8%" align="right"><font size="1">School Year &nbsp;</td>
					<td align="center" colspan="2" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?></td>
					<td></td>
				</tr>
				<tr height="25">
					<td align="right" border="1"><font size="1">School Name &nbsp;</td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_full;?></td>
					<td align="right"><font size="1">School ID &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_code;?></td>
					<td></td>
					<td align="right" valign="middle"><font size="1">Grade & Sec. &nbsp;</td>
					<?php
					$resultLevel = dbquery("SELECT * FROM section WHERE (section_name='".$_GET['classProfile']."' AND section_sy='".$_GET['enrol_sy']."')");
					$dataLevel = dbarray($resultLevel);
					?>
					<td colspan="2" align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $dataLevel['section_level'];?> - <?php echo $_GET['classProfile'];?></td>
					<td width="5%" align="right"></td>
					<td><font size="1"></td>
				</tr>				
			</table>
		</td>
		<td width="10%"><img src="./assets/images/sanhs_logo.png" width="80"></td>
	</tr>
</table>
<table border="1" cellspacing="0" cellpadding="1" width="1500">
	<tr>
		<th width="1%" rowspan="3">#</th>
		<th rowspan="3" width="8%">NAME OF LEARNERS</th>
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
		$checkCourses = dbquery("SELECT * FROM class INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (class.class_sy='".$_GET['enrol_sy']."' AND class.class_section_no='".$dataSection['section_no']."' and class_sem='".$active_sem."') ORDER BY pros_sort ASC");
		$countCourses = dbrows($checkCourses);
		while($dataCourses = dbarray($checkCourses)){
	?>
		<th colspan="5" width="5%"><?php echo $dataCourses['pros_title'];?> <br>(<?php echo $dataCourses['pros_unit'];?> unit/s)</th>
	<?php
	}
	?>	
		<th colspan="6" width="6%">Gen. Ave.</th>
		<th rowspan="3" width="2%">Remarks</th>
	</tr>
	<tr>
	<?php
	for ($i=1;$i<=$countCourses+1;$i++){
	?>
		<th colspan="4">QUARTER</th>
		<th rowspan="2" width="1%" bgcolor="yellow"><small>FG</th>
	<?php
	}
	?>
		<th rowspan="2" width="1%" bgcolor="yellow"><small>FG</th>
	</tr>	
	<tr>
	<?php
	for ($i=1;$i<=$countCourses;$i++){
	?>
		<th>1</th>
		<th>2</th>
		<th>3</th>
		<th>4</th>
	<?php
	}
	?>
		<th>1</th>
		<th>2</th>
		<th>3</th>
		<th>4</th>
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
		$gradedUnits2=0;
		$gradedUnits3=0;
		$gradedUnits4=0;
		$gradedUnitsqf=0;
		$aveQ1=0;
		$aveQ2=0;
		$aveQ3=0;
		$aveQ4=0;
		$aveQf=0;
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
		while($dataGrade1 = dbarray($resultGrade1)){
			
		?>
		<td align="center"><b><?php echo ($dataGrade1['grade_q1']==0?"":$dataGrade1['grade_q1']);?></td>
		<td align="center"><b><?php echo ($dataGrade1['grade_q2']==0?"":$dataGrade1['grade_q2']);?></td>
		<td align="center"><b><?php echo ($dataGrade1['grade_q3']==0?"":$dataGrade1['grade_q3']);?></td>
		<td align="center"><b><?php echo ($dataGrade1['grade_q4']==0?"":$dataGrade1['grade_q4']);?></td>
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
		?>
		<td align="center" bgcolor="yellow"><strong><?php echo ($countUnits!=$gradedUnits1 || $countUnits!=$gradedUnits2?"":($dataGrade1['grade_final']<75?"<font color=red>".$dataGrade1['grade_final']."</font>":$dataGrade1['grade_final']));?></td>
		<?php
		} 
		?>
		<?php 
		if($countUnits==0){
			$countUnits=1;
			for ($ii=1;$ii<=$countCourses;$ii++){
				echo "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td bgcolor=\"yellow\">&nbsp;</td>";
			}
		}
		?>
		<td align="center"><b><?php echo ($countUnits!=$gradedUnits1?"":round($aveQ1/$countUnits,0));?></td>
		<td align="center"><b><?php echo ($countUnits!=$gradedUnits2?"":round($aveQ2/$countUnits,0));?></td>
		<td align="center"><b><?php echo ($countUnits!=$gradedUnits3?"":round($aveQ3/$countUnits,0));?></td>
		<td align="center"><b><?php echo ($countUnits!=$gradedUnits4?"":round($aveQ4/$countUnits,0));?></td>
		<td align="center" bgcolor="yellow"><b><?php echo ($countUnits!=$gradedUnits1 || $countUnits!=$gradedUnits2?"":number_format($aveQf/$countUnits,3));?></b></td>
		<td align="center" bgcolor="yellow"><b><?php echo ($countUnits!=$gradedUnits1 || $countUnits!=$gradedUnits2?"":round($aveQf/$countUnits,0));?></b></td>
		<td align="left">
		<?php
		if($countUnits!=$gradedUnits1 || $countUnits!=$gradedUnits2){
		}
		else{
			if(round($aveQf/$countUnits,0)>=98){
				echo "<b>Hghst Honor";
			}
			else if(round($aveQf/$countUnits,0)>=95){
				echo "<b>High Honor";
			}
			else if(round($aveQf/$countUnits,0)>=90){
				echo "<b>w/ Honor";
			}
			else if(round($aveQf/$countUnits,0)>=75){
				echo "PASSED";
			}
			else if(round($aveQf/$countUnits,0)==""){
				echo "-";
			}
			else{
				echo "<font color=red>FAILED</font>";
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
		<td>#</td>
		<td>#</td>
		<td>#</td>
		<td>#</td>
		<?php
		}
		?>	
		<td>#</td>
		<td>#</td>
		<td>#</td>
		<td>#</td>
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
		$gradedUnits2=0;
		$gradedUnits3=0;
		$gradedUnits4=0;
		$gradedUnitsqf=0;
		$aveQ1=0;
		$aveQ2=0;
		$aveQ3=0;
		$aveQ4=0;
		$aveQf=0;
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
		while($dataGrade1 = dbarray($resultGrade1)){
			
		?>
		<td align="center"><b><?php echo ($dataGrade1['grade_q1']==0?"":$dataGrade1['grade_q1']);?></td>
		<td align="center"><b><?php echo ($dataGrade1['grade_q2']==0?"":$dataGrade1['grade_q2']);?></td>
		<td align="center"><b><?php echo ($dataGrade1['grade_q3']==0?"":$dataGrade1['grade_q3']);?></td>
		<td align="center"><b><?php echo ($dataGrade1['grade_q4']==0?"":$dataGrade1['grade_q4']);?></td>
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
		?>
		<td align="center" bgcolor="yellow"><strong><?php echo ($countUnits!=$gradedUnits1 || $countUnits!=$gradedUnits2?"":($dataGrade1['grade_final']<75?"<font color=red>".$dataGrade1['grade_final']."</font>":$dataGrade1['grade_final']));?></td>
		<?php
		} 
		?>
		<?php 
		if($countUnits==0){
			$countUnits=1;
			for ($ii=1;$ii<=$countCourses;$ii++){
				echo "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td bgcolor=\"yellow\">&nbsp;</td>";
			}
		}
		?>
		<td align="center"><b><?php echo ($countUnits!=$gradedUnits1?"":round($aveQ1/$countUnits,0));?></td>
		<td align="center"><b><?php echo ($countUnits!=$gradedUnits2?"":round($aveQ2/$countUnits,0));?></td>
		<td align="center"><b><?php echo ($countUnits!=$gradedUnits3?"":round($aveQ3/$countUnits,0));?></td>
		<td align="center"><b><?php echo ($countUnits!=$gradedUnits4?"":round($aveQ4/$countUnits,0));?></td>
		<td align="center" bgcolor="yellow"><b><?php echo ($countUnits!=$gradedUnits1 || $countUnits!=$gradedUnits2?"":number_format($aveQf/$countUnits,3));?></b></td>
		<td align="center" bgcolor="yellow"><b><?php echo ($countUnits!=$gradedUnits1 || $countUnits!=$gradedUnits2?"":round($aveQf/$countUnits,0));?></b></td>
		<td align="left">
		<?php
		if($countUnits!=$gradedUnits1 || $countUnits!=$gradedUnits2){
		}
		else{
			if(round($aveQf/$countUnits,0)>=98){
				echo "<b>Hghst Honor";
			}
			else if(round($aveQf/$countUnits,0)>=95){
				echo "<b>High Honor";
			}
			else if(round($aveQf/$countUnits,0)>=90){
				echo "<b>w/ Honor";
			}
			else if(round($aveQf/$countUnits,0)>=75){
				echo "PASSED";
			}
			else if(round($aveQf/$countUnits,0)==""){
				echo "-";
			}
			else{
				echo "<font color=red>FAILED</font>";
			}

		}
		?>
		</td>
	</tr>
	<?php 
	$i++;
	} ?>
</table><br>
<table width="1500">
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