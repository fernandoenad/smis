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
<table border="0" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<td width="10%" align="right"><img src="./assets/images/deped_logo.png" width="80"></td>
		<td align="center" valign="top">
			<strong><font size="+1">Student Billings/Accounts Tracker</font></strong><br>
			<br><br>
			<table width="100%" border="0">
				<tr height="25">
					<td width="10%" align="right" ><font size="1">School ID &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_code;?></td>
					<td width="5%"></td>
					<td><font size="1">Region VII</td>
					<td width="8%" align="right"><font size="1">Division &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_division;?></td>
					<td width="5%"></td>
					<td width="8%" align="right"><font size="1">District &nbsp;</td>
					<td align="center" colspan="2" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_district;?></td>
					<td></td>
				</tr>
				<tr height="25">
					<td align="right" border="1"><font size="1">School Name &nbsp;</td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_full;?></td>
					<td align="right"><font size="1">School Year &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?></td>
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
		<th width="2%">#</th>
		<th width="13%">NAME (Last Name, First Name, Middle Name)</th>
		<?php
			$checkBills = dbquery("SELECT * FROM bill_bills WHERE bill_sy='".$current_sy."' order by bill_prio asc");
			while($dataBills = dbarray($checkBills)){
		?>
			<th><?php echo $dataBills['bill_desc'];?><br>P<?php echo $dataBills['bill_amount'];?></th>
		<?php
		}
		?>
	</tr>

	<?php
	$i=1;
	$MLEi=0;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='MALE' and enrol_status1!='INACTIVE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="25">
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
		<?php
			$checkBills = dbquery("SELECT * FROM bill_bills INNER JOIN bill_assessment ON bill_no=ass_bill_no WHERE (ass_sy='".$_GET['enrol_sy']."' AND ass_stud_no='".$data['stud_no']."') order by bill_prio asc");
			while($dataBills = dbarray($checkBills)){
		?>
			<td><?php echo ($dataBills['ass_invoice_no']==0?"-":($dataBills['ass_invoice_no']==1?"WAIVED":"PAID"));?></td>
		<?php
		}
		?>
	</tr>
	<?php 
	if(substr($data['enrol_remarks'],0,2)=="LE"){
		$MLEi++;
	}
	$i++;
	} ?>
	<tr height="25">
		<td align="right"><strong><?php echo $i-1;?></strong></td>
		<td><strong><=== TOTAL MALE</strong></td>
		<?php
			$checkBills = dbquery("SELECT * FROM bill_bills WHERE bill_sy='".$_GET['enrol_sy']."'");
			while($dataBills = dbarray($checkBills)){
		?>
			<th></th>
		<?php
		}
		?>
	</tr>
	<?php
	$i=1;
	$FLEi=0;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='FEMALE' and enrol_status1!='INACTIVE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="25">
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
		<?php
			$checkBills = dbquery("SELECT * FROM bill_bills INNER JOIN bill_assessment ON bill_no=ass_bill_no WHERE (bill_sy='".$_GET['enrol_sy']."' AND ass_stud_no='".$data['stud_no']."') order by bill_prio asc");
			while($dataBills = dbarray($checkBills)){
		?>
			<td><?php echo ($dataBills['ass_invoice_no']==0?"-":($dataBills['ass_invoice_no']==1?"WAIVED":"PAID"));?></td>
		<?php
		}
		?>
	</tr>
	<?php 
	if(substr($data['enrol_remarks'],0,2)=="LE"){
		$FLEi++;
	}
	$i++;
	} ?>
	<tr height="25">
		<td align="right"><strong><?php echo $i-1;?></strong></td>
		<td><strong><=== TOTAL FEMALE<strong></td>
		<?php
			$checkBills = dbquery("SELECT * FROM bill_bills WHERE bill_sy='".$_GET['enrol_sy']."'");
			while($dataBills = dbarray($checkBills)){
		?>
			<td></td>
		<?php
		}
		?>
	</tr>	
</table><br>