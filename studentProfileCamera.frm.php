<?php
session_start();
require ('maincore.php');

if(isset($_POST["submit1"])) {
	$target_dir = "./assets/images/students/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	if($imageFileType != "jpg") {
		$message= "Sorry, only jpg files are allowed.";
	} 
	else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$_GET['showProfile'].'.jpg')) {
        $message= "successful";
    } else {
        $message= "failed";
    }
	header("Location: ".$_SERVER['HTTP_REFERER']."&status=".$message);
}
?>
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Image Uploader</h4>
      </div>
	  <form action="./studentProfileCamera.frm.php?showProfile=<?php echo $_GET['stud_no'];?>" method="post" enctype="multipart/form-data">
      <div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
					<b>Select Image File to upload:</b>
					<table width="100%" align="center">
			
						<tr>
							
								<td> <input type="file" name="fileToUpload" id="fileToUpload"  class=" form-control"></td>
								<td> <input type="submit" value="Upload Image File" name="submit1"  class=" form-control"></td>
							
						</tr>
						<tr>
							<td colspan="3" align="center"><br><font color="blue"><?php echo (isset($_POST["submit1"])?$message:"");?></font></td>
						</tr>
					</table>
					</div>
				</div>
			</div>
		</div>
		</form>
      <div class="modal-footer">
        <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	</div>