<?php
session_start();
require ('maincore.php');
if(isset($_GET['Save']) && $_GET['Save']="Yes"){
	$updateClass = dbquery("insert into teachsaln(teachSaln_teach_no, teachSaln_filetype, teachSaln_issueyear, teachSaln_status, teachSaln_reguser, teachSaln_regdatetime) values('".$_POST['teachSaln_teach_no']."', '".$_POST['teachSaln_filetype']."', '".$_POST['teachSaln_issueyear']."', '1', '".$_POST['teachSaln_reguser']."',NOW())");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

$checkUser = dbquery("SELECT * FROM teacher where teach_no='".$_GET['fileSALN']."'");
$dataUser = dbarray($checkUser);
?>
<!-- Modal content-->
<div class="modal-content">

	<!-- the header -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">File SALN for <?php echo $dataUser['teach_fname'];?> <?php echo $dataUser['teach_lname'];?></h4>
	</div>
  
	<!-- the body -->
	<form name="form1" method="post" action="teacherSALNfile.frm.php?Save=Yes">
		<input type="hidden" id="user_name" name="teachSaln_reguser" maxlength="15" required="required" class="form-control" value="<?php echo $_SESSION["userid"];?>">
		<input type="hidden" id="user_name" name="teachSaln_teach_no" maxlength="15" required="required" class="form-control" value="<?php echo $_GET['fileSALN'];?>">
		<input type="hidden" id="user_name" name="teachSaln_issueyear" maxlength="15" required="required" class="form-control" value="<?php echo $_GET['year'];?>">
	<div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">Filing Year <span title="Required" class="text-danger">*</span></label>
						<select name="teachSaln_issueyear" class="form-control" required>
							<option value="">---select---</option>
							<?php
							$checkStartYear = dbquery("select * from settings order by settings_sy asc");
							$startYear = dbarray($checkStartYear);
							$yearLimit = $current_sy;
							for ($years=$startYear['settings_sy'];$years<=$yearLimit;$years++){
								$checkSALNS = dbquery("select * from teachsaln where teachSaln_teach_no='".$dataUser['teach_no']."' and teachSaln_issueyear='".$years."'");
								$countSALNS = dbrows($checkSALNS);
							?>
							<option value="<?php echo $years;?>" <?php echo ($countSALNS>0?"disabled":"");?>><?php echo $years;?> <?php echo ($countSALNS>0?"(Already filed!)":"");?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">Filing Type <span title="Required" class="text-danger">*</span></label>
						<select name="teachSaln_filetype" class="form-control" required>
							<option value="">---select---</option>
							<option value="1">Joint (Both husband and wife are working in the government.)</option>
							<option value="2">Separate (Both husband and wife are working in the government.)</option>
							<option value="3">Not Applicable (Single or if spouse is not working in the government.)</option>

						</select>
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
