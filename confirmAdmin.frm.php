<?php
require ('maincore.php');
$resultStudent = dbquery("SELECT * FROM student WHERE stud_no='".$_GET['showProfile']."'");
$dataStudent = dbarray($resultStudent);

$resultEnrollment = dbquery("SELECT * FROM studenroll WHERE enrol_no='".$_GET['enrol_no']."'");
$dataEnrollment = dbarray($resultEnrollment);

?>
	<script type="text/javascript">
	$(document).ready(function(){
	$('#admin_pword').keyup(adminPword_check);
	});
	
	function adminPword_check(){	
	var admin_pword = $('#admin_pword').val();
	if(admin_pword == "" || admin_pword.length < 2){
	$('#admin_pword').css('border', '3px #CCC solid');
	$('#tick').hide();
	$("#submit").attr("disabled", "disabled");
	}else{
		
	jQuery.ajax({
	   type: "POST",
	   url: "checkAdminPword.php",
	   data: 'admin_pword='+ admin_pword,
	   cache: false,
	   success: function(response){
			if(response == 0){
				$('#admin_pword').css('border', '3px #C33 solid');	
				$('#tick').hide();
				$('#cross').fadeIn();
				$("#submit").attr("disabled", "disabled");
				}else{
				$('#admin_pword').css('border', '3px #090 solid');
				$('#cross').hide();
				$('#tick').fadeIn();
				$("#submit").removeAttr("disabled");
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
<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()">&times;</button>
		<h4 class="modal-title">Confirm Unenroll</h4>
    </div>
	<form name="form1" method="post" action="./enrollment.scr.php?UnEnroll=Yes">
	<input type="hidden" id="enrol_stud_no" name="enrol_stud_no" required="required" class=" form-control" value="<?php echo $_GET['showProfile']; ?>">
	<input type="hidden" id="enrol_no" name="enrol_no" required="required" class=" form-control" value="<?php echo $_GET['enrol_no']; ?>">
    <div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						Enter an Administrator password to confirm the unenrollment request! 
					</div>
				</div>
			</div>
			<div class="row"></div>
			<div class="row"></div>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						
						<label class="control-label required" for="stud_lrn">Administrator Password: <span title="Required" class="text-danger">*</span><img id="tick" src="assets/images/tick.png" width="16" height="16"/>
						<img id="cross" src="assets/images/cross.png" width="16" height="16"/></label>
						<input type="password" id="admin_pword" name="admin_pword" maxlength="50" required="required" class=" form-control" value="" placeholder="Administrator Password" / autofocus >
						
						</tr>
					</div>
				</div>
			</div>

		</div>
     </div>
	<div class="modal-footer">
		<button type="submit" id="submit" name="submit" class="btn btn-primary" 
			onClick="return confirm('Are you sure you want to unenroll \n<?php echo $dataStudent['stud_lrn']." ".$dataStudent['stud_lname'].", ".$dataStudent['stud_fname']." ".$dataStudent['stud_mname'];?> \nfrom School Year: <?php echo $dataEnrollment['enrol_sy'];?> - <?php echo $dataEnrollment['enrol_sy']+1;?>?')" disabled="disabled">Unenroll</button>
		<button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
	</div>
	</form>
</div>		