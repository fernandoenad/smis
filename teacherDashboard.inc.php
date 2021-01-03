<?php
if(isset($_POST['searchStudent'])) {
	$searchStudent = $_POST['searchStudent'];
}
elseif(isset($_GET['searchStudent'])) {
	$searchStudent = $_GET['searchStudent'];
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
	
	$resultChk = dbquery("SELECT * FROM teacher WHERE (CONCAT(teach_lname,', ',teach_fname) LIKE '%".$searchStudent."%' OR teach_id LIKE '%".$searchStudent."%' OR teach_no LIKE '%".$searchStudent."%')  ORDER BY teach_lname ASC, teach_fname ASC");
	$rowsChk = dbrows($resultChk);
	$page_rows = 100;
	$last = ceil($rowsChk/$page_rows); 
	
	if ($pagenum < 1) { 
		$pagenum = 1; 
	} 
	elseif ($pagenum > $last) { 
		$pagenum = $last; 
	} 

	$max = 'limit ' .($pagenum - 1) * $page_rows .',' .$page_rows;
	
	if (isset($_GET['display']) && $_GET['display']=="teaching")
		$filter =" AND teach_status='1' AND teach_teacher='1'";
	else if (isset($_GET['display']) && $_GET['display']=="nonteaching")
		$filter =" AND teach_status='1' AND teach_teacher='0'";
	else if (isset($_GET['display']) && $_GET['display']=="all")
		$filter =" AND teach_status='1'";
	else if (isset($_GET['display']) && $_GET['display']=="nonactive")
		$filter =" AND teach_status='0'";
	else 
		$filter =" AND teach_status='1'";
	$result = dbquery("SELECT * FROM teacher WHERE ((CONCAT(teach_lname,', ',teach_fname) LIKE '%".$searchStudent."%' OR teach_id LIKE '%".$searchStudent."%' OR teach_no LIKE '%".$searchStudent."%') $filter)  ORDER BY teach_lname ASC, teach_fname ASC ".$max."");
	$rows = dbrows($result);


?>
		<div class="pagecontent container">
			<div class="row row-toolbar">
				<div class="col-lg-3 col-md-3 col-lg-push-9 col-md-push-9">
					<div class="btn-group pull-right" style="margin-top: 5px;">
						<form class="navbar-form navbar-right" method="post" action="./?page=teacher">
							<div class="input-group">
								<input type="text" name="searchStudent" class="form-control" placeholder="Search Teacher..." value="<?php echo (isset($_POST['searchStudent'])?$_POST['searchStudent']:""); ?>" autofocus>
								<div class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="page-header" style="margin-top: 20px">
				<h1>Teacher</h1>
			</div>
	    <ol class="breadcrumb">
        <li><a href="./?page=teacher">Teacher</a></li>
    </ol>
		
		<div class="row row-toolbar">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-push-8 col-md-push-8 col-sm-push-8 col-xs-push-8 clearfix"></div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-pull-4 col-md-pull-4 col-sm-pull-4 col-xs-pull-4">
                <select  class="form-control" id="ui-classes" style="margin-top: 5px" onchange="if (this.value) window.location.href=this.value">
					<option value=".?page=teacher" selected>All Records</option>
					<option value=".?page=teacher&display=teaching" <?php echo (isset($_GET['display']) && $_GET['display']=="teaching"?"selected":"");?>>Teaching</option>
					<option value=".?page=teacher&display=nonteaching" <?php echo (isset($_GET['display']) && $_GET['display']=="nonteaching"?"selected":"");?>>Non-Teaching</option>
					<option value=".?page=teacher&display=all" <?php echo (isset($_GET['display']) && $_GET['display']=="all"?"selected":"");?>>All Personnel (Active)</option>					
					<option value=".?page=teacher&display=nonactive" <?php echo (isset($_GET['display']) && $_GET['display']=="nonactive"?"selected":"");?>>Non-Active Personnel</option>
                </select>
			</div>
		</div>	

			<div class="panel panel-default">

				<div class="panel-heading">Teacher List
				<div class="btn-toolbar  pull-right">
						<div class="btn-group">
							<a title="Print Faculty List" class="btn  btn-xs  btn-default" <?php echo (isset($_GET['display']) ? "" : "disabled"); ?> onclick="window.open('teacherList.php?display=<?php echo (isset($_GET['display']) ? $_GET['display'] : ''); ?>', 'newwindow', 'width=1350, height=600'); return false;">
								<span class="glyphicon glyphicon-print"></span></a>
							<a title="Print Faculty Attendance Sheet" class="btn  btn-xs  btn-default" <?php echo (isset($_GET['display']) ? "" : "disabled"); ?> onclick="window.open('showForm2e.php?display=<?php echo (isset($_GET['display']) ? $_GET['display'] : ''); ?>', 'newwindow', 'width=1350, height=600'); return false;">
								<span class="glyphicon glyphicon-list"></span></a>	
						</div>
                    </div>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-condensed table-striped table-sticky">
						<thead>
							<tr>
								<th width="3%">#</th>
								<th width="8%">DepEd ID</th>
								<th>Teacher</th>
								<th width="7%">Gender</th>
								<th>Birthday</th>
								<th>Address</th>
								<th width="10%">Position</th>
								<th width="11%">&nbsp;</th>
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
								<td><a href="#" onclick="window.open('teachPass.php?teach_no=<?php echo $data['teach_no']; ?>', 'newwindow', 'width=700, height=500'); return false;"><?php echo $data['teach_id']; ?></a></td>
								<td><small><?php echo strtoupper($data['teach_lname']).", ".strtoupper($data['teach_fname'])." ".strtoupper($data['teach_xname'])." ".strtoupper($data['teach_mname']); ?></small></td>
								<td><small><?php echo $data['teach_gender']; ?></small></td>
								<?php
									$selectAppointments = dbquery("SELECT * FROM teacherappointments WHERE (teacherappointments_teach_no='".$data['teach_no']."' and teacherappointments_item_no!='ANCILLARY' and teacherappointments_active='1') ORDER BY teacherappointments_date DESC LIMIT 1");
									$rowAppointments = dbarray($selectAppointments);
									$rowAppointments = (isset($rowAppointments) ? $rowAppointments : array("teacherappointments_position"=>""));
								?>
								<td><small>
								<?php 
									$phpdate = strtotime($data['teach_bdate']);
									echo $mysqldate = date('F d, Y', $phpdate);
								?>
								</small></td>
								<td><small><small><?php echo $data['teach_residence'];?></small></small></td>
								<td><small><small><?php echo $rowAppointments['teacherappointments_position'];?></small></small></td>
								<td>
								<a <?php echo ($_SESSION["userid"]==$data['teach_no']?"":($_SESSION["user_role"]==1 || $_SESSION["user_role"]==3?"":"disabled"));?> class="btn btn-default btn-xs" href="./?page=teacher&showProfile=<?php echo $data['teach_no'];  ?>&tab=info"><span class="glyphicon glyphicon-user"></span></a>
								<a title="View Load" class="btn  btn-xs  btn-default" onclick="window.open('facultyLoad.php?teach_no=<?php echo $data['teach_no'];?>&enrol_sy=<?php echo $current_sy;?>&term=<?php echo $current_sem;?>', 'newwindow', 'width=820, height=520'); return false;">
								<span class="glyphicon glyphicon-list"></span></a>
								<?php
								$checkAdvisory=dbquery("select * from section where section_adviser='".$data['teach_no']."'");
								$countAdvisory=dbrows($checkAdvisory);
								$checkClasses=dbquery("select * from class where class_user_name='".$data['teach_no']."'");
								$countClasses=dbrows($checkClasses);
								$checkAppointments=dbquery("select * from teacherappointments where teacherappointments_teach_no='".$data['teach_no']."'");
								$countAppointments=dbrows($checkAppointments);
								$checkIDs=dbquery("select * from  teacherids where teacherids_teach_no='".$data['teach_no']."'");
								$countIDs=dbrows($checkIDs);
								$checkBGround=dbquery("select * from  teacher_ebackground where eback_teach_no='".$data['teach_no']."'");
								$countBGround=dbrows($checkBGround);
								$checkSALN=dbquery("select * from  teachsaln where teachSaln_teach_no='".$data['teach_no']."'");
								$countSALN=dbrows($checkSALN);
								$checkAnec=dbquery("select * from  anecdotal where (anec_stud_no='".$data['teach_no']."' or anec_user_name='".$data['teach_no']."')");
								$countAnec=dbrows($checkAnec);
								
								$disableDelete = ($countAdvisory>0 || $countClasses>0 || $countAppointments>0 || $countIDs>0 || $countBGround>0 || $countSALN>0 || $countAnec>0?"disabled":"");
								?>
								<a <?php echo ($_SESSION["user_role"]!=1?"disabled":"");?> class="btn btn-danger btn-xs" <?php echo $disableDelete ;?> title="Delete a teacher profile. A teacher previously or currently assigned as adviser or subject teacher cannot be deleted." href="./teacher.scr.php?teach_no=<?php echo $data['teach_no'];?>&deleteUser=Yes"><span class="glyphicon glyphicon-remove" onClick="return Confirm('Are you sure you want to delete the choosed teacher profile? This action is irreversible.')"></span></a>
								</td>
							</tr>
						<?php
							$i++;
							}	
						}
						?>
							
						</tbody>
						<tr> <td colspan="8" align="center">Showing page <strong><?php echo $pagenum; ?></strong> out of <strong><?php echo $last; ?></strong>  page(s)...<br></td></tr>
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
								echo "<li class='previous'><a href='./?page=teacher&searchStudent=".$searchStudent."&pagenum=$previous'>Previous</a></li>";
							} 
						
							if ($pagenum == $last){
								/* $next = $pagenum+1;
								echo "<li class='active'><a href='./?page=student&searchStudent=".$searchStudent."&pagenum=$next'>></a></li>";	
								echo "<li class='active'><a href='./?page=student&searchStudent=".$searchStudent."&pagenum=$last'>&raquo;</a></li>";	
								*/
															
							} 
							else {
								$next = $pagenum+1;
								echo "<li class='next'><a href='./?page=teacher&searchStudent=".$searchStudent."&pagenum=$next'>Next</a></li>";
								// echo "<li class='last'><a href='./?page=student&searchStudent=".$searchStudent."&pagenum=$last'>Last</a></li>";
							}
							?>
							</ul>
				</div>
			</div>
		</div>	
	</div>