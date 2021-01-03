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
</head>
<table border="0" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<td width="10%" align="right"><img src="./assets/images/deped_logo.png" width="80"></td>
		<td align="center" valign="top">
			<strong><font size="+1">School Form 4 (SF4) Monthly Learner's Movement and Attendance </font></strong><br>
			<small><i>(This replaced Form 3 & STS Form 4-Absenteeism and Dropout Profile)</i></small>
			<br><br>
			<table width="100%" border="0">
				<tr height="25">
					<td width="10%" align="right" ><font size="1">School ID &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_code;?></td>
					<td width="5%"></td>
					<td></td>
					<td width="8%" align="right"><font size="1">Region &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_reg_code;?></td>
					<td width="5%"></td>
					<td width="8%" align="right"><font size="1">Division &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_division;?></td>
					<td width="8%" align="right"><font size="1">District &nbsp;</td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_district;?></td>

				</tr>
				<tr height="25">
					<td align="right" border="1"><font size="1">School Name &nbsp;</td>
					<td align="center" colspan="4" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_full;?> </td>
					<td align="right"><font size="1">School Year</td>
					<td align="center" colspan="2" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?></td>
					<td align="right"><font size="1">Report for the Month of</td>
					<td align="center" colspan="4" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1">
					<?php
					$month = 0;
					$year = 0;
					switch($_GET['classProfile']){
						case "sch_m1": echo "June"; $month=6; $year=$current_sy; break;
						case "sch_m2": echo "July"; $month=7; $year=$current_sy; break;
						case "sch_m3": echo "August"; $month=8; $year=$current_sy; break;
						case "sch_m4": echo "September"; $month=9; $year=$current_sy; break;
						case "sch_m5": echo "October"; $month=10; $year=$current_sy; break;
						case "sch_m6": echo "November"; $month=11; $year=$current_sy; break;
						case "sch_m7": echo "December"; $month=12; $year=$current_sy; break;
						case "sch_m8": echo "January"; $month=1; $year=$current_sy+1; break;
						case "sch_m9": echo "February"; $month=2; $year=$current_sy+1; break;
						case "sch_m10": echo "March"; $month=3; $year=$current_sy+1; break;
						case "sch_m11": echo "April"; $month=4; $year=$current_sy+1; break;
						case "sch_m12": echo "May";  $month=5; $year=$current_sy+1; break;
					
					}
					?>
					</td>
				
				</tr>				
			</table>
		</td>
		<td width="10%"><img src="./assets/images/deped_word.png" width="80"></td>
	</tr>
</table>
<?php
 $dateLimit =  $year."-".$month."-"."31 23:59:59";
 $prevLimit =  (($month-1)==0?$year-1:$year)."-".(($month-1)==0?12:$month-1)."-"."31 23:59:59";
?>

