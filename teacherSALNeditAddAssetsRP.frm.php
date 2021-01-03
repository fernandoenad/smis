<?php
session_start();
require ('maincore.php');

if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$teachSalnDet_details = array($_POST['RPdescription'],$_POST['RPkind'],$_POST['RPlocation'],$_POST['RPassessedvalue'],$_POST['RPmarketvalue'],$_POST['RPyearacquisition'],$_POST['RKmodeacquisition']);
	$teachSalnDet_details_string = mysqli_real_escape_string($conn, serialize($teachSalnDet_details));;
	$insertRealProperty = dbquery("insert into teachsalndetails(teachSalnDet_teachSaln_no, teachSalnDet_type, teachSalnDet_details, teachSalnDet_cost) 
		values('".$_POST['teachSaln_no']."', '1', '".$teachSalnDet_details_string."', '".$_POST['teachSalnDet_cost']."' )");
	$updateSALN = dbquery("update teachsaln set teachSaln_status='2', teachSaln_moduser='".$_SESSION["userid"]."', teachSaln_moddatetime=NOW() where teachSaln_no='".$_POST['teachSaln_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['Edit']) && $_GET['Edit']="Yes"){
	$teachSalnDet_details = array($_POST['RPdescription'],$_POST['RPkind'],$_POST['RPlocation'],$_POST['RPassessedvalue'],$_POST['RPmarketvalue'],$_POST['RPyearacquisition'],$_POST['RKmodeacquisition']);
	$teachSalnDet_details_string = mysqli_real_escape_string($conn, serialize($teachSalnDet_details));;
	$insertRealProperty = dbquery("update teachsalndetails set teachSalnDet_details='".$teachSalnDet_details_string."', teachSalnDet_cost='".$_POST['teachSalnDet_cost']."' where teachSalnDet_no='".$_POST['teachSalnDet_no']."'");
	$updateSALN = dbquery("update teachsaln set teachSaln_status='2', teachSaln_moduser='".$_SESSION["userid"]."', teachSaln_moddatetime=NOW() where teachSaln_no='".$_POST['teachSaln_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['editRealProperty']) and $_GET['editRealProperty']!=0){
	$checkRealProperty = dbquery("select * from teachsalndetails where teachSalnDet_no='".$_GET['editRealProperty']."'");
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
		<h4 class="modal-title"><?php echo (isset($_GET['editRealProperty'])?"Modify":"Add");?> Real Properties</h4>
	</div>
  
	<!-- the body -->
	<form name="form1" method="post" action="teacherSALNeditAddAssetsRP.frm.php?<?php echo(isset($_GET['editRealProperty'])?"Edit":"Save");?>=Yes">
		<input type="hidden" id="user_name" name="teachSaln_no" maxlength="15" required="required" class="form-control" value="<?php echo $_GET['edit'];?>">
		<input type="hidden" id="user_name" name="teachSalnDet_no" maxlength="15" required="required" class="form-control" value="<?php echo (isset($_GET['editRealProperty']) ? $_GET['editRealProperty'] : 0);?>">
	<div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_fname">Description <span title="Required" class="text-danger">*</span></label> 
						<select name="RPdescription" class="form-control" required>
							<option value="">---select---</option>
							<option value="CONDOMINIUM" <?php echo (isset($dataRealPropertyArray[0]) && $dataRealPropertyArray[0]=="CONDOMINIUM"?"selected":"");?>>CONDOMINIUM</option>
							<option value="HOUSE" <?php echo (isset($dataRealPropertyArray[0]) && $dataRealPropertyArray[0]=="HOUSE"?"selected":"");?>>HOUSE</option>
							<option value="IMPROVEMENTS" <?php echo (isset($dataRealPropertyArray[0]) && $dataRealPropertyArray[0]=="IMPROVEMENTS"?"selected":"");?>>IMPROVEMENTS</option>
							<option value="LOT" <?php echo (isset($dataRealPropertyArray[0]) && $dataRealPropertyArray[0]=="LOT"?"selected":"");?>>LOT</option>
							<option value="TOWN HOUSES" <?php echo (isset($dataRealPropertyArray[0]) && $dataRealPropertyArray[0]=="TOWN HOUSES"?"selected":"");?>>TOWN HOUSES</option>							
						</select>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_mname">Kind <span title="Required" class="text-danger">*</span></label> 
						<select name="RPkind" class="form-control" required>
							<option value="">---select---</option>
							<option value="RESIDENTIAL" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="RESIDENTIAL"?"selected":"");?>>RESIDENTIAL</option>
							<option value="COMMERCIAL" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="COMMERCIAL"?"selected":"");?>>COMMERCIAL</option>
							<option value="INDUSTRIAL" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="INDUSTRIAL"?"selected":"");?>>INDUSTRIAL</option>
							<option value="AGRICULTURAL" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="AGRICULTURAL"?"selected":"");?>>AGRICULTURAL</option>
							<option value="MIXED USE" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="MIXED USE"?"selected":"");?>>MIXED USE</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Location <span title="Required" class="text-danger">*</span></label> <small><i>(Barangay, Municipality, Province)</small></i>
						<input type="text" id="enrol_actual_lname" name="RPlocation" required="required" class=" form-control" value="<?php echo (isset($dataRealPropertyArray[2]) ? $dataRealPropertyArray[2] : "");?>" style="text-transform:uppercase;"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Assessed Value <span title="Required" class="text-danger">*</span></label> <i><small>(As found in the Tax Declaration of Real Property)</small></i>
						<input type="number" id="enrol_actual_lname" name="RPassessedvalue" required="required" class=" form-control" value="<?php echo (isset($dataRealPropertyArray[3]) ? $dataRealPropertyArray[3] : "");?>" style="text-transform:uppercase;"/>
					</div>
				</div>
			</div>
			<div class="row">	
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Current Fair Market Value <span title="Required" class="text-danger">*</span></label> <i><small>(As found in the Tax Declaration of Real Property)</small></i>
						<input type="number" id="enrol_actual_lname" name="RPmarketvalue" required="required" class=" form-control" value="<?php echo (isset($dataRealPropertyArray[4]) ? $dataRealPropertyArray[4] : "");?>" style="text-transform:uppercase;"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Year of Acquisition  <span title="Required" class="text-danger">*</span></label>
						<select name="RPyearacquisition" class="form-control" required>
							<option value="">---select---</option>
							<?php
							for($year=date("Y");$year>=date("Y")-100;$year--){
							?>
								<option value="<?php echo $year;?>" <?php echo (isset($dataRealPropertyArray[5]) && $dataRealPropertyArray[5]==$year?"selected":"");?>><?php echo $year;?></option>
							<?php }?>
						</select>					
					</div>
				</div>	
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Mode of Acquisition <span title="Required" class="text-danger">*</span></label>
						<select name="RKmodeacquisition" class="form-control" required>
							<option value="">---select---</option>
							<option value="DONATION" <?php echo (isset($dataRealPropertyArray[6]) && $dataRealPropertyArray[6]=="DONATION"?"selected":"");?>>DONATION</option>	
							<option value="INHERITANCE" <?php echo (isset($dataRealPropertyArray[6]) && $dataRealPropertyArray[6]=="INHERITANCE"?"selected":"");?>>INHERITANCE</option>							
							<option value="PURCHASE" <?php echo (isset($dataRealPropertyArray[6]) && $dataRealPropertyArray[6]=="PURCHASE"?"selected":"");?>>PURCHASE</option>
						</select>
					</div>
				</div>	
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Acquisition Cost <span title="Required" class="text-danger">*</span></label>
						<input type="number" step="0.01" id="enrol_actual_lname" name="teachSalnDet_cost" required="required" class=" form-control" value="<?php echo (isset($dataRealProperty['teachSalnDet_cost']) ? $dataRealProperty['teachSalnDet_cost']:"");?>" style="text-transform:uppercase;"/>
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
