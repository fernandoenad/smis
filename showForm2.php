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
			<strong><font size="+1">School Form 2 (SF2) Daily Attendance Report of Learners</font></strong><br>
			<small><i>(This replaces Form 1, Form 2 & STS Form 4 - Absenteeism and Dropout Profile)</i></small>
			<br><br>
			<table width="100%" border="0">
				<tr height="25">
					<td width="10%" align="right" ><font size="1">School ID &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_code;?></td>
					<td width="5%"></td>
					<td></td>
					<td width="8%" align="right"><font size="1">School Year &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?></td>
					<td width="5%"></td>
					<td width="8%" align="right"></td>
					<td align="right" colspan="2"><font size="1">For the Month of &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px">
						<font size="1">			
						<?php 
						//echo $mysqldate = date("F");
						?>
					</td>
				</tr>
				<tr height="25">
					<td align="right" border="1"><font size="1">School Name &nbsp;</td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_full;?></td>
					<td align="right"><font size="1"></td>
					<td align="center"></td>
					<td></td>
					<td align="right"><font size="1">Grade Level &nbsp;</td>
					<?php
					$resultLevel = dbquery("SELECT * FROM section WHERE (section_name='".$_GET['classProfile']."' AND section_sy='".$_GET['enrol_sy']."')");
					$dataLevel = dbarray($resultLevel);
					?>
					<td width="5%" align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $dataLevel['section_level'];?></td>
					<td width="12%" align="right"><font size="1">Section &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $_GET['classProfile'];?></td>
				</tr>				
			</table>
		</td>
		<td width="10%"><img src="./assets/images/sanhs_logo.png" width="80"></td>
	</tr>
</table><br>
<table border="1" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<th rowspan="3" width="1%">#</th>
		<th rowspan="3" width="20%">NAME (Last Name, First Name, Middle Name)</th>
		<th colspan="25">(1st row for date)</th>
		<th rowspan="2" colspan="2" width="3%">Total for the Month</th>
		<th rowspan="3" width="15%">REMARKS <br>(If DROPPED OUT, state reason, please refer to legend number 2. If TRANSFERRED IN/OUT, write the name of School.)</th>
	</tr>
	<tr>
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
		<th>ABSENT</th>	
		<th>TARDY</th>			
	</tr>
	<?php
	$i=1;
	$MLEi=0;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='MALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="18">
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
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
		<td></td>
		<td></td>
		<td><?php echo ($data['enrol_status2']=="REGULAR"?"":$data['enrol_status2']);?></td>
	</tr>

	<?php 
	if($data['enrol_status2']=="REGULAR"){
		$MLEi++;
	}
		$i++;
	} 
	$m = $i-1;
	?>
	<tr height="18">
		<td></td>
		<td></td>
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
		<td></td>
		<td></td>
		<td></td>
	</tr>
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
		<td></td>
		<td></td>
	</tr>
	<?php
	$i=1;
	$FLEi=0;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='FEMALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="18">
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
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
		<td></td>
		<td></td>
		<td><?php echo ($data['enrol_status2']=="REGULAR"?"":$data['enrol_status2']);?></td>
	</tr>
	<?php 
	if($data['enrol_status2']=="REGULAR"){
		$FLEi++;
	}
		$i++;
	} 
	$f = $i-1;
	?>
	<tr height="18">
		<td></td>
		<td></td>
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
		<td></td>
		<td></td>
		<td></td>
	</tr>
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
		<td></td>
		<td></td>
	</tr>	
