<?php
// Start the session
session_start();
require ('maincore.php');		

if($_SESSION["user_pass"]=="P@ssw0rd"){
	header("Location: login2.php");
}
	
if(!isset($_SESSION["sanhsMIS_logged"])){
	$prev_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	header("Location: login.php?prev_url=".$prev_url);
}
else if(isset($_SESSION["sanhsMIS_logged"]) && $_SESSION["sanhsMIS_logged"]!=TRUE){
	$prev_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	header("Location: login.php?prev_url=".$prev_url);
}
else {
	$password = substr(md5($_SESSION["user_pass"]),0,50);
	$checkUser = dbquery("select * from users where (user_name='".$_SESSION["user_name"]."' AND user_pass='".$password."' AND user_status='1')");
	$rowLoginCheckUser= dbrows($checkUser);
	$checkStudent= dbquery("SELECT * FROM student WHERE (stud_lrn='".$_SESSION["user_name"]."' AND stud_password='".$password."' AND stud_status=1)");
	$rowLoginCheckStudent= dbrows($checkStudent);
	if ($rowLoginCheckUser > 0){}
	else if ($rowLoginCheckStudent > 0){}
	else {
		header("Location: login.php?prev_url=".urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"));
	}
	
}




if(isset($_SESSION["user_role"]) && $_SESSION["user_role"]==0 && $_SESSION["userid"]!=$_GET['showProfile']){
	header("Location: ./?page=student&showProfile=".$_SESSION['userid']."&tab=history");
}

/*
if(isset($_SESSION["user_role"]) && $_SESSION["user_role"]==2 && $_SESSION["userid"]!=$_GET['showProfile']){
	header("Location: ./?page=teacher&showProfile=".$_SESSION['userid']);
}
*/


if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time();

if(!isset($_GET['page'])){
	header("Location: ./?page=class&enrol_sy=$current_sy");
}
	

require ('header.inc.php');

	if(isset($_GET['page'])){
		if($_GET['page']=="student"){
			if(isset($_GET['showProfile'])){
				require('studentProfile.inc.php');
			}
			elseif(isset($_GET['createProfile'])){
				require('studentNew.inc.php');
			}
			elseif(isset($_GET['updateProfile'])){
				require('studentUpdate.inc.php');
			}
			elseif(isset($_GET['searchProfile'])){
				require('studentUpdate.inc.php');
			}
			elseif(isset($_GET['earlyRegistration'])){
				require('earlyRegistrationDashboard.inc.php');
			}
			else{
				require('studentDashboard.inc.php');
			}
		}
		if($_GET['page']=="teacher"){
			if(isset($_GET['showProfile'])){
				require('teacherProfile.inc.php');
			}
			elseif(isset($_GET['createProfile'])){
				require('teacherNew.inc.php');
			}
			elseif(isset($_GET['updateProfile'])){
				require('teacherUpdate.inc.php');
			}
			elseif(isset($_GET['searchProfile'])){
				require('teacherUpdate.inc.php');
			}
			elseif(isset($_GET['showDTR'])){
				require('teacherDTR.inc.php');
			}
			elseif(isset($_GET['approveDTR'])){
				require('teacherDTRApprove.inc.php');
			}
			elseif(isset($_GET['reports'])){
				require('teacherDTRreport.inc.php');
			}
			elseif(isset($_GET['realtime'])){
				require('teacherDTRreport.inc.php');
			}
			elseif(isset($_GET['showSALN'])){
				require('teacherSALN.inc.php');
			}
			elseif(isset($_GET['editSALN'])){
				require('teacherSALNedit.inc.php');
			}
			elseif(isset($_GET['manageSALN'])){
				require('teacherSALNmanage.inc.php');
			}
			elseif(isset($_GET['showProperty'])){
				require('teacherProperty.inc.php');
			}
			elseif(isset($_GET['manageProperty'])){
				require('teacherPropertymanage.inc.php');
			}
			else{
				require('teacherDashboard.inc.php');
			}
		}		
		elseif($_GET['page']=="class"){
			if(isset($_GET['classProfile'])){
				require('classProfile.inc.php');
			}
			else{
				require('classDashboard.inc.php');
			}
		}
		elseif($_GET['page']=="schedule"){
			require('classSchedule.inc.php');
		}
		elseif($_GET['page']=="admin"){
			require('admin.inc.php');
		} 		
		elseif($_GET['page']=="settings"){
			require('config.inc.php');
		} 	
		elseif($_GET['page']=="sectioning"){
			require('sectioningDashboard.inc.php');
		}
		elseif($_GET['page']=="sectioning2"){
			require('sectioningDashboard2.inc.php');
		}
		elseif($_GET['page']=="prospectus"){
			require('prospectusDashboard.inc.php');
		} 
		elseif($_GET['page']=="offerings"){
			require('classSchedule.inc.php');
		} 		
		elseif($_GET['page']=="loads"){
			require('teacherLoad.inc.php');
		} 	
		elseif($_GET['page']=="load"){
			require('teacherLoad.inc.php');
		} 		
		elseif($_GET['page']=="financials"){
			require('financialsDashboard.inc.php');
		} 	
		elseif($_GET['page']=="reports"){
			require('reportFinancialDashboard.inc.php');
		} 
		elseif($_GET['page']=="reportsSum"){
			require('reportFinancialDashboard2.inc.php');
		} 
		elseif($_GET['page']=="assessments"){
			require('assessmentsDashboard.inc.php');
		} 
		elseif($_GET['page']=="receiptSearch"){
			require('receiptDashboard.inc.php');
		} 
		elseif($_GET['page']=="dropdowns"){
			require('dropdownsDashboard.inc.php');
		} 
		elseif($_GET['page']=="settingsfi"){
			require('settingsfi.inc.php');
		} 	
		elseif($_GET['page']=="settingsdb"){
			require('settingsdb.inc.php');
		} 	
		elseif($_GET['page']=="settingsia"){
			require('settingsia.inc.php');
		} 
		elseif($_GET['page']=="restoredb"){
			require('restoredb.inc.php');
		} 
		elseif($_GET['page']=="sf7header"){
			require('sf7header.inc.php');
		} 
	}

require ('footer.inc.php');
/***
if(isset($_GET['ua']) && $_GET['ua']=="Yes"){
		$lockstudent = dbquery("update student set stud_status='0' where stud_no='".$_SESSION["userid"]."'");
		?>
		<script>
			alert("Account was lockedout due to the hacking attempt.");
		</script>
		<?php
		// remove all session variables
		session_unset(); 
		// destroy the session 
		session_destroy(); 

		setcookie("freichat_user", "LOGGED_IN", time()-3600, "/"); 
}
***/
?>
<script>
    $(document).ready(function({
    var url = "costam#active"
     var url2 = url.split('#')[1];

     var script = '#myTab a[href="#'+url2+'"]';

     $(script).tab('show');
    }));
</script>



