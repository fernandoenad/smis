<?php
require('../maincore.php');
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
		font-size: .7em;
	} 
	
	td {
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: .6em;		
	}
	</style>
</head>	
<table border="0" cellspacing="0" cellpadding="0" width="850">
	<tr>
		<td width="60"><img src="../assets/images/sanhs_logo.png" width="50"></td>
		<td align="left" valign="top">
		<strong><?php echo $current_school_name;?></strong><br>
		<?php echo $current_school_address;?>
		<h3>Year Level Masterlist<br>
		</h3>
		</td>
	</tr>
</table>	
<?php
if(isset($_GET['level'])){

?>
<h3>Grade <?php echo $_GET['level'];?> Academic Excellence Awardees</h3>
<?php
$result= dbquery("SELECT * FROM studenroll INNER JOIN student ON studenroll.enrol_stud_no=student.stud_no INNER JOIN studcontacts ON student.stud_no=studcontacts.studCont_stud_no WHERE (studenroll.enrol_sy='".$current_sy."' AND studenroll.enrol_level='".$_GET['level']."' AND studenroll.enrol_status2!='RETAINED' AND studenroll.enrol_status1!='INACTIVE') ORDER BY stud_gender DESC, stud_lname ASC, stud_fname ASC");
$rows = dbrows($result);
?>
<table border="1" cellspacing="0" cellpadding="1" width="850">
	<tr>
		<th width="2%">#</th>
		<th width="3%">LRN</th>
		<th width="8%">FIRSTNAME</th>
		<th width="2%">M.I.</th>
		<th width="7%">LASTNAME</th>
		<th width="1%">EXT</th>
		<th width="3%">Gender</th>
		<th width="8%">Gr & Sec</th>
		<th width="3%">GWA</th>
		<th width="8%">Academic Award</th>
	</tr>
	<?php
	$i=1;
	while($data = dbarray($result)){
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $data['stud_lrn'];?></td>
		<td><?php echo $data['stud_fname'];?></td>
		<td><?php echo ($data['stud_mname']=="-"?"":substr($data['stud_mname'],0,1));?></td>
		<td><?php echo $data['stud_lname'];?></td>
		<td><?php echo $data['stud_xname'];?></td>
		<td><?php echo $data['stud_gender'];?></td>
		<td><?php echo $data['enrol_level']." - ".$data['enrol_section'];?></td>
		<?php
		$resultAverage = dbquery("select * from grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no where (grade_stud_no='".$data['stud_no']."' and pros_level='".$_GET['level']."')");
		$totalunits = 0;
		$totalgrades = 0;
		$award="";
		$below80counter=0;
		while($dataAverage = dbarray($resultAverage)){
			$subgrades = ($dataAverage['grade_recomputedfinalgrade']>0 || $dataAverage['grade_recomputedfinalgrade']!=NULL?$dataAverage['grade_recomputedfinalgrade']:$dataAverage['grade_final']);
			$totalunits = $totalunits + ($subgrades<60?0:$dataAverage['pros_unit']);
			$totalgrades = $totalgrades + ($subgrades<60?0:($subgrades*$dataAverage['pros_unit']));
			if(($dataAverage['grade_q1']<80 || $dataAverage['grade_q2']<80 || $dataAverage['grade_q3']<80 || $dataAverage['grade_q4']<80) && $dataAverage['pros_unit']>0) { $below80counter++;}

		}
		$totalunits = ($totalunits==0?1:$totalunits);
		$average = $totalgrades/$totalunits;

		?>
		<td align="center"><?php echo number_format(round($average,3),3);?></td>
		<?php
		if($average>=97.5)
			$award = "With Highest Honors";
		else if($average>=94.5)
			$award = "With High Honors";	
		else if($average>=89.5)
			$award = "With Honors";		
		?>
		<td><?php echo ($below80counter>0?"":$award);?></td>
	</tr>
	<?php 
	$i++;
	} ?>
</table>
<?php
} 
else {
?>
<h3>Grade 12 Academic Excellence Awardees</h3>
<?php

$result= dbquery("SELECT * FROM studenroll INNER JOIN student ON studenroll.enrol_stud_no=student.stud_no INNER JOIN studcontacts ON student.stud_no=studcontacts.studCont_stud_no WHERE (studenroll.enrol_sy='".$current_sy."' AND studenroll.enrol_level='12' AND studenroll.enrol_status2!='RETAINED' AND studenroll.enrol_status1!='INACTIVE') ORDER BY stud_gender DESC, stud_lname ASC, stud_fname ASC");
$rows = dbrows($result);
?>
<table border="1" cellspacing="0" cellpadding="1" width="850">
	<tr>
		<th width="2%">#</th>
		<th width="3%">LRN</th>
		<th width="8%">FIRSTNAME</th>
		<th width="2%">M.I.</th>
		<th width="7%">LASTNAME</th>
		<th width="1%">EXT</th>
		<th width="3%">Gender</th>
		<th width="8%">Gr & Sec</th>
		<th width="3%">GWA</th>
		<th width="8%">Academic Award</th>
	</tr>
	<?php
	$i=1;
	while($data = dbarray($result)){
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $data['stud_lrn'];?></td>
		<td><?php echo $data['stud_fname'];?></td>
		<td><?php echo ($data['stud_mname']=="-"?"":substr($data['stud_mname'],0,1));?></td>
		<td><?php echo $data['stud_lname'];?></td>
		<td><?php echo $data['stud_xname'];?></td>
		<td><?php echo $data['stud_gender'];?></td>
		<td><?php echo $data['enrol_level']." - ".$data['enrol_section'];?></td>
		<?php
		$resultAverage = dbquery("select * from grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no where (grade_stud_no='".$data['stud_no']."' and pros_level>10)");
		$totalunits = 0;
		$totalgrades = 0;
		$award="";
		$below80counter=0;
		while($dataAverage = dbarray($resultAverage)){
			$subgrades = ($dataAverage['grade_recomputedfinalgrade']>0 || $dataAverage['grade_recomputedfinalgrade']!=NULL?$dataAverage['grade_recomputedfinalgrade']:$dataAverage['grade_final']);
			$totalunits = $totalunits + ($subgrades<60?0:$dataAverage['pros_unit']);
			$totalgrades = $totalgrades + ($subgrades<60?0:($subgrades*$dataAverage['pros_unit']));
			if(($dataAverage['grade_q1']<80 || $dataAverage['grade_q2']<80) && $dataAverage['pros_unit']>0) { $below80counter++;}
			
		}
		$totalunits = ($totalunits==0?1:$totalunits);
		$average = $totalgrades/$totalunits;

		?>
		<td align="center"><?php echo number_format(round($average,3),3);?></td>
		<?php
		if($average>=97.5)
			$award = "With Highest Honors";
		else if($average>=94.5)
			$award = "With High Honors";	
		else if($average>=89.5)
			$award = "With Honors";		
		?>
		<td><?php echo ($below80counter>0?"":$award);?></td>
	</tr>
	<?php 
	$i++;
	} ?>
</table>
<?php
}
?>