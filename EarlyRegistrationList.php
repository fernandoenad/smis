<?php
session_start();	 
require('maincore.php');
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<style>
	.borderdraw {
		position:fixed;
		border-style:solid;
		height:0;
		line-height:0;
		width:0;
		z-index:-1;
	}

	.tag1{ z-index:9999;position:absolute;top:40px; }
	.tag2 { z-index:9999;position:absolute;left:40px; }
	.diag { position: relative; width: 50px; height: 50px; }
	.outerdivslant { position: absolute; top: 0px; left: 0px; border-color: transparent transparent transparent rgb(64, 0, 0); border-width: 50px 0px 0px 60px;}
	.innerdivslant {position: absolute; top: 1px; left: 0px; border-color: transparent transparent transparent #fff; border-width: 49px 0px 0px 59px;}                  

	table {
	
	}
	
	th{
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.7em;
	} 
	
	td {
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.6em;		
	}
	</style>	
</head>

<table border="0" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<td align="center"><b>DEPARTMENT OF EDUCATION</b></td>
	</tr>
	<tr>
		<td align="center"><b>EARLY REGISTRATION FORM</b></td>
	</tr>
	<tr>
		<td align="right">FORM 1</td>
	</tr>
</table>
<br>
<table border="0" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<td width="8%">School ID:</td>
		<td width="62%"><b><u><?php echo $current_school_code;?></b></u></td>
		<td width="8%">Region:</td>
		<td width="12%"><b><u><?php echo $current_school_reg_code;?></b></u></td>
	</tr>
	<tr>
		<td>School Name:</td>
		<td><b><u><?php echo $current_school_name;?></b></u></td>
		<td>Division:</td>
		<td><b><u><?php echo $current_school_division;?></b></u></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>School District:</td>
		<td><b><u><?php echo $current_school_district;?></b></u></td>
	</tr>
</table>
<br>
<table border="0" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<td align="center"><b>GRADE <?php echo $_GET['er_level'];?></b></td>
	</tr>
</table>
<br>
<table border="1" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<th width="3%">#</th>
		<th>NAME</th>
		<th width="5%">SEX</th>
		<th width="5%">AGE</th>
		<th width="5%">BIRTHDATE</th>
		<th width="25%">ADDRESS</th>
		<th width="26%">CATEGORY OF C/Y DISABILITY<br>(for children and youth with disabilities only)</th>
		<th width="8%">REMARKS</th>	
	</tr>
	<?php
	$i=1;
	$checkList = dbquery("select * from earlyregistry inner join student on er_stud_no=stud_no where (er_level='".$_GET['er_level']."' and 	er_sy='".($current_sy+1)."') order by stud_gender desc, stud_lname asc, stud_fname asc");
	while ($dataList = dbarray($checkList)){
	?>
	<tr>
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper(($dataList['stud_lname'].", ".$dataList['stud_fname']." ".substr($dataList['stud_mname'],0,1)));?></td>
		<td><?php echo $dataList['stud_gender'];?></td>
		<?php 
		$phpdate = strtotime($dataList['stud_bdate']);
		$mysqldate = date('F d, Y', $phpdate);
		$date1 = strtotime(date("Y-m-d"));
		$date2 = strtotime($dataList['stud_bdate']);
		$time_difference = $date1 - $date2;
		$seconds_per_year = 60*60*24*365;
		$years = (int) ($time_difference / $seconds_per_year);
		?>	
		<td><?php echo "$years";?></td>
		<td><?php echo $dataList['stud_bdate'];?></td>
		<td><?php echo $dataList['stud_residence'];?></td>
		<td><?php echo $dataList['er_disability'];?></td>
		<td><?php echo $dataList['er_remarks'];?></td>
	</tr>
	<?php 
		$userid = $dataList['er_lastmod_user_no'];
		$i++; 
	} ?>
</table>
<br>
<table border="0" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<?php
		$checkuser = dbquery("select * from users where user_no='".$userid."'");
		$datauser = dbarray($checkuser);
		?>
		<td width="35%" valign="top">Prepared by:<br><br><br><b><?php echo $datauser['user_fullname'];?></b><br>Member, Early Registration Committee</td>
		<td width="30%" valign="top">Checked by:<br><br><br><b><?php echo $current_registrar;?></b><br>School Registrar</td>
		<td width="35%" valign="top">Noted by:<br><br><br><b><?php echo $current_principal;?></b><br>School Principal</td>
	</tr>
</table>