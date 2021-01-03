<br>

<?php

?>
<div class="pagecontent container">
	<div class="page-header" style="margin-top: 20px">
		<h1>School Form 7 Header Data</h1>
	</div> 
	<div class="row-fluid">
			<div class="span12"><br>
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="btn-toolbar  pull-right">
							<div class="btn-group">
							</div>
						</div>
						
						A. Nationally-Funded Teaching & Teaching Related Items</div>
					<div class="table-responsive">
						<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
							<thead>
								<tr>
									<th>Important Notice: <br>Please tag the teacher correctly with their corresponding recent appointment/position. <br>The activate button is disabled for now, so just edit the entry and save to activate the same. </th>				
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12"><br>
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="btn-toolbar  pull-right">
							<div class="btn-group">
								<a <?php echo ($_SESSION["user_role"]==3?"disabled=disabled":"");?> href="sf7header.frm.php?dept=100" title="Add New" data-toggle="modal" data-target="#modal-medium"  data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
									<span class="glyphicon glyphicon-plus"></span></a>																	
							</div>
						</div>
						
						B. Nationally-Funded Non Teaching Items</div>
					<div class="table-responsive">
						<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
							<thead>
								<tr>
									<th width="3%">#</th>
									<th>Department</th>
									<th>Title of Plantilla Position </th>
									<th>Number of Incumbent</th>
									<th width="10%"></th>					
								</tr>
							</thead>
							<tbody> 
							<?php
							$i=1;
							$checkSF7 = dbquery("select * from iis_menu where (iis_menuparent_menu_no='100' or iis_menuparent_menu_no='200' or iis_menuparent_menu_no='300') order by iis_menuparent_menu_no asc, iis_menuname asc");
							while($dataSF7 = dbarray($checkSF7)){
							?>
								<tr>
									<td>*</td>
									<td><?php echo ($dataSF7['iis_menuparent_menu_no']==100?"ELEMENTARY SCHOOL":($dataSF7['iis_menuparent_menu_no']==200?"JUNIOR HIGH SCHOOL":"SENIOR HIGH SCHOOL"));?></td>
									<td><?php echo $dataSF7['iis_menuname'];?></td>
									<td><?php echo $dataSF7['iis_menusort'];?></td>
									<td>
										<a href="sf7headerU.frm.php?anec_no=<?php echo $dataSF7['iis_menu_no']; ?>" title="Update" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
											<span class="glyphicon glyphicon-pencil"></span></a>
										<a href="sf7header.src.php?DeleteAnec=Yes&anec_no=<?php echo $dataSF7['iis_menu_no'];?>" title="Delete" onClick="return confirm('Are you sure you want to delete entry?')" class="btn  btn-xs  btn-default">
											<span class="glyphicon glyphicon-remove"></span></a>
									</td>
								</tr>	
							<?php
							$i++;
							}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

<div class="row-fluid">
			<div class="span12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="btn-toolbar  pull-right">
							<div class="btn-group">
								<a <?php echo ($_SESSION["user_role"]==3?"disabled=disabled":"");?> href="sf7headerLC.frm.php" title="Add New" data-toggle="modal" data-target="#modal-medium"  data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
									<span class="glyphicon glyphicon-plus"></span></a>																	
							</div>
						</div>
						
						C. Other Appointments and Funding Sources</div>
					<div class="table-responsive">
						<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
							<thead>
								<tr>
									<th width="3%">#</th>
									<th>Title of Designation</th>
									<th>Appointment</th>
									<th>Fund Source</th>
									<th>Number of Incumbent</th>
									<th width="10%"></th>					
								</tr>
							</thead>
							<tbody> 
							<?php
							$i=1;
							$checkSF7 = dbquery("select * from iis_page where iis_pagetitle like 'appoint_%' order by iis_pagetitle asc");
							while($dataSF7 = dbarray($checkSF7)){
							?>
								<tr>
									<td>*</td>
									<td><?php echo substr($dataSF7['iis_pagetitle'],8);?></td>
									<td><?php echo $dataSF7['iis_pagecontent'];?></td>
									<td><?php echo $dataSF7['iis_page_menu_no'];?> <small>(Legend: 1-MOOE; 2-SEF; 3-PTA; 4-NGO; 5-Others)</small></td>
									<td><?php echo $dataSF7['iis_page_user_no'];?></td>
									<td>
									<!--
										<a href="sf7headerLCU.frm.php?anec_no=<?php echo $dataSF7['iis_page_no']; ?>" title="Update" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
											<span class="glyphicon glyphicon-pencil"></span></a>
									-->		
										<a href="sf7header.src.php?LCDeleteAnec=Yes&anec_no=<?php echo $dataSF7['iis_page_no'];?>" title="Delete" onClick="return confirm('Are you sure you want to delete entry?')" class="btn  btn-xs  btn-default">
											<span class="glyphicon glyphicon-remove"></span></a>
									</td>
								</tr>	
							<?php
							$i++;
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



