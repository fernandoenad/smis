<?php
session_start();
require ('maincore.php');
if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$updateClass = dbquery("UPDATE dropdowns SET field_name='".$_POST['field_name']."', field_ext='".$_POST['field_ext']."' WHERE  field_no='".$_POST['field_no']."' ");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

$resultGrade = dbquery("SELECT * FROM dropdowns WHERE (field_no='".$_GET['field_no']."')");
$dataGrade = dbarray($resultGrade);
?>
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modify Dropdown Item List for Category <?php echo $_GET['category'];?> </h4>
      </div>
	  <form name="form1" method="post" action="dropdownsEdit.frm.php?Save=Yes">
	  <input type="hidden" id="field_category" name="field_category" maxlength="150" required="required" class="form-control" value="<?php echo $_GET['category'];?>">
	  <input type="hidden" id="field_no" name="field_no" maxlength="150" required="required" class="form-control" value="<?php echo $_GET['field_no'];?>">
      <div class="modal-body">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Entry <span title="Required" class="text-danger">*</span></label>
							<input type="text" id="field_name" name="field_name" maxlength="200" required="required" class="form-control" value="<?php echo $dataGrade ['field_name'];?>"		>

						</div>
					</div>
				</div>	
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Extension/ Remarks <span title="Required" class="text-danger">*</span></label>
							<input type="text" id="field_ext" name="field_ext" maxlength="200" required="required" class="form-control" value="<?php echo $dataGrade ['field_ext'];?>"		>

						</div>
					</div>
				</div>
	  </div>
      <div class="modal-footer">
		<button type="submit" id="submit" name="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')" >Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	  </form>
    </div>
