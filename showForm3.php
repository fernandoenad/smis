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
		<td width="10%" align="right"></td>
		<td align="center" valign="top">
			<strong><font size="+1">School Form 3 (SF3) Books Issued and Returned</font></strong><br>
			<small><i>(This replaces Form 1 & Inventory of Textbooks)</i></small>
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
					<td align="right" colspan="2"><font size="1"></td>
					<td align="center">
						<font size="1">			
						<?php 
						// echo $mysqldate = date("F");
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
		<td width="10%"></td>
	</tr>
</table><br>
<table border="1" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<th rowspan="3" width="1%">#</th>
		<th rowspan="3" width="20%">NAME (Last Name, First Name, Middle Name)</th>
		<th colspan="2">Subject Area & Title<br><br><br></th>
		<th colspan="2">Subject Area & Title<br><br><br></th>
		<th colspan="2">Subject Area & Title<br><br><br></th>
		<th colspan="2">Subject Area & Title<br><br><br></th>
		<th colspan="2">Subject Area & Title<br><br><br></th>
		<th colspan="2">Subject Area & Title<br><br><br></th>
		<th colspan="2">Subject Area & Title<br><br><br></th>
		<th colspan="2">Subject Area & Title<br><br><br></th>
		<th colspan="2">Subject Area & Title<br><br><br></th>
		<th colspan="2">Subject Area & Title<br><br><br></th>
		<th rowspan="3" width="8%">REMARKS/ACTION TAKEN <br>(Please refer to the legend on last page)</th>
	</tr>
	<tr>
		<th colspan="2">Date</th>
		<th colspan="2">Date</th>
		<th colspan="2">Date</th>
		<th colspan="2">Date</th>
		<th colspan="2">Date</th>
		<th colspan="2">Date</th>
		<th colspan="2">Date</th>
		<th colspan="2">Date</th>
		<th colspan="2">Date</th>
		<th colspan="2">Date</th>
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
	</tr>
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
			<br><br><strong><?php echo strtoupper($dataAdviser['user_fullname']);?></strong><br>(Signature of Adviser over Printed Name)
			<br><br><strong>________________________________</strong><br><b>Generated thru LIS</b>
			<br><br>Date of BoSY: <u><?php echo $current_bosy;?></u> Date of EoSY: <u><?php echo $current_eosy;?></u>
		</td>
	</tr>
</table>
