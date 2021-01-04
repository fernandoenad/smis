<?php
if(isset($_POST['searchStudent'])) {
	$searchStudent = trim($_POST['searchStudent']);
}
elseif(isset($_GET['searchStudent'])) {
	$searchStudent = trim($_GET['searchStudent']);
}
else{
	$searchStudent = " ";
}
	if (isset($_GET['pagenum'])) {
		$pagenum = $_GET['pagenum'];
	}
	else {
		$pagenum = 1;
	}
	
	$resultChk = dbquery("SELECT * FROM student WHERE (CONCAT(stud_lname,', ',stud_fname,' ',stud_mname) LIKE '%".$searchStudent."%' OR stud_lrn LIKE '%".$searchStudent."%' OR stud_no LIKE '%".$searchStudent."%')  ORDER BY stud_lname ASC, stud_fname ASC");
	$rowsChk = dbrows($resultChk);
	$page_rows = 10;
	$last = ceil($rowsChk/$page_rows); 
	
	if ($pagenum < 1) { 
		$pagenum = 1; 
	} 
	elseif ($pagenum > $last) { 
		$pagenum = $last; 
	} 

	$max = 'limit ' .($pagenum - 1) * $page_rows .',' .$page_rows;
	
	$result = dbquery("SELECT * FROM student WHERE (CONCAT(stud_lname,', ',stud_fname,' ',stud_mname) LIKE '%".$searchStudent."%' OR stud_lrn LIKE '%".$searchStudent."%' OR stud_no LIKE '%".$searchStudent."%')  ORDER BY stud_lname ASC, stud_fname ASC ".$max."");
	$rows = dbrows($result);


