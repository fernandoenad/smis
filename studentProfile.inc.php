	<?php
if(isset($_GET['showProfile'])) {
	$searchStudent = $_GET['showProfile'];
}
else{
	$searchStudent = "a";
}




	$result = dbquery("SELECT * FROM student WHERE stud_no='".$searchStudent."'");
	$rows = dbrows($result);
	$data = dbarray($result);

?>


		<div class="pagecontent container">
			<div class="row row-toolbar">
				<div class="col-lg-3 col-md-3 col-lg-push-9 col-md-push-9">
					<div class="btn-group pull-right" style="margin-top: 5px;">
						<form class="navbar-form navbar-right" method="post" action="./?page=student">
							<div class="input-group">
								<input <?php echo($_SESSION["user_role"]==0?"disabled":"");?> type="text" name="searchStudent" class="form-control" placeholder="Search Student..." value="<?php echo (isset($_POST['searchStudent'])?$_POST['searchStudent']:""); ?>" autofocus>
								<div class="input-group-btn">
									<button <?php echo($_SESSION["user_role"]==0?"disabled":"");?> class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="page-header" style="margin-top: 20px">
				<h1>Student</h1>
			</div>  
			<ol class="breadcrumb">
				<?php 
				if($_SESSION["user_role"]==0){}
				else{
				?>
					<li><a href="./?page=student">Student</a></li>
				<?php
				}
				?>
				<li class="active">Student Profile</li>
			</ol>
			
			
