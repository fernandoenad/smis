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
			<strong><h1>  School Form 5B List of Learners  with  Complete  SHS Requirements (SF5B-SHS)  </h1></strong>
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
	<tr height="30">
		<th width="1%">No.</th>
		<th width="1%">LRN</th>
		<th>LEARNER'S NAME <br><small>(Last Name, First Name, Middle Name)</small></th>
		<th width="10%">Completed SHS in 2 SYs? (Y/N)</th>
		<th width="40%">National Certification Level Attained <br><small>(only if applicable)</small></th>
		
	</tr>
	<tr height="25">
		<th align="left"><strong></strong></th>
		<th align="center"><strong>MALE</strong></th>
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
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='MALE' AND studenroll.enrol_status1!='INACTIVE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="22">
		<td><?php echo $i;?></td>
		<td align="right"><font size="1"><?php echo $data['stud_lrn'];?></td>
		<td><font size="1"><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
		<td align="center"><font size="2">Yes</td>
		<td align="center"><input type="text" style="width: 300px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td>
		
		

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
	</tr>
	<tr height="25">
		<th align="left"><strong></strong></th>
		<th align="center"><strong>FEMALE</strong></th>
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
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='FEMALE' AND studenroll.enrol_status1!='INACTIVE') ORDER BY stud_gender ASC, stud_lname ASC, stud_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="22">
		<td><?php echo $ii;?></td>
		<td align="right"><font size="1"><?php echo $data['stud_lrn'];?></td>
		<td><font size="1"><?php echo strtoupper($data['stud_lname'].", ".$data['stud_fname']." ".$data['stud_xname']." ".$data['stud_mname']);?></td>
		<td align="center"><font size="2">Yes</td>
		<td align="center"><input type="text" style="width: 300px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td>
		
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
	</tr>
	<tr height="25">
		<th align="left"><strong></strong></th>
		<th align="center"><strong><?php echo ($m+$f);?></strong></th>
		<th align="left"><strong><=== TOTAL COMBINED</strong></th>
		<th align="left" bgcolor="lightblue"><strong></strong></th>
		<th align="left" bgcolor="lightblue"><strong></strong></th>
	</tr>
</table>
	</td>
	<td valign="top" width="35%">
		<table width="100%" border="1" cellpadding="0" cellspacing="0">
			<tr height="20"><th colspan="4">Summary Table A</th></tr>
			<tr height="20"><th width="15%">STATUS</th><th width="6%">Male</th><th width="5%">Female</th><th width="5%">Total</th></tr>
			<tr height="20" align="center"><th>Learners who completed SHS Program within 2 SYs or 4 semesters</th><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><tr>
			<tr height="20" align="center"><th>Learners who completed SHS Program in more than 2 SYs or 4 semesters</th><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><tr>
			<tr height="20" align="center"><th>TOTAL</th><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><tr>
		</table><br>
		<table width="100%" border="1" cellpadding="0" cellspacing="0">
			<tr height="20"><th colspan="4" >Summary Table B</th></tr>
			<tr height="20"><th width="15%">STATUS</th><th width="6%">Male</th><th width="5%">Female</th><th width="5%">Total</th></tr>
			<tr height="20" align="center"><th>NC III</th><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><tr>
			<tr height="20" align="center"><th>NC II</th><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><tr>
			<tr height="20" align="center"><th>NC I</th><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><tr>
			<tr height="20" align="center"><th>TOTAL</th><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><td><font size="2"><input type="text" style="width: 30px; border: 0px; font-weight: bold !important; font-size: 10px; text-align: center;" value=""></td><tr>
		</table><br>
		<table width="100%">
			<tr><td align="left"><br>GUIDELINES:</td></tr>
			<tr>
				<td>
				1. This form should be accomplished by the Class Adviser at End of School Year.<br>                                                                                                                                             
				2. It should be compiled and checked by the School Head and passed to the Division Office before graduation.<br> 			
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
					
		</table>
	</td>
	</tr>
</table>

