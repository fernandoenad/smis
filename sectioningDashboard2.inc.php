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

$rowsChk = dbquery("select * from student inner join proposedsection on stud_no=prop_lrn where (prop_sy='$current_sy' and (CONCAT(stud_lname,', ',stud_fname,' ',stud_mname) LIKE '%".$search."%' OR stud_lrn LIKE '%".$search."%' OR stud_no LIKE '%".$search."%' ) and prop_section LIKE '".(isset($_GET['classProfile']) ? $_GET['classProfile'] : "%")."') order by stud_lname asc, stud_fname asc");
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
$listCurrentStudents = dbquery("select * from student inner join proposedsection on stud_no=prop_lrn where (prop_sy='$current_sy' and (CONCAT(stud_lname,', ',stud_fname,' ',stud_mname) LIKE '%".$search."%' OR stud_lrn LIKE '%".$search."%' OR stud_no LIKE '%".$search."%' ) and prop_section LIKE '".(isset($_GET['classProfile']) ? $_GET['classProfile'] : "%")."') order by stud_lname asc, stud_fname ASC ".$max."");

?>

	<div class="pagecontent container">
		<div class="row row-toolbar">
			<div class="col-lg-3 col-md-3 col-lg-push-9 col-md-push-9">
				<div class="btn-group pull-right" style="margin-top: 5px;">
					<form class="navbar-form navbar-right" method="post" action="./?page=sectioning2&search&classProfile=<?php echo $_GET['classProfile'];?>">
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
		<div class="row row-toolbar">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-push-8 col-md-push-8 col-sm-push-8 col-xs-push-8 clearfix"></div>
	
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-pull-4 col-md-pull-4 col-sm-pull-4 col-xs-pull-4">
			<label class="control-label required" for="enrol_actual_lrn">Select Section From Dropdown <span title="Required" class="text-danger">*</span></label>
                <select <?php echo($_SESSION["user_role"]==2?"disabled":"");?> class="form-control" id="ui-classes" style="margin-top: 5px" onchange="if (this.value) window.location.href=this.value">
				<?php
				for($section_level=7;$section_level <= 12; $section_level++){
				?>
					<optgroup label="Grade <?php echo $section_level; ?>">  
					<?php
					$resultSection = dbquery("SELECT * FROM section WHERE (section_level='".$section_level."' AND section_sy='".$current_sy."') ORDER BY section_name ASC");
					while($dataSection = dbarray($resultSection)){
						if(substr($dataSection['section_name'],0,5)=="Z_TLE"){
						}
						else{
					?>
						<option value=".?page=sectioning2&classProfile=<?php echo $dataSection['section_name']; ?>" <?php echo (isset($_GET['classProfile']) && $dataSection['section_name']==$_GET['classProfile']?"selected":"");?>>Grade <?php echo $dataSection['section_level']; ?> - <?php echo $dataSection['section_name']; ?></option>
					<?php }} ?>
					</optgroup> 
				<?php }?>	
                </select>

          </div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">Current Sectioning List
			<div class="btn-toolbar  pull-right">
						<div class="btn-group">
							<a  title="Access Current SY Sectioning List" class="btn  btn-xs  btn-default" href="?page=sectioning">
								<span class="glyphicon glyphicon-list"> Previous SY Students List</span></a>

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
							<th width="15%">Action</th>
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
							<td><?php echo $dataCurrentStudents['prop_section'];?></td>
							<td><a href="./sectioning2.frm.php?stud_no=<?php echo $dataCurrentStudents['stud_no'];?>" title="Assign Section" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false"><span class="glyphicon glyphicon-share"></span></a></td>

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

