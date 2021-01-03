<?php
if(isset($_GET['updateProfile'])) {
	$searchStudent = $_GET['updateProfile'];
}
else{
	$searchStudent = "a";
}

	$result = dbquery("SELECT * FROM student WHERE stud_no='".$searchStudent."'");
	$rows = dbrows($result);
	$data = dbarray($result);

?>

		<div class="pagecontent container">
			<div class="row row-toolbar">
				<div class="col-lg-3 col-md-3 col-lg-push-9 col-md-push-9">
					<div class="btn-group pull-right" style="margin-top: 5px;">
						<form class="navbar-form navbar-right" method="post" action="./?page=student">
							<div class="input-group">
								<input type="text" name="searchStudent" class="form-control" placeholder="Search Student..." value="<?php echo (isset($_POST['searchStudent'])?$_POST['searchStudent']:""); ?>" autofocus>
								<div class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="page-header" style="margin-top: 20px">
				<h1>Student</h1>
			</div>                
    <ol class="breadcrumb">
        <li><a href="./?page=student">Student</a></li>
		<li><a href="./?page=student&showProfile=<?php echo $_GET['updateProfile'];?>">Profile</a></li>
        <li class="active">Update Profile</li>
    </ol>
    
    <form id="enrol" method="post" action="./student.scr.php?updateStudent=Yes" >
	<div class="card">
		<div class="card-heading simple">Learner</div>
		<div class="card-body">
			<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">Learner's Reference Number <span title="Required" class="text-danger">*</span></label>
						<img id="tick" src="assets/images/tick.png" width="16" height="16"/>
						<img id="cross" src="assets/images/cross.png" width="16" height="16"/>
						<input type="text" id="stud_lrn" name="stud_lrn" maxlength="12" required="required" class=" form-control" value="<?php echo $data['stud_lrn']; ?>" autofocus>
					</div>
				</div>
			</div>
		<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_fname">First name <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_actual_fname" name="stud_fname"  required="required" class=" form-control" value="<?php echo strtoupper($data['stud_fname']); ?>" style="text-transform:uppercase;"/>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_mname">Middle name <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_actual_mname" name="stud_mname" required="required" class=" form-control" value="<?php echo strtoupper($data['stud_mname']); ?>" style="text-transform:uppercase;"/>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Last name <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_actual_lname" name="stud_lname" required="required" class=" form-control" value="<?php echo strtoupper($data['stud_lname']); ?>" style="text-transform:uppercase;"/>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label" for="enrol_actual_xname">Ext name</label>
						<select id="enrol_actual_xname" name="stud_xname" class="form-control">
							<?php
							$result = dbquery("SELECT * FROM dropdowns WHERE field_category='FIELD_EXT' ORDER BY field_no DESC");
							$rows = dbrows($result);
							while($data2 = dbarray($result)){
							?>
								<option value="<?php echo $data2['field_name']; ?>" <?php echo ($data2['field_name']==$data['stud_xname']?"selected":"No"); ?>><?php echo ($data2['field_name']==NULL?"NONE":$data2['field_name']); ?></option>";
							<?php
							}
							?>
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_gender">Gender <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_actual_gender" name="stud_gender" required="required" class="form-control">
							<option value="">---select---</option>
							<?php
							$result = dbquery("SELECT * FROM dropdowns WHERE field_category='GENDER' ORDER BY field_name ASC");
							$rows = dbrows($result);
							while($data2 = dbarray($result)){
							?>
								<option value="<?php echo $data2['field_name']; ?>" <?php echo ($data2['field_name']==$data['stud_gender']?"selected":"No"); ?>><?php echo ($data2['field_name']==NULL?"NONE":$data2['field_name']); ?></option>";
							<?php							}
							?>
						</select>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_bdate">Birth date <span title="Required" class="text-danger">*</span></label>
						<input type="date" id="enrol_actual_bdate" name="stud_bdate" required="required" class=" form-control" value="<?php echo $data['stud_bdate']; ?>" />
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_residence">Residence <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_actual_residence" name="stud_residence" required="required" class="form-control">
							<option value="">---select---</option>
							<?php
							$result = dbquery("SELECT * FROM dropdowns WHERE field_category='RESIDENCE' ORDER BY field_name ASC");
							$rows = dbrows($result);
							while($data2 = dbarray($result)){
							?>
								<option value="<?php echo $data2['field_name']; ?>" <?php echo ($data2['field_name']==$data['stud_residence']?"selected":"No"); ?>><?php echo ($data2['field_name']==NULL?"NONE":$data2['field_name']); ?></option>";
							<?php							}
							?>
						</select><a href="newResidence.frm.php"  data-toggle="modal" data-target="#modal-medium">Not found?</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_birthDate">CCT <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_actual_gender" name="stud_cct" required="required" class="form-control">
							<option value="">---select---</option>
							<?php
							$result = dbquery("SELECT * FROM dropdowns WHERE field_category='CCT' ORDER BY field_name ASC");
							$rows = dbrows($result);
							while($data2 = dbarray($result)){
							?>
								<option value="<?php echo $data2['field_name']; ?>" <?php echo ($data2['field_name']==$data['stud_cct']?"selected":"No"); ?>><?php echo ($data2['field_name']==NULL?"NONE":$data2['field_name']); ?></option>";
							<?php							}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<?php
		$contact = dbquery("SELECT * FROM studcontacts INNER JOIN student ON studcontacts.studCont_stud_no=student.stud_no WHERE studcontacts.studCont_stud_no='".$data['stud_no']."' order by studCont_no asc");
		$rowsContact = dbrows($contact);
		$dataContact = dbarray($contact);
		?>
		<div class="col-lg-4 col-md-4 col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">Guardian</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label" for="learner_update_guardian_last">Last name</label>
						<input type="text" id="learner_update_guardian_last" required="required" name="stud_gua_lname" class=" form-control" value="<?php echo strtoupper($dataContact['studCont_stud_glname']); ?>" style="text-transform:uppercase;"/>
					</div>
					<div class="form-group">
						<label class="control-label" for="learner_update_guardian_first">First name (add Name Extension here)</label>
						<input type="text" id="learner_update_guardian_first" required="required" name="stud_gua_fname" class=" form-control" value="<?php echo strtoupper($dataContact['studCont_stud_gfname']); ?>" style="text-transform:uppercase;"/>
					</div>
					<div class="form-group">
						<label class="control-label" for="learner_update_guardian_middle_name">Middle name</label>
						<input type="text" id="learner_update_guardian_middle_name" required="required" name="stud_gua_mname" class=" form-control" value="<?php echo strtoupper($dataContact['studCont_stud_gmname']); ?>" style="text-transform:uppercase;"/>
					</div>
					<div class="form-group">
						<label class="control-label" for="learner_update_guardianRelationId">Relationship</label>
						<select id="learner_update_guardianRelationId" required="required" name="stud_gua_rel" class="form-control">
							<option value="PARENT" <?php echo ($dataContact['studCont_stud_grelation']=="PARENT"?"selected":"No"); ?>>PARENT</option>
							<option value="RELATIVE" <?php echo ($dataContact['studCont_stud_grelation']=="RELATIVE"?"selected":"No"); ?>>RELATIVE</option>
							<option value="NON-RELATIVE" <?php echo ($dataContact['studCont_stud_grelation']=="NON-RELATIVE"?"selected":"No"); ?>>NON-RELATIVE</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-4 col-md-4 col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">Mother's maiden name</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label" for="learner_update_motherMaidenName_last">Last name</label>
						<input type="text" id="learner_update_motherMaidenName_last" required="required" name="stud_mot_lname" class=" form-control" value="<?php echo strtoupper($dataContact['studCont_stud_mlname']); ?>" style="text-transform:uppercase;"/>
					</div>
					<div class="form-group">
						<label class="control-label" for="learner_update_motherMaidenName_first">First name</label>
						<input type="text" id="learner_update_motherMaidenName_first" required="required" name="stud_mot_fname" class=" form-control" value="<?php echo strtoupper($dataContact['studCont_stud_mfname']); ?>" style="text-transform:uppercase;"/>
					</div>
					<div class="form-group">	
						<label class="control-label" for="learner_update_motherMaidenName_middle_name">Middle name</label>
						<input type="text" id="learner_update_motherMaidenName_middle_name" required="required" name="stud_mot_mname" class=" form-control" value="<?php echo strtoupper($dataContact['studCont_stud_mmname']); ?>" style="text-transform:uppercase;"/>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-4 col-md-4 col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">Father</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label" for="learner_update_fatherLastName">Last name</label>
						<input type="text" id="learner_update_fatherLastName" required="required" name="stud_fat_lname" class=" form-control" value="<?php echo strtoupper($dataContact['studCont_stud_flname']); ?>" style="text-transform:uppercase;"/>
					</div>
					<div class="form-group">
						<label class="control-label" for="learner_update_fatherFirstName">First name (add Name Extension here)</label>
						<input type="text" id="learner_update_fatherFirstName" required="required" name="stud_fat_fname" class=" form-control" value="<?php echo strtoupper($dataContact['studCont_stud_ffname']); ?>" style="text-transform:uppercase;"/>
					</div>
					<div class="form-group">
						<label class="control-label" for="learner_update_fatherMiddleName_name">Middle name</label>
						<input type="text" id="learner_update_fatherMiddleName_name" required="required" name="stud_fat_mname" class=" form-control" value="<?php echo strtoupper($dataContact['studCont_stud_fmname']); ?>" style="text-transform:uppercase;"/>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-3 col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Guardian's Contact Number</div>
				<div class="panel-body ">
					<label class="control-label" for="learner_update_residence">Contact #</label>
					<input type="text" id="learner_update_residence" name="stud_gua_contact" required="required" class=" form-control" value="<?php echo strtoupper($dataContact['studCont_stud_gcontact']); ?>" style="text-transform:uppercase;"/>
				</div>
			</div>
		</div>
		
		<div class="col-lg-3 col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Religion</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label" for="learner_update_religion">Religion</label>
						<select id="learner_update_religion" name="stud_religion" required="required" class="autoselect2 form-control form-control">
							<option value="">---select---</option>
							<?php
							$result = dbquery("SELECT * FROM dropdowns WHERE field_category='RELIGION' ORDER BY field_name ASC");
							$rows = dbrows($result);
							while($data2 = dbarray($result)){
							?>
								<option value="<?php echo $data2['field_name']; ?>" <?php echo ($data2['field_name']==$data['stud_religion']?"selected":"No"); ?>><?php echo ($data2['field_name']==NULL?"NONE":$data2['field_name']); ?></option>";
							<?php							}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-3 col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Ethnicity</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label" for="learner_update_religion">Ethnicity</label>
						<select id="learner_update_religion" name="stud_ethnicity" required="required" class="autoselect2 form-control form-control">
							<option value="">---select---</option>
							<?php
							$result = dbquery("SELECT * FROM dropdowns WHERE field_category='ETHNICITY' ORDER BY field_name ASC");
							$rows = dbrows($result);
							while($data2 = dbarray($result)){
							?>
								<option value="<?php echo $data2['field_name']; ?>" <?php echo ($data2['field_name']==$data['stud_ethnicity']?"selected":"No"); ?>><?php echo ($data2['field_name']==NULL?"NONE":$data2['field_name']); ?></option>";
							<?php							}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-3 col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Dialect / MTB</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label" for="learner_update_religion">Dialect / MTB</label>
						<select id="learner_update_religion" name="stud_dialect" required="required" class="autoselect2 form-control form-control">
							<option value="">---select---</option>
							<?php
							$result = dbquery("SELECT * FROM dropdowns WHERE field_category='DIALECT' ORDER BY field_name ASC");
							$rows = dbrows($result);
							while($data2 = dbarray($result)){
							?>
								<option value="<?php echo $data2['field_name']; ?>" <?php echo ($data2['field_name']==$data['stud_dialect']?"selected":"No"); ?>><?php echo ($data2['field_name']==NULL?"NONE":$data2['field_name']); ?></option>";
							<?php							}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
		</div>
		<hr/>
		<input type="hidden" name="stud_no" value="<?php echo $data['stud_no']; ?>">
		<button type="submit" name="submit" id="submit" class="btn btn-primary pull-right"  onclick="return confirm('Are you sure you want to save the changes?')">Update</button>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-default">Back to Profile</a>
		<br/>
	</form>

              </div>
            </div>
          </div>
        </div>