<?php

// Credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sanhsmis";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    header("Location: ../?response=-1");
	//die("Connection failed: " . $conn->connect_error);
}

// MySQL database functions
function dbquery($query) {
	global $conn;
	$result = $conn->query($query);
	
	return $result;	
}

function dbarray($rs) {
	$result = (empty($rs) ? null : $rs->fetch_assoc());
	
	return $result;
}

function dbrows($rs) {
	$result = (empty($rs) ? 0 : $rs->num_rows);
	
	return $result;
}


// Site Global Settings
$selectGlobalSettings = dbquery("SELECT * FROM settings WHERE activated='1'");
$rowGlobalSettings = dbarray($selectGlobalSettings);
$current_sy = $rowGlobalSettings['settings_sy'];
$current_sem = $rowGlobalSettings['settings_sem'];
$current_pros = $rowGlobalSettings['settings_pros'];
$current_registrar = $rowGlobalSettings['settings_registrar'];
$current_principal = $rowGlobalSettings['settings_principal'];
$current_psds = $rowGlobalSettings['settings_supervisor'];
$current_representative = $rowGlobalSettings['settings_representative'];
$current_superintendent = $rowGlobalSettings['settings_superintendent'];
$current_bosy = $rowGlobalSettings['settings_bosy'];
$current_eosy = $rowGlobalSettings['settings_eosy'];
$current_closing = $rowGlobalSettings['settings_closing'];
$current_user = (isset($_SESSION["user_fullname"]) ? $_SESSION["user_fullname"]: "");
$current_month = $rowGlobalSettings['settings_month'];
$eoyupdate = $rowGlobalSettings['settings_eosynow'];
$earlyregistrationOn = $rowGlobalSettings['settings_earlyreg'];
$current_dow = (date("m")==1?date("Y")."-01-31":$current_bosy);

$login_message = $rowGlobalSettings['settings_loginmessage'];
$admission_message = $rowGlobalSettings['settings_admissionmessage'];
$lockdownEncoderStudAccess = false;

$check_settings = dbquery("select * from license limit 1");
$data_settings = dbarray($check_settings);
$current_school_name= $data_settings['current_school_name'];
$current_school_full = $data_settings['current_school_full'];
$current_school_short = $data_settings['current_school_short'];
$current_school_code = $data_settings['current_school_code'];
$current_school_address = $data_settings['current_school_address'];
$current_school_district = $data_settings['current_school_district'];
$current_school_division = $data_settings['current_school_division'];
$current_school_region = $data_settings['current_school_region'];
$current_school_reg_code = $data_settings['current_school_reg_code'];
$current_school_contact = $data_settings['current_school_contact'];
$current_school_email = $data_settings['current_school_email'];
$current_school_minlevel = $data_settings['current_school_minlevel'];
$current_school_maxlevel = $data_settings['current_school_maxlevel'];
$current_footer = "Copyright &copy 2016. <a href=''>".$current_school_short." Management Information System</a>. All  rights reserved.";
$current_footer_www = "Copyright &copy 2017. <a href=''>".$current_school_short." Portal</a>. All  rights reserved.";
$current_footer_ams = "Copyright &copy 2017. <a href=''>".$current_school_short." Attendance Management System</a>. All  rights reserved.";






?>
