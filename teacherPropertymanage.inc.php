<?php
if(isset($_GET['showSALN'])) {
	$searchStudent = $_GET['showSALN'];
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
					<label class="control-label required" for="stud_lrn">Fiscal Year <span title="Required" class="text-danger">* </span></label>
					<select name="month" class="form-control" onchange="if (this.value) window.location.href=this.value" <?php echo ($_SESSION["user_role"]!=1 || $_GET['showSALN']>1?"disabled":"");?>>
						<option value="">---select---</option>
						<?php
						for ($fiscalYear=date("Y");$fiscalYear>=date("Y")-10;$fiscalYear--){
						?>
							<option value="?page=teacher&manageSALN=<?php echo $_GET['showSALN'];?>&year=<?php echo $fiscalYear;?>" <?php echo ($_GET['year']==$fiscalYear?"selected":"");?>><?php echo $fiscalYear;?> </option>
						<?php
						}
						?>
					</select>
				</div>
			</form>
		</div>
		<h1>Manage SALN Filings</h1>
	</div> 
		
	<ol class="breadcrumb">
		<li><a href="<?php echo($_SESSION["user_role"]==2?"#":"./?page=teacher");?>">Teacher</a></li>
		<li class="active">Manage SALN Filings</li>
	</ol>

	
			
	<div class="row">
		<div class="panel-body">
			<div class="row-fluid">
				<div class="span12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="btn-toolbar  pull-right">
								<div class="btn-group">
									<a href="#"  title="View/Print SALN" class="btn  btn-xs  btn-default" onclick="window.open('teacherSALNviewList.php?year=<?php echo $_GET['year'];?>', 'newwindow', 'width=1024, height=600'); return false;">
										<span class="glyphicon glyphicon-print"></span></a>
								</div>
							</div>
							SALN Filing for <?php echo $_GET['year'];?> Fiscal Year 
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
								$i=1;
								$checkSALN = dbquery("select * from teacher where teach_status='1' order by teach_lname asc, teach_fname asc");
								while ($dataSALN = dbarray($checkSALN)){
									$checkSALN2 = dbquery("select * from teachsaln where (teachSaln_teach_no='".$dataSALN['teach_no']."' and teachSaln_issueyear='".$_GET['year']."')");
									$dataSALN2 = dbarray($checkSALN2);
								?>
									<tr>
										<td><?php echo $i.". ".$dataSALN['teach_lname'];?>, <?php echo $dataSALN['teach_fname'];?></td>
										<td align="right"><?php echo $dataSALN2['teachSaln_issueyear'];?></td>
										<td><?php echo ($dataSALN2['teachSaln_filetype']==1?"Joint":($dataSALN2['teachSaln_filetype']==2?"Separate":($dataSALN2['teachSaln_filetype']==3?"Not Applicable":"-")));?></td>
										<td align="right"><?php echo ($dataSALN2['teachSaln_networth']==""?"-":number_format($dataSALN2['teachSaln_networth'],2));?></td>
										<td><?php 
												if($dataSALN2['teachSaln_status']==0)
													echo "-";
												else
													echo ($dataSALN2['teachSaln_status']==1?date('M. d, Y h:ia',strtotime($dataSALN2['teachSaln_regdatetime'])+8.0*3600):date('M. d, Y h:ia',strtotime($dataSALN2['teachSaln_moddatetime'])+8.0*3600));
										
											?></td>
										<?php
										$user = ($dataSALN2['teachSaln_status']==1?$dataSALN2['teachSaln_reguser']:$dataSALN2['teachSaln_moduser']);
										$checkUser = dbquery("select * from teacher where teach_no='".$user."'");
										$dataUser = dbarray($checkUser);
										?>
										<td><?php echo $dataUser['teach_lname'];?>, <?php echo substr($dataUser['teach_fname'],0,1);?>.</td>
										<td><?php echo ($dataSALN2['teachSaln_status']==1?"Open":($dataSALN2['teachSaln_status']==2?"In Progress":($dataSALN2['teachSaln_status']==3?"Completed":"-")));?></td>
										<td>
											<a href="#"  title="View/Print SALN" class="btn  btn-xs  btn-default" <?php echo ($dataSALN2['teachSaln_status']!=3?"disabled":"");?> onclick="window.open('teacherSALNview.php?teachSaln_no=<?php echo $dataSALN2['teachSaln_no'];?>', 'newwindow', 'width=1024, height=600'); return false;">
												<span class="glyphicon glyphicon-print"></span></a>
											<a href=".?page=teacher&editSALN=<?php echo $dataSALN['teach_no']; ?>&year=<?php echo $_GET['year'];?>&edit=<?php echo $dataSALN2['teachSaln_no'];?>"  <?php echo ($dataSALN2['teachSaln_status']==0?"disabled":"");?> title="Edit SALN" class="btn  btn-xs  btn-default">
												<span class="glyphicon glyphicon-pencil"></span></a>
											<a href="teacherSALNedit.scr.php?resetSALN=yes&edit=<?php echo $dataSALN2['teachSaln_no'];?>"  <?php echo ($dataSALN2['teachSaln_status']==0 || $dataSALN2['teachSaln_status']==1 || $dataSALN2['teachSaln_status']==2?"disabled":"");?> title="Revert Status to In-Progress" class="btn  btn-xs  btn-default" onClick="return confirm('Are you sure you want to revert the status to In-Progress?');">
												<span class="glyphicon glyphicon-refresh"></span></a>
										</td>
									</tr>
								<?php $i++; } ?>
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