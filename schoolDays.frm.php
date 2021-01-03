<?php
session_start();
require ('maincore.php');
if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$updateSettings = dbquery("UPDATE school_days SET sch_firstday='".$_POST['sch_firstday']."', sch_m1='".$_POST['sch_m1']."', sch_m2='".$_POST['sch_m2']."', sch_m3='".$_POST['sch_m3']."', sch_m4='".$_POST['sch_m4']."', sch_m5='".$_POST['sch_m5']."', sch_m6='".$_POST['sch_m6']."', sch_m7='".$_POST['sch_m7']."', sch_m8='".$_POST['sch_m8']."', sch_m9='".$_POST['sch_m9']."', sch_m10='".$_POST['sch_m10']."', sch_m11='".$_POST['sch_m11']."', sch_m12='".$_POST['sch_m12']."' WHERE sch_no='".$_POST['sch_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

$checkSchoolDays = dbquery("SELECT * FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$_GET['stud_no']."')");
$dateSchoolDays = dbrows($checkSchoolDays);
if($dateSchoolDays<1){
	$insertSchoolDays = dbquery("INSERT INTO school_days (sch_no, sch_sy, sch_stud_no) VALUES('','".$_GET['enrol_sy']."', '".$_GET['stud_no']."')");
}
$checkSchoolDays = dbquery("SELECT * FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$_GET['stud_no']."') ORDER BY sch_sy DESC, sch_no asc limit 1");
$dataSchoolDays = dbarray($checkSchoolDays);
?>
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()">&times;</button>
		<?php
		$checkName = dbquery("SELECT * FROM student WHERE stud_no='".$dataSchoolDays['sch_stud_no']."'");
		$dataName = dbarray($checkName);
		$countName = dbrows($checkName );
		
		?>
        <h4 class="modal-title">School Days Panel for <?php echo ($countName==0?$dataSchoolDays['sch_stud_no']:$dataName['stud_lname'].", ".$dataName['stud_fname']);?></h4>
      </div>
	  <form name="form1" method="post" action="schoolDays.frm.php?Save=Yes">
	  <input type="hidden" id="user_name" name="sch_no" maxlength="15" required="required" class="form-control" value="<?php echo $dataSchoolDays['sch_no'];?>" / autofocus>
      <div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">First Day <span title="Required" class="text-danger">*</span></label>
						<input type="date" id="" name="sch_firstday" maxlength="50"  class="form-control" value="<?php echo $dataSchoolDays['sch_firstday'];?>" / autofocus >
					</div>
				</div>				
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">June School Days <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="" name="sch_m1" step="0.01" maxlength="50" required="required" class="form-control" value="<?php echo $dataSchoolDays['sch_m1'];?>" / autofocus >
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">July School Days <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="" name="sch_m2" step="0.01" maxlength="50" required="required" class="form-control" value="<?php echo $dataSchoolDays['sch_m2'];?>" / autofocus >
					</div>
				</div>		
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">August School Days <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="" name="sch_m3" step="0.01" maxlength="50" required="required" class="form-control" value="<?php echo $dataSchoolDays['sch_m3'];?>" / autofocus >
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">September School Days <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="" name="sch_m4"  step="0.01" maxlength="50" required="required" class="form-control" value="<?php echo $dataSchoolDays['sch_m4'];?>" / autofocus >
					</div>
				</div>		
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">October School Days <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="" name="sch_m5" step="0.01" maxlength="50" required="required" class="form-control" value="<?php echo $dataSchoolDays['sch_m5'];?>" / autofocus >
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">November School Days <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="" name="sch_m6" step="0.01" maxlength="50" required="required" class="form-control" value="<?php echo $dataSchoolDays['sch_m6'];?>" / autofocus >
					</div>
				</div>		
			</div>			
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">December School Days <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="" name="sch_m7" step="0.01" maxlength="50" required="required" class="form-control" value="<?php echo $dataSchoolDays['sch_m7'];?>" / autofocus >
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">January School Days <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="" name="sch_m8" step="0.01" maxlength="50" required="required" class="form-control" value="<?php echo $dataSchoolDays['sch_m8'];?>" / autofocus >
					</div>
				</div>		
			</div>	
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">February School Days <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="" name="sch_m9" step="0.01" maxlength="50" required="required" class="form-control" value="<?php echo $dataSchoolDays['sch_m9'];?>" / autofocus >
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">March School Days <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="" name="sch_m10" step="0.01" maxlength="50" required="required" class="form-control" value="<?php echo $dataSchoolDays['sch_m10'];?>" / autofocus >
					</div>
				</div>		
			</div>	
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">April School Days <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="" name="sch_m11" step="0.01" maxlength="50" required="required" class="form-control" value="<?php echo $dataSchoolDays['sch_m11'];?>" / autofocus >
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">May School Days <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="" name="sch_m12" step="0.01" maxlength="50" required="required" class="form-control" value="<?php echo $dataSchoolDays['sch_m12'];?>" / autofocus >
					</div>
				</div>		
			</div>				
		</div>
      <div class="modal-footer">
		<button type="submit" id="submit" name="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')" >Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
      </div>
	  </form>
	</div>
