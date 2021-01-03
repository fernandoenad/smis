<?php
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
<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()">&times;</button>
		<h4 class="modal-title">Modify Enrollment Details</h4>
    </div>
	<form name="form1" method="post" action="./enrollment.scr.php?UpdateEnroll=Yes">
	<input type="hidden" id="enrol_stud_no" name="enrol_stud_no" required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_stud_no']; ?>">
	<input type="hidden" id="enrol_no" name="enrol_no" required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_no']; ?>">
	<input type="hidden" id="enrol_school" name="enrol_school" required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_school']; ?>">
	<input type="hidden" id="enrol_sy" name="enrol_sy" required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_sy']; ?>">
	<input type="hidden" id="enrol_eligibility" name="enrol_eligibility" required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_eligibility']; ?>">
    <div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						Modify enrollment details of <strong><?php echo $dataStudent['stud_lrn']." ".strtoupper($dataStudent['stud_lname']).", ".strtoupper($dataStudent['stud_fname'])." ".strtoupper($dataStudent['stud_mname']); ?></strong> for School Year <strong><?php echo $dataEnrollment['enrol_sy']; ?>-<?php echo $dataEnrollment['enrol_sy']+1; ?></strong>?
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Level <span title="Required" class="text-danger">*</span></label>
						<input type="number" step="0.01" id="enrol_level" name="enrol_level" readonly required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_level']; ?>" style="text-transform:uppercase;">
						
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Section <span title="Required" class="text-danger">*</span></label>
						<input type="text" step="0.01" id="enrol_height" name="enrol_section" readonly required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_section']; ?>" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Years in School <span title="Required" class="text-danger">*</span></label>
						<input type="number" step="0.01" id="enrol_schoolyears" name="enrol_schoolyears" required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_schoolyears']; ?>" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Height <small>(cm.)</small><span title="Required" class="text-danger">*</span></label>
						<input type="number" step="0.01" min="5" id="enrol_height" name="enrol_height" required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_height']; ?>" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Weight <small>(Kg.)</small<span title="Required" class="text-danger">*</span></label>
						<input type="number" step="0.01" min="5" id="enrol_weight" name="enrol_weight" required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_weight']; ?>" style="text-transform:uppercase;">
					</div>
				</div>				
				
			</div>
			<?php
			if ($dataEnrollment['enrol_level']>10){
			?>
			<div class="row">
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Track <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_track" readonly name="enrol_track" required="required" value="<?php echo $dataEnrollment['enrol_track'];?>" class=" form-control">
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Strand <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_strand" readonly name="enrol_strand" required="required" value="<?php echo $dataEnrollment['enrol_strand'];?>" class=" form-control">
					</div>
				</div>
				<div class="col-lg-8 col-md-8">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Combo <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_combo" readonly name="enrol_combo" required="required"  class=" form-control" value="<?php echo $dataEnrollment['enrol_combo']; ?>" style="text-transform:uppercase;">
					</div>
				</div>
			</div>	
			<?php
			}
			?>
			<div class="row">
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Average <span title="Required" class="text-danger">*</span></label>
						<?php
						$resultGrade = dbquery("SELECT * FROM grade INNER JOIN class ON grade_class_no = class_no INNER JOIN prospectus ON class_pros_no = pros_no WHERE (grade_stud_no='".$dataEnrollment['enrol_stud_no']."' AND pros_title NOT LIKE  '%***%' AND grade_sy='".$current_sy."')");	
						$below80counter=0;
						while($dataGrade = dbarray($resultGrade)){
							$aveQf += ($dataGrade['grade_final']*$dataGrade['pros_unit']);
							if($dataGrade['grade_final']<60){
								$gradedUnitsqf+=0;
							}
							else {
								$gradedUnitsqf+=$dataGrade['pros_unit'];
							}
							$countUnits+=$dataGrade['pros_unit'];
							if(($dataGrade['grade_q1']<80 || $dataGrade['grade_q2']<80 || $dataGrade['grade_q3']<80 || $dataGrade['grade_q4']<80) && $dataGrade['pros_unit']>0) { $below80counter++;}
						}
						?>
						<input type="number" step="0.0001" id="enrol_average" readonly name="enrol_average" required="required" class=" form-control" value="<?php echo ($countUnits!=$gradedUnitsqf?"0":number_format($aveQf/$countUnits,3));?>" style="text-transform:uppercase;">
					</div>
				</div>	
				<div class="col-lg-2 col-md-2">
					<div class="form-group">	
						<label class="control-label required" for="stud_lrn">Fail(s) <span title="Required" class="text-danger">*</span></label>
						<?php
						$checkFailGrade = dbquery("select * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (pros_unit!=0 and(grade_final<75 and grade_final>59) and grade_sy='".$current_sy."' and grade_stud_no='".$dataEnrollment['enrol_stud_no']."')");	
						$countFailGrade = dbrows($checkFailGrade);
						?>
						<input type="text" id="enrol_status22" name="enrol_status22" readonly required="required" class=" form-control" value="<?php echo $countFailGrade;?>">
					</div>
				</div>
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Enrollment Status 1 <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_status1" name="enrol_status1" required="required" onChange="updateChange(this);" class=" form-control">
							<option value="" disabled>---select---</option>
							<option value="ENROLLED" <?php echo ("ENROLLED"==$dataEnrollment['enrol_status1']?"selected":"");?> <?php echo ($eoyupdate==false?"":"disabled");?>>ENROLLED</option>
							<option value="PROMOTED" <?php echo ("PROMOTED"==$dataEnrollment['enrol_status1']?"selected":"");?> <?php echo ($eoyupdate==false?"disabled":"");?>>EOSY STATUS</option>
						</select>	
					</div>
				</div>
				
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Enrollment Status 2 <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_status2" name="enrol_status2" required="required" class=" form-control">
							<option value="" >---select---</option>
							<option value="REGULAR" <?php echo ("REGULAR"==$dataEnrollment['enrol_status2'] && $eoyupdate==false?"selected":"disabled");?>>REGULAR</option>
							<?php
							if($dataEnrollment['enrol_level']>10){
							?>
							<option value="IRREGULAR" <?php echo ("IRREGULAR"==$dataEnrollment['enrol_status2']?"selected":"disabled");?>>IRREGULAR</option>
							<?php
							}
							?>
							<?php
							if($dataEnrollment['enrol_level']==12){
							?>
							<option value="GRADUATED" <?php echo ("GRADUATED"==$dataEnrollment['enrol_status2']?"selected":"disabled");?>>GRADUATED</option>
							<?php
							}
							?>
							<option value="PROMOTED" <?php echo ("PROMOTED"==$dataEnrollment['enrol_status2']?"selected":"disabled");?>>PROMOTED</option>
							<option value="IRREGULAR" <?php echo ("IRREGULAR"==$dataEnrollment['enrol_status2']?"selected":"disabled");?>>IRREGULAR</option>
							<option value="RETAINED" <?php echo ("RETAINED"==$dataEnrollment['enrol_status2']?"selected":"disabled");?>>RETAINED</option>
							
						</select>	
					</div>
				</div>
				
				
			</div>
			
			<div class="row">
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Remarks <i><small>(Dash "-" if none.)</small></i> <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_remarks" name="enrol_remarks" readonly required="required" class=" form-control" value="<?php echo $dataEnrollment['enrol_remarks']; ?>" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Completion Date <span title="Required" class="text-danger">*</span></label>
						<input type="date" id="enrol_graddate" name="enrol_graddate" readonly  required maxlength="100" class=" form-control" value="<?php echo ($dataEnrollment['enrol_level']=="12"?$current_closing:$dataEnrollment['enrol_graddate']); ?>" style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-lg-5 col-md-5">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Completion Academic Awards  <i><small>(Dash "-" if none.)</small></i> <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_gradawards" readonly name="enrol_gradawards" <?php echo ($eoyupdate==true?"":"readonly");?> required maxlength="200" class=" form-control" value="<?php echo ($below80counter>0?"-":($dataEnrollment['enrol_gradawards'])); ?>" style="text-transform:uppercase;">
					</div>
				</div>
			</div>			
			<tr>	
				<?php
				$resultUser = dbquery("select * from users where user_no='".$dataEnrollment['enrol_username']."'");
				$dataUser = dbarray($resultUser);
				?>
				<td colspan="9">
				<i>Admitted on <strong><small><?php echo date('F d, Y g:ia', strtotime($dataEnrollment['enrol_admitdate']) + 8.0 * 3600);?>
				<?php echo ($dataEnrollment['enrol_level']>10?" (first sem) / ".date('F d, Y g:ia', strtotime($dataEnrollment['enrol_admitdate2']) + 8.0 * 3600)." (2nd sem)":"");?>
				</strong></small><br>
				Last modified by <strong><small><?php echo $dataUser['user_fullname']; ?></strong></small> on <strong><small><?php echo date('F d, Y g:ia', strtotime($dataEnrollment['enrol_updatedate']) + 8.0 * 3600);?></strong></small></i></td>
			</tr>
			
		</div>
     </div>
	<div class="modal-footer">
		<a href="anecdotalCredentials.frm.php?stud_no=<?php echo $dataEnrollment['enrol_stud_no'];?>" title="View Submitted Credentials" data-toggle="modal" data-target="#modal-medium"  data-backdrop="static" data-keyboard="false" class="btn btn-success"><span class="glyphicon glyphicon-list"></span></a>
		<a href="enrollment.scr.php?Reset=Yes&enrol_no=<?php echo $dataEnrollment['enrol_no'];?>" <?php echo ($dataEnrollment['enrol_status1']=="PROMOTED"?"":"disabled");?> id="reactivate" name="reactivate" class="btn btn-success" onClick="return confirm('Are you sure you want to reset enrollment details?')">Reset</a>
		<button type="submit" id="submit" name="submit" class="btn btn-primary" <?php //echo ($dataEnrollment['enrol_status1']=="PROMOTED"?"disabled":"");?> onClick="return confirm('Are you sure you want to save changes?')">Modify</button>
		<button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
	</div>
	</form>
