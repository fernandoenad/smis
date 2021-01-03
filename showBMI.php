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
<?php
$resultTeacher = dbquery("SELECT * FROM section WHERE (section_name='".$_GET['classProfile']."' AND section_sy='".$_GET['enrol_sy']."')");
$dataTeacher = dbarray($resultTeacher);
?>
<table border="0" cellspacing="0" cellpadding="1" width="750">
	<tr>
		<td width="10%" align="right"><img src="./assets/images/deped_logo.png" width="80"></td>
		<td align="center" valign="top">
			<strong><big><big>Department of Education<br>School Form 8 (SF8<?php echo ($dataTeacher['section_level']>10?"-SHS":"");?>)  Learner's Basic Health and Nutrition Report <?php echo ($dataTeacher['section_level']>10?"for Senior High School":"");?></strong></big></big><br>
			<small><i>(For All Grade Levels)</i></small>
			<br><br>
			<table width="100%" border="0">
				<tr height="23">
					<td width="15%" align="right" border="1"><font size="1">School Name &nbsp;</td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_full;?></td>
					<td width="3%"></td>
					<td width="10%" align="right"><font size="1">District &nbsp;</td>
					<td width="10%" align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_district;?></td>
					<td width="3%"></td>
					<td width="10%" align="right"><font size="1">Division &nbsp;</td>
					<td width="10%" align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_division;?></td>
					<td width="3%"></td>
					<td width="10%" align="right" ><font size="1">Region &nbsp;</td>
					<td width="5%" align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_reg_code;?></td>
				</tr>
			</table>
		</td>
		<td width="10%"><img src="./assets/images/deped_word.png" width="80"></td>
	</tr>
</table>
<table border="0" width="750">	
	<tr height="25">
		<td width="8%" align="right" ><font size="1">School ID &nbsp;</td>
		<td width="8%" align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_code;?></td>
		<td width="2%"></td>
		<td width="7%" align="right" border="1" ><font size="1">Grade &nbsp;</td>
		<td width="6%" align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $dataTeacher['section_level'];?></td>
		<td width="2%"></td>
		<td width="6%" align="right"><font size="1">Section &nbsp;</td>
		<td width="12%" align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $dataTeacher['section_name'];?></td>
		<td width="2%"></td>
		<?php
		if($dataTeacher['section_level']>10){
		?>
		<td width="15%" align="right"><font size="1">Track/Strand (SHS) &nbsp;</td>
		<td width="10%" align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo substr($dataTeacher['section_track'],4);?></td>
		<td width="2%"></td>
		<?php
		}
		?>
		<td width="10%" align="right"><font size="1">School Year &nbsp;</td>
		<td width="10%" align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?></td>
		<td width="5%" ><font size="1"></td>
	</tr>				
</table>	

<table border="0" cellspacing="0" cellpadding="0" width="750">
<tr>

