<?php
require ("maincore.php");
//$resultPros = dbquery("SELECT * FROM prospectus WHERE pros_no='".$_GET['No']."' ");
$dataPros = null;

?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">New Prospectus</h4>
    </div>
	<form method="post" action="prospectus.scr.php?Add=Yes">
	<input type="hidden" id="class_pros_no" name="level" required="required" class=" form-control" value="<?php echo $_GET['gradeLevel'];?>">
	<input type="hidden" id="class_pros_no" name="curr" required="required" class=" form-control" value="<?php echo $_GET['prosCurr'];?>">

	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Course Code <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="class_section_name" name="code" required="required" class=" form-control" value="" >
					</div>
				</div>
			</div>			
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Descriptive Title <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="class_section_name" name="title" required="required" class=" form-control" value="" >
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Cut Off Grade <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="class_section_name" name="cutoff" required="required" class=" form-control" value="75" >
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Pre-requisite <span title="Required" class="text-danger">*</span></label>
						<input id="class_section_name" name="prereq" required="required" class=" form-control" value="" >
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Unit <span title="Required" class="text-danger">*</span></label>
						<input type="number" step="0.01" id="class_section_name" name="unit" required="required" class=" form-control" value="1" >
					</div>
				</div>
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Hours/Week  <span title="Required" class="text-danger">*</span></label>
						<input type="number" step="0.01" id="class_section_name" name="hours" required="required" class=" form-control" value="4" >
					</div>
				</div>
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Term <span title="Required" class="text-danger">*</span></label>
						<select id="class_section_name" name="term" required="required" class=" form-control">
							<option value="">---select---</option>
							<option value="12" <?php echo ($_GET['prosSem']==12?"selected":"");?>>Full Year</option>
							<option value="1" <?php echo ($_GET['prosSem']==1?"selected":"");?>>First Semester</option>
							<option value="2" <?php echo ($_GET['prosSem']==2?"selected":"");?>>Second Semester</option>
						</select>
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<?php 
						$track = $_GET['gradeLevel'];
						$trackName = ($track<11?($track<7?"ES":"JHS"):"SHS");
						$checkTracks = dbquery("SELECT * FROM dropdowns WHERE (field_category='TRACK' AND field_name LIKE '%".$trackName."%') ORDER BY field_name ASC");
						?>
						<label class="control-label required" for="stud_lrn">Track <span title="Required" class="text-danger">*</span></label>
						<select type="number" id="class_section_name" name="track" required="required" class=" form-control">
							<option value="">---select---</option>
							<?php
							while($dataTracks = dbarray($checkTracks)){
							?>
								<option value="<?php echo $dataTracks['field_name'];?>" <?php echo ($track<11?"selected":"");?>><?php echo $dataTracks['field_name'];?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Sort Order (1-n<sup>th</sup>) <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="class_section_name" name="sort" required="required" class=" form-control" value="<?php echo $dataPros['pros_sort'];?>" >
					</div>
				</div>
			</div>				
		</div>
     </div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')">Save</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	</form>
</div>