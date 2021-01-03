<?php
session_start();
require ('maincore.php');
if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$updateSpouse = dbquery("update teachercontacts set 
	teachCont_fname='".$_POST['teachCont_fname']."', 
	teachCont_mname='".$_POST['teachCont_mname']."', 
	teachCont_lname='".$_POST['teachCont_lname']."', 
	teachCont_xname='".$_POST['teachCont_xname']."', 
	teachCont_position='".$_POST['teachCont_position']."', 
	teachCont_office='".$_POST['teachCont_office']."', 
	teachCont_offadd='".$_POST['teachCont_offadd']."', 
	teachCont_govid='".$_POST['teachCont_govid']."',
	teachCont_idno='".$_POST['teachCont_idno']."',
	teachCont_issuedate='".$_POST['teachCont_issuedate']."',
	teachCont_moduser='".$_SESSION["userid"]."',
	teachCont_moddatetime=NOW()
	where teachCont_no='".$_POST['teachCont_no']."'");
	$updateSALN = dbquery("update teachsaln set teachSaln_status='2', teachSaln_moduser='".$_SESSION["userid"]."', teachSaln_moddatetime=NOW() where teachSaln_no='".$_GET['edit']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['delete']) && $_GET['delete']=="Yes"){
	$insertSpouse = dbquery("delete from teachercontacts where teachCont_no='".$_GET['editSpouse']."'");
	$updateSALN = dbquery("update teachsaln set teachSaln_status='2', teachSaln_moduser='".$_SESSION["userid"]."', teachSaln_moddatetime=NOW() where teachSaln_no='".$_GET['edit']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
} 

if(isset($_GET['editSpouse']) && $_GET['editSpouse']==""){
	$insertSpouse = dbquery("insert into teachercontacts(teachCont_teach_no, teachCont_type) values('".$_GET['editSALN']."','1')");
	$updateSALN = dbquery("update teachsaln set teachSaln_status='2', teachSaln_moduser='".$_SESSION["userid"]."', teachSaln_moddatetime=NOW() where teachSaln_no='".$_GET['edit']."'");
} 
$checkSpouse = dbquery("SELECT * FROM teachercontacts inner join teacher on teachCont_teach_no=teach_no where (teachCont_teach_no='".$_GET['editSALN']."' and teachCont_type='1')");
$dataSpouse = dbarray($checkSpouse);
?>
<!-- Modal content-->
<div class="modal-content">

	<!-- the header -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Update Spouse Information</h4>
	</div>
  
	<!-- the body -->
	<form name="form1" method="post" action="teacherSALNeditSpouse.frm.php?Save=Yes&edit=<?php echo $_GET['edit'];?>">
		<input type="hidden" id="user_name" name="teachCont_no" maxlength="15" required="required" class="form-control" value="<?php echo $dataSpouse['teachCont_no'];?>">
		<input type="hidden" id="user_name" name="teachCont_teach_no" maxlength="15" required="required" class="form-control" value="<?php echo $dataSpouse['teachCont_teach_no'];?>">
	<div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_fname">First name <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_actual_fname" name="teachCont_fname"  required="required" class=" form-control" value="<?php echo $dataSpouse['teachCont_fname'];?>" style="text-transform:uppercase;"/>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_mname">Middle name <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_actual_mname" name="teachCont_mname" required="required" class=" form-control" value="<?php echo $dataSpouse['teachCont_mname'];?>" style="text-transform:uppercase;"/>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Last name <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_actual_lname" name="teachCont_lname" required="required" class=" form-control" value="<?php echo $dataSpouse['teachCont_lname'];?>" style="text-transform:uppercase;"/>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label" for="enrol_actual_xname">Ext name</label>
						<select id="enrol_actual_xname" name="teachCont_xname" class="form-control">
						<?php
						$checkExt = dbquery("select * from dropdowns where field_category='FIELD_EXT' order by field_name asc");
						while($dataExt = dbarray($checkExt)){
						?>
							<option value="<?php echo $dataExt['field_name'];?>" <?php echo ($dataExt['field_name']==$dataSpouse['teachCont_xname']?"selected":"");?>><?php echo ($dataExt['field_name']==""?"NONE":$dataExt['field_name']);?></option>
						<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_fname">Working in Government? <span title="Required" class="text-danger">*</span></label>
						<select id="workingovt" name="workingovt" required="required" onChange="updateChange(this);"  class=" form-control">
							<option value="" >---select---</option>
							<option value="1" <?php echo ($dataSpouse['teachCont_position']==""?"":"selected");?>>Yes</option>
							<option value="0" <?php echo ($dataSpouse['teachCont_position']==""?"selected":"");?>>No</option>
						</select>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_fname">Position </label>
						<input type="text" id="teachCont_position" name="teachCont_position" <?php echo ($dataSpouse['teachCont_position']==""?"readonly":"");?> required="required" class=" form-control" value="<?php echo $dataSpouse['teachCont_position'];?>" style="text-transform:uppercase;"/>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_mname">Office / Agency </label>
						<input type="text" id="teachCont_office" name="teachCont_office" <?php echo ($dataSpouse['teachCont_position']==""?"readonly":"");?> required="required" class=" form-control" value="<?php echo $dataSpouse['teachCont_office'];?>" style="text-transform:uppercase;"/>
					</div>
				</div>
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Work Address <span title="Required" class="text-danger">*</span></label><i>(Barangay, Municipality / City, Province)</i>
						<input type="text" id="teachCont_offadd" name="teachCont_offadd" <?php echo ($dataSpouse['teachCont_position']==""?"readonly":"");?> required="required" class=" form-control" value="<?php echo $dataSpouse['teachCont_offadd'];?>" style="text-transform:uppercase;"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_fname">Gov't ID </label>
						<select id="teachCont_govid" name="teachCont_govid" class="form-control" <?php echo ($dataSpouse['teachCont_position']==""?"readonly":"");?> required="required">
							<option value="">---select---</option>
						<?php
						$checkExt = dbquery("select * from dropdowns where field_category='TEACHERIDS' order by field_name asc");
						while($dataExt = dbarray($checkExt)){
						?>
							<option value="<?php echo $dataExt['field_name'];?>" <?php echo ($dataExt['field_name']==$dataSpouse['teachCont_govid']?"selected":"");?>><?php echo $dataExt['field_name'];?></option>
						<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_mname">ID Number </label>
						<input type="text" id="teachCont_idno" name="teachCont_idno" class=" form-control" <?php echo ($dataSpouse['teachCont_position']==""?"readonly":"");?> required="required" value="<?php echo $dataSpouse['teachCont_idno'];?>" style="text-transform:uppercase;"/>
					</div>
				</div>
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Date Issued </label>
						<input type="date" id="teachCont_issuedate" name="teachCont_issuedate" class=" form-control" <?php echo ($dataSpouse['teachCont_position']==""?"readonly":"");?> required="required" value="<?php echo $dataSpouse['teachCont_issuedate'];?>" style="text-transform:uppercase;"/>
					</div>
				</div>
			</div>
		</div>		
	</div>
	<!-- the footer -->
	<div class="modal-footer">
		<button type="submit" id="submit" name="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')" >Save</button>
		<a href="teacherSALNeditSpouse.frm.php?delete=Yes&editSpouse=<?php echo $_GET['editSpouse'];?>" class="btn btn-danger" onClick="return confirm('Are you sure you want to remove spouse?')">Remove Spouse</a>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	</form>
</div>

<script type="text/javascript">
var workingovt;
function updateChange(element){
		workingovt =  document.getElementById('workingovt').value;
		
		if(workingovt=="1"){
			$("#teachCont_position").removeAttr("readonly");
			$("#teachCont_office").removeAttr("readonly");	
			$("#teachCont_offadd").removeAttr("readonly");
			$("#teachCont_govid").removeAttr("readonly");
			$("#teachCont_idno").removeAttr("readonly");
			$("#teachCont_issuedate").removeAttr("readonly");
		} 
		else if(workingovt=="0") {
			$("#teachCont_position").attr("readonly","readonly");
			$("#teachCont_office").attr("readonly","readonly");	
			$("#teachCont_offadd").attr("readonly","readonly");
			$("#teachCont_govid").attr("readonly","readonly");
			$("#teachCont_idno").attr("readonly","readonly");
			$("#teachCont_issuedate").attr("readonly","readonly");
		} 
	
    }
</script>
