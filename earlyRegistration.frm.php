<?php
require ('maincore.php');
$resultStudent = dbquery("SELECT * FROM student WHERE stud_no='".$_GET['showProfile']."'");
$dataStudent = dbarray($resultStudent);

$resultEnrollment = dbquery("SELECT * FROM studenroll WHERE (enrol_sy='".$current_sy."' AND enrol_stud_no='".$_GET['showProfile']."') ORDER BY enrol_sy DESC");
$dataEnrollment = dbarray($resultEnrollment);
$dataEnrollmentSchool = unserialize($dataEnrollment['enrol_school']);

if($dataEnrollment['enrol_status1']=="PROMOTED" && $dataEnrollment['enrol_status2']=="PROMOTED"){
	$level = $dataEnrollment['enrol_level'] + 1;
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "REGULAR";
	$remarks = "PROMOTED FROM GRADE ".$dataEnrollment['enrol_level'];
}
elseif($dataEnrollment['enrol_status1']=="PROMOTED" && $dataEnrollment['enrol_status2']=="IRREGULAR"){
	$level = $dataEnrollment['enrol_level'] + 1;
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "IRREGULAR";
	$remarks = $dataEnrollment['enrol_remarks'];
}
elseif($dataEnrollment['enrol_status1']=="PROMOTED" && $dataEnrollment['enrol_status2']=="RETAINED"){
	$level = $dataEnrollment['enrol_level'];
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "REGULAR";
	$remarks = $dataEnrollment['enrol_remarks'];
}
elseif($dataEnrollment['enrol_status1']=="TRANSFEREE" && $dataEnrollment['enrol_status2']=="PROMOTED"){
	$level = $dataEnrollment['enrol_level'] + 1;
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "REGULAR";
	$remarks = "PROMOTED FROM GRADE ".$dataEnrollment['enrol_level'];
}
elseif($dataEnrollment['enrol_status1']=="TRANSFEREE" && $dataEnrollment['enrol_status2']=="IRREGULAR"){
	$level = $dataEnrollment['enrol_level'] + 1;
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "IRREGULAR";
	$remarks = $dataEnrollment['enrol_remarks'];
}
elseif($dataEnrollment['enrol_status1']=="TRANSFEREE" && $dataEnrollment['enrol_status2']=="RETAINED"){
	$level = $dataEnrollment['enrol_level'];
	$section = "TBA";
	$status1 = "ENROLLED";
	$status2 = "REGULAR";
	$remarks = $dataEnrollment['enrol_remarks'];
}
elseif($dataEnrollment['enrol_status1']=="TRANSFERRED IN" && $dataEnrollment['enrol_status2']=="TRANSFERRED IN"){
	$level = $dataEnrollment['enrol_level'];
	$section = "TBA";
	$status1 = "ENROLLED";
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
<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Early Registration Form - New</h4>
    </div>
	<form name="form1" method="post" action="./earlyregistry.scr.php?save=Yes">
	<input type="hidden" id="enrol_stud_no" name="er_stud_no" required="required" class=" form-control" value="<?php echo $_GET['showProfile']; ?>">
    <div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						Are you sure you want to early register  <strong><?php echo $dataStudent['stud_lrn']." ".strtoupper($dataStudent['stud_lname']).", ".strtoupper($dataStudent['stud_fname'])." ".strtoupper($dataStudent['stud_mname']); ?></strong>?
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">School Year <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_sy" name="er_sy" required="required" class=" form-control">
							<option value="<?php echo $current_sy+1; ?>"><?php echo $current_sy+1; ?></option>
						</select>
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Level <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_level" name="er_level" required="required" onChange="updateChange(this);" class=" form-control">
							<option value="">---select---</option>
							<?php
							for ($i=$current_school_minlevel; $i<=$current_school_maxlevel; $i++) {
							?>
							<option value="<?php echo $i; ?>" <?php echo ($_GET['er_level']==$i?"selected":($i==7?"selected":""));?>><?php echo $i; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Disability <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_eligibility" name="er_disability" required="required" class="form-control">
							<option value="">---select---</option>
							<option value="None">None</option>
							<option value="Visual Impairment">Visual Impairment</option>
							<option value="Hearing Impairment">Hearing Impairment</option>
							<option value="Intellectual Disability">Intellectual Disability</option>
							<option value="Speech/Language Impairment">Speech/Language Impairment</option>
							<option value="Serious Emotional Disturbance">Serious Emotional Disturbance</option>
							<option value="Autism">Autism</option>
							<option value="Orthopedic Impairment">Orthopedic Impairment</option>
							<option value="Special Health Problem">Special Health Problem</option>
							<option value="Multiple Disabilities">Multiple Disabilities</option>
							<option value="Others">Others</option>
						</select>
					</div>
				</div>	
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Credentials <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_status2" name="er_creds" maxlength="100" required="required" class=" form-control" value="" style="text-transform:uppercase;">
					</div>
				</div>
			</div>	
			<div class="row">					
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">School Name/ Learning Center - Address <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_school" name="er_prevschool" required="required" class=" form-control" placeholder="San Agustin NHS - Sagbayan, Bohol" value="<?php echo $dataEnrollmentSchool['1'];?>" <?php echo ($dataEnrollmentSchool['0']==""?"":"readonly");?> style="text-transform:uppercase;">
					</div>
				</div>	
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Remarks <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_school" name="er_remarks" required="required" class=" form-control" placeholder="" value="" style="text-transform:uppercase;">
					</div>
				</div>	
			</div>			
		</div>
     </div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')">Register</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
			document.getElementById("enrol_eligibility").value = "TRANSFEREE";
					
		} 
		else if(enrollevel == 10){
			$("#enrol_graddate").removeAttr("readonly");
			$("#enrol_graddate").attr("required", "required");		
			document.getElementById("enrol_status1").value = "TRANSFEREE";
			document.getElementById("enrol_status2").value = "PROMOTED";
			document.getElementById("enrol_eligibility").value = "TRANSFEREE";
		} 
		else{
			$("#enrol_graddate").attr("readonly", "readonly");
			document.getElementById("enrol_status1").value = "PROMOTED";
			document.getElementById("enrol_status2").value = "PROMOTED";
			document.getElementById("enrol_eligibility").value = "Others";
			
		}            
    }
</script>
