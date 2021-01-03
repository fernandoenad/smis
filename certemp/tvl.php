<?php
require('../maincore.php');
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

<table border="1" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<th rowspan="2">No</th>
		<th rowspan="2" width="7%">Family / Last Name</th>
		<th rowspan="2" width="8%">First Name</th>
		<th rowspan="2" width="7%">Middle Name</th>
		<th rowspan="2" width="2%">Ext. Name</th>
		<th rowspan="2" width="5%">Contact Number</th>
		<th colspan="4">ADDRESS</th>		
		<th rowspan="2">Sex</th>
		<th rowspan="2" width="3%">BIRTH DATE (mm-dd-yyyy)</th>
		<th rowspan="2">Birthplace</th>
		<th rowspan="2" width="3%">Age</th>
		<th rowspan="2" width="3%">Year Level</th>
		<th rowspan="2">Specific Area in TLE/TVL Subject</th>
	</tr>
	<tr>		
		<th width="2%">Street</th>
		<th width="8%">Barangay</th>
		<th width="8%">Municipality</th>
		<th width="5%">Province</th>
	</tr>
	<?php
	$i=1;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$current_sy."' AND studenroll.enrol_section!='' and enrol_level between '9' and '10') ORDER BY enrol_level asc, enrol_section asc, stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
		$checkTLE = dbquery("select * from grade inner join class on grade_class_no=class_no inner join prospectus on class_pros_no=pros_no inner join student on grade_stud_no=stud_no inner join users on class_user_name=user_no where (grade_sy='".$current_sy."' and grade_stud_no='".$data['stud_no']."' and (pros_no='6' or pros_no='18')) ");
		$dataTLE = dbarray($checkTLE);
	?>
	<tr height="25">
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($data['stud_lname']);?></td>
		<td><?php echo strtoupper($data['stud_fname']);?></td>
		<td><?php echo strtoupper($data['stud_mname']);?></td>
		<td><?php echo strtoupper($data['stud_xname']);?></td>
		<?php
		$result2 = dbquery("select * from studcontacts where studCont_stud_no='".$data['stud_no']."' order by studCont_no asc");
		$data2 = dbarray($result2);
		?>
		<td><?php echo strtoupper($data2['studCont_stud_gcontact']);?></td>		
		<?php
		$myString = $data['stud_residence'];
		$myArray = explode(',', $myString);
		?>
		<td>-</td>
		<td><?php echo $myArray[0];?></td>
		<td><?php echo $myArray[1];?></td>
		<td><?php echo $myArray[2];?></td>
		<td><?php echo substr($data['stud_gender'],0,1);?></td>
		<?php 
		$phpdate_bdate = strtotime($data['stud_bdate']);
		$phpdate_bosy = strtotime(date("m-d-Y"));
		?>															
		<td><?php echo $mysqldate = date('m/d/Y', $phpdate_bdate);?></td>
		<td><?php echo $myArray[1].", ".$myArray[2];?></td>
		<?php
		$date1 = strtotime($current_bosy);
		$date2 = strtotime($data['stud_bdate']);
		$time_difference = $date1 - $date2;
		$seconds_per_year = 60*60*24*365;
		$years = $time_difference / $seconds_per_year;
		?>
		<td><?php echo substr($years,0,2);?></td>
		<td><?php echo $data['enrol_level'];?></td>
		<td><?php 
		if($dataTLE['user_fullname']=="DORIS C. MIANO"){
			echo "HE: Cookery NCII";
		}
		else if($dataTLE['user_fullname']=="JENNY ANN L. TUMALE" && $data['enrol_level']==9){
			echo "HE: Nail Care NCII";
		}
		else if($dataTLE['user_fullname']=="JENNY ANN L. TUMALE" && $data['enrol_level']==10){
			echo "HE: Beauty Care NCII";
		}
		else if($dataTLE['user_fullname']=="MA. CHRISTAL T. BONGHANOY"){
			echo "ICT: Computer Systems Servicing NCII";
		}
		else if($dataTLE['user_fullname']=="SHEONY S. LOPEZ"){
			echo "AFA: Agri-Crop Production NCII";
		}
		else if($dataTLE['user_fullname']=="MARIBEL C. TAPA"){
			echo "HE: Dressmaking NCII";
		}
		else if($dataTLE['user_fullname']=="JOSE B. LAMOSTE"){
			echo "HE: Consumer Electronics Servicing NCII";
		}
		
		?></td>
	</tr>
	<?php 
	$i++;
	} ?>
	<?php
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$current_sy."' AND studenroll.enrol_section!='' and enrol_level>10 and enrol_track='TVL') ORDER BY enrol_level asc, enrol_section asc, stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="25">
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($data['stud_lname']);?></td>
		<td><?php echo strtoupper($data['stud_fname']);?></td>
		<td><?php echo strtoupper($data['stud_mname']);?></td>
		<td><?php echo strtoupper($data['stud_xname']);?></td>
		<?php
		$result2 = dbquery("select * from studcontacts where studCont_stud_no='".$data['stud_no']."' order by studCont_no asc");
		$data2 = dbarray($result2);
		?>
		<td><?php echo strtoupper($data2['studCont_stud_gcontact']);?></td>		
		<?php
		$myString = $data['stud_residence'];
		$myArray = explode(',', $myString);
		?>
		<td>-</td>
		<td><?php echo $myArray[0];?></td>
		<td><?php echo $myArray[1];?></td>
		<td><?php echo $myArray[2];?></td>
		<td><?php echo substr($data['stud_gender'],0,1);?></td>
		<?php 
		$phpdate_bdate = strtotime($data['stud_bdate']);
		$phpdate_bosy = strtotime(date("m-d-Y"));
		?>															
		<td><?php echo $mysqldate = date('m/d/Y', $phpdate_bdate);?></td>
		<td><?php echo $myArray[1].", ".$myArray[2];?></td>
		<?php
		$date1 = strtotime($current_bosy);
		$date2 = strtotime($data['stud_bdate']);
		$time_difference = $date1 - $date2;
		$seconds_per_year = 60*60*24*365;
		$years = $time_difference / $seconds_per_year;
		?>
		<td><?php echo substr($years,0,2);?></td>
		<td><?php echo $data['enrol_level'];?></td>
		<td><?php echo $data['enrol_strand'].": ".$data['enrol_combo'];?></td>
	</tr>
	<?php 
	$i++;
	} ?>
	
</table><br>
