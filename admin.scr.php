<?php
require('maincore.php');

if(isset($_GET['DeleteUser']) && $_GET['DeleteUser']=="Yes"){
	$result1 = dbquery("DELETE FROM users WHERE user_no='".$_GET['user_name']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['NewUser']) && $_GET['NewUser']=="Yes"){
	$selectTeacher = dbquery("SELECT * FROM teacher WHERE teach_no='".$_POST['user_fullname']."'");
	$rowTeacher = dbarray($selectTeacher);
	$fullname = strtoupper($rowTeacher['teach_fname']." ".($rowTeacher['teach_mname']=="-"?"":substr($rowTeacher['teach_mname'],0,1).".")." ".$rowTeacher['teach_lname'].($rowTeacher['teach_xname']!=""?", ".$rowTeacher['teach_xname']:""));
	$username = $rowTeacher['teach_fname'].".".$rowTeacher['teach_lname'];
	$username = strtolower(str_replace(" ","",$username));
	$selectCheckTeacher = dbquery("SELECT * FROM users WHERE user_name='".$username."'");
	$countCheckTeacher = dbrows($selectCheckTeacher);
	if($countCheckTeacher>0){
		$username = $username.rand();
	}
	$password = substr(md5("P@ssw0rd"),0,50);
	$result1 = dbquery("INSERT INTO users (user_no, user_name, user_pass, user_fullname, user_role, user_status) VALUES ('".$rowTeacher['teach_no']."','".$username."','".$password."','".$fullname."','".$_POST['user_role']."','1')");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['NewUser1']) && $_GET['NewUser1']=="Yes"){
	$selectTeacher = dbquery("SELECT * FROM teacher WHERE teach_no='".$_GET['teach_no']."'");
	$rowTeacher = dbarray($selectTeacher);
	$fullname = strtoupper($rowTeacher['teach_fname']." ".($rowTeacher['teach_mname']=="-"?"":substr($rowTeacher['teach_mname'],0,1).".")." ".$rowTeacher['teach_lname'].($rowTeacher['teach_xname']!=""?", ".$rowTeacher['teach_xname']:""));
	$username = $rowTeacher['teach_fname'].".".$rowTeacher['teach_lname'];
	$username = strtolower(str_replace(" ","",$username));
	$username =  mb_strtolower($username, 'UTF-8');	
	$selectCheckTeacher = dbquery("SELECT * FROM users WHERE user_name='".$username."'");
	$countCheckTeacher = dbrows($selectCheckTeacher);
	if($countCheckTeacher>0){
		$username = $username.rand();
	}
	$password = substr(md5("P@ssw0rd"),0,50);
	$result1 = dbquery("INSERT INTO users (user_no, user_name, user_pass, user_fullname, user_role, user_status) VALUES ('".$rowTeacher['teach_no']."','".$username."','".$password."','".$fullname."','2','1')");	
	header("Location: ./?page=teacher&showProfile=".$_GET['teach_no']."&tab=info");
}

if(isset($_GET['NewUserStudent']) && $_GET['NewUserStudent']=="Yes"){
	$selectTeacher = dbquery("SELECT * FROM student WHERE stud_no='".$_POST['user_fullname']."'");
	$rowTeacher = dbarray($selectTeacher);
	$fullname = strtoupper($rowTeacher['stud_fname']." ".($rowTeacher['stud_mname']=="-"?"":substr($rowTeacher['stud_mname'],0,1).".")." ".$rowTeacher['stud_lname'].($rowTeacher['stud_xname']!=""?", ".$rowTeacher['stud_xname']:""));
	$username = $rowTeacher['stud_fname'].".".$rowTeacher['stud_lname'];
	$username = strtolower(str_replace(" ","",$username));
	$selectCheckTeacher = dbquery("SELECT * FROM users WHERE user_name='".$username."'");
	$countCheckTeacher = dbrows($selectCheckTeacher);
	if($countCheckTeacher>0){
		$username = $username.rand();
	}
	$password = substr(md5("P@ssw0rd"),0,50);
	$result1 = dbquery("INSERT INTO users (user_no, user_name, user_pass, user_fullname, user_role, user_status) VALUES ('".$rowTeacher['stud_no']."','".$username."','".$password."','".$fullname."','".$_POST['user_role']."','1')");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['UpdateUser']) && $_GET['UpdateUser']=="Yes"){
	$result1 = dbquery("UPDATE users SET user_name='".$_POST['user_name']."', user_role='".$_POST['user_role']."' WHERE user_no='".$_POST['user_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>