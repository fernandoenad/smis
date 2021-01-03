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
			<strong><font size="+1">School Form 5 (SF 5) Report on Promotion and Level of Proficiency & Achievement</font></strong><br>
			<small><i>Revised to conform with the instructios of DepEd Order 8, s. 2015</i></small>
			<br><br>
			<table width="100%" border="0">
				<tr height="25">
					<td width="10%" align="right" ><font size="1">Region &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_region;?></td>
					<td width="5%"></td>
					<td></td>
					<td width="8%" align="right"><font size="1">Division &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_division;?></td>
					<td width="5%"></td>
					<td width="8%" align="right"><font size="1">District</td>
					<td align="center" colspan="2" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_district;?></td>
					<td align="center">
						<font size="1">			
						<?php 
						// echo $mysqldate = date("F");
						?>
					</td>
				</tr>			
				<tr height="25">
					<td width="10%" align="right" ><font size="1">School ID &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_code;?></td>
					<td width="5%"></td>
					<td></td>
					<td width="8%" align="right"><font size="1">School Year &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?></td>
					<td width="5%"></td>
					<td width="8%" align="right"><font size="1">Curriculum &nbsp;</td>
					<td align="center" colspan="2" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1">K to 12 Curriculum</td>
					<td align="center">
						<font size="1">			
						<?php 
						// echo $mysqldate = date("F");
						?>
					</td>
				</tr>
				<tr height="25">
					<td align="right" border="1"><font size="1">School Name &nbsp;</td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_full;?></td>
					<td align="right"><font size="1"></td>
					<td align="center"></td>
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
</table>
<table border="0" cellspacing="0" cellpadding="1" width="1135">
<tr><td valign="top">
	<table border="1" cellspacing="0" cellpadding="1" >
	<tr>
		<th width="1%">LRN</th>
		<th width="8%">LEARNER'S NAME <br>(Last Name, First Name, Middle Name)</th>
		<th width="3%">GENERAL AVERAGE <br>(Whole numbers for non-honor)</th>
		<th width="3%">ACTION TAKEN: PROMOTED, CONDITIONAL, or RETAINED</th>
		<th width="10%" colspan="2">Did Not Meet Expectations of the ff. Learning Area/s as of end of current School Year</th>
	</tr>
	<tr height="25">
		<tH><strong>MALE</strong></tH>
		<tH><strong></strong></tH>
		<tH></tH>
		<tH></tH>
		<tH colspan="2"></tH>
	</tr>

	<?php
	$i=1;
	$ceM=0;
	$cdM=0;
	$ccM=0;
	$cbM=0;
	$caM=0;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='MALE' AND studenroll.enrol_status1!='INACTIVE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="22">
		<td align="right"><font size="1"><?php echo $data['stud_lrn'];?></td>
		<td><font size="1"><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
		<td align="right"><font size="2"><?php echo number_format($data['enrol_average'],0);?>
		<td align="left"><font size="1"><?php echo ($data['enrol_status1']!="PROMOTED"?"":($data['enrol_status2']=="IRREGULAR"?"CONDITIONAL":($data['enrol_status2']=="GRADUATED"?"PROMOTED":$data['enrol_status2'])));?>
		<?php
		if($data['enrol_gradawards']!="-"){
			if(number_format($data['enrol_average'],0)>=98){
				echo "WITH HIGHEST HONORS";
			}
			else if(number_format($data['enrol_average'],0)>=95){
				echo "WITH HIGH HONORS";
			}
			else if(number_format($data['enrol_average'],0)>=90){
				echo "WITH HONORS";
			}
		}
		?>
		</td>
		<td colspan="2"><font size="2"><?php echo ($data['enrol_remarks']=="-"?"":strtoupper($data['enrol_remarks']));?></td>
		

	</tr>
	<?php 
	if (round($data['enrol_average'],0)<75){
		$ceM++; 
	}
	else if (round($data['enrol_average'],0)<80){
		$cdM++; 
	}
	else if (round($data['enrol_average'],0)<85){
		$ccM++; 
	}
	else if (round($data['enrol_average'],0)<89.5){
		$cbM++; 
	}
	else {
		$caM++;
	}
		$i++;
	} 
	$m = $i-1;
	?>
	<tr height="25">
		<td align="right"><strong><?php echo $m;?></strong></td>
		<td align="left"><strong><=== TOTAL MALE</strong></td>
		<td bgcolor="lightblue"></td>
		<td bgcolor="lightblue"></td>
		<td bgcolor="lightblue" colspan="2"></td>
		

	</tr>
	</tr>
	<tr height="25">
		<tH><strong>FEMALE</strong></tH>
		<tH><strong></strong></tH>
		<tH></tH>
		<tH></tH>
		<th colspan="2"></th>
	</tr>
	<?php
	$i=1;
	$ii=1;
	$ceF=0;
	$cdF=0;
	$ccF=0;
	$cbF=0;
	$caF=0;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='FEMALE' AND studenroll.enrol_status1!='INACTIVE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="22">
		<td align="right"><font size="1"><?php echo $data['stud_lrn'];?></td>
		<td><font size="1"><?php echo $data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname'];?></td>
		<td align="right"><font size="2"><?php echo number_format($data['enrol_average'],0);?>
		<td align="left"><font size="1"><?php echo ($data['enrol_status1']!="PROMOTED"?"":($data['enrol_status2']=="IRREGULAR"?"CONDITIONAL":($data['enrol_status2']=="GRADUATED"?"PROMOTED":$data['enrol_status2'])));?>
		<?php
		if($data['enrol_gradawards']!="-"){
			if(number_format($data['enrol_average'],0)>=98){
				echo "WITH HIGHEST HONORS";
			}
			else if(number_format($data['enrol_average'],0)>=95){
				echo "WITH HIGH HONORS";
			}
			else if(number_format($data['enrol_average'],0)>=90){
				echo "WITH HONORS";
			}
		}
		?>
		</td>
		<td colspan="2"><font size="2"><?php echo ($data['enrol_remarks']=="-"?"":strtoupper($data['enrol_remarks']));?></td>
	</tr>
	<?php 
	if (round($data['enrol_average'],0)<75){
		$ceF++; 
	}
	else if (round($data['enrol_average'],0)<80){
		$cdF++; 
	}
	else if (round($data['enrol_average'],0)<85){
		$ccF++; 
	}
	else if (round($data['enrol_average'],0)<89.5){
		$cbF++; 
	}
	else {
		$caF++;
	}
		$ii++;
	} 	
	$f = $ii-1;
	?>
	<tr height="25">
		<td align="right"><strong><?php echo $f;?></strong></td>
		<td align="left"><strong><=== TOTAL FEMALE</strong></td>
		<td bgcolor="lightblue"></td>
		<td bgcolor="lightblue"></td>
		<td bgcolor="lightblue" colspan="2"></td>
	</tr>
	<tr height="25">
		<td align="right"><strong><?php echo $m+$f;?></strong></td>
		<td align="left"><strong><===COMBINED</strong></td>
		<td bgcolor="lightblue"></td>
		<td bgcolor="lightblue"></td>
		<td bgcolor="lightblue" colspan="2"></td>
	</tr>
	</tr>	
