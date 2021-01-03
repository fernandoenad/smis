<?php
if(isset($_GET['updateProfile'])) {
	$searchStudent = $_GET['updateProfile'];
}
else{
	$searchStudent = "a";
}

	$result = dbquery("SELECT * FROM teacher WHERE teach_no='".$searchStudent."'");
	$rows = dbrows($result);
	$data = dbarray($result);

?>

		<div class="pagecontent container">
			<div class="row row-toolbar">
				<div class="col-lg-3 col-md-3 col-lg-push-9 col-md-push-9">
					<div class="btn-group pull-right" style="margin-top: 5px;">
						<form class="navbar-form navbar-right" method="post" action="./?page=teacher">
							<div class="input-group">
								<input type="text" name="searchStudent" class="form-control" placeholder="Search Teacher..." value="<?php echo (isset($_POST['searchStudent'])?$_POST['searchStudent']:""); ?>" autofocus>
								<div class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="page-header" style="margin-top: 20px">
				<h1>Teacher</h1>
			</div>                
    <ol class="breadcrumb">
        <li><a href="./?page=teacher">Teacher</a></li>
		<li><a href="./?page=teacher&showProfile=<?php echo $_GET['updateProfile'];?>&tab=info">Profile</a></li>
        <li class="active">Update Profile</li>
    </ol>
    
    <form id="enrol" method="post" action="./teacher.scr.php?updateTeacher=Yes" >
	<div class="card">
		<div class="card-heading simple">Teacher</div>
		<div class="card-body">
			<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lrn">Teacher's DepEd ID <span title="Required" class="text-danger">*</span></label>
						<img id="tick" src="assets/images/tick.png" width="16" height="16"/>
						<img id="cross" src="assets/images/cross.png" width="16" height="16"/>
						<input type="text" id="teach_id" name="teach_id" maxlength="7" required="required" class=" form-control" value="<?php echo $data['teach_id']; ?>"  style="text-transform:uppercase;" autofocus />
					</div>
				</div>
			</div>
		<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_fname">First name <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_actual_fname" name="stud_fname"  required="required" class=" form-control" value="<?php echo strtoupper($data['teach_fname']); ?>" style="text-transform:uppercase;"/>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_mname">Middle name <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_actual_mname" name="stud_mname" required="required" class=" form-control" value="<?php echo strtoupper($data['teach_mname']); ?>" style="text-transform:uppercase;"/>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Last name <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_actual_lname" name="stud_lname" required="required" class=" form-control" value="<?php echo strtoupper($data['teach_lname']); ?>" style="text-transform:uppercase;"/>
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
								<option value="<?php echo $data2['field_name']; ?>" <?php echo ($data2['field_name']==$data['teach_xname']?"selected":"No"); ?>><?php echo ($data2['field_name']==NULL?"NONE":$data2['field_name']); ?></option>";
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
								<option value="<?php echo $data2['field_name']; ?>" <?php echo ($data2['field_name']==$data['teach_gender']?"selected":"No"); ?>><?php echo ($data2['field_name']==NULL?"NONE":$data2['field_name']); ?></option>";
							<?php							}
							?>
						</select>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_bdate">Birth date <span title="Required" class="text-danger">*</span></label>
						<input type="date" id="enrol_actual_bdate" name="stud_bdate" required="required" class=" form-control" value="<?php echo $data['teach_bdate']; ?>" />
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
								<option value="<?php echo $data2['field_name']; ?>" <?php echo ($data2['field_name']==$data['teach_residence']?"selected":"No"); ?>><?php echo ($data2['field_name']==NULL?"NONE":$data2['field_name']); ?></option>";
							<?php							}
							?>
						</select><a href="newResidence.frm.php"  data-toggle="modal" data-target="#modal-medium">Not found?</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_birthDate">Civil Status <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_actual_gender" name="teach_cstatus" required="required" class="form-control">
							<option value="">---select---</option>
							<?php
							$result = dbquery("SELECT * FROM dropdowns WHERE field_category='CSTATUS' ORDER BY field_name ASC");
							$rows = dbrows($result);
							while($data2 = dbarray($result)){
							?>
								<option value="<?php echo $data2['field_name']; ?>" <?php echo ($data2['field_name']==$data['teach_cstatus']?"selected":"No"); ?>><?php echo ($data2['field_name']==NULL?"NONE":$data2['field_name']); ?></option>";
							<?php							}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-3 col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Tax Identification Number</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label" for="learner_update_religion">TIN #</label>
						<input type="number" id="learner_update_residence" name="teach_tin" oninput="maxLengthCheck(this)" required="required" maxlength="9" min="0" max="999999999" class=" form-control" value="<?php echo $data['teach_tin']; ?>" style="text-transform:uppercase;">
					</div>
				</div>
			</div>
		</div>
			
		<div class="col-lg-3 col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Contact Number</div>
				<div class="panel-body ">
					<label class="control-label" for="learner_update_residence">Contact #</label>
					<input type="number" id="learner_update_residence" name="teach_dialect" required="required" class=" form-control" value="<?php echo strtoupper($data['teach_dialect']); ?>" style="text-transform:uppercase;">
				</div>
			</div>
		</div>
		

		<div class="col-lg-6 col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Electronic Mail Address</div>
				<div class="panel-body ">
					<label class="control-label" for="learner_update_residence">Email Address</label>
					<input type="email" id="learner_update_residence" name="teach_ethnicity" required="required" class=" form-control" value="<?php echo strtoupper($data['teach_ethnicity']); ?>" style="text-transform:uppercase;">
				</div>
			</div>
		</div>
		

		</div>
		<hr/>
		<input type="hidden" name="teach_no" value="<?php echo $data['teach_no']; ?>">
		<button type="submit" name="submit" id="submit" class="btn btn-primary pull-right"  onclick="return confirm('Are you sure you want to save the changes?')">Update</button>
		<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-default">Back to Profile</a>
		<br/>
	</form>

              </div>
            </div>
          </div>
        </div>
		
<script>
  // This is an old version, for a more recent version look at
  // https://jsfiddle.net/DRSDavidSoft/zb4ft1qq/2/
  function maxLengthCheck(object)
  {
    if (object.value.length > object.maxLength)
      object.value = object.value.slice(0, object.maxLength)
  }
</script>
		