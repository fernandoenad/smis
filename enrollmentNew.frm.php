<?php
session_start();
require ('maincore.php');
$resultStudent = dbquery("SELECT * FROM student WHERE stud_no='".$_GET['showProfile']."'");
$dataStudent = dbarray($resultStudent);

$resultEnrollment = dbquery("SELECT * FROM studenroll WHERE (enrol_sy!='".$current_sy."' AND enrol_stud_no='".$_GET['showProfile']."') ORDER BY enrol_sy DESC");
$dataEnrollment = dbarray($resultEnrollment);
if($dataEnrollment['enrol_status1']=="PROMOTED" && $dataEnrollment['enrol_status2']=="PROMOTED"){
	$level = $dataEnrollment['enrol_level'] + 1;
	$enrol_schoolyears = $dataEnrollment['enrol_schoolyears'] + 1;
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "REGULAR";
	$ti_status  = 0;
	$remarks = "OK";
}
elseif($dataEnrollment['enrol_status1']=="PROMOTED" && $dataEnrollment['enrol_status2']=="IRREGULAR"){
	$level = $dataEnrollment['enrol_level'] + 1;
	$enrol_schoolyears = $dataEnrollment['enrol_schoolyears'] + 1;
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "IRREGULAR";
	$ti_status  = 0;
	$remarks = $dataEnrollment['enrol_remarks'];
}
elseif($dataEnrollment['enrol_status1']=="PROMOTED" && $dataEnrollment['enrol_status2']=="RETAINED"){
	$level = $dataEnrollment['enrol_level'];
	$enrol_schoolyears = $dataEnrollment['enrol_schoolyears'] + 1;
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "REGULAR";
	$ti_status  = 0;
	$remarks = $dataEnrollment['enrol_remarks'];
}
elseif($dataEnrollment['enrol_status1']=="TRANSFEREE" && $dataEnrollment['enrol_status2']=="PROMOTED"){
	$level = $dataEnrollment['enrol_level'] + 1;
	$enrol_schoolyears = $dataEnrollment['enrol_schoolyears'] + 1;
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "REGULAR";
	$ti_status  = 0;
	$remarks = "OK";
}
elseif($dataEnrollment['enrol_status1']=="TRANSFEREE" && $dataEnrollment['enrol_status2']=="IRREGULAR"){
	$level = $dataEnrollment['enrol_level'] + 1;
	$enrol_schoolyears = $dataEnrollment['enrol_schoolyears'] + 1;
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "IRREGULAR";
	$ti_status  = 0;
	$remarks = $dataEnrollment['enrol_remarks'];
}
elseif($dataEnrollment['enrol_status1']=="TRANSFEREE" && $dataEnrollment['enrol_status2']=="RETAINED"){
	$level = $dataEnrollment['enrol_level'];
	$enrol_schoolyears = $dataEnrollment['enrol_schoolyears'] + 1;
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "REGULAR";
	$ti_status  = 0;
	$remarks = $dataEnrollment['enrol_remarks'];
}
elseif($dataEnrollment['enrol_status1']=="TRANSFERRED IN" && $dataEnrollment['enrol_status2']=="TRANSFERRED IN"){
	$level = $dataEnrollment['enrol_level'];
	$enrol_schoolyears = $dataEnrollment['enrol_schoolyears'];
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "REGULAR";
	$ti_status  = 1;
	$remarks = $dataEnrollment['enrol_remarks'];
}
elseif($dataEnrollment['enrol_status1']=="INACTIVE" && $dataEnrollment['enrol_status2']=="DROPPED OUT"){
	$level = $dataEnrollment['enrol_level'];
	$enrol_schoolyears = $dataEnrollment['enrol_schoolyears'] + 1;
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "REGULAR";
	$ti_status  = 0;
	$remarks = $dataEnrollment['enrol_remarks'];
}

