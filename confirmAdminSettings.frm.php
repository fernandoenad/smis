<?php
require ('maincore.php');

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
	   url: "checkAdminPwordSettings.php",
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
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">License Restriction</h4>
    </div>
	<form name="form1" method="post" action="?">
    <div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						
						<label class="control-label required" for="stud_lrn">Enter the License Bypass Code: <span title="Required" class="text-danger">*</span><img id="tick" src="assets/images/tick.png" width="16" height="16"/>
						<img id="cross" src="assets/images/cross.png" width="16" height="16"/></label>
						<input type="password" id="admin_pword" name="admin_pword" maxlength="50" required="required" class=" form-control" style="text-size: 50px" value="" placeholder="Enter the bypass code here..." / autofocus >
						
						</tr>
					</div>
				</div>
			</div>

		</div>
     </div>
	<div class="modal-footer">
		<a href="config.frm.php" id="submit" name="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" disabled="disabled" >Proceed</a>
		<button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
	</div>
	</form>
</div>		