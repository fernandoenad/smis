<?php
require ("maincore.php");
$resultAnec = dbquery("SELECT * FROM teacherappointments WHERE teacherappointments_no='".$_GET['anec_no']."'");
$dataAnec = dbarray($resultAnec);
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Modify Appointment</h4>
    </div>
	<form method="post" action="teacherAppointment.scr.php?UpdateAnec=Yes">
	<input type="hidden" id="anec_no" name="anec_no" required="required" class=" form-control" value="<?php echo $_GET['anec_no'];?>">
	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Item Number <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="anec_details" name="anec_item" required="required" class=" form-control" value="<?php echo $dataAnec['teacherappointments_item_no'];?>" style="text-transform:uppercase;">
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
								<option value="<?php echo $rowPosition['field_name'];?>" <?php echo($rowPosition['field_name']==$dataAnec['teacherappointments_position']?"selected":"");?>><?php echo substr($rowPosition['field_ext'],2);?></option>
							<?php
							}
							?>
						</select>	
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<?php
						$checkTeacher = dbquery("select * from teacher where teach_no='".$dataAnec['teacherappointments_teach_no']."'");
						$dataTeacher = dbarray($checkTeacher);
						?>
						<label class="control-label required" for="stud_lrn">Teacher Type <span title="Required" class="text-danger">*</span></label>
						<input type="hidden" id="anec_stud_no" name="anec_stud_no" required="required" class=" form-control" value="<?php echo $dataTeacher['teach_no'];?>">
						<select id="teach_teacher" name="teach_teacher" required="required" class=" form-control">
							<option value="">---select---</option>
							<option value="1" <?php echo ($dataTeacher['teach_teacher']==1?"selected":"");?>>Teaching</option>
							<option value="0" <?php echo ($dataTeacher['teach_teacher']==0?"selected":"");?>>Non-Teaching</option>
						</select>	
					</div>
				</div>
			</div>		
			
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Date of Appointment <span title="Required" class="text-danger">*</span></label>
						<input type="date" id="anec_details" name="anec_date" required="required" class=" form-control" value="<?php echo $dataAnec['teacherappointments_date'];?>" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">First Day <span title="Required" class="text-danger">*</span></label>
						<input type="date" id="anec_details" name="anec_fdaydate" required="required" class=" form-control" value="<?php echo $dataAnec['teacherappointments_fdaydate'];?>" style="text-transform:uppercase;">
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
								<option value="<?php echo $rowStatus['field_name'];?>" <?php echo($rowStatus['field_name']==$dataAnec['teacherappointments_status']?"selected":"");?>><?php echo $rowStatus['field_name'];?></option>
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
								<option value="<?php echo $rowFunding['field_name'];?>" <?php echo($rowFunding['field_name']==$dataAnec['teacherappointments_funding']?"selected":"");?>><?php echo $rowFunding['field_name'];?></option>
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