</table>
<table width="1135">
	<tr>
		<td width="48%" valign="top"><strong>GUIDELINES:</strong>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td colspan="3">
						1. The attendance shall be accomplished daily. Refer to the codes for checking learners' attendance.<br>
						2. Dates shall be written in the columns after Learner's Name.<br>
						3. To compute the following: <br>
					</td>
				</tr>
				<tr><td colspan="3"></td></tr>
				<tr>
					<td width="40%">a. Percentage of Enrolment =</td>
					<td width="40%" align="center">Registered Learners as of end of the month<hr>Enrolment as of 1st Friday of the school year</td>
					<td width="20%" align="center">x 100</td>
				</tr>
				<tr>
					<td>b. Average Daily Attendance =</td>
					<td align="center">Total Daily Attendance<hr>Number of School Days in reporting month</td>
					<td align="center"></td>
				</tr>
				<tr>
					<td>c. Percentage of Attendance for the month =</td>
					<td align="center">Average daily attendance<hr>Registered Learners as of end of the month</td>
					<td align="center">x 100</td>
				</tr>
				<tr><td colspan="3"></td></tr>
				<tr>
					<td colspan="3">
					4. Every end of the month, the class adviser will submit this form to the office of the principal for recording of summary table into School Form 4. Once signed by the principal, this form should be returned to the adviser.<br>
					5. The adviser will provide neccessary interventions including but not limited to home visitation to learner/s who were absent for 5 consecutive days and/or those at risk of dropping out.<br>
					6.  Attendance performance of learners will be reflected in Form 137 and Form 138 every grading period.<br><br>
					*Beginning of School Year cut-off report is every 1st Friday of the School Year
					</td>
				</tr>
			</table>
		</td>
		<td width="20%">
		<table>
			<tr><td><strong>1. CODES FOR CHECKING ATTENDANCE</strong></td></tr>
			<tr><td>(blank) - Present; (x)- Absent; Tardy (half shaded= Upper for Late Commer, Lower for Cutting Classes)</td></tr>
			<tr><td><strong>2. REASONS/CAUSES FOR DROPPING OUT</strong></td></tr>
			<tr><td><strong>a. Domestic-Related Factors</strong></td></tr>
			<tr><td>a.1. Had to take care of siblings<br>
					a.2. Early marriage/pregnancy<br>
					a.3. Parents' attitude toward schooling<br>
					a.4. Family problems <br>
				</td>
			</tr>
			<tr><td><strong>b. Individual-Related Factors</strong></td></tr>
			<tr><td>b.1. Illness<br>
					b.2. Overage<br>
					b.3. Death<br>
					b.4. Drug Abuse<br>
					b.5. Poor academic performance<br>
					b.6. Lack of interest/Distractions<br>
					b.7. Hunger/Malnutrition<br>
				</td>
			</tr>
			<tr><td><strong>c. School-Related Factors</strong></td></tr>
			<tr><td>c.1. Teacher Factor<br>
					c.2. Physical condition of classroom<br>
					c.3. Peer influence<br>
				</td>
			</tr>
			<tr><td><strong>d. Geographic/Environmental</strong></td></tr>
			<tr><td>d.1. Distance between home and school<br>
					d.2. Armed conflict (incl. Tribal wars & clanfeuds)<br>
					d.3. Calamities/Disasters<br>
				</td>
			</tr>
			<tr><td><strong>e. Financial-Related</strong></td></tr>
			<tr><td>e.1. Child labor, work</td></tr>
			<tr><td><strong>f. Others (Specify)		</strong></td></tr>
		</table>		
		</td>
		<td></td>
		<td width="30%" valign="top">
			<table width="100%" border="1" cellspacing="0" cellpadding="0">
				<tr height="20">
					<th rowspan="2" align="left">Month:	<u><?php //echo $mysqldate = date("F");?></th>
					<th rowspan="2" align="left" width="30%">No. of Days of Classes: _____ </th>
					<th colspan="3" width="30%">Summary</th>
				</tr>
				<tr>
					<th width="10%">M</th>
					<th width="10%">F</th>
					<th width="10%">TOTAL</th>
				</tr>	
				<tr>
					<td colspan="2">* Enrolment  as of  (1st Friday on the Opening of Classes)</td>
					<td align="center"><?php echo $MLEi;?></td>
					<td align="center"><?php echo $FLEi;?></td>
					<td align="center"><?php echo $MLEi+$FLEi;?></td>
				</tr>
				<tr align="center">
					<td colspan="2">Late Enrollment <strong>during the month</strong> <br>(beyond cut-off)</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr align="center">
					<td colspan="2">Registered Learners as of <br><strong>end of month</strong> </td>
					<td></td>
					<td></td>
					<td></td>
				</tr >
				<tr align="center">
					<td colspan="2">Percentage of Enrolment as of <br><strong>end of month</strong> </td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr align="center">
					<td colspan="2">Average Daily Attendance</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr align="center">
					<td colspan="2">Percentage of Attendance for the month</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr align="center">
					<td colspan="2">Number of students absent for 5 consecutive days</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr align="center">
					<td colspan="2"><strong>Dropped out</strong></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr align="center">
					<td colspan="2"><strong>Transferred out</strong></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr align="center">
					<td colspan="2"><strong>Transferred in</strong></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table><br>
			<table width="100%">
				<tr><td>I certify that this is a true and correct report.</td></tr>
				<?php
				$resultAdviser = dbquery("SELECT * FROM users WHERE user_no='".$dataLevel['section_adviser']."'");
				$dataAdviser = dbarray($resultAdviser);
				?>
				<tr><td align="center"><br><br><strong><?php echo strtoupper($dataAdviser['user_fullname']);?></strong><br>(Signature of Adviser over Printed Name)</td></tr>
				<tr><td></td></tr>
				<tr><td>Attested by:</td></tr>
				<tr><td align="center"><br><br><strong><?php echo strtoupper($current_principal);?></strong><br>(Signature of School Head over Printed Name)</td></tr>
			</table>
		</td>
	</tr>
</table>
