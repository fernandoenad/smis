<?php
if(isset($_GET['showProperty'])) {
	$searchStudent = $_GET['showProperty'];
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
		<!--
			<form class="navbar-form navbar-right" method="post" action="./?page=student" >
				<div class="form-group">
					<label class="control-label required" for="stud_lrn">Fiscal Year <span title="Required" class="text-danger">* </span></label>
					<select name="month" class="form-control" onchange="if (this.value) window.location.href=this.value" <?php echo ($_SESSION["user_role"]!=1 || $_GET['showProperty']>1?"disabled":"");?>>
						<option value="">---select---</option>
						<?php
						for ($fiscalYear=date("Y");$fiscalYear>=date("Y")-10;$fiscalYear--){
						?>
							<option value="?page=teacher&showProperty=<?php echo $_GET['showProperty'];?>&year=<?php echo $fiscalYear;?>" <?php echo ($_GET['year']==$fiscalYear?"selected":"");?>><?php echo $fiscalYear;?> </option>
						<?php
						}
						?>
					</select>
				</div>
			</form>
		
		-->
		</div>
		<h1>Property Dashboard</h1>
	</div> 
		
	<ol class="breadcrumb">
		<li><a href="<?php echo($_SESSION["user_role"]==2?"#":"./?page=teacher");?>">Teacher</a></li>
		<li class="active">Property Dashboard</li>
	</ol>

	<div class="row row-toolbar">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-push-8 col-md-push-8 col-sm-push-8 col-xs-push-8 clearfix"></div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-pull-4 col-md-pull-4 col-sm-pull-4 col-xs-pull-4">
			<select <?php echo($_SESSION["user_role"]==2?"disabled":($_SESSION["user_role"]==3?"disabled":""));?> class="form-control" id="ui-classes" style="margin-top: 5px" onchange="if (this.value) window.location.href=this.value">
				<option value=".?page=teacher&showProperty=1&year=<?php echo $_GET['year'];?>">***DISPLAY ALL***</option>
				<?php $checkFaculty = dbquery("SELECT * FROM teacher where teach_status=1 ORDER BY teach_lname ASC, teach_fname asc");
				while($dataFaculty=dbarray($checkFaculty)){
				?>
				<option value=".?page=teacher&showProperty=<?php echo $dataFaculty['teach_no']; ?>&year=<?php echo $_GET['year'];?>" <?php echo ($dataFaculty['teach_no']==$_GET['showProperty']?"selected":"");?>><?php echo strtoupper($dataFaculty['teach_lname'].", ".$dataFaculty['teach_fname']." ".$dataFaculty['teach_xname']." ".$dataFaculty['teach_mname']); ?></option>
				<?php } ?>	
			</select>
		</div>
	</div>			
		
	<div class="clearfix" style="margin-bottom: 5px;"></div>
			
	<div class="row">
		<div class="panel-body">
			<div class="row-fluid">
				<div class="span12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="btn-toolbar  pull-right">
								<div class="btn-group">
									<?php
									if($_GET['showProperty']==0 || $_GET['showProperty']==1){
										$filter = " WHERE teachSaln_issueyear=".$_GET['year']."";
									}
									else{
										$filter = " WHERE teachSaln_teach_no=".$_GET['showProperty']."";
									}
									$checkSALN = dbquery("select * from teachsaln inner join teacher on teachSaln_teach_no=teach_no $filter order by teachSaln_issueyear desc, teach_lname asc, teach_fname asc");
									$countSALN = dbrows($checkSALN);
									?>
									<a href="teacherSALNfile.frm.php?fileSALN=<?php echo $_GET['showProperty'];?>&year=<?php echo $_GET['year'];?>" <?php echo ($_GET['showProperty']==1?"disabled":"");?> title="File a SALN" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
									<span class="glyphicon glyphicon-plus"></span></a>
								</div>
							</div>
							Property Custodianship
						</div>
						
						<div class="table-responsive">
							<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
								<thead>
									<tr>
										<th width="25%">Teacher Name</th>
										<th width="8%">Filing Year</th>
										<th width="12%">Filing Type</th>
										<th>Net Worth (Php)</th>
										<th width="14%">Last Update</th>
										<th width="12%">Processor</th>
										<th width="8%">Status</th>
										<th width="10%"></th>
									</tr>
								</thead>
								<tbody> 
								<?php
								while ($dataSALN = dbarray($checkSALN)){
								?>
									<tr>
										<td><?php echo $dataSALN['teach_lname'];?>, <?php echo $dataSALN['teach_fname'];?></td>
										<td align="right"><?php echo $dataSALN['teachSaln_issueyear'];?></td>
										<td><?php echo ($dataSALN['teachSaln_filetype']==1?"Joint":($dataSALN['teachSaln_filetype']==2?"Separate":"Not Applicable"));?></td>
										<td align="right"><?php echo number_format($dataSALN['teachSaln_networth'],2);?></td>
										<td><?php echo ($dataSALN['teachSaln_status']==1?date('M. d, Y h:ia',strtotime($dataSALN['teachSaln_regdatetime'])+8.0*3600):date('M. d, Y h:ia',strtotime($dataSALN['teachSaln_moddatetime'])+8.0*3600));?></td>
										<?php
										$user = ($dataSALN['teachSaln_status']==1?$dataSALN['teachSaln_reguser']:$dataSALN['teachSaln_moduser']);
										$checkUser = dbquery("select * from teacher where teach_no='".$user."'");
										$dataUser = dbarray($checkUser);
										?>
										<td><?php echo $dataUser['teach_lname'];?>, <?php echo substr($dataUser['teach_fname'],0,1);?>.</td>
										<td><?php echo ($dataSALN['teachSaln_status']==1?"Open":($dataSALN['teachSaln_status']==2?"In Progress":"Completed"));?></td>
										<td>
											<a href="#"  title="View/Print SALN" class="btn  btn-xs  btn-default" <?php echo ($dataSALN['teachSaln_status']!=3?"disabled":"");?> onclick="window.open('teacherSALNview.php?teachSaln_no=<?php echo $dataSALN['teachSaln_no'];?>', 'newwindow', 'width=1024, height=600'); return false;">
												<span class="glyphicon glyphicon-print"></span></a>
											<a href=".?page=teacher&editSALN=<?php echo $dataSALN['teach_no']; ?>&year=<?php echo $_GET['year'];?>&edit=<?php echo $dataSALN['teachSaln_no'];?>"  title="Edit SALN" class="btn  btn-xs  btn-default">
												<span class="glyphicon glyphicon-pencil"></span></a>
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
	</div>
</div>
</div>
</div>