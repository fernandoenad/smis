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
			<strong><font size="+1"> School Form 3 Books Issued and Returned for Senior High School (SF3-SHS) </font></strong><br>
			<br><br>
			<table width="100%" border="0">
				<tr height="25">
					<td align="right" border="1"><font size="1">School Name &nbsp;</td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_full;?></td>
					<td width="10%" align="right" ><font size="1">School ID &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_code;?></td>
					<td align="right"><font size="1">District &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_district;?></td>
					<td width="8%" align="right"><font size="1">Division &nbsp;</td>
					<td align="center" colspan="2" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_division;?></td>
					<td width="8%" align="right"><font size="1">Region &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_reg_code;?></td>
					<td width="8%"></td>
				</tr>
				<tr height="25">
					<td align="right"><font size="1">Semester &nbsp;</td>
					<td align="center" colspan="2" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_sem;?></td>
					<td align="right"><font size="1">School Year &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?></td>
					<td align="right"><font size="1">Grade Level &nbsp;</td>
					<?php
					$resultLevel = dbquery("SELECT * FROM section WHERE (section_name='".$_GET['classProfile']."' AND section_sy='".$_GET['enrol_sy']."')");
					$dataLevel = dbarray($resultLevel);
					?>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $dataLevel['section_level'];?></td>
					<td align="right" colspan="2"><font size="1">Track and Strand &nbsp;</td>
					<td align="center" colspan="4" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo substr($dataLevel['section_track'],4);?></td>
					<td width="8%"></td>
				</tr>
				<tr height="25">
					<td align="right"><font size="1">Section &nbsp;</td>
					<td align="center" colspan="2" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $_GET['classProfile'];?></td>
					<?php
					$checkCourse = dbquery("select * from studenroll where (enrol_sy='".$current_sy."' and enrol_section='".$_GET['classProfile']."') order by enrol_admitdate asc limit 1");
					$dataCourse = dbarray($checkCourse);
					?>
					<td align="right" colspan="2"><font size="1">Course (For TVL Only) &nbsp;</td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo (substr($_GET['classProfile'],0,3)=="TVL"?$dataCourse['enrol_combo']:"");?></td>
					<td width="8%"></td>
					<td align="right"><font size="1"></td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px"><font size="1"></td>
					<td width="8%"></td>
				</tr>				
			</table>
		</td>
		<td width="10%"><img src="./assets/images/deped_word.png" width="80"></td>
	</tr>
