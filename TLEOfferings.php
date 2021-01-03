<?php
require ("maincore.php");
$resultStudent = dbquery("SELECT * FROM class JOIN prospectus ON class_pros_no=pros_no inner join teacher on class_user_name=teach_no inner join section on class_section_no=section_no WHERE (class_sy='".$current_sy."' and pros_level>=9) order by pros_level asc, teach_lname asc");

?>

<link rel="stylesheet" href="./assets/css/style.css">
<link href="./assets/css/bootstrap.css" rel="stylesheet">
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Grade 9 and 10 TLE Offerings</h4>
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
						<th width="15%">Course Name</th>
						<th>Teacher</th>
						<th width="18%">Room</th>
						<th width="20%">Maximum</th>
						<th width="20%">Current</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=1;
					while ($dataStudent = dbarray($resultStudent)){
						if (substr($dataStudent['pros_title'],0,3)=="TLE"){
							$checkStudents = dbquery("select * from grade where grade_class_no='".$dataStudent['class_no']."'");
							$countStudents = dbrows($checkStudents );
					
					
					?>
					<tr><td><?php echo $i;?></td>
						<td><?php echo $dataStudent['pros_title'];?></td>
						<td><?php echo $dataStudent['teach_lname'];?>, <?php echo substr($dataStudent['teach_lname'],0,1);?>. </td>
						<td><?php echo $dataStudent['class_room'];?></td>
						<td align="center"><?php echo $dataStudent['section_cap'];?></td>
						<td align="center"><a href="#" onclick="window.open('showForm2d.php?class_no=<?php echo $dataStudent['class_no'];?>&enrol_sy=<?php echo $current_sy;?>', 'newwindow', 'width=800, height=600');"><?php echo $countStudents;?></a></td>
					</tr>
					<?php
						$i++;
						}
					}
					?>
				</tbody>
			</table>
		</div>
     </div></div>
	<div class="modal-footer">
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