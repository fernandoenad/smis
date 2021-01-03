<?php // Start the session
if(!isset($_SESSION["user_logged"])){
	header("Location: login.php?prev_url=".$_SERVER['REQUEST_URI']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="The official website of San Agustin National High School - Sagbayan, Bohol">
    <meta name="author" content="Fernando B. Enad">
	<meta name="keywords" content="San Agustin NHS, San Agustin National High School">
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="0" />
	<link rel="icon" href="./assets/images/seal.png">
    <title><?php echo $current_school_short;?> MIS - <?php echo $_SESSION["user_fullname"];?> </title>

                
	
    <!-- Bootstrap -->
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="./assets/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
     
	<!--
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
    -->
	<link rel="stylesheet" href="./assets/css/style.css">
	<link rel="stylesheet" href="./assets/css/signin.css">
	<link href="./assets/css/select2.css" rel="stylesheet">
	<link href="./assets/css/select2-bootstrap.css" rel="stylesheet">
	<link href="./assets/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="./assets/js/html5shiv.min.js"></script>
      <script src="./assets/js/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript" src="./assets/js/jquery.js"></script>

	<script type="text/javascript">
    function Reload() {
			window.location.reload();
    }
	
	function pop_up(hyperlink, window_name)
	{
		if (! window.focus)
			return true;
		var href;
		if (typeof(hyperlink) == 'string')
			href=hyperlink;
		else
			href=hyperlink.href;
		window.open(
			href,
			window_name,
			'width=480,height=300,toolbar=no, scrollbars=yes,200,200'
		);
		return false;
	}
	</script>

	<script type="text/javascript">
    $(document).ready(function(){
      refreshTable();
    });

    function refreshTable(){
        $('#tableHolder').load('index.php #tableHolder', function(){
           setTimeout(refreshTable, 1000);
        });
    }
	</script>
	
	<script type="text/javascript">
	$(document).ready(function(){
	$('#stud_lrn').keyup(username_check1);
	});
		
	function username_check1(){	
	var stud_lrn = $('#stud_lrn').val();
	if(stud_lrn == "" || stud_lrn.length < 12){
	$('#stud_lrn').css('border', '3px #CCC solid');
	$('#tick').hide();
	$("#submit").attr("disabled", "disabled");
	}else{
		$("#submit").removeAttr("disabled");
	jQuery.ajax({
	   type: "POST",
	   url: "check.php",
	   data: 'stud_lrn='+ stud_lrn,
	   cache: false,
	   success: function(response){
			if(response == 1){
				$('#stud_lrn').css('border', '3px #C33 solid');	
				$('#tick').hide();
				$('#cross').fadeIn();
				$("#submit").attr("disabled", "disabled");
				}else{
				$('#stud_lrn').css('border', '3px #090 solid');
				$('#cross').hide();
				$('#tick').fadeIn();
				}
			}
		});
	}
	}
	</script>
	
	

	<script type="text/javascript">
	$(document).ready(function(){
	$('#teach_id').keyup(username_check);
	});
		
	function username_check(){	
	var teach_id = $('#teach_id').val();
	if(teach_id == "" || teach_id.length < 7){
	$('#teach_id').css('border', '3px #CCC solid');
	$('#tick').hide();
	$("#submit").attr("disabled", "disabled");
	}else{
		$("#submit").removeAttr("disabled");
	jQuery.ajax({
	   type: "POST",
	   url: "checkTeacher.php",
	   data: 'teach_id='+ teach_id,
	   cache: false,
	   success: function(response){
			if(response == 1){
				$('#teach_id').css('border', '3px #C33 solid');	
				$('#tick').hide();
				$('#cross').fadeIn();
				$("#submit").attr("disabled", "disabled");
				}else{
				$('#teach_id').css('border', '3px #090 solid');
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
	<!--===========================FreiChat=======START=========================-->
	<!--	For uninstalling ME , first remove/comment all FreiChat related code i.e below code
		 Then remove FreiChat tables frei_session & frei_chat if necessary
			 The best/recommended way is using the module for installation                         -->

	<?php
	$ses=$_SESSION["userid"];

	if(!function_exists("freichatx_get_hash")){
	function freichatx_get_hash($ses){

		   if(is_file("./freichat/hardcode.php")){

				   require "./freichat/hardcode.php";

				   $temp_id =  $ses . $uid;

				   return md5($temp_id);

		   }
		   else
		   {
				   echo "<script>alert('module freichatx says: hardcode.php file not found!');</script>";
		   }

		   return 0;
	}
	}
	if($_SESSION["user_role"]==0){}
	else {
	?>
	
	<script type="text/javascript" language="javascipt" src="./freichat/client/main.php?id=<?php echo $ses;?>&xhash=<?php echo freichatx_get_hash($ses); ?>"></script>
	<link rel="stylesheet" href="./freichat/client/jquery/freichat_themes/freichatcss.php" type="text/css">
	
	<?php
	}
	?>
	<!--===========================FreiChatX=======END=========================--> 

</head>
<body>
    <!--[if lt IE 9]>
        <p class="chromeframe"><span class="glyphicon glyphicon-warning-sign"></span> You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> to better experience this site.</p>
    <![endif]-->
	<div id="wrap">
		<div class="navbar navbar-fixed-top navbar-default hidden-print" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
				    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<span class="navbar-brand">
						<img class="logo" src="./assets/images/sanhs_logo.png" alt="SANHS" style="height: 20px; margin-top: -2px"/>
					</span>
					<span class="navbar-brand"><?php echo $current_school_short;?> MIS</span>
				</div>
				
				<div class="navbar-collapse collapse">
					<div class="nav navbar-nav">
						<ul class="nav navbar-nav">
						<?php
						if($_SESSION["user_role"]==0){
						?>
							<li <?php echo ($_GET['page']=="student"?"class=active":""); ?>><a href="./?page=student&showProfile=<?php echo $_SESSION["userid"];?>">Student</a></li>
						<?php
						}
						else{
						?>
							<li <?php echo ($_GET['page']=="student"?"class=active":""); ?>>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Student <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="./?page=student">Dashboard</a></li>
									<li><a href="./?page=student&createProfile" >New Profile</a></li>
									
									<?php 
									if($earlyregistrationOn==true){
									?>
									<li class="divider"></li>
									<li><a href="./?page=student&earlyRegistration&er_level=all">Early Registration Dashboard</a></li>
									<?php
									}
									?>
								</ul>
							</li>
							<li <?php echo ($_GET['page']=="teacher"?"class=active":""); ?>>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Teacher <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<?php
									if($_SESSION["user_role"]==2){
									?>
									<li><a href="./?page=teacher">Dashboard</a></li>
									<li class="divider"></li>
									<li><a href="./?page=teacher&showProfile=<?php echo $_SESSION['userid'];?>&tab=info">My Profile</a></li>
									<li><a href="./?page=teacher&showDTR=<?php echo $_SESSION['userid'];?>&year=<?php echo date('Y');?>&month=<?php echo date('m');?>">My DTR</a></li>
									<li><a href="./?page=teacher&showSALN=<?php echo $_SESSION['userid'];?>&year=<?php echo $current_sy;?>">My SALN</a></li>
									<!--<li><a href="./?page=teacher&showProperty=<?php echo $_SESSION['userid'];?>&year=<?php echo date("Y");?>">My Property</a></li>-->
									<?php
									}
									else if($_SESSION["user_role"]==1){
									?>
									<li><a href="./?page=teacher">Dashboard</a></li>
									<li><a href="./?page=teacher&createProfile" >New Profile</a></li>
									<li class="divider"></li>
									<li class="dropdown-header">DTR</li>
									<li><a href="./?page=teacher&showDTR=<?php echo $_SESSION['userid'];?>&year=<?php echo date('Y');?>&month=<?php echo date('m');?>">DTR Dashboard</a></li>	
									<li><a href="./?page=teacher&approveDTR&filter=all">Approve Missing Logs</a></li>	
									<li><a href="./?page=teacher&reports=0&year=<?php echo date('Y');?>&month=<?php echo date('m');?>&day=<?php echo date('d');?>">Attendance Reports</a></li>	
									<li><a href="./migratefrommdbtomysql.php" target="_blank">Sync Biometric Logs to MIS</a></li>	
									<li class="divider"></li>	
									<li class="dropdown-header">SALN</li>
									<li><a href="./?page=teacher&showSALN=<?php echo $_SESSION['userid'];?>&year=<?php echo $current_sy;?>">SALN Dashboard</a></li>
									<li><a href="./?page=teacher&manageSALN&year=<?php echo $current_sy;?>">Manage SALN</a></li>
									<!--
									<li class="divider"></li>	
									<li class="dropdown-header">PROPERTY</li>
									<li><a href="./?page=teacher&showProperty=<?php echo $_SESSION['userid'];?>&year=<?php echo date("Y");?>">Property Dashboard</a></li>
									<li><a href="./?page=teacher&manageProperty&year=<?php echo date("Y");?>">Manage Property</a></li>
									-->
									<?php } 
									else{
									?>
									<li><a href="./?page=teacher">Dashboard</a></li>
									<?php
									$checkIfTeacher = dbquery("select * from teacher where teach_no='".$_SESSION['userid']."'");
									$countIfTeacher = dbrows($checkIfTeacher);
									if($countIfTeacher>0){
									?>
									<li><a href="./?page=teacher&showProfile=<?php echo $_SESSION['userid'];?>&tab=info">My Profile</a></li>
									<?php
									}
									?>
									<li class="divider"></li>
									<li><a href="./?page=teacher&showDTR=<?php echo $_SESSION['userid'];?>&year=<?php echo date("Y");?>&month=<?php echo date("m");?>">My DTR</a></li>
									<?php
									}
									?>
									
								</ul>							
							</li>
							<li <?php echo ($_GET['page']=="class"?"class=active":""); ?> <?php echo ($_GET['page']=="load"?"class=active":""); ?>>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Classes <span class="caret"></a>
								<ul class="dropdown-menu" role="menu">
									<?php
									if($_SESSION["user_role"]==2){
										$checkSection = dbquery("SELECT * FROM section WHERE (section_adviser='".$_SESSION['userid']."' AND section_sy='".$current_sy."')");
										$dataSection = dbarray($checkSection);
										$countSection = dbrows($checkSection);
										if($countSection>0){
											?>
											<li class="dropdown-header">Advisory</li>
											<li <?php echo ($_GET['page']=="class"?"class=active":""); ?>><a href="./?page=class&enrol_sy=<?php echo $current_sy;?>&classProfile=<?php echo $dataSection['section_name'];?>&section_no=<?php echo $dataSection['section_no'];?>">My Advisory</a></li>
											<li class="divider"></li>
											<li class="dropdown-header">Subject Loads</li>
											<li <?php echo ($_GET['page']=="load"?"class=active":""); ?>><a href="./?page=load&enrol_sy=<?php echo $current_sy; ?>&teach_no=<?php echo $_SESSION['userid'];?>">My Classes</a></li>
											<li class="divider"></li>
											<li class="dropdown-header">Classes</li>
											<li><a href="./showEnrollmentCurrent.frm.php?enrol_sy=<?php echo $current_sy;?>"  data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">Classes List</a></li>
											<?php
										}
										else{
											?>
											<li class="dropdown-header">Advisory</li>
											<li class="disabled"><a href="">No Advisory Assigned</a></li>
											<li class="divider"></li>
											<li class="dropdown-header">Subject Loads</li>
											<li <?php echo ($_GET['page']=="load"?"class=active":""); ?>><a href="./?page=load&enrol_sy=<?php echo $current_sy; ?>&teach_no=<?php echo $_SESSION['userid'];?>">My Classes</a></li>
											<li class="divider"></li>
											<li class="dropdown-header">Classes</li>
											<li><a href="./showEnrollmentCurrent.frm.php?enrol_sy=<?php echo $current_sy;?>"  data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">Classes List</a></li>
											<?php
										}
									}
									else{
										?>							
										<li><a href="./?page=class&enrol_sy=<?php echo $current_sy; ?>">Dashboard</a></li>		
										<?php
										if($current_school_maxlevel>6){
										?>											
										<li><a href="TLEOfferings.php" title="TLE Offerings" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false">TLE Offerings</a></li>
										
										<?php 
										}
									}
									
									if($_SESSION["user_role"]==1){
										?>
										<li class="divider"></li>
										<li><a href="classNew.frm.php?enrol_sy=<?php echo $current_sy; ?>" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">New Class</a></li>
										<?php
										if($current_school_maxlevel>10){
										?>
										<li><a href="offeringNew.frm.php?enrol_sy=<?php echo $current_sy; ?>" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">New SHS Offering</a></li>
										<?php 
										}
									} 
									?>
								</ul>
							</li>
							<?php
							if($_SESSION["user_role"]==1){
							?>
							<li <?php echo ($_GET['page']=="prospectus"?"class=active":""); ?> <?php echo ($_GET['page']=="offerings"?"class=active":""); ?> <?php echo ($_GET['page']=="schedule"?"class=active":""); ?> <?php echo ($_GET['page']=="loads"?"class=active":""); ?>>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Program <span class="caret"></a>
								<ul class="dropdown-menu" role="menu">
									<li class="dropdown-header">Class Assignment</li>
									<li <?php echo ($_GET['page']=="loads"?"class=active":""); ?>><a href="./?page=loads&enrol_sy=<?php echo $current_sy; ?>&teach_no=<?php echo $_SESSION['userid'];?>">Class Assignment</a></li>
									<li class="divider"></li>
									<li class="dropdown-header">Class Offering</li>
									<?php
									$checkBeginningSection = dbquery("select * from section where section_sy='".$current_sy."' order by section_level asc, section_name asc limit 1");
									$dataBeginningSection = dbarray($checkBeginningSection);
									?>
									<li <?php echo ($_GET['page']=="offerings"?"class=active":""); ?>><a href="./?page=offerings&enrol_sy=<?php echo $current_sy; ?>&classProfile=<?php echo $dataBeginningSection['section_name'];?>&section_no=<?php echo $dataBeginningSection['section_no'];?>">Class Offering</a></li>
									<li class="divider"></li>
									<li class="dropdown-header">Curriculum</li>
									<li <?php echo ($_GET['page']=="prospectus"?"class=active":"");?>><a href="./?page=prospectus&pros_curr=<?php echo $current_pros; ?>&tab=<?php echo ($current_school_minlevel<=6?"view_elem":($current_school_minlevel<=10?"view_jhs":"view_shs"));?>">Curriculum</a></li>
									<li><a href="newCurriculum.frm.php" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">New Curriculum</a></li>									
								</ul>
							</li>
							<?php
							}
							if($_SESSION["user_role"]==0 ){}
							else{
							if(isset($_GET['showProfile']) && isset($_GET['teacher'])){
							?>
							<li <?php echo ($_GET['page']=="financials"?"class=active":""); ?> <?php echo ($_GET['page']=="assessments"?"class=active":""); ?> <?php echo ($_GET['page']=="reports"?"class=active":""); ?> <?php echo ($_GET['page']=="reportsSum"?"class=active":""); ?>><a href="#" class="dropdown-toggle" data-toggle="dropdown">Financials <span class="caret"></a>
									<ul class="dropdown-menu" role="menu">
										<li class="dropdown-header">Transactions</li>
										<li><a href="./?page=student&transact=Yes">New Transaction</a>
										<li class="divider"></li>
										<li class="dropdown-header">Reports</li>
										<li <?php echo ($_GET['page']=="reports"?"class=active":""); ?>><a href="./?page=reports">View Report</a>		
									</ul>
								</li>
							<?php
							}
							elseif (isset($_GET['showProfile'])){
							?>							
								<li <?php echo ($_GET['page']=="financials"?"class=active":""); ?> <?php echo ($_GET['page']=="assessments"?"class=active":""); ?> <?php echo ($_GET['page']=="reports"?"class=active":""); ?> <?php echo ($_GET['page']=="reportsSum"?"class=active":""); ?>><a href="#" class="dropdown-toggle" data-toggle="dropdown">Financials <span class="caret"></a>
									<ul class="dropdown-menu" role="menu">
									<li class="dropdown-header">Transactions</li>
									<li><a href="./?page=student&transact=Yes">New Transaction</a>
									<li <?php echo ($_GET['page']=="financials"?"class=active":""); ?>><a href="./?page=financials&showProfile=<?php echo $_GET['showProfile'];?>&tab=assessments">Current Transaction</a>
									<li class="divider"></li>
									<li class="dropdown-header">Reports</li>
									<li <?php echo ($_GET['page']=="receiptSearch"?"class=active":""); ?>><a href="./?page=receiptSearch">Receipt Search</a>
									<li <?php echo ($_GET['page']=="reports"?"class=active":""); ?>><a href="./?page=reports&enrol_sy=<?php echo $current_sy;?>">View Report</a>

									<?php
									if($_SESSION["user_role"]==1){
									?>
									<li <?php echo ($_GET['page']=="reportsSum"?"class=active":""); ?>><a href="./?page=reportsSum&enrol_sy=<?php echo $current_sy;?>">View Collections</a>	
									<li class="divider"></li>
									<li class="dropdown-header">Assessments</li>
									<li <?php echo ($_GET['page']=="assessments"?"class=active":""); ?>><a href="./?page=assessments">Dashboard</a>
									<?php
									}
									?>
									</ul>
								</li>

							<?php
							}
							else{
							?>
								<li <?php echo ($_GET['page']=="financials"?"class=active":""); ?> <?php echo ($_GET['page']=="assessments"?"class=active":""); ?> <?php echo ($_GET['page']=="reports"?"class=active":""); ?> <?php echo ($_GET['page']=="reportsSum"?"class=active":""); ?>><a href="#" class="dropdown-toggle" data-toggle="dropdown">Financials <span class="caret"></a>
									<ul class="dropdown-menu" role="menu">
										<li class="dropdown-header">Transactions</li>
										<li><a href="./?page=student&transact=Yes">New Transaction</a>
										<li class="divider"></li>
										<li class="dropdown-header">Reports</li>
										<li <?php echo ($_GET['page']=="receiptSearch"?"class=active":""); ?>><a href="./?page=receiptSearch">Receipt Search</a>
										<li <?php echo ($_GET['page']=="reports"?"class=active":""); ?>><a href="./?page=reports&enrol_sy=<?php echo $current_sy;?>">View Report</a>										
										<?php
										if($_SESSION["user_role"]==1){
										?>
										<li <?php echo ($_GET['page']=="reportsSum"?"class=active":""); ?>><a href="./?page=reportsSum&enrol_sy=<?php echo $current_sy;?>">View Collections</a>	
										<li class="divider"></li>
										<li class="dropdown-header">Assessments</li>
										<li <?php echo ($_GET['page']=="assessments"?"class=active":""); ?>><a href="./?page=assessments">Dashboard</a>
										<?php
										}
										?>
									</ul>
								</li>
							<?php
							}
							}
							}
							?>	
								<li <?php echo ($_GET['page']=="support"?"class=active":""); ?>> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Support <span class="caret"></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="./about.frm.php" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">About the Web Application</a></li>
										<!---<li><a href="./assets/manual.pdf" target="_blank">Download the Instructional Manual</a></li>-->

									</ul>
								</li>
						</ul>
					</div>
				
					<ul class="nav navbar-nav navbar-right">
						<?php
						if($_SESSION["user_role"]!=1){
						?>
							<li><a href="#">SY <?php echo $current_sy;?>-<?php echo $current_sy+1 ;?>, <?php echo ($current_sem=="1"?"1<sup>st</sup>":"2<sup>nd</sup>");?> Semester  | </a>  </li>
						
						<?php
						}
						else{
						?>
							<li><a href="settings.frm.php" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">SY <?php echo $current_sy;?>-<?php echo $current_sy+1 ;?>, <?php echo ($current_sem=="1"?"1<sup>st</sup>":"2<sup>nd</sup>");?> Semester  | </a>  </li>
						<?php
						}
						?>
						<li <?php echo ($_GET['page']=="admin"?"class=active":""); ?>>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo strtoupper($_SESSION["user_fullname"]);?> <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="./userTools.frm.php" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">My Account</a></li>
								<?php
								if($_SESSION["user_role"]==3 || $_SESSION["user_role"]==2){}
								else{
								?>
								<!-- <li><a href="../att/admin/?page=user&showDTR=<?php echo $_SESSION["userid"];?>&year=<?php echo date('Y');?>&month=<?php echo date('m');?>">AMS</a></li> -->
								<?php 
								}
								if($_SESSION["user_role"]==1){
								?>
								<li class="divider"></li>
								<li class="dropdown-header">Administrative Tools</li>
								<li><a href="./?page=settings">Site Settings</a></li>
								<li><a href="./?page=admin">User Administration</a></li>
								<li><a href="./?page=sf7header&enrol_sy=<?php echo $current_sy; ?>">SF 7 Header Data</a></li>
								<li><a href="./?page=sectioning">Class Sectioning</a></li>
								<li><a href="./?page=dropdowns&category=TIMELSLOTS">Dropdown Configuration</a></li>	
								<li class="divider"></li>
								<li class="dropdown-header">Updates</li>
								<li><a href="./?page=settingsfi">Version Updates</a></li>
								<li><a href="./?page=settingsdb">Database Updates</a></li>	
								<li class="divider"></li>								
								<li class="dropdown-header">Backup & Restore</li>
								<li><a href="backupdb.frm.php" title="Backup Database" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">Backup Database</a></li>
								<li><a href="../phpmyadmin/index.php?lang=en&server=1&pma_username=root&pma_password=03231979&db=sanhsmis" target="_blank" title="Restore Backup">Restore Backup</a></li>
								<!-- <li><a href="?page=restoredb" title="Restore Backup">Restore Backup</a></li>-->
										
								<?php } ?>
								<?php 
								if($_SESSION["user_role"]==3){
								?>
								<li><a href="./?page=sectioning">Sectioning</a></li>
								
								<li <?php echo ($_GET['page']=="offerings"?"class=active":""); ?>><a href="./?page=offerings&enrol_sy=<?php echo $current_sy; ?>&classProfile=AMETHYST">Class Offering</a></li>
								<?php } ?>
							</ul>
						</li>
						<li><a href="logout.php?username=<?php echo $_SESSION["user_name"];?>" onClick="return confirm('Are you sure you want to logout?');">Sign out <span class="glyphicon glyphicon-log-out"></span></a></li>
					</ul>
				</div>
			</div>
		</div><br><br>

		
