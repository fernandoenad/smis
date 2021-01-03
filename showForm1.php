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
<table border="0" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<td width="10%" align="right"></td>
		<td align="center" valign="top">
			<strong><font size="+1">School Form 1 (SF 1) School Register</font></strong><br>
			<small><i>This replaces  Form 1, Master List & STS Form 2-Family Background and Profile)</i></small>
			<br><br>
			<table width="100%" border="0">
				<tr height="25">
					<td width="10%" align="right" ><font size="1">School ID &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_code;?></td>
					<td width="5%"></td>
					<td><font size="1">Region VII</td>
					<td width="8%" align="right"><font size="1">Division &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_division;?></td>
					<td width="5%"></td>
					<td width="8%" align="right"><font size="1">District &nbsp;</td>
					<td align="center" colspan="2" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_district;?></td>
					<td></td>
				</tr>
				<tr height="25">
					<td align="right" border="1"><font size="1">School Name &nbsp;</td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_full;?></td>
					<td align="right"><font size="1">School Year &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?></td>
					<td></td>
					<td align="right"><font size="1">Grade Level &nbsp;</td>
					<?php
					$resultLevel = dbquery("SELECT * FROM section WHERE (section_name='".$_GET['classProfile']."' AND section_sy='".$_GET['enrol_sy']."')");
					$dataLevel = dbarray($resultLevel);
					?>
					<td width="5%" align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $dataLevel['section_level'];?></td>
					<td width="12%" align="right"><font size="1">Section &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $_GET['classProfile'];?></td>
				</tr>				
			</table>
		</td>
		<td width="10%"></td>
	</tr>
