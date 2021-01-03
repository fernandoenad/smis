	<?php
session_start();

require ("maincore.php");
$resultUser = dbquery("SELECT * FROM users WHERE user_no='".$_GET['UpdateUser']."'");
$dataUser = dbarray($resultUser );
?>

<script type="text/javascript">
	$(document).ready(function(){
	$('#user_name').keyup(username_check3);
	});
		
	function username_check3(){	
	var stud_lrn = $('#user_name').val();
	if(stud_lrn == "" || stud_lrn.length < 1){
	$('#user_name').css('border', '3px #CCC solid');
	$('#tick').hide();
	$("#submit").attr("disabled", "disabled");
	}else{
		$("#submit").removeAttr("disabled");
	jQuery.ajax({
	   type: "POST",
	   url: "checkUser.php",
	   data: 'stud_lrn='+ stud_lrn,
	   cache: false,
	   success: function(response){
			if(response == 1){
				$('#user_name').css('border', '3px #C33 solid');	
				$('#tick').hide();
				$('#cross').fadeIn();
				$("#submit").attr("disabled", "disabled");
				}else{
				$('#user_name').css('border', '3px #090 solid');
				$('#cross').hide();
				$('#tick').fadeIn();
				}
			}
		});
	}
	}
	</script>
	<style>
		#tick{display:none}
		#cross{display:none}
	</style>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()">&times;</button>
		<h4 class="modal-title">Update User</h4>
    </div>
	<form method="post" action="admin.scr.php?UpdateUser=Yes">
	<input type="hidden" id="section_no" name="user_no" required="required" class=" form-control" value="<?php echo $dataUser['user_no'];?>">
	<div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Username <span title="Required" class="text-danger">*</span></label>
						<img id="tick" src="assets/images/tick.png" width="16" height="16"/>
						<img id="cross" src="assets/images/cross.png" width="16" height="16"/>
						<input type="text" id="user_name" name="user_name" required="required" readonly class=" form-control" value="<?php echo $dataUser['user_name'];?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Fullname <span title="Required" class="text-danger">*</span> <small><i>(modifiable when updating teacher profile)</i></small></label>
						<input type="text" id="user_fullname" <?php echo ($_SESSION["userid"]==1?"":"disabled");?> name="user_fullname" required="required" class=" form-control" value="<?php echo $dataUser['user_fullname'];?>" >
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">System role <span title="Required" class="text-danger">*</span></label>
						<select id="user_role" name="user_role" required="required" class=" form-control">
							<option value="1" <?php echo (1==$dataUser['user_role'])?"selected":"";?>>System Administrator</option>
							<option value="2" <?php echo (2==$dataUser['user_role'])?"selected":"";?>>Faculty</option>
							<option value="3" <?php echo (3==$dataUser['user_role'])?"selected":"";?>>Encoder</option>
						</select>
					</div>
				</div>
			</div>			
		</div>
     </div>
	<div class="modal-footer">
		<button type="submit" id="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')">Update</button>
		<button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
	</div>
	</form>
</div>