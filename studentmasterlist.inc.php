<?php

if (!(isset($pagenum))) { 
	$pagenum = 1; 
} 

if(isset($_GET['action']) && $_GET['action'] == "searchstudent"){
	$result = dbquery("SELECT * FROM student WHERE (stud_lrn LIKE '".$_POST['search_lrn']."%' AND stud_lname LIKE '".$_POST['search_lname']."%' AND stud_fname LIKE '".$_POST['search_fname']."%') ORDER BY stud_lname ASC, stud_fname ASC");
	$rows = dbrows($result);
	$message = "Showing ".$rows." out of ".$rows." records found.";
	if($rows==0){
	?>
		<div class="alert alert-danger" role="alert"><strong>Oh snap!</strong> 0 results found.</div>
	<?php
	}
}
else{
	$result = dbquery("SELECT * FROM student ORDER BY stud_lname ASC, stud_fname ASC");
	$rows = dbrows($result);
	$page_rows = 10;
	$message = "Showing ".$page_rows." out of ".$rows." records found.";
	$last = ceil($rows/$page_rows); 
		
	if ($pagenum < 1) { 
		$pagenum = 1; 
	} 
	elseif ($pagenum > $last) { 
		$pagenum = $last; 
	}
	$max = 'limit ' .($pagenum - 1) * $page_rows .',' .$page_rows;
	$result = dbquery("SELECT * FROM student $max");
}	



?>
					<h2 class="heading">Student Masterlist</h2>
							<div class="tab-pane " id="view_prospectus">
								<div class="row-fluid">
									<div class="span12">
										<table class="table table-bordered table-hover table-condensed table-grades mediaTable activeMediaTable" style="margin-bottom:20px !important">
											<thead>
												<tr>
													<th colspan="10"><?php 	echo $message; ?>
													</th>
												</tr>
												<tr>
													<th width="4%">#</th>
													<th width="10%">LRN</th>
													<th width="15%">Last name</th>
													<th width="20%">First name</th>
													<th width="15%">Middle name</th>
													<th width="8%">Ext name</th>
													<th width="8%">Gender</th>
													<th width="10%">Birthdate</th>
													<th> </th>
												</tr>
											</thead>
											<tbody> 
											<?php 

											if (dbrows($result)) {
												$i=1;											
												while ($data = dbarray($result)) {
												?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $data['stud_lrn']; ?></td>
													<td><?php echo $data['stud_lname']; ?></td>
													<td><?php echo $data['stud_fname']; ?></td>
													<td><?php echo $data['stud_mname']; ?></td>
													<td><?php echo $data['stud_xname']; ?></td>
													<td><?php echo $data['stud_gender']; ?></td>
													<td><?php 
															$phpdate = strtotime($data['stud_bdate']);
															echo $mysqldate = date('m/d/Y', $phpdate); 
														?>
													</td>
													<form name="load_profile" method="post" action="./?page=student&action=showstudent">
													<td height="10">
													<input type="hidden" name="stud_no" value="<?php echo $data['stud_no']; ?>">
													<button type="submit" style="padding-top:0px; padding-bottom:0px; height:20px; font-size:10px;" class="btn btn-success">Profile</button>
													</a></td>
													</form>
													</tr>
												<?php
												$i++;
												}	
											}
											?>
											</tbody>
										</table>
										<?php 
										/* echo " Page $pagenum of $last"; 
										if ($pagenum == 1) {
								
										} 
										else {
											 echo " <a href='./?page=student&pagenum=1'> <<-First</a> ";
											 echo " ";
											 $previous = $pagenum-1;
											 echo " <a href='./?page=student&pagenum=$previous'> <-Previous</a> ";
										} 
											  //just a spacer
											 echo " ---- ";


										if ($pagenum == $last) {
										
										} 
										else {
											$next = $pagenum+1;
											echo " <a href='./?page=student&pagenum=$next'>Next -></a> ";
											echo " ";
											echo " <a href='./?page=student&pagenum=$last'>Last ->></a> ";
										} */											 
										?>
									</div>
								</div>
							</div>
						</div>
				<div id="sidebar" class="span3">
				<div id="side_accordion" class="accordion span12">
					<div class="accordion-group">
						<div id="accordion1">
							<div class="accordion-heading"><a href="#collapse1" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">Search Student: </a></div>
							<div class="accordion-inner">
								<div class="row-fluid"><br>
									<?php require_once('searchstudent.frm.inc.php'); ?>
								</div>		
							</div>
						</div>
					</div>	
				</div>
			</div>
			