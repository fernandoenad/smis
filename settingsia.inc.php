<br>

<?php
if(isset($_POST["submit1"])) {
	$target_dir = "./assets/images/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	if($imageFileType != "png") {
		$message= "Sorry, only png files are allowed.";
	} 
	else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.'sanhs_logo.png')) {
        $message= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. Please perform a hard refresh to update the Site School Seal.";
    } else {
        $message= "Sorry, there was an error uploading your file.";
    }
	copy($target_dir.'sanhs_logo.png',$target_dir.'seal.png');
} /* else if(isset($_POST["submit2"])) {
	if($imageFileType != "png") {
		$message= "Sorry, only png files are allowed.";
	} 
	else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.'seal.png')) {
        $message= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. Please perform a hard refresh to update the Site School Seal.";
    } else {
        $message= "Sorry, there was an error uploading your file.";
    }
	
}  */ 

else if(isset($_POST["submit3"])) {
	if($imageFileType != "png") {
		$message= "Sorry, only png files are allowed.";
	} 
	else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.'1.png')) {
        $message= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        $message= "Sorry, there was an error uploading your file.";
    }
}  else if(isset($_POST["submit4"])) {
	if($imageFileType != "jpg") {
		$message= "Sorry, only jpg files are allowed.";
	} 
	else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.'idbg.jpg')) {
        $message= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        $message= "Sorry, there was an error uploading your file.";
    }
}

?>
<div class="pagecontent container">
	<div class="page-header" style="margin-top: 20px">
		<h1>Asset Updater</h1>
	</div> 
	<div class="tab-content">
		<div class="tab-pane active" id="view_ledger">
			<div class="row-fluid">
				<div class="span12"><br>
					<table width="70%" align="center">
						<tr>
							<td align="center" colspan="3"><img src="./assets/images/sanhs_logo.png" width="200"> <br>Can be of any size.<br><br></td>
						</tr>					
						<tr>
							<form action="?page=settingsia" method="post" enctype="multipart/form-data">
								<td>Select School Seal to upload:</td>
								<td> <input type="file" name="fileToUpload" id="fileToUpload"  class=" form-control"></td>
								<td> <input type="submit" value="Upload School Seal File" name="submit1"  class=" form-control"></td>
							</form>
						</tr>
						<tr>
							<td colspan="3" align="center"><br><font color="blue"><?php echo (isset($_POST["submit1"])?$message:"");?></font></td>
						</tr>
					</table><hr>
					<!--
					<table width="70%" align="center">
						<tr>
							<td align="center" colspan="3"><img src="./assets/images/seal.png" width="200"> <br>Limited to 16px x 16px size.<br><br></td>
						</tr>
						<tr>
							<form action="?page=settingsia" method="post" enctype="multipart/form-data">
								<td>Select School FAVICON to upload:</td>
								<td> <input type="file" name="fileToUpload" id="fileToUpload"  class=" form-control"></td>
								<td> <input type="submit" value="Upload School FAVICON File" name="submit2"  class=" form-control"></td>
							</form>
						</tr>
						<tr>
							<td colspan="3" align="center"><br><font color="blue"><?php echo (isset($_POST["submit2"])?$message:"");?></font></td>
						</tr>
					</table><hr>
					-->
					<table width="70%" align="center">
						<tr>
							<td align="center" colspan="3"><img src="./assets/images/1.png" width="200"> <br>Can be of any size.<br><br></td>
						</tr>
						<tr>
							<form action="?page=settingsia" method="post" enctype="multipart/form-data">
								<td>Select School Head Signature to upload:</td>
								<td> <input type="file" name="fileToUpload" id="fileToUpload"  class=" form-control"></td>
								<td> <input type="submit" value="Upload School Head Signature File" name="submit3"  class=" form-control"></td>
							</form>
						</tr>
						<tr>
							<td colspan="3" align="center"><br><font color="blue"><?php echo (isset($_POST["submit3"])?$message:"");?></font></td>
						</tr>
					</table><hr>
					<table width="70%" align="center">
						<tr>
							<td align="center" colspan="3"><img src="./assets/images/idbg.jpg" width="200"> <br>Limited to 280px by 414px.<br><br></td>
						</tr>
						<tr>
							<form action="?page=settingsia" method="post" enctype="multipart/form-data">
								<td>Select School ID Background to upload:</td>
								<td> <input type="file" name="fileToUpload" id="fileToUpload"  class=" form-control"></td>
								<td> <input type="submit" value="Upload School ID Background" name="submit4"  class=" form-control"></td>
							</form>
						</tr>
						<tr>
							<td colspan="3" align="center"><br><font color="blue"><?php echo (isset($_POST["submit4"])?$message:"");?></font></td>
						</tr>
					</table>

				</div>
			</div>		
		</div>
		</div>
	</div>
</div>



