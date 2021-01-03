<?php
session_start();
require ('maincore.php');


if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$insertReceipt = dbquery("INSERT INTO bill_receipt (receipt_no, receipt_amtPaid, receipt_stud_no, receipt_amtTendered, receipt_amtChange, receipt_sy, receipt_datetime, receipt_user, receipt_active) VALUES ('', '".$_POST['total']."', '".$_POST['stud_no']."', '".$_POST['tendered']."', '".$_POST['change']."', '".$_POST['enrol_sy']."', '".$_POST['datetime']."', '".$_SESSION["userid"]."', '1' )");
	$checkReceipt = dbquery("SELECT * FROM bill_receipt WHERE (receipt_amtPaid='".$_POST['total']."' AND receipt_stud_no='".$_POST['stud_no']."' AND receipt_sy='".$_POST['enrol_sy']."' AND receipt_user='".$_SESSION["userid"]."') ORDER BY receipt_datetime DESC LIMIT 1");
	$dataReceipt = dbarray($checkReceipt);
	$payItems = $_POST['payments'];
	for($i=0; $i<sizeof($payItems);$i++){
		$insertLedger= dbquery("INSERT INTO bill_ledger (ledger_no, ledger_stud_no, ledger_sy, ledger_receipt_no, ledger_ass_no) VALUES ('', '".$_POST['stud_no']."', '".$_POST['enrol_sy']."', '".$dataReceipt['receipt_no']."', '".$payItems[$i]."')");
		$updateAss = dbquery("UPDATE bill_assessment SET ass_invoice_no='".$dataReceipt['receipt_no']."', ass_remarks='c/o ".$current_user."' WHERE ass_no='".$payItems[$i]."'");
	}
	header("Location: ".$_SERVER['HTTP_REFERER']."&receiptNo=".$dataReceipt['receipt_no']);
}

?>
	
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()">&times;</button>
		<?php
		$checkName = dbquery("SELECT * FROM student WHERE stud_no='".$_GET['stud_no']."'");
		$dataName = dbarray($checkName);
		$countName = dbrows($checkName );
		
		?>
        <h4 class="modal-title">Payment Transaction for <?php echo $dataName['stud_lname'].", ".$dataName['stud_fname'];?></h4>
      </div>
	  <form name="form1" method="post" action="studStatementBack.frm.php?Save=Yes">
	  <?php
	  $phpdate = date("Y-m-d h:i:s");
	  ?>
	  <input type="hidden" id="user_name" name="stud_no" maxlength="15" required="required" class="form-control" value="<?php echo $dataName['stud_no'];?>" / autofocus>
	  <input type="hidden" id="user_name" name="datetime" maxlength="15" required="required" class="form-control" value="<?php echo $phpdate;?>" / autofocus>
      <div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
				<div class="table-responsive">
	<table width="100%" id="datecontainer" onchange="Process(this.options[this.selectedIndex].value)">
		<tr>
			<td valign="top" width="50%">
			<table width="100%" class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
		<thead>
			<tr>
				<th align="left" width="5%"><u>Pay</th>
				<th align="left" width="40%"><u>Description</th>
				<th align="left" width="10%"><u>Amount</th>
		
			</tr>
		</thead>
		<tbody> 
		<?php
		$checkPayables = dbquery("SELECT * FROM bill_assessment INNER JOIN  bill_bills ON ass_bill_no=bill_no WHERE (ass_sy!='".$current_sy."' AND ass_stud_no='".$_GET['stud_no']."' and ass_invoice_no=0) ORDER BY bill_prio ASC LIMIT 0,11");
		$sumPayable=0;
		while($dataPayables = dbarray($checkPayables)){
		$enrol_sy =  $dataPayables['ass_sy'];
		?>													
			<tr>
				<td><input <?php echo ($dataPayables['ass_invoice_no']!=0?"disabled checked":"");?> type="checkbox"  name="payments[]" value="<?php echo $dataPayables['ass_no'];?>" data-price="<?php echo $dataPayables['bill_amount'];?>" onChange="updateTotal(this);"></td>
				<td><small><?php echo $dataPayables['bill_desc'];?></small></td>
				<td><?php echo $dataPayables['bill_amount'];?></td>

			</tr>
		<?php 
		$sumPayable+=$dataPayables['bill_amount'];
		}
		?>	
		</tbody>
	</table>
			</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td valign="top"  width="50%">
			<table width="100%" class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
		<thead>
			<tr>
				<th align="left" width="5%"><u>Pay</th>
				<th align="left" width="40%"><u>Description</th>
				<th align="left" width="10%"><u>Amount</th>
	
			</tr>
		</thead>
		<tbody> 
		<?php
		$checkPayables = dbquery("SELECT * FROM bill_assessment INNER JOIN  bill_bills ON ass_bill_no=bill_no WHERE (ass_sy!='".$current_sy."' AND ass_stud_no='".$_GET['stud_no']."' and ass_invoice_no=0) ORDER BY bill_prio ASC LIMIT 11,11");
		while($dataPayables = dbarray($checkPayables)){
		$enrol_sy =  $dataPayables['ass_sy'];
		?>													
			<tr>
				<td><input <?php echo ($dataPayables['ass_invoice_no']!=0?"disabled checked":"");?> type="checkbox" name="payments[]" value="<?php echo $dataPayables['ass_no'];?>" data-price="<?php echo $dataPayables['bill_amount'];?>" onChange="updateTotal(this);"></td>
				<td><small><?php echo $dataPayables['bill_desc'];?></small></td>
				<td><?php echo $dataPayables['bill_amount'];?></td>

			</tr>
		<?php 
		$sumPayable+=$dataPayables['bill_amount'];		
		}
		?>	

		</tbody>
	</table>
			</td>
		</tr>
		<tr>	
			<td></td>
			<td><input type="hidden" id="enrol_sy" name="enrol_sy" maxlength="15" required="required" class="form-control" value="<?php echo $enrol_sy;?>"></td>
			<td><b>Total: <input name="total" id="total" type="number" readonly="readonly" value="0.00" style="border:0px;"><br>
			<b>Amount Tendered: <input name="tendered" id="tendered" type="number" placeholder="0.00" style="width: 100px" size="5" onkeyup="updateChange(this);" onChange="updateChange(this);"><br>
			<b>Change: <input name="change" id="change" type="number" readonly="readonly"  value="0.00" style="border:0px;"></td>
		</tr>

	</table>
</div>
				</div>
			</div>
		</div>
      <div class="modal-footer">
		<button type="submit" id="submit" disabled name="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')" >Save</button>
        <button type="button"  class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
      </div>
	  </form>
	</div>
<script type="text/javascript">
var amount = 0;
var changes = 0;

function updateTotal(element){
		var price = parseFloat(element.getAttribute('data-price'));
		var subtotal = 0; 
        amount += element.checked ? price : price*-1;
        document.getElementById('total').value = amount;
		document.getElementById('tendered').value = amount;
		changes =  document.getElementById('tendered').value - document.getElementById('total').value;
		document.getElementById('change').value = changes;
		subtotal = $('#total').val();
		
		if(subtotal > 0){
			$("#submit").removeAttr("disabled");	
		}
		else{
			$("#submit").attr("disabled", "disabled");
		}            
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