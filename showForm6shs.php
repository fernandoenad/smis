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
		font-size: 0.6em;		
	}
	</style>	
</head>
<table border="0" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<td width="10%" align="right"><img src="./assets/images/deped_logo.png" width="80"></td>
		<td align="center" valign="top">
			<strong><font size="+1">School Form 6 Summarized Report of Learner Status as of End of Semester and School Year for Senior High School (SF6-SHS)</font></strong><br>
			<small><i>(This replaced Form 20)</i></small>
			<br><br>
			<table width="100%" border="0">
				<tr height="25">
					<td align="right" border="1"><font size="1">School Name &nbsp;</td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_full;?></td>
					<td width="10%" align="right" ><font size="1">School ID &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_code;?></td>
					<td align="right"><font size="1">District &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_district;?></td>
					<td width="8%" align="right"><font size="1">Division &nbsp;</td>
					<td align="center" colspan="2" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_division;?></td>
					<td width="8%" align="right"><font size="1">Region &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_reg_code;?></td>
					<td width="10%"></td>
				</tr>
				<tr height="25">				
					<td align="right"><font size="1">Semester</td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_sem;?></td>
					<td align="right"><font size="1">School Year</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?></td>
					
				</tr>				
			</table>
		</td>
		<td width="10%"><img src="./assets/images/sanhs_logo.png" width="80"></td>
	</tr>
