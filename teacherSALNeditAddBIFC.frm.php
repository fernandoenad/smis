<?php
session_start();
require ('maincore.php');


if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$teachSalnDet_details = array($_POST['bifc_name'],$_POST['bifc_address'],$_POST['bifc_nature'],$_POST['bifc_dateacquisition']);
	$teachSalnDet_details_string = mysqli_real_escape_string($conn, serialize($teachSalnDet_details));;
	$insertRealProperty = dbquery("insert into teachsalndetails(teachSalnDet_teachSaln_no, teachSalnDet_type, teachSalnDet_details) 
		values('".$_POST['teachSaln_no']."', '4', '".$teachSalnDet_details_string."')");
	$updateSALN = dbquery("update teachsaln set teachSaln_status='2', teachSaln_moduser='".$_SESSION["userid"]."', teachSaln_moddatetime=NOW() where teachSaln_no='".$_POST['teachSaln_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['Edit']) && $_GET['Edit']="Yes"){
	$teachSalnDet_details = array($_POST['bifc_name'],$_POST['bifc_address'],$_POST['bifc_nature'],$_POST['bifc_dateacquisition']);
	$teachSalnDet_details_string = mysqli_real_escape_string($conn, serialize($teachSalnDet_details));;
	$insertRealProperty = dbquery("update teachsalndetails set teachSalnDet_details='".$teachSalnDet_details_string."' where teachSalnDet_no='".$_POST['teachSalnDet_no']."'"); 
	$updateSALN = dbquery("update teachsaln set teachSaln_status='2', teachSaln_moduser='".$_SESSION["userid"]."', teachSaln_moddatetime=NOW() where teachSaln_no='".$_POST['teachSaln_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['editBIFC']) and $_GET['editBIFC']!=0){
	$checkRealProperty = dbquery("select * from teachsalndetails where teachSalnDet_no='".$_GET['editBIFC']."'");
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
		<h4 class="modal-title"><?php echo (isset($_GET['editBIFC'])?"Modify":"Add");?> Business Interests and Financial Connections</h4>
	</div>
  
	<!-- the body -->
	<form name="form1" method="post" action="teacherSALNeditAddBIFC.frm.php?<?php echo(isset($_GET['editBIFC'])?"Edit":"Save");?>=Yes">
		<input type="hidden" id="user_name" name="teachSaln_no" maxlength="15" required="required" class="form-control" value="<?php echo $_GET['edit'];?>">
		<input type="hidden" id="user_name" name="teachSalnDet_no" maxlength="15" required="required" class="form-control" value="<?php echo (isset($_GET['editBIFC']) ? $_GET['editBIFC'] : "");?>">
	<div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Name of Entity / Business Enterprise <span title="Required" class="text-danger">*</span></label> 
						<input type="text" id="enrol_actual_lname" name="bifc_name" required="required" class=" form-control" value="<?php echo (isset($dataRealPropertyArray[0]) ? $dataRealPropertyArray[0] : "");?>"  style="text-transform:uppercase;"/>				
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Business Address <span title="Required" class="text-danger">*</span></label> <small><i>(Barangay, Municipality/City, Province)</small></i>
						<input type="text" id="enrol_actual_lname" name="bifc_address" required="required" class=" form-control" value="<?php echo (isset($dataRealPropertyArray[1]) ? $dataRealPropertyArray[1] : "");?>" style="text-transform:uppercase;"/>				
					</div>
				</div>
			</div>
			<div class="row">	
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Nature of Business Interest and/or Financial Connection<span title="Required" class="text-danger">*</span></label>
						<select name="bifc_nature" class="form-control" required>
							<option value="">---select---</option>
							<option value="CONSULTANT" <?php echo (isset($dataRealPropertyArray[2]) && $dataRealPropertyArray[2]=="CONSULTANT"?"selected":"");?>>CONSULTANT</option>
							<option value="CREDITOR" <?php echo (isset($dataRealPropertyArray[2]) && $dataRealPropertyArray[2]=="CREDITOR"?"selected":"");?>>CREDITOR</option>	
							<option value="EXECUTIVE" <?php echo (isset($dataRealPropertyArray[2]) && $dataRealPropertyArray[2]=="EXECUTIVE"?"selected":"");?>>EXECUTIVE</option>
							<option value="INVESTOR" <?php echo (isset($dataRealPropertyArray[2]) && $dataRealPropertyArray[2]=="INVESTOR"?"selected":"");?>>INVESTOR</option>							
							<option value="LAWYER" <?php echo (isset($dataRealPropertyArray[2]) && $dataRealPropertyArray[2]=="LAWYER"?"selected":"");?>>LAWYER</option>
							<option value="MANAGING DIRECTOR" <?php echo (isset($dataRealPropertyArray[2]) && $dataRealPropertyArray[2]=="MANAGING DIRECTOR"?"selected":"");?>>MANAGING DIRECTOR</option>
							<option value="OFFICER" <?php echo (isset($dataRealPropertyArray[2]) && $dataRealPropertyArray[2]=="OFFICER"?"selected":"");?>>OFFICER</option>	
							<option value="PARTNER" <?php echo (isset($dataRealPropertyArray[2]) && $dataRealPropertyArray[2]=="PARTNER"?"selected":"");?>>PARTNER</option>							
							<option value="PROMOTER" <?php echo (isset($dataRealPropertyArray[2]) && $dataRealPropertyArray[2]=="PROMOTER"?"selected":"");?>>PROMOTER</option>	
							<option value="PROPRIETOR" <?php echo (isset($dataRealPropertyArray[2]) && $dataRealPropertyArray[2]=="PROPRIETOR"?"selected":"");?>>PROPRIETOR</option>							
							<option value="SHAREHOLDER" <?php echo (isset($dataRealPropertyArray[2]) && $dataRealPropertyArray[2]=="SHAREHOLDER"?"selected":"");?>>SHAREHOLDER</option>
						</select>	
					</div>
				</div>
			</div>
			<div class="row">	
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Date of Acquisition on Interest or Connection <span title="Required" class="text-danger">*</span></label>
						<input type="date" id="enrol_actual_lname" name="bifc_dateacquisition" required="required" class=" form-control" value="<?php echo (isset($dataRealPropertyArray[3]) ? $dataRealPropertyArray[3] : "");?>" style="text-transform:uppercase;"/>
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
