<?php
require('maincore.php');
$resultStudent = dbquery("SELECT * FROM student INNER JOIN studcontacts ON student.stud_no=studcontacts.studCont_stud_no WHERE student.stud_no='".$_GET['stud_no']."'");
$dataStudent = dbarray($resultStudent);
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<style>
	table {
	
	}
	
	th{
		height: 13px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.6em;
	} 
	
	td {
		height: 13px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.55em;		
	}
	input {
		height: 15px;
		text-decoration: strong;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.8em;			
	}
	</style>
</head>	
<table border="0" cellspacing="0" cellpadding="0" width="780">
	<tr>
		<td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td>
		<td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td><td width="7%"></td>
	</tr>
	<tr align="center">
		<td colspan="2" rowspan="5"><img src="./assets/images/sanhs_logo.png" width="65"></td>
		<td colspan="10">Republic of the Philippines</td>
		<?php
		$student_image = "./assets/images/students/".$_GET['stud_no'].".jpg";
		$no_image = "./assets/images/noimage.jpg";
		?>
		<td colspan="2" rowspan="5"><img src="<?php echo (file_exists($student_image) ? $student_image : $no_image); ?>" alt="" style="max-width:100px" border="1"/><br>
		Student No.:<?php echo $_GET['stud_no'];?></td>
	</tr>
	<tr align="center">
		<td colspan="10">Department of Education</td>
	</tr>
	<tr align="center">
		<td colspan="10"><?php echo $current_school_region;?></td>
	</tr>
	<tr align="center">
		<td colspan="10">Division of <?php echo $current_school_division;?></td>
	</tr>
	<tr>
		<td colspan="10" align="center"></td>
	</tr>	
	<tr>
		<td colspan="2"></td>
		<td colspan="10" align="center"><h3><u><?php echo strtoupper($current_school_name);?></u> <br><?php echo $current_school_address;?><br><h2>STUDENT PROFILE</h2></h3></td>
		<td colspan="2"></td>
	<tr>	
	<tr>
		<td>LRN:</td>
		<td colspan="3" style="border-bottom: 1px solid;"><strong> <?php echo $dataStudent['stud_lrn'];?></strong></td>
		<td colspan="10"></td>
	<tr>
	<tr>
		<td>Name:</td>
		<td colspan="5" style="border-bottom: 1px solid;"> <strong><?php echo strtoupper($dataStudent['stud_lname'].", ".$dataStudent['stud_fname']." ".$dataStudent['stud_xname']." ".$dataStudent['stud_mname']);?></strong></td>
		<td colspan="2" align="right">Date of Birth: &nbsp;</td>
		<td colspan="4" style="border-bottom: 1px solid;"> <strong><?php $phpdate = strtotime($dataStudent['stud_bdate']); echo $mysqldate = date('F d, Y', $phpdate);?></strong></td>
		<td align="right">Sex: &nbsp;</td>
		<td style="border-bottom: 1px solid;"><strong><?php echo $dataStudent['stud_gender'];?></strong></td>
	<tr>
	<tr>
		<td colspan="2">Place of Birth</td>
		<td colspan="7" style="border-bottom: 1px solid;"> <strong><input type="text" style="width: 340px; border: 0px; font-weight: bold !important; font-size: 10px" value="" placeholder="<?php echo $dataStudent['stud_residence'];?>"></strong></td>
		<td colspan="5"></td>
	<tr>	
	<tr>
		<td colspan="2">Father</td>
		<td colspan="7" style="border-bottom: 1px solid;"> <strong><?php echo strtoupper($dataStudent['studCont_stud_ffname']." ".$dataStudent['studCont_stud_fmname']." ".$dataStudent['studCont_stud_flname']);?></strong></td>
		<td></td>
		<td colspan="2" align="right" >Occupation: &nbsp;</td>
		<td colspan="2" style="border-bottom: 1px solid;"> <input type="text" style="width: 95px; border: 0px; font-weight: bold !important; font-size: 10px" value="" placeholder="FARMING"></td>
	<tr>
	<tr>
		<td colspan="2">Mother</td>
		<td colspan="7" style="border-bottom: 1px solid;"> <strong><?php echo strtoupper($dataStudent['studCont_stud_mfname']." ".$dataStudent['studCont_stud_mmname']." ".$dataStudent['studCont_stud_mlname']);?></strong></td>
		<td></td>
		<td colspan="2" align="right" >Occupation: &nbsp;</td>
		<td colspan="2" style="border-bottom: 1px solid;"> <input type="text" style="width: 95px; border: 0px; font-weight: bold !important; font-size: 10px" value="" placeholder="FARMING"></td>
	<tr>	
	
	<tr>
		<td colspan="3">Address of Parent or Guardian:</td>
		<td colspan="6" style="border-bottom: 1px solid;"> <strong><?php echo $dataStudent['stud_residence'];?></strong></td>
		<td colspan="6"></td>
	<tr>

		
</table><br>
<table border="0" cellspacing="0" cellpadding="1" width="780">
	<tr>
		<tr>
			<th colspan="6" align="left">Scholastic History</th>

		</tr>
	</tr>
</table>
<table border="1" cellspacing="0" cellpadding="1" width="780">
	<tr>
		<tr>
			<th width="13%">School Year</th>
			<th >School</th>
			<th width="5%">Level</th>
			<th width="13%">Section</th>
			<th width="5%">Average</th>
			<th width="25%">Status</th>
		</tr>
	</tr>
<?php
$resultForm137 = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['stud_no']."' AND enrol_level >6) ORDER BY enrol_sy asc, enrol_level ASC");
while($dataForm137 = dbarray($resultForm137)){
?>
		<tr>
			<td width="13%"><?php echo $dataForm137['enrol_sy'];?>-<?php echo $dataForm137['enrol_sy']+1;?></td>
			<td><?php echo $dataForm137['enrol_school'];?></td>
			<td width="5%"><?php echo $dataForm137['enrol_level'];?></td>
			<td width="13%"><?php echo $dataForm137['enrol_section'];?></td>
			<td width="5%"><?php echo ($dataForm137['enrol_status1']=="ENROLLED"?"":number_format($dataForm137['enrol_average'],2));?></td>
			<td width="25%"><?php echo ($dataForm137['enrol_status1']=="ENROLLED"?"":$dataForm137['enrol_status2']);?></td>
		</tr>
<?php
}
?>






</table><br>
<table border="0" cellspacing="0" cellpadding="1" width="780">
	<tr>
		<tr>
			<th colspan="6" align="left">Anecdotal Records</th>

		</tr>
	</tr>
</table>
<table border="1" cellspacing="0" cellpadding="1" width="780">
	<tr>
		<tr>
			<th width="10%">Case Number</th>
			<th width="10%">Date</th>
			<th>Description</th>
			<th width="30%">Details</th>
			<th width="20%">Counselor</th>
		</tr>
		<?php
		$resultAnec = dbquery("SELECT * FROM anecdotal INNER JOIN users ON anec_user_name=user_name WHERE anec_stud_no='".$_GET['stud_no']."'");
		while($dataAnec = dbarray($resultAnec)){
		?>
		<tr>
			<td><?php echo $dataAnec['anec_no']; ?></td>
			<td><?php echo $dataAnec['anec_date']; ?></td>
			<td><?php echo $dataAnec['anec_desc']; ?></td>
			<td><?php echo $dataAnec['anec_details']; ?></td>
			<td><?php echo $dataAnec['user_fullname']; ?></td>
		</tr>
		<?php
		}
		?>
	</tr>
</table>