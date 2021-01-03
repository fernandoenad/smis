<?php
require ("maincore.php");

?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">New SF7 Header Information</h4>
    </div>
	<form method="post" action="sf7header.src.php?NewAnec=Yes">
	<input type="hidden" id="anec_no" name="anec_no" required="required" class=" form-control" value="<?php echo $_GET['anec_no'];?>">
	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Department <span title="Required" class="text-danger">*</span></label>
						<input type="hidden" id="anec_stud_no" name="anec_stud_no" required="required" class=" form-control" value="<?php echo $dataTeacher['teach_no'];?>">
						<select id="anec_dep" name="anec_dep" required="required" class=" form-control">
							<option value="100" >Elementary</option>
							<option value="200" >Junior High School</option>
							<option value="300" >Senior High School</option>
						</select>	
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Title of Plantilla Position <span title="Required" class="text-danger">*</span></label>
						<?php
							$selectPosition = dbquery("SELECT * FROM  dropdowns WHERE (field_category='POSITION' and field_ext like '0_%') ORDER BY field_name ASC");							
						?>
						<select id="anec_desc" name="anec_position" required="required" class=" form-control">
						<option value="">---select---</option>
							<?php
							while ($rowPosition = dbarray($selectPosition)){
							?>
								<option value="<?php echo substr($rowPosition['field_ext'],2);?>"><?php echo substr($rowPosition['field_ext'],2);?></option>
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
						<label class="control-label required" for="stud_lrn">Number of Incumbent <span title="Required" class="text-danger">*</span></label>
						<select id="anec_desc" name="anec_funding" required="required" class=" form-control">
						<option value="">---select---</option>
							<?php
							for ($i=1;$i<=100;$i++){
							?>
								<option value="<?php echo $i;?>" ><?php echo $i;?></option>
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