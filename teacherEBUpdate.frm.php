<?php
require ("maincore.php");
if(isset($_GET['DeleteAnec']) && $_GET['DeleteAnec']=="Yes"){
	$result1 = dbquery("DELETE FROM teacher_ebackground WHERE eback_no='".$_GET['anec_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['UpdateAnec']) && $_GET['UpdateAnec']=="Yes"){
	$result1 = dbquery("UPDATE teacher_ebackground SET eback_level='".$_POST['anec_desc']."', eback_degree='".$_POST['anec_details']."', eback_major='".$_POST['anec_date']."', eback_minor='".$_POST['anec_place']."', eback_units='".$_POST['anec_units']."' WHERE eback_no='".$_POST['anec_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

$checkEB = dbquery("SELECT * FROM teacher_ebackground WHERE eback_no='".$_GET['anec_no']."'");
$dataEB = dbarray($checkEB);
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Update Educational Background</h4>
    </div>
	<form method="post" action="teacherEBUpdate.frm.php?UpdateAnec=Yes">
	<input type="hidden" id="anec_stud_no" name="anec_stud_no" required="required" class=" form-control" value="<?php echo (isset($_GET['stud_no']) ? $_GET['stud_no'] : "");?>">
	<input type="hidden" id="anec_no" name="anec_no" required="required" class=" form-control" value="<?php echo $_GET['anec_no'];?>">
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
							<option value="">---select---</option>
							<?php
							while ($rowIDType = dbarray($selectIDType)){
							?>
								<option value="<?php echo $rowIDType['field_name'];?>" <?php echo ($dataEB['eback_level']==$rowIDType['field_name']?"selected":"");?>><?php echo $rowIDType['field_name'];?></option>
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
						<input type="text" id="anec_details" name="anec_details" required="required" class=" form-control" value="<?php echo $dataEB['eback_degree'];?>" style="text-transform:uppercase;">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Major <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="anec_details" name="anec_date" required="required" class=" form-control" value="<?php echo $dataEB['eback_major'];?>" style="text-transform:uppercase;">
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Minor <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="anec_details" name="anec_place" required="required" class=" form-control" value="<?php echo $dataEB['eback_minor'];?>" style="text-transform:uppercase;">
					</div>
				</div>
			</div>		
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Units <span title="Required" class="text-danger">*</span></label>
						<select name="anec_units" class=" form-control" required>
							<option value="">---select---</option>
							<option value="100" <?php echo (100==$dataEB['eback_units']?"selected":"");?>>GRADUATED</option>
							<?php
							for ($i=3;$i<100;$i++){
							?>
							<option value="<?php echo $i;?>" <?php echo ($i==$dataEB['eback_units']?"selected":"");?>><?php echo $i;?> Units</option>
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