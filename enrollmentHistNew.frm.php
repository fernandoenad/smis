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
	$remarks = "-";
}
elseif($dataEnrollment['enrol_status1']=="PROMOTED" && $dataEnrollment['enrol_status2']=="IRREGULAR"){
	$level = $dataEnrollment['enrol_level'] + 1;
	$enrol_schoolyears = $dataEnrollment['enrol_schoolyears'] + 1;
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "IRREGULAR";
	$remarks = $dataEnrollment['enrol_remarks'];
}
elseif($dataEnrollment['enrol_status1']=="PROMOTED" && $dataEnrollment['enrol_status2']=="RETAINED"){
	$level = $dataEnrollment['enrol_level'];
	$enrol_schoolyears = $dataEnrollment['enrol_schoolyears'] + 1;
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "REGULAR";
	$remarks = $dataEnrollment['enrol_remarks'];
}
elseif($dataEnrollment['enrol_status1']=="TRANSFEREE" && $dataEnrollment['enrol_status2']=="PROMOTED"){
	$level = $dataEnrollment['enrol_level'] + 1;
	$enrol_schoolyears = $dataEnrollment['enrol_schoolyears'] + 1;
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "REGULAR";
	$remarks = "-";
}
elseif($dataEnrollment['enrol_status1']=="TRANSFEREE" && $dataEnrollment['enrol_status2']=="IRREGULAR"){
	$level = $dataEnrollment['enrol_level'] + 1;
	$enrol_schoolyears = $dataEnrollment['enrol_schoolyears'] + 1;
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "IRREGULAR";
	$remarks = $dataEnrollment['enrol_remarks'];
}
elseif($dataEnrollment['enrol_status1']=="TRANSFEREE" && $dataEnrollment['enrol_status2']=="RETAINED"){
	$level = $dataEnrollment['enrol_level'];
	$enrol_schoolyears = $dataEnrollment['enrol_schoolyears'] + 1;
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "REGULAR";
	$remarks = $dataEnrollment['enrol_remarks'];
}
elseif($dataEnrollment['enrol_status1']=="TRANSFERRED IN" && $dataEnrollment['enrol_status2']=="TRANSFERRED IN"){
	$level = $dataEnrollment['enrol_level'];
	$enrol_schoolyears = $dataEnrollment['enrol_schoolyears'];
	$section = "TBA";
	$status1 = "TRANSFERRED IN";
	$status2 = "TRANSFERRED IN";
	$remarks = $dataEnrollment['enrol_remarks'];
}
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
							data:"enrol_level="+enrol_level+"&enrol_sy="+enrol_sy,
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
							url:"getstrand2.php",
							data:"enrol_track="+enrol_track,
							success:function(data){
								  $("#enrol_strand").html(data);
							}
						 });
				   });
			   });
		  </script>	
