<?php
$checkSALNdet = dbquery("select * from teachsaln where teachSaln_no='".$_GET['edit']."'");
$dataSALN = dbarray($checkSALNdet);

if(isset($_GET['done']) && $_GET['done']=="yes"){
	echo '<script>window.location = ".?page=teacher&showSALN='.$_GET['editSALN'].'&year='.$_GET['year'].'";</script>';
}
else{
	//$updateSALN = dbquery("update teachsaln set teachSaln_status='2', teachSaln_moduser='".$_SESSION["userid"]."', teachSaln_moddatetime=NOW() where teachSaln_no='".$_GET['edit']."'");
}

$checkSALNdet = dbquery("select * from teachsaln where teachSaln_no='".$_GET['edit']."'");
$dataSALN = dbarray($checkSALNdet);

$checkTeacher = dbquery("SELECT * FROM teacher WHERE (teach_no='".$_GET['editSALN']."')");
$dataTeacher = dbarray($checkTeacher);
?>


<div class="pagecontent container">

	<div class="page-header" style="margin-top: 20px">
		<div class="btn-group pull-right" style="margin-top: 0px;">
			<h3>
			<a href="#"  title="View/Print SALN" class="btn  btn-xs  btn-default" <?php echo ($dataSALN['teachSaln_status']!=3?"disabled":"");?> onclick="window.open('teacherSALNview.php?teachSaln_no=<?php echo $dataSALN['teachSaln_no'];?>', 'newwindow', 'width=1024, height=600'); return false;">
				<span class="glyphicon glyphicon-print"> SALN # <?php echo $_GET['edit'];?></span></a>
			
			</h3>
		</div>
		<h1>SALN Dashboard <?php echo "";?></h1>
	</div> 
		
	<ol class="breadcrumb">
		<li><a href="<?php echo($_SESSION["user_role"]==2?"#":"./?page=teacher");?>">Teacher</a></li>
		<!--<li><a href="?page=teacher&manageSALN=<?php echo $_GET['editSALN'];?>&year=<?php echo $_GET['year'];?>">SALN Dashboard</a></li>-->
		<li class="active">Update SALN for <?php echo $dataSALN['teachSaln_issueyear'];?> Fiscal Year</li>
	</ol>
		
	
			
	<form id="enrol" method="post" action="./teacherSALNedit.scr.php?save=Yes">
	<button type="submit" name="submit" id="submit" class="btn btn-primary pull-right"  onclick="return confirm('Are you sure you are done?')">Done</button>&nbsp;&nbsp;
	<input type="hidden" name="teachSaln_no" value="<?php echo $_GET['edit'];?>">
	<div class="clearfix" style="margin-bottom: 5px;"></div>
	<div class="card">
		<div class="card-heading simple">Part I. Declarant's Information</div>
		<div class="card-body">
			<div class="row">
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_fname">Status <span title="Required" class="text-danger">*</span></label>
						<br>
						<input type="radio" disabled name="teachSaln_status" value="2" <?php echo ($dataSALN['teachSaln_status']==2?"checked":"");?>> In Progress<br>
						<input type="radio" disabled name="teachSaln_status" value="3" <?php echo ($dataSALN['teachSaln_status']==3?"checked":"");?>> Done<br>
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_fname">Type of Filing <span title="Required" class="text-danger">*</span></label>
						<br>
						<input type="radio" name="teachSaln_filetype" value="./teacherSALNedit.scr.php?edit=<?php echo $_GET['edit'];?>&editFileType=yes&value=1" onclick="if (this.value) window.location.href=this.value" <?php echo ($dataSALN['teachSaln_filetype']==1?"checked":"");?>> Joint<br>
						<input type="radio" name="teachSaln_filetype" value="./teacherSALNedit.scr.php?edit=<?php echo $_GET['edit'];?>&editFileType=yes&value=2" onclick="if (this.value) window.location.href=this.value" <?php echo ($dataSALN['teachSaln_filetype']==2?"checked":"");?>> Separate<br>
						<input type="radio" name="teachSaln_filetype" value="./teacherSALNedit.scr.php?edit=<?php echo $_GET['edit'];?>&editFileType=yes&value=3" onclick="if (this.value) window.location.href=this.value" <?php echo ($dataSALN['teachSaln_filetype']==3?"checked":"");?>> Not Applicable
					</div>
				</div>				
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_mname">Declarant <span title="Required" class="text-danger">*</span></label>
						<br>
						<strong><?php echo $dataTeacher['teach_lname'];?>, <?php echo $dataTeacher['teach_fname'];?> <?php echo ($dataTeacher['teach_xname']==""?"":$dataTeacher['teach_xname']);?> <?php echo ($dataTeacher['teach_mname']==""?"":substr($dataTeacher['teach_mname'],0,1).".");?></strong><br>
						<?php echo strtoupper($dataTeacher['teach_residence']);?><br>
						<?php $checkPosition=dbquery("select * from teacherappointments WHERE (teacherappointments_teach_no='".$dataTeacher['teach_no']."' and teacherappointments_active='1')");?>
						<?php $dataPosition=dbarray($checkPosition);?>
						<?php $checkPositionInfo=dbquery("select * from dropdowns WHERE field_name='".$dataPosition['teacherappointments_position']."'");?>
						<?php $dataPositionInfo=dbarray($checkPositionInfo);?>
						<?php echo strtoupper(substr($dataPositionInfo['field_ext'],2));?><br>
						<?php echo strtoupper($current_school_name);?><br>
						<?php echo strtoupper($current_school_address);?><br>
						<?php $checkID = dbquery("select * from teacherids where teacherids_teach_no='".$dataTeacher['teach_no']."'"); ?>
						<?php $dataID = dbarray($checkID); ?>
						<?php 
						if(!isset($dataID['teacherids_id'])){
							echo "No ID Added Yet!";
						?>
							 Click <a href="teacherIDNew.frm.php?stud_no=<?php echo $_GET['editSALN'];?>" title="Add ID" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
							<span class="glyphicon glyphicon-plus"></span></a> to add.
						<?php } 
						else {
						?>
							<?php echo $dataID['teacherids_id'];?> / <?php echo $dataID['teacherids_details'];?> / <?php echo date('m-d-Y',strtotime($dataID['teacherids_date_issued'])+8.0*3600);?>
						<?php } ?>
						
					</div>
				</div>
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="enrol_actual_lname">Spouse <span title="Required" class="text-danger">*</span></label><br>
						
						<?php
						$checkSpouse = dbquery("select * from teachercontacts where (teachCont_teach_no='".$dataTeacher['teach_no']."' and teachCont_type='1')");
						$dataSpouse = dbarray($checkSpouse);
						if(isset($dataSpouse)){
						?>
							<strong><?php echo strtoupper(($dataSpouse['teachCont_lname']==""?"N/A":$dataSpouse['teachCont_lname'].", ".strtoupper($dataSpouse['teachCont_fname'])." ".strtoupper($dataSpouse['teachCont_xname'])." ".strtoupper(substr($dataSpouse['teachCont_mname'],0,1).".")));?></strong>
							<a href="teacherSALNeditSpouse.frm.php?editSALN=<?php echo $_GET['editSALN'];?>&editSpouse=<?php echo $dataSpouse['teachCont_no'];?>&edit=<?php echo $_GET['edit'];?>" title="Edit Spouse Info" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false">
								<span class="glyphicon glyphicon-pencil"></span></a><br>
							<?php echo strtoupper(($dataSpouse['teachCont_position']==""?"N/A":$dataSpouse['teachCont_position']));?><br>
							<?php echo strtoupper(($dataSpouse['teachCont_office']==""?"N/A":$dataSpouse['teachCont_office']));?><br>
							<?php echo strtoupper(($dataSpouse['teachCont_offadd']==""?"N/A":$dataSpouse['teachCont_offadd']));?><br>
							<?php echo ($dataSpouse['teachCont_govid']==""?"N/A":$dataSpouse['teachCont_govid']." / ".$dataSpouse['teachCont_idno']." / ".date('m-d-Y',strtotime($dataSpouse['teachCont_issuedate']) +8.0+3600));?>
						<?php } else {?>
							<a href="teacherSALNeditSpouse.frm.php?editSALN=<?php echo $_GET['editSALN'];?>&editSpouse=&edit=<?php echo $_GET['edit'];?>" title="Edit Spouse Info" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false">
							<span class="glyphicon glyphicon-plus"></span></a><br>
						<?php } ?>
					</div>
				</div>
			</div>

		</div>
	</div>
	
	<div class="card">
		<div class="card-heading simple">Part II. Dependents</div>
		<div class="card-body">
			<div class="row">	
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="btn-toolbar  pull-right">
							<div class="btn-group">
								<a href="teacherSALNeditAddDependent.frm.php?editSALN=<?php echo $_GET['editSALN'];?>" title="Add Dependents" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
									<span class="glyphicon glyphicon-plus"></span></a>
							</div>
						</div>
						Unmarried Children Below Eighteen (18) Years of Age Living in Declarant's Household
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
							<thead>
								<tr>
									<th width="50%">Name</th>
									<th width="30%">Date of Birth</th>
									<th width="10%">Age</th>
									<th width="10%"></th>
								</tr>
							</thead>
							<tbody> 
								<?php
								$checkDependents = dbquery("select * from teachercontacts where (teachCont_teach_no='".$_GET['editSALN']."' and teachCont_type='2')");
								while ($dataDependent = dbarray($checkDependents)){
								?>
								<tr>
									<td><?php echo strtoupper($dataDependent['teachCont_fname']);?> <?php echo strtoupper($dataDependent['teachCont_mname']);?> <?php echo strtoupper($dataDependent['teachCont_lname']);?> <?php echo strtoupper($dataDependent['teachCont_xname']);?></td>
									<td><?php echo date('F d, Y',strtotime($dataDependent['teachCont_bdate'])+8.0*3600);?></td>
									<?php 
									$date1 = strtotime(($dataSALN['teachSaln_issueyear'])."-12-31");
									$date2 = strtotime($dataDependent['teachCont_bdate']);
									$time_difference = $date1 - $date2;
									$seconds_per_year = 60*60*24*365;
									$years = (int) ($time_difference / $seconds_per_year);
									?>
									<td><?php echo $years;?></td>
									<td>
										<a href="teacherSALNeditAddDependent.frm.php?editDependent=<?php echo $dataDependent['teachCont_no'];?>&edit=<?php echo $_GET['edit'];?>" title="Edit Dependents" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
											<span class="glyphicon glyphicon-pencil"></span></a>
										<a href="teacherSALNedit.scr.php?deleteCont=yes&edit=<?php echo $_GET['edit'];?>&id=<?php echo $dataDependent['teachCont_no'];?>" title="Delete Dependent" class="btn  btn-xs  btn-default" onclick="return confirm('Are you sure you want to delete this entry?');">
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
	
	<div class="card">
		<div class="card-heading simple">Part III. Assets, Liabilities and Networth</div>
		<div class="card-body">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="btn-toolbar  pull-right">
							<div class="btn-group">
								<a href="teacherSALNeditAddAssetsRP.frm.php?editSALN=<?php echo $_GET['editSALN'];?>&edit=<?php echo $_GET['edit'];?>" title="Add Real Properties" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
									<span class="glyphicon glyphicon-plus"></span></a>
							</div>
						</div>
						Assets: (a.) Real Properties
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
							<thead>
								<tr>
									<th width="15%">Description</th>
									<th width="10%">Kind</th>
									<th width="15%">Location</th>
									<th width="10%">Assessed Value</th>
									<th width="10%">Market Value</th>
									<th width="5%">Year</th>
									<th width="10%">Mode</th>
									<th width="11%">Cost</th>
									<th width="10%"></th>
								</tr>
							</thead>
							<tbody> 
								<?php
								$totalRealProperties=0;
								$checkRealProperties = dbquery("select * from teachsalndetails where (teachSalnDet_teachSaln_no='".$_GET['edit']."' and teachSalnDet_type='1')");
								while ($dataRealProperties = dbarray($checkRealProperties)){
									$RealPropertiesDetails = unserialize($dataRealProperties['teachSalnDet_details']);
									$totalRealProperties = $totalRealProperties + $dataRealProperties['teachSalnDet_cost'];
								?>
								<tr>
									<td><?php echo $RealPropertiesDetails[0];?></td>
									<td><?php echo $RealPropertiesDetails[1];?></td>
									<td><small><small><small><?php echo strtoupper($RealPropertiesDetails[2]);?></small></small></small></td>
									<td align="right"><?php echo number_format($RealPropertiesDetails[3],2);?></td>
									<td align="right"><?php echo number_format($RealPropertiesDetails[4],2);?></td>
									<td align="right"><?php echo $RealPropertiesDetails[5];?></td>
									<td><?php echo $RealPropertiesDetails[6];?></td>
									<td align="right"><?php echo number_format($dataRealProperties['teachSalnDet_cost'],2);?></td>
									<td>
										<a href="teacherSALNeditAddAssetsRP.frm.php?editRealProperty=<?php echo $dataRealProperties['teachSalnDet_no'];?>&edit=<?php echo $_GET['edit'];?>" title="Edit Real Property" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
											<span class="glyphicon glyphicon-pencil"></span></a>
										<a href="teacherSALNedit.scr.php?deleteSALN=yes&id=<?php echo $dataRealProperties['teachSalnDet_no'];?>&edit=<?php echo $_GET['edit'];?>" title="Delete Real Property" class="btn  btn-xs  btn-default" onclick="return confirm('Are you sure you want to delete this entry?');">
											<span class="glyphicon glyphicon-remove"></span></a>
									</td>
								</tr>
								<?php } ?>
								<tr>
									<td align="right" colspan="7"><strong><big>Subtotal</big></strong></td>
									<td align="right"><strong><big><?php echo number_format($totalRealProperties,2);?></strong></big></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="btn-toolbar  pull-right">
							<div class="btn-group">
								<a href="teacherSALNeditAddAssetsPP.frm.php?editSALN=<?php echo $_GET['editSALN'];?>&edit=<?php echo $_GET['edit'];?>" title="Add Personal Properties" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
									<span class="glyphicon glyphicon-plus"></span></a>
							</div>
						</div>
						Assets: (b.) Personal Properties
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
							<thead>
								<tr>
									<th>Description</th>
									<th width="15%">Year Acquired</th>
									<th width="20%">Acquisition Cost / Amount</th>
									<th width="10%"></th>
								</tr>
							</thead>
							<tbody> 
								<?php
								$totalPersonalProperties=0;
								$checkPersonalProperties = dbquery("select * from teachsalndetails where (teachSalnDet_teachSaln_no='".$_GET['edit']."' and teachSalnDet_type='2')");
								while ($dataPersonalProperties = dbarray($checkPersonalProperties)){
									$PersonalPropertiesDetails = unserialize($dataPersonalProperties['teachSalnDet_details']);
									$totalPersonalProperties = $totalPersonalProperties + $dataPersonalProperties['teachSalnDet_cost'];
								?>							
								<tr>
									<td><?php echo strtoupper($PersonalPropertiesDetails[0]);?></td>
									<td align="right"><?php echo $PersonalPropertiesDetails[1];?></td>
									<td align="right"><?php echo number_format($dataPersonalProperties['teachSalnDet_cost'],2);?></td>
									<td>
										<a href="teacherSALNeditAddAssetsPP.frm.php?editPersonalProperty=<?php echo $dataPersonalProperties['teachSalnDet_no'];?>&edit=<?php echo $_GET['edit'];?>" title="Edit Personal Property" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
											<span class="glyphicon glyphicon-pencil"></span></a>
										<a href="teacherSALNedit.scr.php?deleteSALN=yes&id=<?php echo $dataPersonalProperties['teachSalnDet_no'];?>&edit=<?php echo $_GET['edit'];?>" title="Delete Personal Property" class="btn  btn-xs  btn-default" onclick="return confirm('Are you sure you want to delete this entry?');">
										<span class="glyphicon glyphicon-remove"></span></a>
									</td>
								</tr>
								<?php } ?>	
								<tr>
									<td align="right" colspan="2"><strong><big>Subtotal</big></strong><br><strong><big>TOTAL ASSETS (a+b)</big></strong></td>
									<td align="right"><strong><big><?php echo number_format($totalPersonalProperties,2);?></strong></big><br><strong><big><?php echo number_format($totalRealProperties+$totalPersonalProperties,2);?></strong></big></td>
								</tr>	
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="btn-toolbar  pull-right">
							<div class="btn-group">
								<a href="teacherSALNeditAddLiabilities.frm.php?editSALN=<?php echo $_GET['editSALN'];?>&edit=<?php echo $_GET['edit'];?>" title="Add Liabilities" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
									<span class="glyphicon glyphicon-plus"></span></a>
							</div>
						</div>
						Liabilities
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
							<thead>
								<tr>
									<th width="20%">Nature</th>
									<th>Name of Creditors</th>
									<th width="20%">Outstanding Balance</th>
									<th width="10%"></th>
								</tr>
							</thead>
							<tbody> 
								<?php
								$totalLiabilities=0;
								$checkLiabilities = dbquery("select * from teachsalndetails where (teachSalnDet_teachSaln_no='".$_GET['edit']."' and teachSalnDet_type='3')");
								while ($dataLiabilities = dbarray($checkLiabilities)){
									$LiabilitiesDetails = unserialize($dataLiabilities['teachSalnDet_details']);
									$totalLiabilities = $totalLiabilities + $dataLiabilities['teachSalnDet_cost'];
								?>							
								<tr>
									<td><?php echo strtoupper($LiabilitiesDetails[0]);?></td>
									<td><?php echo strtoupper($LiabilitiesDetails[1]);?></td>
									<td align="right"><?php echo number_format($dataLiabilities['teachSalnDet_cost'],2);?></td>
									<td>
										<a href="teacherSALNeditAddLiabilities.frm.php?editLiability=<?php echo $dataLiabilities['teachSalnDet_no'];?>&edit=<?php echo $_GET['edit'];?>" title="Edit Liability" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
											<span class="glyphicon glyphicon-pencil"></span></a>
										<a href="teacherSALNedit.scr.php?deleteSALN=yes&id=<?php echo $dataLiabilities['teachSalnDet_no'];?>&edit=<?php echo $_GET['edit'];?>" title="Delete Liability" class="btn  btn-xs  btn-default" onclick="return confirm('Are you sure you want to delete this entry?');">
										<span class="glyphicon glyphicon-remove"></span></a>
									</td>
								</tr>
								<?php } ?>
								<tr>
									<td align="right" colspan="2"><strong><big>Subtotal</big></strong><br><br><strong><big>NET WORTH: Total Assets less Total Liabilities</big></strong></td>
									<td align="right"><strong><big><?php echo number_format($totalLiabilities,2);?></strong></big><br><br><strong><big><?php echo number_format(($totalRealProperties+$totalPersonalProperties)-$totalLiabilities,2);?></strong></big></td>
								</tr>
							</tbody>
						</table>
						<input type="hidden" name="teachSaln_networth" value="<?php echo ($totalRealProperties+$totalPersonalProperties)-$totalLiabilities;?>">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-heading simple">Part IV. Business Interests and Financial Connections</div>
		<div class="card-body">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="btn-toolbar  pull-right">
							<div class="btn-group">
								<a href="teacherSALNeditAddBIFC.frm.php?editSALN=<?php echo $_GET['editSALN'];?>&edit=<?php echo $_GET['edit'];?>" title="Add Business Interest" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
									<span class="glyphicon glyphicon-plus"></span></a>
							</div>
						</div>
						(of Declarant /Declarant’s spouse/ Unmarried Children Below Eighteen (18) years of Age Living in Declarant’s Household)
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
							<thead>
								<tr>
									<th>Business Name</th>
									<th width="27%">Address</th>
									<th width="20%">Nature</th>
									<th width="13%">Date of Acquisition</th>
									<th width="10%"></th>
								</tr>
							</thead>
							<tbody> 
								<?php
								$checkbifc = dbquery("select * from teachsalndetails where (teachSalnDet_teachSaln_no='".$_GET['edit']."' and teachSalnDet_type='4')");
								while ($databifc = dbarray($checkbifc)){
									$bifcDetails = unserialize($databifc['teachSalnDet_details']);
								?>							
								<tr>
									<td><small><?php echo strtoupper($bifcDetails[0]);?></small></td>
									<td><small><?php echo strtoupper($bifcDetails[1]);?></small></td>
									<td><?php echo strtoupper($bifcDetails[2]);?></td>
									<td><?php echo strtoupper($bifcDetails[3]);?></td>
									<td>
										<a href="teacherSALNeditAddBIFC.frm.php?editBIFC=<?php echo $databifc['teachSalnDet_no'];?>&edit=<?php echo $_GET['edit'];?>" title="Edit Business Interest" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
											<span class="glyphicon glyphicon-pencil"></span></a>
										<a href="teacherSALNedit.scr.php?deleteSALN=yes&id=<?php echo $databifc['teachSalnDet_no'];?>&edit=<?php echo $_GET['edit'];?>" title="Delete Business Interest" class="btn  btn-xs  btn-default" onclick="return confirm('Are you sure you want to delete this entry?');">
										<span class="glyphicon glyphicon-remove"></span></a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card">
		<div class="card-heading simple">Part V. Relatives in the Government Office</div>
		<div class="card-body">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="btn-toolbar  pull-right">
							<div class="btn-group">
								<a href="teacherSALNeditAddRelatives.frm.php?editSALN=<?php echo $_GET['editSALN'];?>&edit=<?php echo $_GET['edit'];?>" title="Add Relative" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
									<span class="glyphicon glyphicon-plus"></span></a>
							</div>
						</div>
						Within the Fourth Degree of Consanguinity or Affinity. Include also Bilas, Balae and Inso
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
							<thead>
								<tr>
									<th>Name of Relative</th>
									<th width="15%">Relationship</th>
									<th width="15%">Position</th>
									<th width="35%">Name of Agency / Address</th>
									<th width="10%"></th>
								</tr>
							</thead>
							<tbody> 
								<?php
								$checkrelative = dbquery("select * from teachsalndetails where (teachSalnDet_teachSaln_no='".$_GET['edit']."' and teachSalnDet_type='5')");
								while ($datarelative = dbarray($checkrelative)){
									$relativeDetails = unserialize($datarelative['teachSalnDet_details']);
								?>							
								<tr>
									<td><small><?php echo strtoupper($relativeDetails[0]);?></small></td>
									<td><small><?php echo strtoupper($relativeDetails[1]);?></small></td>
									<td><?php echo strtoupper($relativeDetails[2]);?></td>
									<td><small><?php echo strtoupper($relativeDetails[3]);?></small></td>
									<td>
										<a href="teacherSALNeditAddRelatives.frm.php?editRelatives=<?php echo $datarelative['teachSalnDet_no'];?>&edit=<?php echo $_GET['edit'];?>" title="Edit Relative" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
											<span class="glyphicon glyphicon-pencil"></span></a>
										<a href="teacherSALNedit.scr.php?deleteSALN=yes&id=<?php echo $datarelative['teachSalnDet_no'];?>&edit=<?php echo $_GET['edit'];?>" title="Delete Relative" class="btn  btn-xs  btn-default" onclick="return confirm('Are you sure you want to delete this entry?');">
										<span class="glyphicon glyphicon-remove"></span></a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>	
			</div>
		</div>
	</div>
	
	
		<hr/>
		<button type="submit" name="submit" id="submit" class="btn btn-primary pull-right"  onclick="return confirm('Are you sure you are done?')">Done</button>
		<a href="?page=teacher&showSALN=<?php echo $_GET['editSALN'];?>&year=<?php echo $_GET['year'];?>" class="btn btn-default">Back</a>
		<br/>
	</form>

</div>
</div>
</div>
<!--- https://www.youtube.com/watch?v=_QMiFqB4HFk -->