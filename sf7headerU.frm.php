<?php
require ("maincore.php");
$resultAnec = dbquery("SELECT * FROM iis_menu WHERE iis_menu_no='".$_GET['anec_no']."'");
$dataAnec = dbarray($resultAnec);
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">New SF7 Header Information</h4>
    </div>
	<form method="post" action="sf7header.src.php?UpdateAnec=Yes">
	<input type="hidden" id="anec_no" name="anec_no" required="required" class=" form-control" value="<?php echo $_GET['anec_no'];?>">
	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Department <span title="Required" class="text-danger">*</span></label>
						<select id="anec_dep" name="anec_dep" required="required" class=" form-control">
							<option value="100" <?php echo ($dataAnec['iis_menuparent_menu_no']==100?"selected":"");?>>Elementary</option>
							<option value="200" <?php echo ($dataAnec['iis_menuparent_menu_no']==200?"selected":"");?>>Junior High School</option>
							<option value="300" <?php echo ($dataAnec['iis_menuparent_menu_no']==300?"selected":"");?>>Senior High School</option>
						</select>	
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Title of Plantilla Position <span title="Required" class="text-danger">*</span></label>
						<?php
							$selectPosition = dbquery("SELECT * FROM  dropdowns WHERE (field_category='POSITION' and field_ext like '0_%') ORDER BY field_name ASC");							
						?>
						<select id="anec_desc" name="anec_position" required="required" class=" form-control">
						<option value="">---select---</option>
							<?php
							while ($rowPosition = dbarray($selectPosition)){
							?>
								<option value="<?php echo substr($rowPosition['field_ext'],2);?>" <?php echo (substr($rowPosition['field_ext'],2)==$dataAnec['iis_menuname']?"selected":"");?>><?php echo substr($rowPosition['field_ext'],2);?></option>
							<?php
							}
							?>
						</select>	
					</div>
				</div>
				
			</div>		
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Number of Incumbent <span title="Required" class="text-danger">*</span></label>
						<select id="anec_desc" name="anec_funding" required="required" class=" form-control">
						<option value="">---select---</option>
							<?php
							for ($i=1;$i<=100;$i++){
							?>
								<option value="<?php echo $i;?>" <?php echo ($i==$dataAnec['iis_menusort']?"selected":"");?>><?php echo $i;?></option>
							<?php
							}
							?>
						</select>					
					</div>
				</div>
			</div>				
		</div>
     </div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')">Update</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	</form>
</div>