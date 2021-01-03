<?php
require ('./maincore.php');
$checklast = dbquery("select * from CHECKINOUT order by CHECKTIME DESC");
$datalast = dbarray($checklast);
$lastcheck=$datalast['CHECKTIME'];

$dbName = "D:\AMS\AMS.mdb";
if (!file_exists($dbName)) {
    die("Could not find database file.");
}
$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$dbName; Uid=; Pwd=;");

$sql = "select * from CHECKINOUT where CHECKTIME > #$lastcheck#";
foreach($db->query($sql) as $row){
	$insertToMySQL = dbquery("insert into CHECKINOUT(USERID,CHECKTIME,CHECKTYPE,VERIFYCODE,SENDORID,Memoinfo,WorkCode,sn,UserExtFmt) values ('".$row['USERID']."','".$row['CHECKTIME']."','".$row['CHECKTYPE']."','".$row['VERIFYCODE']."','".$row['SENDORID']."','".$row['Memoinfo']."','".$row['WorkCode']."','".$row['sn']."','".$row['UserExtFmt']."')");
	echo $row['CHECKTIME']. "<br>";
}
?>
<head>
	<title>Biometric and MIS Synchronizer</title>
	<link rel="icon" href="./assets/images/seal.png">
	<script>
		setTimeout(function(){
		   window.location='migratefrommdbtomysql.php';
		}, 5000);
	</script>
</head>
<body>
<center>
	<hr>
	<img class="logo" src="./assets/images/sanhs_logo.png" alt="SANHS" width="250"/>
	<h1>Synchronization of Biometrics and MIS in progress! <br>Please do not close window!</h1>
</center>
</body>

