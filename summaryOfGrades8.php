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
<table border="0" cellspacing="0" cellpadding="1" width="750">
	<tr>
		<td width="10%" align="right"><img src="./assets/images/deped_logo.png" width="50"></td>
		<td align="center" valign="top">
			<h3><?php echo $current_school_name;?><br>Graduation Summary<br>
			SY: <?php echo $_GET['enrol_sy']; ?>-<?php echo $_GET['enrol_sy']+1; ?> / Section: <?php echo $_GET['classProfile']; ?>
			<br>Adviser: <u><?php echo strtoupper($dataTeacher['user_fullname']); ?></u> </h3>

		</td>
		<td width="10%"><img src="./assets/images/sanhs_logo.png" width="50"></td>
	</tr>
</table>
<table border="1" cellspacing="0" cellpadding="1" width="750">
	<tr>
		<th width="1%">#</th>
		<th>NAME</th>
		<th width="15%">Number of Subjects Taken</th>
		<th width="15%">Number of Fails</th>
		<th width="15%">SHS Average (Dec)</th>
		<th width="10%">SHS Average</th>
		<th width="20%">Remarks</th>
	</tr>
	<?php
	$i=1;
	$MLEi=0;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no INNER JOIN studcontacts ON student.stud_no=studCont_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='MALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="20">
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
		<td align="center">
		<?php 
		$SearchSubjects=dbquery("select * from grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no where (grade_stud_no='".$data['stud_no']."' and pros_level>10)");
		echo $CountSubjects=dbrows($SearchSubjects);
		?>
		</td>
		<td align="center">
		<?php 
		$SearchSubjects=dbquery("select * from grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no where (grade_stud_no='".$data['stud_no']."' and pros_level>10 and grade_final<75)");
		echo $CountSubjects=dbrows($SearchSubjects);
		?>		
		</td>
		<td align="center">
		<?php
		$resultAverage = dbquery("select * from grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no where (grade_stud_no='".$data['stud_no']."' and pros_level>10)");
		$totalunits = 0;
		$totalgrades = 0;
		while($dataAverage = dbarray($resultAverage)){
			$subgrades = ($dataAverage['grade_recomputedfinalgrade']>0 || $dataAverage['grade_recomputedfinalgrade']!=NULL?$dataAverage['grade_recomputedfinalgrade']:$dataAverage['grade_final']);
			$totalunits = $totalunits + ($subgrades<60?0:$dataAverage['pros_unit']);
			$totalgrades = $totalgrades + ($subgrades<60?0:($subgrades*$dataAverage['pros_unit']));
		}
		$totalunits = ($totalunits==0?1:$totalunits);
		echo $average = number_format($totalgrades/$totalunits,3);
		?>
		</td>
		<td align="center">
		<?php echo $average = round($totalgrades/$totalunits,0); ?>
		</td>
		<td>
		<?php
		if($average>=98)
			echo "With Highest Honors";
		else if($average>=95)
			echo "With High Honors";
		else if($average>=90)
			echo "With Honors";
		else 
			echo "-";
		?>
		</td>
	</tr>
	<?php 
	$i++;
	} ?>
	<tr height="20">
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
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no INNER JOIN studcontacts ON student.stud_no=studCont_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='FEMALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="20">
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
		<td align="center">
		<?php 
		$SearchSubjects=dbquery("select * from grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no where (grade_stud_no='".$data['stud_no']."' and pros_level>10)");
		echo $CountSubjects=dbrows($SearchSubjects);
		?>
		</td>
		<td align="center">
		<?php 
		$SearchSubjects=dbquery("select * from grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no where (grade_stud_no='".$data['stud_no']."' and pros_level>10 and grade_final<75)");
		echo $CountSubjects=dbrows($SearchSubjects);
		?>		
		</td>
		<td align="center">
		<?php
		$resultAverage = dbquery("select * from grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no where (grade_stud_no='".$data['stud_no']."' and pros_level>10)");
		$totalunits = 0;
		$totalgrades = 0;
		while($dataAverage = dbarray($resultAverage)){
			$subgrades = ($dataAverage['grade_recomputedfinalgrade']>0 || $dataAverage['grade_recomputedfinalgrade']!=NULL?$dataAverage['grade_recomputedfinalgrade']:$dataAverage['grade_final']);
			$totalunits = $totalunits + ($subgrades<60?0:$dataAverage['pros_unit']);
			$totalgrades = $totalgrades + ($subgrades<60?0:($subgrades*$dataAverage['pros_unit']));
		}
		$totalunits = ($totalunits==0?1:$totalunits);
		echo $average = number_format($totalgrades/$totalunits,3);
		?>
		</td>
		<td align="center">
		<?php echo $average = round($totalgrades/$totalunits,0); ?>
		</td>
		<td>
		<?php
		if($average>=98)
			echo "With Highest Honors";
		else if($average>=95)
			echo "With High Honors";
		else if($average>=90)
			echo "With Honors";
		else 
			echo "-";
		?>
		</td>
	</tr>
	<?php 
	$i++;
	} ?>
</table><br>

<table width="750">
			<?php 
			$checkDetails = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
			$dataDetails = dbarray($checkDetails);
			?>
	<tr>
		<td>Prepared by:<br><br><br><strong><?php echo strtoupper($dataTeacher['user_fullname']); ?></strong><br>Class Adviser</td>
		<td>Noted by:<br><br><br><strong><?php echo strtoupper($dataDetails['settings_registrar']);	?></strong><br>School Registrar</td>
		<td>Attested by:<br><br><br><strong><?php echo strtoupper($dataDetails['settings_principal']);	?></strong><br>School Principal</td>
	</tr>
</table>
