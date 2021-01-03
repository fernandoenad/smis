<?php
// Start the session
session_start();

require ('maincore.php');

if(isset($_POST['submit'])){
	$password= substr(md5($_POST['password2']),0,50);
	if($_SESSION["user_role"]==0){
		$resultChangefullname = dbquery("UPDATE student SET stud_password='".$password."' WHERE stud_lrn='".$_SESSION["user_name"]."'");
		//$_SESSION["user_fullname"] = $_POST['user_fullname'];
		$_SESSION["user_pass"] = $_POST['password2'];
		header("Location: ./?page=student&showProfile=".$_SESSION['userid']."&tab=history");
	}
	else{
		$resultChangefullname = dbquery("UPDATE users SET user_pass='".$password."' WHERE user_name='".$_SESSION["user_name"]."'");
		// $_SESSION["user_fullname"] = $_POST['user_fullname'];
		$_SESSION["user_pass"] = $_POST['password2'];
		if ($_SESSION["user_role"]==1)
			header("Location: ./");
		else
			header("Location: ./?page=teacher&teacher=yes&showProfile=".$_SESSION['userid']."&tab=info");
	}
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
    <title><?php echo $current_school_short;?> MIS - Change Password (First Use) </title>
	
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
	<script type="text/javascript">
	$(document).ready(function(){
	$('#password2').keyup(userPword_match);
	});
	
	function userPword_match(){	
	var user_pass1 = $('#password1').val();
	var user_pass2 = $('#password2').val();
	if(user_pass2 != user_pass1){
		$('#password2').css('border', '3px #F00 solid');
		$("#submit").attr("disabled", "disabled");
	}else{
		$('#password2').css('border', '3px #090 solid');
		$("#submit").removeAttr("disabled");
	}
	}		
	</script>
  <style>
		#tick1{display:none}
		#cross1{display:none}
	</style>
	
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
								<center><h3>Welcome, </h3><h4><b><?php echo $_SESSION["user_fullname"];?></h4></b></center>
								<center>Please change your password to continue...</center>
								<form class="form-signin" action="login2.php" method="post">
									<input type="password" id="password1" name="password1" maxlength="50" class="form-control" placeholder="New Password" value="" required autofocus>
									<input type="password" id="password2" name="password2" maxlength="50" class="form-control" placeholder="Confirm Password" value="" required>
									<input type="submit" id="submit" name="submit" disabled class="btn btn-lg btn-default btn-block" value="Change Password" onclick="return confirm('Are you sure you want to save the inputted values?')"" />
									
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

		


  </body>
</html>

