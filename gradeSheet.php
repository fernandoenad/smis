<?php
require('maincore.php');
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<style>
	.borderdraw {
		position:fixed;
		border-style:solid;
		height:0;
		line-height:0;
		width:0;
		z-index:-1;
	}

	.tag1{ z-index:9999;position:absolute;top:40px; }
	.tag2 { z-index:9999;position:absolute;left:40px; }
	.diag { position: relative; width: 50px; height: 50px; }
	.outerdivslant { position: absolute; top: 0px; left: 0px; border-color: transparent transparent transparent rgb(64, 0, 0); border-width: 50px 0px 0px 60px;}
	.innerdivslant {position: absolute; top: 1px; left: 0px; border-color: transparent transparent transparent #fff; border-width: 49px 0px 0px 59px;}                  

	table {
	
	}
	
	th{
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.7em;
	} 
	
	td {
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: .7em;		
	}
	</style>	
</head>
<table border="0" cellspacing="0" cellpadding="1" width="800">
	<tr>
		<td width="10%" align="right"><img src="./assets/images/deped_logo.png" width="40"></td>
		<td align="center" valign="top">
			<strong><font size="+1">Record of Class Performance</font></strong><br>
			<br>
			<table width="100%" border="0">
			<?php
			$checkClass = dbquery("SELECT * FROM class INNER JOIN prospectus ON class_pros_no=pros_no INNER JOIN users ON class_user_name=user_no WHERE class_no='".$_GET['class_no']."'");
			$dataClass= dbarray($checkClass);
			?>
				<tr height="25">
					<td width="15%" align="right" ><font size="1">Level / Subject &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $dataClass['pros_level'];?> / <?php echo $dataClass['pros_title'];?></td>
					<td width="3%"></td>
					<td></td>
					<td width="15%" align="right"><font size="1">Schedule / Room &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $dataClass['class_timeslots'];?> (<?php echo $dataClass['class_days'];?>) / <?php echo $dataClass['class_room'];?></td>
				</tr>
		
			</table>
		</td>
		<td width="10%"><img src="./assets/images/sanhs_logo.png" width="40"></td>
	</tr>
</table>
<table border="1" cellspacing="0" cellpadding="1" width="800">
	<tr height="30">
		<th width="1%">#</th>
		<th width="20%">NAME (Last Name, First Name, MI)</th>
		<th width="4%">Quarter 1 / Midterms</th>
		<th width="4%">Quarter 2 / Finals</th>
		<th width="4%">Quarter 3 (JHS Only)</th>
		<th width="4%">Quarter 4 (JHS Only)</th>
		<th width="4%" bgcolor="yellow">Average</th>
		<th width="10%">Section</th>
	</tr>
	<?php
	$i=1;
	$MLEi=0;
	$result= dbquery("SELECT * FROM grade INNER JOIN student ON grade_stud_no=stud_no INNER JOIN studenroll ON stud_no=enrol_stud_no WHERE (grade_class_no='".$_GET['class_no']."' AND enrol_sy='".$_GET['enrol_sy']."' AND student.stud_gender='MALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="18">
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".substr($data['stud_mname'],0,1));?></td>
		<?php
		$resultGrade1 = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade_class_no='".$_GET['class_no']."' AND grade.grade_stud_no='".$data['stud_no']."' AND class.class_sy='".$data['enrol_sy']."') ORDER BY pros_sort ASC");
		$dataGrade1 = dbarray($resultGrade1);
		?>
		<td align="center"><b><?php echo ($dataGrade1['grade_q1']<60?"":$dataGrade1['grade_q1']);?></td>
		<td align="center"><b><?php echo ($dataGrade1['grade_q2']<60?"":$dataGrade1['grade_q2']);?></td>
		<td align="center"><b><?php echo ($dataGrade1['grade_q3']<60?"":$dataGrade1['grade_q3']);?></td>
		<td align="center"><b><?php echo ($dataGrade1['grade_q4']<60?"":$dataGrade1['grade_q4']);?></td>
		<td align="center" bgcolor="yellow">
			<strong>
			<?php echo ($dataGrade1['grade_sem']<12&& ($dataGrade1['grade_q1']>=60 && $dataGrade1['grade_q2']>=60)?$dataGrade1['grade_final']:($dataGrade1['grade_sem']==12 && ($dataGrade1['grade_q1']>=60 && $dataGrade1['grade_q2']>=60 && $dataGrade1['grade_q3']>=60 && $dataGrade1['grade_q4']>=60)?$dataGrade1['grade_final']:""))?>
		</td>
		<td><?php echo $data['enrol_section'];?></td>
	</tr>
	<?php 

	if(substr($data['enrol_remarks'],0,2)=="LE"){
		$MLEi++;
	}
		$i++;
	} 
	$m = $i-1;
	?>
	<tr height="25">
		<td align="right"><strong><?php echo $i-1;?></strong></td>
		<td align="center"><strong>#</strong></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<?php
	$i=1;
	$FLEi=0;
	$result= dbquery("SELECT * FROM grade INNER JOIN student ON grade_stud_no=stud_no INNER JOIN studenroll ON stud_no=enrol_stud_no WHERE (grade_class_no='".$_GET['class_no']."' AND enrol_sy='".$_GET['enrol_sy']."' AND student.stud_gender='FEMALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="18">
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".substr($data['stud_mname'],0,1));?></td>
		<?php
		$resultGrade1 = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade_class_no='".$_GET['class_no']."' AND grade.grade_stud_no='".$data['stud_no']."' AND class.class_sy='".$data['enrol_sy']."') ORDER BY pros_sort ASC");
		$dataGrade1 = dbarray($resultGrade1);
		?>
		<td align="center"><b><?php echo ($dataGrade1['grade_q1']==0?"":$dataGrade1['grade_q1']);?></td>
		<td align="center"><b><?php echo ($dataGrade1['grade_q2']==0?"":$dataGrade1['grade_q2']);?></td>
		<td align="center"><b><?php echo ($dataGrade1['grade_q3']==0?"":$dataGrade1['grade_q3']);?></td>
		<td align="center"><b><?php echo ($dataGrade1['grade_q4']==0?"":$dataGrade1['grade_q4']);?></td>
		<td align="center" bgcolor="yellow">
			<strong>
			<?php echo ($dataGrade1['grade_sem']<12&& ($dataGrade1['grade_q1']>=60 && $dataGrade1['grade_q2']>=60)?$dataGrade1['grade_final']:($dataGrade1['grade_sem']==12 && ($dataGrade1['grade_q1']>=60 && $dataGrade1['grade_q2']>=60 && $dataGrade1['grade_q3']>=60 && $dataGrade1['grade_q4']>=60)?$dataGrade1['grade_final']:""))?>
		</td>
		<td><?php echo $data['enrol_section'];?></td>
	</tr>
	<?php 
	if(substr($data['enrol_remarks'],0,2)=="LE"){
		$FLEi++;
	}
		$i++;
	} 
	$f = $i-1;
	?>
	<tr height="25">
		<td align="right"><strong><?php echo $i-1;?></strong></td>
		<td align="center"><strong>#</strong></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>
<table>
	<tr>
		<td colspan="8">
			<br>
			Submitted by:<br>
			<br>
			<?php
			$checkTeacher = dbquery("SELECT * FROM class INNER JOIN users ON class_user_name=user_no WHERE class_no='".$_GET['class_no']."'");
			$dataTeacher = dbarray($checkTeacher );
			?>
			<b><?php echo strtoupper($dataTeacher['user_fullname']);?></b><br>
			Teacher		
		</td>
	</tr>
</table>

