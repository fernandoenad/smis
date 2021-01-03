<?php
session_start();
require ('maincore.php');


if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$AddSubjects = $_POST['AddSubjects'];
	for($i=0; $i<sizeof($AddSubjects);$i++){
		$resultEnroll = dbquery("INSERT INTO grade (grade_no, grade_sy, grade_sem, grade_class_no, grade_stud_no) VALUES ('','".$current_sy."', '".$_POST['curr_sem']."','".$AddSubjects[$i]."','".$_POST['stud_no']."')");
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

?>
	
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<?php
		$checkName = dbquery("SELECT * FROM student INNER JOIN studenroll ON stud_no=enrol_stud_no WHERE (stud_no='".$_GET['enrol_stud_no']."' and enrol_sy='".$current_sy."')");
		$dataName = dbarray($checkName);
		$checkSection = dbquery("select * from section where (section_name='".$dataName['enrol_section']."' and section_sy='".$current_sy."') ");
		$dataSection =  dbarray($checkSection);
		$countName = dbrows($checkName );
		
		?>
        <h4 class="modal-title">Add Subjects for <?php echo $dataName['stud_lname'].", ".$dataName['stud_fname'];?> for SY <?php echo $current_sy;?>-<?php echo $current_sy+1;?></h4>
      </div>
	  <form name="form1" method="post" action="addSubsCurrent.frm.php?Save=Yes">
	  <input type="hidden" id="user_name" name="stud_no" maxlength="15" required="required" class="form-control" value="<?php echo $dataName['stud_no'];?>" / autofocus>
	  
      <div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
				<div class="table-responsive">
				
	<table width="100%" class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
		<thead>
			<tr>
				<th align="left" width="5%"><u>Add</th>
				<th align="left" width="20%"><u>Class</th>
				<th align="left"><u>Descriptive Title</th>
				<th align="right" width="3%"><u>Units</th>
				<th align="left" width="15%"><u>Time</th>
				<th align="left" width="15%"><u>Days</th>
				<th align="left" width="15%"><u>Room</th>
				
	
			</tr>
		</thead>
		<tbody> 
			<?php	
			$curr_sem = ($dataName['enrol_level']>10?$current_sem:12);
			//$curr_sem = $current_sem;
			if($dataName['enrol_level']>10){
				$checkClasses = dbquery("select * from class inner join prospectus on class_pros_no=pros_no inner join section on class_section_no=section_no where (class_sy='".$current_sy."' and pros_level>'10' and class_sem='".$curr_sem."') order by pros_sem asc, pros_title asc");
			}
			else {
				$checkClasses = dbquery("select * from class inner join prospectus on class_pros_no=pros_no inner join section on class_section_no=section_no where (class_sy='".$current_sy."' and pros_level='".$dataName['enrol_level']."' and class_sem='".$curr_sem."' and class_section_no='".$dataSection['section_no']."') order by pros_sort asc");		
			}
			while($dataClasses = dbarray($checkClasses)){
				
			?>													
				<tr>
				<?php
					$checkGrade = dbquery("select * from grade inner join class on grade_class_no=class_no where (class_pros_no='".$dataClasses['pros_no']."' and grade_stud_no='".$dataName['stud_no']."' and class_sy='".$current_sy."')");
					$countCheckSubStatus = dbrows($checkGrade);
				?>
					<input type="hidden" id="user_name" name="curr_sem" maxlength="15" required="required" class="form-control" value="<?php echo $curr_sem;?>" / autofocus>
					<td><input type="checkbox"  <?php echo ($countCheckSubStatus>0?"checked disabled":"");?>  name="AddSubjects[]" value="<?php echo $dataClasses['class_no'];?>"></td>
					<td><small><small><?php echo $dataClasses['pros_title'];?> (<?php echo $dataClasses['section_name'];?>)</small></small></td>
					<td><small><small><?php echo substr($dataClasses['pros_desc'],0,35);?>... </small></small></td>
					<td><small><small><?php echo $dataClasses['pros_unit'];?></small></small></td>
					<td><small><small><?php echo $dataClasses['class_timeslots'];?></small></small></td>
					<td><small><small><?php echo $dataClasses['class_days'];?></small></small></td>
					<td><small><small><?php echo $dataClasses['class_room'];?></small></small></td>
				</tr>
			<?php 
			}
			?>	
		</tbody>
	</table>
	</div>
				</div>
			</div>
		</div>
      <div class="modal-footer">
		<button type="submit" id="submit" name="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to enroll students to these subjects?')" >Enroll</button>
        <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	  </form>
	</div>
