<?php
session_start();
require ("maincore.php");
$result1 = dbquery("SELECT * FROM class INNER JOIN section ON class.class_section_no=section.section_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no INNER JOIN users ON class_user_name=user_no WHERE class.class_no='".$_GET['class_no']."'");
$data1 = dbarray($result1 );

$updateSem = dbquery("update grade set grade_sem='".$data1['class_sem']."' where grade_class_no='".$_GET['class_no']."'");
$resultGrade1 = dbquery("SELECT * FROM grade INNER JOIN student ON grade.grade_stud_no=student.stud_no WHERE grade.grade_class_no='".$_GET['class_no']."' ORDER BY stud_gender DESC, stud_lname ASC, stud_fname ASC");
?>
<link rel="stylesheet" href="./assets/css/style.css">
<link href="./assets/css/bootstrap.css" rel="stylesheet">
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Input Grades for <?php echo $data1['pros_title'];?> - <?php echo $data1['pros_desc'];?> (<?php echo $data1['class_section_no'];?>) <!--/ <?php echo $data1['user_fullname'];?>--></h4>
    </div>
	<form method="post" action="inputgrades.scr.php?UpdateGrades=Yes">
	<div class="modal-body">
	<div class="panel panel-default">
    <div class="panel-heading">Section <?php echo  $data1['section_name'];?></div>
	<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped table-sticky">
				<thead>
					<tr>
						<th width="3%">#</th>
						<th>Learner</th>
						<th width="8%">Q1</th>
						<th width="8%">Q2</th>
						<th width="8%">Q3</th>
						<th width="8%">Q4</th>
						<th width="8%">Final</th>
						<th width="14%">Remarks</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$i=1;
				while($dataGrade1 = dbarray($resultGrade1)){
					$checkActive = dbquery("select * from studenroll where (enrol_stud_no='".$dataGrade1['stud_no']."' and enrol_sy='".$_GET['enrol_sy']."')");
					$dataActive = dbarray($checkActive);
					if($dataActive['enrol_status1']=="INACTIVE"){}
					else{
					
				?>
					<input type="hidden" id="grade_no[]" name="grade_no[]" required="required" class=" form-control" value="<?php echo $dataGrade1['grade_no'];?>">
					<tr><td><?php echo $i;?></td>
						<td><small><?php echo strtoupper($dataGrade1['stud_lname'].", ".$dataGrade1['stud_fname']." ".$dataGrade1['stud_xname']." ".substr($dataGrade1['stud_mname'],0,1));?></small></td>
						<td><input <?php echo($dataGrade1['grade_q1']>59 && $_SESSION["user_role"]!=1?"readonly":"");?> name="grade_q1[]" id="grade_q1[]" type="number" style="width: 75px; height=15px;" max="100" min="60" class="form-control"  value="<?php echo ($dataGrade1['grade_q1']<60?"":$dataGrade1['grade_q1']);?>"></td>
						<td><input <?php echo($dataGrade1['grade_q2']>59 && $_SESSION["user_role"]!=1?"readonly":"");?> name="grade_q2[]" id="grade_q2[]" type="number" style="width: 75px; height=30px;" max="100" min="60" class="form-control"  value="<?php echo ($dataGrade1['grade_q2']<60?"":$dataGrade1['grade_q2']);?>"></td>
						<td><input <?php echo($dataGrade1['grade_q3']>59 && $_SESSION["user_role"]!=1?"readonly":"");?> <?php echo($dataGrade1['grade_sem']!=12 && $_SESSION["user_role"]!=1?"readonly":"");?> name="grade_q3[]" id="grade_q3[]" type="number" style="width: 75px; height=30px;" max="100" min="60" class="form-control" value="<?php echo ($dataGrade1['grade_q3']<60?"":$dataGrade1['grade_q3']);?>"></td>
						<td><input <?php echo($dataGrade1['grade_q4']>59 && $_SESSION["user_role"]!=1?"readonly":"");?> <?php echo($dataGrade1['grade_sem']!=12 && $_SESSION["user_role"]!=1?"readonly":"");?> name="grade_q4[]" id="grade_q4[]" type="number" style="width: 75px; height=30px;" max="100" min="60" class="form-control" value="<?php echo ($dataGrade1['grade_q4']<60?"":$dataGrade1['grade_q4']);?>"></td>
						<td><!--<input name="grade_final[]" readonly id="grade_final[]" type="number" style="width: 75px; height=30px;" max="100" min="60" class="form-control" value="<?php echo ($dataGrade1['grade_final']<60?"":$dataGrade1['grade_final']);?>">--></td>
						<td><!--<select name="grade_remarks[]" id="grade_remarks[]" class="form-control" readonly>
							<option value="1" <?php echo ($dataGrade1['grade_remarks']==1?"selected":""); ?>>PASSED</option>
							<option value="0" <?php echo ($dataGrade1['grade_remarks']==0?"selected":""); ?>>FAILED</option>
							</select>-->
						</td>
					</tr>
				<?php 
				$i++;
				} }?>
					<tr>	
						<?php
						$resultGrade2 = dbquery("SELECT * FROM grade INNER JOIN student ON grade.grade_stud_no=student.stud_no inner join users on grade_lastuser_no=user_no WHERE grade.grade_class_no='".$_GET['class_no']."' ORDER BY stud_gender DESC, stud_lname ASC, stud_fname ASC");
						$dataGrade2 = dbarray($resultGrade2);
						?>
						<td colspan="9"><i>Last modified by <strong><small><?php echo (isset($dataGrade2['user_fullname']) ? $dataGrade2['user_fullname'] : "N/A");?></strong></small> on <strong><small><?php echo $mysqldate = (isset($dataGrade2['grade_lastupdated']) ? date('F d, Y h:ia', strtotime($dataGrade2['grade_lastupdated']) + 8.0 * 3600) : "N/A");?></strong></small></i></td>
					</tr>
				</tbody>
			</table>
		</div>
     </div></div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')">Save</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	</form>
</div>