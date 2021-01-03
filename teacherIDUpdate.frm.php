<?php
require ("maincore.php");
$resultAnec = dbquery("SELECT * FROM teacherids WHERE teacherids_no='".$_GET['anec_no']."'");
$dataAnec = dbarray($resultAnec);
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Modify Identification</h4>
    </div>
	<form method="post" action="teacherID.scr.php?UpdateAnec=Yes">
	<input type="hidden" id="anec_no" name="anec_no" required="required" class=" form-control" value="<?php echo $_GET['anec_no'];?>">
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
								<option value="<?php echo $rowIDType['field_name'];?>" <?php echo ($rowIDType['field_name']==$dataAnec['teacherids_id']?"selected":"");?>><?php echo $rowIDType['field_name'];?></option>
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
						<input type="number" id="anec_details" name="anec_details" required="required" class=" form-control" value="<?php echo $dataAnec['teacherids_details'];?>" style="text-transform:uppercase;">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Date Issued <span title="Required" class="text-danger">*</span></label>
						<input type="date" id="anec_date" name="anec_date" required="required" class=" form-control" value="<?php echo $dataAnec['teacherids_date_issued'];?>" >
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Place Issued <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="anec_details" name="anec_place" required="required" class=" form-control" value="<?php echo $dataAnec['teacherids_place_issued'];?>" style="text-transform:uppercase;">
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