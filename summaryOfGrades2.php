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
		font-size: 0.5em;		
	}
	</style>	
</head>
<?php
$resultTeacher = dbquery("SELECT * FROM section INNER JOIN users ON section.section_adviser=users.user_no WHERE (section_name='".$_GET['classProfile']."' AND section_sy='".$_GET['enrol_sy']."')");
$dataTeacher = dbarray($resultTeacher);
?>
<table border="0" cellspacing="0" cellpadding="1" width="1200">
<tr>
		<td width="10%" align="right"><img src="./assets/images/deped_logo.png" width="80"></td>
		<td align="center" valign="top">
			<strong><font size="+1">FINAL GRADES AND GENERAL AVERAGE																																														</font></strong><br>
			<br><br>
			<table width="100%" border="0">
				<tr height="25">
					<td width="10%" align="right" ><font size="1">Region &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1">302887</td>
					<td width="5%"></td>
					<td><font size="1"></td>
					<td width="8%" align="right"><font size="1">Division &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1">Bohol</td>
					<td width="5%"></td>
					<td width="8%" align="right"><font size="1">School Year &nbsp;</td>
					<td align="center" colspan="2" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?></td>
					<td></td>
				</tr>
				<tr height="25">
					<td align="right" border="1"><font size="1">School Name &nbsp;</td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1">San Agustin NHS</td>
					<td align="right"><font size="1">School ID &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1">302887</td>
					<td></td>
					<td align="right" valign="middle"><font size="1"></td>
					<?php
					$resultLevel = dbquery("SELECT * FROM section WHERE (section_name='".$_GET['classProfile']."' AND section_sy='".$_GET['enrol_sy']."')");
					$dataLevel = dbarray($resultLevel);
					?>
					<td colspan="2" align="center"><font size="1"></td>
					<td width="5%" align="right"></td>
					<td><font size="1"></td>
				</tr>				
			</table>
		</td>
		<td width="10%"><img src="./assets/images/sanhs_logo.png" width="80"></td>
	</tr>
</table>
<table border="1" cellspacing="0" cellpadding="1" width="1200">
	<tr>
		<th width="1%" rowspan="3">#</th>
		<th rowspan="3" width="10%">JUNIOR HIGH SCHOOL<br>GRADE and SECTION</th>
	<?php
		$resultSection = dbquery("SELECT * FROM section WHERE (section_name='AMETHYST' AND section_sy='".$current_sy."')");
		$dataSection = dbarray($resultSection);
		$checkCourses = dbquery("SELECT * FROM class INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (class.class_sy='".$_GET['enrol_sy']."' AND class.class_section_no='".$dataSection['section_no']."') ORDER BY pros_sort ASC");
		$countCourses = dbrows($checkCourses);
		while($dataCourses = dbarray($checkCourses)){
	?>
		<th colspan="5" width="8%"><?php echo substr($dataCourses['pros_title'],0,strlen($dataCourses['pros_title'])-1);?></th>
	<?php
	}
	?>	
		<th colspan="5" width="8%">Gen. Ave.</th>
		
	</tr>
	<tr>
	<?php
	for ($i=1;$i<=$countCourses+1;$i++){
	?>
		<th colspan="4">QUARTER</th>
		<th rowspan="2" width="2%" bgcolor="yellow"><small>FG</th>
	<?php
	}
	?>
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
	$result= dbquery("SELECT * FROM section WHERE (section_sy='".$_GET['enrol_sy']."' AND section_level<'11' AND section_name NOT LIKE '%Z_TLE%') ORDER BY section_level ASC, section_name ASC");
	while($data = dbarray($result)){
	?>
	<tr>
		<td><?php echo $i;?></td>
		<td><?php echo $data['section_level'];?> - <?php echo $data['section_name'];?></td>
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
		$checkCourses = dbquery("SELECT * FROM class INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (class.class_sy='".$_GET['enrol_sy']."' AND class.class_section_no='".$data['section_no']."') ORDER BY pros_sort ASC");
		while($dataCourses = dbarray($checkCourses)){
			$checkGrade = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade_class_no='".$dataCourses['class_no']."' AND class.class_sy='".$current_sy."') ORDER BY pros_sort ASC");
			$dataGrade1 = dbarray($checkGrade);
		?>
		<td align="center"><?php echo ($dataGrade1['grade_q1']==0?"":$dataGrade1['grade_q1']);?></td>
		<td align="center"><?php echo ($dataGrade1['grade_q2']==0?"":$dataGrade1['grade_q2']);?></td>
		<td align="center"><?php echo ($dataGrade1['grade_q3']==0?"":$dataGrade1['grade_q3']);?></td>
		<td align="center"><?php echo ($dataGrade1['grade_q4']==0?"":$dataGrade1['grade_q4']);?></td>
		<td align="center" bgcolor="yellow"><strong><?php echo ($dataGrade1['grade_final']==0?"":$dataGrade1['grade_final']);?></td>
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
		} 
		?>
		<td align="center"><?php echo ($countUnits!=$gradedUnits1?"":round($aveQ1/$countUnits,0));?></td>
		<td align="center"><?php echo ($countUnits!=$gradedUnits2?"":round($aveQ2/$countUnits,0));?></td>
		<td align="center"><?php echo ($countUnits!=$gradedUnits3?"":round($aveQ3/$countUnits,0));?></td>
		<td align="center"><?php echo ($countUnits!=$gradedUnits4?"":round($aveQ4/$countUnits,0));?></td>
		<td align="center" bgcolor="yellow"><b><?php echo ($countUnits!=$gradedUnitsqf?"":round($aveQf/$countUnits,0));?></b></td>
	</tr>
	<?php 
	$i++;
	} ?>

</table><br>
<table width="1350">
	<tr>
		<td>Prepared by:<br><br><br><strong><?php echo strtoupper($current_registrar); ?></strong><br>School Registrar</td>
		<td></td>
		<td>Attested by:<br><br><br><strong><?php echo strtoupper($current_principal); ?></strong><br>School Principal</td>
	</tr>
</table>