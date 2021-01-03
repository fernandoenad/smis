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
		font-size: 0.7em;		
	}
	</style>	
</head>
<table border="0" cellspacing="0" cellpadding="1" width="780">
	<tr>
		<td width="20%" align="right"><img src="./assets/images/deped_word.png" width="80"></td>
		<td align="center" valign="top">
			Republic of the Philippines<br>	
			Department of Education	<br>										
			<?php echo $current_school_region; ?><br>	
			Division of <?php echo $current_school_division; ?><br>												
		</td>
		<td width="20%"><img src="./assets/images/sanhs_logo.png" width="80"></td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td align="center" valign="top">										
		</td>
		<td width="20%"></td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td align="center" valign="top"><b>REPORT ON ENROLLMENT AND ATTENDANCE</b></td>
		<td width="20%"></td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<?php
		$month = 0;
		$year = 0;
		$monthname = "";
		switch($_GET['classProfile']){
			case "sch_m1": $monthname="June"; $month=6; $year=$current_sy; break;
			case "sch_m2": $monthname="July"; $month=7; $year=$current_sy; break;
			case "sch_m3": $monthname="August"; $month=8; $year=$current_sy; break;
			case "sch_m4": $monthname="September"; $month=9; $year=$current_sy; break;
			case "sch_m5": $monthname="October"; $month=10; $year=$current_sy; break;
			case "sch_m6": $monthname="November"; $month=11; $year=$current_sy; break;
			case "sch_m7": $monthname="December"; $month=12; $year=$current_sy; break;
			case "sch_m8": $monthname="January"; $month=1; $year=$current_sy+1; break;
			case "sch_m9": $monthname="February"; $month=2; $year=$current_sy+1; break;
			case "sch_m10": $monthname="March"; $month=3; $year=$current_sy+1; break;
			case "sch_m11": $monthname="April"; $month=4; $year=$current_sy+1; break;
			case "sch_m12": $monthname="May";  $month=5; $year=$current_sy+1; break;
		
		}
		?>
		<td align="center" valign="top">End of Month for <?php echo $monthname.", ".$year;?> </td>
		<td width="20%"></td>
	</tr>
	<tr>
		<td width="20%" align="right"> </td>
		<td align="center" valign="top"></td>
		<td width="20%"></td>
	</tr>
	<tr>
		<td width="20%" align="right">Name of School: </td>
		<td align="left" valign="top"><b><?php echo $current_school_name;?></b></td>
		<td width="20%"></td>
	</tr>
	<tr>
		<td width="20%" align="right">Address: </td>
		<td align="left" valign="top"><b><?php echo $current_school_address;?></b></td>
		<td width="20%"></td>
	</tr>
	<tr>
		<td width="20%" align="right"></td>
		<td align="center" valign="top"> </td>
		<td width="20%"></td>
	</tr>
	<tr>
		<td align="left" colspan="3">List all your teachers including those without advisory, locally funded and their subjects handled.</td>
	</tr>
</table>
<?php
 $dateLimit =  $year."-".$month."-"."31 23:59:59";
?>

