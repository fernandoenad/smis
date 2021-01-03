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
		<h3>School Year <?php echo $_GET['enrol_sy']; ?>-<?php echo $_GET['enrol_sy']+1; ?>, <?php echo ($current_sem==1?"First":"Second");?> Semester<br>
		<?php 
		$y= substr($_GET['date'],0,4);
		$m= substr($_GET['date'],4,2);
		$d= substr($_GET['date'],6,2);
		$date=$y."-".$m."-".$d;
		$phpdate = strtotime($date);
		$mysqldate = date('F d, Y', $phpdate);
		?> 
		Transaction Report Summary as of <?php echo $mysqldate;?>
		</h3>
		</td>
	</tr>
</table>	

<table border="1" cellspacing="0" cellpadding="1" width="750">
<tr>
	<th colspan="4" align="left">Current Schooly Year Summary</th>
</tr>	
				<tr>
					<th width="20%">Category</th>
					<th>Description</th>
					<th width="10%">Amount</th>
					<th width="30%">Acknowledgement Receipt from In-Charge</th>
				</tr>
				<?php
					$sumPaid = 0;	
					$checkBills = dbquery("SELECT * FROM bill_bills GROUP BY bill_category ORDER BY bill_prio ASC");
					while($dataBills = dbarray($checkBills)){
				?>	
				<tr>
					<td><?php echo $dataBills['bill_category'];?></td>
					
					<td>					
					<?php 
					$checkSYSettings = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
					$dataSYSettings = dbarray($checkSYSettings);
					$checkPaids1 = dbquery("SELECT count(bill_no) as counter, bill_desc, sum(ass_amount) as paidTotal FROM bill_receipt INNER JOIN bill_assessment ON receipt_no=ass_invoice_no INNER JOIN  bill_bills ON ass_bill_no=bill_no WHERE (bill_sy='".$_GET['enrol_sy']."' AND bill_category='".$dataBills['bill_category']."') GROUP BY bill_desc");
					while($dataPaids1 = dbarray($checkPaids1)){
						echo "* ".$dataPaids1['bill_desc']." - ".number_format($dataPaids1['paidTotal'],2)." (".$dataPaids1['counter']." student)<br>";
						
						
					}
					?></td>
					<td align="right">
					<?php 
					$checkPaids = dbquery("SELECT SUM(ass_amount) as totalPaid FROM bill_receipt INNER JOIN bill_assessment ON receipt_no=ass_invoice_no INNER JOIN  bill_bills ON ass_bill_no=bill_no WHERE (bill_sy='".$_GET['enrol_sy']."' AND bill_category='".$dataBills['bill_category']."') ORDER BY receipt_datetime DESC");
					$dataPaids = dbarray($checkPaids);
					echo number_format($dataPaids['totalPaid'],2);
					$sumPaid=$sumPaid+$dataPaids['totalPaid'];
					?>
					</td>
					<td></td>
					
				</tr>
				<?php
				}
				?>
				<tr>
					
					<td></td>
					<td align="right"><b>TOTAL</b></td>
					<td align="right"><b><?php echo number_format($sumPaid,2);?></b></td>
					<td></td>
				</tr>
			</table>	<br>
		<table border="1" cellspacing="0" cellpadding="1" width="750">
<tr>
	<th colspan="4" align="left">Back Balances</th>
