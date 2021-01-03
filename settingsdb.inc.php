<br>
<?php
/*
if(isset($_GET['installed']) && $_GET['installed']=="dbu_enr_tbl"){
	unlink('./updates/dbu_enr_tbl.php');
}
*/
?>
<div class="pagecontent container">
	<div class="page-header" style="margin-top: 20px">
		<h1>Database Updates</h1>
	</div> 
	<div class="tab-content">
		<div class="tab-pane active" id="view_ledger">
			<div class="row-fluid">
				<div class="span12"><br>
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="btn-toolbar  pull-right">
							<div class="btn-group">
																									
							</div>
							</div>
							
							Database Update History</div>
						<div class="table-responsive">
							<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
								<thead>
									<tr>
										<th width="3%">#</th>
										<th width="20%">Database Update #</th>
										<th>Update Details</th>
										<th width="20%">Date/Time of Update</th>
										<th width="10%"></th>					
									</tr>
								</thead>
								<tbody> 
									<tr>
										<td>1</td>
										<td>Re-zero Backup</td>
										<td>This re-zeroes the whole database. Please note that re-zeroing the database, deletes all information you have entered so far.</td>
										<td>May 1, 2018 @ 6:19AM</td>
										<td>
										<?php
										if (file_exists("./backupdb/sanhsmis.sql")){
										?>
										<a href="./confirmRezeroDB.frm.php" title="Restore Backup" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" onclick="return confirm('Are you sure you want to re-zero the database? This action will erase all your data...')">Re-zero Database</a>
										<?php
										}
										else  {
										?>
										File not found!</a>
										<?php
										}
										?>
										</td>
									</tr>
									<tr>
										<td>2</td>
										<td>BMI Requirement</td>
										<td>BMI lookup values have been integrated to the database for a more accurate identification of the BMI values and the corresponding interpretation.</td>
										<td>May 1, 2018 @ 2:27PM</td>
										<td>
										<?php
										$checkExist1 = dbquery("select 1 from nut_bmi");
										if($checkExist1!==FALSE){
											echo "Updated";
										} else {
											echo "<a href=updates/dbu_nut_bmi.php >Update now</a>";
										}
										?>
										</td>
									</tr>	
									<tr>
										<td>3</td>
										<td>AFH Requirement</td>
										<td>AFH lookup values have been integrated to the database for a more accurate identification of the AFH values and the corresponding interpretation.</td>
										<td>May 1, 2018 @ 2:27PM</td>
										<td>
										<?php
										$checkExist2 = dbquery("select 1 from nut_afh");
										if($checkExist2!==FALSE){
											echo "Updated";
										} else {
											echo "<a href=updates/dbu_nut_afh.php>Update now</a>";
										}
										?>
										</td>
									</tr>	
									<tr>
										<td>4</td>
										<td>SF10 Requirement</td>
										<td>Update enrollment table structure and contents to suit to the SF10 requirement
										<br>If updated already in MIS Version 1.14, please do not update again or it will scramble enrollment database.
										</td>
										<td>May 1, 2018 @ 2:27PM</td>
										<?php
										$checkSchool = dbquery("select * from studenroll limit 1");
										$dataSchool = dbarray($checkSchool);
										$countSchool = dbrows($checkSchool);
										$dataSchoolName = unserialize($dataSchool['enrol_school']);
										?>
										<td>
										<?php 
										if($countSchool==0){
											$schoolDetails = array($current_school_code,$current_school_full,$current_school_address);
											$schoolDetails_string = mysql_escape_string(serialize($schoolDetails));
											$inserEnrol = dbquery("insert into studenroll (enrol_school) values ('".$schoolDetails_string."')");
											?>
											<a href="updates/dbu_enr_tbl.php">Update now</a>
											<?php
										}
										else if(is_array($dataSchoolName)){
											echo "Updated";
										}
										else{
										?>
										<a href="updates/dbu_enr_tbl.php">Update now</a>
										<?php
										}
										?>
										</td>
									</tr>
									<tr>
										<td>5</td>
										<td>Fix Missing Teacher Contact Details</td>
										<td>Some installations where found to be missing with the Teacher Contact Details table.</td>
										<td>June 9, 2018 @ 2:27PM</td>
										<td>
										<?php
										$checkExist3 = dbquery("select 1 from teachercontacts");
										if($checkExist3!==FALSE){
											echo "Updated";
										} else {
											echo "<a href=updates/dbu_tea_con.php>Update now</a>";
										}
										?>
										</td>
									</tr>	
									<tr>
										<td>6</td>
										<td>Fix Missing SALN Tables</td>
										<td>Some installations where found to be missing with the SALN tables.</td>
										<td>June 9, 2018 @ 2:27PM</td>
										<td>
										<?php
										$checkExist4 = dbquery("select 1 from teachsaln");
										if($checkExist4!==FALSE){
											echo "Updated";
										} else {
											echo "<a href=updates/dbu_tea_sal.php>Update now</a>";
										}
										?>
										</td>
									</tr>
									<tr>
										<td>7</td>
										<td>SF9 Requirements</td>
										<td>Table creation script to store the Learner's Observed Values as reflected in SF9.</td>
										<td>September 25, 2018 @ 7:51PM</td>
										<td>
										<?php
										$checkExist5 = dbquery("select 1 from student_corevalues");
										if($checkExist5!==FALSE){
											echo "Updated";
										} else {
											echo "<a href=updates/dbu_stu_cv.php>Update now</a>";
										}
										?>
										</td>
									</tr>									
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



