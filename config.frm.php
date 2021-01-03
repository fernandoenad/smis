<?php
session_start();
require ('maincore.php');
if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$updateQuery = dbquery("update license set current_school_code='".$_POST['current_school_code']."', current_school_name='".$_POST['current_school_name']."', current_school_full='".$_POST['current_school_full']."', current_school_short='".$_POST['current_school_short']."', current_school_address='".$_POST['current_school_address']."', current_school_district='".$_POST['current_school_district']."', current_school_division='".$_POST['current_school_division']."', current_school_region='".$_POST['current_school_region']."', current_school_reg_code='".$_POST['current_school_reg_code']."', current_school_contact='".$_POST['current_school_contact']."', current_school_email='".$_POST['current_school_email']."', current_school_minlevel='".$_POST['current_school_minlevel']."', current_school_maxlevel='".$_POST['current_school_maxlevel']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Configure Website</h4>
      </div>
	  <form name="form1" method="post" action="config.frm.php?Save=Yes">
	  <input type="hidden" id="user_name" name="user_name" maxlength="15" required="required" class="form-control" value="<?php echo $_SESSION["user_name"];?>" / autofocus>
      <div class="modal-body">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-4 col-md-4">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">School Code (ID) <span title="Required" class="text-danger">*</span></label>
							<input type="number" id="user_name" name="current_school_code" maxlength="6" required="required" placeholder="302887" class="form-control" value="<?php echo $current_school_code;?>" / autofocus>
						</div>
					</div>
					<div class="col-lg-4 col-md-4">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Min. Grade Level <span title="Required" class="text-danger">*</span></label>
							<input type="number" min="0" max="12" id="user_name" name="current_school_minlevel" maxlength="6" required="required" placeholder="1" class="form-control" value="<?php echo $current_school_minlevel;?>" / autofocus>
						</div>
					</div>
					<div class="col-lg-4 col-md-4">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Max. Grade Level <span title="Required" class="text-danger">*</span></label>
							<input type="number" min="1" max="12" id="user_name" name="current_school_maxlevel" maxlength="150" required="required" placeholder="12" class="form-control" value="<?php echo $current_school_maxlevel;?>" / autofocus>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">School Fullname <span title="Required" class="text-danger">*</span></label>
							<input type="text" id="user_name" name="current_school_name" maxlength="150" required="required" placeholder="San Agustin National High School" class="form-control" value="<?php echo $current_school_name;?>" / autofocus>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-7 col-md-7">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">School Name (shortened) <span title="Required" class="text-danger">*</span></label>
							<input type="text" id="user_name" name="current_school_full" maxlength="150" required="required" placeholder="San Agustin National High School" class="form-control" value="<?php echo $current_school_full;?>" / autofocus>
						</div>
					</div>
					<div class="col-lg-5 col-md-5">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">School Abbreviation <span title="Required" class="text-danger">*</span></label>
							<input type="text" id="user_name" name="current_school_short" maxlength="150" required="required" placeholder="SANHS" class="form-control" value="<?php echo $current_school_short;?>" / autofocus>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-7 col-md-7">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">School Full Address (Municipality, Province) <span title="Required" class="text-danger">*</span></label>
							<input type="text" id="user_name" name="current_school_address" maxlength="150" required="required" placeholder="Sagbayan, Bohol" class="form-control" value="<?php echo $current_school_address;?>" / autofocus>
						</div>
					</div>
					<div class="col-lg-5 col-md-5">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">District <span title="Required" class="text-danger">*</span></label>
							<input type="text" id="user_name" name="current_school_district" maxlength="150" required="required" placeholder="Sagbayan" class="form-control" value="<?php echo $current_school_district;?>" / autofocus>
						</div>
					</div>
				</div>
				<div class="row">
					
					<div class="col-lg-3 col-md-3">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Division <span title="Required" class="text-danger">*</span></label>
							<input type="text" id="user_name" name="current_school_division" maxlength="150" required="required" placeholder="Bohol" class="form-control" value="<?php echo $current_school_division;?>" / autofocus>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Region (Text) <span title="Required" class="text-danger">*</span></label>
							<input type="text" id="user_name" name="current_school_region" maxlength="150" required="required" placeholder="Region VII, Central Visayas" class="form-control" value="<?php echo $current_school_region;?>" / autofocus>
						</div>
					</div>
					<div class="col-lg-3 col-md-3">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Region Code <span title="Required" class="text-danger">*</span></label>
							<input type="number" id="user_name" min="1" max="20" name="current_school_reg_code" maxlength="2" required="required" placeholder="7" class="form-control" value="<?php echo $current_school_reg_code;?>" / autofocus>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-4">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Contact Phone <span title="Required" class="text-danger">*</span></label>
							<input type="text" id="user_name" name="current_school_contact" maxlength="150" required="required" placeholder="+63.920.500.1182" class="form-control" value="<?php echo $current_school_contact;?>" / autofocus>
						</div>
					</div>
					<div class="col-lg-8 col-md-8">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">School Email <span title="Required" class="text-danger">*</span></label>
							<input type="text" id="user_name" name="current_school_email" maxlength="150" required="required" placeholder="sanhs.sagbayan@gmail.com" class="form-control" value="<?php echo $current_school_email;?>" / autofocus>
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
