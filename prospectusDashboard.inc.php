<?php


?>
		<div class="pagecontent container">
		
			<div class="row row-toolbar">
				<div class="col-lg-3 col-md-3 col-lg-push-9 col-md-push-9">
					<div class="btn-group pull-right" style="margin-top: 5px;">
						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
						 <?php echo $_GET['pros_curr'];?> Curriculum
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
							<li role="presentation" class="dropdown-header">Select School Year</li>
							<?php 
								$selectCurriculum = dbquery("SELECT * FROM dropdowns WHERE field_category='CURRICULUM' ORDER BY field_name ASC");
								while($rowCurriculum = dbarray($selectCurriculum)){								
							?>
									<li><a href="?page=prospectus&tab=&pros_curr=<?php echo $rowCurriculum['field_name'];?>"><?php echo $rowCurriculum['field_name'];?> Curriculum</a></li>
							<?php }	?>
						</ul>
					</div>
				</div>

			</div>
	
			
			<div class="page-header" style="margin-top: 20px">
				<h1>Curricular Offerings</h1>
			</div>
			<ol class="breadcrumb">
				<li><a href="./?page=offerings&enrol_sy=<?php echo $current_sy; ?>">Curriculum</a></li>
				<li class="active">Current Curriculum</li>
			</ol>
		
			<div  class="tabbable">
				<ul class="nav nav-tabs">
					<li class="<?php echo ($_GET['tab']=="view_elem"?"active":"");?>"><a href="?page=prospectus&pros_curr=<?php echo $_GET['pros_curr'];?>&tab=view_elem">Current Elementary Curriculum</a></li>
					<li class="<?php echo ($_GET['tab']=="view_jhs"?"active":"");?>"><a href="?page=prospectus&pros_curr=<?php echo $_GET['pros_curr'];?>&tab=view_jhs">Current Junior HS Curriculum</a></li>
					<li class="<?php echo ($_GET['tab']=="view_shs"?"active":"");?>"><a href="?page=prospectus&pros_curr=<?php echo $_GET['pros_curr'];?>&tab=view_shs">Current Senior HS Curriculum</a></li>
				</ul>
				<div class="tab-content">
					<div class="<?php echo ($_GET['tab']=="view_elem"?"tab-pane active":"tab-pane");?>" id="view_elem">
						<div class="row-fluid">
							<div class="span12"><br>
								
								<?php 
									for($i=1; $i<=6; $i++){
								?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<div class="btn-toolbar  pull-right">
											<a href="prospectusNew.frm.php?Add=Yes&gradeLevel=<?php echo $i;?>&prosCurr=<?php echo $_GET['pros_curr'];?>&prosSem=12" title="Add New" data-toggle="modal" data-target="#modal-medium"  data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
											<span class="glyphicon glyphicon-plus"></span></a>
										</div>
											Grade <?php echo $i; ?>, Full Year
									</div>
												
									<div class="table-responsive">
										<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
											<thead>
												<tr>
													<th width="3%">#</th>
													<th width="20%">Course Code</th>
													<th>Descriptive Title</th>
													<th width="10%">Cut-off Grade</th>
													<th width="15%">Pre-requisites</th>
													<th width="5%">Units</th>
													<th width="10%">Term</th>
													<th width="10%"></th>
												</tr>
											</thead>
											<tbody> 
												<?php 
												$count=1;
												$resultProspectus = dbquery("SELECT * FROM prospectus WHERE (pros_curr='".$_GET['pros_curr']."' AND pros_level='".$i."') ORDER BY pros_sort ASC");
												while($dataProspectus = dbarray($resultProspectus)){
													?>
													<tr>
														<td><?php echo $count;?></td>
														<td><?php echo ($dataProspectus['pros_part']=="1"?"":"x");?><?php echo $dataProspectus['pros_title'] ;?>
																
														</td>
														<td><small><?php echo ucwords(strtolower($dataProspectus['pros_desc']));?></small></td>
														<td><?php echo $dataProspectus['pros_cutoff'] ;?></td>
														<td><small><small><small><?php echo $dataProspectus['pros_prereq'] ;?></small></small></small></td>
														<td><?php echo $dataProspectus['pros_unit'] ;?></td>
														<td><?php 
														if($dataProspectus['pros_sem']==1)
															echo "First Sem";			
														elseif($dataProspectus['pros_sem']==2)
															echo "Second Sem";	
														elseif($dataProspectus['pros_sem']==12)
															echo "Full Year";																
														?>
														</td>
														<td>
														<?php
														$checkProsActive = dbquery("SELECT * FROM class WHERE (class_pros_no='".$dataProspectus['pros_no']."')");
														$countProsActive = dbrows($checkProsActive);
														?>
															<a  href="prospectusUpdate.frm.php?Update=Yes&No=<?php echo $dataProspectus['pros_no'];?>" title="Modify Subject" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
															<span class="glyphicon glyphicon-pencil"></span></a>
															<a <?php echo ($countProsActive>0?"disabled=disabled":"");?> href="prospectus.scr.php?Delete=Yes&No=<?php echo $dataProspectus['pros_no']; ?>" title="Delete Subject" class="btn  btn-xs  btn-default" onClick="return confirm('Are you sure you want to delete prospectus?')" >
															<span class="glyphicon glyphicon-remove"></span></a>
														</td>
													</tr>
												<?php 
												$count++;
												} 
												?>
											</tbody>
										</table>
									</div>
								</div>
										<?php } ?>
							</div>			
							
						</div>
					</div>
					<div class="<?php echo ($_GET['tab']=="view_jhs"?"tab-pane active":"tab-pane");?>" id="view_jhs">
						<div class="row-fluid">
							<div class="span12"><br>
								
								<?php 
									for($i=7; $i<=10; $i++){
								?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<div class="btn-toolbar  pull-right">
											<a href="prospectusNew.frm.php?Add=Yes&gradeLevel=<?php echo $i;?>&prosCurr=<?php echo $_GET['pros_curr'];?>&prosSem=12" title="Add New" data-toggle="modal" data-target="#modal-medium"  data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
											<span class="glyphicon glyphicon-plus"></span></a>
										</div>
											Grade <?php echo $i; ?>, Full Year
									</div>
												
									<div class="table-responsive">
										<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
											<thead>
												<tr>
													<th width="3%">#</th>
													<th width="20%">Course Code</th>
													<th>Descriptive Title</th>
													<th width="10%">Cut-off Grade</th>
													<th width="15%">Pre-requisites</th>
													<th width="5%">Units</th>
													<th width="10%">Term</th>
													<th width="10%"></th>
												</tr>
											</thead>
											<tbody> 
												<?php 
												$count=1;
												$resultProspectus = dbquery("SELECT * FROM prospectus WHERE (pros_curr='".$_GET['pros_curr']."' AND pros_level='".$i."') ORDER BY pros_sort ASC");
												while($dataProspectus = dbarray($resultProspectus)){
													?>
													<tr>
														<td><?php echo $count;?></td>
														<td><?php echo ($dataProspectus['pros_part']=="1"?"":"x");?><?php echo $dataProspectus['pros_title'] ;?>
																
														</td>
														<td><small><?php echo ucwords(strtolower($dataProspectus['pros_desc']));?></small></td>
														<td><?php echo $dataProspectus['pros_cutoff'] ;?></td>
														<td><small><small><small><?php echo $dataProspectus['pros_prereq'] ;?></small></small></small></td>
														<td><?php echo $dataProspectus['pros_unit'] ;?></td>
														<td><?php 
														if($dataProspectus['pros_sem']==1)
															echo "First Sem";			
														elseif($dataProspectus['pros_sem']==2)
															echo "Second Sem";	
														elseif($dataProspectus['pros_sem']==12)
															echo "Full Year";																
														?>
														</td>
														<td>
														<?php
														$checkProsActive = dbquery("SELECT * FROM class WHERE (class_pros_no='".$dataProspectus['pros_no']."')");
														$countProsActive = dbrows($checkProsActive);
														?>
															<a href="prospectusUpdate.frm.php?Update=Yes&No=<?php echo $dataProspectus['pros_no'];?>" title="Modify Subject" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
															<span class="glyphicon glyphicon-pencil"></span></a>
															<a <?php echo ($countProsActive>0?"disabled=disabled":"");?> href="prospectus.scr.php?Delete=Yes&No=<?php echo $dataProspectus['pros_no']; ?>" title="Delete Subject" class="btn  btn-xs  btn-default" onClick="return confirm('Are you sure you want to delete prospectus?')" >
															<span class="glyphicon glyphicon-remove"></span></a>
														</td>
													</tr>
												<?php 
												$count++;
												} 
												?>
											</tbody>
										</table>
									</div>
								</div>
										<?php } ?>
							</div>			
							
						</div>
					</div>

					<div class="<?php echo ($_GET['tab']=="view_shs"?"tab-pane active":"tab-pane");?>" id="view_shs">
						<div class="row-fluid">
							<div class="span12"><br>
								
								<?php 
									for($i=11; $i<=12; $i++){
										for($i2=1; $i2<=2; $i2++){
								?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<div class="btn-toolbar  pull-right">
											<a href="prospectusNew.frm.php?Add=Yes&gradeLevel=<?php echo $i;?>&prosCurr=<?php echo $_GET['pros_curr'];?>&prosSem=<?php echo $i2;?>" title="Add New" data-toggle="modal" data-target="#modal-medium"  data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
											<span class="glyphicon glyphicon-plus"></span></a>
										</div>
											Grade <?php echo $i;?>, <?php echo($i2=="1"?"First Semester":($i2=="2"?"Second Semester":"Full Year"));?>
									</div>
												
									<div class="table-responsive">
										<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
											<thead>
												<tr>
													<th width="3%">#</th>
													<th width="20%">Course Code</th>
													<th>Descriptive Title</th>
													<th width="10%">Cut-off Grade</th>
													<th width="15%">Pre-requisites</th>
													<th width="5%">Units</th>
													<th width="10%">Term</th>
													<th width="10%"></th>
												</tr>
											</thead>
											<tbody> 
												<?php 
												$count=1;
												$resultProspectus = dbquery("SELECT * FROM prospectus WHERE (pros_curr='".$_GET['pros_curr']."' AND pros_level='".$i."' and pros_sem='".$i2."') ORDER BY pros_level ASC, pros_sem ASC, pros_sort ASC");
												while($dataProspectus = dbarray($resultProspectus)){
													?>
													<tr>
														<td><?php echo $count;?></td>
														<td><?php echo ($dataProspectus['pros_part']=="1"?"":"x");?><?php echo $dataProspectus['pros_title'];
														if ($dataProspectus['pros_track']=="SHS GENERAL")
															echo " (Core)";
														elseif ($dataProspectus['pros_track']=="SHS APPLIED")
															echo " (Applied)";	
														else
															echo " (Specialization)";

														?></td>
														<td><small><?php echo substr(ucwords(strtolower($dataProspectus['pros_desc'])),0,40);?></small>...
														<a href="#" title="Remarks" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="<?php echo $dataProspectus['pros_desc']; ?>"><span class="glyphicon glyphicon-zoom-in"></a></td>
														<td><?php echo $dataProspectus['pros_cutoff'] ;?></td>
														<td><small><small><small><?php echo $dataProspectus['pros_prereq'] ;?></small></small></small></td>
														<td><?php echo $dataProspectus['pros_unit'] ;?></td>
														<td><?php 
														if($dataProspectus['pros_sem']==1)
															echo "First Sem";			
														elseif($dataProspectus['pros_sem']==2)
															echo "Second Sem";	
														elseif($dataProspectus['pros_sem']==12)
															echo "Full Year";																
														?>
														</td>
														<td>
														<?php
														$checkProsActive = dbquery("SELECT * FROM class WHERE (class_pros_no='".$dataProspectus['pros_no']."')");
														$countProsActive = dbrows($checkProsActive);
														?>
															<a href="prospectusUpdate.frm.php?Update=Yes&No=<?php echo $dataProspectus['pros_no'];?>" title="Modify Subject" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
															<span class="glyphicon glyphicon-pencil"></span></a>
															<a <?php echo ($countProsActive>0?"disabled=disabled":"");?> href="prospectus.scr.php?Delete=Yes&No=<?php echo $dataProspectus['pros_no']; ?>" title="Delete Subject" class="btn  btn-xs  btn-default" onClick="return confirm('Are you sure you want to delete prospectus?')" >
															<span class="glyphicon glyphicon-remove"></span></a>
														</td>
													</tr>
												<?php 
												$count++;
												} 
												?>
											</tbody>
											
										</table>
									</div>
								</div>
								<?php 
								}
								}
								// end of grade 11 
								?>		
								
														
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