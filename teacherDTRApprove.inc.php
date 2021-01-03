<?php
if(isset($_POST["submit"])) {
	$target_dir = "backupdb/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	if($imageFileType != "csv") {
		$message= "Sorry, only csv files are allowed.";
	} 
	else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.'checkinout.csv')) {
        $message= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. Click <a href=\"importcsv.php\">here</a> to deploy batch attendance.";
    } else {
        $message= "Sorry, there was an error uploading your file.";
    }
}
?>
		<div class="pagecontent container">

			<div class="page-header" style="margin-top: 20px">
				<h1>Approve Applied Logs</h1>
			</div>  
			<ol class="breadcrumb">
				<li><a href="<?php echo($_SESSION["user_role"]==2?"#":"./?page=teacher");?>">Teacher</a></li>
				<li class="active">DTR Dashboard</li>
			</ol>

			<div class="row row-toolbar">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-push-8 col-md-push-8 col-sm-push-8 col-xs-push-8 clearfix"></div>
	
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-pull-4 col-md-pull-4 col-sm-pull-4 col-xs-pull-4">
                <select <?php echo($_SESSION["user_role"]==2?"disabled":($_SESSION["user_role"]==3?"disabled":""));?> class="form-control" id="ui-classes" style="margin-top: 5px" onchange="if (this.value) window.location.href=this.value">
					<optgroup label="Filters"> 
						<option value=".?page=teacher&approveDTR&filter=all" <?php echo (isset($_GET['filter']) && $_GET['filter'] =="all"?"selected":"");?>>Applied Logs</option>
						<option value=".?page=teacher&approveDTR&filter=approved" <?php echo (isset($_GET['filter']) && $_GET['filter']=="approved"?"selected":"");?>>Approved Logs</option>
						<option value=".?page=teacher&approveDTR&filter=disapproved" <?php echo (isset($_GET['filter']) && $_GET['filter']=="disapproved"?"selected":"");?>>Disapproved Logs</option>
					</optgroup>
					<optgroup label="Faculty and Staff">  
					<?php
					$checkFaculty = dbquery("SELECT * FROM teacher WHERE teach_status = '1' ORDER BY teach_lname ASC, teach_fname asc");
					while($dataFaculty=dbarray($checkFaculty)){
					?>
						<option value=".?page=teacher&approveDTR&userid=<?php echo $dataFaculty['teach_bio_no']; ?>" <?php echo (isset($_GET['userid']) && $dataFaculty['teach_bio_no']==$_GET['userid']?"selected":"");?>><?php echo $dataFaculty['teach_lname'].", ".$dataFaculty['teach_fname']; ?></option>
					<?php } ?>
					</optgroup> 	
                </select>

          </div>
		</div>		
		<?php if ($current_school_code=="302887") {	?>
		<table width="60%" align="center">
			<tr>
				<form action="?page=teacher&approveDTR&filter=all" method="post" enctype="multipart/form-data">
					<td>Select Batch File (*.csv):</td>
					<td> <input type="file" name="fileToUpload" id="fileToUpload"  class=" form-control"></td>
					<td> <input type="submit" value="Upload Batch File" name="submit"  class=" form-control"></td>
				</form>
			</tr>
			<tr>
				<td colspan="3" align="center"><br><font color="blue"><?php echo (isset($_POST["submit"])?$message:"");?></font></td>
			</tr>
		</table><br>
		<?php } ?>
