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
		font-size: 1.1em;
	} 
	
	td {
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 1em;		
	}
	</style>
</head>	
<table border="0" cellspacing="0" cellpadding="0" width="850">
	<tr>
		<td width="60"><img src="./assets/images/sanhs_logo.png" width="50"></td>
		<td align="left" valign="top">
		<strong><?php echo $current_school_name;?></strong><br>
		<?php echo $current_school_address;?>
		<h3>Year Level Masterlist<br>
		</h3>
		</td>
	</tr>
</table>	
<h3>Candidates for Moving Up / Promotion | Grade  <?php echo $_GET['classProfile'];?></h3>
<?php
$result= dbquery("SELECT * FROM studenroll INNER JOIN student ON studenroll.enrol_stud_no=student.stud_no INNER JOIN studcontacts ON student.stud_no=studcontacts.studCont_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_level='".$_GET['classProfile']."' AND studenroll.enrol_status2!='RETAINED' AND studenroll.enrol_status1!='INACTIVE') ORDER BY stud_gender DESC, stud_lname ASC, stud_fname ASC");
$rows = dbrows($result);
?>
<table border="1" cellspacing="0" cellpadding="1" width="850">
	<tr>
		<th width="2%">#</th>
		<th width="3%">LRN</th>
		<th width="8%">FIRSTNAME</th>
		<th width="4%">M.I.</th>
		<th width="7%">LASTNAME</th>
		<th width="3%">Gender</th>
		<th width="6%">Gr & Sec</th>
	</tr>
	<?php
	$i=1;
	while($data = dbarray($result)){
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $data['stud_lrn'];?></td>
		<td><?php echo $data['stud_fname'].($data['stud_xname']!=""?", ".$data['stud_xname']:"");?></td>
		<td><?php echo ($data['stud_mname']=="-"?"":substr($data['stud_mname'],0,1).".");?></td>
		<td><?php echo $data['stud_lname'];?></td>
		<td><?php echo $data['stud_gender'];?></td>
		<td><?php echo $data['enrol_level']." - ".$data['enrol_section'];?></td>
	</tr>
	<?php 
	$i++;
	} ?>
</table>