</table>
<table border="1" cellspacing="0" cellpadding="1" width="1135">
	<tr align="center" height="40">
		<th rowspan="3" width="15%">GRADE LEVEL</th>
		<th colspan="9">END OF SEMESTER STATUS</th>
		<th colspan="9">END OF SCHOOL YEAR<br>(Fill up only at the end of the second semester.)</th>
	</tr>
	<tr align="center" height="20">
		<th colspan="3">COMPLETE</th>
		<th colspan="3">INCOMPLETE</th>
		<th colspan="3">TOTAL</th>
		<th colspan="3">REGULAR</th>
		<th colspan="3">IRREGULAR</th>
		<th colspan="3">TOTAL</th>
	</tr>
	<tr align="center" height="20">
		<th>MALE</th>
		<th>FEMALE</th>
		<th>TOTAL</th>
		<th>MALE</th>
		<th>FEMALE</th>
		<th>TOTAL</th>
		<th>MALE</th>
		<th>FEMALE</th>
		<th>TOTAL</th>
		<th>MALE</th>
		<th>FEMALE</th>
		<th>TOTAL</th>
		<th>MALE</th>
		<th>FEMALE</th>
		<th>TOTAL</th>
		<th>MALE</th>
		<th>FEMALE</th>
		<th>TOTAL</th>
	</tr>
	<?php
	$g1=11;
	$gn=12;
	for($g1;$g1<=$gn;$g1++){
	?>
	<tr align="center" height="25">
		<th colspan="19" align="left">GRADE <?php echo $g1;?></th>
	</tr>
	<tr align="center" height="25">
		<th colspan="19" align="left">TRACK/STRAND/COURSE</th>
	</tr>
	<?php
	$checkTrackStrands=dbquery("SELECT enrol_track, enrol_strand FROM studenroll WHERE (enrol_level='".$g1."' AND enrol_sy='".$current_sy."') GROUP BY enrol_strand ORDER BY enrol_track ASC, enrol_strand ASC");
	while ($dataTrackStrands=dbarray($checkTrackStrands)){
	?>
	<tr align="center" height="25">
		<th><?php echo $dataTrackStrands['enrol_track'];?> - <?php echo $dataTrackStrands['enrol_strand'];?></th>
		<?php
		$checkCompleteM=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (enrol_strand='".$dataTrackStrands['enrol_strand']."' AND studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' OR studenroll.enrol_status2='GRADUATED') AND student.stud_gender='MALE' AND enrol_level='".$g1."')");
		$countCompleteM=dbrows($checkCompleteM);
		?>
		<td><?php echo $countCompleteM;?></td>
		<?php
		$checkCompleteF=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (enrol_strand='".$dataTrackStrands['enrol_strand']."' AND studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' OR studenroll.enrol_status2='GRADUATED') AND student.stud_gender='FEMALE' AND enrol_level='".$g1."')");
		$countCompleteF=dbrows($checkCompleteF);
		?>
		<td><?php echo $countCompleteF;?></td>
		<td><?php echo $countCompleteM+$countCompleteF;?></td>
		<?php
		$checkIncCompleteM=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (enrol_strand='".$dataTrackStrands['enrol_strand']."' AND studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='CONDITIONAL') AND student.stud_gender='MALE' AND enrol_level='".$g1."')");
		$countIncCompleteM=dbrows($checkIncCompleteM);
		?>
		<td><?php echo $countIncCompleteM;?></td>
		<?php
		$checkIncCompleteF=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (enrol_strand='".$dataTrackStrands['enrol_strand']."' AND studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='CONDITIONAL') AND student.stud_gender='FEMALE' AND enrol_level='".$g1."')");
		$countIncCompleteF=dbrows($checkIncCompleteF);
		?>
		<td><?php echo $countIncCompleteF;?></td>
		<td><?php echo $countIncCompleteM+$countIncCompleteF;?></td>
		<td><?php echo $countCompleteM+$countIncCompleteM;?></td>
		<td><?php echo $countCompleteF+$countIncCompleteF;?></td>
		<td><?php echo $countCompleteM+$countIncCompleteM+$countCompleteF+$countIncCompleteF;?></td>
		
		<?php
		$checkCompleteM=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (enrol_strand='".$dataTrackStrands['enrol_strand']."' AND studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' OR studenroll.enrol_status2='GRADUATED') AND student.stud_gender='MALE' AND enrol_level='".$g1."')");
		$countCompleteM=dbrows($checkCompleteM);
		?>
		<td><?php echo $countCompleteM;?></td>
		<?php
		$checkCompleteF=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (enrol_strand='".$dataTrackStrands['enrol_strand']."' AND studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' OR studenroll.enrol_status2='GRADUATED') AND student.stud_gender='FEMALE' AND enrol_level='".$g1."')");
		$countCompleteF=dbrows($checkCompleteF);
		?>
		<td><?php echo $countCompleteF;?></td>
		<td><?php echo $countCompleteM+$countCompleteF;?></td>
		<?php
		$checkIncCompleteM=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (enrol_strand='".$dataTrackStrands['enrol_strand']."' AND studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='CONDITIONAL') AND student.stud_gender='MALE' AND enrol_level='".$g1."')");
		$countIncCompleteM=dbrows($checkIncCompleteM);
		?>
		<td><?php echo $countIncCompleteM;?></td>
		<?php
		$checkIncCompleteF=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (enrol_strand='".$dataTrackStrands['enrol_strand']."' AND studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='CONDITIONAL') AND student.stud_gender='FEMALE' AND enrol_level='".$g1."')");
		$countIncCompleteF=dbrows($checkIncCompleteF);
		?>
		<td><?php echo $countIncCompleteF;?></td>
		<td><?php echo $countIncCompleteM+$countIncCompleteF;?></td>
		<td><?php echo $countCompleteM+$countIncCompleteM;?></td>
		<td><?php echo $countCompleteF+$countIncCompleteF;?></td>
		<td><?php echo $countCompleteM+$countIncCompleteM+$countCompleteF+$countIncCompleteF;?></td>
	</tr>	
	<?php
	}
	?>
	<tr align="center" height="25" bgcolor="lightgray">
		<th>SUB TOTAL</th>
		<?php
		$checkCompleteM=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' OR studenroll.enrol_status2='GRADUATED') AND student.stud_gender='MALE' AND enrol_level='".$g1."')");
		$countCompleteM=dbrows($checkCompleteM);
		?>
		<td><?php echo $countCompleteM;?></td>
		<?php
		$checkCompleteF=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' OR studenroll.enrol_status2='GRADUATED') AND student.stud_gender='FEMALE' AND enrol_level='".$g1."')");
		$countCompleteF=dbrows($checkCompleteF);
		?>
		<td><?php echo $countCompleteF;?></td>
		<td><?php echo $countCompleteM+$countCompleteF;?></td>
		<?php
		$checkIncCompleteM=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='CONDITIONAL') AND student.stud_gender='MALE' AND enrol_level='".$g1."')");
		$countIncCompleteM=dbrows($checkIncCompleteM);
		?>
		<td><?php echo $countIncCompleteM;?></td>
		<?php
		$checkIncCompleteF=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='CONDITIONAL') AND student.stud_gender='FEMALE' AND enrol_level='".$g1."')");
		$countIncCompleteF=dbrows($checkIncCompleteF);
		?>
		<td><?php echo $countIncCompleteF;?></td>
		<td><?php echo $countIncCompleteM+$countIncCompleteF;?></td>
		<td><?php echo $countCompleteM+$countIncCompleteM;?></td>
		<td><?php echo $countCompleteF+$countIncCompleteF;?></td>
		<td><?php echo $countCompleteM+$countIncCompleteM+$countCompleteF+$countIncCompleteF;?></td>
		
		<?php
		$checkCompleteM=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' OR studenroll.enrol_status2='GRADUATED') AND student.stud_gender='MALE' AND enrol_level='".$g1."')");
		$countCompleteM=dbrows($checkCompleteM);
		?>
		<td><?php echo $countCompleteM;?></td>
		<?php
		$checkCompleteF=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' OR studenroll.enrol_status2='GRADUATED') AND student.stud_gender='FEMALE' AND enrol_level='".$g1."')");
		$countCompleteF=dbrows($checkCompleteF);
		?>
		<td><?php echo $countCompleteF;?></td>
		<td><?php echo $countCompleteM+$countCompleteF;?></td>
		<?php
		$checkIncCompleteM=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='CONDITIONAL') AND student.stud_gender='MALE' AND enrol_level='".$g1."')");
		$countIncCompleteM=dbrows($checkIncCompleteM);
		?>
		<td><?php echo $countIncCompleteM;?></td>
		<?php
		$checkIncCompleteF=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='CONDITIONAL') AND student.stud_gender='FEMALE' AND enrol_level='".$g1."')");
		$countIncCompleteF=dbrows($checkIncCompleteF);
		?>
		<td><?php echo $countIncCompleteF;?></td>
		<td><?php echo $countIncCompleteM+$countIncCompleteF;?></td>
		<td><?php echo $countCompleteM+$countIncCompleteM;?></td>
		<td><?php echo $countCompleteF+$countIncCompleteF;?></td>
		<td><?php echo $countCompleteM+$countIncCompleteM+$countCompleteF+$countIncCompleteF;?></td>
	</tr>
	<?php
	}
	?>
	<tr align="center" height="25">
		<th>TOTAL</th>
