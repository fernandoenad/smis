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
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.6em;
	} 
	
	td {
		height: 10px;
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
<table border="0" cellspacing="0" cellpadding="0" width="750">
	<tr>
		<td width="60" valign="top"><img src="./assets/images/sanhs_logo.png" width="50"></td>
		<td align="left" valign="top">
		<strong><?php echo $current_school_name;?></strong><br>
		<?php echo $current_school_address;?>
		<h4>School Year <?php echo $_GET['enrol_sy']; ?>-<?php echo $_GET['enrol_sy']+1; ?>, <?php echo ($current_sem==1?"First":"Second");?> Semester<br>
		Attendance Summary for Section <?php echo $_GET['classProfile'];?> 
		<br>Adviser: <?php echo $dataTeacher['user_fullname']; ?></h4>

		</td>
	</tr>
</table>
<table border="1" cellspacing="0" cellpadding="1" width="750">
	<tr>
		<th width="2%">#</th>
		<th>Student Name</th>
		<th width="9%">First Day</th>
		<th width="4%">Jun</th>
		<th width="4%">Jul</th>
		<th width="4%">Aug</th>
		<th width="4%">Sep</th>
		<th width="4%">Oct</th>
		<th width="4%">Nov</th>
		<th width="4%">Dec</th>
		<th width="4%">Jan</th>
		<th width="4%">Feb</th>
		<th width="4%">Mar</th>
		<th width="4%">Apr</th>
		<th width="4%">May</th>
		<th width="7%">Total</th>
		<th width="7%">%</th>
	</tr>
	<?php
	$checkAtt = dbquery("SELECT * FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$_GET['enrol_sy']."')");
	$dataAtt1 = dbarray($checkAtt)
	?>
	<tr bgcolor="lightgray">
		<th>-</td>
		<th>Total School Days</td>
		<th><?php echo $current_bosy;?></td>
		<th><?php echo ($dataAtt1['sch_m1']==0?"-":$dataAtt1['sch_m1']);?></th>
		<th><?php echo ($dataAtt1['sch_m2']==0?"-":$dataAtt1['sch_m2']);?></th>
		<th><?php echo ($dataAtt1['sch_m3']==0?"-":$dataAtt1['sch_m3']);?></th>
		<th><?php echo ($dataAtt1['sch_m4']==0?"-":$dataAtt1['sch_m4']);?></th>
		<th><?php echo ($dataAtt1['sch_m5']==0?"-":$dataAtt1['sch_m5']);?></th>
		<th><?php echo ($dataAtt1['sch_m6']==0?"-":$dataAtt1['sch_m6']);?></th>
		<th><?php echo ($dataAtt1['sch_m7']==0?"-":$dataAtt1['sch_m7']);?></th>
		<th><?php echo ($dataAtt1['sch_m8']==0?"-":$dataAtt1['sch_m8']);?></th>
		<th><?php echo ($dataAtt1['sch_m9']==0?"-":$dataAtt1['sch_m9']);?></th>
		<th><?php echo ($dataAtt1['sch_m10']==0?"-":$dataAtt1['sch_m10']);?></th>
		<th><?php echo ($dataAtt1['sch_m11']==0?"-":$dataAtt1['sch_m11']);?></th>
		<th><?php echo ($dataAtt1['sch_m12']==0?"-":$dataAtt1['sch_m12']);?></th>
		<?php
		$checkSchoolDays = dbquery("SELECT (sch_m1 + sch_m2 + sch_m3 + sch_m4 + sch_m5 + sch_m6 + sch_m7 + sch_m8 + sch_m9 + sch_m10 + sch_m11 + sch_m12) as total FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$_GET['enrol_sy']."')");
		$dataSchoolDays = dbarray($checkSchoolDays)
		?>
		<th><?php echo ($dataSchoolDays['total']==0?"-":$dataSchoolDays['total']);?></th>
		<th>-</th>
	</tr>
	<tr>
	<?php
	$i=1;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no INNER JOIN school_days ON enrol_stud_no=sch_stud_no WHERE (sch_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."') ORDER BY stud_gender DESC, stud_lname ASC, stud_fname ASC");
	while($dataAtt = dbarray($result)){
	?>
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($dataAtt['stud_lname'].", ".$dataAtt['stud_fname']." ".$dataAtt['stud_xname']." ".($dataAtt['stud_mname']=="-"?$dataAtt['stud_mname']:substr($dataAtt['stud_mname'],0,1)."."));?></td>
		<td align="center"><?php echo $dataAtt['sch_firstday'];?></td>
		<td align="center"><?php echo ($dataAtt['sch_m1']==0?"-":$dataAtt['sch_m1']);?></td>
		<td align="center"><?php echo ($dataAtt['sch_m2']==0?"-":$dataAtt['sch_m2']);?></td>
		<td align="center"><?php echo ($dataAtt['sch_m3']==0?"-":$dataAtt['sch_m3']);?></td>
		<td align="center"><?php echo ($dataAtt['sch_m4']==0?"-":$dataAtt['sch_m4']);?></td>
		<td align="center"><?php echo ($dataAtt['sch_m5']==0?"-":$dataAtt['sch_m5']);?></td>
		<td align="center"><?php echo ($dataAtt['sch_m6']==0?"-":$dataAtt['sch_m6']);?></td>
		<td align="center"><?php echo ($dataAtt['sch_m7']==0?"-":$dataAtt['sch_m7']);?></td>
		<td align="center"><?php echo ($dataAtt['sch_m8']==0?"-":$dataAtt['sch_m8']);?></td>
		<td align="center"><?php echo ($dataAtt['sch_m9']==0?"-":$dataAtt['sch_m9']);?></td>
		<td align="center"><?php echo ($dataAtt['sch_m10']==0?"-":$dataAtt['sch_m10']);?></td>
		<td align="center"><?php echo ($dataAtt['sch_m11']==0?"-":$dataAtt['sch_m11']);?></td>
		<td align="center"><?php echo ($dataAtt['sch_m12']==0?"-":$dataAtt['sch_m12']);?></td>
			<?php
			$checkPresent = dbquery("SELECT (sch_m1 + sch_m2 + sch_m3 + sch_m4 + sch_m5 + sch_m6 + sch_m7 + sch_m8 + sch_m9 + sch_m10 + sch_m11 + sch_m12) as total FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$dataAtt['stud_no']."')");
			$dataPresent = dbarray($checkPresent)
			?>
		<td align="center"><?php echo round($dataPresent['total'],2);?></td>
			<?php
			$checkSchoolDays = dbquery("SELECT (sch_m1 + sch_m2 + sch_m3 + sch_m4 + sch_m5 + sch_m6 + sch_m7 + sch_m8 + sch_m9 + sch_m10 + sch_m11 + sch_m12) as total FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$_GET['enrol_sy']."')");
			$dataSchoolDays = dbarray($checkSchoolDays)
			?>
		<td align="center"><?php echo round($dataPresent['total']/($dataSchoolDays['total']==0?1:$dataSchoolDays['total'])*100,2);?>%</td>
	</tr>	
	<?php $i++; } ?>
	<tr bgcolor="lightgray">
	<?php
		$checkAveAtt = dbquery("SELECT SUM( sch_m1 ) AS m1, SUM( sch_m2 ) AS m2, SUM( sch_m3 ) AS m3, SUM( sch_m4 ) AS m4, SUM( sch_m5 ) AS m5, SUM( sch_m6 ) AS m6, SUM( sch_m7 ) AS m7, SUM( sch_m8 ) AS m8, SUM( sch_m9 ) AS m9, SUM( sch_m10 ) AS m10, SUM( sch_m11 ) AS m11, SUM( sch_m12 ) AS m12
						FROM studenroll
						INNER JOIN student ON enrol_stud_no = stud_no
						INNER JOIN school_days ON enrol_stud_no = sch_stud_no
						WHERE (enrol_section =  '".$_GET['classProfile']."' AND enrol_sy='".$_GET['enrol_sy']."' AND sch_sy='".$_GET['enrol_sy']."')
						ORDER BY stud_gender DESC , stud_lname ASC , stud_fname ASC");
		$dataAtt = dbarray($checkAveAtt);
		$i--;
	?>
		<th>-</td>
		<th>Average Attendance</td>
		<th>-</td>
		<th><?php echo ($dataAtt['m1']==0?"-":number_format($dataAtt['m1']/($dataAtt1['sch_m1']==0?1:$dataAtt1['sch_m1']),2));?></th>
		<th><?php echo ($dataAtt['m2']==0?"-":number_format($dataAtt['m2']/($dataAtt1['sch_m2']==0?1:$dataAtt1['sch_m2']),2));?></th>
		<th><?php echo ($dataAtt['m3']==0?"-":number_format($dataAtt['m3']/($dataAtt1['sch_m3']==0?1:$dataAtt1['sch_m3']),2));?></th>
		<th><?php echo ($dataAtt['m4']==0?"-":number_format($dataAtt['m4']/($dataAtt1['sch_m4']==0?1:$dataAtt1['sch_m4']),2));?></th>
		<th><?php echo ($dataAtt['m5']==0?"-":number_format($dataAtt['m5']/($dataAtt1['sch_m5']==0?1:$dataAtt1['sch_m5']),2));?></th>
		<th><?php echo ($dataAtt['m6']==0?"-":number_format($dataAtt['m6']/($dataAtt1['sch_m6']==0?1:$dataAtt1['sch_m6']),2));?></th>
		<th><?php echo ($dataAtt['m7']==0?"-":number_format($dataAtt['m7']/($dataAtt1['sch_m7']==0?1:$dataAtt1['sch_m7']),2));?></th>
		<th><?php echo ($dataAtt['m8']==0?"-":number_format($dataAtt['m8']/($dataAtt1['sch_m8']==0?1:$dataAtt1['sch_m8']),2));?></th>
		<th><?php echo ($dataAtt['m9']==0?"-":number_format($dataAtt['m9']/($dataAtt1['sch_m9']==0?1:$dataAtt1['sch_m9']),2));?></th>
		<th><?php echo ($dataAtt['m10']==0?"-":number_format($dataAtt['m10']/($dataAtt1['sch_m10']==0?1:$dataAtt1['sch_m10']),2));?></th>
		<th><?php echo ($dataAtt['m11']==0?"-":number_format($dataAtt['m11']/($dataAtt1['sch_m11']==0?1:$dataAtt1['sch_m11']),2));?></th>
		<th><?php echo ($dataAtt['m12']==0?"-":number_format($dataAtt['m12']/($dataAtt1['sch_m12']==0?1:$dataAtt1['sch_m12']),2));?></th>
		<th>-</th>
		<th>-</th>
	</tr>	
</table>
<table border="0" cellspacing="0" cellpadding="0" width="750">
	<tr>
		<td colspan="2">
		<br><br>
		Prepared by:<br><br><br>
		<b><?php echo strtoupper($dataTeacher['user_fullname']); ?></b><br>
		Class Adviser
		
		
		</td>
	</tr>
</table>
