<?php
require('maincore.php');
if(isset($_GET['NewCurriculum']) && $_GET['NewCurriculum']=="Yes"){
	$insertNewCurr = dbquery("INSERT INTO dropdowns (field_no, field_category, field_name) VALUES ('', 'CURRICULUM', '".$_POST['pros_curr']."')");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">New Curriculum</h4>
    </div>
	<form name="form1" method="post" action="./newCurriculum.frm.php?NewCurriculum=Yes">
    <div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						Select the Implementation Year of the Curriculum
					</div>
				</div>
			</div>
			<div class="row"></div>
			<div class="row"></div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Curriculum Year Implemented: <span title="Required" class="text-danger">*</span></label>
						<select name="pros_curr" class="form-control" required>
							<option value="">---select---</option>
							<?php 
							for($i=1994;$i<=$current_sy;$i++){
							?>
								<option value="<?php echo $i;?>"><?php echo $i;?></option>
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
		<button type="submit" id="submit" name="submit" class="btn btn-primary" 
			onClick="return confirm('Are you sure you want to save the new curriculum?')">Save</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	</form>
</div>		