</table><br>
<table border="1" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<th rowspan="3" width="1%">#</th>
		<th rowspan="3" width="20%">NAME (Last Name, First Name, Middle Name)</th>
		<th colspan="2">Book / ModuleTitle<br><br><br></th>
		<th colspan="2">Book / ModuleTitle<br><br><br></th>
		<th colspan="2">Book / ModuleTitle<br><br><br></th>
		<th colspan="2">Book / ModuleTitle<br><br><br></th>
		<th colspan="2">Book / ModuleTitle<br><br><br></th>
		<th colspan="2">Book / ModuleTitle<br><br><br></th>
		<th colspan="2">Book / ModuleTitle<br><br><br></th>
		<th colspan="2">Book / ModuleTitle<br><br><br></th>
		<th colspan="2">Book / ModuleTitle<br><br><br></th>
		<th colspan="2">Book / ModuleTitle<br><br><br></th>
		<th rowspan="3" width="8%">REMARKS/ACTION TAKEN <br>(Please refer to the codes below)</th>
	</tr>
	<tr>
		<th colspan="2">Date <small>(mm/dd/yy)</small></th>
		<th colspan="2">Date <small>(mm/dd/yy)</small></th>
		<th colspan="2">Date <small>(mm/dd/yy)</small></th>
		<th colspan="2">Date <small>(mm/dd/yy)</small></th>
		<th colspan="2">Date <small>(mm/dd/yy)</small></th>
		<th colspan="2">Date <small>(mm/dd/yy)</small></th>
		<th colspan="2">Date <small>(mm/dd/yy)</small></th>
		<th colspan="2">Date <small>(mm/dd/yy)</small></th>
		<th colspan="2">Date <small>(mm/dd/yy)</small></th>
		<th colspan="2">Date <small>(mm/dd/yy)</small></th>
	</tr>
	<tr>
		<td width="4%"><small>Issued</small></td>
		<td width="4%"><small>Returned</small></td>
		<td width="4%"><small>Issued</small></td>
		<td width="4%"><small>Returned</small></td>
		<td width="4%"><small>Issued</small></td>
		<td width="4%"><small>Returned</small></td>
		<td width="4%"><small>Issued</small></td>
		<td width="4%"><small>Returned</small></td>
		<td width="4%"><small>Issued</small></td>
		<td width="4%"><small>Returned</small></td>
		<td width="4%"><small>Issued</small></td>
		<td width="4%"><small>Returned</small></td>
		<td width="4%"><small>Issued</small></td>
		<td width="4%"><small>Returned</small></td>
		<td width="4%"><small>Issued</small></td>
		<td width="4%"><small>Returned</small></td>
		<td width="4%"><small>Issued</small></td>
		<td width="4%"><small>Returned</small></td>
		<td width="4%"><small>Issued</small></td>
		<td width="4%"><small>Returned</small></td>
	</tr>

	<?php
	$i=1;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='MALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="18">
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
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
		$i++;
	} 
	$m = $i-1;
	?>
	<tr height="25">
		<td align="right"><strong><?php echo $i-1;?></strong></td>
		<td align="center"><strong> TOTAL MALE ===></strong></td>
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
	</tr>
	<?php
	$i=1;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='FEMALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="18">
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
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
		$i++;
	} 
	$f = $i-1;
	?>
	<tr height="25">
		<td align="right"><strong><?php echo $i-1;?></strong></td>
		<td align="center"><strong> TOTAL FEMALE ===></strong></td>
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
	<tr height="25">
		<td align="right"><strong><?php echo $m+$f;?></strong></td>
		<td align="center"><strong>COMBINED ===></strong></td>
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
	</tr>	
</table>
<table width="1135">
	<tr>
		<th width="30%" valign="top" align="left">GUIDELINES:</th>
		<th align="left">In case of lost/unreturned books, please provide information with the following code:</th>
		<th width="30%" valign="top" align="left">Prepared By:</th>
	</tr>
	<tr>
		<td>
			1. Title of Books Issued to each learner must be recorded  by the class adviser.<br>
			2. The Date of Issuance and the Date of Return shall be reflected in the form.<br>
			3. The Total Number of Copies issued at BoSY shall be reflected in the form.<br>
			4. The Total Number of Copies of Books Returned at the EoSYshall be reflected in the form.<br>
			5. All textbooks being used must be included. Additional copies of <br>
		</td>
		<td>
			A. In Column Date Returned, codes are: FM=Force Majeure, TDO: Transferred/Dropout, NEG=Negligence<br>
			B. In Column Remark/Action Taken, codes are: LLTR=Secured Letter from Learner duly signed by parent/guardian (for code FM), TLTR=Teacher prepared letter/report duly noted by School Head for submission to School Property Custodian (for code TDO), PTL=Paid by the Learner (for  code NEG).  References:  DO#23, s.2001, DO#25, s.2003, DO#14, 2.2012.
		</td>
		<td align="center">
			<?php
			$resultAdviser = dbquery("SELECT * FROM users WHERE user_no='".$dataLevel['section_adviser']."'");
			$dataAdviser = dbarray($resultAdviser);
			?>
			<br><br><strong><?php echo strtoupper($dataAdviser['user_fullname']);?></strong><br>Signature of Adviser over Printed Name

		</td>
	</tr>
</table>