</tr>	
				<tr>
					<th width="20%">Category</th>
					<th>Description</th>
					<th width="10%">Amount</th>
					<th width="30%">Acknowledgement Receipt from In-Charge</th>
				</tr>
				<?php
					$sumPaid = 0;	
					$checkBills = dbquery("SELECT * FROM bill_bills GROUP BY bill_category ORDER BY bill_prio ASC");
					while($dataBills = dbarray($checkBills)){
				?>	
				<tr>
					<td><?php echo $dataBills['bill_category'];?></td>
					
					<td>					
					<?php 
					$checkSYSettings = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
					$dataSYSettings = dbarray($checkSYSettings);
					$checkPaids1 = dbquery("SELECT count(bill_no) as counter, bill_desc, sum(ass_amount) as paidTotal FROM bill_receipt INNER JOIN bill_assessment ON receipt_no=ass_invoice_no INNER JOIN  bill_bills ON ass_bill_no=bill_no WHERE (bill_sy<'".$_GET['enrol_sy']."' AND bill_category='".$dataBills['bill_category']."') GROUP BY bill_desc");
					while($dataPaids1 = dbarray($checkPaids1)){
						echo "* ".$dataPaids1['bill_desc']." - ".number_format($dataPaids1['paidTotal'],2)." (".$dataPaids1['counter']." student)<br>";
						
						
					}
					?></td>
					<td align="right">
					<?php 
					$checkPaids = dbquery("SELECT SUM(ass_amount) as totalPaid FROM bill_receipt INNER JOIN bill_assessment ON receipt_no=ass_invoice_no INNER JOIN  bill_bills ON ass_bill_no=bill_no WHERE (bill_sy<'".$_GET['enrol_sy']."' AND bill_category='".$dataBills['bill_category']."') ORDER BY receipt_datetime DESC");
					$dataPaids = dbarray($checkPaids);
					echo number_format($dataPaids['totalPaid'],2);
					$sumPaid=$sumPaid+$dataPaids['totalPaid'];
					?>
					</td>
					<td></td>
					
				</tr>
				<?php
				}
				?>
				<tr>
					
					<td></td>
					<td align="right"><b>TOTAL</b></td>
					<td align="right"><b><?php echo number_format($sumPaid,2);?></b></td>
					<td></td>
				</tr>
			</table>	<br>	
<tr>
<?php
$result= dbquery("SELECT SUM(receipt_amtPaid) as paidAmt, user_fullname,  receipt_user FROM bill_bills INNER JOIN bill_assessment ON bill_no=ass_bill_no INNER JOIN bill_receipt ON ass_invoice_no=receipt_no INNER JOIN users ON receipt_user=user_no WHERE (bill_sy<'".$_GET['enrol_sy']."') GROUP BY receipt_user ORDER BY receipt_datetime DESC");
$rows = dbrows($result);
?>
<table border="1" cellspacing="0" cellpadding="1" width="750">
	<tr>
		<th colspan="6" align="left">Details</th>
	</tr>
	<tr>
		<th width="3%">#</th>
		<th>Collector's Name</th>
		<th width="25%">Particulars</th>
		<th width="25%">Remitted?</th>
		<th width="10%">Amount Paid</th>
	</tr>
	<?php
	$sumPaid=0;
	$i=1;
	while($data = dbarray($result)){
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $data['user_fullname']; ?></td>
		<td><?php 
			$checkItems = dbquery("SELECT SUM(bill_amount) as paidAmt, bill_category FROM bill_bills INNER JOIN bill_assessment ON bill_no=ass_bill_no INNER JOIN bill_receipt ON ass_invoice_no=receipt_no INNER JOIN users ON receipt_user=user_no WHERE (bill_sy='".$_GET['enrol_sy']."' AND receipt_user='".$data['receipt_user']."') GROUP BY bill_category ORDER BY receipt_datetime DESC");
			while($dataItems = dbarray($checkItems)){
				echo $dataItems['bill_category']." - ".number_format($dataItems['paidAmt'],2)."<br>";
				
			}
		?>
		</td>
		<td></td>
		<td align="right"><?php echo number_format($data['paidAmt'],2); ?> <?php echo ($data['paidAmt']==0?" (voided)":""); ?></td>
	</tr>
	<?php 
	$sumPaid=$sumPaid + $data['paidAmt'];
	$i++;
	} ?>
	<tr>
		<td colspan="3" align="right">
				
		</td>
		<td align="right" valign="top"><b>TOTAL</td>
		<td valign="top" align="right"><b>	<?php echo number_format($sumPaid,2); ?></td>
		
	</tr>
</table>
