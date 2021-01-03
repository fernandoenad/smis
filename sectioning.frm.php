<?php
require ('maincore.php');

$prev_sy = $current_sy-1;
$checkStudent = dbquery("select * from student inner join studenroll on stud_no=enrol_stud_no where (enrol_sy='$prev_sy' and stud_no='".$_GET['stud_no']."')");
$dataStudent = dbarray($checkStudent);

$student_image = "../mis/assets/images/students/".$_GET['stud_no'].".jpg";
$no_image = "../mis/assets/images/noimage.jpg";

$accessCode= rand();
?>
<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
		<h4 class="modal-title">Student Sectioning Form for School Year <?php echo $current_sy;?>-<?php echo $current_sy+1;?></h4>
    </div>
	<form name="form1" method="post" action="sectioning.scr.php?save=yes">
	<input type="hidden" id="stud_lrn" name="stud_no" required="required" class=" form-control" value="<?php echo $dataStudent['stud_no']; ?>">
    <div class="modal-body">
		<div class="card-body">			
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<div class="media">
							<div class="col-lg-3 col-md-3">
								<img src="<?php echo (file_exists($student_image) ? $student_image : $no_image); ?>" alt="" style="max-width:180px" />
							</div>
							<div class="media-body">
								<h3 class="media-heading"> <span style="font-size:25px;font-weight:normal"><?php echo strtoupper($dataStudent['stud_lname'].", ".$dataStudent['stud_fname']." ".$dataStudent['stud_xname']." ".$dataStudent['stud_mname']);?></h3>
								<h5> <span class="glyphicon glyphicon-list-alt"> <span style="font-size:13px;font-weight:normal">Previous SY Class: <?php echo $dataStudent['enrol_level']." - ".$dataStudent['enrol_section'];?></h5>
								<h5> <span class="glyphicon glyphicon-info-sign"> <span style="font-size:13px;font-weight:normal"><?php echo ($dataStudent['stud_status']==1?"Active Account":"Locked Out"); ?></h5>
								<hr>
								<?php
								$section_level = ($dataStudent['enrol_status2']!="RETAINED"?$dataStudent['enrol_level']+1:"");
								$section = dbquery("select * from section where (section_sy='$current_sy' and section_level='$section_level') order by section_name asc");
								?>
								<h5> <table border="0" width="100%"><tr><td width="28%"> New Section Assignment: </td><td>
								<select name="newsection" required class="selectpicker form-control">
									<option value="" >---<?php echo ($dataStudent['enrol_status2']!="RETAINED"?"select":"Ineligible for Promotion. Consult with Registrar.");?>---</option>
									<?php
									while($datasection = dbarray($section)){
										?>
										<option value="<?php echo $datasection['section_name'];?>"><?php echo $datasection['section_name'];?></option>
										<?php
									}
									?>
								</select>
								</td></tr></table>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<i><small>
						<ol> <strong>Note to the Encoder:</strong>
							<li> Make sure you have searched the right student.</li>
							<li> Assign student the section based on the list provided.</li>
							<li> Click on the "Assign" to complete process. </li>
						</ol>
						</small></i>
					</div>
				</div>
			</div>
		</div>
		
	</div>	
	<div class="modal-footer">
		
		<div class="form-group" >
			<button type="submit" id="submit" name="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')" >Assign</button>
			<button type="button" id="closed" name="closed" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
	</form>
</div>



