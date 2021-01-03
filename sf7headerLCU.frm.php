<?php
require ("maincore.php");
$resultAnec = dbquery("SELECT * FROM iis_page WHERE iis_page_no='".$_GET['anec_no']."'");
$dataAnec = dbarray($resultAnec);
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">New SF7 Header Information</h4>
    </div>
	<form method="post" action="sf7header.src.php?LCNewAnec=Yes">
	<input type="hidden" id="anec_no" name="anec_no" required="required" class=" form-control" value="<?php echo $_GET['anec_no'];?>">
	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Title of Designation <span title="Required" class="text-danger">*</span></label>
						<select id="anec_desc" name="anec_designation" required="required" class=" form-control">
							<option value="">---select---</option>
							<option value="Teacher" <?php echo ($dataAnec['iis_pagetitle']=="Teacher"?"selected":"");?>>Teacher</option>
							<option value="Clerk" <?php echo ($dataAnec['iis_pagetitle']=="Clerk"?"selected":"");?>>Clerk</option>
							<option value="Security Guard" <?php echo ($dataAnec['iis_pagetitle']=="Security Guard"?"selected":"");?>>Security Guard</option>
							<option value="Driver" <?php echo ($dataAnec['iis_pagetitle']=="Driver"?"selected":"");?>>Driver</option>
							<option value="General Services" <?php echo ($dataAnec['iis_pagetitle']=="General Services"?"selected":"");?>>General Services</option>
							<option value="Others" <?php echo ($dataAnec['iis_pagetitle']=="Others"?"selected":"");?>>Others</option>
						</select>	
					</div>
				</div>
				
			</div>	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Appointment <span title="Required" class="text-danger">*</span></label>
						<select id="anec_desc" name="anec_appointment" required="required" class=" form-control">
							<option value="">---select---</option>
							<option value="Contractual">Contractual</option>
							<option value="Substitute">Substitute</option>
							<option value="Volunteer">Volunteer</option>
							<option value="Others">Others</option>
						</select>	
					</div>
				</div>
				
			</div>	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Fund Source <span title="Required" class="text-danger">*</span></label>
						<select id="anec_desc" name="anec_fundsource" required="required" class=" form-control">
							<option value="">---select---</option>
							<option value="1">MOOE</option>
							<option value="2">SEF</option>
							<option value="3">PTA</option>
							<option value="4">NGO</option>
							<option value="5">Others</option>
						</select>	
					</div>
				</div>
				
			</div>		
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Designation Type<span title="Required" class="text-danger">*</span></label>
						<select id="anec_desc" name="anec_type" required="required" class=" form-control">
							<option value="">---select---</option>
							<option value="1">Teaching</option>
							<option value="2">Non-Teaching</option>

						</select>	
					</div>
				</div>
				
			</div>				
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Number of Incumbent <span title="Required" class="text-danger">*</span></label>
						<select id="anec_desc" name="anec_count" required="required" class=" form-control">
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