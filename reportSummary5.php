<?php
session_start();
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
		font-size: 0.6em;		
	}
	</style>
</head>	
<?php
$resultTeacher = dbquery("SELECT * FROM users WHERE (user_no='".$_GET['user_no']."')");
$dataTeacher = dbarray($resultTeacher);
?>

<table border="0" cellspacing="0" cellpadding="0" width="750">
	<tr>
		<td width="60"><img src="./assets/images/sanhs_logo.png" width="50"></td>
		<td align="left" valign="top">
		<strong><?php echo $current_school_name;?></strong><br>
		<?php echo $current_school_address;?>
		<h3>School Year <?php echo $current_sy; ?>-<?php echo $current_sy+1; ?>, <?php echo ($current_sem==1?"First":"Second");?> Semester<br>
		<?php 
		$checkBill = dbquery("SELECT * FROM bill_bills WHERE bill_no='".$_GET['bill_no']."'");
		$dataBill = dbarray($checkBill);
		?> 
		Payors List for <?php echo $dataBill['bill_desc'];?>
		<br>Collector: <?php echo $dataTeacher['user_fullname']; ?></h3>
		</td>
	</tr>
</table>	

<table border="1" cellspacing="0" cellpadding="1" width="750">
<tr>
	<th colspan="4" align="left">Summary</th>
</tr>	
				<tr>
					<th width="20%">Category</th>
					<th>Description</th>
					<th width="10%">Amount</th>
					<th width="30%">Acknowledgement Receipt from In-Charge</th>
				</tr>
				<tr>
					<td><?php echo $dataBill['bill_category'];?></td>
					<td><?php echo $dataBill['bill_desc'];?></td>
					<td align="right">
					<?php 
					$sumPaid = 0;
					$checkPaids = dbquery("SELECT SUM(receipt_amtPaid) as totalPaid FROM bill_receipt INNER JOIN bill_assessment ON receipt_no=ass_invoice_no INNER JOIN  bill_bills ON ass_bill_no=bill_no WHERE (receipt_user='".$_GET['user_no']."' AND bill_no='".$_GET['bill_no']."') ORDER BY receipt_datetime DESC");
					$dataPaids = dbarray($checkPaids);
					echo number_format($dataPaids['totalPaid'],2);
					$sumPaid=$sumPaid+$dataPaids['totalPaid'];
					?>
					</td>
					<td></td>
					
				</tr>
			</table>	<br>
<tr>
<?php
$result= dbquery("SELECT *  FROM bill_bills INNER JOIN bill_assessment ON bill_no=ass_bill_no INNER JOIN bill_receipt ON ass_invoice_no=receipt_no INNER JOIN student ON receipt_stud_no=stud_no WHERE (bill_sy='".$_GET['enrol_sy']."' AND receipt_user='".$_GET['user_no']."' AND bill_no='".$_GET['bill_no']."' ) ORDER BY receipt_datetime ASC");
$rows = dbrows($result);
?>
<table border="1" cellspacing="0" cellpadding="1" width="750">
	<tr>
		<th colspan="7" align="left">Details</th>
	</tr>
	<tr>
		<th width="3%">#</th>
		<th width="25%">Payor</th>
		<th width="15%">Lvl. & Sec.</th>
		<th width="10%">Receipt #</th>
		<th width="15%">Date/Time Issued</th>
		<th>Particulars</th>
		<th width="10%">Amount Paid</th>
	</tr>
	<?php
	$sumPaid=0;
	$i=1;
	while($data = dbarray($result)){
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td>
		<?php 
			$checkUser = dbquery("SELECT * FROM student WHERE (stud_no='".$data['receipt_stud_no']."')");
			$dataUser = dbarray($checkUser);
			echo $dataUser['stud_lname'].", ".$dataUser['stud_fname'];
		?></td>
		<td>
		<?php 
			$checkUser = dbquery("SELECT * FROM studenroll where (enrol_stud_no='".$data['receipt_stud_no']."' and enrol_sy='".$_GET['enrol_sy']."')");
			$dataUser = dbarray($checkUser);
			echo $dataUser['enrol_level']." - ".$dataUser['enrol_section'];
		?></td>
		<td><?php echo $data['receipt_no']; ?></td>
		<td><?php echo $data['receipt_datetime']; ?></td>
		<td><?php 
			$checkItems = dbquery("SELECT * FROM bill_ledger INNER JOIN bill_assessment ON ass_no=ledger_ass_no INNER JOIN bill_bills ON ass_bill_no=bill_no WHERE (ledger_receipt_no='".$data['receipt_no']."' AND bill_no='".$_GET['bill_no']."')");
			while($dataItems = dbarray($checkItems)){
				echo $dataItems['bill_desc']."";
			}
		?>
		</td>
		<td align="right"><?php echo number_format($data['receipt_amtPaid'],2); ?> <?php echo ($data['receipt_amtPaid']==0?" (voided)":""); ?></td>
	</tr>
	<?php 
	$sumPaid=$sumPaid + $data['receipt_amtPaid'];
	$i++;
	} ?>
	<tr>
		<td colspan="5" align="right">
				
		</td>
		<td align="right" valign="top"><b>TOTAL</td>
		<td valign="top" align="right"><b>	<?php echo number_format($sumPaid,2); ?></td>
		
	</tr>
</table>
