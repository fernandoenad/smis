<?php
require ("maincore.php");
$resultStudent = dbquery("SELECT * FROM grade INNER JOIN student ON student.stud_no=grade.grade_stud_no INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE grade.grade_no='".$_GET['grade_no']."'");
$dataStudent = dbarray($resultStudent);
?>

<link rel="stylesheet" href="./assets/css/style.css">
<link href="./assets/css/bootstrap.css" rel="stylesheet">
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Update Grades for <?php echo $dataStudent['pros_title'];?>, SY: <?php echo $dataStudent['grade_sy'];?>-<?php echo $dataStudent['grade_sy']+1;?>, <?php echo ($dataStudent['grade_sem']==1?"First Semester":($dataStudent['grade_sem']==2?"Second Semester":"Full Year"));?> </h4>
    </div>
	<form method="post" action="inputgrades.scr.php?UpdateRemedialGrades=Yes">
	<div class="modal-body">
	<div class="panel panel-default">
    <div class="panel-heading"></div>
	<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped table-sticky">
				<thead>
					<tr>
						<th width="3%">#</th>
						<th width="25%">Learner</th>
						<th width="8%">Final</th>
						<th width="8%">Remedial Class Mark</th>
						<th width="8%">Recomputed Final Grade</th>
						<th width="14%">Remarks</th>
					</tr>
				</thead>
				<tbody>
					<input type="hidden" id="grade_no" name="grade_no" required="required" class=" form-control" value="<?php echo $dataStudent['grade_no'];?>">
					<tr><td>1</td>
						<td><small><?php echo $dataStudent['stud_lname'].", ".$dataStudent['stud_fname']." ".$dataStudent['stud_xname']." ".substr($dataStudent['stud_mname'],0,1);?></small></td>
						<td><input name="grade_final" id="grade_final" name="total" class="form-control" type="number" readonly="readonly" value="<?php echo $dataStudent['grade_final'];?>"></td>
						<td><input name="grade_remedialgrade" id="grade_remedialgrade" type="number" class="form-control" onkeyup="updateChange(this);" onChange="updateChange(this);" max="100" min="60" value="<?php echo $dataStudent['grade_remedialgrade'];?>"></td>
						<td><input name="grade_recomputedfinalgrade" id="grade_recomputedfinalgrade" type="number" class="form-control" readonly="readonly" value="<?php echo $dataStudent['grade_recomputedfinalgrade'];?>"></td>
						<td><select name="grade_finalremarks" id="grade_finalremarks" class="form-control" readonly>
							<option value="1" <?php echo ($dataStudent['grade_finalremarks']==1?"selected":""); ?>>PASSED</option>
							<option value="0" <?php echo ($dataStudent['grade_finalremarks']==0?"selected":""); ?>>FAILED</option>
							</select>
						</td>
					</tr>
					<tr>
					<?php 
						$fulltext = $dataStudent['grade_notes'];
						$len = strlen($fulltext);
						$pos_from = strpos($fulltext,"From:");
						$pos_from = $pos_from+5;
						$from = substr($fulltext,$pos_from,10);
						$pos_to= strpos($fulltext,"To:");
						$pos_to = $pos_to+3;
						$to = substr($fulltext,$pos_to,10);
						$pos_from = strpos($fulltext,"From:");
						$school = trim(substr($fulltext,0,$pos_from));

						
					
					?>
						<th colspan="2">Venue:<input name="grade_notes1" required="required" id="grade_notes[]" type="text" style="width: 320px; height=30px;" max="100" min="60" class="form-control" value="<?php echo $school;?>" placeholder="San Agustin NHS - Sagbayan, Bohol"></th>
						<th colspan="2">From:<input name="grade_notes2" required="required" id="grade_notes[]" type="date" style="width: 200px; height=30px;" max="100" min="60" class="form-control" value="<?php echo $from;?>" placeholder=""></th>
						<th colspan="2">To:<input name="grade_notes3" required="required" id="grade_notes[]" type="date" style="width: 200px; height=30px;" max="100" min="60" class="form-control" value="<?php echo $to;?>" placeholder=""></th>
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


<script type="text/javascript">
var changes = 0;

function updateChange(element){
		changes = parseInt(document.getElementById('grade_final').value) + parseInt(document.getElementById('grade_remedialgrade').value);
		changes = Math.round(changes/2);
		document.getElementById('grade_recomputedfinalgrade').value = changes;
		if(changes>=75){
			document.getElementById('grade_finalremarks').value = 1;
		}
		else{
			document.getElementById('grade_finalremarks').value = 0;
		}
       
    }
</script>