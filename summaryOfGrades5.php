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
		height: 12px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.9em;
	} 
	
	td {
		height: 12px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.8em;		
	}
	</style>	
</head>
<?php
$resultTeacher = dbquery("SELECT * FROM section INNER JOIN users ON section.section_adviser=users.user_no WHERE (section_name='".$_GET['classProfile']."' AND section_sy='".$_GET['enrol_sy']."')");
$dataTeacher = dbarray($resultTeacher);
?>
<table border="0" cellspacing="0" cellpadding="1" width="1200">
<tr>
		<td width="10%" align="right"><img src="./assets/images/deped_logo.png" width="80"></td>
		<td align="center" valign="top">
			<strong><font size="+1">FINAL GRADES AND GENERAL AVERAGE																																														</font></strong><br>
			<br><br>
			<table width="100%" border="0">
				<tr height="25">
					<td width="10%" align="right" ><font size="1">Region &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1">302887</td>
					<td width="5%"></td>
					<td><font size="1"></td>
					<td width="8%" align="right"><font size="1">Division &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1">Bohol</td>
					<td width="5%"></td>
					<td width="8%" align="right"><font size="1">School Year &nbsp;</td>
					<td align="center" colspan="2" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?></td>
					<td></td>
				</tr>
				<tr height="25">
					<td align="right" border="1"><font size="1">School Name &nbsp;</td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1">San Agustin NHS</td>
					<td align="right"><font size="1">School ID &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1">302887</td>
					<td></td>
					<td align="right" valign="middle"><font size="1"></td>
					<?php
					$resultLevel = dbquery("SELECT * FROM section WHERE (section_name='".$_GET['classProfile']."' AND section_sy='".$_GET['enrol_sy']."')");
					$dataLevel = dbarray($resultLevel);
					?>
					<td colspan="2" align="center"><font size="1"></td>
					<td width="5%" align="right"></td>
					<td><font size="1"></td>
				</tr>				
			</table>
		</td>
		<td width="10%"><img src="./assets/images/sanhs_logo.png" width="80"></td>
	</tr>
</table>
<table border="1" cellspacing="0" cellpadding="1" width="1200">
	<tr>
		<th rowspan="2" width="13%">Level & Section</th>
		<th rowspan="2" width="10%">Subject</th>
		<th colspan="4">Failures</th>
		<th colspan="4">75-79</th>
		<th colspan="4">80-89</th>
		<th colspan="4">90-94</th>
		<th colspan="4">95-99</th>
	</tr>
	<tr>
		<th>Q1</th>
		<th>Q2</th>
		<th>Q3</th>
		<th>Q4</th>
		<th>Q1</th>
		<th>Q2</th>
		<th>Q3</th>
		<th>Q4</th>
		<th>Q1</th>
		<th>Q2</th>
		<th>Q3</th>
		<th>Q4</th>
		<th>Q1</th>
		<th>Q2</th>
		<th>Q3</th>
		<th>Q4</th>
		<th>Q1</th>
		<th>Q2</th>
		<th>Q3</th>
		<th>Q4</th>
	</tr>
	<?php
	$countCount =0;
	$checkSubjects = dbquery("select * from class inner join prospectus on class_pros_no=pros_no inner join section on class_section_no=section_no where (class_sy='".$current_sy."' and section_level='".$_GET['classProfile']."') order by section_level asc, section_name asc, pros_sort asc");
	while($dataSubjects = dbarray($checkSubjects)){
	?>
	<tr>
		<td><?php echo $dataSubjects['section_level']." - ".$dataSubjects['section_name'];?></td>
		<td><?php echo $dataSubjects['pros_title'];?></td>
		<?php
		$checkCount = dbquery("select * from grade where (grade_class_no='".$dataSubjects['class_no']."' and grade_q1 between 60 and 74)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where ( grade_class_no='".$dataSubjects['class_no']."' and grade_q2 between 60 and 74)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where ( grade_class_no='".$dataSubjects['class_no']."' and grade_q3 between 60 and 74)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where ( grade_class_no='".$dataSubjects['class_no']."' and grade_q4 between 60 and 74)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where ( grade_class_no='".$dataSubjects['class_no']."' and grade_q1 between 75 and 79)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where ( grade_class_no='".$dataSubjects['class_no']."' and grade_q2 between 75 and 79)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where ( grade_class_no='".$dataSubjects['class_no']."' and grade_q3 between 75 and 79)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where (  grade_class_no='".$dataSubjects['class_no']."' and grade_q4 between 75 and 79)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where ( grade_class_no='".$dataSubjects['class_no']."' and grade_q1 between 80 and 89)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where ( grade_class_no='".$dataSubjects['class_no']."' and grade_q2 between  80 and 89)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where ( grade_class_no='".$dataSubjects['class_no']."' and grade_q3 between 80 and 89)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where ( grade_class_no='".$dataSubjects['class_no']."' and grade_q4 between 80 and 89)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where ( grade_class_no='".$dataSubjects['class_no']."' and grade_q1 between 90 and 94)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where ( grade_class_no='".$dataSubjects['class_no']."' and grade_q2 between  90 and 94)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where ( grade_class_no='".$dataSubjects['class_no']."' and grade_q3 between 90 and 94)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where ( grade_class_no='".$dataSubjects['class_no']."' and grade_q4 between 90 and 94)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where ( grade_class_no='".$dataSubjects['class_no']."' and grade_q1 between 95 and 100)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where ( grade_class_no='".$dataSubjects['class_no']."' and grade_q2 between  95 and 100)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where ( grade_class_no='".$dataSubjects['class_no']."' and grade_q3 between 95 and 100)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		<?php
		$checkCount = dbquery("select * from grade where ( grade_class_no='".$dataSubjects['class_no']."' and grade_q4 between 95 and 100)");
		$countCount = dbrows($checkCount);
		?>
		<td align="center"><?php echo $countCount;?></td>
		
	</tr>
	<?php
	}
	?>
</table>
<br>
<table width="1350">
	<tr>
		<td>Prepared by:<br><br><br><strong><?php echo strtoupper($current_registrar); ?></strong><br>School Registrar</td>
		<td></td>
		<td>Attested by:<br><br><br><strong><?php echo strtoupper($current_principal); ?></strong><br>School Principal</td>
	</tr>
</table>