</table><br>
<table border="1" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<th rowspan="2">#</th>
		<th rowspan="2">LRN</th>
		<th rowspan="2" width="13%">NAME (Last Name, First Name, Middle Name)</th>
		<th rowspan="2">Sex</th>
		<th rowspan="2" width="3%">BIRTH DATE (mm/ dd/ yyyy)</th>
		<th rowspan="2">AGE as of 1st Friday June</th>
		<th rowspan="2" width="5%">MOTHER TONGUE (Grade 1 to 3 Only)</th>
		<th rowspan="2">IP (Ethnic Group)</th>
		<th rowspan="2">RELIGION</th>
		<th colspan="4">ADDRESS</th>
		<th colspan="2">PARENTS</th>
		<th colspan="2">GUARDIAN <br>(if not Parent)</th>
		<th rowspan="2">Contact Number of Parent or Guardian</th>
		<th >REMARKS</th>
	</tr>
	<tr>		
		<th width="5%">House #/ Street/ Sitio/ Purok</th>
		<th width="5%">Barangay</th>
		<th width="5%">Municipa- lity/ City</th>
		<th width="5%">Province</th>
		<th width="8%">Father's Name (Last Name, First Name, Middle Name)</th>
		<th width="8%">Mother's Maiden Name (Last Name, First Name, Middle </th>
		<th width="8%">Name</th>
		<th width="5%">Relation- ship</th>
		<th>(Please refer to the legend on last page)</th>
	</tr>
	<?php
	$i=1;
	$MLEi=0;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='MALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="25">
		<td><?php echo $i;?></td>
		<td><?php echo $data['stud_lrn'];?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
		<td><?php echo substr($data['stud_gender'],0,1);?></td>
		<?php 
		$phpdate_bdate = strtotime($data['stud_bdate']);
		$phpdate_bosy = strtotime($current_bosy);
		?>
															
		<td><?php echo $mysqldate = date('m/d/Y', $phpdate_bdate);?></td>
		<?php
		$date1 = strtotime($current_bosy);
		$date2 = strtotime($data['stud_bdate']);
		$time_difference = $date1 - $date2;
		$seconds_per_year = 60*60*24*365;
		$years = $time_difference / $seconds_per_year;
		?>
		<td><?php echo substr($years,0,2);?></td>
		<td><?php echo $data['stud_dialect'];?></td>
		<td><?php echo $data['stud_ethnicity'];?></td>
		<td><?php echo $data['stud_religion'];?></td>
		<?php
		$myString = $data['stud_residence'];
		$myArray = explode(',', $myString);
		?>
		<td>-</td>
		<td><?php echo $myArray[0];?></td>
		<td><?php echo $myArray[1];?></td>
		<td><?php echo $myArray[2];?></td>
		<?php
		$result2 = dbquery("select * from studcontacts where studCont_stud_no='".$data['stud_no']."' order by studCont_no asc");
		$data2 = dbarray($result2);
		?>
		<td><?php echo strtoupper($data2['studCont_stud_flname'].", ".$data2['studCont_stud_ffname']." ".$data2['studCont_stud_fmname']);?></td>
		<td><?php echo strtoupper($data2['studCont_stud_mlname'].", ".$data2['studCont_stud_mfname']." ".$data2['studCont_stud_mmname']);?></td>
		<td><?php echo strtoupper($data2['studCont_stud_glname'].", ".$data2['studCont_stud_gfname']." ".$data2['studCont_stud_gmname']);?></td>
		<td><?php echo strtoupper($data2['studCont_stud_grelation']);?></td>
		<td><?php echo strtoupper($data2['studCont_stud_gcontact']);?></td>
		<td><?php echo ($data['enrol_status1']=="ENROLLED")?"":$data['enrol_remarks'];?><?php echo (substr($data['enrol_remarks'],0,2))=="LE"?$data['enrol_remarks']:"";?>
		<?php
		$checkFirstDay = dbquery("SELECT * FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$data['stud_no']."')");
		$dataFirstDay = dbarray($checkFirstDay);
		$phpdate = strtotime($dataFirstDay['sch_firstday']);
		echo "FD:". $mysqldate = date('m/d', $phpdate);
		echo ", CCT:".$data['stud_cct'];
		?>	
		</td>
	</tr>
	<?php 
	if(substr($data['enrol_remarks'],0,2)=="LE"){
		$MLEi++;
	}
	$i++;
	} ?>
	<tr height="25">
		<td></td>
		<td align="right"><strong><?php echo $i-1;?></strong></td>
		<td><strong><=== TOTAL MALE</strong></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<?php
	$i=1;
	$FLEi=0;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='FEMALE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="25">
		<td><?php echo $i;?></td>
		<td><?php echo $data['stud_lrn'];?></td>
		<td><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
		<td><?php echo substr($data['stud_gender'],0,1);?></td>
		<?php 
		$phpdate_bdate = strtotime($data['stud_bdate']);
		$phpdate_bosy = strtotime($current_bosy);
		?>
															
		<td><?php echo $mysqldate = date('m/d/Y', $phpdate_bdate);?></td>
		<?php
		$date1 = strtotime($current_bosy);
		$date2 = strtotime($data['stud_bdate']);
		$time_difference = $date1 - $date2;
		$seconds_per_year = 60*60*24*365;
		$years = $time_difference / $seconds_per_year;
		?>
		<td><?php echo substr($years,0,2);?></td>
		<td><?php echo $data['stud_dialect'];?></td>
		<td><?php echo $data['stud_ethnicity'];?></td>
		<td><?php echo $data['stud_religion'];?></td>
		<?php
		$myString = $data['stud_residence'];
		$myArray = explode(',', $myString);
		?>
		<td>-</td>
		<td><?php echo $myArray[0];?></td>
		<td><?php echo $myArray[1];?></td>
		<td><?php echo $myArray[2];?></td>
		<?php
		$result2 = dbquery("select * from studcontacts where studCont_stud_no='".$data['stud_no']."' order by studCont_no asc");
		$data2 = dbarray($result2);
		?>
		<td><?php echo strtoupper($data2['studCont_stud_flname'].", ".$data2['studCont_stud_ffname']." ".$data2['studCont_stud_fmname']);?></td>
		<td><?php echo strtoupper($data2['studCont_stud_mlname'].", ".$data2['studCont_stud_mfname']." ".$data2['studCont_stud_mmname']);?></td>
		<td><?php echo strtoupper($data2['studCont_stud_glname'].", ".$data2['studCont_stud_gfname']." ".$data2['studCont_stud_gmname']);?></td>
		<td><?php echo strtoupper($data2['studCont_stud_grelation']);?></td>
		<td><?php echo strtoupper($data2['studCont_stud_gcontact']);?></td>
		<td><?php echo ($data['enrol_status1']=="ENROLLED"?"":$data['enrol_remarks']);?><?php echo (substr($data['enrol_remarks'],0,2))=="LE"?$data['enrol_remarks']:"";?>
		<?php
		$checkFirstDay = dbquery("SELECT * FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$data['stud_no']."')");
		$dataFirstDay = dbarray($checkFirstDay);
		$phpdate = strtotime($dataFirstDay['sch_firstday']);
		echo "FD:". $mysqldate = date('m/d', $phpdate);
		echo ", CCT:".$data['stud_cct'];
		?>
		</td>
	</tr>
	<?php 
	if(substr($data['enrol_remarks'],0,2)=="LE"){
		$FLEi++;
	}
	$i++;
	} ?>
	<tr height="25">
		<td></td>
		<td align="right"><strong><?php echo $i-1;?></strong></td>
		<td><strong><=== TOTAL FEMALE<strong></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>	
