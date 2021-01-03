<?php

?>
		<div class="pagecontent container">
		
			<div class="row row-toolbar">
				<div class="col-lg-3 col-md-3 col-lg-push-9 col-md-push-9">
					<div class="btn-group pull-right" style="margin-top: 5px;">
						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
						SY <?php echo $_GET['enrol_sy'];?> - <?php echo $_GET['enrol_sy']+1;?>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
							<li role="presentation" class="dropdown-header">Select School Year</li>
							<?php 
								for($sy=1997; $sy<=$current_sy; $sy++){
							?>
							<li><a href="?page=offerings&enrol_sy=<?php echo $sy;?>"><?php echo $sy;?> - <?php echo $sy+1;?></a></li>
							<?php }	?>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-lg-pull-3 col-md-pull-3"  style="margin-top: 5px;">
					<div class="btn-group">
					<?php 
					if($_SESSION["user_role"]==1){
					?>						
						<a href="classNew.frm.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>" title="New class" class="btn btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false"><span class="glyphicon glyphicon-plus"></span> Open Offering</a>
					<?php } ?>
					</div>
				</div>
			</div>
	
			
			<div class="page-header" style="margin-top: 20px">
				<h1>List of Offerings</h1>
			</div>
			<ol class="breadcrumb">
				<li><a href="./?page=offerings&enrol_sy=<?php echo $current_sy; ?>">Offerings</a></li>
			</ol>
		
			<div  class="tabbable">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#view_g7" data-toggle="tab">Grade 7 Offerings</a></li>
							<li ><a href="#view_g8" data-toggle="tab">Grade 8 Offerings</a></li>
							<li ><a href="#view_g9" data-toggle="tab">Grade 9 Offerings</a></li>
							<li ><a href="#view_g10" data-toggle="tab">Grade 10 Offerings</a></li>
							<li ><a href="#view_g11" data-toggle="tab">Grade 11 Offerings</a></li>
							<li ><a href="#view_g12" data-toggle="tab">Grade 12 Offerings</a></li>

						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="view_g7">
								<div class="row-fluid">
									<div class="span12"><br>
										<div class="panel panel-default">
										<?php 
										for($i=7; $i<=7; $i++){
										?>
											<div class="panel-heading">
												Grade <?php echo $i; ?></div>
											<div class="table-responsive">
												<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
													<thead>
														<tr>
															<th width="12%">Course Code</th>
															<th>Descriptive Title</th>
															<th width="10%">Cut-off Grade</th>
															<th width="12%">No. of Takes</th>
															<th width="10%">Pre-requisites</th>
															<th width="5%">Units</th>
															<th width="8%">Grade</th>
															<th width="8%">Remarks</th>
														</tr>
													</thead>
													<tbody> 
													<?php 
													$resultProspectus = dbquery("SELECT * FROM prospectus WHERE pros_level='".$i."'");
													while($dataProspectus = dbarray($resultProspectus)){
														$resultProsGrade = dbquery("SELECT * FROM grade INNER JOIN student ON student.stud_no=grade.grade_stud_no INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (class.class_pros_no='".$dataProspectus['pros_no']."' AND grade.grade_stud_no='".$_GET['showProfile']."')");
														$dataProsGrade = dbarray($resultProsGrade);
														$countProsGrade = dbrows($resultProsGrade);
													?>
														<tr>
															<td><?php echo $dataProspectus['pros_title'] ;?></td>
															<td><?php echo ucwords(strtolower($dataProspectus['pros_desc']));?></td>
															<td><?php echo $dataProspectus['pros_cutoff'] ;?></td>
															<td><?php echo $countProsGrade;	?></td>
															<td><?php echo $dataProspectus['pros_prereq'] ;?></td>
															<td><?php echo $dataProspectus['pros_unit'] ;?></td>
															<td><?php echo $dataProsGrade['grade_final'] ;?></td>
															<td><?php echo ($dataProsGrade['grade_remarks']==1?"PASSED":"FAILED");?></td>
														</tr>
													<?php } ?></tbody>
												</table>
											</div></div>
										<?php } ?>
										</div>
									</div>
								</div>
							</div>
							
							
							
							
							
							
						</div>
					</div>
					
				</div>
			</div>	
		</div>