<?php
		$checkCompleteM=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' OR studenroll.enrol_status2='GRADUATED') AND student.stud_gender='MALE' AND enrol_level>10)");
		$countCompleteM=dbrows($checkCompleteM);
		?>
		<th><?php echo $countCompleteM;?></th>
		<?php
		$checkCompleteF=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' OR studenroll.enrol_status2='GRADUATED') AND student.stud_gender='FEMALE' AND enrol_level>10)");
		$countCompleteF=dbrows($checkCompleteF);
		?>
		<th><?php echo $countCompleteF;?></th>
		<th><?php echo $countCompleteM+$countCompleteF;?></th>
		<?php
		$checkIncCompleteM=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='CONDITIONAL') AND student.stud_gender='MALE' AND enrol_level>10)");
		$countIncCompleteM=dbrows($checkIncCompleteM);
		?>
		<th><?php echo $countIncCompleteM;?></th>
		<?php
		$checkIncCompleteF=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='CONDITIONAL') AND student.stud_gender='FEMALE' AND enrol_level>10)");
		$countIncCompleteF=dbrows($checkIncCompleteF);
		?>
		<th><?php echo $countIncCompleteF;?></th>
		<th><?php echo $countIncCompleteM+$countIncCompleteF;?></th>
		<th><?php echo $countCompleteM+$countIncCompleteM;?></th>
		<th><?php echo $countCompleteF+$countIncCompleteF;?></th>
		<th><?php echo $countCompleteM+$countIncCompleteM+$countCompleteF+$countIncCompleteF;?></th>
		
		<?php
		$checkCompleteM=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' OR studenroll.enrol_status2='GRADUATED') AND student.stud_gender='MALE' AND enrol_level>10)");
		$countCompleteM=dbrows($checkCompleteM);
		?>
		<th><?php echo $countCompleteM;?></th>
		<?php
		$checkCompleteF=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' OR studenroll.enrol_status2='GRADUATED') AND student.stud_gender='FEMALE' AND enrol_level>10)");
		$countCompleteF=dbrows($checkCompleteF);
		?>
		<th><?php echo $countCompleteF;?></th>
		<th><?php echo $countCompleteM+$countCompleteF;?></th>
		<?php
		$checkIncCompleteM=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='CONDITIONAL') AND student.stud_gender='MALE' AND enrol_level>10)");
		$countIncCompleteM=dbrows($checkIncCompleteM);
		?>
		<th><?php echo $countIncCompleteM;?></th>
		<?php
		$checkIncCompleteF=dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='CONDITIONAL') AND student.stud_gender='FEMALE' AND enrol_level>10)");
		$countIncCompleteF=dbrows($checkIncCompleteF);
		?>
		<th><?php echo $countIncCompleteF;?></th>
		<th><?php echo $countIncCompleteM+$countIncCompleteF;?></th>
		<th><?php echo $countCompleteM+$countIncCompleteM;?></th>
		<th><?php echo $countCompleteF+$countIncCompleteF;?></th>
		<th><?php echo $countCompleteM+$countIncCompleteM+$countCompleteF+$countIncCompleteF;?></th>
	</tr>

	
</table>

<br><br>
<table width="1135">
	<tr align="center" valign="top">
		<?php
		$checkSettings = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
		$dataSettings = dbarray($checkSettings);
		?>
		<td>Prepared and Submitted by:</td>
		<td><u><b><?php echo strtoupper($dataSettings['settings_principal']);?></b></u><br>SCHOOL HEAD</td>
		<td>Reviewed & Validated by: </td>
		<td><u><b><?php echo strtoupper($dataSettings['settings_representative']);?></u></b><br>DIVISION REPRESENTATIVE</td>
		<td>Noted by:</td>
		<td><u><b><?php echo strtoupper($dataSettings['settings_superintendent']);?></u></b><br>SCHOOLS DIVISION SUPERINTENDENT</td>
	</tr>
	<tr>
		<th colspan="6" align="left">GUIDELINES:</th>
	</tr>
	<tr align="left">
		<td colspan="6">
		1. After receiving and validating the Report for Promotion submitted by the class adviser, the School Head shall compute the grade level total and school total.<br>																					
		2. This report together with the copy of Report for Promotion submitted by the class adviser shall be forwarded to the Division Office by the end of the school year.<br>																					
		3. The Report on Promotion per grade level is reflected in the End of School Year Report of GESP/GSSP.<br>																					
		4. Protocols of validation & submission is under the discretion of the Schools Division Superintendent.																					

		</td>
	</tr>	
</table>



