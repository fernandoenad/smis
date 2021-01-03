<?php
require ("maincore.php");
$teacherDetails = dbquery("select * from missinglogs inner join teacher on ml_userid=teach_bio_no where ml_no='".$_GET['ml_no']."'");
$dataTeacherDetails = dbarray($teacherDetails);
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Approve/Disapprove Missing Log Application</h4>
    </div>
	<form method="post" action="missinglogs.scr.php?approve=Yes">
	<input type="hidden" id="ml_no" name="ml_no" required="required" class=" form-control" value="<?php echo $dataTeacherDetails['ml_no'];?>">
	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Teacher <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="CHECKTYPE" name="CHECKTYPE" readonly required="required" class=" form-control" value="<?php echo $dataTeacherDetails['teach_lname'].", ".$dataTeacherDetails['teach_fname'];?>" style="text-transform:uppercase;">
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Date Applied <span title="Required" class="text-danger">*</span></label>
						<input type="date" id="ml_checkdate" name="ml_checkdate" readonly required="required" class=" form-control" value="<?php echo $dataTeacherDetails['ml_checkdate'];?>" >
					</div>
				</div>
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">State <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="ml_checktype" name="ml_checktype" readonly required="required" class=" form-control" value="<?php echo ($dataTeacherDetails['ml_checktype']=="I"?"In":"Out");?>" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Actual Timestamp <span title="Required" class="text-danger">*</span></label>
						<input type="time" id="timeapp" name="timeapp"  required="required" class=" form-control" value="<?php echo $dataTeacherDetails['ml_checktime'];?>" style="text-transform:uppercase;">
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Reason <span title="Required" class="text-danger">*</span></label>
						<textarea id="ml_reason" name="ml_reason" required="required"  class=" form-control" value="" style="text-transform:uppercase;"><?php echo $dataTeacherDetails['ml_reason'];?> / </textarea>
					</div>
				</div>
			</div>
		</div>
     </div>
	<div class="modal-footer">
		<button type="submit" name="action" value="disapprove" class="btn btn-danger" onClick="return confirm('Are you sure you want to save changes?')">Disapprove</button>
		<button type="submit" name="action" value="approve" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')">Approve</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	</form>
</div>