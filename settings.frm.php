<?php
session_start();
require ('maincore.php');
if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$updateSettings = dbquery("UPDATE settings SET activated='0'");
	$updateSettings1 = dbquery("UPDATE settings SET activated='1', settings_sem='".$_POST['sem']."', settings_month='".$_POST['month']."', settings_earlyreg='".$_POST['earlyreg']."', settings_eosynow='".$_POST['eosy']."', settings_loginmessage='".$_POST['loginmessage']."', settings_admissionmessage='".$_POST['admissionmessage']."' WHERE settings_sy='".$_POST['sy']."'");
	header("Location: ./?page=class&enrol_sy=".$_POST['sy']);
}
?>
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Site Global Settings</h4>
      </div>
	  <form name="form1" method="post" action="settings.frm.php?Save=Yes">
	  <input type="hidden" id="user_name" name="user_name" maxlength="15" required="required" class="form-control" value="<?php echo $_SESSION["user_name"];?>" / autofocus>
      <div class="modal-body">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-4 col-md-4">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Current School Year <span title="Required" class="text-danger">*</span></label>
							<select name="sy" class="form-control" required>
							<option value="">---select---</option>
							<?php 
							$selectSY = dbquery("SELECT * FROM settings ORDER BY settings_sy ASC");
							while($dataSY = dbarray($selectSY)){
							?>
								<option value="<?php echo $dataSY['settings_sy'];?>" <?php echo ($dataSY['settings_sy']==$current_sy?"selected":"");?>><?php echo $dataSY['settings_sy'];?> - <?php echo $dataSY['settings_sy']+1;?></option>
							<?php	
							}
							?>
						</select>
						</div>
					</div>
					<div class="col-lg-4 col-md-4">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Current Semester <span title="Required" class="text-danger">*</span></label>
							<select name="sem" class="form-control" required>
							<option value="">---select---</option>
							<option value="1" <?php echo ($current_sem=="1"?"selected":"");?>>First Semester</option>
							<option value="2" <?php echo ($current_sem=="2"?"selected":"");?>>Second Semester</option>							
						</select>
						</div>
					</div>
					<div class="col-lg-4 col-md-4">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Current Month <span title="Required" class="text-danger">*</span></label>
							<select name="month" class="form-control" required>
							<option value="">---select---</option>
							<option value="sch_m1" <?php echo ($current_month=="sch_m1"?"selected":"");?>>June</option>		
							<option value="sch_m2" <?php echo ($current_month=="sch_m2"?"selected":"");?>>July</option>		
							<option value="sch_m3" <?php echo ($current_month=="sch_m3"?"selected":"");?>>August</option>		
							<option value="sch_m4" <?php echo ($current_month=="sch_m4"?"selected":"");?>>September</option>		
							<option value="sch_m5" <?php echo ($current_month=="sch_m5"?"selected":"");?>>October</option>		
							<option value="sch_m6" <?php echo ($current_month=="sch_m6"?"selected":"");?>>November</option>		
							<option value="sch_m7" <?php echo ($current_month=="sch_m7"?"selected":"");?>>December</option>		
							<option value="sch_m8" <?php echo ($current_month=="sch_m8"?"selected":"");?>>January</option>		
							<option value="sch_m9" <?php echo ($current_month=="sch_m9"?"selected":"");?>>February</option>		
							<option value="sch_m10" <?php echo ($current_month=="sch_m10"?"selected":"");?>>March</option>		
							<option value="sch_m11" <?php echo ($current_month=="sch_m11"?"selected":"");?>>April</option>		
							<option value="sch_m12" <?php echo ($current_month=="sch_m12"?"selected":"");?>>May</option>		
						</select>
						</div>
					</div>
				</div>	
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Activate Early Registration <span title="Required" class="text-danger">*</span></label>
							<select name="earlyreg" class="form-control" required>
							<option value="">---select---</option>
							<option value="0" <?php echo ($earlyregistrationOn==false?"selected":"");?>>No</option>
							<option value="1" <?php echo ($earlyregistrationOn==true?"selected":"");?>>Yes</option>							
						</select>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Activate EOSY <span title="Required" class="text-danger">*</span></label>
							<select name="eosy" class="form-control" required>
							<option value="">---select---</option>
							<option value="0" <?php echo ($eoyupdate ==false?"selected":"");?>>No</option>
							<option value="1" <?php echo ($eoyupdate ==true?"selected":"");?>>Yes</option>							
						</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Login Message <span title="Required" class="text-danger">*</span></label>
							<textarea name="loginmessage" class="form-control" rows="3"><?php echo $login_message;?></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Admission Message <span title="Required" class="text-danger">*</span></label>
							<textarea name="admissionmessage" class="form-control" rows="6"><?php echo $admission_message;?></textarea>
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