?>
		<script type="text/javascript">
			   $(document).ready(function(){
				   $("#enrol_level").change(function(){
						 var enrol_level=$("#enrol_level").val();
						 $.ajax({
							type:"post",
							url:"getsection.php",
							data:"enrol_level="+enrol_level,
							success:function(data){
								  $("#enrol_section").html(data);
							}
						 });
				   });
			   });
		  </script>	
		  
		  <script type="text/javascript">
			   $(document).ready(function(){
				   $("#enrol_track").change(function(){
						 var enrol_track=$("#enrol_track").val();
						 $.ajax({
							type:"post",
							url:"getstrand.php",
							data:"enrol_track="+enrol_track,
							success:function(data){
								  $("#enrol_strand").html(data);
							}
						 });
				   });
			   });
		  </script>	
		  <script type="text/javascript">
			   $(document).ready(function(){
				   $("#enrol_strand").change(function(){
						 var enrol_strand=$("#enrol_strand").val();
						 $.ajax({
							type:"post",
							url:"getcombo.php",
							data:"enrol_strand="+enrol_strand,
							success:function(data){
								  $("#enrol_combo").html(data);
							}
						 });
				   });
			   });
		  </script>	
<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()">&times;</button>
		<h4 class="modal-title">Confirm Enrollment Details</h4>
    </div>
	<form name="form1" method="post" action="./enrollment.scr.php?Enroll=Yes">
	<input type="hidden" id="enrol_stud_no" name="enrol_stud_no" required="required" class=" form-control" value="<?php echo $_GET['showProfile']; ?>">
	<input type="hidden" id="ti_status" name="ti_status" required="required" class=" form-control" value="<?php echo $ti_status; ?>">
    <div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						Are you sure you want to enroll <strong><?php echo $dataStudent['stud_lrn']." ".strtoupper($dataStudent['stud_lname']).", ".strtoupper($dataStudent['stud_fname'])." ".strtoupper($dataStudent['stud_mname']); ?></strong> for School Year <strong><?php echo $current_sy; ?> - <?php echo $current_sy+1; ?></strong>?
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Level <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_level" name="enrol_level" required="required" class=" form-control">
							<?php
							for ($i=$current_school_minlevel ; $i<=$current_school_maxlevel ; $i++) {
							?>
							<option value="<?php echo $i; ?>" <?php echo ($i==$level?"selected":($_SESSION["user_role"]=="1"?"":"disabled")); ?>><?php echo $i; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Section <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_section" name="enrol_section" required="required" class=" form-control">
							<option value="">---select---</option>
							<?php
							$resultSectionProp = dbquery("SELECT * FROM proposedsection WHERE (prop_lrn='".$dataStudent['stud_no']."' AND prop_sy='".$current_sy."')");
							$dataSectionProp = dbarray($resultSectionProp);
							$sectionName = (isset($dataSectionProp['prop_section']) ? $dataSectionProp['prop_section']: "");
							
							$resultSectionList = dbquery("SELECT * FROM section WHERE (section_sy='".$current_sy."' AND section_level='".$level."') ORDER BY section_name ASC");
							while($dataSectionList = dbarray($resultSectionList)){
								$resultClass = dbquery("SELECT * FROM studenroll WHERE (enrol_section='".$dataSectionList['section_name']."' AND enrol_sy='".$current_sy."')");
								$dataClass = dbarray($resultClass);
								$rowClass = dbrows($resultClass);
								
							?>
								<option value="<?php echo $dataSectionList['section_name']; ?>" <?php echo ($dataSectionList['section_name']==$sectionName ?"selected":"")?> <?php echo (substr($dataSectionList['section_name'],0,2)=="Z_"?"disabled":"");?> <?php echo ($rowClass>=$dataSectionList['section_cap']?"disabled":"") ;?>><?php echo $dataSectionList['section_name']." (".$rowClass."/".$dataSectionList['section_cap'].")"; ?></option>
							<?php 
								
							}?>
						</select>
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Years in School <span title="Required" class="text-danger">*</span></label>
						<input type="number" step="0.01" id="enrol_schoolyears" readonly name="enrol_schoolyears" required="required" class=" form-control" value="<?php echo $enrol_schoolyears;?>" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Height <small>(cm.)</small><span title="Required" class="text-danger">*</span></label>
						<input type="number" step="0.01" min="10" id="enrol_height" name="enrol_height" required="required" class=" form-control" value="" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Weight <small>(Kg.)</small><span title="Required" class="text-danger">*</span></label>
						<input type="number" step="0.01" min="10"  id="enrol_weight" name="enrol_weight" required="required" class=" form-control" value="" style="text-transform:uppercase;">
					</div>
				</div>				
			</div>
			<?php
			if($level>10){
			?>
			<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Track <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_track" name="enrol_track" required class=" form-control">
							<option value="">--select---</option>
							<?php
							$checkTracks = dbquery("select * from dropdowns where field_category='TRACKS'");
							while($dataTracks=dbarray($checkTracks)){
							?>
								<option value="<?php echo $dataTracks['field_name'];?>" <?php echo ($dataEnrollment['enrol_track']==$dataTracks['field_name']?"selected":""); ?>><?php echo $dataTracks['field_name'];?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Strand <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_strand" name="enrol_strand" required class=" form-control">
							<option value="">--select---</option>
							<?php
							$checkStrands = dbquery("select * from dropdowns where field_category like 'STRAND%'");
							while($dataStrands = dbarray($checkStrands)){
							?>
							<option value="<?php echo $dataStrands['field_name'];?>" <?php echo ($dataEnrollment['enrol_strand']==$dataStrands['field_name']?"selected":""); ?>><?php echo $dataStrands['field_name'];?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="col-lg-7 col-md-7">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Combo <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_combo" name="enrol_combo" required class=" form-control">
							<option value="">--select---</option>
							<?php
							$checkCombos = dbquery("select * from dropdowns where field_category like 'COMBO%'");
							while($dataCombos = dbarray($checkCombos)){
							?>
							<option value="<?php echo $dataCombos['field_name'];?>" <?php echo (strtoupper($dataEnrollment['enrol_combo'])==strtoupper($dataCombos['field_name'])?"selected":""); ?>><?php echo $dataCombos['field_name'];?></option>
							<?php
							}
							?>
						</select>					
					</div>
				</div>
			</div>
			<?php
			}
			?>
			<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Enrollment Status 1 <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_status1" name="enrol_status1"  required="required" class=" form-control">
							<option value="" >---select---</option>
							<option value="ENROLLED" <?php echo ("ENROLLED"==$status1?"selected":"");?>>ENROLLED</option>
						</select>	
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Enrollment Status 2 <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_status2" name="enrol_status2"  required="required" class=" form-control">
							<option value="" >---select---</option>
							<option value="REGULAR" <?php echo ("REGULAR"==$status2?"selected":"");?>>REGULAR</option>
							<?php
							if($level>10){
							?>
							<option value="IRREGULAR" <?php echo ("IRREGULAR"==$status2?"selected":"");?>>IRREGULAR</option>
							<?php
							}
							?>
							<!-- <option value="TRANSFERRED IN" <?php echo ("TRANSFERRED IN"==$status2?"selected":"");?>>TRANSFERRED IN</option> -->
						</select>	
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Remarks </label>
						<input type="text" id="enrol_remarks" name="enrol_remarks" maxlength="50" class=" form-control" value="<?php echo $remarks;?>" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Form 138 <span title="Required" class="text-danger">*</span> </label>
						<input type="checkbox" id="enrol_remarks1" name="enrol_remarks1" maxlength="50" required="required" class=" form-control" value="OK" style="text-transform:uppercase;">
					</div>
				</div>
			</div>
     </div>
	 <?php
	 if(($status2=="IRREGULAR" || $status2=="RETAINED" ) && $_SESSION["user_role"]!="1"){
	 ?>
	 <div class="alert alert-danger" role="alert"><center><b>Ineligible for enrollment.</b> Refer the student to the School Registrar. </center></div>
	 <?php
	 }
	 ?>
	<div class="modal-footer">
		
		<button type="submit" class="btn btn-primary" <?php echo ($status2=="IRREGULAR" && $_SESSION["user_role"]!="1"?"disabled":"");?> onClick="return confirm('Are you sure you want to save changes?')">Enroll</button>
		<button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
	</div>
	</form>
</div>