?>
		<div class="pagecontent container">
			<div class="row row-toolbar">
				<div class="col-lg-3 col-md-3 col-lg-push-9 col-md-push-9">
					<div class="btn-group pull-right" style="margin-top: 5px;">
						<form class="navbar-form navbar-right" method="post" action="./?page=student<?php echo (isset($_GET['transact'])=="Yes"?"&transact=Yes":"");?>">
							<div class="input-group">
								<input type="text" name="searchStudent" class="form-control" placeholder="Search Student..." value="<?php echo (isset($_POST['searchStudent'])?$_POST['searchStudent']:""); ?>" autofocus>
								<div class="input-group-btn">
									<button  class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="page-header" style="margin-top: 20px">
				<h1>Student</h1>
			</div>
	    <ol class="breadcrumb">
        <li><a href="./?page=student">Student</a></li>
    </ol>
	

			<div class="panel panel-default">

				<div class="panel-heading">Student List</div>
				<div class="table-responsive">
					<table class="table table-bordered table-condensed table-striped table-sticky">
						<thead>
							<tr>
								<th width="3%">#</th>
								<th width="15%">LRN / ID No.</th>
								<th>Learner</th>
								<th width="10%">Gender</th>
								<th width="13%">Current Class</th>
								<th width="15%">Status (<?php echo "SY ".$current_sy; ?> - <?php echo $current_sy+1; ?>)</th>
								<th width="15%"></th>
							</tr>
						</thead>
						<tbody>
						<?php
						if (dbrows($result)) {
							$i=1;											
							while ($data = dbarray($result)) {
						?>
							<tr>
								<td class="text-right"><?php echo ($pagenum-1)* $page_rows  +$i; ?></td>
								<td align="right"><?php echo ($_SESSION["user_role"]==0?"************":$data['stud_lrn']." (".$data['stud_no'].")");?></td>
								<td><?php echo strtoupper($data['stud_lname']).", ".strtoupper($data['stud_fname'])." ".strtoupper($data['stud_xname'])." ".strtoupper($data['stud_mname']); ?></td>
								<td><?php echo $data['stud_gender']; ?></td>
								<?php
								$resultCheckEnroll = dbquery("SELECT * FROM studenroll WHERE enrol_stud_no='".$data['stud_no']."' ORDER BY enrol_sy DESC, enrol_no DESC");
								$dataCheckEnroll = dbarray($resultCheckEnroll);
								?>
								<td><?php echo (isset($dataCheckEnroll['enrol_level']) ? $dataCheckEnroll['enrol_level'] : "");?> - <?php echo (isset($dataCheckEnroll['enrol_section']) ? $dataCheckEnroll['enrol_section'] : "");?></td>
								<?php
								$resultEnroll = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$data['stud_no']."' AND enrol_sy='".$current_sy."') ORDER BY enrol_sy DESC, enrol_no DESC");
								$rowsEnroll = dbrows($resultEnroll);
								$dataEnroll = dbarray($resultEnroll);
								?>
								<td><small><small><?php echo ($rowsEnroll==0?"NOT ENROLLED":$dataEnroll['enrol_status1']." (".$dataEnroll['enrol_status2'].")");?></small></small></td>
								<td>
									<a title="View Profile" <?php echo ($_SESSION["user_role"]==0?"disabled":"");?> <?php echo ($lockdownEncoderStudAccess == true ? "disabled" : "");?> class="btn btn-default btn-xs" href="./?page=student&showProfile=<?php echo $data['stud_no'];  ?>&tab=history">Profile</a>
									<?php
									if(isset($_GET['transact']) && $_GET['transact'] =="Yes"){
									?>
									<a title="Transact" <?php echo ($_SESSION["user_role"]==0?"disabled":"");?> class="btn btn-success btn-xs" href="./?page=financials&showProfile=<?php echo $data['stud_no'];  ?>&tab=assessments">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
									<?php
									}
									if($earlyregistrationOn==true){
									$erlyregyr = $current_sy+1;
									$checkEarly = dbquery("select * from earlyregistry where (er_stud_no='".$data['stud_no']."' and er_sy='".$erlyregyr."')");
									$countcheckEarly = dbrows($checkEarly);
									?>
									<a title="Early Register for Next School Year" class="btn btn-danger btn-xs" <?php echo ($countcheckEarly >0 ?"disabled":"");?> href="earlyRegistration.frm.php?showProfile=<?php echo $data['stud_no'];?>&er_level=<?php echo $dataCheckEnroll['enrol_level']+1;?>" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false"><span class="glyphicon glyphicon-check"></span></a>
									<?php
									}
									?>
								</td>
							</tr>
						<?php
							$i++;
							}	
						}
						?>
						
							<tr> <td colspan="7" align="center">Showing page <strong><?php echo $pagenum; ?></strong> out of <strong><?php echo $last; ?></strong>  page(s)...<br>

							</td></tr>
						</tbody>
					</table>
												<ul class="pager">
							<?php
				
							
							if ($pagenum == 1) {
								/* $previous = $pagenum-1;
								echo "<li class='active'><a href='./?page=student&searchStudent=".$searchStudent."&pagenum=1'>&laquo;</a></li> ";
								echo "<li class='active'><a href='./?page=student&searchStudent=".$searchStudent."&pagenum=$previous'><</a></li>";
								*/
				
							} 
							else {
								// echo "<li class='first'><a href='./?page=student&searchStudent=".$searchStudent."&pagenum=1'>First</a></li> ";
								$previous = $pagenum-1;
								echo "<li class='previous'><a href='./?page=student&searchStudent=".$searchStudent."&pagenum=$previous'>Previous</a></li>";
							} 
						
							if ($pagenum == $last){
								/* $next = $pagenum+1;
								echo "<li class='active'><a href='./?page=student&searchStudent=".$searchStudent."&pagenum=$next'>></a></li>";	
								echo "<li class='active'><a href='./?page=student&searchStudent=".$searchStudent."&pagenum=$last'>&raquo;</a></li>";	
								*/
															
							} 
							else {
								$next = $pagenum+1;
								echo "<li class='next'><a href='./?page=student&searchStudent=".$searchStudent."&pagenum=$next'>Next</a></li>";
								// echo "<li class='last'><a href='./?page=student&searchStudent=".$searchStudent."&pagenum=$last'>Last</a></li>";
							}
							?>
							</ul>
				</div>
			</div>
		</div>	
	</div>