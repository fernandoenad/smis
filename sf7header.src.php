<?php
// Start the session
session_start();
require('maincore.php');

if(isset($_GET['DeleteAnec']) && $_GET['DeleteAnec']=="Yes"){
	$result0 = dbquery("delete FROM iis_menu WHERE (iis_menu_no='".$_GET['anec_no']."')");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
if(isset($_GET['LCDeleteAnec']) && $_GET['LCDeleteAnec']=="Yes"){
	$result0 = dbquery("delete FROM iis_page WHERE (iis_page_no='".$_GET['anec_no']."')");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

if(isset($_GET['NewAnec']) && $_GET['NewAnec']=="Yes"){
	$result1 = dbquery("INSERT INTO iis_menu (iis_menu_no, iis_menuname, iis_menuparent_menu_no	, iis_menusort) VALUES ('','".$_POST['anec_position']."','".$_POST['anec_dep']."','".$_POST['anec_funding']."')");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
	
}

if(isset($_GET['LCNewAnec']) && $_GET['LCNewAnec']=="Yes"){
	$result1 = dbquery("INSERT INTO iis_page (iis_page_no, iis_pagetitle, iis_pagecontent, iis_page_menu_no, iis_page_user_no, iis_pagepublishdate) VALUES ('','appoint_".$_POST['anec_designation']."','".$_POST['anec_appointment']."','".$_POST['anec_fundsource']."','".$_POST['anec_count']."',NOW())");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
	
}

if(isset($_GET['UpdateAnec']) && $_GET['UpdateAnec']=="Yes"){
	$result1 = dbquery("UPDATE iis_menu SET iis_menuparent_menu_no='".$_POST['anec_dep']."', iis_menuname='".$_POST['anec_position']."', iis_menusort='".$_POST['anec_funding']."' WHERE iis_menu_no='".$_POST['anec_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}


?>