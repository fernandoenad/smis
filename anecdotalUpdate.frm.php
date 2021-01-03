<?php
require ("maincore.php");
$resultAnec = dbquery("SELECT * FROM anecdotal WHERE anec_no='".$_GET['anec_no']."'");
$dataAnec = dbarray($resultAnec);
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Modify Case</h4>
    </div>
	<form method="post" action="anecdotal.scr.php?UpdateAnec=Yes">
	<input type="hidden" id="anec_no" name="anec_no" required="required" class=" form-control" value="<?php echo $_GET['anec_no'];?>">
	<div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Date <span title="Required" class="text-danger">*</span></label>
						<input type="date" id="anec_desc" name="anec_date" readonly required="required" class=" form-control" value="<?php echo $dataAnec['anec_date'];?>" style="text-transform:uppercase;">
					</div>
				</div>
			</div>		
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Description <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="anec_desc" name="anec_desc" readonly required="required" class=" form-control" value="<?php echo $dataAnec['anec_desc'];?>" style="text-transform:uppercase;">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Details <span title="Required" class="text-danger">*</span></label>
						<textarea type="text" id="anec_details" name="anec_details"  required="required" class=" form-control" value="" style="text-transform:uppercase;"><?php echo $dataAnec['anec_details'];?></textarea>
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