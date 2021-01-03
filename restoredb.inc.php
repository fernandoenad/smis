<br>

<?php
$target_dir = "./backupdb/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["submit1"])) {
	if($imageFileType != "sql") {
		$message= "Sorry, only sql files are allowed.";
	} 
	else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.'restoredb.sql')) {
        $message= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. Click restore on the table below to restore the backup.";
    } else {
        $message= "Sorry, there was an error uploading your file.";
    }
}

?>
<div class="pagecontent container">
	<div class="page-header" style="margin-top: 20px">
		<h1>Restore Backup Panel</h1>
	</div> 
	<div class="tab-content">
		<div class="tab-pane active" id="view_ledger">
			<div class="row-fluid">
				<div class="span12"><br>
					<table width="70%" align="center">
			
						<tr>
							<form action="?page=restoredb" method="post" enctype="multipart/form-data">
								<td>Select Backup File to upload:</td>
								<td> <input type="file" name="fileToUpload" id="fileToUpload"  class=" form-control"></td>
								<td> <input type="submit" value="Upload Backup File" name="submit1"  class=" form-control"></td>
							</form>
						</tr>
						<tr>
							<td colspan="3" align="center"><br><font color="blue"><?php echo (isset($_POST["submit1"])?$message:"");?></font></td>
						</tr>
					</table>
				</div>
			</div>		
		</div>
		</div>
		<div class="tab-content">
		<div class="tab-pane active" id="view_ledger">
			<div class="row-fluid">
				<div class="span12"><br>
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="btn-toolbar  pull-right">
							<div class="btn-group">
																									
							</div>
							</div>
							
							Database Update History</div>
						<div class="table-responsive">
							<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
								<thead>
									<tr>
										<th width="3%">#</th>
										<th>Backup File</th>
										<th width="50%"></th>					
									</tr>
								</thead>
								<tbody> 
									<tr>
										<td>*</td>
										<td>Restore Backup</td>
										<td>
										<?php
										if (file_exists("./backupdb/restoredb.sql")){
										?>
										<a href="./confirmRestoreBackup.frm.php" title="Restore Backup" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" onclick="return confirm('Are you sure you want to restore backup? This action will replace all current data...')">Restore Backup</a>
										<?php
										}
										else  {
										?>
										No Restore file found! Upload backup to restore.</a>
										<?php
										}
										?>
										</td>
									</tr>		
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



