<?php
session_start();
require ('maincore.php');
if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$updateSettings = dbquery("INSERT INTO settings (settings_no, settings_sy, settings_sem, settings_pros, settings_registrar, settings_principal, settings_supervisor, settings_representative, settings_superintendent, settings_bosy, settings_eosy, settings_late1, settings_late2, settings_closing, settings_eosynow, activated) VALUES ('', '".$_POST['sy']."', '1', '".$_POST['pros']."', '".$_POST['reg']."', '".$_POST['pri']."', '".$_POST['vis']."', '".$_POST['rep']."', '".$_POST['sup']."', '".$_POST['bos']."', '".$_POST['eos']."', '".$_POST['late1']."', '".$_POST['late2']."', '".$_POST['closing']."', '0', '0')");
	header("Location: ".$_SERVER['HTTP_REFERER']);
	
}

$dataSY = null;
?>
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Site Global Settings</h4>
      </div>
	  <form name="form1" method="post" action="settingsNew.frm.php?Save=Yes">
	  <input type="hidden" id="user_name" name="user_name" maxlength="15" required="required" class="form-control" value="<?php echo $_SESSION["user_name"];?>" / autofocus>
      <div class="modal-body">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Current School Year <span title="Required" class="text-danger">*</span></label>
							<select name="sy" class="form-control">
								<option value="">---select---</option>
								<?php
								for($sy=1994;$sy<=date("Y")+1;$sy++){
									$selectSY = dbquery("SELECT * FROM settings WHERE settings_sy='".$sy."'");
									$rowsSY = dbrows($selectSY);
									if($rowsSY==0){
								?>
									<option value="<?php echo $sy;?>"><?php echo $sy;?> - <?php echo $sy+1;?></value>
								<?php
									}
								}
								?>
							</select>
							
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Current Curriculum <span title="Required" class="text-danger">*</span></label>
							<select name="pros" class="form-control" required>
							<option value="">---select---</option>
							<?php 
							$selectCurr = dbquery("SELECT * FROM dropdowns WHERE field_category='CURRICULUM' ORDER BY field_name DESC");
							while($dataCurr = dbarray($selectCurr)){
							?>
								<option value="<?php echo $dataCurr['field_name'];?>"><?php echo $dataCurr['field_name'];?></option>
							<?php	
							}
							?>
						</select>						</div>
					</div>
				</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Current School Registrar <span title="Required" class="text-danger">*</span></label>
							<input type="text" id="user_fullname" name="reg" maxlength="50" required="required" class="form-control" value="" / autofocus >
						</div>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Current School Principal <span title="Required" class="text-danger">*</span></label>
							<input type="text" id="user_fullname" name="pri" maxlength="50" required="required" class="form-control" value="" / autofocus >
						</div>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Current District Supervisor <span title="Required" class="text-danger">*</span></label>
							<input type="text" id="user_fullname" name="vis" maxlength="50" required="required" class="form-control" value="" / autofocus >
						</div>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Current Division Representative <span title="Required" class="text-danger">*</span></label>
							<input type="text" id="user_fullname" name="rep" maxlength="50" required="required" class="form-control" value="" / autofocus >
						</div>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Current Schools Division Superintendent <span title="Required" class="text-danger">*</span></label>
							<input type="text" id="user_fullname" name="sup" maxlength="50" required="required" class="form-control" value="" / autofocus >
						</div>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Beginning of School Year <span title="Required" class="text-danger">*</span></label>
							<input type="date" id="user_fullname" name="bos" maxlength="25" required="required" class="form-control" value="" / autofocus >
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">End of School Year <span title="Required" class="text-danger">*</span></label>
							<input type="date" id="user_fullname" name="eos" maxlength="25" required="required" class="form-control" value="" / autofocus >
						</div>
					</div>					
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-4 col-md-4">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Late (1st Sem) <span title="Required" class="text-danger">*</span></label>
							<input type="date" id="user_fullname" name="late1" maxlength="25" required="required" class="form-control" value="" / autofocus >
						</div>
					</div>
					<div class="col-lg-4 col-md-4">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Late (2nd Sem) <span title="Required" class="text-danger">*</span></label>
							<input type="date" id="user_fullname" name="late2" maxlength="25" required="required" class="form-control" value="" / autofocus >
						</div>
					</div>
					<div class="col-lg-4 col-md-4">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Closing <span title="Required" class="text-danger">*</span></label>
							<input type="date" id="user_fullname" name="closing" maxlength="25" required="required" class="form-control" value="" / autofocus >
						</div>
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