<table border="1" cellspacing="0" cellpadding="1" width="780">
	<tr>
		<th colspan="2" rowspan="3">NAME OF TEACHER	</th>
		<th width="10%" rowspan="3">Plantilla <br>Position</th>
		<th width="8%" rowspan="3">No. of Teaching Minutes/ Week</th>
		<th width="18%" rowspan="3">Grade Level & <br> Section</th>
		<th width="15%" colspan="3" rowspan="2">ANNUAL ENROLLMENT</th>
		<th width="15%" colspan="3" rowspan="2">MONTHLY ENROLLMENT</th>
		<th width="5%" rowspan="3">Remarks</th>
	</tr>
	<tr>
	</tr>
	<tr>
		<th>M</th>
		<th>F</th>
		<th>T</th>
		<th>M</th>
		<th>F</th>
		<th>T</th>
	</tr>
	<?php 
	$checkSections = dbquery("select * from section inner join users on section_adviser=user_no where (section_sy='".$current_sy."')  order by section_level asc, section_name asc");
	$i=1;
	while($dataSections = dbarray($checkSections)){
		if(substr($dataSections['section_name'],0,2)=="Z_"){}
		else{
	?>
	
	<tr>
		<td width="1%"><?php echo $i;?></td>
		<td><?php echo strtoupper(($dataSections['user_no']==1?"TBA":$dataSections['user_fullname']));?></td>
		<?php
		$checkPosition=  dbquery("select * from teacherappointments where (teacherappointments_teach_no='".$dataSections['user_no']."' and teacherappointments_active='1')");
		$dataPosition= dbarray($checkPosition);
		?>
		<td><small><?php echo $dataPosition['teacherappointments_position'];?></small></td>
		<?php
		$totalMinutes = 0;
		$checkAssignments = dbquery("SELECT * FROM class INNER JOIN prospectus ON class_pros_no=pros_no INNER JOIN section ON class_section_no=section_no WHERE (class_sy='".$_GET['enrol_sy']."' AND class_user_name='".$dataSections['user_no']."' and (pros_sem='".$current_sem."' or pros_sem=12))");
		while($dataAssignments = dbarray($checkAssignments)){
		if(substr($dataAssignments['pros_title'],0,3)=="***"){}
		else{
		$totalMinutes = $totalMinutes + ($dataAssignments['pros_hoursPerWk']*60);
		}
		}
		?>
		<td align="right"><?php echo round(($totalMinutes)/5,0);?></td>		
		<td><?php echo $dataSections['section_level']." - ".strtoupper($dataSections['section_name']);?></td>
		<?php
		$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='MALE' and enrol_admitdate <= '".$dateLimit."')");
		$countEnrolM = dbrows($checkEnrolM);
		$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='FEMALE' and enrol_admitdate <= '".$dateLimit."')");
		$countEnrolF = dbrows($checkEnrolF);
		$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' and enrol_admitdate <= '".$dateLimit."')");
		$countEnrolT = dbrows($checkEnrolT);
		?>
		<td align="right"><?php echo number_format($countEnrolM,0);?></td>
		<td align="right"><?php echo number_format($countEnrolF,0);?></td>
		<td align="right"><?php echo number_format($countEnrolT,0);?></td>
		<?php
		$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='MALE' and enrol_admitdate <= '".$dateLimit."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
		$countEnrolM = dbrows($checkEnrolM);
		$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='FEMALE' and enrol_admitdate <= '".$dateLimit."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
		$countEnrolF = dbrows($checkEnrolF);
		$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' and enrol_admitdate <= '".$dateLimit."' and (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
		$countEnrolT = dbrows($checkEnrolT);
		?>
		<td align="right"><?php echo number_format($countEnrolM,0);?></td>
		<td align="right"><?php echo number_format($countEnrolF,0);?></td>
		<td align="right"><?php echo number_format($countEnrolT,0);?></td>
		<td></td>
	</tr>
	<?php
		$i++;
		}
	}
	?>
	<?php 
	$checkSections = dbquery("select * from users inner join teacher on user_no=teach_no where (user_no NOT IN (select section_adviser from section where (section_sy='".$current_sy."')) and user_role!='3' and user_status='1' and teach_teacher='1') order by user_fullname asc");
	while($dataSections = dbarray($checkSections)){
	?>
	<tr>
		<td width="1%"><?php echo $i;?></td>
		<td><?php echo $dataSections['user_fullname'];?></td>
		<?php
		$checkPosition=  dbquery("select * from teacherappointments where (teacherappointments_teach_no='".$dataSections['user_no']."' and teacherappointments_active='1') order by teacherappointments_date desc");
		$dataPosition= dbarray($checkPosition);
		?>
		<td><small><?php echo $dataPosition['teacherappointments_position'];?></small></td>
		<?php
		
		$totalMinutes = 0;
		$checkAssignments = dbquery("SELECT * FROM class INNER JOIN prospectus ON class_pros_no=pros_no INNER JOIN section ON class_section_no=section_no WHERE (class_sy='".$_GET['enrol_sy']."' AND class_user_name='".$dataSections['user_no']."' and (pros_sem='".$current_sem."' or pros_sem=12))");
		while($dataAssignments = dbarray($checkAssignments)){
		if(substr($dataAssignments['pros_title'],0,3)=="***"){}
		else{
		$totalMinutes = $totalMinutes + ($dataAssignments['pros_hoursPerWk']*60);
		}
		}
		?>
		<td align="right"><?php echo round(($totalMinutes)/5,0);?></td>	
		<td><small><small>
		<?php
		$checkPosition=  dbquery("select * from teacherappointments where (teacherappointments_teach_no='".$dataSections['user_no']."' and teacherappointments_item_no='ANCILLARY') order by teacherappointments_date desc");
		while($dataPosition= dbarray($checkPosition)){
			echo strtoupper($dataPosition['teacherappointments_position']).", ";
		}
		$checkAssignments = dbquery("SELECT * FROM class INNER JOIN prospectus ON class_pros_no=pros_no INNER JOIN section ON class_section_no=section_no WHERE (class_sy='".$_GET['enrol_sy']."' AND class_user_name='".$dataSections['user_no']."' and (pros_sem='".$current_sem."' or pros_sem=12)) group by pros_title");
		while($dataAssignments = dbarray($checkAssignments)){
			echo $dataAssignments['pros_title'].", ";
		}
		?></small></small>
		</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<?php
		$i++;
	}
	?>
