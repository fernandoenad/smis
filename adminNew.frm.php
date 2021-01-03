<?php
require ("maincore.php");
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Add User</h4>
    </div>
	<form method="post" action="admin.scr.php?NewUser=Yes">
	<input type="hidden" id="section_no" name="section_no" required="required" class=" form-control" value="">
	<div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Select Teacher <span title="Required" class="text-danger">*</span></label>
						<?php
							$selectTeacher = dbquery("SELECT * FROM teacher WHERE teach_no NOT IN (SELECT user_no FROM users) ORDER BY  teach_lname ASC, teach_fname ASC");
						?>
						<select id="user_name" name="user_fullname" required="required" class=" form-control" value="" >
							<option value="">---select---</value>
							<?php
								while($rowTeacher = dbarray($selectTeacher)){
									$fullname = $rowTeacher['teach_fname']." ".($rowTeacher['teach_mname']=="-"?"":substr($rowTeacher['teach_mname'],0,1).".")." ".$rowTeacher['teach_lname'].($rowTeacher['teach_xname']!=""?", ".$rowTeacher['teach_xname']:"");
							?>	
								<option value="<?php echo $rowTeacher['teach_no'];?>"><?php echo strtoupper($fullname);?></value>
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
						<label class="control-label required" for="stud_lrn">System role <span title="Required" class="text-danger">*</span></label>
						<select id="user_role" name="user_role" required="required" class=" form-control">
							<option value="" >---select---</option>
							<option value="1" >System Administrator</option>
							<option value="2" >Faculty</option>
							<option value="3" >Encoder</option>
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