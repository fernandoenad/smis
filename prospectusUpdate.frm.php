<?php
require ("maincore.php");
$resultPros = dbquery("SELECT * FROM prospectus WHERE pros_no='".$_GET['No']."' ");
$dataPros = dbarray($resultPros);
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Update Prospectus</h4>
    </div>
	<form method="post" action="prospectus.scr.php?Update=Yes">
	<input type="hidden" id="class_pros_no" name="no" required="required" class=" form-control" value="<?php echo $dataPros['pros_no'];?>">

	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Course Code <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="class_section_name" name="code" required="required" class=" form-control" value="<?php echo $dataPros['pros_title'];?>" >
					</div>
				</div>
			</div>			
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Descriptive Title <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="class_section_name" name="title" required="required" class=" form-control" value="<?php echo $dataPros['pros_desc'];?>" >
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Cut Off Grade <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="class_section_name" name="cutoff" required="required" class=" form-control" value="<?php echo $dataPros['pros_cutoff'];?>" >
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Pre-requisite <span title="Required" class="text-danger">*</span></label>
						<input id="class_section_name" name="prereq" required="required" class=" form-control" value="<?php echo $dataPros['pros_prereq'];?>" >
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Unit <span title="Required" class="text-danger">*</span></label>
						<input type="number" step="0.01" id="class_section_name" name="unit" required="required" class=" form-control" value="<?php echo $dataPros['pros_unit'];?>" >
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Hours/Week <span title="Required" class="text-danger">*</span></label>
						<input type="number" step="0.01" id="class_section_name" name="hours" required="required" class=" form-control" value="<?php echo $dataPros['pros_hoursPerWk'];?>" >
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Grade Level <span title="Required" class="text-danger">*</span></label>
						<select id="class_section_name" name="level" required="required" class=" form-control">
							<option value="">---select---</option>
							<?php
							$dept=substr($dataPros['pros_track'],0,3);
							for($i=$current_school_minlevel;$i<=$current_school_maxlevel;$i++){
							?>
								<option value="<?php echo $i;?>" <?php echo ($i==$dataPros['pros_level']?"selected":"");?>><?php echo $i;?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="col-lg-3 col-md-3">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Term <span title="Required" class="text-danger">*</span></label>
						<select id="class_section_name" name="term" required="required" class=" form-control">
							<option value="">---select---</option>
							<option value="12" <?php echo ($dataPros['pros_sem']==12?"selected":"");?>>Full Year</option>
							<option value="1" <?php echo ($dataPros['pros_sem']==1?"selected":"");?>>First Semester</option>
							<option value="2" <?php echo ($dataPros['pros_sem']==2?"selected":"");?>>Second Semester</option>
						</select>
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<?php 
						$checkTracks = dbquery("SELECT * FROM dropdowns WHERE field_category='TRACK' order by field_name asc");
						?>
						<label class="control-label required" for="stud_lrn">Track <span title="Required" class="text-danger">*</span></label>
						<select type="number" id="class_section_name" name="track" required="required" class=" form-control">
							<option value="">---select---</option>
							<?php
							while($dataTracks = dbarray($checkTracks)){
							?>
								<option value="<?php echo $dataTracks['field_name'];?>" <?php echo ($dataTracks['field_name']==$dataPros['pros_track']?"selected":"");?>><?php echo $dataTracks['field_name'];?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="col-lg-4 col-md-4">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Sort Order (1-n<sup>th</sup>) <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="class_section_name" name="sort" required="required" class=" form-control" value="<?php echo $dataPros['pros_sort'];?>" >
					</div>
				</div>
				<div class="col-lg-2 col-md-2">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Active <span title="Required" class="text-danger">*</span></label>
						<input type="checkbox" id="class_section_name" name="part"  class=" form-control" value="1" <?php echo ($dataPros['pros_part']==1?"checked":"");?>>
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