<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()">&times;</button>
		<h4 class="modal-title">Add Enrollment History</h4>
    </div>
	<form name="form1" method="post" action="./enrollment.scr.php?saveEnrolHist=Yes">
	<input type="hidden" id="enrol_stud_no" name="enrol_stud_no" required="required" class=" form-control" value="<?php echo $_GET['showProfile']; ?>">
    <div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						Add an enrollment history for  <strong><?php echo $dataStudent['stud_lrn']." ".strtoupper($dataStudent['stud_lname']).", ".strtoupper($dataStudent['stud_fname'])." ".strtoupper($dataStudent['stud_mname']); ?></strong>?
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">School Year <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_sy" name="enrol_sy" required="required" class=" form-control" onChange="updateStatus(this);">
							<option value="">---select---</option>
							<option value="<?php echo $current_sy-.5; ?>">TRANSFERRED IN</option>
							<?php
							for ($i=$current_sy-1; $i>$current_sy-100; $i--) {
								$checkSY = dbquery("select * from studenroll where (enrol_stud_no='".$_GET['showProfile']."' and enrol_sy='".$i."')");
								$dataSY = dbarray($checkSY);
								$countSY = dbrows(checkSY);
							?>
							<option value="<?php echo $i; ?>" <?php echo ($i==$dataSY['enrol_sy']?"disabled":"");?>><?php echo $i; ?></option>
							<?php } ?>
							
						</select>
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Level <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_level" name="enrol_level" required="required" onChange="updateChange(this);" class=" form-control">
							<option value="">---select---</option>
							<?php
							for ($i=$current_school_minlevel-1; $i<=$current_school_maxlevel; $i++) {
								if($i==-1){}
								else{
							?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php }} ?>
						</select>
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Rating <span title="Required" class="text-danger">*</span></label>
						<input type="number" step="0.01" id="enrol_average" name="enrol_average" required="required" class=" form-control" value="0" style="text-transform:uppercase;">
					</div>
				</div>	
				<div class="col-lg-5 col-md-5">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Admission Type / Eligibility <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_eligibility" name="enrol_eligibility" onChange="updateStatus2(this);" class="form-control">
							<option value="" selected>---select---</option>
							<option value="Transferee">Transferee</option>
							<option value="Old Curriculum High School Completer">Old Curriculum High School Completer</option>
							<option value="Junior High School Completer">Junior High School Completer</option>
							<option value="Philippine Education Placement Test Passer">Philippine Education Placement Test Passer</option>
							<option value="Alternative Learning System Passer">Alternative Learning System Passer</option>
							<option value="Others">Others/Old Student</option>
						</select>
					</div>
				</div>	
			
			</div>	
			<div class="row">
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">School ID  <span title="Required" class="text-danger">*</span></label>
						<input type="number" min="000000" max="999999" id="enrol_school_id" name="enrol_school_id" required="required" class=" form-control" placeholder="<?php echo $current_school_code;?>" value="" style="text-transform:uppercase;">
					</div>
				</div>	
				<div class="col-lg-8 col-md-8">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">School / Learning Center <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_school_name" name="enrol_school_name" required="required" class=" form-control" placeholder="<?php echo $current_school_full;?>" value="" style="text-transform:uppercase;">
					</div>
				</div>	
			</div>
			<div class="row">		
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">School / Learning Center Address <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_school_address" name="enrol_school_address" required="required" class=" form-control" placeholder="<?php echo $current_school_address;?>" value="" style="text-transform:uppercase;">
					</div>
				</div>				
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
					
						<label class="control-label required" for="stud_lrn">Enrollment Status 1 <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_status1" name="enrol_status1" readonly required="required" class=" form-control">
							<option value="">---select---</option>
							<option value="PROMOTED">PROMOTED</option>
							<option value="TRANSFEREE">TRANSFEREE</option>
							<option value="TRANSFERRED IN" <?php echo ($_SESSION["user_role"]=="1"?"":"disabled");?> >TRANSFERRED IN</option>

						</select>	
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Enrollment Status 2 <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_status2" name="enrol_status2"  required="required" class=" form-control">
							<option value="">---select---</option>
							<?php
							$resultStatus2 = dbquery("SELECT * FROM dropdowns WHERE field_category LIKE 'TRANS%' ORDER BY field_name ASC");
							while($dataStatus = dbarray($resultStatus2)){
							?>
								<option value="<?php echo $dataStatus['field_name']; ?>"><?php echo $dataStatus['field_name']; ?></option>
							<?php } ?>
						</select>	
					</div>
				</div>
			
			</div>
			<?php 
			if($current_school_maxlevel>10){			
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
						<input type="number" id="enrol_status2" name="enrol_schoolyears" readonly maxlength="100" class=" form-control" value="<?php echo $enrol_schoolyears;?>" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Remarks <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_status2" name="enrol_remarks" maxlength="100" required="required" class=" form-control" value="-" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Section <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_section" name="enrol_section"  class=" form-control">
							<option value="">TRANSFEREE</option>
						</select>
					</div>
				</div>	
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Date of Graduation/ Examination </label>
						<input type="date" id="enrol_graddate" name="enrol_graddate" readonly class=" form-control" value="0" style="text-transform:uppercase;">
					</div>
				</div>	
			</div>
			
		</div>
     </div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')">Add</button>
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
			$("#enrol_track").attr("readonly", "readonly");	
			$("#enrol_strand").attr("readonly", "readonly");	
			$("#enrol_combo").attr("readonly", "readonly");	
					
		} 
		else if(enrollevel == 10){
			$("#enrol_graddate").removeAttr("readonly");
			$("#enrol_graddate").attr("required", "required");		
			document.getElementById("enrol_status1").value = "TRANSFEREE";
			document.getElementById("enrol_status2").value = "PROMOTED";
			document.getElementById("enrol_eligibility").value = "Junior High School Completer";
			$("#enrol_track").attr("readonly", "readonly");	
			$("#enrol_strand").attr("readonly", "readonly");	
			$("#enrol_combo").attr("readonly", "readonly");	
		} 
		else if(enrollevel > 10){
			$("#enrol_track").removeAttr("readonly");			
			$("#enrol_strand").removeAttr("readonly");	
			$("#enrol_combo").removeAttr("readonly");	
		}
		else{
			$("#enrol_graddate").attr("readonly", "readonly");
			document.getElementById("enrol_status1").value = <?php echo ($status1=="TRANSFERRED IN"?"TRANSFERRED IN":"TRANSFEREE");?>;
			document.getElementById("enrol_status2").value = <?php echo ($status1=="TRANSFERRED IN"?"TRANSFERRED IN":"PROMOTED");?>;
			document.getElementById("enrol_eligibility").value = "Transferee";
			$("#enrol_track").attr("readonly", "readonly");	
			$("#enrol_strand").attr("readonly", "readonly");	
			$("#enrol_combo").attr("readonly", "readonly");	
	
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
			document.getElementById("enrol_eligibility").value = "Transferee";		
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
			document.getElementById("enrol_school_id").value = "";	
			document.getElementById("enrol_school_name").value = "";	
			document.getElementById("enrol_school_address").value = "";	
			$("#enrol_school_id").removeAttr("readonly");
			$("#enrol_school_name").removeAttr("readonly");
			$("#enrol_school_address").removeAttr("readonly");
			
		}
    }
</script>


