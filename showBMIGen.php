<?php
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
		font-size: 0.6em;
	} 
	
	th {
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.5em;		
	}
	td {
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.5em;		
	}
	</style>	
</head>
<table border="0" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<td width="10%" align="right"><img src="./assets/images/deped_logo.png" width="80"></td>
		<td align="center" valign="top">
			<strong><font size="+1">Department of Education<br>School Form 8 (SF8<?php echo ($_GET['g1']>10?"-SHS":"");?>)  Learner's Basic Health and Nutrition Report <?php echo ($_GET['g1']>10?"for Senior High School":"");?></font></strong><br>
			<small><i>(For All Grade Levels)</i></small>
			<br><br>
			<table width="100%" border="0">
				<tr height="25">
					<td width="10%" align="right" ><font size="1">School ID &nbsp;</td>
					<td width="10%" align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_code;?></td>
					<td width="3%"></td>
					<td align="right" border="1"><font size="1">School Name &nbsp;</td>
					<td width="20%" align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_full;?></td>
					<td width="3%"></td>
					<td width="8%" align="right"><font size="1">Division &nbsp;</td>
					<td width="10%" align="center" colspan="2" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_division;?></td>
					<td width="3%"></td>
					<td width="8%" align="right"><font size="1">Region &nbsp;</td>
					<td width="10%" align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_reg_code;?></td>
				</tr>
			</table>
		</td>
		<td width="10%"><img src="./assets/images/sanhs_logo.png" width="80"></td>
	</tr>
</table>
<table width="1135">
	<tr>
		<td align="center"><h2>SUMMARY TABLE<br>(as of <?php echo date('F d, Y');?>)</h2></td>
	</tr>
