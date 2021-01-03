<?php
require ("maincore.php");
if(isset($_GET['NewAnec']) && $_GET['NewAnec']=="Yes"){
	$result1 = dbquery("INSERT INTO teacher_ebackground (eback_no, eback_teach_no, eback_level, eback_degree, eback_major, eback_minor, eback_units) VALUES ('','".$_POST['anec_stud_no']."', '".$_POST['anec_desc']."', '".$_POST['anec_details']."', '".$_POST['anec_date']."', '".$_POST['anec_place']."', '".$_POST['anec_units']."')");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">New Educational Background</h4>
    </div>
	<form method="post" action="teacherEBNew.frm.php?NewAnec=Yes">
	<input type="hidden" id="anec_stud_no" name="anec_stud_no" required="required" class=" form-control" value="<?php echo $_GET['stud_no'];?>">
	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Level <span title="Required" class="text-danger">*</span></label>
						<?php
							$selectIDType = dbquery("SELECT * FROM  dropdowns WHERE field_category='EDUCLEVEL' ORDER BY field_no ASC");							
						?>
						<select id="anec_desc" name="anec_desc" required="required" class=" form-control">
							<?php
							while ($rowIDType = dbarray($selectIDType)){
							?>
								<option value="<?php echo $rowIDType['field_name'];?>"><?php echo $rowIDType['field_name'];?></option>
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
						<label class="control-label required" for="stud_lrn">Degree <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="anec_details" name="anec_details" required="required" class=" form-control" value="" style="text-transform:uppercase;">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Major <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="anec_details" name="anec_date" required="required" class=" form-control" value="" style="text-transform:uppercase;">
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Minor <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="anec_details" name="anec_place" required="required" class=" form-control" value="" style="text-transform:uppercase;">
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Units <span title="Required" class="text-danger">*</span></label>
						<select name="anec_units" class=" form-control" required>
							<option value="">---select---</option>
							<option value=100">GRADUATED</option>
							<?php
							for ($i=3;$i<100;$i++){
							?>
							<option value="<?php echo $i;?>"><?php echo $i;?> Units</option>
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