<div class="clearfix" style="margin-bottom: 5px;"></div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="btn-toolbar  pull-right">
						<div class="btn-group">
							<!--
							<a  title="Print Student Profile" class="btn  btn-xs  btn-default" onclick="window.open('studPrintProfile.php?stud_no=<?php echo $data['stud_no']; ?>', 'newwindow', 'width=850, height=500'); return false;">
								Print Student Profile <span class="glyphicon glyphicon-user"></span></a>
							-->
							<a  <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  href="./studentProfileCamera.frm.php?stud_no=<?php echo $data['stud_no'];?>" title="Image Uploader" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
								<span class="glyphicon glyphicon-camera"></span></a>
							<a  <?php echo ($_SESSION["user_role"]==0?"disabled":"");?> title="Print ID" class="btn  btn-xs  btn-default" onclick="window.open('studPass.php?stud_no=<?php echo $data['stud_no']; ?>', 'newwindow', 'width=650, height=400'); return false;">
								<span class="glyphicon glyphicon-credit-card"></span></a>
							<a <?php echo($_SESSION["user_role"]==2?"disabled":"");?> <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  href="./student.scr.php?resetPass=Yes&stud_no=<?php echo $data['stud_no'];?>" title="Reset Password" class="btn  btn-xs  btn-default" onclick="return confirm('Are you sure you want to reset the student\'s account? This action will revert the password to \'P@ssw0rd\'.')">
								<span class="glyphicon glyphicon-repeat"></span></a>
                            <a <?php echo($_SESSION["user_role"]==0?"disabled":"");?> <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  href="./?page=student&updateProfile=<?php echo $data['stud_no'];?>" title="Update Information" class="btn  btn-xs  btn-default">
								<span class="glyphicon glyphicon-pencil"></span></a>

						</div>
                    </div>
                    Profile
					
                </div>
                
                <div class="panel-body">
					<div class="row-fluid">
						<div class="media">
							<?php
							$student_image = "./assets/images/students/".$data['stud_no'].".jpg";
							$no_image = "./assets/images/noimage.jpg";
									
							?>
							<div class="col-xs-6 col-md-2">
							<?php
							if ($_SESSION["user_role"]==0 || $_SESSION["user_role"]==2){
								$access = "#";
								$popUp = "";
							}
							else {
								$access = "./cameraapp/index.php?showProfile=".$_GET['showProfile'];
								$popUp = "onclick";
							}
							?>
							<a class="thumbnail" href="<?php echo $access;?>" <?php echo $popUp;?>="return pop_up(this, 'Pop Up')">

								<img src="<?php echo (file_exists($student_image) ? $student_image : $no_image); ?>" alt="" style="max-width:143px; max-height:143px" />
							</a>
							</div>
							<div class="media-body">
								<h3 class="media-heading"> <span style="font-size:25px;font-weight:normal"><?php echo strtoupper($data['stud_lname']).", ".strtoupper($data['stud_fname'])." ".strtoupper($data['stud_xname'])." ".strtoupper($data['stud_mname']); ?></h3>
								<h5> <span class="glyphicon glyphicon-barcode"> <span style="font-size:13px;font-weight:normal"><?php echo $data['stud_lrn'];?></h5>
								<h5> <span class="glyphicon glyphicon-plus"> <span style="font-size:13px;font-weight:normal"><?php echo $data['stud_religion'];?></h5>
								<h5> <span class="glyphicon glyphicon-home"> <span style="font-size:13px;font-weight:normal"><?php echo $data['stud_residence'];?></h5>
								<h5> <span class="glyphicon glyphicon-info-sign"> <span style="font-size:13px;font-weight:normal"><?php echo ($data['stud_status']==1?"Active Account":"Account Locked Out"); ?></h5>
								<?php if($data['stud_cct']!="NO"){								
								?>
								<h5> <span class="glyphicon glyphicon-comment"> <span style="font-size:13px;font-weight:normal">CCT Beneficiary: <?php echo $data['stud_cct'];?></h5>
								<?php
								}
								?>
							</div>
							<?php
							$resultRemarks = dbquery("SELECT * FROM studenroll WHERE enrol_stud_no='".$_GET['showProfile']."' ORDER BY enrol_sy DESC");
							$dataRemarks = dbarray($resultRemarks);
							if($dataRemarks['enrol_sy']==$current_sy){
								?>
								<!--
								<div class="<?php echo (strtoupper($dataRemarks['enrol_remarks'])!="OK"?"alert alert-danger":"alert alert-success");?>" role="alert">
								<span class="glyphicon glyphicon-comment"></span> <?php echo $dataRemarks['enrol_remarks'];?> 
								<?php
								if($current_school_code==302887){
								?>
								/ Lacking Requirements:
								<?php 
								if($dataRemarks['enrol_level']<=10){
									echo (strpos($data['stud_credentials'],"jhsEnv")==0?"Envelop, ":"");
									echo (strpos($data['stud_credentials'],"jhsPho")==0?"Photo, ":"");
									echo (strpos($data['stud_credentials'],"jhsNso")==0?"NSO, ":"");
									echo (strpos($data['stud_credentials'],"jhsBir")==0?"Birth Cert, ":"");
									echo (strpos($data['stud_credentials'],"jhsDip")==0?"Diploma, ":"");
									echo (strpos($data['stud_credentials'],"jhsGoo")==0?"Good Moral Character Cert, ":"");
									echo (strpos($data['stud_credentials'],"jhs138")==0?"Form 138, ":"");
									echo (strpos($data['stud_credentials'],"jhs137")==0?"Form 137":"");
								}
								else {
									echo (strpos($data['stud_credentials'],"shsEnv")==0?"Envelop, ":"");
									echo (strpos($data['stud_credentials'],"shsPho")==0?"Photo, ":"");
									echo (strpos($data['stud_credentials'],"shsNso")==0?"NSO, ":"");
									echo (strpos($data['stud_credentials'],"shsBir")==0?"Birth Cert, ":"");
									echo (strpos($data['stud_credentials'],"shsDip")==0?"Diploma, ":"");
									echo (strpos($data['stud_credentials'],"shsGoo")==0?"Good Moral Character Cert, ":"");
									echo (strpos($data['stud_credentials'],"shs138")==0?"Form 138, ":"");
									echo (strpos($data['stud_credentials'],"shs137")==0?"Form 137, ":"");
									echo (strpos($data['stud_credentials'],"shsNca")==0?"NCAE":"");	
								}
								}
								?>
								/
								<?php
									$checkAssessment = dbquery("SELECT * FROM bill_assessment INNER JOIN  bill_bills ON ass_bill_no=bill_no WHERE (ass_sy!='".$current_sy."' AND ass_stud_no='".$_GET['showProfile']."' and ass_invoice_no=0) ORDER BY bill_prio ASC");
									$rowsAssessment = dbrows($checkAssessment);
									?>
								</div>
								-->
								<?php
							}
							else {
							?>
							<!--
							<div class="<?php echo ($dataRemarks['enrol_remarks']!="-"?"alert alert-danger":"alert alert-success");?>" role="alert">
								<span class="glyphicon glyphicon-comment"></span> <?php echo $dataRemarks['enrol_remarks'];?> 
								<?php
								if($current_school_code==302887){
								?>
								/ Lacking Credentials:
								<?php 
								if($dataRemarks['enrol_level']<=10){
									echo (strpos($data['stud_credentials'],"jhsEnv")==0?"Envelop, ":"");
									echo (strpos($data['stud_credentials'],"jhsPho")==0?"Photo, ":"");
									echo (strpos($data['stud_credentials'],"jhsNso")==0?"NSO, ":"");
									echo (strpos($data['stud_credentials'],"jhsBir")==0?"Birth Cert, ":"");
									echo (strpos($data['stud_credentials'],"jhsDip")==0?"Diploma, ":"");
									echo (strpos($data['stud_credentials'],"jhsGoo")==0?"Good Moral Character Cert, ":"");
									echo (strpos($data['stud_credentials'],"jhs138")==0?"Form 138, ":"");
									echo (strpos($data['stud_credentials'],"jhs137")==0?"Form 137":"");
								}
								else {
									echo (strpos($data['stud_credentials'],"shsEnv")==0?"Envelop, ":"");
									echo (strpos($data['stud_credentials'],"shsPho")==0?"Photo, ":"");
									echo (strpos($data['stud_credentials'],"shsNso")==0?"NSO, ":"");
									echo (strpos($data['stud_credentials'],"shsBir")==0?"Birth Cert, ":"");
									echo (strpos($data['stud_credentials'],"shsDip")==0?"Diploma, ":"");
									echo (strpos($data['stud_credentials'],"shsGoo")==0?"Good Moral Character Cert, ":"");
									echo (strpos($data['stud_credentials'],"shs138")==0?"Form 138, ":"");
									echo (strpos($data['stud_credentials'],"shs137")==0?"Form 137, ":"");
									echo (strpos($data['stud_credentials'],"shsNca")==0?"NCAE":"");	
								}
								}
								?>
							</div>
							-->
							<?php } ?>
							<?php
						$checkPrevTLE = dbquery("select * from grade inner join class on grade_class_no=class_no inner join prospectus on class_pros_no=pros_no inner join users on class_user_name=user_no WHERE (grade_stud_no='".$_GET['showProfile']."' and pros_no=18 and grade_sy!='$current_sy')");
						$dataPrevTLE = dbarray($checkPrevTLE);
						$countPrevTLE = dbrows($checkPrevTLE);
						
						$checkAssessment = dbquery("SELECT *, SUM(ass_amount) as total  FROM bill_assessment INNER JOIN  bill_bills ON ass_bill_no=bill_no WHERE (ass_sy!='".$current_sy."' AND ass_stud_no='".$_GET['showProfile']."' and ass_invoice_no=0) ORDER BY bill_prio ASC");
						$dataAssessment = dbarray($checkAssessment);
						if($dataAssessment['total']>0){
						?>
						<div class="alert alert-danger" role="alert">
							<span class="glyphicon glyphicon-comment"> Student has back balances worth P<?php echo number_format($dataAssessment['total'],2);?>. Refer student to the School Registrar.</span>
						</div>
						<?php
						}
						if($countPrevTLE>0 && $dataRemarks['enrol_sy']!=$current_sy){
						?>
						<div class="alert alert-success" role="alert">
							<span class="glyphicon glyphicon-comment"> Grade 9 TLE was under <?php echo $dataPrevTLE['user_fullname'];?></span>
						</div>						
						<?php
						}
						?>
						</div>
						<ul class="nav nav-tabs" id="myTab">
							<li class="<?php echo ($_GET['tab']=="profile"?"active":"");?>"><a href="?page=student&showProfile=<?php echo $_GET['showProfile'];?>&tab=profile" >Student Information</a></li>
							<li class="<?php echo ($_GET['tab']=="history"?"active":"");?>"><a href="?page=student&showProfile=<?php echo $_GET['showProfile'];?>&tab=history" >Enrollment History</a></li>
							<li class="<?php echo ($_GET['tab']=="schedule"?"active":"");?>"><a href="?page=student&showProfile=<?php echo $_GET['showProfile'];?>&tab=schedule" >Class Schedule</a></li>
							<li class="<?php echo ($_GET['tab']=="performance"?"active":"");?>"><a href="?page=student&showProfile=<?php echo $_GET['showProfile'];?>&tab=performance&tab2=grades" >Performance</a></li>
							<li class="<?php echo ($_GET['tab']=="attendance"?"active":"");?>"><a href="?page=student&showProfile=<?php echo $_GET['showProfile'];?>&tab=attendance" >Attendance</a></li>
							<li class="<?php echo ($_GET['tab']=="prospectus"?"active":"");?>"><a href="?page=student&showProfile=<?php echo $_GET['showProfile'];?>&tab=prospectus" >Prospectus</a></li>
							<li class="<?php echo ($_GET['tab']=="anecdotal"?"active":"");?>"><a href="?page=student&showProfile=<?php echo $_GET['showProfile'];?>&tab=anecdotal" >Anecdotal Records</a></li>
						</ul>
					</div>

					<div  class="tabbable"><br>
						<div class="tab-content">
						<?php
						if(isset($_GET['tab']) && $_GET['tab']=="profile"){
							require('studProfileProfile.inc.php');
						}
						else if(isset($_GET['tab']) && $_GET['tab']=="history"){
							require('studProfileHistory.inc.php');
						}
						else if(isset($_GET['tab']) && $_GET['tab']=="schedule"){
							require('studProfileSchedule.inc.php');
						}
						else if(isset($_GET['tab']) && $_GET['tab']=="performance"){
							require('studProfilePerformance.inc.php');
						}
						else if(isset($_GET['tab']) && $_GET['tab']=="attendance"){
							require('studProfileAttendance.inc.php');
						}
						else if(isset($_GET['tab']) && $_GET['tab']=="prospectus"){
							require('studProfileProspectus.inc.php');
						}
						else if(isset($_GET['tab']) && $_GET['tab']=="anecdotal"){
							require('studProfileAnecdotal.inc.php');
						}
						else {
							require('studProfileHistory.inc.php');
						}
						?>
						</div>


					</div>
            </div>
        </div>
    </div>



              </div>
            </div>
          </div>
        </div>
<?php
if(isset($_GET['status']) && $_GET['status']=="successful")	{
?>	
	<script>
		alert('Image was uploaded successfully!');
	</script>		
<?php
} 
else if(isset($_GET['status']) && $_GET['status']=="failed")	{
?>
	<script>
		alert('An error was encountered!');
	</script>	
<?php
}
?>