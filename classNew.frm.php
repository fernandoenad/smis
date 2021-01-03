<?php
require ("maincore.php");
?>
<script type="text/javascript">
	

</script>	

<script type="text/javascript">

	$(document).ready(function(){
	$('#section_name').keyup(username_check);
	});
		
	function username_check(){	
	var teach_id = $('#section_name').val();
	if(teach_id == "" || teach_id.length < 1){
	$('#section_name').css('border', '3px #CCC solid');
	$('#tick').hide();
	$("#submit").attr("disabled", "disabled");
	}else{
		$("#submit").removeAttr("disabled");
	jQuery.ajax({
	   type: "POST",
	   url: "checkClass.php",
	   data: 'teach_id='+ teach_id,
	   cache: false,
	   success: function(response){
			if(response == 1){
				$('#section_name').css('border', '3px #C33 solid');	
				$('#tick').hide();
				$('#cross').fadeIn();
				$("#submit").attr("disabled", "disabled");
				}else{
				$('#section_name').css('border', '3px #090 solid');
				$('#cross').hide();
				$('#tick').fadeIn();
				}
			}
		});
	}
	}
	$("input#section_name").on({
	  keydown: function(e) {
		if (e.which === 32)
		  return false;
	  },
	  change: function() {
		this.value = this.value.replace(/\s/g, "");
	  }
	});

</script>	
	
<style>
		#tick{display:none}
		#cross{display:none}
</style>	
	
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()">&times;</button>
		<h4 class="modal-title">New Class</h4>
    </div>
	<form method="post" action="class.scr.php?NewClass=Yes">
	<input type="hidden" id="enrol_sy" name="enrol_sy" required="required" class=" form-control" value="<?php echo $_GET['enrol_sy'];?>">
	<div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Name <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="section_name" name="section_name" required="required" class=" form-control" value="" style="text-transform:uppercase;">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Level <span title="Required" class="text-danger">*</span></label>
						<select id="section_level" name="section_level" required="required" class=" form-control" value="" >
							<option value="">---select---</option>
						<?php
						for($i=$current_school_minlevel; $i<=$current_school_maxlevel; $i++){
						?>
							<option value="<?php echo $i;?>"><?php echo $i;?></option>
						<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Capacity <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="section_level" name="section_cap" required="required" class=" form-control" value="" >
					</div>
				</div>				
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Class Department / Type (Section Track/Strand) <span title="Required" class="text-danger">*</span></label>
						<select id="section_track_strand" name="section_track_strand" required="required" class=" form-control">
							<option value="">---select---</option>
							<?php
							$resultTeachers = dbquery("SELECT * FROM dropdowns WHERE (field_category='TRACK') ORDER BY field_name ASC");
							while($dataTeachers = dbarray($resultTeachers)){
							if($dataTeachers['field_name']=="SHS APPLIED" || $dataTeachers['field_name']=="SHS GENERAL"){}
							else{
							?>
							<option value="<?php echo $dataTeachers['field_name']; ?>"><?php echo strtoupper($dataTeachers['field_name']); ?></option>
							<?php } }?>
						</select>
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Adviser <span title="Required" class="text-danger">*</span></label>
						<select id="section_adviser" name="section_adviser" required="required" class=" form-control">
							<option value="">---select---</option>
							<option value="1">---TBA---</option>
							<?php
							$resultTeachers = dbquery("SELECT * FROM users WHERE (user_role!='3' and user_status='1' and user_no>=3) ORDER BY user_fullname ASC");
							while($dataTeachers = dbarray($resultTeachers)){
							?>
							<option value="<?php echo $dataTeachers['user_no']; ?>" <?php echo $dataTeachers['user_no']; ?>><?php echo strtoupper($dataTeachers['user_fullname']); ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>			
		</div>
     </div>
	<div class="modal-footer">
		<button type="submit" name="submit" id="submit" class="btn btn-primary" disabled onClick="return confirm('Are you sure you want to save changes?')">Save</button>
		<button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
	</div>
	</form>
</div>