</div>

<?php
	$checkFailGrade = dbquery("select * from grade inner join class on grade_class_no=class_no inner join prospectus on class_pros_no=pros_no where ((grade_final<75 and grade_final>59) and grade_sy='".$current_sy."' and grade_stud_no='".$dataEnrollment['enrol_stud_no']."')");
	$countFailGrade = dbrows($checkFailGrade);
	$failSubjects = "";
	while($dataFailGrade = dbarray($checkFailGrade)){
		$failSubjects = $failSubjects.$dataFailGrade['pros_title'].", ";
	}
	$failSubjects = substr($failSubjects,0,strlen($failSubjects)-2);

?>
<script type="text/javascript">
var enrolstatus1;
var enrollevel;
var enrolstatus22;
var enrolstatus2 = $('#enrol_status2');
var enrol_average = $('#enrol_average').val();

function updateChange(element){
		// document.getElementById("enrol_gradawards").value = enrol_average;
		enrolstatus1 =  document.getElementById('enrol_status1').value;
		enrollevel =  document.getElementById('enrol_level').value;
		enrolstatus22 = document.getElementById('enrol_status22').value;
		$("#submit").removeAttr("disabled");
		
		if(enrol_average >= 97.50 && enrolstatus22 == 0) {
			document.getElementById("enrol_gradawards").value = "WITH HIGHEST HONORS";
		} else if(enrol_average >= 94.50 && enrolstatus22 == 0) {
			document.getElementById("enrol_gradawards").value = "WITH HIGH HONORS";
		} else	if(enrol_average >= 89.50 && enrolstatus22 == 0) {
			document.getElementById("enrol_gradawards").value = "WITH HONORS";
		}  
		
		if(enrolstatus1 == "INACTIVE"){
			$("#enrol_graddate").removeAttr("readonly");
			$("#enrol_graddate").attr("required", "required");	
			$("#enrol_status2").removeAttr("readonly");
			enrolstatus2.empty().append('<option value="">---select---</option><option value="TRANSFERRED OUT">TRANSFERRED OUT</option><option value="DROPPED OUT">DROPPED OUT</option>');
		} 
		else if(enrolstatus1 == "ENROLLED"){
			$("#enrol_graddate").removeAttr("readonly");
			$("#enrol_graddate").attr("required", "required");	
			$("#enrol_status2").removeAttr("readonly");
			enrolstatus2.empty().append('<option value="">---select---</option><option value="REGULAR">REGULAR</option><option value="IRREGULAR">CONDITIONAL</option>');
			$("#submit").attr("disabled", "disabled");
		} 
		else if (enrollevel==10 && enrolstatus1 == "PROMOTED"){
				
			if(enrolstatus22>2){
				enrolstatus2.empty().append('<option value="">---select---</option><option value="RETAINED">RETAINED</option>');
				document.getElementById("enrol_status2").value = "RETAINED";
				document.getElementById("enrol_remarks").value = "-";
				document.getElementById("enrol_eligibility").value = "Others";
			}
			else if(enrolstatus22>0){
				enrolstatus2.empty().append('<option value="">---select---</option><option value="IRREGULAR">CONDITIONAL</option>');
				document.getElementById("enrol_status2").value = "IRREGULAR";
				document.getElementById("enrol_remarks").value = "<?php echo $failSubjects;?>";
				
				document.getElementById("enrol_eligibility").value = "Others";
			}
			else if(enrolstatus22==0) {
				enrolstatus2.empty().append('<option value="">---select---</option><option value="PROMOTED">PROMOTED</option>');
				document.getElementById("enrol_status2").value = "PROMOTED";
				document.getElementById("enrol_remarks").value = "-";
				document.getElementById("enrol_eligibility").value = "Junior High School Completer";
			}
								
		}
		else if(enrolstatus1 == "PROMOTED"){
			if(enrolstatus22>2 && enrollevel<11){
				enrolstatus2.empty().append('<option value="">---select---</option><option value="RETAINED">RETAINED</option>');
				document.getElementById("enrol_status2").value = "RETAINED";
				document.getElementById("enrol_remarks").value = "-";
				document.getElementById("enrol_eligibility").value = "Others";
				
				
			}
			else if(enrolstatus22>0){
				enrolstatus2.empty().append('<option value="">---select---</option><option value="IRREGULAR">CONDITIONAL</option>');
				document.getElementById("enrol_status2").value = "IRREGULAR";
				document.getElementById("enrol_remarks").value = "<?php echo $failSubjects;?>";
				document.getElementById("enrol_eligibility").value = "Others";
				
			}
			else if(enrolstatus22==0) {
				enrolstatus2.empty().append('<option value="">---select---</option><option value="PROMOTED">PROMOTED</option>');
				document.getElementById("enrol_status2").value = "PROMOTED";
				document.getElementById("enrol_remarks").value = "-";
				document.getElementById("enrol_eligibility").value = "Others";
				if(enrollevel==12) {
					enrolstatus2.empty().append('<option value="">---select---</option><option value="GRADUATED" selected>GRADUATED</option>');
					document.getElementById("enrol_remarks").value = "-";
					$("#enrol_graddate").removeAttr("readonly");		
				}
			}

				
		} 
		else{
			enrolstatus2.empty().append('<option value="">---select---</option>');
			$("#enrol_graddate").attr("readonly", "readonly");
			$("#submit").attr("disabled", "disabled");
		}

				
    }
</script>
