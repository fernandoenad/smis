<?php
session_start();
require ('maincore.php');


if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$AddSubjects = $_POST['2ndSemSubs'];
	for($i=0; $i<sizeof($AddSubjects);$i++){
		$resultEnroll = dbquery("INSERT INTO grade (grade_no, grade_sy, grade_sem, grade_class_no, grade_stud_no) VALUES ('','".$current_sy."','2','".$AddSubjects[$i]."','".$_POST['stud_no']."')");
	}
	$udpateEnrol2ndSem = dbquery("update studenroll set enrol_admitdate2=NOW(), enrol_updatedate=NOW(), enrol_username='".$_SESSION["userid"]."' where (enrol_sy='".$current_sy."' and enrol_stud_no='".$_POST['stud_no']."')");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

?>
	
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()">&times;</button>
		<?php
		$checkName = dbquery("SELECT * FROM student INNER JOIN studenroll ON stud_no=enrol_stud_no WHERE (stud_no='".$_GET['stud_no']."' and enrol_sy='".$current_sy."')");
		$dataName = dbarray($checkName);
		$countName = dbrows($checkName );
		
		?>
        <h4 class="modal-title">Add 2nd Sem Subjects for <?php echo $dataName['stud_lname'].", ".$dataName['stud_fname'];?></h4>
      </div>
	  <form name="form1" method="post" action="add2ndSemSubs.frm.php?Save=Yes">
	  <?php
	  $phpdate = date("Y-m-d h:i:s");
	  ?>
	  <input type="hidden" id="user_name" name="stud_no" maxlength="15" required="required" class="form-control" value="<?php echo $dataName['stud_no'];?>" / autofocus>
      <div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
				<div class="table-responsive">
				Grade <?php echo $dataName['enrol_level'];?>, 2nd Semester Subjects for SY <?php echo $current_sy;?>-<?php echo $current_sy+1;?>
				
	<table width="100%" class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
		<thead>
			<tr>
				<th align="left" width="5%"><u>Add</th>
				<th align="left" width="35%"><u>Code</th>
				<th align="left"><u>Description</th>
	
			</tr>
		</thead>
		<tbody> 
			<?php
			$checkSectionNo = dbquery("SELECT * FROM section WHERE (section_name='".$dataName['enrol_section']."' and section_sy='".$current_sy."')");
			$dataSectionNo = dbarray($checkSectionNo);
			
			$checkSubjects = dbquery("SELECT * FROM class INNER JOIN prospectus ON class_pros_no=pros_no WHERE (class_sy='".$current_sy."' AND class_section_no='".$dataSectionNo['section_no']."' AND class_sem='2')");
			while($dataSubjects = dbarray($checkSubjects)){
			if(substr($dataSubjects['pros_title'],0,3)!="***"){
			?>													
				<tr>
					<td><input checked type="checkbox"  name="2ndSemSubs[]" value="<?php echo $dataSubjects['class_no'];?>"></td>
					<td><small><?php echo $dataSubjects['pros_title']." (".$dataName['enrol_section'].")";?></small></td>
					<td><?php echo substr($dataSubjects['pros_desc'],0,45);?>...</td>
				</tr>
			<?php 
			} 
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
        <button type="button"  class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
      </div>
	  </form>
	</div>
