<?php
require ("maincore.php");
$resultAnec = dbquery("SELECT * FROM teacherappointments WHERE teacherappointments_no='".$_GET['anec_no']."'");
$dataAnec = dbarray($resultAnec);
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Modify Designation</h4>
    </div>
	<form method="post" action="teacherAppointment.scr.php?UpdateAnec=Yes">
	<input type="hidden" id="anec_no" name="anec_no" required="required" class=" form-control" value="<?php echo $_GET['anec_no'];?>">
	<input type="hidden" id="anec_details" name="anec_item" required="required" class=" form-control" value="<?php echo $dataAnec['teacherappointments_item_no'];?>">
	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Designation <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="anec_details" name="anec_position" required="required" class=" form-control" value="<?php echo $dataAnec['teacherappointments_position'];?>" style="text-transform:uppercase;">
					</div>
				</div>
			</div>				
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Date of Designation<span title="Required" class="text-danger">*</span></label>
						<input type="date" id="anec_details" name="anec_date" required="required" class=" form-control" value="<?php echo $dataAnec['teacherappointments_date'];?>" style="text-transform:uppercase;">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Start School Year <span title="Required" class="text-danger">*</span></label>
						<select id="anec_desc" name="anec_status" required="required" class=" form-control">
						<option value="">---select---</option>
							<?php
							for($i=$current_sy;$i>=1900;$i--){
							?>
								<option value="<?php echo $i;?>" <?php echo ($i==$dataAnec['teacherappointments_status']?"selected":"");?>><?php echo $i;?>-<?php echo $i+1;?></option>
							<?php
							}
							?>
						</select>	
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">End School Year <span title="Required" class="text-danger">*</span></label>
						<select id="anec_desc" name="anec_funding" required="required" class=" form-control">
						<option value="0" <?php echo (0==$dataAnec['teacherappointments_funding']?"selected":"");?>>---present---</option>
							<?php
							for($i=$current_sy;$i>=1900;$i--){
							?>
								<option value="<?php echo $i;?>" <?php echo ($i==$dataAnec['teacherappointments_funding']?"selected":"");?>><?php echo $i;?>-<?php echo $i+1;?></option>
							<?php
							}
							?>
						</select>	
					</div>
				</div>
			</div>	
			
		</div>
     </div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')">Update</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	</form>
</div>