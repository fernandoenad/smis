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
		<td width="10%" align="right"><img src="./assets/images/deped_logo.png" width="80"></td>
		<td align="center" valign="top">
			<strong><h1> School Form 5A End of Semester and School Year Status of Learners for Senior High School (SF5A-SHS) </h1></strong>
			<br>
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
					<td width="8%"></td>
				</tr>
				<tr height="25">
					<td align="right"><font size="1">Semester &nbsp;</td>
					<td align="center" colspan="2" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_sem;?></td>
					<td align="right"><font size="1">School Year &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?></td>
					<td align="right"><font size="1">Grade Level &nbsp;</td>
					<?php
					$resultLevel = dbquery("SELECT * FROM section WHERE (section_name='".$_GET['classProfile']."' AND section_sy='".$_GET['enrol_sy']."')");
					$dataLevel = dbarray($resultLevel);
					?>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $dataLevel['section_level'];?></td>
					<td align="right" colspan="2"><font size="1">Track and Strand &nbsp;</td>
					<td align="center" colspan="4" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo substr($dataLevel['section_track'],4);?></td>
					<td width="8%"></td>
				</tr>
				<tr height="25">
					<td align="right"><font size="1">Section &nbsp;</td>
					<td align="center" colspan="2" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $_GET['classProfile'];?></td>
					<?php
					$checkCourse = dbquery("select * from studenroll where (enrol_sy='".$current_sy."' and enrol_section='".$_GET['classProfile']."') order by enrol_admitdate asc limit 1");
					$dataCourse = dbarray($checkCourse);
					?>
					<td align="right" colspan="2"><font size="1">Course (For TVL Only) &nbsp;</td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo (substr($_GET['classProfile'],0,3)=="TVL"?$dataCourse['enrol_combo']:"");?></td>
					<td width="8%"></td>
					<td align="right"><font size="1"></td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 0px; BORDER-TOP: black solid 0px; BORDER-LEFT: black solid 0px; BORDER-BOTTOM: black solid 0px"><font size="1"></td>
					<td width="8%"></td>
				</tr>				
			</table>
		</td>
		<td width="10%"><img src="./assets/images/deped_word.png" width="80"></td>
	</tr>
