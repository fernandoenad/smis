<?php
session_start();
require ('maincore.php');

if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$teachSalnDet_details = array($_POST['PPdescription'],$_POST['PPyearacquisition']);
	$teachSalnDet_details_string = mysqli_real_escape_string($conn, serialize($teachSalnDet_details));
	$insertRealProperty = dbquery("insert into teachsalndetails(teachSalnDet_teachSaln_no, teachSalnDet_type, teachSalnDet_details, teachSalnDet_cost) 
		values('".$_POST['teachSaln_no']."', '2', '".$teachSalnDet_details_string."', '".$_POST['teachSalnDet_cost']."' )");
	$updateSALN = dbquery("update teachsaln set teachSaln_status='2', teachSaln_moduser='".$_SESSION["userid"]."', teachSaln_moddatetime=NOW() where teachSaln_no='".$_POST['teachSaln_no']."'");

	header("Location: ".$_SERVER['HTTP_REFERER']);
} 

if(isset($_GET['Edit']) && $_GET['Edit']="Yes"){
	$teachSalnDet_details = array($_POST['PPdescription'],$_POST['PPyearacquisition']);
	$teachSalnDet_details_string = mysqli_real_escape_string($conn, serialize($teachSalnDet_details));;
	$insertRealProperty = dbquery("update teachsalndetails set teachSalnDet_details='".$teachSalnDet_details_string."', teachSalnDet_cost='".$_POST['teachSalnDet_cost']."' where teachSalnDet_no='".$_POST['teachSalnDet_no']."'");
	$updateSALN = dbquery("update teachsaln set teachSaln_status='2', teachSaln_moduser='".$_SESSION["userid"]."', teachSaln_moddatetime=NOW() where teachSaln_no='".$_POST['teachSaln_no']."'");
	
	header("Location: ".$_SERVER['HTTP_REFERER']);
} 

if(isset($_GET['editPersonalProperty']) and $_GET['editPersonalProperty']!=0){
	$checkRealProperty = dbquery("select * from teachsalndetails where teachSalnDet_no='".$_GET['editPersonalProperty']."'");
	$dataRealProperty = dbarray($checkRealProperty);
	$dataRealPropertyArray = unserialize($dataRealProperty['teachSalnDet_details']);
} else {
	$dataRealProperty = null;
	$dataRealPropertyArray = null;
}
?>
<!-- Modal content-->
<div class="modal-content">

	<!-- the header -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"><?php echo (isset($_GET['editPersonalProperty'])?"Modify":"Add");?> Personal Properties</h4>
	</div>
  
	<!-- the body -->
	<form name="form1" method="post" action="teacherSALNeditAddAssetsPP.frm.php?<?php echo(isset($_GET['editPersonalProperty'])?"Edit":"Save");?>=Yes">
		<input type="hidden" id="user_name" name="teachSaln_no" maxlength="15" required="required" class="form-control" value="<?php echo $_GET['edit'];?>">
		<input type="hidden" id="user_name" name="teachSalnDet_no" maxlength="15" required="required" class="form-control" value="<?php echo (isset($_GET['editPersonalProperty']) ? $_GET['editPersonalProperty'] : "");?>">
	<div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Description <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_actual_lname" name="PPdescription" required="required" class=" form-control" value="<?php echo (isset($dataRealPropertyArray['0']) ? $dataRealPropertyArray['0'] : "");?>" style="text-transform:uppercase;"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Year Acquired  <span title="Required" class="text-danger">*</span></label>
						<select name="PPyearacquisition" class="form-control" required>
							<option value="">---select---</option>
							<?php
							for($year=date("Y");$year>=date("Y")-100;$year--){
							?>
								<option value="<?php echo $year;?>" <?php echo (isset($dataRealPropertyArray['1']) && $dataRealPropertyArray['1']==$year?"selected":"");?>><?php echo $year;?></option>
							<?php }?>
						</select>					
					</div>
				</div>
			</div>
			<div class="row">	
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Acquisition Cost / Amount <span title="Required" class="text-danger">*</span></label>
						<input type="number" step="0.01" id="enrol_actual_lname" name="teachSalnDet_cost" required="required" class=" form-control" value="<?php echo (isset($dataRealProperty['teachSalnDet_cost']) ? $dataRealProperty['teachSalnDet_cost'] : "");?>" style="text-transform:uppercase;"/>
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
