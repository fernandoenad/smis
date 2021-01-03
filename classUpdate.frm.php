<?php
// Start the session
session_start();
require ("maincore.php");
$resultSectionInfo = dbquery("SELECT * FROM section WHERE (section_no='".$_GET['section_no']."' AND section_sy='".$_GET['enrol_sy']."')");
$dateSectionInfo = dbarray($resultSectionInfo);
?>
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
		<h4 class="modal-title">Class Setting - Section <?php echo $dateSectionInfo['section_name']; ?> / SY <?php echo $_GET['enrol_sy']; ?> - <?php echo $_GET['enrol_sy']+1; ?></h4>
    </div>
	<form method="post" action="class.scr.php?UpdateClass=Yes">
	<input type="hidden" id="section_no" name="section_no" required="required" class=" form-control" value="<?php echo $dateSectionInfo['section_no']; ?>">
	<input type="hidden" id="section_name_old" name="section_name_old" required="required" class=" form-control" value="<?php echo $dateSectionInfo['section_name']; ?>">
	<div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Name <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="section_name" name="section_name" required="required" class=" form-control" value="<?php echo $dateSectionInfo['section_name']; ?>" style="text-transform:uppercase;">
						
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Level <span title="Required" class="text-danger">*</span></label>
						<?php 
						$checkEnrolCount = dbquery("select * from studenroll where (enrol_sy='".$current_sy."' and enrol_section='".$dateSectionInfo['section_name']."')");
						$rowEnrolCount = dbrows($checkEnrolCount);
						if($rowEnrolCount>0){
						?>
							<input type="text" id="section_level" name="section_level" required="required" class=" form-control" value="<?php echo $dateSectionInfo['section_level']; ?>" readonly>
						<?php
						}
						else {
						?>
							<select id="section_level" name="section_level" required="required" class=" form-control" value="" >
								<option value="">---select---</option>
						<?php
								for($i=$current_school_minlevel; $i<=$current_school_maxlevel; $i++){
						?>
									<option value="<?php echo $i;?>" <?php echo ($dateSectionInfo['section_level']==$i?"selected":"");?>><?php echo $i;?></option>
						<?php
								}
						?>
							</select>
						<?php
						}
						?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Capacity <span title="Required" class="text-danger">*</span></label>
						<input type="number" id="section_level" name="section_cap" required="required" class=" form-control" value="<?php echo $dateSectionInfo['section_cap']; ?>">
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
							<option value="<?php echo $dataTeachers['field_name']; ?>" <?php echo ($dataTeachers['field_name']==$dateSectionInfo['section_track']?"selected":""); ?>><?php echo strtoupper($dataTeachers['field_name']); ?></option>
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
							<?php
							$resultTeachers = dbquery("SELECT * FROM users WHERE user_no='".$dateSectionInfo['section_adviser']."'");
							$dataTeachers = dbarray($resultTeachers)
							?>	
							<option value="1" <?php echo ($dataTeachers['user_no']=='1'?"selected":""); ?>>---TBA---</option>						
							<?php
							// AND user_no NOT IN (SELECT section_adviser FROM section WHERE section_sy='".$_GET['enrol_sy']."')
							$resultTeachers = dbquery("SELECT * FROM users WHERE (user_role!='3' and user_status='1' and user_no>=3) ORDER BY user_fullname ASC");
							while($dataTeachers = dbarray($resultTeachers)){
							?>
							<option value="<?php echo $dataTeachers['user_no']; ?>" <?php echo ($dataTeachers['user_no']==$dateSectionInfo['section_adviser']?"selected":""); ?>><?php echo strtoupper($dataTeachers['user_fullname']); ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>			
		</div>
     </div>
	<div class="modal-footer">
		<?php 
		if($_SESSION["user_role"]==1){
		$selectStudents = dbquery("SELECT * FROM studenroll WHERE (enrol_section='".$dateSectionInfo['section_name']."' AND enrol_sy='".$_GET['enrol_sy']."')");
		$countStudents = dbrows($selectStudents);
		$checkClasses = dbquery("select * from section inner join class on section_no=class_section_no where (section_no='".$_GET['section_no']."' and section_sy='".$_GET['enrol_sy']."')");
		$countClasses = dbrows($checkClasses);
		?>
		<a <?php echo ($countStudents>0?"disabled":"");?> <?php echo ($countClasses>0?"disabled":"");?> href="class.scr.php?DeleteClass=Yes&section_no=<?php echo $_GET['section_no']; ?>" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this class?')" >Delete Class</a>

		<?php }	?>		
		<button type="submit" id="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')" >Update</button>
		<button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
	</div>
	</form>
</div>

