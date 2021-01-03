<?php
require('maincore.php');
$resultStudent = dbquery("SELECT * FROM student INNER JOIN studenroll ON student.stud_no=studenroll.enrol_stud_no WHERE (enrol_sy='".$current_sy."' AND stud_no='".$_GET['stud_no']."')");
$dataStudent = dbarray($resultStudent );
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<style>
	table {
	
	}
	
	th{
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.6em;
	} 
	
	td {
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.5em;		
	}
	</style>
</head>	
<table border="1" border="260">
<tr><td>
<table width="250" border="0" align="center">
	<tr>
		<td>
			<table>
				<tr>
					<td><img src="./assets/images/sanhs_logo.png" width="30"></td>
					<td><strong>San Agustin National High School</strong><br>San Agustin, Sagbayan, Bohol</td>
				</tr>
			</table>	
		</td>
	</tr>
	<tr>
		<td align="center">
			<h1>Student ID Request</h1>
			<img src="./assets/images/students/<?php echo $dataStudent['stud_no'].".jpg"; ?>" width="100"><br><br>
			<h2><u><?php echo strtoupper($dataStudent['stud_lname']).", ".strtoupper($dataStudent['stud_fname'])." ".strtoupper($dataStudent['stud_xname'])." ".strtoupper($dataStudent['stud_mname']);?></u></h2>
			<h3><?php echo $dataStudent['enrol_level']." - ".$dataStudent['enrol_section'];?></h3><br>
			<strong><?php echo $current_principal;?></strong><br>School Principal
		</td>
	</tr>
<table><br><br>
</td>
</tr>
</table>		