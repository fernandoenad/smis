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
<br><br>
<table border="0" cellspacing="0" cellpadding="0" width="750">
	<tr>
		<td width="60" valign="top"><img src="./assets/images/deped_logo.png" width="80"></td>
		<td align="center" valign="top">
		Republic of the Philippines<br>
		Department of Education<br>
		<?php echo $current_school_region;?><br>
		<strong>Division of <?php echo $current_school_division;?></strong><br>
		<strong>DISTRICT OF <?php echo $current_school_district;?></strong><br><br>
		<strong><?php echo $current_school_name;?></strong><br>
		<i><?php echo $current_school_address;?></i><br>
		<?php
		$enrol_sy=$_GET['enrol_sy'];
		$checkLateDates = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
		$dataLateDates = dbarray($checkLateDates);
		
		if($_GET['status']=="current"){
			$title = "Current Enrollment";
			$filter = " AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED') ";
		}
		else if($_GET['status']=="all"){
			$title = "Annual Enrollment";
			$filter = "  ";
		}
		else if($_GET['status']=="bosy"){
			$title = "BOSY Enrollment";
			$filter = " AND enrol_admitdate<='".$dataLateDates['settings_late1']."' and enrol_admitdate!='0000-00-00 00:00:00' ";
		}
		else if($_GET['status']=="late1"){
			$title = "Late Enrollment (First Semester)";
			$checkLateDates = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
			$dataLateDates = dbarray($checkLateDates);
			$filter = "  AND studenroll.enrol_admitdate>'".$dataLateDates['settings_late1']."' and enrol_section!='' ";
		}
		else if($_GET['status']=="ti"){
			$title = "Transferred Ins";
			$filter = "  AND studenroll.enrol_ti='1' ";			
		}
		else if($_GET['status']=="ns"){
			$title = "New Students (Second Semester, SHS)";
			$filter = "  AND enrol_admitdate='0000-00-00 00:00:00' ";
		}
		else if($_GET['status']=="late2"){
			$title = "Late Enrollment (Second Semester, SHS)";
			$checkLateDates = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
			$dataLateDates = dbarray($checkLateDates);
			$filter = "  AND studenroll.enrol_admitdate2>'".$dataLateDates['settings_late2']."' and enrol_section!=''  ";
		}
		else if($_GET['status']=="to"){
			$title = "Transferred Outs";
			$filter = "  AND studenroll.enrol_status1='INACTIVE' AND studenroll.enrol_status2='TRANSFERRED OUT' ";
		}
		else if($_GET['status']=="do"){
			$title = "Dropouts";
			$filter = " AND studenroll.enrol_status1='INACTIVE' AND studenroll.enrol_status2='DROPPED OUT'  ";
		}
		else if($_GET['status']=="cct"){
			$title = "Conditional Cash Transfer Beneficiaries";
			$filter = "  AND stud_cct!='NO' ";
		}
		else if($_GET['status']=="prom"){
			$title = "Promoted";
			$filter = " AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='PROMOTED'  ";
		}
		else if($_GET['status']=="ret"){
			$title = "Retained";
			$filter = " AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED'  ";
		}
		else if($_GET['status']=="cond"){
			$title = "Conditional";
			$filter = " AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR'  ";
		}
		?>
		<h2>STUDENT LIST - <?php echo $title;?></h2>
		School Year <?php echo $current_sy;?>-<?php echo $current_sy+1;?>, <?php echo ($current_sem==1?"First":"Second");?> Semester<br>
		</td>
		<td width="60" valign="top"><img src="./assets/images/sanhs_logo.png" width="80"></td>
	</tr>
</table>

	
<table border="0" cellspacing="0" cellpadding="0" width="750">
<tr>
<?php
$result= dbquery("SELECT * FROM studenroll INNER JOIN student ON studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND student.stud_gender='MALE' $filter) ORDER BY enrol_level ASC, enrol_section asc, stud_lname ASC, stud_fname ASC");
$rows = dbrows($result);
?>
<td valign="top" width="375">Males (<?php echo  $rows; ?>)
<table border="0" cellspacing="0" cellpadding="1" width="100%">
	<tr>
		<th width="1%">#</th>
		<th width="42%">FULLNAME</th>
		<th align="right">Level</th>
		<th align="left">Section</th>
		<th align="left">LRN</th>
	</tr>
	<?php
	$i=1;
	while($data = dbarray($result)){
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".($data['stud_mname']=="-"?"":substr($data['stud_mname'],0,1).".")); ?></td>
		<td align="right"><?php echo $data['enrol_level'];?></td>	
		<td align="left"><?php echo $data['enrol_section'];?></td>			
		<td align="left"><?php echo $data['stud_lrn'];?></td>
	</tr>	
	<?php 
	$i++;
	} ?>
</table>
</td>
<td>&nbsp;</td>
<?php
$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."'  AND studenroll.enrol_section!='' AND student.stud_gender='FEMALE' $filter) ORDER BY enrol_level ASC, enrol_section asc, stud_lname ASC, stud_fname ASC");
$rows = dbrows($result);
?>
<td valign="top" width="375">Females (<?php echo  $rows; ?>)
<table border="0" cellspacing="0" cellpadding="1" width="100%">
	<tr>
		<th width="1%">#</th>
		<th width="42%">FULLNAME</th>
		<th align="right">Level</th>
		<th align="left">Section</th>
		<th align="left">LRN</th>
	</tr>
	<?php
	$i=1;
	while($data = dbarray($result)){
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".($data['stud_mname']=="-"?"":substr($data['stud_mname'],0,1).".")); ?></td>
		<td align="right"><?php echo $data['enrol_level'];?></td>	
		<td align="left"><?php echo $data['enrol_section'];?></td>			
		<td align="left"><?php echo $data['stud_lrn'];?></td>
	</tr>
	<?php 
	$i++;
	} ?>
</table>
</td>
</tr>
</table>
<br>
<table border="0" cellspacing="0" cellpadding="0" width="800">
	<tr>
		<td width="30%"></td>
		<td></td>
		<td width="30%">Prepared by:<br><br><br></td>
	</tr>
	<tr>
		<td align="center"></td>
		<td align="center"></td>
		<td align="center"><b><?php echo strtoupper($current_registrar);?></b><br>School Registrar</td>
	</tr>	
</table>