</table>
<table border="1" cellspacing="0" cellpadding="1" width="1135">
	<tr align="center" height="23">
		<th rowspan="3" width="2%">#</th>
		<th rowspan="3">Level/Year</th>
		<th colspan="18">Nutritional Status</th>
		<th colspan="15">Height for Age (HFA)</th>
	</tr>
	<tr height="22">
		<th colspan="3">Severely Wasted</th>
		<th colspan="3">Wasted</th>
		<th colspan="3">Normal</th>
		<th colspan="3">Overweight</th>
		<th colspan="3">Obese</th>
		<th colspan="3">TOTAL</th>
		<th colspan="3">Severely Stunted</th>
		<th colspan="3">Stunted</th>
		<th colspan="3">Normal</th>
		<th colspan="3">Tall</th>
		<th colspan="3">TOTAL</th>
	</tr>
	<tr height="21">
		<th width="2.8%">M</th>
		<th width="2.8%">F</th>
		<th width="2.8%">T</th>
		<th width="2.8%">M</th>
		<th width="2.8%">F</th>
		<th width="2.8%">T</th>
		<th width="2.8%">M</th>
		<th width="2.8%">F</th>
		<th width="2.8%">T</th>
		<th width="2.8%">M</th>
		<th width="2.8%">F</th>
		<th width="2.8%">T</th>
		<th width="2.8%">M</th>
		<th width="2.8%">F</th>
		<th width="2.8%">T</th>
		<th width="2.8%">M</th>
		<th width="2.8%">F</th>
		<th width="2.8%">T</th>
		<th width="2.8%">M</th>
		<th width="2.8%">F</th>
		<th width="2.8%">T</th>
		<th width="2.8%">M</th>
		<th width="2.8%">F</th>
		<th width="2.8%">T</th>
		<th width="2.8%">M</th>
		<th width="2.8%">F</th>
		<th width="2.8%">T</th>
		<th width="2.8%">M</th>
		<th width="2.8%">F</th>
		<th width="2.8%">T</th>
		<th width="2.8%">M</th>
		<th width="2.8%">F</th>
		<th width="2.8%">T</th>


	</tr>	
	<?php
	$i=1;
	$g1=$_GET['g1'];
	$gn=$_GET['gn'];
	for($g=$g1;$g<=$gn;$g++){
	?>	
	<tr align="center" height="20">
		<th align="center"> <?php echo $i;?></th>
		<th align="center">GRADE <?php echo $g;?></th>
		<?php
		$checkBMI = dbquery("SELECT * FROM studenroll INNER JOIN student ON enrol_stud_no=stud_no WHERE (enrol_level='".$g."' and enrol_status1!='INACTIVE' and enrol_sy='".$_GET['enrol_sy']."' AND enrol_section!='')");
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
		while($dataBMI = dbarray($checkBMI)){
			$height = $dataBMI['enrol_height'];
			if($height==0){
				$bmi=0;
			}
			else {
				$bmi = round($dataBMI['enrol_weight']/((($dataBMI['enrol_height']==0?1:$dataBMI['enrol_height'])/100)*(($dataBMI['enrol_height']==0?1:$dataBMI['enrol_height'])/100)),2);
			}
			$dow = strtotime($current_dow);
			$dob = strtotime($dataBMI['stud_bdate']);
			$time_difference = $dow - $dob;
			$seconds_per_year = 60*60*24*365;
			$months = (int) (($time_difference / $seconds_per_year) * 12);
			
			if($dataBMI['stud_gender']=="MALE"){		
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
				else {
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
			}
			elseif($dataBMI['stud_gender']=="FEMALE") {
				$dow = strtotime($current_dow);
				$dob = strtotime($dataBMI['stud_bdate']);
				$time_difference = $dow - $dob;
				$seconds_per_year = 60*60*24*365;
				$months = (int) (($time_difference / $seconds_per_year) * 12);
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
			}
			// echo $nut_stat." ".$dataBMI['stud_no'];
		}
		?>
		<td><?php echo number_format($countSWm,0);?></td>
		<td><?php echo number_format($countSWf,0);?></td>
		<td><?php echo number_format(($countSWm+$countSWf),0);?></td>
		<td><?php echo number_format($countWm,0);?></td>
		<td><?php echo number_format($countWf,0);?></td>
		<td><?php echo number_format(($countWm+$countWf),0);?></td>
		<td><?php echo number_format($countNm,0);?></td>
		<td><?php echo number_format($countNf,0);?></td>
		<td><?php echo number_format(($countNm+$countNf),0);?></td>
		<td><?php echo number_format($countOWm,0);?></td>
		<td><?php echo number_format($countOWf,0);?></td>
		<td><?php echo number_format(($countOWm+$countOWf),0);?></td>
		<td><?php echo number_format($countOm,0);?></td>
		<td><?php echo number_format($countOf,0);?></td>
		<td><?php echo number_format(($countOm+$countOf),0);?></td>
		<td><?php echo number_format($countSWm+$countWm+$countNm+$countOWm+$countOm,0);?></td>
		<td><?php echo number_format($countSWf+$countWf+$countNf+$countOWf+$countOf,0);?></td>
		<td><?php echo number_format($countSWm+$countWm+$countNm+$countOWm+$countOm+$countSWf+$countWf+$countNf+$countOWf+$countOf,0);?></td>	
		
		<td><?php echo number_format($countSSHm,0);?></td>
		<td><?php echo number_format($countSSHf,0);?></td>
		<td><?php echo number_format($countSSHm+$countSSHf,0);?></td>
		<td><?php echo number_format($countSHm,0);?></td>
		<td><?php echo number_format($countSHf,0);?></td>
		<td><?php echo number_format($countSHm+$countSHf,0);?></td>
		<td><?php echo number_format($countNHm,0);?></td>
		<td><?php echo number_format($countNHf,0);?></td>
		<td><?php echo number_format($countNHm+$countNHf,0);?></td>
		<td><?php echo number_format($countTHm,0);?></td>
		<td><?php echo number_format($countTHf,0);?></td>
		<td><?php echo number_format($countTHm+$countTHf,0);?></td>
		<td><?php echo number_format($countSSHm+$countSHm+$countNHm+$countTHm,0);?></td>
		<td><?php echo number_format($countSSHf+$countSHf+$countNHf+$countTHf,0);?></td>
		<td><?php echo number_format($countSSHm+$countSHm+$countNHm+$countTHm+$countSSHf+$countSHf+$countNHf+$countTHf,0);?></td>

	</tr>
	<?php	
	$i++;
	}
	?>
	<tr align="center" height="20">
		<th colspan="2" align="left">TOTAL</th>
		<?php
		$checkBMI = dbquery("SELECT * FROM studenroll INNER JOIN student ON enrol_stud_no=stud_no WHERE (enrol_level<='".$gn."' and enrol_level>='".$g1."' and enrol_status1!='INACTIVE' and enrol_sy='".$_GET['enrol_sy']."' AND enrol_section!='')");
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
		while($dataBMI = dbarray($checkBMI)){
			$height = $dataBMI['enrol_height'];
			if($height==0){
				$bmi=0;
			}
			else{
				$bmi = round($dataBMI['enrol_weight']/((($dataBMI['enrol_height']==0?1:$dataBMI['enrol_height'])/100)*(($dataBMI['enrol_height']==0?1:$dataBMI['enrol_height'])/100)),2);
			}
			$dow = strtotime($current_dow);
			$dob = strtotime($dataBMI['stud_bdate']);
			$time_difference = $dow - $dob;
			$seconds_per_year = 60*60*24*365;
			$months = (int) (($time_difference / $seconds_per_year) * 12);
			
			if($dataBMI['stud_gender']=="MALE"){
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
				else {
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
			}
			else{
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
					elseif($height<=150){
						$nut_stath="Stunted";
						$countSHf++;
					}
					elseif($height<=176.20){
						$nut_stath="Normal";
						$countNHf++;
					}
					elseif($height>176.20){
						$nut_stath="Tall";
						$countTHf++;
					}					
				}
			}
		}
		?>
		<th><?php echo number_format($countSWm,0);?></th>
		<th><?php echo number_format($countSWf,0);?></th>
		<th><?php echo number_format(($countSWm+$countSWf),0);?></th>
		<th><?php echo number_format($countWm,0);?></th>
		<th><?php echo number_format($countWf,0);?></th>
		<th><?php echo number_format(($countWm+$countWf),0);?></th>
		<th><?php echo number_format($countNm,0);?></th>
		<th><?php echo number_format($countNf,0);?></th>
		<th><?php echo number_format(($countNm+$countNf),0);?></th>
		<th><?php echo number_format($countOWm,0);?></th>
		<th><?php echo number_format($countOWf,0);?></th>
		<th><?php echo number_format(($countOWm+$countOWf),0);?></th>
		<th><?php echo number_format($countOm,0);?></th>
		<th><?php echo number_format($countOf,0);?></th>
		<th><?php echo number_format(($countOm+$countOf),0);?></th>
		<th><?php echo number_format($countSWm+$countWm+$countNm+$countOWm+$countOm,0);?></th>
		<th><?php echo number_format($countSWf+$countWf+$countNf+$countOWf+$countOf,0);?></th>
		<th><?php echo number_format($countSWm+$countWm+$countNm+$countOWm+$countOm+$countSWf+$countWf+$countNf+$countOWf+$countOf,0);?></th>	
		
		<th><?php echo number_format($countSSHm,0);?></th>
		<th><?php echo number_format($countSSHf,0);?></th>
		<th><?php echo number_format($countSSHm+$countSSHf,0);?></th>
		<th><?php echo number_format($countSHm,0);?></th>
		<th><?php echo number_format($countSHf,0);?></th>
		<th><?php echo number_format($countSHm+$countSHf,0);?></th>
		<th><?php echo number_format($countNHm,0);?></th>
		<th><?php echo number_format($countNHf,0);?></th>
		<th><?php echo number_format($countNHm+$countNHf,0);?></th>
		<th><?php echo number_format($countTHm,0);?></th>
		<th><?php echo number_format($countTHf,0);?></th>
		<th><?php echo number_format($countTHm+$countTHf,0);?></th>
		<th><?php echo number_format($countSSHm+$countSHm+$countNHm+$countTHm,0);?></th>
		<th><?php echo number_format($countSSHf+$countSHf+$countNHf+$countTHf,0);?></th>
		<th><?php echo number_format($countSSHm+$countSHm+$countNHm+$countTHm+$countSSHf+$countSHf+$countNHf+$countTHf,0);?></th>
	</tr>
</table>
<br>
<table border="0" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<?php
		$checkSettings = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
		$dataSettings = dbarray($checkSettings);
		?>
		<td>Prepared by:<br><br><br>
		<center><b><?php echo strtoupper($dataSettings['settings_registrar']);?></b><br>
		School Registrar</center>
		</td>
		<td>Certified Correct by:<br><br><br>
		<center><b><?php echo strtoupper($dataSettings['settings_principal']);?></b><br>
		School Principal</center>
		</td>
		<td>Approved/Submitted by:<br><br><br>
		<center><b><?php echo strtoupper($dataSettings['settings_supervisor']);?></b><br>
		Public Schools District Supervisor</center>
		</td>
	</tr>
</table>



