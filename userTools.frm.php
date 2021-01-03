<?php
session_start();
require ('maincore.php');
?>
<script type="text/javascript">
	$(document).ready(function(){
	$('#user_pass').keyup(userPword_check);
	});
	
	function userPword_check(){	
	var user_pass = $('#user_pass').val();
	if(user_pass == "" || user_pass.length < 2){
		$('#user_pass').css('border', '3px #CCC solid');
		$('#tick').hide();
	}else{
		
	jQuery.ajax({
	   type: "POST",
	   url: "checkUserPass.php",
	   data: 'user_pass='+ user_pass,
	   cache: false,
	   success: function(response){
			if(response == 0){
				$('#user_pass').css('border', '3px #C33 solid');	
				$('#tick').hide();
				$('#cross').fadeIn();	
				$("#user_pass1").attr("readonly", "readonly");
				$("#user_pass2").attr("readonly", "readonly");				
				}else{
				$('#user_pass').css('border', '3px #090 solid');
				$('#cross').hide();
				$('#tick').fadeIn();
				$("#user_pass1").removeAttr("readonly");
				$("#user_pass2").removeAttr("readonly");
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
	
<script type="text/javascript">
	$(document).ready(function(){
	$('#user_pass2').keyup(userPword_match);
	});
	
	function userPword_match(){	
	var user_pass1 = $('#user_pass1').val();
	var user_pass2 = $('#user_pass2').val();
	if(user_pass2 != user_pass1){
		$('#user_pass2').css('border', '3px #CCC solid');
		$('#tick1').hide();
		$('#cross1').fadeIn();
		$("#submit").attr("disabled", "disabled");
	}else{
		$('#user_pass2').css('border', '3px #090 solid');
		$('#cross1').hide();
		$('#tick1').fadeIn();
		$("#submit").removeAttr("disabled");
	}
	}		
	</script>
  <style>
		#tick1{display:none}
		#cross1{display:none}
	</style>	
	
	
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()">&times;</button>
        <h4 class="modal-title">User Tools</h4>
      </div>
	  <form name="form1" method="post" action="userTools.scr.php">
	  <input type="hidden" id="user_name" name="user_name" maxlength="15" required="required" class="form-control" value="<?php echo $_SESSION["user_name"];?>" / autofocus>
      <div class="modal-body">
		<div class="card">
			<div class="card-heading simple">Username: <?php echo $_SESSION["user_name"];?></div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">User Fullname <span title="Required" class="text-danger">*</span></label>
							<input type="text" id="user_fullname" name="user_fullname" disabled maxlength="25" required="required" class="form-control" value="<?php echo $_SESSION["user_fullname"];?>" / autofocus <?php echo ($_SESSION["userid"]!=1?"readonly":"");?>>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Old Password <span title="Required" class="text-danger">*</span><img id="tick" src="assets/images/tick.png" width="16" height="16"/>
						<img id="cross" src="assets/images/cross.png" width="16" height="16"/></label>
							<input type="password" id="user_pass" name="user_pass" maxlength="50" class="form-control" value="" <?php echo ($_SESSION["user_name"]=="sanhs.admin"?"disabled":"");?>/ autofocus>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">New Password <span title="Required" class="text-danger">*</span></label>
							<input type="password" id="user_pass1" name="user_pass1" required maxlength="50" readonly class="form-control" value="" / autofocus>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label required" for="enrol_actual_lrn">Confirm Password <span title="Required" class="text-danger">*</span><img id="tick1" src="assets/images/tick.png" width="16" height="16"/>
						<img id="cross1" src="assets/images/cross.png" width="16" height="16"/></label>
							<input type="password" id="user_pass2" name="user_pass2" required maxlength="50" readonly class="form-control" value="" / autofocus>
						</div>
					</div>
				</div>
			</div>
		</div>
	  </div>
      <div class="modal-footer">
		<button type="submit" id="submit" name="submit" class="btn btn-primary" disabled onClick="return confirm('Are you sure you want to save changes?')" >Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
      </div>
	  </form>
    </div>
