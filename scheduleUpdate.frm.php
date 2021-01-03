<?php
require ("maincore.php");
$resultSchedule = dbquery("SELECT * FROM section WHERE (section_no='".$_GET['section_no']."' AND section_sy='".$current_sy."')");
$dataSchedule = dbarray($resultSchedule);
$resultClass = dbquery("SELECT * FROM class WHERE class_no='".$_GET['class_no']."'");
$dataClass = dbarray($resultClass);
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Update Schedule</h4>
    </div>
	<form method="post" action="sched.scr.php?UpdateSched=Yes">
	<input type="hidden" id="class_section_no" name="class_section_no" required="required" class=" form-control" value="<?php echo $dataSchedule['section_no'];?>">
	<input type="hidden" id="class_pros_no" name="class_pros_no" required="required" class=" form-control" value="<?php echo $dataClass['class_pros_no'];?>">
	<input type="hidden" id="class_no" name="class_no" required="required" class=" form-control" value="<?php echo $dataClass['class_no'];?>">
	<input type="hidden" id="class_pros_name" name="class_pros_name" required="required" class=" form-control" value="<?php echo $dataTitle['pros_title'];?>" readonly>

	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Section <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="class_section_name" name="class_section_name" required="required" class=" form-control" value="<?php echo $dataSchedule['section_name'];?>" readonly >
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
					<?php
					$resultTitle = dbquery("SELECT * FROM prospectus WHERE pros_no='".$dataClass['class_pros_no']."'");
					$dataTitle = dbarray($resultTitle);
					?>
						<label class="control-label required" for="stud_lrn">Course Code <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="class_pros_name" name="class_pros_name2" required="required" class=" form-control" value="<?php echo $dataTitle['pros_title'];?> - <?php echo $dataTitle['pros_desc'];?>" readonly>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Timeslots (Military Time)<span title="Required" class="text-danger">*</span></label>
						<br><small><i>(Separated by " / " for multiple timeslots)</i></small>
						<?php
						$checkTimeslots = dbquery("SELECT * FROM dropdowns WHERE field_category='TIMELSLOTS' ORDER BY field_name ASC");
						?>
						<!---
						<select id="class_timeslots" name="class_timeslots" required="required" class=" form-control">
								<option value="">---select---</option>
								
							<?php
							while ($dataTimeslots = dbarray($checkTimeslots)){
							?>
								<option value="<?php echo $dataTimeslots['field_name'];?>" <?php echo ($dataTimeslots['field_name']==$dataClass['class_timeslots']?"selected":"");?>><?php echo $dataTimeslots['field_name'];?></option>
							<?php
							}
							?>
						</select>
						--->
						<input type="text" id="class_timeslots" name="class_timeslots" required="required" class=" form-control" value="<?php echo $dataClass['class_timeslots'];?>">
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Days <span title="Required" class="text-danger">*</span></label>
						<br><small><i>(Separated by " / " for multiple day slots)</i></small>
						<input type="text" id="class_days" name="class_days" required="required" class=" form-control" value="<?php echo $dataClass['class_days'];?>" >
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8 col-md-8">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Classroom <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="class_room" name="class_room" required="required" class=" form-control" value="<?php echo $dataClass['class_room'];?>" >
					</div>
				</div>
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Semester to Offer <span title="Required" class="text-danger">*</span></label>
						<select type="text" id="class_sem" name="class_sem" required="required" class=" form-control" >
							<option value="">---select---</option>
						<?php
						if($dataSchedule['section_level']>10){
						?>
							<option value="1" <?php echo ($dataClass['class_sem']==1?"selected":"");?>>First Semester</option>
							<option value="2" <?php echo ($dataClass['class_sem']==2?"selected":"");?>>Second Semester</option>
						<?php
						}
						else {
						?>
							<option value="12" <?php echo ($dataClass['class_sem']==12?"selected":"");?>>Full Year</option>
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
						<label class="control-label required" for="stud_lrn">Teacher <span title="Required" class="text-danger">*</span></label>
						<select type="text" id="class_user_name" name="class_user_name" required="required" class=" form-control" >
							<option value="">---select---</option>
							<option value="1" <?php echo($dataTeacherList['user_no']==$dataClass['class_user_name']?"selected":"");?>>TBA</option>
						<?php
						$resulTeacherList = dbquery("SELECT * FROM users WHERE (user_role!='3' and user_status='1' and user_no>=3) ORDER BY user_fullname ASC");
						while($dataTeacherList = dbarray($resulTeacherList)){
						?>
							<option value="<?php echo $dataTeacherList['user_no'];?>" <?php echo($dataTeacherList['user_no']==$dataClass['class_user_name']?"selected":"");?>><?php echo strtoupper($dataTeacherList['user_fullname']);?></option>
						<?php } ?>
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