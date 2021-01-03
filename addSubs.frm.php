<?php
session_start();
require ('maincore.php');


if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$AddSubjects = $_POST['2ndSemSubs'];
	for($i=0; $i<sizeof($AddSubjects);$i++){
		$resultEnroll = dbquery("INSERT INTO grade (grade_no, grade_sy, grade_class_no, grade_stud_no) VALUES ('','".$current_sy."','".$AddSubjects[$i]."','".$_POST['stud_no']."')");
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
if(isset($_GET['SaveSubs']) && $_GET['SaveSubs']="Yes"){
	$AddSubjects = $_POST['AddSubjects'];
	for($i=0; $i<sizeof($AddSubjects);$i++){
		$resultCheckClass = dbquery("select * from class where (class_section_no='0' and class_sy='".$_POST['enrol_sy']."' and class_sem='".$_POST['enrol_sem']."' and class_pros_no='".$AddSubjects[$i]."')");
		$countCheckClass = dbrows($resultCheckClass);
		if($countCheckClass==0){
			$resultCreateClass = dbquery("INSERT INTO class (class_no, class_sy, class_sem, class_pros_no, class_section_no, class_user_name) VALUES ('','".$_POST['enrol_sy']."','".$_POST['enrol_sem']."', '".$AddSubjects[$i]."','0','1')");
		}
		$resultCheckClass = dbquery("select * from class where (class_section_no='0' and class_sy='".$_POST['enrol_sy']."' and class_sem='".$_POST['enrol_sem']."' and class_pros_no='".$AddSubjects[$i]."')");	
		$dataGetClass = dbarray($resultCheckClass);
		$insertToGrade = dbquery("INSERT INTO grade (grade_no, grade_sy, grade_sem, grade_class_no, grade_stud_no) VALUES ('','".$_POST['enrol_sy']."', '".$_POST['enrol_sem']."','".$dataGetClass['class_no']."','".$_POST['stud_no']."')");
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

?>
	
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<?php
		$checkName = dbquery("SELECT * FROM student INNER JOIN studenroll ON stud_no=enrol_stud_no WHERE (stud_no='".$_GET['enrol_stud_no']."' and enrol_sy='".$_GET['enrol_sy']."' and enrol_level='".$_GET['enrol_level']."')");
		$dataName = dbarray($checkName);
		$countName = dbrows($checkName );
		
		?>
        <h4 class="modal-title">Add Subjects for <?php echo $dataName['stud_lname'].", ".$dataName['stud_fname'];?></h4>
      </div>
	  <form name="form1" method="post" action="addSubs.frm.php?SaveSubs=Yes">
	  <?php
	  $phpdate = date("Y-m-d h:i:s");
	  ?>
	  <input type="hidden" id="user_name" name="stud_no" maxlength="15" required="required" class="form-control" value="<?php echo $dataName['stud_no'];?>" / autofocus>
	  <input type="hidden" id="enrol_sy" name="enrol_sy" maxlength="15" required="required" class="form-control" value="<?php echo $dataName['enrol_sy'];?>" / autofocus>
      <div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
				<div class="table-responsive">
				<b>for Grade <?php echo $dataName['enrol_level'];?>, SY <?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?></b><br><br>
				<label class="control-label required" for="stud_lrn">Semester: <span title="Required" class="text-danger">*</span></label>
				 <select name="enrol_sem" class="form-control">
					<?php 
					if($_GET['enrol_level']<11){
					?>
						<option value="12">Full Year</option>
					<?php
					}
					else {
					?>
						<option value="1" <?php echo ($_GET['enrol_sem']==1?"selected":"");?>>First Sem</option>
						<option value="2" <?php echo ($_GET['enrol_sem']==2?"selected":"");?>>Second Sem</option>
					<?php
					}
					?>
				</select><br>
				
	<table width="100%" class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
		<thead>
			<tr>
				<th align="left" width="5%"><u>Add</th>
				<th align="left" width="30%"><u>Code</th>
				<th align="left" width="5%"><u>Unit(s)</th>
				<th align="left" width="20%"><u>Remarks</th>
				<th align="left"><u>Description</th>
				
	
			</tr>
		</thead>
		<tbody> 
			<?php	
			$curr_year = ($_GET['enrol_sy']<2012?1994:2012);
			if($_GET['enrol_level']<11){
				$checkSubjects = dbquery("SELECT * FROM prospectus where (pros_level='".$_GET['enrol_level']."' and  pros_curr='".$curr_year."') ORDER BY pros_level ASC, pros_sort ASC");
			}
			else{
				$checkSubjects = dbquery("SELECT * FROM prospectus where (pros_level>10 and  pros_curr='".$curr_year."') ORDER BY pros_level ASC, pros_track ASC, pros_sort ASC");			
			}			
			while($dataSubjects = dbarray($checkSubjects)){
				$countCheckSubStatus=0;
				$resultCheckSubStatus = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['enrol_stud_no']."' and class_pros_no='".$dataSubjects['pros_no']."') ORDER BY grade_no DESC");
				$countCheckSubStatus = dbrows($resultCheckSubStatus);
				$dataCheckSubStatus = dbarray($resultCheckSubStatus );
			?>													
				<tr>
					<td><input type="checkbox"  <?php echo (isset($_GET['all'])?"checked":($countCheckSubStatus>0?"checked disabled":""));?>  name="AddSubjects[]" value="<?php echo $dataSubjects['pros_no'];?>"></td>
					<td><small><?php echo $dataSubjects['pros_title'];?> (<?php echo $dataSubjects['pros_track'];?>)</small></td>
					<td><small><?php echo $dataSubjects['pros_unit'];?> </small></td>
					<td><?php echo ($countCheckSubStatus>0?($dataCheckSubStatus['grade_remarks']==""?"Already Taken":$dataCheckSubStatus['grade_remarks']):"Available");?></td>					
					<td><?php echo substr($dataSubjects['pros_desc'],0,30);?>...</td>
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
