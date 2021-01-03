<?php
require('maincore.php');
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
<table border="0" cellspacing="0" cellpadding="0" width="750">
	<tr>
		<td width="60"><img src="./assets/images/sanhs_logo.png" width="50"></td>
		<td align="left" valign="top">
		<strong>San Agustin National High School</strong><br>
		San Agustin, Sagbayan, Bohol
		<h2>LEARNERS OF EARLY REGISTRATION IMPLEMENTERS (GRADE 12)<br>SY 2016
		</h2>
		</td>
	</tr>
</table>	
<h3>Student List for Grade <?php echo $_GET['classProfile'];?> / SY <?php echo $_GET['enrol_sy'];?> - <?php echo $_GET['enrol_sy']+1;?></h3>

<table border="1" cellspacing="0" cellpadding="1" width="1024">
	<tr height="25">
		<th width="3%">#</th>
		<th width="7%">LRN</th>
		<th width="10%">First</th>
		<th width="10%">Middle</th>
		<th width="10%">Last</th>
		<th width="5%">Ext</th>
		<th width="5%">Sex<br>(M/F)</th>
		<th width="5%">Birthdate<br>(mm/dd/yyyy)</th>
		<th width="15%">Enrollment Source</th>
		<th>Program Offering</th>
	</tr>
	<?php
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student ON studenroll.enrol_stud_no=student.stud_no INNER JOIN studcontacts ON student.stud_no=studcontacts.studCont_stud_no WHERE (enrol_status1!='INACTIVE' AND enrol_section!='' AND enrol_level='".$_GET['classProfile']."' AND enrol_sy='".$_GET['enrol_sy']."') ORDER BY enrol_section ASC, stud_lname ASC, stud_fname ASC");
	$rows = dbrows($result);
	$i=1;
	while($data = dbarray($result)){
	?>
	<tr height="25">
		<td><?php echo $i; ?></td>
		<td><?php echo strtoupper($data['stud_lrn']);?></td>
		<td><?php echo strtoupper($data['stud_fname']);?></td>
		<td><?php echo strtoupper($data['stud_mname']);?></td>
		<td><?php echo strtoupper($data['stud_lname']);?></td>
		<td><?php echo strtoupper($data['stud_xname']);?></td>
		<td><?php echo substr($data['stud_gender'],0,1);?></td>
		<?php
			$phpdate = strtotime($data['stud_bdate']);
		?>
		<td><?php echo $mysqldate = date('m/d/Y', $phpdate);?></td>
		<td>DepEd Public Gr 10 Completer</td>
		<td><?php echo (substr($data['enrol_section'],0,5)=="ACAD-"?"Academics - General Academic Strand":(substr($data['enrol_section'],0,5)=="TVL-I"?"TVL-Information and Communications Technology":"TVL-Home Economics"));?></td>
	</tr>
	<?php 
	$i++;
	} ?>


</table>
<br>
<table border="0" cellspacing="0" cellpadding="0" width="750">
	<tr>
		<td>Prepared by: <br><br><br><br><strong><?php echo $current_registrar; ?></strong><br>School Registrar</td>
		<td>Approved by: <br><br><br><br><strong><?php echo $current_principal; ?></strong><br>School Principal</td>
	</tr>
</table>