<table border="1" cellspacing="0" cellpadding="1" width="1135">
	<tr align="center">
		<th width="13%" rowspan="3">NAME OF ADVISER</th>
		<th width="5%" rowspan="3">GRADE/ YEAR LEVEL</th>
		<th width="6%" rowspan="3">SECTION</th>
		<th rowspan="2" colspan="3">REGISTERED LEARNERS<br>(As of End of the Month)</th>
		<th colspan="6">ATTENDANCE</th>
		<th colspan="9">DROPPED OUT</th>
		<th colspan="9">TRANSFERRED OUT</th>
		<th colspan="9">TRANSFERRED IN</th>
	</tr>
	<tr align="center">
		<td colspan="3">Daily Average</td>
		<td colspan="3">Percentage for the Month</td>
		<td colspan="3">(A) Cumulative as of Previous Month</td>
		<td colspan="3">(B) For the Month</td>
		<td colspan="3">(A+B) Cumulative as of End of the Month</td>
		<td colspan="3">(A) Cumulative as of Previous Month</td>
		<td colspan="3">(B) For the Month</td>
		<td colspan="3">(A+B) Cumulative as of End of the Month</td>
		<td colspan="3">(A) Cumulative as of Previous Month</td>
		<td colspan="3">(B) For the Month</td>
		<td colspan="3">(A+B) Cumulative as of End of the Month</td>
	</tr>
	<tr align="center">
		<td width="2%">M</td>
		<td width="2%">F</td>
		<td width="2%">T</td>
		<td width="2%">M</td>
		<td width="2%">F</td>
		<td width="2%">T</td>
		<td width="2%">M</td>
		<td width="2%">F</td>
		<td width="2%">T</td>
		<td width="2%">M</td>
		<td width="2%">F</td>
		<td width="2%">T</td>
		<td width="2%">M</td>
		<td width="2%">F</td>
		<td width="2%">T</td>
		<td width="2%">M</td>
		<td width="2%">F</td>
		<td width="2%">T</td>
		<td width="2%">M</td>
		<td width="2%">F</td>
		<td width="2%">T</td>
		<td width="2%">M</td>
		<td width="2%">F</td>
		<td width="2%">T</td>
		<td width="2%">M</td>
		<td width="2%">F</td>
		<td width="2%">T</td>
		<td width="2%">M</td>
		<td width="2%">F</td>
		<td width="2%">T</td>
		<td width="2%">M</td>
		<td width="2%">F</td>
		<td width="2%">T</td>
		<td width="2%">M</td>
		<td width="2%">F</td>
		<td width="2%">T</td>
	</tr>
	
	<?php
	$checkSections = dbquery("SELECT * FROM section INNER JOIN users ON section_adviser=user_no WHERE section_sy='".$_GET['enrol_sy']."' and section_level>10 ORDER BY section_level ASC, section_name ASC");
	while($dataSections = dbarray($checkSections)){
		if(substr($dataSections['section_name'],0,2)=="Z_"){}
		else{
	?>
		<tr height="18">
			<td width="2%"><?php echo ($dataSections['user_no']=="1"?"TBA":strtoupper($dataSections['user_fullname']));?></td>
			<td width="1%" align="center"><b><?php echo $dataSections['section_level'];?></td>
			<td width="2%"><?php echo strtoupper($dataSections['section_name']);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='MALE' and enrol_admitdate <= '".$dateLimit."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='FEMALE' and enrol_admitdate <= '".$dateLimit."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' and enrol_admitdate <= '".$dateLimit."' and (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
			<?php
				$checkMonth = $_GET['classProfile'];
				$checkAttM = dbquery("SELECT SUM($checkMonth) as  mon_sum FROM studenroll INNER JOIN student on enrol_stud_no=stud_no INNER JOIN school_days ON stud_no=sch_stud_no WHERE (sch_sy='".$_GET['enrol_sy']."' AND enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' and enrol_admitdate <= '".$dateLimit."' AND stud_gender='MALE' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
				$countAttM = dbarray($checkAttM);
				$checkAttF = dbquery("SELECT SUM($checkMonth) as  mon_sum FROM studenroll INNER JOIN student on enrol_stud_no=stud_no INNER JOIN school_days ON stud_no=sch_stud_no WHERE (sch_sy='".$_GET['enrol_sy']."' AND enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' and enrol_admitdate <= '".$dateLimit."' AND stud_gender='FEMALE' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
				$countAttF = dbarray($checkAttF);
				$checkAttT = dbquery("SELECT SUM($checkMonth) as  mon_sum FROM studenroll INNER JOIN student on enrol_stud_no=stud_no INNER JOIN school_days ON stud_no=sch_stud_no WHERE (sch_sy='".$_GET['enrol_sy']."' AND enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' and enrol_admitdate <= '".$dateLimit."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
				$countAttT = dbarray($checkAttT);
				$checkDay = dbquery("SELECT SUM($checkMonth) as mon_sum FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$_GET['enrol_sy']."')");
				$dataDay = dbarray($checkDay);

				$mon_aveM=$countAttM['mon_sum']/($dataDay['mon_sum']==0?1:$dataDay['mon_sum']);
				$mon_aveF=$countAttF['mon_sum']/($dataDay['mon_sum']==0?1:$dataDay['mon_sum']);
				$mon_aveT=$countAttT['mon_sum']/($dataDay['mon_sum']==0?1:$dataDay['mon_sum']);

			?>		
			<td align="right" width="2%"><?php echo number_format($mon_aveM,2);?></td>
			<td align="right" width="2%"><?php echo number_format($mon_aveF,2);?></td>
			<td align="right" width="2%"><?php echo number_format($mon_aveT,2);?></td>
			<?php
				$percentAttM = $mon_aveM / ($countEnrolM==0?1:$countEnrolM) *100;
				$percentAttF = $mon_aveF / ($countEnrolF==0?1:$countEnrolF) *100;
				$percentAttT = $mon_aveT / ($countEnrolT==0?1:$countEnrolT) *100;
			?>
			<td align="right" width="2%"><?php echo number_format($percentAttM,2);?>%</td>
			<td align="right" width="2%"><?php echo number_format($percentAttF,2);?>%</td>
			<td align="right" width="2%"><?php echo number_format($percentAttT,2);?>%</td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='MALE' and enrol_graddate <= '".$prevLimit."' AND enrol_status2='DROPPED OUT')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='FEMALE' and enrol_graddate <= '".$prevLimit."' AND enrol_status2='DROPPED OUT')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' and enrol_graddate <= '".$prevLimit."' AND enrol_status2='DROPPED OUT')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='MALE' and (enrol_graddate > '".$prevLimit."'  and enrol_graddate <= '".$dateLimit."') AND enrol_status2='DROPPED OUT')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='FEMALE' and (enrol_graddate > '".$prevLimit."'  and enrol_graddate <= '".$dateLimit."') AND enrol_status2='DROPPED OUT')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' and (enrol_graddate > '".$prevLimit."'  and enrol_graddate <= '".$dateLimit."') AND enrol_status2='DROPPED OUT')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='MALE' and enrol_graddate <= '".$dateLimit."' AND enrol_status2='DROPPED OUT')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='FEMALE' and enrol_graddate <= '".$dateLimit."' AND enrol_status2='DROPPED OUT')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' and enrol_graddate <= '".$dateLimit."' AND enrol_status2='DROPPED OUT')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='MALE' and enrol_graddate <= '".$prevLimit."' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='FEMALE' and enrol_graddate <= '".$prevLimit."' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' and enrol_graddate <= '".$prevLimit."' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='MALE' and (enrol_graddate > '".$prevLimit."' and enrol_graddate <= '".$dateLimit."') AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='FEMALE' and (enrol_graddate > '".$prevLimit."' and enrol_graddate <= '".$dateLimit."') AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' and (enrol_graddate > '".$prevLimit."' and enrol_graddate <= '".$dateLimit."') AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolT,0);?></td>
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='MALE' and enrol_graddate <= '".$dateLimit."' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='FEMALE' and enrol_graddate <= '".$dateLimit."' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' and enrol_graddate <= '".$dateLimit."' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='MALE' and enrol_admitdate <= '".$prevLimit."' AND enrol_ti='1')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='FEMALE' and enrol_admitdate <= '".$prevLimit."' AND enrol_ti='1')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' and enrol_admitdate <= '".$prevLimit."' AND enrol_ti='1')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='MALE' and (enrol_admitdate > '".$prevLimit."' and enrol_admitdate <= '".$dateLimit."') AND enrol_ti='1')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='FEMALE' and (enrol_admitdate > '".$prevLimit."' and enrol_admitdate <= '".$dateLimit."') AND enrol_ti='1')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' and (enrol_admitdate > '".$prevLimit."' and enrol_admitdate <= '".$dateLimit."') AND enrol_ti='1')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolT,0);?></td>
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='MALE' and (enrol_admitdate <= '".$dateLimit."') AND enrol_ti='1')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' AND stud_gender='FEMALE' and (enrol_admitdate <= '".$dateLimit."') AND enrol_ti='1')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataSections['section_name']."' and (enrol_admitdate <= '".$dateLimit."') AND enrol_ti='1')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
		</tr>
		
	<?php
		}}
	?>
		<tr>
			<th align="left" colspan="3">SECONDARY:</th>
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
	$checkSections = dbquery("SELECT * FROM section INNER JOIN users ON section_adviser=user_no WHERE section_sy='".$_GET['enrol_sy']."' and section_level>10 GROUP BY section_level ORDER BY section_level ASC, section_name ASC");
	while($dataSections = dbarray($checkSections)){
		if(substr($dataSections['section_name'],0,2)=="Z_"){}
		else{
	?>
		<tr>
			<td width="1%" align="center" colspan="3">GRADE <?php echo $dataSections['section_level'];?></td>
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' AND stud_gender='MALE' and enrol_admitdate <= '".$dateLimit."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' AND stud_gender='FEMALE' and enrol_admitdate <= '".$dateLimit."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_admitdate <= '".$dateLimit."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
			<?php
				$checkMonth = $_GET['classProfile'];
				$checkAttM = dbquery("SELECT SUM($checkMonth) as  mon_sum FROM studenroll INNER JOIN student on enrol_stud_no=stud_no INNER JOIN school_days ON stud_no=sch_stud_no WHERE (sch_sy='".$_GET['enrol_sy']."' AND enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_admitdate <= '".$dateLimit."' AND stud_gender='MALE' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
				$countAttM = dbarray($checkAttM);
				$checkAttF = dbquery("SELECT SUM($checkMonth) as  mon_sum FROM studenroll INNER JOIN student on enrol_stud_no=stud_no INNER JOIN school_days ON stud_no=sch_stud_no WHERE (sch_sy='".$_GET['enrol_sy']."' AND enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_admitdate <= '".$dateLimit."' AND stud_gender='FEMALE' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
				$countAttF = dbarray($checkAttF);
				$checkAttT = dbquery("SELECT SUM($checkMonth) as  mon_sum FROM studenroll INNER JOIN student on enrol_stud_no=stud_no INNER JOIN school_days ON stud_no=sch_stud_no WHERE (sch_sy='".$_GET['enrol_sy']."' AND enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_admitdate <= '".$dateLimit."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
				$countAttT = dbarray($checkAttT);
				$checkDay = dbquery("SELECT SUM($checkMonth) as mon_sum FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$_GET['enrol_sy']."')");
				$dataDay = dbarray($checkDay);
				
				$mon_aveM=$countAttM['mon_sum']/($dataDay['mon_sum']==0?1:$dataDay['mon_sum']);
				$mon_aveF=$countAttF['mon_sum']/($dataDay['mon_sum']==0?1:$dataDay['mon_sum']);
				$mon_aveT=$countAttT['mon_sum']/($dataDay['mon_sum']==0?1:$dataDay['mon_sum']);

			?>		
			<td align="right" width="2%"><?php echo number_format($mon_aveM,2);?></td>
			<td align="right" width="2%"><?php echo number_format($mon_aveF,2);?></td>
			<td align="right" width="2%"><?php echo number_format($mon_aveT,2);?></td>
			<?php
				$percentAttM = $mon_aveM / ($countEnrolM==0?1:$countEnrolM) *100;
				$percentAttF = $mon_aveF / ($countEnrolF==0?1:$countEnrolF) *100;
				$percentAttT = $mon_aveT / ($countEnrolT==0?1:$countEnrolT) *100;
			?>
			<td align="right" width="2%"><?php echo number_format($percentAttM,2);?>%</td>
			<td align="right" width="2%"><?php echo number_format($percentAttF,2);?>%</td>
			<td align="right" width="2%"><?php echo number_format($percentAttT,2);?>%</td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_graddate <= '".$prevLimit."' AND stud_gender='MALE' AND enrol_status2='DROPPED OUT')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_graddate <= '".$prevLimit."' AND stud_gender='FEMALE' AND enrol_status2='DROPPED OUT')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_graddate <= '".$prevLimit."' AND enrol_status2='DROPPED OUT')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and (enrol_graddate and > '".$dateLimit."' and enrol_graddate <= '".$dateLimit."') AND stud_gender='MALE' AND enrol_status2='DROPPED OUT')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and (enrol_graddate and > '".$dateLimit."' and enrol_graddate <= '".$dateLimit."') AND stud_gender='FEMALE' AND enrol_status2='DROPPED OUT')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and (enrol_graddate and > '".$dateLimit."' and enrol_graddate <= '".$dateLimit."') AND enrol_status2='DROPPED OUT')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_graddate <= '".$dateLimit."' AND stud_gender='MALE' AND enrol_status2='DROPPED OUT')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_graddate <= '".$dateLimit."' AND stud_gender='FEMALE' AND enrol_status2='DROPPED OUT')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_graddate <= '".$dateLimit."' AND enrol_status2='DROPPED OUT')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_graddate <= '".$prevLimit."' AND stud_gender='MALE' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_graddate <= '".$prevLimit."' AND stud_gender='FEMALE' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_graddate <= '".$prevLimit."' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and (enrol_graddate > '".$prevLimit."' and enrol_graddate <= '".$dateLimit."') AND stud_gender='MALE' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and (enrol_graddate > '".$prevLimit."' and enrol_graddate <= '".$dateLimit."') AND stud_gender='FEMALE' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and (enrol_graddate > '".$prevLimit."' and enrol_graddate <= '".$dateLimit."') AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_graddate <= '".$dateLimit."' AND stud_gender='MALE' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_graddate <= '".$dateLimit."' AND stud_gender='FEMALE' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_graddate <= '".$dateLimit."' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_admitdate <= '".$prevLimit."' AND stud_gender='MALE' AND enrol_ti='1')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_admitdate <= '".$prevLimit."' AND stud_gender='FEMALE' AND enrol_ti='1')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_admitdate <= '".$prevLimit."' AND enrol_ti='1')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and (enrol_admitdate > '".$prevLimit."' and enrol_admitdate <= '".$dateLimit."') AND stud_gender='MALE' AND enrol_ti='1')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and (enrol_admitdate > '".$prevLimit."' and enrol_admitdate <= '".$dateLimit."') AND stud_gender='FEMALE' AND enrol_ti='1')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and (enrol_admitdate > '".$prevLimit."' and enrol_admitdate <= '".$dateLimit."') AND enrol_ti='1')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_admitdate <= '".$dateLimit."' AND stud_gender='MALE' AND enrol_ti='1')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_admitdate <= '".$dateLimit."' AND stud_gender='FEMALE' AND enrol_ti='1')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_level='".$dataSections['section_level']."' and enrol_admitdate <= '".$dateLimit."' AND enrol_ti='1')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
		</tr>
		
	<?php
		}}
	?>
		<tr>
			<td width="1%" align="center" colspan="3"><b>TOTAL</td>
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section!='' and enrol_admitdate <= '".$dateLimit."' AND stud_gender='MALE' and enrol_level>10 AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section!='' and enrol_admitdate <= '".$dateLimit."' AND stud_gender='FEMALE'  and enrol_level>10 AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section!='' and enrol_admitdate <= '".$dateLimit."'  and enrol_level>10 AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
			<?php
				$checkMonth = $_GET['classProfile'];
				$checkAttM = dbquery("SELECT SUM($checkMonth) as  mon_sum FROM studenroll INNER JOIN student on enrol_stud_no=stud_no INNER JOIN school_days ON stud_no=sch_stud_no WHERE (sch_sy='".$_GET['enrol_sy']."'  and enrol_level>10 AND enrol_sy='".$_GET['enrol_sy']."' and enrol_admitdate <= '".$dateLimit."' AND stud_gender='MALE' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
				$countAttM = dbarray($checkAttM);
				$checkAttF = dbquery("SELECT SUM($checkMonth) as  mon_sum FROM studenroll INNER JOIN student on enrol_stud_no=stud_no INNER JOIN school_days ON stud_no=sch_stud_no WHERE (sch_sy='".$_GET['enrol_sy']."'  and enrol_level>10 AND enrol_sy='".$_GET['enrol_sy']."' and enrol_admitdate <= '".$dateLimit."' AND stud_gender='FEMALE' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
				$countAttF = dbarray($checkAttF);
				$checkAttT = dbquery("SELECT SUM($checkMonth) as  mon_sum FROM studenroll INNER JOIN student on enrol_stud_no=stud_no INNER JOIN school_days ON stud_no=sch_stud_no WHERE (sch_sy='".$_GET['enrol_sy']."'  and enrol_level>10 AND enrol_sy='".$_GET['enrol_sy']."' and enrol_admitdate <= '".$dateLimit."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED'))");
				$countAttT = dbarray($checkAttT);
				$checkDay = dbquery("SELECT SUM($checkMonth) as mon_sum FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$_GET['enrol_sy']."')");
				$dataDay = dbarray($checkDay);
				
				$mon_aveM=$countAttM['mon_sum']/($dataDay['mon_sum']==0?1:$dataDay['mon_sum']);
				$mon_aveF=$countAttF['mon_sum']/($dataDay['mon_sum']==0?1:$dataDay['mon_sum']);
				$mon_aveT=$countAttT['mon_sum']/($dataDay['mon_sum']==0?1:$dataDay['mon_sum']);

			?>		
			<td align="right" width="2%"><?php echo number_format($mon_aveM,2);?></td>
			<td align="right" width="2%"><?php echo number_format($mon_aveF,2);?></td>
			<td align="right" width="2%"><?php echo number_format($mon_aveT,2);?></td>
			<?php
				$percentAttM = $mon_aveM / ($countEnrolM==0?1:$countEnrolM) *100;
				$percentAttF = $mon_aveF / ($countEnrolF==0?1:$countEnrolF) *100;
				$percentAttT = $mon_aveT / ($countEnrolT==0?1:$countEnrolT) *100;
			?>
			<td align="right" width="2%"><?php echo number_format($percentAttM,2);?>%</td>
			<td align="right" width="2%"><?php echo number_format($percentAttF,2);?>%</td>
			<td align="right" width="2%"><?php echo number_format($percentAttT,2);?>%</td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and enrol_graddate <= '".$prevLimit."' AND stud_gender='MALE' AND enrol_status2='DROPPED OUT')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and enrol_graddate <= '".$prevLimit."' AND stud_gender='FEMALE' AND enrol_status2='DROPPED OUT')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and enrol_graddate <= '".$prevLimit."' AND enrol_status2='DROPPED OUT')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and (enrol_graddate > '".$prevLimit."' and enrol_graddate <= '".$dateLimit."') AND stud_gender='MALE' AND enrol_status2='DROPPED OUT')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and (enrol_graddate > '".$prevLimit."' and enrol_graddate <= '".$dateLimit."') AND stud_gender='FEMALE' AND enrol_status2='DROPPED OUT')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and (enrol_graddate > '".$prevLimit."' and enrol_graddate <= '".$dateLimit."') AND enrol_status2='DROPPED OUT')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and enrol_graddate <= '".$dateLimit."' AND stud_gender='MALE' AND enrol_status2='DROPPED OUT')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and enrol_graddate <= '".$dateLimit."' AND stud_gender='FEMALE' AND enrol_status2='DROPPED OUT')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and enrol_graddate <= '".$dateLimit."' AND enrol_status2='DROPPED OUT')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and enrol_graddate <= '".$prevLimit."' AND stud_gender='MALE' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and enrol_graddate <= '".$prevLimit."' AND stud_gender='FEMALE' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10and enrol_graddate <= '".$prevLimit."' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and (enrol_graddate > '".$prevLimit."' and enrol_graddate <= '".$dateLimit."') AND stud_gender='MALE' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and (enrol_graddate > '".$prevLimit."' and enrol_graddate <= '".$dateLimit."') AND stud_gender='FEMALE' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10and (enrol_graddate > '".$prevLimit."' and enrol_graddate <= '".$dateLimit."') AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and enrol_graddate <= '".$dateLimit."' AND stud_gender='MALE' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and enrol_graddate <= '".$dateLimit."' AND stud_gender='FEMALE' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10and enrol_graddate <= '".$dateLimit."' AND enrol_status2='TRANSFERRED OUT')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and enrol_admitdate <= '".$prevLimit."' AND stud_gender='MALE' AND enrol_ti='1')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and enrol_admitdate <= '".$prevLimit."' AND stud_gender='FEMALE' AND enrol_ti='1')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and enrol_admitdate <= '".$prevLimit."' AND enrol_ti='1')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and (enrol_admitdate > '".$prevLimit."' and enrol_admitdate <= '".$dateLimit."') AND stud_gender='MALE' AND enrol_ti='1')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and (enrol_admitdate > '".$prevLimit."' and enrol_admitdate <= '".$dateLimit."') AND stud_gender='FEMALE' AND enrol_ti='1')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and (enrol_admitdate > '".$prevLimit."' and enrol_admitdate <= '".$dateLimit."') AND enrol_ti='1')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%" bgcolor="lightgray"><?php echo number_format($countEnrolT,0);?></td>
			
			<?php
				$checkEnrolM = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and enrol_admitdate <= '".$dateLimit."' AND stud_gender='MALE' AND enrol_ti='1')");
				$countEnrolM = dbrows($checkEnrolM);
				$checkEnrolF = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and enrol_admitdate <= '".$dateLimit."' AND stud_gender='FEMALE' AND enrol_ti='1')");
				$countEnrolF = dbrows($checkEnrolF);
				$checkEnrolT = dbquery("SELECT * FROM studenroll INNER JOIN student on enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' and enrol_level>10 and enrol_admitdate <= '".$dateLimit."' AND enrol_ti='1')");
				$countEnrolT = dbrows($checkEnrolT);
			?>
			<td align="right" width="2%"><?php echo number_format($countEnrolM,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolF,0);?></td>
			<td align="right" width="2%"><?php echo number_format($countEnrolT,0);?></td>
		</tr>	
</table>

<table width="1135">
	<tr align="center" valign="">
		<td width="50%" align="left">
		</td>
		<td></td>
		<td align="left"><b>Prepared and Submitted by:<br><br><br></td>
		<td></td>
		<td><u><b></td>
	</tr>
	<tr align="center" valign="">
		<td width="50%" align="left">
			Generated on: <?php echo date('l, F, d, Y');?>
		</td>
		<?php
		$checkSettings = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
		$dataSettings = dbarray($checkSettings);
		?>
		<td></td>
		<td><u><b><?php echo strtoupper($dataSettings['settings_principal']);?></u><br>(Signature of School Head over Printed Name)</b></td>
		<td></td>
		<td></td>
	</tr>
</table>



