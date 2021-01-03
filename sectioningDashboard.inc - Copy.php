<?php
if(isset($_POST['searchStudent'])) {
	$searchStudent = $_POST['searchStudent'];
	$selectStudent = dbquery("SELECT * FROM proposedsection WHERE (prop_sy='".$current_sy."' AND prop_lrn='".$searchStudent ."')");
	$countStudent = dbrows($selectStudent );
	if($countStudent<1){
		$insertProposedSection = dbquery("INSERT INTO proposedsection (prop_no, prop_sy, prop_lrn, prop_section) VALUES ('', '".$current_sy."', '".$searchStudent."', '".$_POST['enrol_section']."')");
	}
}

if(isset($_GET['DeleteAnec']) && $_GET['DeleteAnec']=="Yes"){
	$result1 = dbquery("DELETE FROM proposedsection WHERE prop_no='".$_GET['anec_no']."'");	
}

$result = dbquery("SELECT * FROM student INNER JOIN proposedsection ON student.stud_no=proposedsection.prop_lrn WHERE (CONCAT(stud_lname,', ',stud_fname) LIKE '%".$searchStudent."%' OR stud_lrn LIKE '%".$searchStudent."%' OR stud_no LIKE '%".$searchStudent."%' AND prop_sy='".$current_sy."')  ORDER BY prop_section ASC, stud_lname ASC, stud_fname ASC ".$max."");
$rows = dbrows($result);

?>
		<div class="pagecontent container">
			<div class="row row-toolbar">
				<div class="container">
					<div class="col-lg-12 col-md-12">
						<div class="btn-group pull-right" style="margin-top: 5px;">
							<div class="form-group" style="width: 600px">
								<form class="navbar-form navbar-right" method="post" action="./?page=sectioning">
									<div class="input-group">
										<span class="input-group-btn btn-group">
											<input type="number" name="searchStudent" class="form-control" placeholder="Input Student No to Add..." style="width: 200px" value="" autofocus>
											<select id="enrol_section" name="enrol_section" required="required"  class="selectpicker form-control" data-live-search="true" style="width: 200px">
											<?php
												$selectSection = dbquery("SELECT * FROM section WHERE section_sy='".$current_sy."' ORDER BY section_level ASC, section_name ASC");
												while($rowSection = dbarray($selectSection )){
											?>
												<option value="<?php echo $rowSection['section_name'];?>" <?php echo ($rowSection['section_name']==$_POST['enrol_section']?"selected":"");?>><?php echo $rowSection['section_level'];?> - <?php echo $rowSection['section_name'];?></option>
											<?php
												}
											?>
											</select>
											<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-plus"></i></button>
										</span>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="page-header" style="margin-top: 20px">
				<h1>Student Sectioning Dashboard</h1>
			</div>
	    <ol class="breadcrumb">
        <li><a href="./?page=teacher">Student</a></li>
    </ol>
	

			<div class="panel panel-default">

				<div class="panel-heading">Student List</div>
				<div class="table-responsive">
					<table class="table table-bordered table-condensed table-striped table-sticky">
						<thead>
							<tr>
								<th width="3%">#</th>
								<th width="13%">LRN </th>
								<th>Student</th>
								<th width="10%">Gender</th>
								<th width="20%">New Level</th>
								<th>New Section</th>
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
								<td class="text-right"><?php echo ($pagenum-1)* $page_rows  +$i; ?></td>
								<td><?php echo $data['stud_lrn']; ?></td>
								<td><?php echo strtoupper($data['stud_lname']).", ".strtoupper($data['stud_fname'])." ".strtoupper($data['stud_xname'])." ".strtoupper($data['stud_mname']); ?></td>
								<td><?php echo $data['stud_gender']; ?></td>
								<?php
									$selectAppointments = dbquery("SELECT * FROM studenroll WHERE enrol_stud_no='".$data['stud_no']."' ORDER BY enrol_sy DESC LIMIT 1");
									$rowAppointments = dbarray($selectAppointments);
								?>
								<td><?php echo $rowAppointments['enrol_level']+1;?></td>
								<td>
								<?php
									$proposedSection = dbquery("SELECT * FROM proposedsection WHERE (prop_lrn='".$data['stud_no']."' AND prop_sy='".$current_sy."')");
									$proposedSectionResult = dbarray($proposedSection);
									echo $proposedSectionResult['prop_section'];
								?>
								</td>
								<td><a class="btn btn-default btn-xs" href="./?page=student&showProfile=<?php echo $data['stud_no'];  ?>">Profile</a>
								<a href="./?page=sectioning&DeleteAnec=Yes&anec_no=<?php echo $proposedSectionResult['prop_no']; ?>" title="Delete" 
															onClick="return confirm('Are you sure you want to delete entry?')" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-remove"></span></a>
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
												
				</div>
			</div>
		</div>	
	</div>