<?php


if(isset($_GET['action']) && $_GET['action'] == "editstudent"){
	if(isset($_GET['stud_no'])){
		$stud_no = $_GET['stud_no'];
	}
	if(isset($_POST['stud_no'])){
		$stud_no = $_POST['stud_no'];
	}
	$result	= dbquery("SELECT * FROM student WHERE stud_no='".$stud_no."'");
	if (dbrows($result)) {
		$data = dbarray($result);
		$stud_no = $data['stud_no'];
		$stud_lrn = $data['stud_lrn'];
		$stud_fname = $data['stud_fname'];
		$stud_mname = $data['stud_mname'];
		$stud_lname = $data['stud_lname'];
		$stud_xname = $data['stud_xname'];
		$stud_gender = $data['stud_gender'];
		$stud_bdate = $data['stud_bdate'];
		$stud_residence = $data['stud_residence'];
		$stud_religion = $data['stud_religion'];
		$stud_dialect = $data['stud_dialect'];
		$stud_ethnicity = $data['stud_ethnicity'];
		$stud_cct = $data['stud_cct'];	
		$header_text = "Modify";
		$form_url = "./?page=student&action=showstudent&action2=update&stud_no=".$_GET['stud_no'];
	}
}

if(isset($_GET['action']) && $_GET['action'] == "newstudent"){
		$stud_lrn = "";
		$stud_fname = "";
		$stud_mname = "";
		$stud_lname = "";
		$stud_xname = "";
		$stud_gender = "";
		$stud_bdate = "";
		$stud_residence = "";
		$stud_religion = "";
		$stud_dialect = "";
		$stud_ethnicity = "";
		$stud_cct = "";
		$header_text = "New";
		$form_url = "./?page=student&action=showstudent&action2=save";
} 
?>
					<h2 class="heading"><?php echo $header_text; ?> Student</h2>
							<div class="tab-pane " id="view_prospectus">
								<div class="row-fluid">
									<div class="span12">
										<form name="stud_form" class="form-vertical" method="post" action="<?php echo $form_url; ?>">
										<table width="100%">
											<tr>
												<td><font size="+1">Learner's Reference No. *: </font></td>
												<td><input type="text" name="stud_lrn" maxlength="12" value="<?php echo $stud_lrn;?>" placeholder="000000000000" required></td>
												<td colspan="2">										
												

												<input type="hidden" name="stud_no" value="<?php echo $stud_no; ?>">
												</td>
											</tr>
											<tr>
												<td><h5>First name *:</h5><input type="text" name="stud_fname" value="<?php echo $stud_fname;?>" placeholder="FIRST NAME" required></td>
												<td><h5>Middle name *:</h5><input type="text" name="stud_mname" value="<?php echo $stud_mname;?>" placeholder="MIDDLE NAME" required></td>
												<td><h5>Last name *:</h5><input type="text" name="stud_lname" value="<?php echo $stud_lname;?>" placeholder="LAST NAME" required></td>
												<td><h5>Ext. name *:</h5><select name="stud_xname">
												<option value="">NONE</option>
												<?php
													$result = dbquery("SELECT * FROM dropdowns WHERE field_category='FIELD_EXT'");
													if (dbrows($result)) {
														while ($data = dbarray($result)) {
														?>
														<option value="<?php echo $data['field_name']; ?>" <?php echo ($data['field_name']==$stud_xname?'selected':''); ?>><?php echo ($data['field_name']=='-'?'NONE':$data['field_name']); ?></option>		
														<?php	
														}
													}
												?>
													</select></td>
											</tr>
											<tr>
												<td>
													<h5>Gender *:</h5><select name="stud_gender" required>
													<option value="">--select--</option>
												<?php
													$result = dbquery("SELECT * FROM dropdowns WHERE field_category='GENDER' ORDER BY field_name ASC");
													if (dbrows($result)) {
														while ($data = dbarray($result)) {
														?>
														<option value="<?php echo $data['field_name']; ?>" <?php echo ($data['field_name']==$stud_gender?'selected':''); ?>><?php echo $data['field_name']; ?></option>		
														<?php	
														}
													}
												?>
													</select>
												</td>
												<td><h5>Date of Birth *:</h5><input type="date" name="stud_bdate" value="<?php echo $stud_bdate;?>" required></td>
												<td colspan="2"><h5>Residential Address (Barangay, Town, Province) *:</h5>
													<select name="stud_residence" style="width: 472px;" required>
													<option value="">--select--</option>
												<?php
													$result = dbquery("SELECT * FROM dropdowns WHERE field_category='RESIDENCE' ORDER BY field_name ASC");
													if (dbrows($result)) {
														while ($data = dbarray($result)) {
														?>
														<option value="<?php echo $data['field_name']; ?>" <?php echo ($data['field_name']==$stud_residence?'selected':''); ?>><?php echo $data['field_name']; ?></option>		
														<?php	
														}
													}
												?>
													</select>
												</td>
											</tr>
											<tr>
												<td><h5>Religion *:</h5><select name="stud_religion" required>
													<option value="">--select--</option>
												<?php
													$result = dbquery("SELECT * FROM dropdowns WHERE field_category='RELIGION' ORDER BY field_name ASC");
													if (dbrows($result)) {
														while ($data = dbarray($result)) {
														?>
														<option value="<?php echo $data['field_name']; ?>" <?php echo ($data['field_name']==$stud_religion?'selected':''); ?>><?php echo $data['field_name']; ?></option>		
														<?php	
														}
													}
												?>
													</select>
												</td>
												<td><h5>Mother Tongue *:</h5><select name="stud_dialect" required>
													<option value="">--select--</option>
												<?php
													$result = dbquery("SELECT * FROM dropdowns WHERE field_category='DIALECT' ORDER BY field_name ASC");
													if (dbrows($result)) {
														while ($data = dbarray($result)) {
														?>
														<option value="<?php echo $data['field_name']; ?>" <?php echo ($data['field_name']==$stud_dialect?'selected':''); ?>><?php echo $data['field_name']; ?></option>		
														<?php	
														}
													}
												?>												
													</select>
												</td>
												<td><h5>Ethnicity *:</h5><select name="stud_ethnicity" required>
													<option value="">--select--</option>
												<?php
													$result = dbquery("SELECT * FROM dropdowns WHERE field_category='ETHNICITY' ORDER BY field_name ASC");
													if (dbrows($result)) {
														while ($data = dbarray($result)) {
														?>
														<option value="<?php echo $data['field_name']; ?>" <?php echo ($data['field_name']==$stud_ethnicity?'selected':''); ?>><?php echo $data['field_name']; ?></option>		
														<?php	
														}
													}
												?>												
													</select>
												</td>
												<td><h5>CCT Recipient?:</h5><select name="stud_cct" required>
													<option value="">--select--</option>
											<?php
													$result = dbquery("SELECT * FROM dropdowns WHERE field_category='CCT' ORDER BY field_name ASC");
													if (dbrows($result)) {
														while ($data = dbarray($result)) {
														?>
														<option value="<?php echo $data['field_name']; ?>" <?php echo ($data['field_name']==$stud_cct?'selected':''); ?>><?php echo $data['field_name']; ?></option>		
														<?php	
														}
													}
												?>	
													</select>
												</td>
											</tr>
											<tr>
												<td colspan="4" align="center"> </td>
											</tr>
											<tr>
												<td colspan="4" align="center"><button type="submit" style="margin-right:0px" class="btn btn-primary">Save Student</button></td>
											</tr>
										</table>
										</form>
									</div>
								</div>
							</div>
						</div>
				<div id="sidebar" class="span3">
				<div id="side_accordion" class="accordion span12">
					<div class="accordion-group">
						<div id="accordion1">
							<div class="accordion-heading"><a href="#collapse1" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">Search Student: </a></div>
							<div class="accordion-inner">
								<div class="row-fluid"><br>
									<?php require_once('searchstudent.frm.inc.php'); ?>
								</div>		
							</div>
						</div>
					</div>	
				</div>
			</div>

					
						</div>	
						</div>	
						</div>	
						</div>	
						</div>	
	