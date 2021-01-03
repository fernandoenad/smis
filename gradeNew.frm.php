<?php
require ("maincore.php");
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">New Schedule</h4>
    </div>
	<form method="post" action="grade.scr.php?NewGrade=Yes">
	<input type="hidden" id="stud_no" name="stud_no" required="required" class=" form-control" value="<?php echo $_GET['stud_no'];?>">
	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Course Code <span title="Required" class="text-danger">*</span></label>
						<select type="text" id="class_no" name="class_no" required="required" class=" form-control">	
							<option value="">---select---</option>
						<?php
						$resultPros = dbquery("SELECT * FROM prospectus INNER JOIN class on prospectus.pros_no=class.class_pros_no WHERE(class.class_sy='".$current_sy."') ORDER BY prospectus.pros_level ASC, prospectus.pros_title ASC");
						while($dataPros = dbarray($resultPros)){
							$resultSectionName = dbquery("SELECT * FROM section WHERE section_no='".$dataPros['class_section_no']."'");
							$dataSectionName = dbarray($resultSectionName);
							$resultTeacherName = dbquery("SELECT * FROM users WHERE user_no='".$dataPros['class_user_name']."'");
							$dataTeacherName = dbarray($resultTeacherName);
						?>
							<option value="<?php echo $dataPros['class_no'];?>"><?php echo $dataPros['pros_title'];?> (<?php echo $dataSectionName['section_name'];?> - <?php echo $dataTeacherName['user_fullname'];?>)</option>
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