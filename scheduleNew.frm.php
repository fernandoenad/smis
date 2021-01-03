<?php
require ("maincore.php");											
$resultSchedule = dbquery("SELECT * FROM section WHERE (section_no='".$_GET['section_no']."' AND section_sy='".$_GET['enrol_sy']."')");
$dataSchedule = dbarray($resultSchedule);
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">New Schedule</h4>
    </div>
	<form method="post" action="sched.scr.php?NewSched=Yes">
	<input type="hidden" id="class_section_no" name="class_section_no" required="required" class=" form-control" value="<?php echo $dataSchedule['section_no'];?>">
	<input type="hidden" id="class_sy" name="class_sy" required="required" class=" form-control" value="<?php echo $_GET['enrol_sy'];?>">
	
	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Section <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="class_section_name" name="class_section_name" required="required" class=" form-control" value="<?php echo $dataSchedule['section_name'];?>" readonly >
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
					
						<label class="control-label required" for="stud_lrn">Course Code <span title="Required" class="text-danger">*</span></label>
						<select type="text" id="class_pros_no" name="class_pros_no" required="required" class=" form-control">
						<?php						
						$checkSem = dbquery("SELECT * FROM settings WHERE settings_sy='".$_GET['enrol_sy']."'");
						$dataSem = dbarray($checkSem);
						if ($dataSchedule['section_level']<11 && substr($_GET['classProfile'],0,2)=="Z_"){
							$resultPros = dbquery("SELECT * FROM prospectus WHERE (pros_title like 'TLE%' and pros_level='".$dataSchedule['section_level']."' and pros_curr='".$dataSem['settings_pros']."' and pros_part='1' AND pros_no NOT IN (SELECT class_pros_no FROM class WHERE class_section_no='".$dataSchedule['section_no']."' AND class_sy='".$_GET['enrol_sy']."')) ORDER BY pros_sort ASC");
						
						} 
						else if ($dataSchedule['section_level']>10 && substr($_GET['classProfile'],0,2)=="Z_"){
							$resultPros = dbquery("SELECT * FROM prospectus WHERE (pros_level>'10' and pros_curr='".$dataSem['settings_pros']."' and pros_part='1' AND pros_no NOT IN (SELECT class_pros_no FROM class WHERE class_section_no='".$dataSchedule['section_no']."' AND class_sy='".$_GET['enrol_sy']."')) ORDER BY pros_sort ASC");
						
						}	
						else if ($dataSchedule['section_level']>10 && $_GET['type']=="irr"){
							$resultPros = dbquery("SELECT * FROM prospectus WHERE (pros_level>10 and pros_curr='".$dataSem['settings_pros']."' and pros_part='1' AND pros_no NOT IN (SELECT class_pros_no FROM class WHERE class_section_no='".$dataSchedule['section_no']."' AND class_sy='".$_GET['enrol_sy']."')) ORDER BY pros_sort ASC");
						
						}						
						else if($dataSchedule['section_level']>10){
							$exclude_sem = ($current_sem==1?2:1);
							$resultPros = dbquery("SELECT * FROM prospectus WHERE (pros_sem!='".$exclude_sem."' AND pros_level='".$dataSchedule['section_level']."' AND pros_curr='".$dataSem['settings_pros']."' and pros_part='1' AND pros_no NOT IN (SELECT class_pros_no FROM class WHERE class_section_no='".$dataSchedule['section_no']."' AND class_sy='".$_GET['enrol_sy']."')) ORDER BY pros_sort ASC");
							$class_sem = $dataSem['settings_sem'];
						} 
						else{
							$resultPros = dbquery("SELECT * FROM prospectus WHERE (pros_level='".$dataSchedule['section_level']."' AND pros_curr='".$dataSem['settings_pros']."' and pros_part='1' AND pros_no NOT IN (SELECT class_pros_no FROM class WHERE class_section_no='".$dataSchedule['section_no']."' AND class_sy='".$_GET['enrol_sy']."')) ORDER BY pros_sort ASC");
							$class_sem = 12;
						}
						
						while($dataPros = dbarray($resultPros)){
						
						// if($dataPros['pros_track']=="JHS GENERAL" || $dataPros['pros_track']=="SHS APPLIED" || $dataPros['pros_track']=="SHS GENERAL" || $dataPros['pros_track']==$dataSchedule['section_track']){
						
						
						?>
							<option value="<?php echo $dataPros['pros_no'];?>"><?php echo $dataPros['pros_title'];?> - <?php echo $dataPros['pros_desc'];?></option>
						<?php  }?>
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<?php
						$checkTimeslots = dbquery("SELECT * FROM dropdowns WHERE field_category='TIMELSLOTS' ORDER BY field_name ASC");
						$extendSize = dbquery("ALTER TABLE class CHANGE class_timeslots class_timeslots VARCHAR(100)");
						?>
						<label class="control-label required" for="stud_lrn">Timeslots (Military Time)<span title="Required" class="text-danger">*</span></label>
						<br><small><i>(Separated by " / " for multiple timeslots)</i></small>
						
						
						<select id="class_timeslots" name="class_timeslots" required="required" class=" form-control">
								<option value="">---select---</option>
								
							<?php
							while ($dataTimeslots = dbarray($checkTimeslots)){
							?>
								<option value="<?php echo $dataTimeslots['field_name'];?>"><?php echo $dataTimeslots['field_name'];?></option>
							<?php
							}
							?>
						</select>
						
						<!---
						<input type="text" id="class_timeslots" name="class_timeslots" required="required" class=" form-control" value="07:45-08:45"> 
						-->
					</div> 
				</div>
				
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Days <span title="Required" class="text-danger">*</span></label>
						<br><small><i>(Separated by " / " for multiple day slots)</i></small>
						<input type="text" id="class_days" name="class_days" required="required" class=" form-control" value="MTWThF">
					</div>
					
				</div>
				
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Classroom <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="class_room" name="class_room" required="required" class=" form-control" value="<?php echo $dataSchedule['section_name'];?>" >
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Semester to Offer <span title="Required" class="text-danger">*</span></label>
						<select type="text" id="class_sem" name="class_sem" required="required" class=" form-control" >
						<?php
						if($dataSchedule['section_level']>10){
						?>
							<option value="1" <?php echo ($class_sem==1?"selected":"");?>>First Semester</option>
							<option value="2" <?php echo ($class_sem==2?"selected":"");?>>Second Semester</option>
						<?php
						}
						else {
						?>
							<option value="12" <?php echo ($class_sem==12?"selected":"");?>>Full Year</option>
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
							<option value="1">TBA</option>
						<?php
						$resulTeacherList = dbquery("SELECT * FROM users WHERE (user_role!='3' and user_status='1' and user_no>=3) ORDER BY user_fullname ASC");
						while($dataTeacherList = dbarray($resulTeacherList)){
						?>
							<option value="<?php echo $dataTeacherList['user_no'];?>"><?php echo strtoupper($dataTeacherList['user_fullname']);?></option>
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