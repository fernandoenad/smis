<?php
require ('maincore.php');
$resultEnrollment = dbquery("SELECT * FROM studenroll WHERE enrol_no='".$_GET['enrol_no']."'");
$dataEnrollment = dbarray($resultEnrollment);
$dataEnrollmentSchool = unserialize($dataEnrollment['enrol_school']);

$resultStudent = dbquery("SELECT * FROM student WHERE stud_no='".$dataEnrollment['enrol_stud_no']."'");
$dataStudent = dbarray($resultStudent);
?>
		  <script type="text/javascript">
			   $(document).ready(function(){
				   $("#enrol_status1").change(function(){
						 var enrol_status1=$("#enrol_status1").val();
						 $.ajax({
							type:"post",
							url:"getstatus2.php",
							data:"enrol_status1="+enrol_status1,
							success:function(data){
								  $("#enrol_status2").html(data);
							}
						 });
				   });
			   });
		  </script>	
		  
		  <script type="text/javascript">
			   $(document).ready(function(){
				   $("#enrol_level").change(function(){
						 var enrol_level=$("#enrol_level").val();
						 $.ajax({
							type:"post",
							url:"getsection2.php",
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
		<h4 class="modal-title">Modify Enrollment History</h4>
    </div>
	<form name="form1" method="post" action="./enrollment.scr.php?UpdateHistoryEnroll=Yes">
	<input type="hidden" id="enrol_stud_no" name="enrol_stud_no" required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_stud_no']; ?>">
	<input type="hidden" id="enrol_no" name="enrol_no" required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_no']; ?>">
    <div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						Modify enrollment history for <strong><?php echo $dataStudent['stud_lrn']." ".strtoupper($dataStudent['stud_lname']).", ".strtoupper($dataStudent['stud_fname'])." ".strtoupper($dataStudent['stud_mname']); ?></strong> for School Year <strong><?php echo $dataEnrollment['enrol_sy']; ?>-<?php echo $dataEnrollment['enrol_sy']+1; ?></strong>?
					</div>
				</div>
			</div>
	
			<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">School Year <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_sy" name="enrol_sy" required="required" class=" form-control">
							<option value="">---select---</option>
							<?php
							for ($i=$current_sy-1; $i>$current_sy-100; $i-=.5) {
							?>
							<option value="<?php echo $i; ?>" <?php echo ($i==$dataEnrollment['enrol_sy']?"selected":""); ?>><?php echo $i; ?></option>
							<?php } ?>
							<option value="<?php echo $current_sy-.5; ?>" <?php echo (($current_sy-.5)==$dataEnrollment['enrol_sy']?"selected":""); ?>>TRANSFERRED IN</option>
						</select>
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Level <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_level" name="enrol_level" required="required" class=" form-control">
							<?php
							for ($i=$current_school_minlevel-1; $i<=$current_school_maxlevel; $i++) {
							?>
							<option value="<?php echo $i; ?>" <?php echo ($i==$dataEnrollment['enrol_level']?"selected":""); ?>><?php echo $i; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Rating <span title="Required" class="text-danger">*</span></label>
						<input type="number" step="0.01" id="enrol_average" name="enrol_average" required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_average']; ?>" style="text-transform:uppercase;">
					</div>
				</div>	
				<div class="col-lg-5 col-md-5">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Admission Type / Eligibility <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_eligibility" name="enrol_eligibility" class="form-control">
							<option value="">---select---</option>
							<option value="Transferee" <?php echo ($dataEnrollment['enrol_eligibility']=="Transferee"?"selected":"");?>>Transferee</option>
							<option value="Old Curriculum High School Completer" <?php echo ($dataEnrollment['enrol_eligibility']=="Old Curriculum High School Completer"?"selected":"");?>>Old Curriculum High School Completer</option>
							<option value="Junior High School Completer" <?php echo ($dataEnrollment['enrol_eligibility']=="Junior High School Completer"?"selected":"");?>>Junior High School Completer</option>
							<option value="Elementary School Completer" <?php echo ($dataEnrollment['enrol_eligibility']=="Elementary School Completer"?"selected":"");?>>Elementary School Completer</option>
							<option value="Philippine Education Placement Test Passer" <?php echo ($dataEnrollment['enrol_eligibility']=="Philippine Education Placement Test Passer"?"selected":"");?>>Philippine Education Placement Test Passer</option>
							<option value="Alternative Learning System Passer" <?php echo ($dataEnrollment['enrol_eligibility']=="Alternative Learning System Passer"?"selected":"");?>>Alternative Learning System Passer</option>
							<option value="Others" <?php echo ($dataEnrollment['enrol_eligibility']=="Others" || $dataEnrollment['enrol_eligibility']==""?"selected":"");?>>Others</option>
						</select>
					</div>
				</div>	
			</div>		
			<div class="row">
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">School ID <span title="Required" class="text-danger">*</span></label>
						<input type="number" min="000000" max="999999" id="enrol_school_id" name="enrol_school_id" required="required" class=" form-control" value="<?php echo $dataEnrollmentSchool['0']; ?>" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-8 col-md-8">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">School / Learning Center <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_school_name" name="enrol_school_name" required="required" class=" form-control" value="<?php echo $dataEnrollmentSchool['1']; ?>" style="text-transform:uppercase;">
					</div>
				</div>		
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">School / Learning Center Address <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_school_address" name="enrol_school_address" required="required" class=" form-control" value="<?php echo $dataEnrollmentSchool['2']; ?>" style="text-transform:uppercase;">
					</div>
				</div>	
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Enrollment Status <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_status1" name="enrol_status1" required="required" class=" form-control">
							<option value="">---select---</option>
							<option value="PROMOTED" <?php echo ("PROMOTED"==$dataEnrollment['enrol_status1']?"selected":"");?>>PROMOTED</option>
							<option value="TRANSFEREE" <?php echo ("TRANSFEREE"==$dataEnrollment['enrol_status1']?"selected":"");?>>TRANSFEREE</option>
							<option value="TRANSFERRED IN" <?php echo ("TRANSFERRED IN"==$dataEnrollment['enrol_status1']?"selected":"");?>>TRANSFERRED IN</option>
						</select>	
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn"><span title="Required" class="text-danger">*</span></label>
						<select id="enrol_status2" name="enrol_status2" required="required" class=" form-control">
							<?php
							$resultStatus2 = dbquery("SELECT * FROM dropdowns WHERE field_category='".$dataEnrollment['enrol_status1']."' ORDER BY field_name ASC");
							while($dataStatus = dbarray($resultStatus2)){
							?>
								<option value="<?php echo $dataStatus['field_name']; ?>" <?php echo ($dataStatus['field_name']==$dataEnrollment['enrol_status2']?"selected":"");?>><?php echo $dataStatus['field_name']; ?></option>
							<?php } ?>
						</select>	
					</div>
				</div>
			
			</div>
			<?php
			if($dataEnrollment['enrol_level']>10){
			?>
			<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Track </label>
						<select id="enrol_track" name="enrol_track" class=" form-control">
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
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Strand </label>
						<select id="enrol_strand" name="enrol_strand" class=" form-control">
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
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Combo </label>
						<input type="text" id="enrol_combo" name="enrol_combo"  class=" form-control" value="<?php echo $dataEnrollment['enrol_combo']; ?>" style="text-transform:uppercase;">
					</div>
				</div>
			</div>
			<?php
			}
			?>
			<div class="row">
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Years in School <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="enrol_status2" name="enrol_schoolyears" maxlength="100" required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_schoolyears']; ?>" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Remarks <span title="Required" class="text-danger">*</span></label>
						<?php
						$pos = strpos($dataEnrollment['enrol_remarks'],"/");
						?>
						<input type="text" id="enrol_status2" name="enrol_remarks" maxlength="100" required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_remarks']; ?>" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Section <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_section" name="enrol_section"  class=" form-control">
							<option value="" <?php echo ($dataEnrollment['enrol_section']==""?"selected":"");?>>TRANSFEREE</option>
							<?php
							$resultSectionList = dbquery("SELECT * FROM section WHERE (section_sy='".$dataEnrollment['enrol_sy']."' AND section_level='".$dataEnrollment['enrol_level']."' and section_name NOT LIKE 'Z_T%') ORDER BY section_name ASC");
							while($dataSectionList = dbarray($resultSectionList)){
							?>
								<option value="<?php echo $dataSectionList['section_name']; ?>" <?php echo ($dataEnrollment['enrol_section']==$dataSectionList['section_name']?"selected":"");?>><?php echo $dataSectionList['section_name'].""; ?></option>
							<?php 
							}?>
						</select>
					</div>
				</div>	
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Date of Graduation/ Examination </label>
						<input type="date" id="date_grad" name="enrol_graddate" class=" form-control" <?php echo ($dataEnrollment['enrol_level']=="6" || $dataEnrollment['enrol_level']=="10"?"":"readonly");?> value="<?php echo $dataEnrollment['enrol_graddate']; ?>" style="text-transform:uppercase;">
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
					<?php echo ($dataEnrollment['enrol_level']>10?" (1st sem) / ".date('F d, Y g:ia', strtotime($dataEnrollment['enrol_admitdate2']) + 8.0 * 3600)." (2nd sem)":"");?>
					</strong></small><br>
					Last modified by <strong><small><?php echo $dataUser['user_fullname']; ?></strong></small> on <strong><small><?php echo $mysqldate = date('F d, Y g:ia', strtotime($dataEnrollment['enrol_updatedate']) + 8.0 * 3600);?></strong></small></i></td>
				</tr>
			
		</div>
     </div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')">Modify</button>
		<button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
	</div>
	</form>
</div>

<script type="text/javascript">
var enrollevel = 0;
function updateChange(element){
		enrollevel =  document.getElementById('enrol_level').value;
		if(enrollevel == 6){
			$("#enrol_graddate").removeAttr("readonly");
			$("#enrol_graddate").attr("required", "required");	
			document.getElementById("enrol_status1").value = "TRANSFEREE";
			document.getElementById("enrol_status2").value = "PROMOTED";
			document.getElementById("enrol_eligibility").value = "Transferee";
					
		} 
		else if(enrollevel == 10){
			$("#enrol_graddate").removeAttr("readonly");
			$("#enrol_graddate").attr("required", "required");		
			document.getElementById("enrol_status1").value = "TRANSFEREE";
			document.getElementById("enrol_status2").value = "PROMOTED";
			document.getElementById("enrol_eligibility").value = "Transferee";
		} 
		else{
			$("#enrol_graddate").attr("readonly", "readonly");
			document.getElementById("enrol_status1").value = "TRANSFEREE";
			document.getElementById("enrol_status2").value = "PROMOTED";
			document.getElementById("enrol_eligibility").value = "Transferee";
	
		}            
    }
</script>

<script type="text/javascript">
var enrolsy = 0;
var currentsy = <?php echo $current_sy-.5;?>;
function updateStatus(element){
		enrolsy =  document.getElementById('enrol_sy').value;
		if(enrolsy == currentsy){
			document.getElementById("enrol_status1").value = "TRANSFERRED IN";
			document.getElementById("enrol_status2").value = "TRANSFERRED IN";				
		}           
    }
</script>

<script type="text/javascript">
var enroleligibility = 0;
function updateStatus2(element){
		enroleligibility =  document.getElementById('enrol_eligibility').value;
		if(enroleligibility == "Others"){
			document.getElementById("enrol_status1").value = "PROMOTED";
			document.getElementById("enrol_status2").value = "PROMOTED";
			document.getElementById("enrol_school_id").value = "<?php echo $current_school_code;?>";	
			document.getElementById("enrol_school_name").value = "<?php echo $current_school_full;?>";	
			document.getElementById("enrol_school_address").value = "<?php echo $current_school_address;?>";	
			$("#enrol_school_id").attr("readonly", "readonly");
			$("#enrol_school_name").attr("readonly", "readonly");
			$("#enrol_school_address").attr("readonly", "readonly");
		}   
		else{
			document.getElementById("enrol_status1").value = "PROMOTED";
			document.getElementById("enrol_status2").value = "PROMOTED";
			ocument.getElementById("enrol_school_id").value = "";	
			document.getElementById("enrol_school_name").value = "";	
			document.getElementById("enrol_school_address").value = "";	
			$("#enrol_school_id").removeAttr("readonly");
			$("#enrol_school_name").removeAttr("readonly");
			$("#enrol_school_address").removeAttr("readonly");
			
		}
    }
</script>


