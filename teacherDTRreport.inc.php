<?php
if(isset($_GET['reports'])) {
	$searchStudent = $_GET['reports'];
}
else{
	$searchStudent = "a";
}




	$result = dbquery("SELECT * FROM teacher WHERE teach_no='".$searchStudent."'");
	$rows = dbrows($result);
	$data = dbarray($result);

?>


		<div class="pagecontent container">

			<div class="page-header" style="margin-top: 20px">
				<div class="btn-group pull-right" style="margin-top: 0px;">
				<form class="navbar-form navbar-right" method="post" action="./?page=student" >
				<div class="form-group">
					<label class="control-label required" for="stud_lrn">Report Date <span title="Required" class="text-danger">* </span></label>
					<select name="month" class="form-control" onchange="if (this.value) window.location.href=this.value">
							<option value="">---select---</option>
						<?php
						$checkEntries = dbquery("select * from checkinout GROUP BY YEAR(CHECKTIME), MONTH(CHECKTIME), DAY(CHECKTIME)  ORDER BY CHECKTIME DESC");
						while($dataEntries = dbarray($checkEntries)){
						?>
							<option value="?page=teacher&reports=<?php echo $_GET['reports'];?>&year=<?php echo date('Y', strtotime($dataEntries['CHECKTIME']));?>&month=<?php echo date('m', strtotime($dataEntries['CHECKTIME']));?>&day=<?php echo date('d', strtotime($dataEntries['CHECKTIME']));?>" <?php echo (date('Y', strtotime($dataEntries['CHECKTIME']))==$_GET['year'] && date('m', strtotime($dataEntries['CHECKTIME']))==$_GET['month'] && date('d', strtotime($dataEntries['CHECKTIME']))==$_GET['day']?"selected":"");?>><?php echo date('F d, Y', strtotime($dataEntries['CHECKTIME']));?></option>
						<?php
						}
						?>
					</select>
					</div>
				</form>
				</div>

				<h1>DTR Reports Dashboard</h1>
			</div>  
			<ol class="breadcrumb">
				<li><a href="<?php echo($_SESSION["user_role"]==2?"#":"./?page=teacher");?>">Teacher</a></li>
				<li class="active">DTR Reports Dashboard</li>
			</ol>
			
			<div class="row row-toolbar">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-push-8 col-md-push-8 col-sm-push-8 col-xs-push-8 clearfix"></div>
	
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-pull-4 col-md-pull-4 col-sm-pull-4 col-xs-pull-4">
                <select <?php echo($_SESSION["user_role"]==2?"disabled":($_SESSION["user_role"]==3?"disabled":""));?> class="form-control" id="ui-classes" style="margin-top: 5px" onchange="if (this.value) window.location.href=this.value">
					<option value=".?page=teacher&reports=0&year=<?php echo $_GET['year'];?>&month=<?php echo $_GET['month'];?>&day=<?php echo $_GET['day'];?>">---select---</option>
					<option value=".?page=teacher&reports=0&year=<?php echo $_GET['year'];?>&month=<?php echo $_GET['month'];?>&day=<?php echo $_GET['day'];?>">***DISPLAY ALL***</option>
					<?php
					$checkFaculty = dbquery("SELECT * FROM teacher WHERE teach_status = '1' ORDER BY teach_lname ASC, teach_fname asc");
					while($dataFaculty=dbarray($checkFaculty)){
					?>
						<option value=".?page=teacher&reports=<?php echo $dataFaculty['teach_no']; ?>&year=<?php echo $_GET['year'];?>&month=<?php echo $_GET['month'];?>&day=<?php echo $_GET['day'];?>" <?php echo ($dataFaculty['teach_no']==$_GET['reports']?"selected":"");?>><?php echo strtoupper($dataFaculty['teach_lname'].", ".$dataFaculty['teach_fname']); ?></option>
					<?php } ?>	
                </select>

          </div>
		</div>	

		
			
