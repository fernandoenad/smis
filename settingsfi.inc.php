<br>

<?php
if(isset($_POST["submit"])) {
	$target_dir = "updates/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	if($imageFileType != "zip") {
		$message= "Sorry, only zipped files are allowed.";
	} 
	else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.'ver_update.zip')) {
        $message= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        $message= "Sorry, there was an error uploading your file.";
    }
}

if(isset($_GET['install']) && $_GET['install']=="yes"){
	$zip = new ZipArchive;
	$res = $zip->open('./updates/ver_update.zip');
	if ($res === TRUE) {
	  $zip->extractTo('./');
	  $zip->close();
	  unlink('./updates/ver_update.zip');
	} 
}
?>
<div class="pagecontent container">
	<div class="page-header" style="margin-top: 20px">
		<h1>Application Updater</h1>
	</div> 
	<div class="tab-content">
		<div class="tab-pane active" id="view_ledger">
			<div class="row-fluid">
				<div class="span12"><br>
					<table width="70%" align="center">
						<tr>
							<form action="?page=settingsfi" method="post" enctype="multipart/form-data">
								<td>Select zipped update file to upload:</td>
								<td> <input type="file" name="fileToUpload" id="fileToUpload"  class=" form-control"></td>
								<td> <input type="submit" value="Upload Zipped Update File" name="submit"  class=" form-control"></td>
							</form>
						</tr>
						<tr>
							<td colspan="3" align="center"><br><font color="blue"><?php echo (isset($_POST["submit"])?$message:"");?></font></td>
						</tr>
					</table><br>
					<div class="panel panel-default">
					
						<div class="panel-heading">
							<div class="btn-toolbar  pull-right">
							<div class="btn-group">
													
							</div>
							</div>
							Version Update Manager
							</div>
							
						<div class="table-responsive">
							
							<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
									
								<thead>
									<tr>
										<th width="3%">#</th>
										<th width="20%">Version Update #</th>
										<th>Update Details</th>
										<th width="15%"></th>					
									</tr>
								</thead>
								<tbody> 
									<?php
									if (file_exists("./updates/ver_update.zip")){
									?>
									<tr>
										<td>1</td>
										<td>Update Available</td>
										<td>Please check the SMIS FB page for update details.</td>
										<td><a href="?page=settingsfi&install=yes">Install</a></td>										
									</tr>
									<?php 
									}
									else {
									?>
									<tr>
										<td>*</td>
										<td>No New Update Available</td>
										<td>Please check the SMIS FB page for information on available updates, then upload it here for deployment.</td>
										<td>Up To Date</td>										
									</tr>
									<?php
									}
									?>
								</tbody>
							</table>
							

						</div>
					</div>
				</div>
			</div>		
		</div>
		</div>
	</div>
</div>



