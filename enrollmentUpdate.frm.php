<?php
session_start();
require ('maincore.php');

$resultEnrollment = dbquery("SELECT * FROM studenroll WHERE enrol_no='".$_GET['enrol_no']."'");
$dataEnrollment = dbarray($resultEnrollment);

$resultStudent = dbquery("SELECT * FROM student WHERE stud_no='".$dataEnrollment['enrol_stud_no']."'");
$dataStudent = dbarray($resultStudent);

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
		<h4 class="modal-title">Modify Enrollment Details</h4>
    </div>
	<form name="form1" method="post" action="./enrollment.scr.php?UpdateEnroll=Yes">
	<input type="hidden" id="enrol_no" name="enrol_no" required="required" class=" form-control" value="<?php echo $_GET['enrol_no']; ?>">
	<input type="hidden" id="enrol_stud_no" name="enrol_stud_no" required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_stud_no']; ?>">
    <div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						Modify enrollment details of <strong><?php echo $dataStudent['stud_lrn']." ".strtoupper($dataStudent['stud_lname']).", ".strtoupper($dataStudent['stud_fname'])." ".strtoupper($dataStudent['stud_mname']); ?></strong> for School Year <strong><?php echo $current_sy; ?> - <?php echo $current_sy+1; ?></strong>?
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
							<option value="<?php echo $i; ?>" <?php echo ($i==$dataEnrollment['enrol_level']?"selected":($_SESSION["user_role"]=="1"?"":"disabled")); ?>><?php echo $i; ?></option>
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

							
							$resultSectionList = dbquery("SELECT * FROM section WHERE (section_sy='".$current_sy."' AND section_level='".$dataEnrollment['enrol_level']."') ORDER BY section_name ASC");
							while($dataSectionList = dbarray($resultSectionList)){
								$resultClass = dbquery("SELECT * FROM studenroll WHERE (enrol_section='".$dataSectionList['section_name']."' AND enrol_sy='".$current_sy."')");
								$dataClass = dbarray($resultClass);
								$rowClass = dbrows($resultClass);
							?>
								<option value="<?php echo $dataSectionList['section_name']; ?>" <?php echo (substr($dataSectionList['section_name'],0,2)=="Z_"?"disabled":"");?> <?php echo ($dataSectionList['section_name']==$dataEnrollment['enrol_section']?"selected":"");?> <?php echo ($rowClass==$dataSectionList['section_cap']+1?"disabled":"") ;?>><?php echo $dataSectionList['section_name']." (".$rowClass."/".$dataSectionList['section_cap'].")"; ?></option>
							<?php 
							}?>
						</select>
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Years in School <span title="Required" class="text-danger">*</span></label>
						<input type="number" step="0.01" id="enrol_schoolyears" name="enrol_schoolyears" required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_schoolyears'];?>" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Height <small>(cm.)</small><span title="Required" class="text-danger">*</span></label>
						<input type="number" step="0.01" min="5" id="enrol_height" name="enrol_height" required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_height'];?>" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Weight <small>(Kg.)</small><span title="Required" class="text-danger">*</span></label>
						<input type="number" step="0.01" min="5" id="enrol_weight" name="enrol_weight" required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_weight'];?>" style="text-transform:uppercase;">
					</div>
				</div>				
			</div>
			<?php
			if($dataEnrollment['enrol_level']>10){
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
						<select id="enrol_status1" name="enrol_status1"  required="required" onChange="updateChange(this);" class=" form-control">
							<option value="" >---select---</option>
							<option value="ENROLLED" <?php echo ("ENROLLED"==$dataEnrollment['enrol_status1']?"selected":"");?>>ENROLLED</option>
							<option value="INACTIVE" <?php echo ("INACTIVE"==$dataEnrollment['enrol_status1']?"selected":"");?>>INACTIVE</option>
						</select>	
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Enrollment Status 2 <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_status2" name="enrol_status2"  required="required" class=" form-control">
							<option value="" >---select---</option>
							<option value="REGULAR" <?php echo ("REGULAR"==$dataEnrollment['enrol_status2']?"selected":"");?>>REGULAR</option>
							<?php
							if($level>10){
							?>
							<option value="IRREGULAR" <?php echo ("IRREGULAR"==$dataEnrollment['enrol_status2']?"selected":"");?>>IRREGULAR</option>
							<?php
							}
							?>
							<option value="TRANSFERRED IN" <?php echo ("TRANSFERRED IN"==$dataEnrollment['enrol_status2']?"selected":"");?>>TRANSFERRED IN</option>
							<option value="TRANSFERRED OUT" <?php echo ("TRANSFERRED OUT"==$dataEnrollment['enrol_status2']?"selected":"");?>>TRANSFERRED OUT</option>
							<option value="DROPPED OUT" <?php echo ("DROPPED OUT"==$dataEnrollment['enrol_status2']?"selected":"");?>>NLS</option>
						</select>	
					</div>
				</div>
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Remarks </label>
						<input type="text" id="enrol_remarks" name="enrol_remarks" maxlength="50"  class=" form-control" value="<?php echo $dataEnrollment['enrol_remarks'];?>" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Form 138 <span title="Required" class="text-danger">*</span> </label>
						<input type="checkbox" checked id="enrol_remarks1" name="enrol_remarks1" maxlength="50" required="required" class=" form-control" value="OK" style="text-transform:uppercase;">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Transfer Out / NLS Effective Date <span title="Required" class="text-danger">*</span> </label>
						<input type="date" id="enrol_graddate" name="enrol_graddate" readonly  maxlength="100" class=" form-control" value="<?php echo $dataEnrollment['enrol_graddate']; ?>" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-8 col-md-8">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Name of School to Transfer / Reason for No Longer in School (NLS) <span title="Required" class="text-danger">*</span> </label>
						<input type="text" id="enrol_gradawards" name="enrol_gradawards" readonly maxlength="200" class=" form-control" value="<?php echo $dataEnrollment['enrol_gradawards']; ?>" style="text-transform:uppercase;">
					</div>
				</div>
			</div>	
	<tr>	
					<?php
					$resultUser = dbquery("select * from users where user_no='".$dataEnrollment['enrol_username']."'");
					$dataUser = dbarray($resultUser);
					?>
					<td colspan="9">
					<i>Admitted on <strong><small><?php echo $mysqldate = date('F d, Y g:ia', strtotime($dataEnrollment['enrol_admitdate']) + 8.0 * 3600);?>
					<?php echo ($dataEnrollment['enrol_level']>10?" (1st sem) ".($dataEnrollment['enrol_admitdate2']==""?" / ".date('F d, Y g:ia', strtotime($dataEnrollment['enrol_admitdate2']) + 8.0 * 3600)." (2nd sem)":""):"");?>
					</strong></small><br>
					Last modified by <strong><small><?php echo $dataUser['user_fullname']; ?></strong></small> on <strong><small><?php echo $mysqldate = date('F d, Y g:ia', strtotime($dataEnrollment['enrol_updatedate']) + 8.0 * 3600);?></strong></small></i></td>
				</tr>		
     </div>
	 <?php
	 if($_SESSION["user_role"]!="1"){
	 ?>
	 <div class="alert alert-danger" role="alert"><center><b>You do not have access to modify enrollment details!</center></div>
	 <?php
	 }
	 ?>
	<div class="modal-footer">
		<a href="enrollment.scr.php?Reset=Yes&enrol_no=<?php echo $dataEnrollment['enrol_no'];?>"  id="reactivate" name="reactivate" class="btn btn-success" <?php echo ($_SESSION["user_role"]=="1"?"":"disabled");?> onClick="return confirm('Are you sure you want to reset enrollment details?')">Reset</a>
		<button type="submit" id="submit" name="submit" class="btn btn-primary" <?php echo ($_SESSION["user_role"]=="1"?"":"disabled");?> <?php echo ($dataEnrollment['enrol_status1']=="INACTIVE"?"disabled":"");?> onClick="return confirm('Are you sure you want to save changes?')">Modify</button>
		<button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload();">Close</button>
	</div>
	</form>
</div>


<script type="text/javascript">
var enrolstatus1;

function updateChange(element){
		enrolstatus1 =  document.getElementById('enrol_status1').value;
		$("#submit").removeAttr("disabled");
		
		if(enrolstatus1 == "INACTIVE"){
			$("#enrol_graddate").removeAttr("readonly");
			$("#enrol_graddate").attr("required", "required");	
			$("#enrol_gradawards").removeAttr("readonly");
			$("#enrol_gradawards").attr("required", "required");	
			$("#enrol_status2").empty().append('<option value="">---select---</option><option value="TRANSFERRED OUT">TRANSFERRED OUT</option><option value="DROPPED OUT">NO LONGER IN SCHOOL</option>');
			$("#submit").removeAttr("disabled");
		} 
		else if(enrolstatus1 == "ENROLLED"){
			$("#enrol_graddate").removeAttr("required");
			$("#enrol_graddate").attr("readonly", "readonly");	
			$("#enrol_gradawards").removeAttr("required");
			$("#enrol_gradawards").attr("readonly", "readonly");	
			$("#enrol_status2").empty().append('<option value="">---select---</option><option value="REGULAR">REGULAR</option><option value="IRREGULAR">CONDITIONAL</option>');
			$("#submit").attr("disabled", "disabled");
		} 
		else{
			$("#enrol_status2").empty().append('<option value="">---select---</option>');
			$("#enrol_graddate").attr("readonly", "readonly");
			$("#submit").attr("disabled", "disabled");
		}		
    }
</script>