</table><br>
<table>
	<tr>
		<td>
		<strong>List and Code of Indicators under REMARKS</strong></td>

		<table border="1" cellspacing="0" cellpadding="1" width="1135">
			<tr>
				<th width="8%">Indicator</th>
				<th align="center" width="3%">Code</th>
				<th width="20%">Required Information</th>
				<th rowspan="5" style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px"></th>
				<th align="center" width="3%">Code</th>
				<th width="20%">Required Information</th>
				<th width="5%">Registered</th>
				<th width="3%">BoSY</th>
				<th width="3%">EoSY</th>
				<th rowspan="5" style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px"></th>
				<td width="15%" align="left" style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px">Prepared by:</td>
				<th style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px"></th>
				<td width="15%" align="left" style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px">Certified Correct:</td>
			</tr>
			<tr height="25">
				<td>Transferred Out</td>
				<td align="center">T/O</td>
				<td>Name of  Public (P) Private (PR) School  & Effectivity Date</td>
				<td align="center">CCT</td>
				<td>CCT Control/reference number & Effectivity Date</td>
				<td align="center">MALE</td>
				<?php
				$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='ENROLLED' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
				$rowCountSYM = dbrows($resultCountSYM);
				?>
				<td align="center"><?php echo $rowCountSYM-$MLEi; ?></td>
				<td align="center"><?php echo $rowCountSYM; ?></td>
				<td align="center" valign="bottom" style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px"></td>
				<td style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px"></td>
				<td align="center" valign="bottom" style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px"></td>
			</tr>
			<tr height="25">
				<td>Transferred IN</td>
				<td align="center">T/I</td>
				<td>Name of  Public (P) Private (PR) School  & Effectivity Date</td>
				<td align="center">B/A</td>
				<td>Name of school last attended & Year</td>
				<td align="center">FEMALE</td>
				<?php
				$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='ENROLLED' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
				$rowCountSYF = dbrows($resultCountSYF);						
				?>				
				<td align="center"><?php echo $rowCountSYF-$FLEi; ?></td>
				<td align="center"><?php echo $rowCountSYF; ?></td>
				<?php
				$resultAdviser = dbquery("SELECT * FROM users WHERE user_no='".$dataLevel['section_adviser']."'");
				$dataAdviser = dbarray($resultAdviser);
				?>
				<td align="center" valign="bottom" style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px"><u><strong><?php echo strtoupper($dataAdviser['user_fullname']); ?></strong></u></td>
				<td style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px"></td>
				<td align="center" valign="bottom" style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px"><u><strong><?php echo strtoupper($current_principal); ?></strong></u></td>
			</tr>
			<tr>
				<td>Dropped</td>
				<td align="center">DRP</td>
				<td>Name of  Public (P) Private (PR) School  & Effectivity Date</td>
				<td align="center">LWD</td>
				<td>Specify</td>
				<td align="center" rowspan="2">TOTAL</td>
				<?php
				$resultCountSYT = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='ENROLLED' AND enrol_section='".$_GET['classProfile']."')");
				$rowCountSYT = dbrows($resultCountSYT);						
				?>					
				<td align="center" rowspan="2"><?php echo $rowCountSYT-($MLEi+$FLEi); ?></td>
				<td align="center" rowspan="2"><?php echo $rowCountSYT; ?></td>
				<td align="center" valign="top" style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px"><small>(Signature of Adviser <br>over Printed Name)</small></td>
				<td style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px"></td>
				<td align="center" valign="top" style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px"><small>(Signature of School Head <br>over Printed Name)</small></td>
			</tr>	
			<tr >
				<td>Late Enrollment</td>
				<td align="center">LE</td>
				<td>Reason (Enrollment beyond 1st Friday of June)</td>
				<td align="center">ACL</td>
				<td>Specify Level & Effectivity Data</td>
				<td align="center" style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px">BoSY Date: <u><?php echo $current_bosy; ?></u> <br>EoSY Date: <u><?php echo $current_eosy; ?></u><br><br></td>
				<td style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px"></td>
				<td align="center" style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px">BoSY Date: <u><?php echo $current_bosy; ?></u> <br>EoSY Date: <u><?php echo $current_eosy; ?></u><br><br></td>
			</tr>		
		</table>
		<table width="1135">
			<tr>
				<td>Generated on: <?php echo date('l, F, d, Y');?></td>
				<td width="15%" align="center">_____________________________<br><b>Generated thru LIS</b></td>
			</tr>
		</table>