</table>
<br>
<table border="1" cellspacing="0" cellpadding="1" width="780">
	<tr>
		<th colspan="2" rowspan="3">Grade Level Summary	</th>
		<th width="10%" rowspan="3">National</th>
		<th width="8%" rowspan="3">LGU</th>
		<th width="18%" rowspan="3"></th>
		<th width="15%" colspan="3" rowspan="2">ANNUAL ENROLLMENT</th>
		<th width="15%" colspan="3" rowspan="2">MONTHLY ENROLLMENT</th>
		<th width="5%" rowspan="3">Remarks</th>
	</tr>
	<tr>
	</tr>
	<tr>
		<th>M</th>
		<th>F</th>
		<th>T</th>
		<th>M</th>
		<th>F</th>
		<th>T</th>
	</tr>
	<?php 
	$i=1;
	$checkSections = dbquery("select * from section inner join users on section_adviser=user_no where (section_sy='".$current_sy."' and section_name NOT LIKE 'Z_%')  group by section_level order by section_level asc, section_name asc");
	while($dataSections = dbarray($checkSections)){
	?>
	<tr>
		<td width="1%"><?php echo $i;?></td>
		<td>Grade <?php echo $dataSections['section_level'];?> Summary</td>
		<?php 
		$checkNational  = dbquery("select * from section  inner join teacherappointments on section_adviser=teacherappointments_teach_no WHERE (section_sy='".$current_sy."' and teacherappointments_funding='NATIONAL' and section_level='".$dataSections['section_level']."' and teacherappointments_active='1' and section_name NOT LIKE 'Z_%') ");	
		$countNational = dbrows($checkNational);
		
		?>
		<td align="right"><?php echo $countNational;?></td>
		<?php 
		$checkNotNational  = dbquery("select * from section  inner join teacherappointments on section_adviser=teacherappointments_teach_no WHERE (section_sy='".$current_sy."' and teacherappointments_funding!='NATIONAL' and section_level='".$dataSections['section_level']."' and teacherappointments_active='1' and section_name NOT LIKE 'Z_%') ");	
		$countNotNational = dbrows($checkNotNational);
		?>
		<td align="right"><?php echo $countNotNational;?></td>
		<td></td>
		<?php
		$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' AND stud_gender='MALE' and enrol_admitdate <= '".$dateLimit."')");
		$countEnrolM = dbrows($checkEnrolM);
		$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' AND stud_gender='FEMALE' and enrol_admitdate <= '".$dateLimit."')");
		$countEnrolF = dbrows($checkEnrolF);
		$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_admitdate <= '".$dateLimit."')");
		$countEnrolT = dbrows($checkEnrolT);
		?>
		<td align="right"><?php echo number_format($countEnrolM,0);?></td>
		<td align="right"><?php echo number_format($countEnrolF,0);?></td>
		<td align="right"><?php echo number_format($countEnrolT,0);?></td>
		<?php
		$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' AND stud_gender='MALE' and enrol_admitdate <= '".$dateLimit."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
		$countEnrolM = dbrows($checkEnrolM);
		$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' AND stud_gender='FEMALE' and enrol_admitdate <= '".$dateLimit."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
		$countEnrolF = dbrows($checkEnrolF);
		$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_admitdate <= '".$dateLimit."' and (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
		$countEnrolT = dbrows($checkEnrolT);
		?>
		<td align="right"><?php echo number_format($countEnrolM,0);?></td>
		<td align="right"><?php echo number_format($countEnrolF,0);?></td>
		<td align="right"><?php echo number_format($countEnrolT,0);?></td>
		<td></td>
	</tr>
	<?php
		$i++;
	}
	?>
	
	<tr>
		<td width="1%"><?php echo $i++;?></td>
		<td>Relieving Teachers Summary</td>
		<?php 
		$checkNational  = dbquery("select * from users inner join teacher on user_no=teach_no inner join teacherappointments on user_no=teacherappointments_teach_no WHERE (user_no NOT IN (select section_adviser from section where (section_sy='".$current_sy."')) and teacherappointments_funding='NATIONAL' and user_role!='3' and user_status='1' and teach_teacher='1' and teacherappointments_active='1')");
		$countNational = dbrows($checkNational);
		?>
		<td align="right"><?php echo $countNational;?></td>
		<?php 
		$checkNotNational  = dbquery("select * from users inner join teacher on user_no=teach_no inner join teacherappointments on user_no=teacherappointments_teach_no WHERE (user_no NOT IN (select section_adviser from section where (section_sy='".$current_sy."')) and (teacherappointments_funding='MUNICIPAL' or teacherappointments_funding='PROVINCIAL' or teacherappointments_funding='REGIONAL') and user_role!='3' and user_status='1' and teach_teacher='1' and teacherappointments_active='1')");
		$countNotNational = dbrows($checkNotNational);
		?>
		<td align="right"><?php echo $countNotNational;?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>

		<td></td>
	</tr>
	<tr bgcolor="lightgray">
		<th width="1%"></th>
		<th>GRAND TOTAL</th>
		<?php 
		$checkNational  = dbquery("select * from users inner join teacher on user_no=teach_no inner join teacherappointments on user_no=teacherappointments_teach_no WHERE (teacherappointments_funding='NATIONAL' and user_role!='3' and user_status='1' and teach_teacher='1' and teacherappointments_active='1' )");	
		$countNational = dbrows($checkNational);
		?>
		<th align="right"><?php echo $countNational;?></th>
		<?php 
		$checkNotNational  = dbquery("select * from users inner join teacher on user_no=teach_no inner join teacherappointments on user_no=teacherappointments_teach_no WHERE ((teacherappointments_funding='MUNICIPAL' or teacherappointments_funding='PROVINCIAL' or teacherappointments_funding='REGIONAL') and user_role!='3' and user_status='1' and teach_teacher='1' and teacherappointments_active='1')");			
		$countNotNational = dbrows($checkNotNational);
		?>
		<th align="right"><?php echo $countNotNational;?></th>
		<th></th>
		<?php
		$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section!='' AND stud_gender='MALE' and enrol_admitdate <= '".$dateLimit."')");
		$countEnrolM = dbrows($checkEnrolM);
		$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section!='' AND stud_gender='FEMALE' and enrol_admitdate <= '".$dateLimit."')");
		$countEnrolF = dbrows($checkEnrolF);
		$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section!='' and enrol_admitdate <= '".$dateLimit."')");
		$countEnrolT = dbrows($checkEnrolT);
		?>
		<th align="right"><?php echo number_format($countEnrolM,0);?></th>
		<th align="right"><?php echo number_format($countEnrolF,0);?></th>
		<th align="right"><?php echo number_format($countEnrolT,0);?></th>
		<?php
		$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section!='' AND stud_gender='MALE' and enrol_admitdate <= '".$dateLimit."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
		$countEnrolM = dbrows($checkEnrolM);
		$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section!='' AND stud_gender='FEMALE' and enrol_admitdate <= '".$dateLimit."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
		$countEnrolF = dbrows($checkEnrolF);
		$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section!='' and enrol_admitdate <= '".$dateLimit."' and (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
		$countEnrolT = dbrows($checkEnrolT);
		?>
		<th align="right"><?php echo number_format($countEnrolM,0);?></th>
		<th align="right"><?php echo number_format($countEnrolF,0);?></th>
		<th align="right"><?php echo number_format($countEnrolT,0);?></th>
		<th></th>
	</tr>
</table>
<br>
<table border="0" cellspacing="0" cellpadding="1" width="780">
	<tr>
		<td width="50%">Prepared by:</td>
		<td>Respectfully submitted by: </td>
	</tr>
	<tr>
		<td><br><br><center><b><?php echo strtoupper($current_registrar);?></b> <br>School Registrar</center></td>
		<td><br><br><center><b><?php echo strtoupper($current_principal);?></b> <br>School Principal</center></td>
	</tr>
</table>
