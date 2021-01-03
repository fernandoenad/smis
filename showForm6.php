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
			<strong><font size="+1">School Form 6 (SF6) Summarized Report on Promotion<br> and Level of Proficiency</font></strong><br>
			<small><i>(This replaced Form 20)</i></small>
			<br><br>
			<table width="100%" border="0">
				<tr height="25">
					<td width="10%" align="right" ><font size="1">School ID &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_code;?></td>
					<td width="5%"></td>
					<td></td>
					<td width="8%" align="right"><font size="1">Region &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_reg_code;?></td>
					<td width="5%"></td>
					<td width="8%" align="right"><font size="1">Division &nbsp;</td>
					<td align="center" colspan="2" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_division;?></td>
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
					<td align="right"><font size="1">District &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_district;?></td>
					<td align="right" colspan="2"><font size="1">School Year</td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?></td>
				</tr>				
			</table>
		</td>
		<td width="10%"><img src="./assets/images/sanhs_logo.png" width="80"></td>
	</tr>
</table>
<table border="1" cellspacing="0" cellpadding="1" width="1135">
	<tr align="center" height="40">
		<th rowspan="2" width="15%">SUMMARY TABLE</th>
		<th colspan="3">GRADE 1/7</th>
		<th colspan="3">GRADE 2/8</th>
		<th colspan="3">GRADE 3/9</th>
		<th colspan="3">GRADE 4/10</th>
		<th colspan="3">GRADE 5</th>
		<th colspan="3">GRADE 6</th>
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
		<th>MALE</th>
		<th>FEMALE</th>
		<th>TOTAL</th>
	</tr>
	<tr align="center" height="35">
		<th>PROMOTED</th>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='PROMOTED' AND student.stud_gender='MALE' AND (enrol_level='1' OR enrol_level='7'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='PROMOTED' AND student.stud_gender='FEMALE' AND (enrol_level='1' OR enrol_level='7'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."'  AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='PROMOTED' AND student.stud_gender='MALE' AND (enrol_level='2' OR enrol_level='8'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."'  AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='PROMOTED' AND student.stud_gender='FEMALE' AND (enrol_level='2' OR enrol_level='8'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."'  AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='PROMOTED' AND student.stud_gender='MALE' AND (enrol_level='3' OR enrol_level='9'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."'  AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='PROMOTED' AND student.stud_gender='FEMALE' AND (enrol_level='3' OR enrol_level='9'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='PROMOTED' AND student.stud_gender='MALE' AND (enrol_level='4' OR enrol_level='10'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='PROMOTED' AND student.stud_gender='FEMALE' AND (enrol_level='4' OR enrol_level='10'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>

		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='PROMOTED' AND student.stud_gender='MALE' AND enrol_level='5')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='PROMOTED' AND student.stud_gender='FEMALE' AND enrol_level='5')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='PROMOTED' AND student.stud_gender='MALE' AND enrol_level='6')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='PROMOTED' AND student.stud_gender='FEMALE' AND enrol_level='6')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='PROMOTED' AND (enrol_level<'7' OR enrol_level<'11') AND student.stud_gender='MALE')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='PROMOTED' AND (enrol_level<'7' OR enrol_level<'11') AND student.stud_gender='FEMALE')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>		
	</tr>	
	<tr align="center" height="35">	
		<th>CONDITIONAL</th>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='MALE' AND (enrol_level='1' OR enrol_level='7'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='FEMALE' AND (enrol_level='1' OR enrol_level='7'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='MALE' AND (enrol_level='2' OR enrol_level='8'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='FEMALE' AND (enrol_level='2' OR enrol_level='8'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='MALE' AND (enrol_level='3' OR enrol_level='9'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='FEMALE' AND (enrol_level='3' OR enrol_level='9'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='MALE' AND (enrol_level='4' OR enrol_level='10'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='FEMALE' AND (enrol_level='4' OR enrol_level='10'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>

		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='MALE' AND enrol_level='5')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='FEMALE' AND enrol_level='5')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>

		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='MALE' AND enrol_level='6')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='FEMALE' AND enrol_level='6')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>

		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND (enrol_level<'7' OR enrol_level<'11') AND student.stud_gender='MALE')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND (enrol_level<'7' OR enrol_level<'11') AND student.stud_gender='FEMALE')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>		
	</tr>
	<tr  align="center" height="35">	
		<th>RETAINED</th>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND student.stud_gender='MALE' AND (enrol_level='1' OR enrol_level='7'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND student.stud_gender='FEMALE' AND (enrol_level='1' OR enrol_level='7'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND student.stud_gender='MALE' AND (enrol_level='2' OR enrol_level='8'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND student.stud_gender='FEMALE' AND (enrol_level='2' OR enrol_level='8'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND student.stud_gender='MALE' AND (enrol_level='3' OR enrol_level='9'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND student.stud_gender='FEMALE' AND (enrol_level='3' OR enrol_level='9'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND student.stud_gender='MALE' AND (enrol_level='4' OR enrol_level='10'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND student.stud_gender='FEMALE' AND (enrol_level='4' OR enrol_level='10'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND student.stud_gender='MALE' AND enrol_level='5')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND student.stud_gender='FEMALE' AND enrol_level='5')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND student.stud_gender='MALE' AND enrol_level='6')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND student.stud_gender='FEMALE' AND enrol_level='6')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND (enrol_level<'7' OR enrol_level<'11') AND student.stud_gender='MALE')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."'  AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND (enrol_level<'7' OR enrol_level<'11') AND student.stud_gender='FEMALE')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>		
	</tr>
	<tr align="center" height="25">
		<th width="10%">LEARNING PROGRESS & ACHIEVEMENT (based on Learners' General Average)</th>
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
		<th>MALE</th>
		<th>FEMALE</th>
		<th>TOTAL</th>
	</tr>	
	<tr align="center" height="35">	
		<th>Did Not Meet Expectations <br>(74 and below)</th>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'74.5' AND student.stud_gender='MALE' AND (enrol_level='1' OR enrol_level='7'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'74.5' AND student.stud_gender='FEMALE' AND (enrol_level='1' OR enrol_level='7'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>		
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'74.5' AND student.stud_gender='MALE' AND (enrol_level='2' OR enrol_level='8'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'74.5' AND student.stud_gender='FEMALE' AND (enrol_level='2' OR enrol_level='8'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'74.5' AND student.stud_gender='MALE' AND (enrol_level='3' OR enrol_level='9'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'74.5' AND student.stud_gender='FEMALE' AND (enrol_level='3' OR enrol_level='9'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'74.5' AND student.stud_gender='MALE' AND (enrol_level='4' OR enrol_level='10'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'74.5' AND student.stud_gender='FEMALE' AND (enrol_level='4' OR enrol_level='10'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'74.5' AND student.stud_gender='MALE' AND enrol_level='5')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'74.5' AND student.stud_gender='FEMALE' AND enrol_level='5')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'74.5' AND student.stud_gender='MALE' AND enrol_level='6')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'74.5' AND student.stud_gender='FEMALE' AND enrol_level='6')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'74.5' AND (enrol_level<'7' OR enrol_level<'11') AND student.stud_gender='MALE')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'74.5' AND (enrol_level<'7' OR enrol_level<'11') AND student.stud_gender='FEMALE')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
	</tr>
	<tr align="center" height="35">	
		<th>Fairly Satisfactory <br>(75-79)</th>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'79.50' AND studenroll.enrol_average>'74.4' AND student.stud_gender='MALE' AND (enrol_level='1' OR enrol_level='7'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'79.50' AND studenroll.enrol_average>'74.4' AND student.stud_gender='FEMALE' AND (enrol_level='1' OR enrol_level='7'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>		
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'79.50' AND studenroll.enrol_average>'74.4' AND student.stud_gender='MALE' AND (enrol_level='2' OR enrol_level='8'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'79.50' AND studenroll.enrol_average>'74.4' AND student.stud_gender='FEMALE' AND (enrol_level='2' OR enrol_level='8'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'79.50' AND studenroll.enrol_average>'74.4' AND student.stud_gender='MALE' AND (enrol_level='3' OR enrol_level='9'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'79.50' AND studenroll.enrol_average>'74.4' AND student.stud_gender='FEMALE' AND (enrol_level='3' OR enrol_level='9'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'79.50' AND studenroll.enrol_average>'74.4' AND studenroll.enrol_average>'75' AND student.stud_gender='MALE' AND (enrol_level='4' OR enrol_level='10'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'79.50' AND studenroll.enrol_average>'74.4' AND studenroll.enrol_average>'75' AND student.stud_gender='FEMALE' AND (enrol_level='4' OR enrol_level='10'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'79.50' AND studenroll.enrol_average>'74.4' AND studenroll.enrol_average>'75' AND student.stud_gender='MALE' AND enrol_level='5')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'79.50' AND studenroll.enrol_average>'74.4' AND studenroll.enrol_average>'75' AND student.stud_gender='FEMALE' AND enrol_level='5')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'79.50' AND studenroll.enrol_average>'74.4' AND studenroll.enrol_average>'75' AND student.stud_gender='MALE' AND enrol_level='6')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'79.50' AND studenroll.enrol_average>'74.4' AND studenroll.enrol_average>'75' AND student.stud_gender='FEMALE' AND enrol_level='6')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'79.50' AND studenroll.enrol_average>'74.4' AND (enrol_level<'7' OR enrol_level<'11') AND student.stud_gender='MALE')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'79.50' AND studenroll.enrol_average>'74.4' AND (enrol_level<'7' OR enrol_level<'11') AND student.stud_gender='FEMALE')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
	</tr>
	<tr align="center" height="35">	
		<th>Satisfactory <br>(80-84)</th>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'84.50' AND studenroll.enrol_average>'79.4' AND student.stud_gender='MALE' AND (enrol_level='1' OR enrol_level='7'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'84.50' AND studenroll.enrol_average>'79.4' AND student.stud_gender='FEMALE' AND (enrol_level='1' OR enrol_level='7'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>		
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'84.50' AND studenroll.enrol_average>'79.4' AND student.stud_gender='MALE' AND (enrol_level='2' OR enrol_level='8'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'84.50' AND studenroll.enrol_average>'79.4' AND student.stud_gender='FEMALE' AND (enrol_level='2' OR enrol_level='8'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'84.50' AND studenroll.enrol_average>'79.4' AND student.stud_gender='MALE' AND (enrol_level='3' OR enrol_level='9'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'84.50' AND studenroll.enrol_average>'79.4' AND student.stud_gender='FEMALE' AND (enrol_level='3' OR enrol_level='9'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'84.50' AND studenroll.enrol_average>'79.4' AND student.stud_gender='MALE' AND (enrol_level='4' OR enrol_level='10'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'84.50' AND studenroll.enrol_average>'79.4' AND student.stud_gender='FEMALE' AND (enrol_level='4' OR enrol_level='10'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'84.50' AND studenroll.enrol_average>'79.4' AND student.stud_gender='MALE' AND enrol_level='5')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'84.50' AND studenroll.enrol_average>'79.4' AND student.stud_gender='FEMALE' AND enrol_level='5')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'84.50' AND studenroll.enrol_average>'79.4' AND student.stud_gender='MALE' AND enrol_level='6')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'84.50' AND studenroll.enrol_average>'79.4' AND student.stud_gender='FEMALE' AND enrol_level='6')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'84.50' AND studenroll.enrol_average>'79.4' AND (enrol_level<'7' OR enrol_level<'11') AND student.stud_gender='MALE')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'84.50' AND studenroll.enrol_average>'79.4' AND (enrol_level<'7' OR enrol_level<'11') AND student.stud_gender='FEMALE')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
	</tr>
	<tr align="center" height="35">	
		<th>Very Satisfactory <br>(85-89)</th>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'89.5' AND studenroll.enrol_average>'84.4' AND student.stud_gender='MALE' AND (enrol_level='1' OR enrol_level='7'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'89.5' AND studenroll.enrol_average>'84.4' AND student.stud_gender='FEMALE' AND (enrol_level='1' OR enrol_level='7'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>		
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'89.5' AND studenroll.enrol_average>'84.4' AND student.stud_gender='MALE' AND (enrol_level='2' OR enrol_level='8'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'89.5' AND studenroll.enrol_average>'84.4' AND student.stud_gender='FEMALE' AND (enrol_level='2' OR enrol_level='8'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'89.5' AND studenroll.enrol_average>'84.4' AND student.stud_gender='MALE' AND (enrol_level='3' OR enrol_level='9'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'89.5' AND studenroll.enrol_average>'84.4' AND student.stud_gender='FEMALE' AND (enrol_level='3' OR enrol_level='9'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'89.5' AND studenroll.enrol_average>'84.4' AND student.stud_gender='MALE' AND (enrol_level='4' OR enrol_level='10'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'89.5' AND studenroll.enrol_average>'84.4' AND student.stud_gender='FEMALE' AND (enrol_level='4' OR enrol_level='10'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'89.5' AND studenroll.enrol_average>'84.4' AND student.stud_gender='MALE' AND enrol_level='5')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'89.5' AND studenroll.enrol_average>'84.4' AND student.stud_gender='FEMALE' AND enrol_level='5')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'89.5' AND studenroll.enrol_average>'84.4' AND student.stud_gender='MALE' AND enrol_level='6')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'89.5' AND studenroll.enrol_average>'84.4' AND student.stud_gender='FEMALE' AND enrol_level='6')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>

		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'89.5' AND studenroll.enrol_average>'84.4' AND (enrol_level<'7' OR enrol_level<'11') AND student.stud_gender='MALE')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'89.5' AND studenroll.enrol_average>'84.4' AND (enrol_level<'7' OR enrol_level<'11') AND student.stud_gender='FEMALE')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
	</tr>
	<tr align="center" height="35">	
		<th>Outstanding <br>(90-100)</th>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'101' AND studenroll.enrol_average>'89.4' AND student.stud_gender='MALE' AND (enrol_level='1' OR enrol_level='7'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'101' AND studenroll.enrol_average>'89.4' AND student.stud_gender='FEMALE' AND (enrol_level='1' OR enrol_level='7'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>		
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'101' AND studenroll.enrol_average>'89.4' AND student.stud_gender='MALE' AND (enrol_level='2' OR enrol_level='8'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'101' AND studenroll.enrol_average>'89.4' AND student.stud_gender='FEMALE' AND (enrol_level='2' OR enrol_level='8'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'101' AND studenroll.enrol_average>'89.4' AND student.stud_gender='MALE' AND (enrol_level='3' OR enrol_level='9'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'101' AND studenroll.enrol_average>'89.4' AND student.stud_gender='FEMALE' AND (enrol_level='3' OR enrol_level='9'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'101' AND studenroll.enrol_average>'89.4' AND student.stud_gender='MALE' AND (enrol_level='4' OR enrol_level='10'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'101' AND studenroll.enrol_average>'89.4' AND student.stud_gender='FEMALE' AND (enrol_level='4' OR enrol_level='10'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'101' AND studenroll.enrol_average>'89.4' AND student.stud_gender='MALE' AND enrol_level='5')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'101' AND studenroll.enrol_average>'89.4' AND student.stud_gender='FEMALE' AND enrol_level='5')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'101' AND studenroll.enrol_average>'89.4' AND student.stud_gender='MALE' AND enrol_level='6')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'101' AND studenroll.enrol_average>'89.4' AND student.stud_gender='FEMALE' AND enrol_level='6')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'101' AND studenroll.enrol_average>'89.4' AND (enrol_level<'7' OR enrol_level<'11') AND student.stud_gender='MALE')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_average<'101' AND studenroll.enrol_average>'89.4' AND (enrol_level<'7' OR enrol_level<'11') AND student.stud_gender='FEMALE')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
	</tr>	
	<tr align="center" height="35">	
		<th>TOTAL</th>
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND student.stud_gender='MALE' AND (enrol_level='1' OR enrol_level='7'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND student.stud_gender='FEMALE' AND (enrol_level='1' OR enrol_level='7'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>		
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND student.stud_gender='MALE' AND (enrol_level='2' OR enrol_level='8'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND student.stud_gender='FEMALE' AND (enrol_level='2' OR enrol_level='8'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND student.stud_gender='MALE' AND (enrol_level='3' OR enrol_level='9'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND student.stud_gender='FEMALE' AND (enrol_level='3' OR enrol_level='9'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND student.stud_gender='MALE' AND (enrol_level='4' OR enrol_level='10'))");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND student.stud_gender='FEMALE' AND (enrol_level='4' OR enrol_level='10'))");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND student.stud_gender='MALE' AND enrol_level='5')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND student.stud_gender='FEMALE' AND enrol_level='5')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND student.stud_gender='MALE' AND enrol_level='6')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND student.stud_gender='FEMALE' AND enrol_level='6')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
		<?php
			$limit = ($current_school_maxlevel>10?10:$current_school_maxlevel);
			$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' and enrol_level<='".$limit."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (enrol_level<'7' OR enrol_level<'11') AND student.stud_gender='MALE')");
			$rowCountSYM = dbrows($resultCountSYM);
			$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' and enrol_level<='".$limit."' AND studenroll.enrol_section!='' AND studenroll.enrol_status1='PROMOTED' AND (enrol_level<'7' OR enrol_level<'11') AND student.stud_gender='FEMALE')");
			$rowCountSYF = dbrows($resultCountSYF);	
		?>
		<td><font size="2"><?php echo $rowCountSYM;?></td>
		<td><font size="2"><?php echo $rowCountSYF;?></td>
		<td><font size="2"><?php echo $rowCountSYM + $rowCountSYF;?></td>	
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



