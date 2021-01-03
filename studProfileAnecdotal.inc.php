<div class="row-fluid">
									<div class="span12"><br>
										<div class="panel panel-default">
											<div class="panel-heading">
												<div class="btn-toolbar  pull-right">
													
													<a href="anecdotalNew.frm.php?stud_no=<?php echo $_GET['showProfile'];?>" <?php echo ($_SESSION["user_role"]==0?"disabled":"");?> title="Add New" data-toggle="modal" data-target="#modal-medium"  data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-plus"></span></a>
												</div>
												Anecdotal Records</div>
											<div class="table-responsive">
												<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
													<thead>
														<tr>
													<th width="10%">Case Number</th>
													<th width="10%">Date</th>
													<th width="20%">Description</th>
													<th width="30%">Details</th>
													<th width="20%">Counselor</th>
													<th width="10%"></th>
												</tr>
											</thead>
											<tbody> 
											<?php
											$resultAnec = dbquery("SELECT * FROM anecdotal INNER JOIN users ON anecdotal.anec_user_name=users.user_name WHERE anecdotal.anec_stud_no='".$_GET['showProfile']."'");
											while($dataAnec = dbarray($resultAnec)){
											?>
												<tr>
													<td><?php echo $dataAnec['anec_no']; ?></td>
													<td><?php echo $dataAnec['anec_date']; ?></td>
													<td><?php echo ($dataAnec['anec_desc']=="-"?"CREDENTIALS":$dataAnec['anec_desc']); ?></td>
													<td><?php echo substr($dataAnec['anec_details'],0,90); ?>...
													<a href="" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="<?php echo $dataAnec['anec_details']; ?>">
														<span class="glyphicon glyphicon-zoom-in"></span></a>
													
													</td>
													<td><?php echo $dataAnec['user_fullname']; ?></td>
													<td><a href="anecdotalUpdate.frm.php?anec_no=<?php echo $dataAnec['anec_no']; ?>" <?php echo ($_SESSION["user_role"]!=1?"disabled":"");?> title="Update" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-pencil"></span></a>
														<a href="anecdotal.scr.php?DeleteAnec=Yes&anec_no=<?php echo $dataAnec['anec_no']; ?>" <?php echo ($_SESSION["user_role"]==1?"":"disabled");?> title="Delete" 
															onClick="return confirm('Are you sure you want to delete entry?')" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-remove"></span></a></td>
												</tr>
											<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>