<div class="clearfix" style="margin-bottom: 5px;"></div>
    <div class="row">
        <div class="col-xs-12 col-md-12">              
                <div class="panel-body">
					<div  class="tabbable">
						<ul class="nav nav-tabs">
							<li class="active" ><a href="#student_info" data-toggle="tab">DTR Report</a></li>
						</ul>
						
						<div class="tab-content">
							<div class="tab-pane active" id="student_info">
								<div class="row-fluid">
									<div class="span12"><br>
										<div class="panel panel-default">
											<div class="panel-heading">
											    <div class="btn-toolbar  pull-right">
													<div class="btn-group">
													<a onclick="window.open('showDTRreport.php?year=<?php echo $_GET['year'];?>&month=<?php echo $_GET['month'];?>&day=<?php echo $_GET['day'];?>', 'newwindow', 'width=850, height=600'); return false;" title="Print DTR" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-print"></span></a>
													</div>
												</div>
												For the Month of 
												<?php
													echo date('F d, Y',strtotime($_GET['year']."-".$_GET['month']."-".$_GET['day']));
												?>
											</div>
											<div class="table-responsive">
												<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
													<thead>
														<tr>
															<th width="20%">Teacher Name</th>
															<th width="4%">Date</th>
															<th width="5%">Day</th>
															<th width="10%">State</th>
															<th width="10%">Time Stamp</th>
															<th width="12%">Source</th>	
															<th>Remarks</th>																
															<th width="10%">Action</th>
														</tr>
													</thead>
													<tbody> 
													<?php
													if($_GET['reports']==1){
														$filter = "USERID=".$data['teach_bio_no']." and ";
													}
													else if($_GET['reports']==0){
														$filter = " ";
													}
													else{
														$filter = "USERID=".$data['teach_bio_no']." and ";
													}
													$startStamp = $_GET['year']."-".$_GET['month']."-".$_GET['day'];
													// $endStamp = $_GET['year']."-".$_GET['month']."-31 23:59:59";
													$checkCurrentLogs = dbquery("select * from checkinout inner join teacher on USERID=teach_bio_no where ($filter YEAR(CHECKTIME)='".$_GET['year']."' and MONTH(CHECKTIME)='".$_GET['month']."' and DAY(CHECKTIME)='".$_GET['day']."') order by CHECKTIME ASC");
													while($dataCurrentLogs = dbarray($checkCurrentLogs)){
													
													?>
														<tr>
															<?php
															$checkUserID = dbquery("select *  from teacher where teach_bio_no='".$dataCurrentLogs['USERID']."'");
															$dataUserID = dbarray($checkUserID);
															?>
															<td><small><?php echo $dataUserID['teach_lname'].", ".$dataUserID['teach_fname']." ".$dataUserID['teach_xname'];?></small></td>
															<td><small><?php echo date('d', strtotime($dataCurrentLogs['CHECKTIME']));?></small></td>
															<td><small><?php echo date('D', strtotime($dataCurrentLogs['CHECKTIME']));?></small></td>
															<td><small><?php echo ($dataCurrentLogs['CHECKTYPE']=="I"?"In":"Out");?></small>
															<?php 
																$stateCurrent = ($dataCurrentLogs['CHECKTYPE']=="I"?"In":"Out");
																$stateChange = ($dataCurrentLogs['CHECKTYPE']=="I"?"Out":"In");
															?>
																<a href="missinglogs.scr.php?ml_no=<?php echo $dataMissingLogsApp['ml_no'];?>&changeState=Yes&state=<?php echo $stateChange;?>&userid=<?php echo $dataCurrentLogs['USERID'];?>&checktime=<?php echo $dataCurrentLogs['CHECKTIME'];?>&checktype=<?php echo $dataCurrentLogs['CHECKTYPE'];?>" title="Change State"  onClick="return confirm('Are you sure you want to change the <?php echo $stateCurrent;?> state to the <?php echo $stateChange;?> state?')">
																<span class="glyphicon glyphicon-pencil"></span></a>
															</td>
															<td><small><?php echo date('g:ia', strtotime($dataCurrentLogs['CHECKTIME']));?></small></td>
															<td><small><?php echo ($dataCurrentLogs['UserExtFmt']=="1"?"From Machine":"<font color='red'>Manual</font>");?></td>
															<?php
															$ml_checkdate = substr($dataCurrentLogs['CHECKTIME'],0,10);
															$ml_checktime = substr($dataCurrentLogs['CHECKTIME'],11,8);
															
															$checkIfMissingLog = dbquery("select * from missinglogs	where (ml_userid='".$dataCurrentLogs['USERID']."' and ml_checkdate='$ml_checkdate' and ml_checktime='$ml_checktime' and ml_checktype='".$dataCurrentLogs['CHECKTYPE']."')");
															$countIfMissingLog = dbrows($checkIfMissingLog);
															$dataMissingLog = dbarray($checkIfMissingLog);
															$checkApprover = dbquery("select * from teacher where teach_no='".$dataMissingLog['ml_approve_user_no']."'");
															$dataApprover = dbarray($checkApprover);
															?>
															<td><small><?php echo ($countIfMissingLog>0?$dataMissingLog['ml_reason']:""); ?></small>
															<?php
															if($countIfMissingLog>0){
															?>
															<a href="#" title="Details" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="<?php echo "by ".($dataMissingLog['ml_approve_user_no']==1?"SYSTEM ADMIN":$dataApprover['teach_lname'].", ".substr($dataApprover['teach_fname'],0,1).".")." on ".date('F d, Y @ g:ia', strtotime($dataMissingLog['ml_approve_regdatetime'])+8*3600);?>"><span class="glyphicon glyphicon-zoom-in"></a>
															<?php
															}
															?>
															</td>
															<td><small>
																<a href="teacher.scr.php?teach_no=<?php echo $dataCurrentLogs['USERID'];?>&checktime=<?php echo $dataCurrentLogs['CHECKTIME'];?>&checktype=<?php echo $dataCurrentLogs['CHECKTYPE'];?>&deleteLog=Yes" title="Delete Log" <?php echo ($_SESSION["user_role"]==1?"":"disabled");?> onClick="return confirm('Are you sure you want to delete entry?')" class="btn  btn-xs  btn-default">
																<span class="glyphicon glyphicon-remove"></span></a>
																</small>
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
							
							<div class="tab-pane" id="student_logs">
								<div class="row-fluid">
									<div class="span12"><br>
										<div class="panel panel-default">
											<div class="panel-heading">
											    <div class="btn-toolbar  pull-right">
													<a href="missinglogsapply.frm.php?teach_no=<?php echo $data['teach_no'];?>" <?php echo ($_GET['showDTR']==0?"disabled":"");?> title="Manually Add Logs" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
														<span class="glyphicon glyphicon-plus"></span></a>
												</div>
												As of  
												<?php
													echo date('F, Y',strtotime($_GET['year']."-".$_GET['month']."-01"));
												?>
											</div>
											<div class="table-responsive">
												<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
													<thead>
														<tr>
															<th width="20%">Teacher Name</th>
															<th width="10%">Applied Date</th>
															<th width="3%">State</th>
															<th width="3%">Time</th>
															<th>Reason/Remarks</th>	
															<th width="15%">Approver</th>																
															<th width="15%">Date/Time Approved</th>
															<th width="8%"></th>
														</tr>
													</thead>
													<tbody>
													<?php
													$startStamp = $_GET['year']."-".$_GET['month']."-01";
													$endStamp = $_GET['year']."-".$_GET['month']."-31";
													$checkMissingLogsApp = dbquery("select * from missinglogs where (ml_userid='".$data['teach_bio_no']."' and ml_checkdate between '$startStamp' and '$endStamp') order by ml_approve_user_no asc, ml_apply_regdatetime desc limit 0,120");
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
															<td><small><?php echo $dataMissingLogsApp['ml_reason'];?></small></td>
															<?php
															$teach_no = ($dataMissingLogsApp['ml_approve_user_no']<0?$dataMissingLogsApp['ml_approve_user_no']*-1:$dataMissingLogsApp['ml_approve_user_no']);
															$checkUserID = dbquery("select *  from teacher where teach_no='".$teach_no."'");
															$dataUserID = dbarray($checkUserID);
															?>
															<td><small><?php echo ($dataMissingLogsApp['ml_approve_user_no']==0?"":($dataMissingLogsApp['ml_approve_user_no']==1?"SYSTEM ADMIN":$dataUserID['teach_lname'].", ".substr($dataUserID['teach_fname'],0,1)."."));?></small></td>
															<td><small><?php echo ($dataMissingLogsApp['ml_approve_regdatetime']==0?"":date('F d, Y g:ia', strtotime($dataMissingLogsApp['ml_approve_regdatetime'])));?></small></td>
															<td><a <?php echo ($dataMissingLogsApp['ml_approve_user_no']!=0?"disabled":"");?> href="missinglogs.scr.php?ml_no=<?php echo $dataMissingLogsApp['ml_no'];?>&deleteApp=Yes" title="Delete Application"  onClick="return confirm('Are you sure you want to delete entry?')" class="btn  btn-xs  btn-default">
																<span class="glyphicon glyphicon-remove"></span></a>
																<?php
																$checkFromLog = dbquery("select * from checkinout where (USERID='".$dataMissingLogsApp['ml_userid']."' and CHECKTIME='".$dataMissingLogsApp['ml_checkdate']." ".$dataMissingLogsApp['ml_checktime']."')");
																$countFromLog = dbrows($checkFromLog);
																?>
																<a <?php echo ($countFromLog>0?"disabled":"");?> href="missinglogsapprove.frm.php?ml_no=<?php echo $dataMissingLogsApp['ml_no'];?>" title="Approve/Disapprove Applied Logs" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
																<span class="glyphicon glyphicon-share"></span></a>
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
			</div>

            </div>


        </div>


        </div>
    </div>



              </div>
            </div>
          </div>
        </div>