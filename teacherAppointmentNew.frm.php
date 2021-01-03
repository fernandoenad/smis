<?php
require ("maincore.php");
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">New Appointment</h4>
    </div>
	<form method="post" action="teacherAppointment.scr.php?NewAnec=Yes">
	<input type="hidden" id="anec_stud_no" name="anec_stud_no" required="required" class=" form-control" value="<?php echo $_GET['stud_no'];?>">
	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Item Number <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="anec_details" name="anec_item" required="required" class=" form-control" value="" style="text-transform:uppercase;">
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Position <span title="Required" class="text-danger">*</span></label>
						<?php
							$selectPosition = dbquery("SELECT * FROM  dropdowns WHERE field_category='POSITION' ORDER BY field_name ASC");							
						?>
						<select id="anec_desc" name="anec_position" required="required" class=" form-control">
							<option value="">---select---</option>
							<?php
							while ($rowPosition = dbarray($selectPosition)){
							?>
								<option value="<?php echo $rowPosition['field_name'];?>"><?php echo substr($rowPosition['field_ext'],2);?></option>
							<?php
							}
							?>
						</select>	
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Teacher Type <span title="Required" class="text-danger">*</span></label>
						<select id="teach_teacher" name="teach_teacher" required="required" class=" form-control">
							<option value="">---select---</option>
							<option value="1">Teaching</option>
							<option value="0">Non-Teaching</option>
						</select>	
					</div>
				</div>
			</div>		
			
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Date of Appointment<span title="Required" class="text-danger">*</span></label>
						<input type="date" id="anec_details" name="anec_date" required="required" class=" form-control" value="" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">First Day <span title="Required" class="text-danger">*</span></label>
						<input type="date" id="anec_details" name="anec_fdaydate" required="required" class=" form-control" value="" style="text-transform:uppercase;">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Status <span title="Required" class="text-danger">*</span></label>
						<?php
							$selectStatus = dbquery("SELECT * FROM  dropdowns WHERE field_category='STATUS' ORDER BY field_name ASC");							
						?>
						<select id="anec_desc" name="anec_status" required="required" class=" form-control">
						<option value="">---select---</option>
							<?php
							while ($rowStatus = dbarray($selectStatus)){
							?>
								<option value="<?php echo $rowStatus['field_name'];?>"><?php echo $rowStatus['field_name'];?></option>
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
						<label class="control-label required" for="stud_lrn">Funding <span title="Required" class="text-danger">*</span></label>
						<?php
							$selectFunding = dbquery("SELECT * FROM  dropdowns WHERE field_category='FUNDING' ORDER BY field_name ASC");							
						?>
						<select id="anec_desc" name="anec_funding" required="required" class=" form-control">
						<option value="">---select---</option>
							<?php
							while ($rowFunding = dbarray($selectFunding)){
							?>
								<option value="<?php echo $rowFunding['field_name'];?>"><?php echo $rowFunding['field_name'];?></option>
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