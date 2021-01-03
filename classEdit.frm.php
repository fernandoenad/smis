<?php
session_start();
require ('maincore.php');
if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$updateClass = dbquery("UPDATE grade SET grade_class_no='".$_POST['class_no']."' WHERE  grade_no='".$_POST['grade_no']."' ");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

$resultGrade = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_no='".$_GET['grade_no']."' AND grade.grade_sy='".$current_sy."') ORDER BY class_timeslots ASC");
$dataGrade = dbarray($resultGrade);
?>
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update TLE Major/ Current: <?php echo $dataGrade['pros_title'];?> </h4>
      </div>
	  <form name="form1" method="post" action="classEdit.frm.php?Save=Yes">
	  <input type="hidden" id="user_name" name="user_name" maxlength="15" required="required" class="form-control" value="<?php echo $_SESSION["user_name"];?>">
	  <input type="hidden" id="user_name" name="grade_no" maxlength="15" required="required" class="form-control" value="<?php echo $_GET['grade_no'];?>"		>
      <div class="modal-body">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">New Major <span title="Required" class="text-danger">*</span></label>
							<select name="class_no" class="form-control" required>
							<option value="">---select---</option>
							<?php 
							$selectSY = dbquery("SELECT * FROM class INNER JOIN prospectus ON pros_no=class_pros_no INNER JOIN users ON class_user_name=user_no WHERE (pros_level='".$dataGrade['pros_level']."' AND (pros_title='".$dataGrade['pros_title']."') AND class_sy='".$current_sy."' AND class_sem='".$_GET['sem']."') ORDER BY user_fullname ASC");
							while($dataSY = dbarray($selectSY)){
								$checkClassCap = dbquery("select * from section where section_no='".$dataSY['class_section_no']."'");
								$dataClassCap = dbarray($checkClassCap);
								$checkClassSize = dbquery("select * from grade inner join class on grade_class_no=class_no where (grade_sy='".$current_sy."' and class_no='".$dataSY['class_no']."')");
								$countClassSize = dbrows($checkClassSize);
							?>
								<option value="<?php echo $dataSY['class_no'];?>" <?php echo ($dataSY['class_no']==$dataGrade['grade_class_no']?"selected":"");?> ><?php echo $dataSY['pros_title']." (".($dataSY['user_no']==1?"TBA":$dataSY['class_timeslots']." / ".$dataSY['user_fullname']).")";?> - <?php echo $dataSY['class_room'];?> (<?php echo $countClassSize."/".$dataClassCap['section_cap'];?>)</option>
							<?php	
							}
							?>
						</select>
						</div>
					</div>
				</div>		
	  </div>
      <div class="modal-footer">
		<button type="submit" id="submit" name="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')" >Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	  </form>
    </div>
