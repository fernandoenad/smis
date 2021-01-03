<?php
require ("maincore.php");
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">New Case</h4>
    </div>
	<form method="post" action="anecdotal.scr.php?NewAnec=Yes">
	<input type="hidden" id="anec_stud_no" name="anec_stud_no" required="required" class=" form-control" value="<?php echo $_GET['stud_no'];?>">
	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Date <span title="Required" class="text-danger">*</span></label>
						<input type="date" id="anec_desc" name="anec_date" required="required" class=" form-control" value="" style="text-transform:uppercase;">
					</div>
				</div>
			</div>		
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Description <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="anec_desc" name="anec_desc" required="required" class=" form-control" value="" style="text-transform:uppercase;">
						<!--
						<select  id="anec_desc" name="anec_desc" required="required" class=" form-control">
							<option value="FIRST DAY">FIRST DAY</option>
							<option value="INFRACTIONS">INFRACTIONS</option>
							<option value="TIMELINESS ISSUE">FIRST DAY</option>
							<option value="FIRST DAY">FIRST DAY</option>
						</select>
						-->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Details <span title="Required" class="text-danger">*</span></label>
						<textarea type="text" id="anec_details" name="anec_details" required="required" class=" form-control" value="" placeholder="Details" style="text-transform:uppercase;"></textarea>
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