<?php

	$result = dbquery("SELECT * FROM settings ORDER BY settings_sy DESC");
	$rows = dbrows($result);


?>
		<div class="pagecontent container">
			<div class="row row-toolbar">
				<div class="col-lg-3 col-md-3 col-lg-push-9 col-md-push-9">
					<div class="btn-group pull-right" style="margin-top: 5px;">
						<div class="btn-group">
							
                            <a href="confirmAdminSettings.frm.php" title="Configure Site" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false">
								Configure the Website <span class="glyphicon glyphicon-cog"></span></a>
							
						</div>
					</div>
				</div>
			</div>
			<div class="page-header" style="margin-top: 20px">
				<h1>Site Settings</h1>
				
			</div>
	    <ol class="breadcrumb">
        <li><a href="./?page=settings">Site Settings</a></li>
    </ol>
	

			<div class="panel panel-default">

				<div class="panel-heading">School Year List
				
				    <div class="btn-toolbar  pull-right">
						
						<div class="btn-group">
						    <a href="settingsNew.frm.php" title="Add School Year" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
								<span class="glyphicon glyphicon-plus"></span></a>
							<a href="settings.frm.php" title="Configure School Year" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
								<span class="glyphicon glyphicon-cog"></span></a>
							<a href="?page=settingsia" title="Update School Seal" class="btn  btn-xs  btn-default">
								<span class="glyphicon glyphicon-picture"></span></a>	
							<a onclick="return pop_up(this, 'Pop Up')" href="./appsx/index.php" title="Configure the Camera" class="btn  btn-xs  btn-default">
								<span class="glyphicon glyphicon-camera"></span></a>				
							<!--
							<a href="../phpmyadmin/index.php?lang=en&server=1&pma_username=root&pma_password=03231979&db=sanhsmis" target="_blank" title="Backup Database" class="btn  btn-xs  btn-default">
								<span class="glyphicon glyphicon-hdd"></span></a>
							-->
						</div>
						
                    </div>
				
				</div>
				
				<div class="table-responsive">
					<table class="table table-bordered table-condensed table-striped table-sticky">
						<thead>
							<tr>
								<th width="3%">#</th>
								<th width="20%">School Year</th>
								<th> Curriculum</th>
								<th width="15%">BOSY</th>
								<th width="15%">School Days</th>
								<th width="15%">Sections</th>
								<th width="15%">EOSY</th>
								<th width="10%"></th>
							</tr>
						</thead>
						<tbody>
						<?php
						if (dbrows($result)) {
							$i=1;											
							while ($data = dbarray($result)) {
						?>
							<tr>
								<td class="text-right"><?php echo $i;?></td>
								<td><?php echo $data['settings_sy'];?> - <?php echo $data['settings_sy']+1;?>
								<?php
								if($data['activated']==1){
								?>	
									<span class="glyphicon glyphicon-check"></span>
								<?php
								}
								?>
								</td>
								<td><?php echo $data['settings_pros'];?></td>
								<td><?php echo $data['settings_bosy'];?></td>
								<td><a  href="schoolDays.frm.php?enrol_sy=<?php echo $data['settings_sy'];?>&stud_no=<?php echo $data['settings_sy'];?>" title="Modify School Days Data" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
										<span class="glyphicon glyphicon-calendar"></span></a></td>
								<td><a  href="viewSections.frm.php?enrol_sy=<?php echo $data['settings_sy'];?>&stud_no=<?php echo $data['settings_sy'];?>" title="View Sections" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
										<span class="glyphicon glyphicon-list"></span></a></td>
								<td><?php echo $data['settings_eosy'];?></td>
								<td>
									
									<a href="settingsUpdate.frm.php?settings_no=<?php echo $data['settings_no'];?>" title="Modify School Year Data" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
										<span class="glyphicon glyphicon-pencil"></span></a>
									
									</td>
							</tr>
						<?php
							$i++;
							}	
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>	
	</div>