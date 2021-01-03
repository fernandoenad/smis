<?php
if(isset($_POST['search'])) {
	$search = trim($_POST['search']);
}
elseif(isset($_GET['search'])) {
	$search = trim($_GET['search']);
}
else{
	$search = " ";
}

if (isset($_GET['pagenum'])) {
	$pagenum = $_GET['pagenum'];
}
else {
	$pagenum = 1;
}
$prev_sy = $current_sy-1;
$rowsChk = dbquery("select * from student inner join studenroll on stud_no=enrol_stud_no where (enrol_sy='$prev_sy' and enrol_status1!='INACTIVE' and (CONCAT(stud_lname,', ',stud_fname,' ',stud_mname) LIKE '%".$search."%' OR stud_lrn LIKE '%".$search."%' OR stud_no LIKE '%".$search."%') and stud_lrn not in (select prop_lrn from proposedsection where prop_sy='$current_sy')) order by stud_lname asc, stud_fname asc");
$countChk = dbrows($rowsChk);
$page_rows = 50;
$last = ceil($countChk/$page_rows); 

if ($pagenum < 1) { 
	$pagenum = 1; 
} 
elseif ($pagenum > $last) { 
	$pagenum = $last; 
} 

$max = 'limit ' .($pagenum - 1) * $page_rows .',' .$page_rows;
$start_page = ($pagenum - 1) * $page_rows;
$listCurrentStudents = dbquery("select * from student inner join studenroll on stud_no=enrol_stud_no where (enrol_sy='$prev_sy' and enrol_status1!='INACTIVE' and (CONCAT(stud_lname,', ',stud_fname,' ',stud_mname) LIKE '%".$search."%' OR stud_lrn LIKE '%".$search."%' OR stud_no LIKE '%".$search."%') and stud_lrn not in (select prop_lrn from proposedsection where prop_sy='$current_sy')) order by stud_lname asc, stud_fname ASC ".$max."");

?>

	<div class="pagecontent container">
		<div class="row row-toolbar">
			<div class="col-lg-3 col-md-3 col-lg-push-9 col-md-push-9">
				<div class="btn-group pull-right" style="margin-top: 5px;">
					<form class="navbar-form navbar-right" method="post" action="./?page=sectioning&search">
						<div class="input-group">
							<input type="text" name="search" class="form-control" placeholder="Search Student..." value="<?php echo $search;?>" autofocus>
							<div class="input-group-btn">
								<button  class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">Previous SY Students List
			<div class="btn-toolbar  pull-right">
						<div class="btn-group">
							<a  title="Access Current SY Sectioning List" class="btn  btn-xs  btn-default" href="?page=sectioning2">
								<span class="glyphicon glyphicon-list"> Current Sectioning List</span></a>

						</div>
                    </div>
			
			
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table-condensed table-striped table-sticky">
					<thead>
						<tr>
							<th width="3%">#</th>
							<th width="10%">Student No</th>
							<th>Learner</th>
							<th width="10%">Gender</th>
							<th width="20%">Current Class</th>
							<th width="15%">Verification</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$i=$start_page+1;
					while($dataCurrentStudents = dbarray($listCurrentStudents)){
					?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $dataCurrentStudents['stud_no'];?></td>
							<td><?php echo strtoupper($dataCurrentStudents['stud_lname'].", ".$dataCurrentStudents['stud_fname']." ".$dataCurrentStudents['stud_xname']." ".$dataCurrentStudents['stud_mname']);?></td>
							<td><?php echo $dataCurrentStudents['stud_gender'];?></td>
							<td><?php echo $dataCurrentStudents['enrol_level']." - ".$dataCurrentStudents['enrol_section'];?></td>
							<td><a href="./sectioning.frm.php?stud_no=<?php echo $dataCurrentStudents['stud_no'];?>" title="Assign Section" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false"><span class="glyphicon glyphicon-share"></span></a></td>

						</tr>
					<?php
					$i++;
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
		<center>
			<ul class="pagination">
			<?php 
			for($i=1;$i<=$last;$i++){
			?>
				<li class="<?php echo ($i==$_GET['pagenum']?"active":"");?> <?php echo (!isset($_GET['pagenum']) && $i==1?"active":"");?>"><a href="./?page=sectioning&pagenum=<?php echo $i;?>"><?php echo $i;?></a></li>
			<?php
			}
			?>
			</ul>
		</center>
	</div>	</div></div>

