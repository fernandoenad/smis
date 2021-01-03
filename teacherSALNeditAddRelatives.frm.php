<?php
session_start();
require ('maincore.php');


if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$teachSalnDet_details = array($_POST['rel_name'],$_POST['rel_relationship'],$_POST['rel_position'],$_POST['rel_agencyandaddress']);
	$teachSalnDet_details_string = mysqli_real_escape_string($conn, serialize($teachSalnDet_details));;
	$insertRealProperty = dbquery("insert into teachsalndetails(teachSalnDet_teachSaln_no, teachSalnDet_type, teachSalnDet_details) 
		values('".$_POST['teachSaln_no']."', '5', '".$teachSalnDet_details_string."')");
	$updateSALN = dbquery("update teachsaln set teachSaln_status='2', teachSaln_moduser='".$_SESSION["userid"]."', teachSaln_moddatetime=NOW() where teachSaln_no='".$_POST['teachSaln_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['Edit']) && $_GET['Edit']="Yes"){
	$teachSalnDet_details = array($_POST['rel_name'],$_POST['rel_relationship'],$_POST['rel_position'],$_POST['rel_agencyandaddress']);
	$teachSalnDet_details_string = mysqli_real_escape_string($conn, serialize($teachSalnDet_details));;
	$insertRealProperty = dbquery("update teachsalndetails set teachSalnDet_details='".$teachSalnDet_details_string."' where teachSalnDet_no='".$_POST['teachSalnDet_no']."'"); 
	$updateSALN = dbquery("update teachsaln set teachSaln_status='2', teachSaln_moduser='".$_SESSION["userid"]."', teachSaln_moddatetime=NOW() where teachSaln_no='".$_POST['teachSaln_no']."'");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['editRelatives']) and $_GET['editRelatives']!=0){
	$checkRealProperty = dbquery("select * from teachsalndetails where teachSalnDet_no='".$_GET['editRelatives']."'");
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
		<h4 class="modal-title"><?php echo (isset($_GET['editRelatives'])?"Modify":"Add");?> Business Interests and Financial Connections</h4>
	</div>
  
	<!-- the body -->
	<form name="form1" method="post" action="teacherSALNeditAddRelatives.frm.php?<?php echo(isset($_GET['editRelatives'])?"Edit":"Save");?>=Yes">
		<input type="hidden" id="user_name" name="teachSaln_no" maxlength="15" required="required" class="form-control" value="<?php echo $_GET['edit'];?>">
		<input type="hidden" id="user_name" name="teachSalnDet_no" maxlength="15" required="required" class="form-control" value="<?php echo (isset($_GET['editRelatives']) ? $_GET['editRelatives'] : "");?>">
	<div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Name Relative <span title="Required" class="text-danger">*</span></label> <small><i>(e.g. JUAN C. DELA CRUZ, JR)</i></small>
						<input type="text" id="enrol_actual_lname" name="rel_name" required="required" class=" form-control" value="<?php echo (isset($dataRealPropertyArray[0]) ? $dataRealPropertyArray[0]: "");?>" style="text-transform:uppercase;"/>				
					</div>
				</div>
			</div>
			<div class="row">	
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Relationship<span title="Required" class="text-danger">*</span></label>
						<select name="rel_relationship" class="form-control" required>
							<option value="">---select---</option>
							<option value="CHILD" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="CHILD"?"selected":"");?>>CHILD</option>
							<option value="PARENT" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="PARENT"?"selected":"");?>>PARENT</option>
							<option value="GRANDCHILD" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="GRANDCHILD"?"selected":"");?>>GRANDCHILD</option>
							<option value="BROTHER" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="BROTHER"?"selected":"");?>>BROTHER</option>
							<option value="SISTER" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="GRANDPARENT"?"selected":"");?>>SISTER</option>
							<option value="GRANDPARENT" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="GRANDPARENT"?"selected":"");?>>GRANDPARENT</option>
							<option value="GREAT GRANDCHILD" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="GREAT GRANDCHILD"?"selected":"");?>>GREAT GRANDCHILD</option>
							<option value="NIECE" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="NIECE"?"selected":"");?>>NIECE</option>
							<option value="NEPHEW" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="NEPHEW"?"selected":"");?>>NEPHEW</option>
							<option value="AUNT" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="AUNT"?"selected":"");?>>AUNT</option>
							<option value="UNCLE" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="UNCLE"?"selected":"");?>>UNCLE</option>
							<option value="GRAND NEPHEW" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="GRAND NEPHEW"?"selected":"");?>>GRAND NEPHEW</option>
							<option value="GRAND NIECE" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="GRAND NIECE"?"selected":"");?>>GRAND NIECE</option>
							<option value="FIRST COUSIN" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="FIRST COUSIN"?"selected":"");?>>FIRST COUSIN</option>
							<option value="GREAT UNCLE" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="GREAT UNCLE"?"selected":"");?>>GREAT UNCLE</option>
							<option value="GREAT AUNTIE" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="GREAT AUNTIE"?"selected":"");?>>GREAT AUNTIE</option>
							<option value="GREAT GREAT GRANDPARENT" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="GREAT GREAT GRANDPARENT"?"selected":"");?>>GREAT GREAT GRANDPARENT</option>
							<option value="SPOUSE" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="SPOUSE"?"selected":"");?>>SPOUSE</option>
							<option value="PARENT-IN-LAW" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="PARENT-IN-LAW"?"selected":"");?>>PARENT-IN-LAW</option>
							<option value="DAUGHTER-IN-LAW" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="DAUGHTER-IN-LAW"?"selected":"");?>>DAUGHTER-IN-LAW</option>
							<option value="SON-IN-LAW" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="SON-IN-LAW"?"selected":"");?>>SON-IN-LAW</option>
							<option value="GRANDPARENT-IN-LAW" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="GRANDPARENT-IN-LAW"?"selected":"");?>>GRANDPARENT-IN-LAW</option>
							<option value="BROTHER-IN-LAW" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="BROTHER-IN-LAW"?"selected":"");?>>BROTHER-IN-LAW</option>
							<option value="SISTER-IN-LAW" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="SISTER-IN-LAW"?"selected":"");?>>SISTER-IN-LAW</option>
							<option value="GRANDCHILD-IN-LAW" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="GRANDCHILD-IN-LAW"?"selected":"");?>>GRANDCHILD-IN-LAW</option>
							<option value="GREAT GRANDPARENT-IN-LAW" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="GREAT GRANDPARENT-IN-LAW"?"selected":"");?>>GREAT GRANDPARENT-IN-LAW</option>
							<option value="UNCLE-IN-LAW" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="UNCLE-IN-LAW"?"selected":"");?>>UNCLE-IN-LAW</option>
							<option value="FIRST COUSIN-IN-LAW" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="FIRST COUSIN-IN-LAW"?"selected":"");?>>FIRST COUSIN-IN-LAW</option>
							<option value="NIECE-IN-LAW" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="NIECE-IN-LAW"?"selected":"");?>>NIECE-IN-LAW</option>
							<option value="NEPHEW-IN-LAW" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="NEPHEW-IN-LAW"?"selected":"");?>>NEPHEW-IN-LAW</option>
							<option value="GREAT GRANDCHILD-IN-LAW" <?php echo (isset($dataRealPropertyArray[1]) && $dataRealPropertyArray[1]=="GREAT GRANDCHILD-IN-LAW"?"selected":"");?>>GREAT GRANDCHILD-IN-LAW</option>
							
						</select>	
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Position <span title="Required" class="text-danger">*</span></label> 
						<input type="text" id="enrol_actual_lname" name="rel_position" required="required" class=" form-control" value="<?php echo (isset($dataRealPropertyArray[2]) ? $dataRealPropertyArray[2] : "");?>" style="text-transform:uppercase;"/>				
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Name of Agency / Address <span title="Required" class="text-danger">*</span></label> <small><i>(e.g. SAN AGUSTIN NHS / SAGBAYAN, BOHOL)</i></small>
						<input type="text" id="enrol_actual_lname" name="rel_agencyandaddress" required="required" class=" form-control" value="<?php echo (isset($dataRealPropertyArray[3]) ?  $dataRealPropertyArray[3] : "");?>" style="text-transform:uppercase;"/>				
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
