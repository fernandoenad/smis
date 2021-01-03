<?php
session_start();
require('maincore.php');
$checkStudent = dbquery("SELECT * FROM student INNER JOIN studenroll on student.stud_no=studenroll.enrol_stud_no WHERE (student.stud_no='".$_GET['stud_no']."' AND enrol_sy='".$current_sy."')");
$dataStudent = dbarray($checkStudent );
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
<table border="0" cellspacing="0" cellpadding="0" width="800">
	<tr>
		<td width="60" valign="top"><img src="./assets/images/sanhs_logo.png" width="50"></td>
		<td align="left" valign="top">
		<strong><?php echo $current_school_name;?></strong><br>
		<?php echo $current_school_address;?>
		<h2>Statement of Accounts Slip<br>
		School Year <?php echo $current_sy;?>-<?php echo $current_sy+1;?>, <?php echo ($current_sem==1?"First":"Second");?> Semester
		</h2>
		</td>
		<td align="right">
		
		</td>
		<td align="center"><img src="./barcodeapp/barcode.php?text=<?php echo $_GET['stud_no']; ?>" alt="testing" /><br>Student No.: <?php echo $_GET['stud_no']; ?>
		</td>
	</tr>
</table>	
<table border="0" cellspacing="2	" cellpadding="0" width="800">
	<tr>
		<td width="16%" align="right">Learner's Reference Number:</td>
		<td> <b><?php echo $dataStudent['stud_lrn'];?></td>
		<td width="12%" align="right"></td>
		<td width="15%"></td>
	</tr>
	<tr>
		<td align="right">Student Fullname:</td>
		<td> <b><?php echo $dataStudent['stud_lname'];?>, <?php echo $dataStudent['stud_fname'];?> <?php echo $dataStudent['stud_xname'];?> <?php echo $dataStudent['stud_mname'];?></td>
		<td align="right">Grade Level / Section:</td>
		<td align="left"> <b><?php echo $dataStudent['enrol_level'];?> / <?php echo $dataStudent['enrol_section'];?></td>
	</tr>	
	<?php
	if($dataStudent['enrol_level']>10){
	?>
	<tr>
		<td align="right">Track/Strand & Combo: </td>
		<td> <b><?php echo strtoupper($dataStudent['enrol_track']);?> / <?php echo strtoupper($dataStudent['enrol_strand']);?> - <?php echo strtoupper($dataStudent['enrol_combo']);?></td>
		<td align="right"></td>
		<td align="left"> </td>
	</tr>
	<?php
	}
	?>
</table>	
<hr>
<?php
$resultEnrol = dbquery("SELECT * FROM studenroll WHERE (enrol_sy='".$current_sy."' AND enrol_stud_no='".$_GET['stud_no']."')");
$dataEnroll = dbarray($resultEnrol);
$resultSectionName = dbquery("SELECT * FROM section WHERE (section_name='".$dataEnroll['enrol_section']."' AND section_sy='".$current_sy."')");
$dataSectionName = dbarray($resultSectionName);
$checkUser = dbquery("SELECT * FROM users WHERE user_no='".$dataSectionName['section_adviser']."'");
$dataUser = dbarray($checkUser );
?>
<div class="table-responsive">
	<table>
		<tr>
			<td valign="top">
			<table width="450" class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
		<thead>
			<tr>
				<th align="left" width="60%"><u>Description</th>
				<th align="left" width="10%"><u>Amount</th>
				<th align="left" width="20%"><u>Invoice #</th>
		
			</tr>
		</thead>
		<tbody> 
		<?php
		$checkPayables = dbquery("SELECT * FROM bill_assessment INNER JOIN  bill_bills ON ass_bill_no=bill_no WHERE (ass_sy='".$current_sy."' AND ass_stud_no='".$_GET['stud_no']."') ORDER BY bill_prio ASC LIMIT 0,12");
		$sumPayable=0;
		$sumPaid=0;
		while($dataPayables = dbarray($checkPayables)){
		?>													
			<tr>
				<td><?php echo $dataPayables['bill_desc'];?></td>
				<td><?php echo $dataPayables['ass_amount'];?></td>
				<td><?php echo ($dataPayables['ass_invoice_no']==0?"":$dataPayables['ass_invoice_no']);?></td>
				<td><a href="anecdotalUpdate.frm.php?anec_no=<?php echo $dataAnec['anec_no']; ?>" title="Update" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
						<span class="glyphicon glyphicon-pencil"></span></a></td>		
			</tr>
		<?php 
		$sumPayable+=$dataPayables['ass_amount'];
		$sumPaid=$sumPaid + ($dataPayables['ass_invoice_no']==0?0:$dataPayables['ass_amount']);
		}
		?>	
		</tbody>
	</table>
			</td>
			<td valign="top">
			<table width="450" class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
		<thead>
			<tr>
				<th align="left" width="60%"><u>Description</th>
				<th align="left" width="10%"><u>Amount</th>
				<th align="left" width="20%"><u>Invoice #</th>
		
			</tr>
		</thead>
		<tbody> 
		<?php
		$checkPayables = dbquery("SELECT * FROM bill_assessment INNER JOIN  bill_bills ON ass_bill_no=bill_no WHERE (ass_sy='".$current_sy."' AND ass_stud_no='".$_GET['stud_no']."') ORDER BY bill_prio ASC LIMIT 12,12");
		while($dataPayables = dbarray($checkPayables)){
		?>													
			<tr>
				<td><?php echo $dataPayables['bill_desc'];?></td>
				<td><?php echo $dataPayables['ass_amount'];?></td>
				<td><?php echo ($dataPayables['ass_invoice_no']==0?"":$dataPayables['ass_invoice_no']);?></td>
				<td><a href="anecdotalUpdate.frm.php?anec_no=<?php echo $dataAnec['anec_no']; ?>" title="Update" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
						<span class="glyphicon glyphicon-pencil"></span></a></td>		
			</tr>
		<?php 
		$sumPayable+=$dataPayables['bill_amount'];
		$sumPaid=$sumPaid + ($dataPayables['ass_invoice_no']==0?0:$dataPayables['bill_amount']);

		}
		?>	

		</tbody>
	</table>
			</td>
		</tr>
		<tr>
			<td align="left"><b>Total Payables: <?php echo $sumPayable;?> <br> Payments Made: <?php echo $sumPaid;?></b></td>
			<td align="left" colspan="2"><b>Remarks: </b><input type="text" size="30" placeholder=" ***" style="border:0px;" autofocus></td>
		</tr>		
	</table>
</div>
<hr>
<table border="0" cellspacing="0" cellpadding="0" width="800">
	<tr>
		<td width="40%"></td>
		<td></td>
		<td width="40%">Prepared by:<br><br><br></td>
	</tr>
	<tr>
	<?php
		$checkUser = dbquery("SELECT * FROM users WHERE user_name='".$_SESSION["user_name"]."'");
		$dataUser = dbarray($checkUser );
		?>
		<td align="center"></td>
		<td></td>
		<td align="center"><b><?php echo $dataUser['user_fullname'];?></b><br>Accounts Personnel</td>
	</tr>	

	<tr>
		<td colspan="3"><br> *** <?php echo date("M d, Y - D / h:i:s A");?> / <?php echo $dataUser['user_fullname'];?> ***</td>
	</tr>		
</table>	