<div class="clearfix" style="margin-bottom: 5px;"></div>
    <div class="row">
        <div class="col-xs-12 col-md-12">              
    

										<div class="panel panel-default">
											<div class="panel-heading">
											<div class="btn-toolbar  pull-right">
													<div class="btn-group">
													<a href="missinglogsapplymassapprove.frm.php" <?php echo (isset($_GET['filter']) && $_GET['filter']!="all"?"disabled":"");?> title="Mass Approve" class="btn  btn-xs  btn-primary" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false">
														<span class="glyphicon glyphicon-plus"></span> Mass Approve</a>
													<a href="missinglogsapplymassdisapprove.frm.php" <?php echo (isset($_GET['filter']) && $_GET['filter']!="all"?"disabled":"");?> title="Mass Disapprove" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false">
														<span class="glyphicon glyphicon-minus"></span> Mass Disapprove</a>
													<a href="missinglogsapplymassdelete.frm.php" <?php echo (isset($_GET['filter']) && $_GET['filter']!="all"?"disabled":"");?> title="Mass Delete" class="btn  btn-xs  btn-danger" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false">
														<span class="glyphicon glyphicon-remove"></span> Mass Delete</a>
													</div>
												</div>
												As of  
												<?php
													echo date ('F, Y');
												?>
											</div>
											<div class="table-responsive">
												<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
													<thead>
														<tr>
															<th width="20%">Teacher</th>
															<th width="13%">Applied Date</th>
															<th width="3%">State</th>
															<th width="3%">Time</th>
															<th>Reason</th>	
															<th width="15%">Applied by</th>																
															<th width="15%">Date/Time Applied</th>
															<th width="8%"></th>
														</tr>
													</thead>
													<tbody>
													<?php
													if(isset($_GET['filter']) && $_GET['filter']=="all"){
														$filter="ml_approve_user_no=0  ";
													}
													else if(isset($_GET['filter']) && $_GET['filter']=="approved"){
														$filter="ml_approve_user_no>0  ";
													}
													else if(isset($_GET['filter']) && $_GET['filter']=="disapproved"){
														$filter="ml_approve_user_no<0  ";
													} 
													else {
														$filter="ml_userid=".$_GET['userid']."  ";
													}
													// $startStamp = $_GET['year']."-".$_GET['month']."-01";
													// $endStamp = $_GET['year']."-".$_GET['month']."-31";
													$checkMissingLogsApp = dbquery("select * from missinglogs where ($filter) order by ml_userid desc, ml_checkdate asc, ml_checktime asc limit 200");
													while($dataMissingLogsApp = dbarray($checkMissingLogsApp)){
													?>
														<tr>
															<?php
															$checkUserID = dbquery("select *  from teacher where teach_bio_no='".$dataMissingLogsApp['ml_userid']."'");
															$dataUserID = dbarray($checkUserID);
															?>
															<td><small><?php echo $dataUserID['teach_lname'].", ".$dataUserID['teach_fname']." ".$dataUserID['teach_xname'];?></small></td>
															<td><small><?php echo date('F d, Y', strtotime($dataMissingLogsApp['ml_checkdate']));?></small></td>
															<td><small><?php echo ($dataMissingLogsApp['ml_checktype']=="I"?"In":"Out");?></small></td>
															<td><small><?php echo date('g:ia', strtotime($dataMissingLogsApp['ml_checktime']));?></small></td>
															<?php
															$checkApprover = dbquery("select * from teacher where teach_no='".$dataMissingLogsApp['ml_approve_user_no']."'");
															$dataApprover = dbarray($checkApprover);
															?>
															<td><small><?php echo $dataMissingLogsApp['ml_reason'];?></small>
															<?php
															if($dataMissingLogsApp['ml_approve_user_no']!=0){
															?>
															<a href="#" title="Details" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="<?php echo "by ".($dataMissingLogsApp['ml_approve_user_no']==1?"SYSTEM ADMIN":$dataApprover['teach_lname'].", ".substr($dataApprover['teach_fname'],0,1).".")." on ".date('F d, Y @ g:ia', strtotime($dataMissingLogsApp['ml_approve_regdatetime'])+8*3600);?>"><span class="glyphicon glyphicon-zoom-in"></a>
															<?php
															}
															?>
															</td>
															<?php
															$checkUserID = dbquery("select *  from teacher where teach_no='".$dataMissingLogsApp['ml_apply_user_no']."'");
															$dataUserID = dbarray($checkUserID);
															?>
															<td><small><?php echo ($dataMissingLogsApp['ml_apply_user_no']=="1"?"SYSTEM ADMIN":$dataUserID['teach_lname'].", ".substr($dataUserID['teach_fname'],0,1).".");?></small></td>
															<td><small><?php echo date('F d, Y g:ia', strtotime($dataMissingLogsApp['ml_apply_regdatetime'])+ 8 * 3600);?></small></td>
															<?php
															$checkFromLog = dbquery("select * from checkinout where (USERID='".$dataMissingLogsApp['ml_userid']."' and CHECKTIME='".$dataMissingLogsApp['ml_checkdate']." ".$dataMissingLogsApp['ml_checktime']."')");
															$countFromLog = dbrows($checkFromLog);
															?>
															<td><a <?php echo ($countFromLog>0?"disabled":"");?>  href="missinglogsapprove.frm.php?ml_no=<?php echo $dataMissingLogsApp['ml_no'];?>" <?php echo ($dataMissingLogsApp['ml_approve_user_no']<0 || $dataMissingLogsApp['ml_approve_user_no']>0?"disabled":"");?> title="Approve/Disapprove Applied Logs" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
														<span class="glyphicon glyphicon-share"></span></a><a href="missinglogs.scr.php?ml_no=<?php echo $dataMissingLogsApp['ml_no'];?>&deleteApp=Yes" <?php echo ($dataMissingLogsApp['ml_approve_user_no']<0 || $dataMissingLogsApp['ml_approve_user_no']>0?"disabled":"");?> title="Delete Application"  onClick="return confirm('Are you sure you want to delete entry?')" class="btn  btn-xs  btn-default">
																<span class="glyphicon glyphicon-remove"></span></a></td>
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


        </div>


        </div>
    </div>



              </div>
            </div>
          </div>
        </div>