<?php
session_start();
require ('maincore.php');
$resultStudent = dbquery("SELECT * FROM student WHERE stud_no='".$_GET['showProfile']."'");
$dataStudent = dbarray($resultStudent);

$resultEnrollment = dbquery("SELECT * FROM studenroll WHERE (enrol_sy!='".$current_sy."' AND enrol_stud_no='".$_GET['showProfile']."') ORDER BY enrol_sy DESC");
$dataEnrollment = dbarray($resultEnrollment);
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
<?php
$checkEarly = dbquery("select * from earlyregistry where (er_no='".$_GET['er_no']."')");
$countcheckEarly = dbrows($checkEarly);
$datacheckEarly = dbarray($checkEarly);
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Early Registration Form - Update</h4>
    </div>
	<form name="form1" method="post" action="./earlyregistry.scr.php?update=Yes">
	<input type="hidden" id="enrol_stud_no" name="er_no" required="required" class=" form-control" value="<?php echo $datacheckEarly['er_no']; ?>">
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
							<option value="<?php echo $i; ?>" <?php echo($datacheckEarly['er_level']==$i?"selected":"");?>><?php echo $i; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Disability <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_eligibility" name="er_disability" class="form-control">
							<option value="">---select---</option>
							<option value="None" <?php echo($datacheckEarly['er_disability']=="None"?"selected":"");?>>None</option>
							<option value="Visual Impairment" <?php echo($datacheckEarly['er_disability']=="Visual Impairment"?"selected":"");?>>Visual Impairment</option>
							<option value="Hearing Impairment" <?php echo($datacheckEarly['er_disability']=="Hearing Impairment"?"selected":"");?>>Hearing Impairment</option>
							<option value="Intellectual Disability" <?php echo($datacheckEarly['er_disability']=="Intellectual Disability"?"selected":"");?>>Intellectual Disability</option>
							<option value="Speech/Language Impairment" <?php echo($datacheckEarly['er_disability']=="Speech/Language Impairment"?"selected":"");?>>Speech/Language Impairment</option>
							<option value="Serious Emotional Disturbance" <?php echo($datacheckEarly['er_disability']=="Serious Emotional Disturbance"?"selected":"");?>>Serious Emotional Disturbance</option>
							<option value="Autism" <?php echo($datacheckEarly['er_disability']=="Autism"?"selected":"");?>>Autism</option>
							<option value="Orthopedic Impairment" <?php echo($datacheckEarly['er_disability']=="Orthopedic Impairment"?"selected":"");?>>Orthopedic Impairment</option>
							<option value="Special Health Problem" <?php echo($datacheckEarly['er_disability']=="Special Health Problem"?"selected":"");?>>Special Health Problem</option>
							<option value="Multiple Disabilities" <?php echo($datacheckEarly['er_disability']=="Multiple Disabilities"?"selected":"");?>>Multiple Disabilities</option>
							<option value="Others" <?php echo($datacheckEarly['er_disability']=="Others"?"selected":"");?>>Others</option>
						</select>
					</div>
				</div>	
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Credentials <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_status2" name="er_creds" maxlength="100" required="required" class=" form-control" value="<?php echo $datacheckEarly['er_creds'];?>" style="text-transform:uppercase;">
					</div>
				</div>
			</div>	
			<div class="row">					
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">School Name/ Learning Center - Address <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_school" name="er_prevschool" required="required" class=" form-control" placeholder="San Agustin NHS - Sagbayan, Bohol" value="<?php echo $datacheckEarly['er_prevschool'];?>" style="text-transform:uppercase;">
					</div>
				</div>	
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Remarks <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_school" name="er_remarks" required="required" class=" form-control" placeholder="" value="<?php echo $datacheckEarly['er_remarks'];?>" style="text-transform:uppercase;">
					</div>
				</div>	
			</div>		
			<?php
			$resultUser = dbquery("select * from users where user_no='".$datacheckEarly['er_lastmod_user_no']."'");
			$dataUser = dbarray($resultUser);
			?>
			</strong></small><br>
			<i>Last modified by <strong><small><?php echo $dataUser['user_fullname']; ?></strong></small> on <strong><small><?php echo date('F d, Y g:ia', strtotime($datacheckEarly['er_lastmoddatetime']) + 8.0 * 3600);?></strong></small></i></td>
			</tr>
		</div>
     </div>
	<div class="modal-footer">
		<a class="btn btn-danger" href="earlyregistry.scr.php?unregister=Yes&er_no=<?php echo $datacheckEarly['er_no'];?>" <?php echo ($_SESSION["user_role"]==1?"":"disabled");?> onClick="return confirm('Are you sure you want to unregister student?')">Un-Register</a>
		<button type="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')">Update</button>
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
