<?php
session_start();
require ("maincore.php");
$resultStudent = dbquery("SELECT * FROM grade INNER JOIN student ON student.stud_no=grade.grade_stud_no INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (student.stud_no='".$_GET['stud_no']."' and grade_sy='".$_GET['enrol_sy']."') ORDER BY pros_sort ASC");
$dataStudent = dbarray($resultStudent);
?>
<link rel="stylesheet" href="./assets/css/style.css">
<link href="./assets/css/bootstrap.css" rel="stylesheet">
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()">&times;</button>
		<h4 class="modal-title">Update Grades for <?php echo strtoupper($dataStudent['stud_lname'].", ".$dataStudent['stud_fname']);?> </h4>
    </div>
	<form method="post" action="inputgrades.scr.php?UpdateGrades=Yes">
	<div class="modal-body">
	<div class="panel panel-default">
    <div class="panel-heading"></div>
	<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped table-sticky">
				<thead>
					<tr>
						<th width="3%">#</th>
						<th>Subject</th>
						<th width="5%">Q1</th>
						<th width="5%">Q2</th>
						<th width="5%">Q3</th>
						<th width="5%">Q4</th>
						<th width="5%">Final</th>
						<th width="14%">Remarks</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$i=1;
				$resultStudent1 = dbquery("SELECT * FROM grade INNER JOIN student ON student.stud_no=grade.grade_stud_no INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (student.stud_no='".$_GET['stud_no']."' and grade_sy='".$_GET['enrol_sy']."' and grade_sem='".$_GET['enrol_sem']."') ORDER BY pros_sort ASC");
				while($dataGrade1 = dbarray($resultStudent1)){
				?>
					<input type="hidden" id="grade_no[]" name="grade_no[]" required="required" class=" form-control" value="<?php echo $dataGrade1['grade_no'];?>">
					<tr><td><?php echo $i;?></td>
						<td><small><?php echo $dataGrade1['pros_title'];?> (<?php echo $dataGrade1['pros_desc'];?>)</small></td>
						<td><input name="grade_q1[]" <?php echo($dataGrade1['grade_q1']>59 && $_SESSION["user_role"]!=1?"readonly":"");?> id="grade_q1[]" type="number" style="width: 75px; height=15px;" max="100" min="60" class="form-control"  value="<?php echo ($dataGrade1['grade_q1']<60?"":$dataGrade1['grade_q1']);?>"></td>
						<td><input name="grade_q2[]" <?php echo($dataGrade1['grade_q2']>59 && $_SESSION["user_role"]!=1?"readonly":"");?> id="grade_q2[]" type="number" style="width: 75px; height=30px;" max="100" min="60" class="form-control"  value="<?php echo ($dataGrade1['grade_q2']<60?"":$dataGrade1['grade_q2']);?>"></td>
						<td><input name="grade_q3[]" <?php echo($dataGrade1['grade_q3']>59 && $_SESSION["user_role"]!=1?"readonly":"");?> id="grade_q3[]" <?php echo($dataGrade1['grade_sem']!=12 && $_SESSION["user_role"]!=1?"readonly":"");?> type="number" style="width: 75px; height=30px;" max="100" min="60" class="form-control" value="<?php echo ($dataGrade1['grade_q3']<60?"":$dataGrade1['grade_q3']);?>"></td>
						<td><input name="grade_q4[]" <?php echo($dataGrade1['grade_q4']>59 && $_SESSION["user_role"]!=1?"readonly":"");?> id="grade_q4[]" <?php echo($dataGrade1['grade_sem']!=12 && $_SESSION["user_role"]!=1?"readonly":"");?> type="number" style="width: 75px; height=30px;" max="100" min="60" class="form-control" value="<?php echo ($dataGrade1['grade_q4']<60?"":$dataGrade1['grade_q4']);?>"></td>
						<td><!--<input name="grade_final[]" readonly id="grade_final[]" type="number" style="width: 75px; height=30px;" max="100" min="60" class="form-control" value="<?php echo ($dataGrade1['grade_final']<60?"":$dataGrade1['grade_final']);?>">--></td>
						<td><!--<select name="grade_remarks[]" id="grade_remarks[]" class="form-control" readonly>
							<option value="1" <?php echo ($dataGrade1['grade_remarks']==1?"selected":""); ?>>PASSED</option>
							<option value="0" <?php echo ($dataGrade1['grade_remarks']==0?"selected":""); ?>>FAILED</option>
							</select>-->
						</td>
					</tr>
				<?php
				$i++;
				}
				?>
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