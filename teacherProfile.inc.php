<?php
if(isset($_GET['showProfile'])) {
	$searchStudent = $_GET['showProfile'];
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
								<input <?php echo($_SESSION["user_role"]==2?"disabled":"");?> type="text" name="searchStudent" class="form-control" placeholder="Search Teacher..." value="<?php echo (isset($_POST['searchStudent'])?$_POST['searchStudent']:""); ?>" autofocus>
								<div class="input-group-btn">
									<button <?php echo($_SESSION["user_role"]==2?"disabled":"");?> class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
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
				<li><a href="<?php echo($_SESSION["user_role"]==2?"#":"./?page=teacher");?>">Teacher</a></li>
				<li class="active">Teacher Profile</li>
			</ol>
			
			
<div class="clearfix" style="margin-bottom: 5px;"></div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="btn-toolbar  pull-right">
						<div class="btn-group">
							<a <?php echo($_SESSION["user_role"]==2?"disabled":"");?> <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  href="./teacherProfileCamera.frm.php?teach_no=<?php echo $_GET['showProfile'];?>" title="Image Uploader" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
								<span class="glyphicon glyphicon-camera"></span></a>
							<a <?php echo($_SESSION["user_role"]==2?"disabled":"");?> title="Print Temp Pass" class="btn  btn-xs  btn-default" onclick="window.open('teachPass.php?teach_no=<?php echo $data['teach_no']; ?>', 'newwindow', 'width=700, height=500'); return false;">
								<span class="glyphicon glyphicon-credit-card"></span></a>
								<?php
								$checkTeacherStatus = dbquery("select * from teacher where teach_no='".$_GET['showProfile']."'");
								$resultTeacherStatus = dbarray($checkTeacherStatus);
								?>
							<a <?php echo($_SESSION["user_role"]==2?"disabled":"");?> <?php echo ($_SESSION["user_role"]==0?"disabled":"");?> <?php echo ($resultTeacherStatus['teach_status']==1?"disabled":"");?> href="./userTools.scr.php?reactivateTeacher=Yes&teach_no=<?php echo $data['teach_no'];?>" title="Reactivate Account" class="btn  btn-xs  btn-default" onclick="return confirm('Are you sure you want to reactivate account?')">
								<span class="glyphicon glyphicon-repeat"></span></a>	
							<a <?php echo($_SESSION["user_role"]==2?"disabled":"");?> <?php echo ($_SESSION["user_role"]==0?"disabled":"");?> <?php echo ($resultTeacherStatus['teach_status']==0?"disabled":"");?> href="./userTools.scr.php?deactivateTeacher=Yes&teach_no=<?php echo $data['teach_no'];?>" title="Deactivate Account" class="btn  btn-xs  btn-default" onclick="return confirm('Are you sure you want to deactivate account?')">
								<span class="glyphicon glyphicon-scissors"></span></a>		
                            <a href="./?page=teacher&updateProfile=<?php echo $data['teach_no'];?>" title="Update" class="btn  btn-xs  btn-default">
								<span class="glyphicon glyphicon-pencil"></span></a>

						</div>
                    </div>
                    Profile
                </div>
                
                <div class="panel-body">
					<div class="row-fluid">
						<div class="media">
							<?php
							$student_image = "./assets/images/teachers/".$data['teach_no'].".jpg";
							$no_image = "./assets/images/noimage.jpg";
									
							?>
							<div class="col-xs-6 col-md-2">
							<?php
							if ($_SESSION["user_role"]==0 || $_SESSION["user_role"]==2){
								$access = "#";
								$popUp = "";
							}
							else {
								$access = "./cameraapp/index2.php?showProfile=".$_GET['showProfile'];
								$popUp = "onclick";
							}
							?>
							<a class="thumbnail" href="<?php echo $access;?>" <?php echo $popUp;?>="return pop_up(this, 'Pop Up')">
								<img src="<?php echo (file_exists($student_image) ? $student_image : $no_image); ?>" alt="" style="max-width:143px; max-height:143px" />
							</a>
							</div>
							<div class="media-body">
								<h3 class="media-heading"> <span style="font-size:25px;font-weight:normal"><?php echo strtoupper($data['teach_lname']).", ".strtoupper($data['teach_fname'])." ".strtoupper($data['teach_xname'])." ".strtoupper($data['teach_mname']); ?></h3>
								<h5> <span class="glyphicon glyphicon-barcode"> <span style="font-size:13px;font-weight:normal"><?php echo $data['teach_id'];?></h5>
								<h5> <span class="glyphicon glyphicon-credit-card"> <span style="font-size:13px;font-weight:normal"><?php echo $data['teach_tin'];?></h5>
								<h5> <span class="glyphicon glyphicon-home"> <span style="font-size:13px;font-weight:normal"><?php echo $data['teach_residence'];?></h5>
							</div>
						</div>
					</div>

					<div  class="tabbable"><br>
						<ul class="nav nav-tabs">
							<li class="<?php echo ($_GET['tab']=="info"?"active":"");?>" ><a href="?page=teacher&showProfile=<?php echo $_GET['showProfile'];?>&tab=info">Teacher Data</a></li>
							<li class="<?php echo ($_GET['tab']=="ids"?"active":"");?>"><a href="?page=teacher&showProfile=<?php echo $_GET['showProfile'];?>&tab=ids">Teacher IDs</a></li>
							<li class="<?php echo ($_GET['tab']=="education"?"active":"");?>"><a href="?page=teacher&showProfile=<?php echo $_GET['showProfile'];?>&tab=education">Educational Background</a></li>
							<li class="<?php echo ($_GET['tab']=="appointments"?"active":"");?>"><a href="?page=teacher&showProfile=<?php echo $_GET['showProfile'];?>&tab=appointments">Appointments & Designations</a></li>
							<li class="<?php echo ($_GET['tab']=="loads"?"active":"");?>"><a href="?page=teacher&showProfile=<?php echo $_GET['showProfile'];?>&tab=loads">Current Subject Loads</a></li>
							<li class="<?php echo ($_GET['tab']=="201"?"active":"");?>"><a href="?page=teacher&showProfile=<?php echo $_GET['showProfile'];?>&tab=201">201 Remarks</a></li>
						</ul>
						
						<div class="tab-content">
							<div class="<?php echo ($_GET['tab']=="info"?"tab-pane active":"tab-pane");?>" id="info">
								<div class="row-fluid">
									<div class="span12"><br>
										<div class="panel panel-default">
											<div class="panel-heading">
											    <div class="btn-toolbar  pull-right">
													<a href="./?page=teacher&updateProfile=<?php echo $data['teach_no'];?>" title="Update" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-pencil"></span></a>
												</div>
												Personal Details
											</div>
											<div class="table-responsive">
												<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
													<thead>
														<tr>
															<th width="20%">Fields</th>
															<th>Details</th>
														</tr>
													</thead>
													<tbody> 
														<tr>
															<td>Teacher #</td>
															<td><?php echo $data['teach_no'];?></td>
														</tr>														
														<tr>
															<td>DepEd ID</td>
															<td><?php echo strtoupper($data['teach_id']);?></td>
														</tr>
														<tr>
															<td>Last name</td>
															<td><?php echo strtoupper($data['teach_lname']);?></td>
														</tr>
														<tr>
															<td>First name</td>
															<td><?php echo strtoupper($data['teach_fname']);?></td>
														</tr>
														<tr>
															<td>Middle name</td>
															<td><?php echo strtoupper($data['teach_mname']);?></td>
														</tr>
														<tr>
															<td>Ext. name</td>
															<td><?php echo $data['teach_xname'];?></td>
														</tr>
														<tr>
															<td>Gender</td>
															<td><?php echo $data['teach_gender'];?></td>
														</tr>
														<tr>
															<td>Birth date</td>
															<td>
															<?php 
															$phpdate = strtotime($data['teach_bdate']);
															echo $mysqldate = date('F d, Y', $phpdate);
															$date1 = strtotime(date("Y-m-d"));
															$date2 = strtotime($data['teach_bdate']);
															$time_difference = $date1 - $date2;
															$seconds_per_year = 60*60*24*365;
															$years = (int) ($time_difference / $seconds_per_year);
															echo " <small>($years years old)</small>";
														?>													
															</td>
														</tr>
														<tr>
															<td>Current residence</td>
															<td><?php echo $data['teach_residence'];?></td>
														</tr>
														<tr>
															<td>Civil Status</td>
															<td><?php echo $data['teach_cstatus'];?></td>
														</tr>														
														<tr>
															<td>Tax Identification Number</td>
															<td><?php echo $data['teach_tin'];?></td>
														</tr>
														<tr>
															<td>Contact Number</td>
															<td><?php echo $data['teach_dialect'];?></td>
														</tr>
														<tr>
															<td>Email Address</td>
															<td><?php echo $data['teach_ethnicity'];?></td>
														</tr>														
														</tbody>
												</table>
											</div>
										</div>	
										<tr>	
										<?php
										$resultUser = dbquery("select * from users where user_no='".$data['teach_create_user_no']."'");
										$dataUser = dbarray($resultUser);
										?>
										<td colspan="9">
										<i>Created by <strong><small><?php echo $dataUser['user_fullname'] ;?> </strong></small> on <strong><small><?php echo date('F d, Y g:ia', strtotime($data['teach_cretedatetime']) + 8.0 * 3600);?></strong></small>	
										<?php
										$resultUser = dbquery("select * from users where user_no='".$data['teach_create_user_no']."'");
										$dataUser = dbarray($resultUser);
										?>
										</strong></small><br>
										Last modified by <strong><small><?php echo $dataUser['user_fullname']; ?></strong></small> on <strong><small><?php echo date('F d, Y g:ia', strtotime($data['teach_lastmoddatetime']) + 8.0 * 3600);?></strong></small></i></td>
										</tr>		

									</div>
								</div>
							</div>
							<div class="<?php echo ($_GET['tab']=="ids"?"tab-pane active":"tab-pane");?>" id="ids">
								<div class="row-fluid">
									<div class="span12"><br>
										<div class="panel panel-default">
											<div class="panel-heading">
											    <div class="btn-toolbar  pull-right">
													<a <?php echo ($_SESSION["user_role"]==3?"disabled=disabled":"");?> href="teacherIDNew.frm.php?stud_no=<?php echo $_GET['showProfile'];?>" title="Add New" data-toggle="modal" data-target="#modal-medium"  data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-plus"></span></a>
												</div>
												Personal Identification
											</div>
											<div class="table-responsive">
												<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
													<thead>
														<tr>
															<th width="20%">Fields</th>
															<th>Details</th>
															<th>Date Issued</th>
															<th>Place Issued</th>
															<th width="10%"></th>
														</tr>
													</thead>
													<tbody> 
														<tr>
															<td>Biometric ID</td>
															<td><?php echo $data['teach_bio_no'];?></td>
															<td>-</td>
															<td><?php echo $current_school_full;?></td>
															<td><a <?php echo ($_SESSION["user_role"]==2?"disabled":"");?> href="teacherBioIDUpdate.frm.php?teach_no=<?php echo $data['teach_no']; ?>" title="Update" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
																<span class="glyphicon glyphicon-pencil"></span></a></td>
														</tr>
													<?php
														$selectIDS = dbquery("SELECT * FROM teacherids WHERE teacherids_teach_no='".$data['teach_no']."' ORDER BY teacherids_date_issued ASC");
														while($rowIDS = dbarray($selectIDS)){
													?>									
														<tr>
															<td><?php echo $rowIDS['teacherids_id'];?></td>
															<td><?php echo $rowIDS['teacherids_details'];?></td>
															<td><?php echo $rowIDS['teacherids_date_issued'];?></td>
															<td><?php echo $rowIDS['teacherids_place_issued'];?></td>
															<td><a href="teacherIDUpdate.frm.php?anec_no=<?php echo $rowIDS['teacherids_no']; ?>" title="Update" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
																<span class="glyphicon glyphicon-pencil"></span></a>
																<a href="teacherID.scr.php?DeleteAnec=Yes&anec_no=<?php echo $rowIDS['teacherids_no']; ?>" title="Delete" onClick="return confirm('Are you sure you want to delete entry?')" class="btn  btn-xs  btn-default">
																<span class="glyphicon glyphicon-remove"></span></a>
															</td>
														</tr>	
													<?php
														}
													?>
													</tbody>
												</table>
											</div>
										</div>														

									</div>
								</div>
							</div>	
							<div class="<?php echo ($_GET['tab']=="appointments"?"tab-pane active":"tab-pane");?>" id="appointments">
								<div class="row-fluid">
									<div class="span12"><br>
										<div class="panel panel-default">
											<div class="panel-heading">
											    <div class="btn-toolbar  pull-right">
													<a <?php echo ($_SESSION["user_role"]==3?"disabled=disabled":"");?> href="teacherAppointmentNew.frm.php?stud_no=<?php echo $_GET['showProfile'];?>" title="Add New" data-toggle="modal" data-target="#modal-medium"  data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-plus"></span></a>
												</div>
												Appointments
											</div>
											<div class="table-responsive">
												<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
													<thead>
														<tr>
															<th width="25%">Item Number</th>
															<th>Position</th>
															<th>Date of Appointment</th>
															<th>First Day of Service</th>
															<th>Status</th>
															<th>Funding</th>
															<th width="15%"></th>
														</tr>
													</thead>
													<tbody> 
													<?php
														$selectAppointments = dbquery("SELECT * FROM teacherappointments WHERE (teacherappointments_teach_no='".$data['teach_no']."' AND teacherappointments_item_no!='ANCILLARY') ORDER BY teacherappointments_date DESC");
														while($rowAppointments= dbarray($selectAppointments)){
													?>									
														<tr>
															<td><?php echo strtoupper($rowAppointments['teacherappointments_item_no']);?></td>
															<td><?php echo strtoupper($rowAppointments['teacherappointments_position']);?></td>
															<td><?php echo $rowAppointments['teacherappointments_date'];?>  </td>
															<td><?php echo $rowAppointments['teacherappointments_fdaydate'];?>  </td>
															<td><?php echo $rowAppointments['teacherappointments_status'];?></td>
															<td><?php echo $rowAppointments['teacherappointments_funding'];?></td>
															<td>
																<a disabled href="teacherAppointment.scr.php?UpdateActive=Yes&teacherappointments_no=<?php echo $rowAppointments['teacherappointments_no'];?>&teacherappointments_teach_no=<?php echo $rowAppointments['teacherappointments_teach_no'];?>&value=<?php echo ($rowAppointments['teacherappointments_active']=='1'?'0':'1');?>" onClick="return confirm('Are you sure you want to activate/deactivate entries?')" title="Activate Appointment" class="btn  btn-xs  btn-default"><?php echo ($rowAppointments['teacherappointments_active']=='1'?"<span class='glyphicon glyphicon-check'></span>":"<span class='glyphicon glyphicon-ok'></span>");?></a>																
																<a href="teacherAppointmentUpdate.frm.php?anec_no=<?php echo $rowAppointments['teacherappointments_no']; ?>" title="Update" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
																<span class="glyphicon glyphicon-pencil"></span></a>
																<a href="teacherAppointment.scr.php?DeleteAnec=Yes&anec_no=<?php echo $rowAppointments['teacherappointments_no']; ?>" title="Delete" onClick="return confirm('Are you sure you want to delete entry?')" class="btn  btn-xs  btn-default">
																<span class="glyphicon glyphicon-remove"></span></a>
															</td>
														</tr>	
													<?php
														}
													?>
													</tbody>
												</table>
											</div>
										</div>	
										<div class="panel panel-default">
											<div class="panel-heading">
											    <div class="btn-toolbar  pull-right">
													<a <?php echo ($_SESSION["user_role"]==2?"disabled=disabled":"");?> href="teacherDesignationNew.frm.php?stud_no=<?php echo $_GET['showProfile'];?>" title="Add New" data-toggle="modal" data-target="#modal-medium"  data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-plus"></span></a>
												</div>
												Designations / Ancillaries
											</div>
											<div class="table-responsive">
												<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
													<thead>
														<tr>
															<th width="25%">Designation</th>
															<th>Date of Designation</th>
															<th>Start School Year</th>
															<th>End School Year</th>
															<th width="15%"></th>
														</tr>
													</thead>
													<tbody> 
													<?php
														$selectAppointments = dbquery("SELECT * FROM teacherappointments WHERE (teacherappointments_teach_no='".$data['teach_no']."' AND teacherappointments_item_no='ANCILLARY') ORDER BY teacherappointments_date DESC");
														while($rowAppointments= dbarray($selectAppointments)){
													?>									
														<tr>
															<td><?php echo strtoupper($rowAppointments['teacherappointments_position']);?></td>
															<td><?php echo $rowAppointments['teacherappointments_date'];?>  </td>
															<td><?php echo $rowAppointments['teacherappointments_status'];?>-<?php echo $rowAppointments['teacherappointments_status']+1;?></td>
															<td><?php echo ($rowAppointments['teacherappointments_funding']==0?"until present":$rowAppointments['teacherappointments_funding']."-".($rowAppointments['teacherappointments_funding']+1));?></td>
															<td>
																<a href="teacherDesignationUpdate.frm.php?anec_no=<?php echo $rowAppointments['teacherappointments_no']; ?>" title="Update" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
																<span class="glyphicon glyphicon-pencil"></span></a>
																<a href="teacherAppointment.scr.php?DeleteAnec=Yes&anec_no=<?php echo $rowAppointments['teacherappointments_no']; ?>" title="Delete" onClick="return confirm('Are you sure you want to delete entry?')" class="btn  btn-xs  btn-default">
																<span class="glyphicon glyphicon-remove"></span></a>
															</td>
														</tr>	
													<?php
														}
													?>
													</tbody>
												</table>
											</div>
										</div>											
									</div>
								</div>
							</div>										

							<div class="<?php echo ($_GET['tab']=="loads"?"tab-pane active":"tab-pane");?>" id="loads">
								<div class="row-fluid">
									<div class="span12"><br>
										<div class="panel panel-default">
											<div class="panel-heading">
											    <div class="btn-toolbar  pull-right">
													<a title="Print Load" class="btn  btn-xs  btn-default" onclick="window.open('facultyLoadProfile.php?teach_no=<?php echo $_GET['showProfile'];?>', 'newwindow', 'width=870, height=520'); return false;">
														<span class="glyphicon glyphicon-print"></span></a>
												</div>
												Current Subject Loads / SY <?php echo $current_sy;?>-<?php echo $current_sy+1;?> /  <?php echo ($current_sem==1?"First":"Second");?> Semester
											</div>
											<div class="table-responsive">
												<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
													<thead>
														<tr>
															<th width="18%">Course Code</th>
															<th>Descriptive Title</th>
															<th width="3%">Units</th>
															<th width="20%">Time</th>
															<th width="10%">Days</th>
															<th width="15%">Class / Room</th>
														</tr>
													</thead>
													<tbody> 
													<?php
														$checkLoads = dbquery("SELECT * FROM class INNER JOIN prospectus ON class_pros_no=pros_no WHERE (class_sy='".$current_sy."' AND class_user_name='".$data['teach_no']."') ORDER BY pros_sem ASC, class_timeslots ASC");
														$countUnits=0;
														while($dataLoads = dbarray($checkLoads)){
														if(substr($dataLoads['pros_title'],0,3)!="***"){
													?>									
														<tr>
															<?php
															$checkEnrolled = dbquery("SELECT * FROM grade WHERE grade_class_no='".$dataLoads['class_no']."'");
															$countEnrolled = dbrows($checkEnrolled)
															
															?>
															<td><?php echo $dataLoads['pros_title'];?> (<?php echo $dataLoads['class_section_no'];?>)</a> 
															/ <?php echo ($dataLoads['pros_sem']=="1"?"1st":($dataLoads['pros_sem']=="2"?"2nd":"FY"));?></td>
															<td><?php echo $dataLoads['pros_desc'];?> </td>
															<td><?php echo $dataLoads['pros_unit'];?></td>
															<td><?php echo $dataLoads['class_timeslots'];?></td>
															<td><?php echo $dataLoads['class_days'];?></td>
															<td><?php echo $dataLoads['class_room'];?> </td>
														</tr>	
													<?php
														$countUnits+=$dataLoads['pros_unit'];
														}
														}
													?>
													<?php
														$checkAdvisory = dbquery("SELECT * FROM section WHERE (section_adviser='".$_GET['showProfile']."' AND section_sy='".$current_sy."')");
														$dataAdvisory = dbarray($checkAdvisory);
														$countAdvisory = dbrows($checkAdvisory);
														if($countAdvisory>0){
														
													?>
													<tr>
														
														<td><a href="#" onclick="window.open('./classProgram.php?section=<?php echo $dataAdvisory['section_name'];?>&enrol_sy=<?php echo $current_sy;?>&enrol_sem=<?php echo $current_sem;?>', 'newwindow', 'width=850, height=800'); return false;"><?php echo $dataAdvisory['section_name'];?></a> / FY</td>
														<td>Advisory</td>
														<td>1</td>
														<td>07:45-17:00</td>
														<td>M-F</td>
														<td><?php echo $dataAdvisory['section_name'];?></td>
														<td><a <?php echo($_SESSION["user_role"]==2?"disabled":"");?> href="#" title="Update" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
															<span class="glyphicon glyphicon-pencil"></span></a>
														</td>
													</tr>	
													<?php
													}
													?>

													<tr>
														<td></td>
														<td align="right"><b>Total Units</b></td>
														<td><b><?php echo round($countUnits+$countAdvisory,4);?></b></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
													</tbody>
												</table>
											</div>
										</div>														
									</div>
								</div>
							</div>	
							<div class="<?php echo ($_GET['tab']=="201"?"tab-pane active":"tab-pane");?>" id="201">
								<div class="row-fluid">
									<div class="span12"><br>
										<div class="panel panel-default">
											<div class="panel-heading">
												<div class="btn-toolbar  pull-right">
													<a <?php echo($_SESSION["user_role"]==2?"disabled":"");?> <?php echo ($_SESSION["user_role"]==3?"disabled=disabled":"");?> href="anecdotalNew.frm.php?stud_no=<?php echo $_GET['showProfile'];?>" title="Add New" data-toggle="modal" data-target="#modal-medium"  data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-plus"></span></a>
												</div>
												201 Remarks</div>
											<div class="table-responsive">
												<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
													<thead>
														<tr>
													<th width="10%">Case Number</th>
													<th width="10%">Date</th>
													<th width="20%">Description</th>
													<th width="30%">Details</th>
													<th width="20%">Counselor</th>
													<th width="10%"></th>
												</tr>
											</thead>
											<tbody> 
											<?php
											$resultAnec = dbquery("SELECT * FROM anecdotal INNER JOIN users ON anecdotal.anec_user_name=users.user_name WHERE anecdotal.anec_stud_no='".$_GET['showProfile']."' order by anec_date asc");
											while($dataAnec = dbarray($resultAnec)){
											?>
												<tr>
													<td><?php echo $dataAnec['anec_no']; ?></td>
													<td><?php echo $dataAnec['anec_date']; ?></td>
													<td><?php echo $dataAnec['anec_desc']; ?></td>
													<td><?php echo substr($dataAnec['anec_details'],0,90); ?>...
													<a href="" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="<?php echo $dataAnec['anec_details']; ?>">
														<span class="glyphicon glyphicon-zoom-in"></span></a>
													
													</td>
													<td><?php echo $dataAnec['user_fullname']; ?></td>
													<td><a <?php echo($_SESSION["user_role"]==2?"disabled":"");?> href="anecdotalUpdate.frm.php?anec_no=<?php echo $dataAnec['anec_no']; ?>" title="Update" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-pencil"></span></a>
														<a <?php echo($_SESSION["user_role"]==2?"disabled":"");?> href="anecdotal.scr.php?DeleteAnec=Yes&anec_no=<?php echo $dataAnec['anec_no']; ?>" title="Delete" 
															onClick="return confirm('Are you sure you want to delete entry?')" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-remove"></span></a></td>
												</tr>
											<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>		
							<div class="<?php echo ($_GET['tab']=="education"?"tab-pane active":"tab-pane");?>" id="education">
								<div class="row-fluid">
									<div class="span12"><br>
										<div class="panel panel-default">
											<div class="panel-heading">
												<div class="btn-toolbar  pull-right">
													<a <?php echo ($_SESSION["user_role"]==3?"disabled=disabled":"");?> href="teacherEBNew.frm.php?stud_no=<?php echo $_GET['showProfile'];?>" title="Add New" data-toggle="modal" data-target="#modal-medium"  data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-plus"></span></a>
												</div>
												Educational Background</div>
											<div class="table-responsive">
												<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
													<thead>
														<tr>
													<th width="15%">Level</th>
													<th>Degree</th>
													<th width="30%">Major</th>
													<th width="25%">Minor</th>
													<th width="15%">Units</th>
													<th width="25%"></th>
												</tr>
											</thead>
											<tbody> 
											<?php
											$resultAnec = dbquery("SELECT * FROM teacher_ebackground WHERE eback_teach_no='".$_GET['showProfile']."' ORDER BY eback_no ASC");
											while($dataAnec = dbarray($resultAnec)){
											?>
												<tr>
													<td><?php echo strtoupper($dataAnec['eback_level']); ?></td>
													<td><?php echo strtoupper($dataAnec['eback_degree']); ?></td>
													<td><?php echo strtoupper($dataAnec['eback_major']); ?></td>
													<td><?php echo strtoupper($dataAnec['eback_minor']); ?></td>
													<td><?php echo ($dataAnec['eback_units']==100?"GRADUATED":$dataAnec['eback_units']); ?></td>
													
													<td><a href="teacherEBUpdate.frm.php?anec_no=<?php echo $dataAnec['eback_no']; ?>" title="Update" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-pencil"></span></a>
														<a href="teacherEBUpdate.frm.php?DeleteAnec=Yes&anec_no=<?php echo $dataAnec['eback_no']; ?>" title="Delete" 
															onClick="return confirm('Are you sure you want to delete entry?')" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-remove"></span></a></td>
												</tr>
											<?php } ?>
													</tbody>
												</table>
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



              </div>
            </div>
          </div>
        </div>