</table>
	</td>
	<td valign="top" width="25%"><br><br><br><br><br>
		<table width="100%" border="1" cellpadding="0" cellspacing="0">
			<tr height="20"><th colspan="4">SUMMARY TABLE</th></tr>
			<tr height="30"><th width="10%">STATUS</th><th width="6%">MALE</th><th width="5%">FEMALE</th><th width="5%">TOTAL</th></tr>
				<?php
				$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' or studenroll.enrol_status2='GRADUATED') AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
				$rowCountSYM = dbrows($resultCountSYM);
				$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' or studenroll.enrol_status2='GRADUATED')  AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
				$rowCountSYF = dbrows($resultCountSYF);	
				?>
			<tr height="30" align="center"><th>PROMOTED</th><td><font size="2"><?php echo $rowCountSYM;?></td><td><font size="2"><?php echo $rowCountSYF;?></td><td><font size="2"><?php echo $rowCountSYM+$rowCountSYF; ?></td><tr>
				<?php
				$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
				$rowCountSYM = dbrows($resultCountSYM);
				$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
				$rowCountSYF = dbrows($resultCountSYF);	
				?>
			<tr height="30" align="center"><th><i>CONDITIONALLY PROMOTED</i></th><td><font size="2"><?php echo $rowCountSYM;?></td><td><font size="2"><?php echo $rowCountSYF;?></td><td><font size="2"><?php echo $rowCountSYM+$rowCountSYF; ?></td><tr>
				<?php
				$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
				$rowCountSYM = dbrows($resultCountSYM);
				$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
				$rowCountSYF = dbrows($resultCountSYF);	
				?>
			<tr height="30" align="center"><th>RETAINED</th><td><font size="2"><?php echo $rowCountSYM;?></td><td><font size="2"><?php echo $rowCountSYF;?></td><td><font size="2"><?php echo $rowCountSYM+$rowCountSYF; ?></td><tr>
		</table><br>
		<table width="100%" border="1" cellpadding="0" cellspacing="0">
			<tr height="35"><td colspan="4" align="center"><b><font size="-10">LEVEL OF PROGRESS AND ACHIEVEMENT <br>(Based on Learners' General Average)</font></b></td></tr>
			<tr height="35"><th width="7%">Descriptors & Grading Scale</th><th width="5%">MALE</th><th width="5%">FEMALE</th><th width="5%">TOTAL</th></tr>
			<tr height="35" align="center"><th>Did Not Meet <br>Expectations <br>(74 and below)</th><td><font size="2"><?php echo $ceM; ?></td><td><font size="2"><?php echo $ceF; ?></td><td><font size="2"><?php echo  $ceM+$ceF;?></td><tr>
			<tr height="35" align="center"><th>Fairly <br>Satisfactory <br>(75-79)</th><font size="2"><td><font size="2"><?php echo $cdM; ?></td><td><font size="2"><?php echo $cdF; ?></td><td><font size="2"><?php echo  $cdM+$cdF;?></td><tr>
			<tr height="35" align="center"><th>Satisfactory <br>(80-84)</th><td><font size="2"><?php echo $ccM; ?></td><td><font size="2"><?php echo $ccF; ?></td><td><font size="2"><?php echo  $ccM+$ccF;?></td><tr>
			<tr height="35" align="center"><th>Very <br>Satisfactory <br>(85-89)</th><td><font size="2"><?php echo $cbM; ?></td><td><font size="2"><?php echo $cbF; ?></td><td><font size="2"><?php echo  $cbM+$cbF;?></td><tr>
			<tr height="35" align="center"><th>Outstanding <br>(90-100)</th><td><font size="2"><?php echo $caM; ?></td><td><font size="2"><?php echo $caF; ?></td><td><font size="2"><?php echo  $caM+$caF;?></td><tr>			
		</table><br>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td>PREPARED BY:</td></tr>
			<tr>
				<td align="center"><br><br><br>
				<strong>
				<?php
				$resultAdviser = dbquery("SELECT * FROM users WHERE user_no='".$dataLevel['section_adviser']."'");
				$dataAdviser = dbarray($resultAdviser);
				echo strtoupper($dataAdviser['user_fullname']);
				?>
				</strong>
				<br>Class Adviser<br>(Name and Signature)<br><br>
				</td>
			</tr>
			<?php 
			$checkDetails = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
			$dataDetails = dbarray($checkDetails);
			?>
			<tr><td>CERTIFIED CORRECT AND SUBMITTED BY:</td></tr>
			<tr>
				<td align="center"><br><br><br>
				<strong>
				<?php echo strtoupper($dataDetails['settings_principal']);	?>
				</strong>
				<br>School Head<br>(Name and Signature)<br><br>
				</td>
			</tr>
			<tr><td>REVIEWED BY:</td></tr>
			<tr>
				<td align="center"><br><br><br>
				<strong>
				<?php echo strtoupper($dataDetails['settings_representative']);	?>
				</strong>
				<br>Division Representative<br>(Name and Signature)				
				</td>
			</tr>
			<tr>
				<td align="center"><br><hr>
				Generated thru LIS				
				</td>
			</tr>
			<tr><th align="left"><br><br>GUIDELINES:</th></tr>
			<tr>
				<td><i>
				1.  Do not include Dropouts and Transferred Out (D.O.4, 2014).<br>
				2.  To be prepared by the Adviser. Final rating per learning area should be taken from the record of subject teachers. The class adviser should compute for the General Average. (leave it blank for *conditionally promoted).<br>
				3.  On the summary table, reflect the total number of learners PROMOTED (Final Grade of at least 75% in ALL learning areas), RETAINED (Did not meet expectations in three (3) or more learning areas) and *CONDITIONALLY PROMOTED (*did not meet expectations in not more than two (2) learning areas) and the Level of Progress and Achievement according to the individual General Average. All provisions on classroom assessment and the grading system in the said Order shall be in effect for all grade levels - Deped Order 29, s. 2015.<br>
				4.  Incomplete Learning Areas. The 1st sub-column refers to learning area/s that failed from previous SY but had been completed in the current SY. The 2nd sub-column presented the list of learning area/s that did not meet expectation during the current SY.<br>
				5.  Protocols of validation & submission is under the discretion of the Schools Division Superintendent.<br>		
				6.  TE - Temporary Enrolled <br>
				</i></td>
			</tr>
			<tr>
				<td align="right"><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				School Form 5: Page 2 of 2
				</td>
			</tr>			
		</table>
	</td>
	</tr>
</table>

