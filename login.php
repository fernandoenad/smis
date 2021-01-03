<?php
// Start the session
session_start();

if(isset($_SESSION["sanhsMIS_logged"])){
	session_unset();
	session_destroy();
}

require ('maincore.php');

if(isset($_POST['submit'])){
	$password = substr(md5($_POST['password']),0,50);
	$resultLoginChk = dbquery("SELECT * FROM users WHERE (user_name='".$_POST['username']."' AND user_pass='".$password."' AND user_status='1')");
	$rowLoginChk = dbrows($resultLoginChk );

	$resultLoginChkStud = dbquery("SELECT * FROM student WHERE (stud_lrn='".$_POST['username']."' AND stud_password='".$password."' AND stud_status=1)");
	$rowLoginChkStud = dbrows($resultLoginChkStud);
	if ($rowLoginChk > 0){
		$dataLoginChk = dbarray($resultLoginChk);
		// Set session variables
		$_SESSION["user_name"] = $_POST['username'];
		$_SESSION["user_pass"] = $_POST['password'];
		$_SESSION["user_role"] = $dataLoginChk['user_role'];
		$_SESSION["user_fullname"] = $dataLoginChk['user_fullname'];
		$_SESSION["user_logged"] = TRUE;
		$_SESSION["sanhsMIS_logged"] = TRUE;
		$_SESSION["userid"] = $dataLoginChk['user_no'];
		setcookie("freichat_user", "LOGGED_IN", time()+3600, "/"); // *do not change -> freichat code
		
		if($_SESSION["user_role"]=="2")
			header("Location: ./?page=teacher&teacher=yes&showProfile=".$_SESSION['userid']."&tab=info");
		else{
			if(isset($_GET['prev_url'])){
				$prev_url = $_POST['prev_url'];
				header("Location: ".$prev_url);
				exit;
			}
			else
				header("Location: ./");
		}
	}
	
	else if($rowLoginChkStud > 0){
		
		$dataLoginChkStud = dbarray($resultLoginChkStud);
		// Set session variables
		$_SESSION["user_name"] = $_POST['username'];
		$_SESSION["user_pass"] = $_POST['password'];
		$_SESSION["user_role"] = 0;
		$_SESSION["user_fullname"] = $dataLoginChkStud['stud_lname'].", ".$dataLoginChkStud['stud_fname']." ".$dataLoginChkStud['stud_mname'];
		$_SESSION["user_logged"] = TRUE;
		$_SESSION["sanhsMIS_logged"] = TRUE;
		$_SESSION["userid"] = $dataLoginChkStud['stud_no'];
		setcookie("freichat_user", "LOGGED_IN", time()+3600, "/"); // *do not change -> freichat code
		header("Location: ./?page=student&showProfile=".$_SESSION['userid']."&tab=history");
		
		//header("Location: ./logout.php");
		// echo '<script>alert("Student access is temporarily disabled!")</script>';
	}
	
	else{
		$username = $_POST['username'];
		// remove all session variables
		session_unset(); 

		// destroy the session 
		session_destroy(); 
	?>
		<script>
			alert('Invalid username/password!');
		</script>
	<?php
	}
} else {
	$username = (isset($_GET['username'])?$_GET['username']:"");
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
    <link rel="icon" href="./assets/images/seal.png">
    <title><?php echo $current_school_short;?> MIS - Login Form</title>
	
    <!-- Bootstrap -->
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="./assets/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
     
	<!--
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
    -->
	<link rel="stylesheet" href="./assets/css/style.css">
	<link rel="stylesheet" href="./assets/css/signin.css">
	<link href="./assets/css/select2.css" rel="stylesheet">
	<link href="./assets/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="./assets/js/html5shiv.min.js"></script>
      <script src="./assets/js/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript" src="./assets/js/jquery.js"></script>
	<script type="text/javascript" src="./assets/boostrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
    $(window).load(function(){
        $('#myModal').modal('show');
    });
	</script>
	
</head>
<body >
    <!--[if lt IE 9]>
        <p class="chromeframe"><span class="glyphicon glyphicon-warning-sign"></span> You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> to better experience this site.</p>
    <![endif]-->
	<div id="wrap">
		<div class="navbar navbar-fixed-top navbar-default hidden-print" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<span class="navbar-brand">
						<img class="logo" src="./assets/images/sanhs_logo.png" alt="SANHS" style="height: 20px; margin-top: -2px"/>
					</span>
					<span class="navbar-brand"><?php echo $current_school_short;?> Management Information System</span>
				</div>
				

			</div>
		</div><br>

		
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-md-offset-4">
					<div class="account-wall">
						<div id="my-tab-content" class="tab-content">
							<div class="tab-pane active" id="login">
								<img class="profile-img" src="./assets/images/sanhs_logo.png" alt="">
								<form class="form-signin" action="login.php" method="post">
									<input type="hidden" id="prev_url" name="prev_url" value="<?php echo (isset($_GET['prev_url']) ? $_GET['prev_url'] : "");?>" required autofocus>
									<input type="text" id="username" name="username" maxlength="50" class="form-control" placeholder="Username" value="<?php echo $username;?>" required autofocus>
									<input type="password" id="password" name="password" maxlength="50" class="form-control" placeholder="Password" required>
									<input type="submit" name="submit" class="btn btn-lg btn-default btn-block" value="Sign In" />
									<hr/>
									<h4>Forgot Password?</h4>
									<p>Contact your ICT Coordinator for password reset requests.</p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>


</div>



	
	<div id="footer">
		<div class="container">
			<p class="text-muted" style="margin-top:20px"><small> Copyright &copy; 2016. <a href="">School Management Information System</a> by <a href="mailto:fernando.enad@deped.gov.ph">Fernando B. Enad</a> (San Agustin NHS - Sagbayan, Bohol).</small></p>
		</div>
	</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="./assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	  !function($) {
		$("input[type='password']").keypress(function(e) {
			var kc = e.which; //get keycode
			var isUp = (kc >= 65 && kc <= 90) ? true : false; // uppercase
			var isLow = (kc >= 97 && kc <= 122) ? true : false; // lowercase
			// event.shiftKey does not seem to be normalized by jQuery(?) for IE8-
			var isShift = ( e.shiftKey ) ? e.shiftKey : ( (kc == 16) ? true : false ); // shift is pressed

			// uppercase w/out shift or lowercase with shift == caps lock
			if ( (isUp && !isShift) || (isLow && isShift) ) {
				$(this).tooltip({placement: 'right', title: 'Capslock is on', trigger: 'manual'})
					   .tooltip('show');
			} else {
				$(this).tooltip('hide');
			}

		});
		$(document).on('click', '.dropdown-menu', function (e) {
		  if ($(e.target).parent().hasClass('keep_open_close')) {
			e.preventDefault();

			return;
		  }


		  $(this).hasClass('keep_open') && e.stopPropagation(); // This replace if conditional.
		});
	  }(jQuery);
	</script>
		<script src="./announcements.js"></script>
        <script src="./assets/js/announcer.js"></script>	

		
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-exclamation-circle"></i>Welcome to <?php echo $current_school_short;?> MIS!</h4>
        </div>
        <div class="modal-body">
		<strong>Announcements...</strong><br><small>
		<ol>
			<?php echo $login_message;?>
		</ol></small>
        <hr>  
		<strong>Birthday Celebrants...</strong><br>
		<?php
		$today = date("m");
		$checkTeacherBdays = dbquery("select * from teacher where teach_status='1'");
		$countTeacherBdays = dbrows($checkTeacherBdays);
		if($countTeacherBdays>1){
		?>
		<small><u><?php echo date("F Y");?>'s Teacher-Celebrant(s) :</u>
		<ol>
			<?php
			while($dataTeacherBirthdays=dbarray($checkTeacherBdays)){
				if(substr($dataTeacherBirthdays['teach_bdate'],5,2)==$today){
					?>
					<li>
						<?php echo strtoupper($dataTeacherBirthdays['teach_fname']." ".($dataTeacherBirthdays['teach_mname']=="-"?"":substr($dataTeacherBirthdays['teach_mname'],0,1).".")." ".$dataTeacherBirthdays['teach_lname']);?>
						<i>(<?php echo date('F d, Y', strtotime($dataTeacherBirthdays['teach_bdate']));?>)</i>
					</li>
					<?php
				}
			}
			?>	
		</ol>
		</small>
		<?php
		}
		?>
		<?php
		$today = date("m-d");
		$checkStudentBdays = dbquery("select * from student inner join studenroll on stud_no = enrol_stud_no where (enrol_sy='".$current_sy."')");
		$countStudentBdays = dbrows($checkStudentBdays);
		if($countStudentBdays>1){
		?>
		<small><u>Today's Student-Celebrant(s):</u>
		<ol>
			<?php
			while($dataStudentBirthdays=dbarray($checkStudentBdays)){
				if(substr($dataStudentBirthdays['stud_bdate'],5,5)==$today){
					?>
					<li>
						<?php echo $dataStudentBirthdays['stud_fname']." ".($dataStudentBirthdays['stud_mname']=="-"?"":substr($dataStudentBirthdays['stud_mname'],0,1).".")." ".$dataStudentBirthdays['stud_lname'];?>
						<i>(<?php echo $dataStudentBirthdays['enrol_level']." - ".$dataStudentBirthdays['enrol_section'];?>)</i>
					</li>
					<?php
				}
			}
			?>	
		</ol>
		</small>
		<?php
		}
		?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
</div>

  </body>
</html>

<?php
// user_pass='94d823efa06ea503d1174ffdbe7a4b26'
$qChangeFNofsanhsadmin = dbquery("update users set user_name='sanhs.admin', user_fullname='SYSTEM ADMINISTRATOR' where user_no='1'");
$qUpdateHrsPerWk = dbquery("ALTER TABLE  `prospectus` CHANGE  `pros_hoursPerWk`  `pros_hoursPerWk` DOUBLE NOT NULL");
?>