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
					<td align="right"><font size="1"></td>
					<td width="5%" align="center"></td>
					<td width="12%" align="right"></td>
					<td align="center"></td>
				</tr>				
			</table>
		</td>
		<td width="10%"><img src="./assets/images/sanhs_logo.png" width="80"></td>
	</tr>
</table><br>

<table border="1" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<th width="2%">#</th>
		<th width="13%">Section</th>
		<?php
			$checkBills = dbquery("SELECT * FROM bill_bills WHERE bill_sy='".$_GET['enrol_sy']."' order by bill_prio asc");
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
	$result= dbquery("SELECT * FROM section WHERE section_sy='".$_GET['enrol_sy']."' ORDER BY section_level ASC, section_name ASC");
	while($data = dbarray($result)){
		if(substr($data['section_name'],0,2)=="Z_"){
			
			}
			else{
				$checkEnrollment = dbquery("SELECT * FROM studenroll WHERE (enrol_section='".$data['section_name']."' AND enrol_sy='".$_GET['enrol_sy']."')");
				$countEnrollment = dbrows ($checkEnrollment);
	?>
	<tr height="25">
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($data['section_level']);?> - <?php echo strtoupper($data['section_name']);?> (x <?php echo $countEnrollment;?>)</td>
		<?php
			$checkBills = dbquery("SELECT * FROM bill_bills WHERE bill_sy='".$_GET['enrol_sy']."' order by bill_prio asc");
			while($dataBills = dbarray($checkBills)){
				$checkPaid = dbquery("SELECT SUM(ass_amount) as paidAmt FROM studenroll INNER JOIN bill_assessment ON enrol_stud_no=ass_stud_no WHERE (enrol_section='".$data['section_name']."' AND enrol_sy='".$_GET['enrol_sy']."' AND ass_invoice_no!='0' AND ass_invoice_no!='1' AND ass_bill_no='".$dataBills['bill_no']."' ) ");
				$dataPaid = dbarray($checkPaid);
		?>
			<td><?php echo number_format($dataPaid['paidAmt'],2);?></td>
		<?php
		}
		?>
	</tr>
	<?php 
	$i++;
	}} ?>
	<tr height="25">
		<td align="right"><strong><?php echo $i-1;?></strong></td>
		<td><strong><=== TOTAL</strong></td>
		<?php
			$checkBills = dbquery("SELECT * FROM bill_bills WHERE bill_sy='".$_GET['enrol_sy']."' order by bill_prio asc");
			$totalPaid = 0;
			while($dataBills = dbarray($checkBills)){
				$checkPaid = dbquery("SELECT SUM(ass_amount) as paidAmt FROM studenroll INNER JOIN bill_assessment ON enrol_stud_no=ass_stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND ass_invoice_no!='0' AND ass_invoice_no!='1' AND ass_bill_no='".$dataBills['bill_no']."' ) ");
				$dataPaid = dbarray($checkPaid);
				$totalPaid+=$dataPaid['paidAmt'];
		?>
			<td><?php echo number_format($dataPaid['paidAmt'],2);?></td>
		<?php
		}
		?>
	</tr>	
</table><br>