<?php
session_start();
require ('maincore.php');

if(isset($_GET['Edit']) && $_GET['Edit']="Yes"){
	$updateSpouse = dbquery("update teachercontacts set 
	teachCont_fname='".$_POST['teachCont_fname']."', 
	teachCont_mname='".$_POST['teachCont_mname']."', 
	teachCont_lname='".$_POST['teachCont_lname']."', 
	teachCont_xname='".$_POST['teachCont_xname']."', 
	teachCont_bdate='".$_POST['teachCont_bdate']."', 
	teachCont_moduser='".$_SESSION["userid"]."',
	teachCont_moddatetime=NOW()
	where teachCont_no='".$_POST['teachCont_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}


if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$insertDependent = dbquery("insert into teachercontacts(teachCont_teach_no, teachCont_type, teachCont_fname, teachCont_mname, teachCont_lname, teachCont_xname, teachCont_bdate, teachCont_moduser, teachCont_moddatetime) 
	values('".$_POST['teachCont_teach_no']."', '2', '".$_POST['teachCont_fname']."', '".$_POST['teachCont_mname']."', '".$_POST['teachCont_lname']."', '".$_POST['teachCont_xname']."', '".$_POST['teachCont_bdate']."', '".$_SESSION["userid"]."', NOW())"); 
	$updateSALN = dbquery("update teachsaln set teachSaln_status='2', teachSaln_moduser='".$_SESSION["userid"]."', teachSaln_moddatetime=NOW() where teachSaln_no='".$_GET['edit']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['editDependent']) &&  $_GET['editDependent']!=0){
	$checkDependent = dbquery("select * from teachercontacts where teachCont_no='".$_GET['editDependent']."'");
	$dataDependent = dbarray($checkDependent);
} else {
	$dataDependent = null;
}
?>
<!-- Modal content-->
<div class="modal-content">

	<!-- the header -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"><?php echo (isset($_GET['edit'])?"Modify":"Add");?> Dependent</h4>
	</div>
  
	<!-- the body -->
	<form name="form1" method="post" action="teacherSALNeditAddDependent.frm.php?<?php echo(isset($_GET['edit'])?"Edit":"Save");?>=Yes&edit=<?php echo (isset($_GET['edit']) ? $_GET['edit'] : "");?>">
		<input type="hidden" id="user_name" name="teachCont_no" maxlength="15" required="required" class="form-control" value="<?php echo (isset($_GET['editDependent']) ? $_GET['editDependent'] : 0);?>">
	<div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_fname">First name <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_actual_fname" name="teachCont_fname"  required="required" class=" form-control" value="<?php echo $dataDependent['teachCont_fname'];?>" style="text-transform:uppercase;"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_mname">Middle name <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_actual_mname" name="teachCont_mname" required="required" class=" form-control" value="<?php echo $dataDependent['teachCont_mname'];?>" style="text-transform:uppercase;"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Last name <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_actual_lname" name="teachCont_lname" required="required" class=" form-control" value="<?php echo $dataDependent['teachCont_lname'];?>" style="text-transform:uppercase;"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label" for="enrol_actual_xname">Ext name</label>
						<select id="enrol_actual_xname" name="teachCont_xname" class="form-control">
						<?php
						$checkExt = dbquery("select * from dropdowns where field_category='FIELD_EXT' order by field_name asc");
						while($dataExt = dbarray($checkExt)){
						?>
							<option value="<?php echo $dataExt['field_name'];?>" <?php echo ($dataExt['field_name']==$dataDependent['teachCont_xname']?"selected":"");?>><?php echo ($dataExt['field_name']==""?"NONE":$dataExt['field_name']);?></option>
						<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_fname">Date of Birth <span title="Required" class="text-danger">*</span></label>
						<input type="date" id="enrol_actual_fname" name="teachCont_bdate"  required="required" class=" form-control" value="<?php echo $dataDependent['teachCont_bdate'];?>" style="text-transform:uppercase;"/>
					</div>
				</div>
			</div>
		</div>		
	</div>
	<!-- the footer -->
	<div class="modal-footer">
		<button type="submit" id="submit" name="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')" >Save</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	</form>
</div>
