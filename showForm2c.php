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
		font-size: 0.6em;
	} 
	
	td {
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.5em;		
	}
	</style>	
</head><br>
<table border="0" cellspacing="0" cellpadding="1" width="800">
	<tr>
		<td width="10%" align="right"><img src="./assets/images/deped_logo.png" width="40"></td>
		<td align="center" valign="top">
			<strong><font size="+1">School Form 2 (SF2) Daily Attendance Report of Learners</font></strong><br>
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
					<td width="3%"></td>
					<td width="3%" align="right"></td>
					<td align="right" colspan="2"><font size="1">For the Month of &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	</td>
				</tr>
		
			</table>
		</td>
		<td width="10%"><img src="./assets/images/sanhs_logo.png" width="40"></td>
	</tr>
</table>
<table border="1" cellspacing="0" cellpadding="1" width="800">
	<tr>
		<th rowspan="3" width="1%">#</th>
		<th rowspan="3" width="20%">NAME (Last Name, First Name, Middle Name)</th>
		<th colspan="25">(1st row for date)</th>
		<th rowspan="3" width="10%">Section</th>
	</tr>
	<tr height="15">
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
	</tr>
	<tr>
		<th>M</th>
		<th>T</th>
		<th>W</th>
		<th>TH</th>
		<th>F</th>
		<th>M</th>
		<th>T</th>
		<th>W</th>
		<th>TH</th>
		<th>F</th>
		<th>M</th>
		<th>T</th>
		<th>W</th>
		<th>TH</th>
		<th>F</th>
		<th>M</th>
		<th>T</th>
		<th>W</th>
		<th>TH</th>
		<th>F</th>
		<th>M</th>
		<th>T</th>
		<th>W</th>
		<th>TH</th>
		<th>F</th>	
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
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
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
		<td align="center"><strong><=== MALE | TOTAL Per Day ===></strong></td>
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
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
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
		<td align="center"><strong><=== FEMALE | TOTAL Per Day ===></strong></td>
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
		<td></td>
		<td></td>

	<tr height="25">
		<td align="right"><strong><?php echo $m+$f;?></strong></td>
		<td align="center"><strong>Combined | TOTAL Per Day</strong></td>
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
		<td></td>
		<td></td>
	</tr>	
</table>
