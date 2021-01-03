<?php
require ("maincore.php");
if(isset($_GET['saveCombo']) && $_GET['saveCombo']=="yes"){
	$insertNewCombo = dbquery("insert into dropdowns (field_no, field_category, field_name) values ('','COMBO-".$_POST['enrol_strand']."','".$_POST['enrol_combo']."')");
	$insertNewCombo1 = dbquery("insert into dropdowns (field_no, field_category, field_name) values ('','TRACK','SHS-".$_POST['enrol_track']."-".$_POST['enrol_strand']."')");

	header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>
		  <script type="text/javascript">
			   $(document).ready(function(){
				   $("#enrol_track").change(function(){
						 var enrol_track=$("#enrol_track").val();
						 $.ajax({
							type:"post",
							url:"getstrand.php",
							data:"enrol_track="+enrol_track,
							success:function(data){
								  $("#enrol_strand").html(data);
							}
						 });
				   });
			   });
		  </script>	
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()">&times;</button>
		<h4 class="modal-title">New Senior HS Offering</h4>
    </div>
	<form method="post" action="offeringNew.frm.php?saveCombo=yes">
	<div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Track <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_track" name="enrol_track" required class=" form-control">
							<option value="">--select---</option>
							<?php
							$checkTracks = dbquery("select * from dropdowns where field_category='TRACKS'");
							while($dataTracks=dbarray($checkTracks)){
							?>
								<option value="<?php echo $dataTracks['field_name'];?>"><?php echo $dataTracks['field_name'];?></option>
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
						<label class="control-label required" for="stud_lrn">Strand <span title="Required" class="text-danger">*</span></label>
						<select id="enrol_strand" name="enrol_strand" required class=" form-control">
							<option value="">--select---</option>
							<?php
							$checkStrands = dbquery("select * from dropdowns where field_category like 'STRAND%'");
							while($dataStrands = dbarray($checkStrands)){
							?>
							<option value="<?php echo $dataStrands['field_name'];?>"><?php echo $dataStrands['field_name'];?></option>
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
						<label class="control-label required" for="stud_lrn">Combo <span title="Required" class="text-danger">*</span></label>
						<input type="text" id="enrol_combo" name="enrol_combo" required="required" class=" form-control" value="">
					</div>
				</div>
			</div>				
		</div>
     </div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')">Save</button>
		<button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
	</div>
	</form>
</div>