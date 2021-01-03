<?php
require ("maincore.php");
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">New Designation</h4>
    </div>
	<form method="post" action="teacherAppointment.scr.php?NewAnec=Yes">
	<input type="hidden" id="anec_stud_no" name="anec_stud_no" required="required" class=" form-control" value="<?php echo $_GET['stud_no'];?>">
	<input type="hidden" id="anec_details" name="anec_item" required="required" class=" form-control" value="ANCILLARY">
	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Designation <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="anec_details" name="anec_position" required="required" class=" form-control" value="" style="text-transform:uppercase;">
					</div>
				</div>
			</div>				
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Date of Designation<span title="Required" class="text-danger">*</span></label>
						<input type="date" id="anec_details" name="anec_date" required="required" class=" form-control" value="" style="text-transform:uppercase;">
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
								<option value="<?php echo $i;?>"><?php echo $i;?>-<?php echo $i+1;?></option>
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
						<option value="0">---present---</option>
							<?php
							for($i=$current_sy;$i>=1900;$i--){
							?>
								<option value="<?php echo $i;?>"><?php echo $i;?>-<?php echo $i+1;?></option>
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
		<button type="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')">Save</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	</form>
</div>