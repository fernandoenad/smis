<?php
require ("maincore.php");
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">New Identification</h4>
    </div>
	<form method="post" action="teacherid.scr.php?NewAnec=Yes">
	<input type="hidden" id="anec_stud_no" name="anec_stud_no" required="required" class=" form-control" value="<?php echo $_GET['stud_no'];?>">
	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">ID Type <span title="Required" class="text-danger">*</span></label>
						<?php
							$selectIDType = dbquery("SELECT * FROM  dropdowns WHERE field_category='TEACHERIDS' ORDER BY field_name ASC");							
						?>
						<select id="anec_desc" name="anec_desc" required="required" class=" form-control">
							<?php
							while ($rowIDType = dbarray($selectIDType)){
							?>
								<option value="<?php echo $rowIDType['field_name'];?>"><?php echo $rowIDType['field_name'];?></option>
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
						<label class="control-label required" for="stud_lrn">ID Number <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="anec_details" name="anec_details" required="required" class=" form-control" value="" style="text-transform:uppercase;">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Date Issued <span title="Required" class="text-danger">*</span></label>
						<input type="date" id="anec_details" name="anec_date" required="required" class=" form-control" value="" >
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Place Issued <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="anec_details" name="anec_place" required="required" class=" form-control" value="" style="text-transform:uppercase;">
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