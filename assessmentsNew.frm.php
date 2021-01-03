<?php
session_start();
require ('maincore.php');
if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$updateBills = dbquery("INSERT INTO bill_bills (bill_no, bill_category, bill_desc, bill_sy, bill_amount, bill_prio) VALUES ('', '".$_POST['bill_cat']."', '".$_POST['bill_desc']."', '".$current_sy."', '".$_POST['bill_amount']."', '".$_POST['bill_prio']."')");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

?>
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()">&times;</button>
		<?php
		if(isset($_GET['bill_no'])){
			$checkName = dbquery("SELECT * FROM bill_bills WHERE bill_no='".$_GET['bill_no']."'");
			$dataName = dbarray($checkName);
		} else {
			$dataName = null;
		}
		?>
        <h4 class="modal-title">New Bill <small> </small></h4>
      </div>
	  <form name="form1" method="post" action="assessmentsNew.frm.php?Save=Yes">
	  <input type="hidden" id="user_name" name="bill_no" maxlength="15" required="required" class="form-control" value="<?php echo $dataName['bill_no'];?>" / autofocus>
      <div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">Category <span title="Required" class="text-danger">*</span></label>
						<select type="text" id="" name="bill_cat" maxlength="50" required="required" class="form-control" value="<?php echo $dataName['bill_category'];?>" / autofocus >
							<option value="">---select---</option>
							<?php
								$selectBillCat = dbquery("SELECT * FROM dropdowns WHERE field_category='BILL_CAT' ORDER BY field_name ASC");
								while($dataBillCat = dbarray($selectBillCat)){
							?>
									<option value="<?php echo $dataBillCat['field_name'];?>"><?php echo $dataBillCat['field_name'];?></option>
								<?php
								}
								?>
						</select>
					</div>
				</div>				
			</div>			
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">Description <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="" name="bill_desc" maxlength="50" required="required" class="form-control" value="" / autofocus >
					</div>
				</div>				
			</div>	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">Amount <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="" name="bill_amount" maxlength="50" required="required" class="form-control" value="" / autofocus >
					</div>
				</div>				
			</div>			
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">Prio/Sort <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="" name="bill_prio" maxlength="50" required="required" class="form-control" value="" / autofocus >
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