</table>
<table border="0" cellspacing="0" cellpadding="1" width="1135">
<tr><td valign="top">
	<table border="1" cellspacing="0" cellpadding="1" >
	<tr>
		<th width="1%">No.</th>
		<th width="1%">LRN</th>
		<th width="8%">LEARNER'S NAME <br><small>(Last Name, First Name, Middle Name)</small></th>
		<th width="10%">BACK SUBJECT/S<br><small>(List down subjects where learner obtained a rating below 75%)</small></th>
		<th width="3%">END OF SEMESTER STATUS <br><small>(Complete/ Incomplete)</small></th>
		<th width="3%">END OF SCHOOL YEAR STATUS <br><small>(Regular/ Irregular)</small></th>
		
	</tr>
	<tr height="25">
		<th align="left"><strong></strong></th>
		<th align="center"><strong>MALE</strong></th>
		<th align="left"><strong></strong></th>
		<th align="left"><strong></strong></th>
		<th align="left"><strong></strong></th>
		<th align="left"><strong></strong></th>
	</tr>

	<?php
	$i=1;
	$ceM=0;
	$cdM=0;
	$ccM=0;
	$cbM=0;
	$caM=0;
	$result= dbquery("SELECT * FROM grade inner join studenroll on grade_stud_no=enrol_stud_no INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND grade_sem='".$current_sem."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='MALE' AND studenroll.enrol_status1!='INACTIVE') GROUP BY grade_stud_no ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="22">
		<td><?php echo $i;?></td>
		<td align="right"><font size="1"><?php echo $data['stud_lrn'];?></td>
		<td><font size="1"><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
		<td><font size="2"><?php echo ($data['enrol_remarks']=="-" || $data['enrol_remarks']=="OK"?"":strtoupper($data['enrol_remarks']));?></td>
		<?php
		$checkFails=dbquery("select * from grade where (grade_sy='".$current_sy."' AND grade_stud_no='".$data['stud_no']."' AND grade_sem='".$current_sem."')");
		$countFails=dbrows($checkFails);
		?>
		<td align="center"><font size="2"><?php echo ($data['enrol_status1']=="PROMOTED"?($countFails==0?"-":($data['enrol_remarks']=="-"?"COMPLETE":"INCOMPLETE")):"");?></td>
		<?php
		$checkFails=dbquery("select * from grade where (grade_sy='".$current_sy."' AND grade_stud_no='".$data['stud_no']."' AND grade_final<75)");
		$countFails=dbrows($checkFails);
		?>
		<td align="center"><font size="2"><?php echo ($data['enrol_status1']=="ENROLLED"?"":($countFails==0?"REGULAR":"IRREGULAR"))?></td>
		<!--
		<td align="center"><font size="2"><?php echo ($eoyupdate==true?($data['enrol_status2']=="GRADUATED" || $data['enrol_status2']=="PROMOTED"?"COMPLETE":"INCOMPLETE"):"");?></td>
		<td align="center"><font size="2"><?php echo ($eoyupdate==true?($data['enrol_status2']=="GRADUATED" || $data['enrol_status2']=="PROMOTED"?"REGULAR":"IRREGULAR"):"");?></td>
		-->
		

	</tr>
	<?php 
	if ($data['enrol_average']<75){
		$ceM++; 
	}
	else if ($data['enrol_average']<80){
		$cdM++; 
	}
	else if ($data['enrol_average']<85){
		$ccM++; 
	}
	else if ($data['enrol_average']<89.5){
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
		<th align="left"><strong></strong></th>
		<th align="center"><strong><?php echo $m;?></strong></th>
		<th align="left"><strong><=== TOTAL MALE</strong></th>
		<th align="left" bgcolor="lightblue"><strong></strong></th>
		<th align="left" bgcolor="lightblue"><strong></strong></th>
		<<th align="left" bgcolor="lightblue"><strong></strong></th>
	</tr>
	<tr height="25">
		<th align="left"><strong></strong></th>
		<th align="center"><strong>FEMALE</strong></th>
		<th align="left"><strong></strong></th>
		<th align="left"><strong></strong></th>
		<th align="left"><strong></strong></th>
		<th align="left"><strong></strong></th>
	</tr>
	<?php
	$ii=1;
	$ceF=0;
	$cdF=0;
	$ccF=0;
	$cbF=0;
	$caF=0;
	$result= dbquery("SELECT * FROM grade inner join studenroll on grade_stud_no=enrol_stud_no INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND grade_sem='".$current_sem."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='FEMALE' AND studenroll.enrol_status1!='INACTIVE') GROUP BY grade_stud_no ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="22">
		<td><?php echo $ii;?></td>
		<td align="right"><font size="1"><?php echo $data['stud_lrn'];?></td>
		<td><font size="1"><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
		<td><font size="2"><?php echo ($data['enrol_remarks']=="-" || $data['enrol_remarks']=="OK"?"":strtoupper($data['enrol_remarks']));?></td>
		<?php
		$checkFails=dbquery("select * from grade where (grade_sy='".$current_sy."' AND grade_stud_no='".$data['stud_no']."' AND grade_sem='".$current_sem."')");
		$countFails=dbrows($checkFails);
		?>
		<td align="center"><font size="2"><?php echo ($data['enrol_status1']=="PROMOTED"?($countFails==0?"-":($data['enrol_remarks']=="-"?"COMPLETE":"INCOMPLETE")):"");?></td>
		<?php
		$checkFails=dbquery("select * from grade where (grade_sy='".$current_sy."' AND grade_stud_no='".$data['stud_no']."' AND grade_final<75)");
		$countFails=dbrows($checkFails);
		?>
		<td align="center"><font size="2"><?php echo ($data['enrol_status1']=="ENROLLED"?"":($countFails==0?"REGULAR":"IRREGULAR"))?></td>
		<!--
		<td align="center"><font size="2"><?php echo ($eoyupdate==true?($data['enrol_status2']=="GRADUATED" || $data['enrol_status2']=="PROMOTED"?"COMPLETE":"INCOMPLETE"):"");?></td>
		<td align="center"><font size="2"><?php echo ($eoyupdate==true?($data['enrol_status2']=="GRADUATED" || $data['enrol_status2']=="PROMOTED"?"REGULAR":"IRREGULAR"):"");?></td>
		-->
	</tr>
	<?php 
	if ($data['enrol_average']<75){
		$ceF++; 
	}
	else if ($data['enrol_average']<80){
		$cdF++; 
	}
	else if ($data['enrol_average']<85){
		$ccF++; 
	}
	else if ($data['enrol_average']<89.5){
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
		<th align="left"><strong></strong></th>
		<th align="center"><strong><?php echo $f;?></strong></th>
		<th align="left"><strong><=== TOTAL FEMALE</strong></th>
		<th align="left" bgcolor="lightblue"><strong></strong></th>
		<th align="left" bgcolor="lightblue"><strong></strong></th>
		<th align="left" bgcolor="lightblue"><strong></strong></th>
	</tr>
	<tr height="25">
		<th align="left"><strong></strong></th>
		<th align="center"><strong><?php echo $m+$f;?></strong></th>
		<th align="left"><strong><=== TOTAL COMBINED</strong></th>
		<th align="left" bgcolor="lightblue"><strong></strong></th>
		<th align="left" bgcolor="lightblue"><strong></strong></th>
		<th align="left" bgcolor="lightblue"><strong></strong></th>
	</tr>
</table>
	</td>
	<td valign="top" width="25%">
		<table width="100%" border="1" cellpadding="0" cellspacing="0">
			<tr height="20"><th colspan="4">Summary Table 1st Sem</th></tr>
			<tr height="20"><th width="10%">STATUS</th><th width="6%">MALE</th><th width="5%">FEMALE</th><th width="5%">TOTAL</th></tr>
				<?php
				$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."' and enrol_admitdate!='0000-00-00 00:00:00' and enrol_stud_no NOT IN (SELECT grade_stud_no FROM grade WHERE (grade_sy='".$current_sy."' AND grade_sem='1' AND grade_final<75)))");
				$rowCountSYM = dbrows($resultCountSYM);
				$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."' and enrol_admitdate!='0000-00-00 00:00:00' and enrol_stud_no NOT IN (SELECT grade_stud_no FROM grade WHERE (grade_sy='".$current_sy."' AND grade_sem='1' AND grade_final<75)))");
				$rowCountSYF = dbrows($resultCountSYF);
				//$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' or studenroll.enrol_status2='GRADUATED') AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."' and enrol_admitdate!='0000-00-00 00:00:00')");
				//$rowCountSYM = dbrows($resultCountSYM);
				//$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' or studenroll.enrol_status2='GRADUATED')  AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."' and enrol_admitdate!='0000-00-00 00:00:00')");
				//$rowCountSYF = dbrows($resultCountSYF);	
				?>
			<tr height="20" align="center"><th>Complete</th><td><font size="2"><?php echo $rowCountSYM;?></td><td><font size="2"><?php echo $rowCountSYF;?></td><td><font size="2"><?php echo ($rowCountSYM+$rowCountSYF); ?></td><tr>
				<?php
				$resultCountSYM1 = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."' and enrol_admitdate!='0000-00-00 00:00:00' and enrol_stud_no IN (SELECT grade_stud_no FROM grade WHERE (grade_sy='".$current_sy."' AND grade_sem='1' AND grade_final<75)))");
				$rowCountSYM1 = dbrows($resultCountSYM1);
				$resultCountSYF1 = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."' and enrol_admitdate!='0000-00-00 00:00:00' and enrol_stud_no IN (SELECT grade_stud_no FROM grade WHERE (grade_sy='".$current_sy."' AND grade_sem='1' AND grade_final<75)))");
				$rowCountSYF1 = dbrows($resultCountSYF1);	
				//$resultCountSYM1 = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."' and enrol_admitdate!='0000-00-00 00:00:00')");
				//$rowCountSYM1 = dbrows($resultCountSYM1);
				//$resultCountSYF1 = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."' and enrol_admitdate!='0000-00-00 00:00:00')");
				//$rowCountSYF1 = dbrows($resultCountSYF1);	
				?>
			<tr height="20" align="center"><th>Incomplete</th><td><font size="2"><?php echo $rowCountSYM1;?></td><td><font size="2"><?php echo $rowCountSYF1;?></td><td><font size="2"><?php echo ($rowCountSYM1+$rowCountSYF1); ?></td><tr>
			<tr height="20" align="center"><th>TOTAL</th><td><font size="2"><?php echo ($rowCountSYM+$rowCountSYM1);?></td><td><font size="2"><?php echo ($rowCountSYF+$rowCountSYF1);?></td><td><font size="2"><?php echo ($rowCountSYM+$rowCountSYM1+$rowCountSYF+$rowCountSYF1); ?></td><tr>
		</table><br>
		<table width="100%" border="1" cellpadding="0" cellspacing="0">
			<tr height="20"><th colspan="4">Summary Table 2nd Sem</th></tr>
			<tr height="20"><th width="10%">STATUS</th><th width="6%">MALE</th><th width="5%">FEMALE</th><th width="5%">TOTAL</th></tr>
				<?php
				$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' or studenroll.enrol_status2='GRADUATED') AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."' and enrol_admitdate2!='0000-00-00 00:00:00')");
				$rowCountSYM = dbrows($resultCountSYM);
				$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' or studenroll.enrol_status2='GRADUATED')  AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."' and enrol_admitdate2!='0000-00-00 00:00:00')");
				$rowCountSYF = dbrows($resultCountSYF);	
				?>
			<tr height="20" align="center"><th>Complete</th><td><font size="2"><?php echo $rowCountSYM;?></td><td><font size="2"><?php echo $rowCountSYF;?></td><td><font size="2"><?php echo ($rowCountSYM+$rowCountSYF); ?></td><tr>
				<?php
				$resultCountSYM1 = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."' and enrol_admitdate2!='0000-00-00 00:00:00')");
				$rowCountSYM1 = dbrows($resultCountSYM1);
				$resultCountSYF1 = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."' and enrol_admitdate2!='0000-00-00 00:00:00')");
				$rowCountSYF1 = dbrows($resultCountSYF1);	
				?>
			<tr height="20" align="center"><th>Incomplete</th><td><font size="2"><?php echo $rowCountSYM1;?></td><td><font size="2"><?php echo $rowCountSYF1;?></td><td><font size="2"><?php echo ($rowCountSYM1+$rowCountSYF1); ?></td><tr>
			<tr height="20" align="center"><th>TOTAL</th><td><font size="2"><?php echo ($rowCountSYM+$rowCountSYM1);?></td><td><font size="2"><?php echo ($rowCountSYF+$rowCountSYF1);?></td><td><font size="2"><?php echo ($rowCountSYM+$rowCountSYM1+$rowCountSYF+$rowCountSYF1); ?></td><tr>
		</table><br>
		<table width="100%" border="1" cellpadding="0" cellspacing="0">
			<tr height="20"><th colspan="4">Summary Table (End of the School Year  Only)</th></tr>
			<tr height="20"><th width="10%">STATUS</th><th width="6%">MALE</th><th width="5%">FEMALE</th><th width="5%">TOTAL</th></tr>
				<?php
				$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' or studenroll.enrol_status2='GRADUATED') AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
				$rowCountSYM = dbrows($resultCountSYM);
				$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' or studenroll.enrol_status2='GRADUATED')  AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
				$rowCountSYF = dbrows($resultCountSYF);	
				?>
			<tr height="20" align="center"><th>Regular</th><td><font size="2"><?php echo $rowCountSYM;?></td><td><font size="2"><?php echo $rowCountSYF;?></td><td><font size="2"><?php echo ($rowCountSYM+$rowCountSYF); ?></td><tr>
				<?php
				$resultCountSYM1 = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
				$rowCountSYM1 = dbrows($resultCountSYM1);
				$resultCountSYF1 = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
				$rowCountSYF1 = dbrows($resultCountSYF1);	
				?>
			<tr height="20" align="center"><th>Irregular</th><td><font size="2"><?php echo $rowCountSYM1;?></td><td><font size="2"><?php echo $rowCountSYF1;?></td><td><font size="2"><?php echo ($rowCountSYM1+$rowCountSYF1); ?></td><tr>
			<tr height="20" align="center"><th>TOTAL</th><td><font size="2"><?php echo ($rowCountSYM+$rowCountSYM1);?></td><td><font size="2"><?php echo ($rowCountSYF+$rowCountSYF1);?></td><td><font size="2"><?php echo ($rowCountSYM+$rowCountSYM1+$rowCountSYF+$rowCountSYF1); ?></td><tr>
		</table><br>

		<table width="260">
			<tr><td align="left"><br>GUIDELINES:</td></tr>
			<tr>
				<td>This form shall be accomplished after each semester in a school year,  leaving the End of School Year Status Column and Summary Table for End of School Year Status blank/unfilled at the end of the 1st Semester.  These data elements shall be filled up only after the 2nd semester or at the end of the School Year. </td>
			</tr>
			<tr><td align="left"><br>INDICATORS:</td></tr>
			<tr>
				<td>
				<i><strong>End of Semester Status</strong></i><br><i>	
				Complete - number of learners who completed/satisfied the requirements in all subject areas (with grade of at least 75%)<br>	
				Incomplete -  number of learners who did not meet expectations in one or more subject areas, regardless of number of subjects failed (with grade less than 75%)<br>	
				Note: Do not include learners who are No Longer in School (NLS)<br>	<br>	
			
				<i><strong>End of School Year Status</strong></i><br>		
				Regular -  number of learners who completed/satisfied requirements in all subject areas  both in the 1st and 2nd semester<br>	
				Irregular - number of learners who were not able to satisfy/complete requirements in one or both semesters<br>	
				</i>	
		</td>
			</tr>	
		</table>
		<br><br>
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
				<br>Signature of Class Adviser over Printed Name<br><br>
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
				<br>Signature of School Head over Printed Name<br><br>
				</td>
			</tr>
			<tr><td>REVIEWED BY:</td></tr>
			<tr>
				<td align="center"><br><br><br>
				<strong>
				<?php echo strtoupper($dataDetails['settings_representative']);	?>
				</strong>
				<br>Signature of Division Representative over Printed Name				
				</td>
			</tr>
			<tr>
				<td align="center"><hr>
				Generated thru LIS				
				</td>
			</tr>
					
		</table>
	</td>
	</tr>
</table>


