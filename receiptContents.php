<?php
session_start();
require ('maincore.php');
?>	
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<?php
		$checkPayables = dbquery("SELECT * FROM bill_receipt WHERE receipt_no='".$_GET['receipt_no']."'");
		$dataStud = dbarray($checkPayables);
		$checkName = dbquery("SELECT * FROM student WHERE stud_no='".$dataStud['receipt_stud_no']."'");
		$dataName = dbarray($checkName);
		$countName = dbrows($checkName );
		
		?>
        <h4 class="modal-title">Item List for Receipt # <?php echo $_GET['receipt_no'];?> 
		<small>for <?php echo $dataName['stud_lname'].", ".$dataName['stud_fname'];?></small>
		</h4>
      </div>
	  <form name="form1" method="post" action="studStatement.frm.php?Save=Yes">
	  <input type="hidden" id="user_name" name="stud_no" maxlength="15" required="required" class="form-control" value="<?php echo $dataName['stud_no'];?>" / autofocus>
      <div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
				<div class="table-responsive">
	<table width="100%" class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
		<thead>
			<tr>
				<th align="left" width="5%"><u>#</th>
				<th align="left" width="40%"><u>Description</th>
				<th align="left" width="10%"><u>Amount</th>
	
			</tr>
		</thead>
		<tbody> 
		<?php
		$i=1;
		$sumPayable=0;
		$checkPayables = dbquery("SELECT * FROM bill_receipt INNER JOIN bill_ledger ON receipt_no=ledger_receipt_no INNER JOIN bill_assessment ON ledger_ass_no=ass_no INNER JOIN bill_bills ON ass_bill_no=bill_no WHERE 	receipt_no='".$_GET['receipt_no']."' ORDER BY bill_prio ASC");
		while($dataPayables = dbarray($checkPayables)){
		?>													
			<tr>
				<td><?php echo $i;?></td>
				<td><small><?php echo $dataPayables['bill_desc'];?></small></td>
				<td align="right"><?php echo number_format($dataPayables['bill_amount'],2);?> <?php echo ($dataPayables['receipt_active']==0?" (voided)":"");?></td>

			</tr>
		<?php 
		$sumPayable+=($dataPayables['receipt_active']==0?"0":$dataPayables['bill_amount']);
		$i++;
		}
		?>	
		<tr>
		<?php
		$checkReceipt = dbquery("select * from bill_receipt where receipt_no='".$_GET['receipt_no']."'");
		$dataReceipt = dbarray($checkReceipt);
		?>
			<td></td><td align="right"><b>Amount Due</b><br> <b>Amount Tendered</b><br><b>Change </b></td>
			<td align="right">
				<b><?php echo number_format($sumPayable,2);?> <?php echo ($sumPayable==0?" (voided)":"");?></b><br>
				<b><?php echo number_format($dataReceipt['receipt_amtPaid'],2);?> <?php echo ($dataReceipt['receipt_amtPaid']==0?" (voided)":"");?></b><br>
				<b><?php echo number_format($dataReceipt['receipt_amtChange'] ,2);?> </b><br>
			</td> 
		</tr>

		</tbody>
	</table>
</div>
				</div>
			</div>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	  </form>
	</div>
<script type="text/javascript">
var amount = 0;
var changes = 0;

function updateTotal(element){
        var price = parseFloat(element.getAttribute('data-price'));
        amount += element.checked ? price : price*-1;
        document.getElementById('total').value = amount;
		document.getElementById('tendered').value = amount;
		changes =  document.getElementById('tendered').value - document.getElementById('total').value;
		document.getElementById('change').value = changes;
            
    }
</script>
<script type="text/javascript">
var changes = 0;

function updateChange(element){
        var price = parseFloat(element.getAttribute('placeholder'));
        changes =  document.getElementById('tendered').value - document.getElementById('total').value;
        document.getElementById('change').value = changes;
            
    }
</script>