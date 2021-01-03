<?php
require ("maincore.php");
$teacherDetails = dbquery("select * from teacher where teach_no='".$_GET['teach_no']."'");
$dataTeacherDetails = dbarray($teacherDetails);
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">New Missing Log Application</h4>
    </div>
	<form method="post" action="missinglogs.scr.php?NewApp=Yes">
	<input type="hidden" id="USERID" name="USERID" required="required" class=" form-control" value="<?php echo $dataTeacherDetails['teach_bio_no'];?>">
	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Date Applied <span title="Required" class="text-danger">*</span></label>
						<input type="date" id="dateapp" name="dateapp" required="required" class=" form-control" value="" >
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">State <span title="Required" class="text-danger">*</span></label>
						<select name="CHECKTYPE" required="required" class=" form-control">
							<option value="">---select---</option>
							<option value="I">In</option>
							<option value="O">Out</option>
						</select>
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Actual Timestamp <span title="Required" class="text-danger">*</span></label>
						<input type="time" id="timeapp" name="timeapp" required="required" class=" form-control" value="" style="text-transform:uppercase;">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Reason <span title="Required" class="text-danger">*</span></label>
						<textarea id="reason" name="reason" required="required" class=" form-control" value="" style="text-transform:uppercase;"></textarea>
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