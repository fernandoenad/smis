<?php
require ('maincore.php');


$checkStudent = dbquery("select * from student inner join proposedsection on stud_no=prop_lrn where (prop_sy='$current_sy' and stud_no='".$_GET['stud_no']."')");
$dataStudent = dbarray($checkStudent);

$student_image = "../mis/assets/images/students/".$_GET['stud_no'].".jpg";
$no_image = "../mis/assets/images/noimage.jpg";


?>
<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
		<h4 class="modal-title">Student Section Assignment Form for School Year <?php echo $current_sy;?>-<?php echo $current_sy+1;?></h4>
    </div>
	<form name="form1" method="post" action="sectioning.scr.php?delete=yes">
	<input type="hidden" id="prop_no" name="prop_no" required="required" class="form-control" value="<?php echo $dataStudent['prop_no']; ?>">
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
								<h5> <span class="glyphicon glyphicon-list-alt"> <span style="font-size:13px;font-weight:normal">Current Class: <?php echo $dataStudent['prop_section'];?></h5>
								<h5> <span class="glyphicon glyphicon-info-sign"> <span style="font-size:13px;font-weight:normal"><?php echo ($dataStudent['stud_status']==1?"Active Account":"Locked Out"); ?></h5>
								
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
							<li> Should there be changes on the current section assignment, un-assign student by clicking on the "Un-Assign".</li>
							<li> Click on the Previous Students List to re-assign student with the correct section.</li>
						</ol>
						</small></i>
					</div>
				</div>
			</div>
			<tr>	
				<?php
				$resultUser = dbquery("select * from users where user_no='".$dataStudent['reg_userno']."'");
				$dataUser = dbarray($resultUser);
				?>
				<td colspan="9">
				Assigned by <strong><small><?php echo $dataUser['user_fullname']; ?></strong></small> on <strong><small><?php echo date('F d, Y g:ia', strtotime($dataStudent['reg_datetime']) + 8.0 * 3600);?>
				</strong></small></i></td>
			</tr>
		</div>
		
		
	</div>	
	<div class="modal-footer">
		
		<div class="form-group" >
			<button type="submit" id="submit" name="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')" >Un-Assign</button>
			<button type="button" id="closed" name="closed" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
	</form>
</div>



