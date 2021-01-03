<?php
session_start();
require ('maincore.php');

if(isset($_GET['cancelreceipt']) && $_GET['Save']="Yes"){
	$phpdate = date("Y-m-d h:i:s");
	$updateAss = dbquery("UPDATE bill_assessment SET ass_invoice_no='0' WHERE ass_invoice_no='".$_GET['receipt_no']."'");
	$deleteRec = dbquery("UPDATE bill_receipt SET receipt_active='0', receipt_amtPaid='0', receipt_datetime='".$phpdate."' WHERE receipt_no='".$_GET['receipt_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
if(isset($_GET['cancelwaive']) && $_GET['Save']="Yes"){
	$checkAss = dbquery("SELECT * FROM bill_assessment INNER JOIN bill_bills on ass_bill_no=bill_no WHERE ass_no='".$_GET['ass_no']."'");
	$dataAss = dbarray($checkAss);
	$updateAss = dbquery("UPDATE bill_assessment SET ass_amount='".$dataAss['bill_amount']."', ass_invoice_no='0', ass_remarks='Cancelled Waive c/o ".$current_user."' WHERE ass_no='".$_GET['ass_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$updateAss = dbquery("UPDATE bill_assessment SET ass_amount='0', ass_invoice_no='1', ass_remarks='".$_POST['waiveReason']." c/o ".$current_user."' WHERE ass_no='".$_POST['ass_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
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
        <h4 class="modal-title">Waive Fee for <?php echo $dataName['stud_lname'].", ".$dataName['stud_fname'];?></h4>
      </div>
	  <form name="form1" method="post" action="studStatementWaive.frm.php?Save=Yes">
	  <input type="hidden" id="user_name" name="ass_no" maxlength="15" required="required" class="form-control" value="<?php echo $_GET['ass_no'];?>" / autofocus>
      <div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
				<div class="table-responsive">
				<?php
				$checkAss = dbquery("SELECT * FROM bill_assessment INNER JOIN bill_bills ON ass_bill_no=bill_no WHERE ass_no='".$_GET['ass_no']."'");
				$dataAss = dbarray($checkAss );
				?>
				Reason for waiving <b><?php echo $dataAss['bill_desc'];?></b> of <b>P<?php echo $dataAss['bill_amount'];?></b>?
				<input type="text" name="waiveReason" placeholder="working scholar, with sibling..." required="required" class="form-control">
				</div>
				</div>
			</div>
		</div>
      <div class="modal-footer">
		<button type="submit" id="submit" name="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')" >Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
      </div>
	  </form>
	</div>