<table border="1" cellspacing="0" cellpadding="1" width="750">
	<tr>
		<th rowspan="2">#</th>
		<th rowspan="2" width="9%">LRN</th>
		<th rowspan="2" width="25%">Learner's Name<br><i><small>(Last Name, First Name, Name Extension, Middle Name)</small></i></th>
		<th rowspan="2">Birthdate<br><i><small>(MM/DD/YYYY)</small></i></th>
		<th rowspan="2">Age</th>
		<th rowspan="2">Weight<br><i><small>(Kg)</small></i></th>
		<th rowspan="2">Height<br><i><small>(m)</small></i></th>
		<th rowspan="2">Height<sup>2</sup><br><i><small>(m<sup>2</sup>)</small></i></th>
		<th colspan="2">Nutritional Status</th>
		<th rowspan="2">Height for Age <br>(HFA)</th>
		<th rowspan="2">Remarks</th>
	</tr>
	<tr>
		<th>BMI<br><small><i>(Kg/m<sup>2</sup>)</small></i></th>
		<th>BMI <br>Category</th>
	</tr>
	<tr>
		<td colspan="12" bgcolor="gray"><i>MALE</i></td>
	</tr>
	<?php
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student ON studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND stud_gender='MALE' and enrol_status1!='INACTIVE' and studenroll.enrol_section='".$_GET['classProfile']."' ) ORDER BY stud_gender DESC, stud_lname ASC, stud_fname ASC");
	$rows = dbrows($result);
	$countSWm=0;
	$countWm=0;
	$countNm=0;
	$countOWm=0;
	$countOm=0;
	$countSWf=0;
	$countWf=0;
	$countNf=0;
	$countOWf=0;
	$countOf=0;
	
	
	$countSSHm=0;
	$countSHm=0;
	$countNHm=0;
	$countTHm=0;
	$countSSHf=0;
	$countSHf=0;
	$countNHf=0;
	$countTHf=0;
	
	$i=1;
	while($data = dbarray($result)){
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $data['stud_lrn'];?> </td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?> </td>
		<td>
			<?php 
			$phpdate = strtotime($data['stud_bdate']);
			echo $mysqldate = date('m-d-Y', $phpdate);
			?>	
		</td>
		<td>
		<?php
		$dow = strtotime($current_dow);
		$dob = strtotime($data['stud_bdate']);
		$time_difference = $dow - $dob;
		$seconds_per_year = 60*60*24*365;
		echo $years = (int) ($time_difference / $seconds_per_year);
		$months = (int) (($time_difference / $seconds_per_year) * 12);
		?>
		</td>
		<td><?php echo number_format($data['enrol_weight'],2); ?></td>
		<td><?php echo number_format($data['enrol_height']/100,2); ?></td>
		<td><?php echo number_format(($data['enrol_height']/100)*($data['enrol_height']/100),2); ?></td>
		<td><?php 
			if($data['enrol_height']==0){
				$bmi=0;
				echo "-";
			}
			else {
				echo $bmi= number_format($data['enrol_weight']/(($data['enrol_height']/100)*($data['enrol_height']/100)),2);
			}
			?>
		</td>
		<td>
		<?php
		$imale = 1;
		$checkBMItbl = dbquery("select * from nut_bmi where (gender='MALE' and months='".$months."')"); 
		$dataBMItbl = dbarray($checkBMItbl);
		if($months<=228){
			if($bmi==0){}
			elseif($bmi<=$dataBMItbl['sw']){
				$nut_stat="Severely Wasted";
				$countSWm++;
			}
			elseif($bmi<=$dataBMItbl['w']){
				$nut_stat="Wasted";
				$countWm++;
			}
			elseif($bmi<=$dataBMItbl['n']){
				$nut_stat="Normal";
				$countNm++;
			}
			elseif($bmi<=$dataBMItbl['ow']){
				$nut_stat="Overweight";
				$countOWm++;
			}
			elseif($bmi>$dataBMItbl['ow']){
				$nut_stat="Obese";
				$countOm++;
			}
		}
		else {
			if($bmi==0){}
			elseif($bmi<18.5){
				$nut_stat="Wasted";
				$countWm++;
			}
			elseif($bmi<=24.9){
				$nut_stat="Normal";
				$countNm++;
			}
			elseif($bmi<=29.9){
				$nut_stat="Overweight";
				$countOWm++;
			}
			elseif($bmi>29.9){
				$nut_stat="Obese";
				$countOm++;
			}
		}		
		$imale++;
	
		echo ($data['enrol_height']==0?"-":$nut_stat);
		?>		
		</td>
		<td>
		<?php
		$height = $data['enrol_height'];
		$checkAFHtbl = dbquery("select * from nut_afh where (gender='MALE' and months='".$months."')"); 
		$datacheckAFHtbl = dbarray($checkAFHtbl);
		if($months<=228){
			if($height==0){}
			elseif($height<=$datacheckAFHtbl['ss']){
				$nut_stath="Severely Stunted";
				$countSSHm++;					
			}
			elseif($height<=$datacheckAFHtbl['s']){
				$nut_stath="Stunted";
				$countSHm++;
			}
			elseif($height<=$datacheckAFHtbl['n']){
				$nut_stath="Normal";
				$countNHm++;
			}
			elseif($height>$datacheckAFHtbl['n']){
				$nut_stath="Tall";
				$countTHm++;
			}
		}
		else{
			if($height==0){}
			elseif($height<=154.5){
				$nut_stath="Severely Stunted";
				$countSSHm++;					
			}
			elseif($height<=161.8){
				$nut_stath="Stunted";
				$countSHm++;
			}
			elseif($height<=191.1){
				$nut_stath="Normal";
				$countNHm++;
			}
			elseif($height>191.1){
				$nut_stath="Tall";
				$countTHm++;
			}		
		}
		echo ($data['enrol_height']==0?"-":$nut_stath);
		?>
		</td>
		<td>
		</td>
		
	</tr>
	<?php 
	$i++;
	} ?>
	<tr>
		<td colspan="12" bgcolor="gray"><i>FEMALE</i></td>
	</tr>
	<?php
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student ON studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND stud_gender='FEMALE' and enrol_status1!='INACTIVE' and studenroll.enrol_section='".$_GET['classProfile']."' ) ORDER BY stud_gender DESC, stud_lname ASC, stud_fname ASC");
	$rows = dbrows($result);
	$i=1;
	while($data = dbarray($result)){
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $data['stud_lrn'];?> </td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?> </td>
		<td>
			<?php 
			$phpdate = strtotime($data['stud_bdate']);
			echo $mysqldate = date('m-d-Y', $phpdate);
			?>	
		</td>
		<td>
		<?php
		$dow = strtotime($current_dow);
		$dob = strtotime($data['stud_bdate']);
		$time_difference = $dow - $dob;
		$seconds_per_year = 60*60*24*365;
		echo $years = (int) ($time_difference / $seconds_per_year);
		$months = (int) (($time_difference / $seconds_per_year) * 12);
		?>
		</td>
		<td><?php echo number_format($data['enrol_weight'],2); ?></td>
		<td><?php echo number_format($data['enrol_height']/100,2); ?></td>
		<td><?php echo number_format(($data['enrol_height']/100)*($data['enrol_height']/100),2); ?></td>
		<td><?php 
			if($data['enrol_height']==0){
				$bmi=0;
				echo "-";
			}
			else {
				echo $bmi= number_format($data['enrol_weight']/(($data['enrol_height']/100)*($data['enrol_height']/100)),2);
			}
			?>
		</td>
		<td>
		<?php
		$checkBMItbl = dbquery("select * from nut_bmi where (gender='FEMALE' and months='".$months."')"); 
		$dataBMItbl = dbarray($checkBMItbl);
		if($months<=228){
			if($bmi==0){}
			elseif($bmi<=$dataBMItbl['sw']){
				$nut_stat="Severely Wasted";
				$countSWf++;
			}
			elseif($bmi<=$dataBMItbl['w']){
				$nut_stat="Wasted";
				$countWf++;
			}
			elseif($bmi<=$dataBMItbl['n']){
				$nut_stat="Normal";
				$countNf++;
			}
			elseif($bmi<=$dataBMItbl['ow']){
				$nut_stat="Overweight";
				$countOWf++;
			}
			elseif($bmi>$dataBMItbl['ow']){
				$nut_stat="Obese";
				$countOf++;
			}
		}
		else {
			if($bmi==0){}
			elseif($bmi<18.5){
				$nut_stat="Wasted";
				$countWf++;
			}
			elseif($bmi<=24.9){
				$nut_stat="Normal";
				$countNf++;
			}
			elseif($bmi<=29.9){
				$nut_stat="Overweight";
				$countOWf++;
			}
			elseif($bmi>29.9){
				$nut_stat="Obese";
				$countOf++;
			}
		}
		$imale++;
	
		echo ($data['enrol_height']==0?"-":$nut_stat);
		?>		
		</td>
		<td>
		<?php
		$height = $data['enrol_height'];
		$checkAFHtbl = dbquery("select * from nut_afh where (gender='FEMALE' and months='".$months."')"); 
		$datacheckAFHtbl = dbarray($checkAFHtbl);
		if($months<=228){
			if($height==0){}
			elseif($height<=$datacheckAFHtbl['ss']){
				$nut_stath="Severely Stunted";
				$countSSHf++;					
			}
			elseif($height<=$datacheckAFHtbl['s']){
				$nut_stath="Stunted";
				$countSHf++;
			}
			elseif($height<=$datacheckAFHtbl['n']){
				$nut_stath="Normal";
				$countNHf++;
			}
			elseif($height>$datacheckAFHtbl['n']){
				$nut_stath="Tall";
				$countTHf++;
			}
		}
		else{
			if($height==0){}
			elseif($height<=143.4){
				$nut_stath="Severely Stunted";
				$countSSHf++;					
			}
			elseif($height<=150.0){
				$nut_stath="Stunted";
				$countSHf++;
			}
			elseif($height<=176.2){
				$nut_stath="Normal";
				$countNHf++;
			}
			elseif($height>176.2){
				$nut_stath="Tall";
				$countTHf++;
			}		
		}
		echo ($data['enrol_height']==0?"-":$nut_stath);
		?>
		</td>
		<td>
		</td>
		
	</tr>
	<?php 
	$i++;
	} ?>
