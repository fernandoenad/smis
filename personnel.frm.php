<?php
require ("maincore.php");
$resultAnec = dbquery("SELECT * FROM teacherappointments WHERE teacherappointments_no='".$_GET['anec_no']."'");
$dataAnec = dbarray($resultAnec);
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Modify Appointment</h4>
    </div>
	<form method="post" action="teacherAppointment.scr.php?UpdateAnec=Yes">
	<input type="hidden" id="anec_no" name="anec_no" required="required" class=" form-control" value="<?php echo $_GET['anec_no'];?>">
	<div class="modal-body">
		<div class="card-body">	
		<?php
		$checkPositions = dbquery("SELECT * FROM dropdowns inner join teacherappointments on field_name=teacherappointments_position where (field_category='POSITION') group by teacherappointments_teach_no order by teacherappointments_date desc");
		while($dataPositions = dbarray($checkPositions)){
			if(substr($dataPositions['field_name'],0,2)=="1_"){
		?>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Item Number <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="anec_details" name="anec_item" required="required" class=" form-control" value="<?php echo $dataAnec['teacherappointments_item_no'];?>" style="text-transform:uppercase;">
					</div>
				</div>
			</div>	
		<?php
			}
		}
		?>
		</div>
     </div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')">Update</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	</form>
</div>