</table>
<br>
<table width="750">
	<tr>
		<td align="center"><h2>SUMMARY TABLE</h2></td>
	</tr>
</table>
<table border="1" cellspacing="0" cellpadding="1" width="750">
	<tr align="center" height="23">
		<th rowspan="2" width="10%">Level/Year</th>
		<th colspan="6" width="50%">Nutritional Status</th>
		<th colspan="5" width="40%">Height for Age (HFA)</th>
	</tr>
	<tr height="22">
		<th width="8%">Severely Wasted</th>
		<th width="8%">Wasted</th>
		<th width="8%">Normal</th>
		<th width="8%">Overweight</th>
		<th width="8%">Obese</th>
		<th width="8%">TOTAL</th>
		<th width="8%">Severely Stunted</th>
		<th width="8%">Stunted</th>
		<th width="8%">Normal</th>
		<th width="8%">Tall</th>
		<th width="8%">TOTAL</th>
	</tr>

	<tr align="center" height="20">
		<th align="center">MALE </th>
		<td><?php echo number_format($countSWm,0);?></td>
		<td><?php echo number_format($countWm,0);?></td>
		<td><?php echo number_format($countNm,0);?></td>
		<td><?php echo number_format($countOWm,0);?></td>
		<td><?php echo number_format($countOm,0);?></td>
		<td><?php echo number_format($countSWm+$countWm+$countNm+$countOWm+$countOm,0);?></td>
		
		<td><?php echo number_format($countSSHm,0);?></td>
		<td><?php echo number_format($countSHm,0);?></td>
		<td><?php echo number_format($countNHm,0);?></td>
		<td><?php echo number_format($countTHm,0);?></td>
		<td><?php echo number_format($countSSHm+$countSHm+$countNHm+$countTHm,0);?></td>
	</tr>
	<tr align="center" height="20">
		<th align="center">FEMALE </th>
		<td><?php echo number_format($countSWf,0);?></td>
		<td><?php echo number_format($countWf,0);?></td>
		<td><?php echo number_format($countNf,0);?></td>
		<td><?php echo number_format($countOWf,0);?></td>
		<td><?php echo number_format($countOf,0);?></td>
		<td><?php echo number_format($countSWf+$countWf+$countNf+$countOWf+$countOf,0);?></td>
		
		<td><?php echo number_format($countSSHf,0);?></td>
		<td><?php echo number_format($countSHf,0);?></td>
		<td><?php echo number_format($countNHf,0);?></td>
		<td><?php echo number_format($countTHf,0);?></td>
		<td><?php echo number_format($countSSHf+$countSHf+$countNHf+$countTHf,0);?></td>
	</tr>
	<?php	
	?>
	<tr align="center" height="20">
		<th>TOTAL</th>
		<th><?php echo number_format($countSWm+$countSWf,0);?></th>
		<th><?php echo number_format($countWm+$countWf,0);?></th>
		<th><?php echo number_format($countNm+$countNf,0);?></th>
		<th><?php echo number_format($countOWm+$countOWf,0);?></th>
		<th><?php echo number_format($countOm+$countOf,0);?></th>
		<th><?php echo number_format($countSWm+$countWm+$countNm+$countOWm+$countOm+$countSWf+$countWf+$countNf+$countOWf+$countOf,0);?></th>
		
		<th><?php echo number_format($countSSHm+$countSSHf,0);?></th>
		<th><?php echo number_format($countSHm+$countSHf,0);?></th>
		<th><?php echo number_format($countNHm+$countNHf,0);?></th>
		<th><?php echo number_format($countTHm+$countTHf,0);?></th>
		<th><?php echo number_format($countSSHm+$countSHm+$countNHm+$countTHm+$countSSHf+$countSHf+$countNHf+$countTHf,0);?></th>
	</tr>
</table>
<br>
<table border="0" cellspacing="0" cellpadding="1" width="750">
	<tr>
		<?php
		$checkSettings = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
		$dataSettings = dbarray($checkSettings);
		?>
		<td>Date of Assessment:<br><br><br>
		<center><b><u><?php echo date('F d, Y',strtotime($current_bosy));?></u></b><br></center>
		</td>
		<?php
		$resultTeacher = dbquery("SELECT * FROM section inner join users on section_adviser=user_no WHERE (section_name='".$_GET['classProfile']."' AND section_sy='".$_GET['enrol_sy']."')");
		$dataTeacher = dbarray($resultTeacher);
		?>
		<td>Conducted/Assessed by:<br><br><br>
		<center><b><?php echo strtoupper($dataTeacher['user_fullname']);?></b><br>
		Class Adviser</center>
		</td>
		<td>Certified Correct by:<br><br><br>
		<center><b><?php echo strtoupper($dataSettings['settings_registrar']);?></b><br>
		School Registrar</center>
		</td>
		<td>Reviewed by:<br><br><br>
		<center><b><?php echo strtoupper($dataSettings['settings_principal']);?></b><br>
		School Principal</center>
		</td>
	</tr>
</table>