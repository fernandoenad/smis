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
			<strong><font size="+1">School Form 2e (SF2e) Daily Attendance Report of Teachers</font></strong><br>
			<br>
			<table width="100%" border="0">
				<tr height="25">
					<td width="10%" align="right" ><font size="1">School ID &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_code;?></td>
					<td width="5%"></td>
					<td></td>
					<td width="8%" align="right"><font size="1">School Year &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_sy;?>-<?php echo $current_sy+1;?></td>
					<td width="5%"></td>
					<td width="8%" align="right"></td>
					<td align="right" colspan="2"><font size="1">For the Month of &nbsp;</td>
					<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px">
						<font size="1">			
						<?php 
						echo $mysqldate = date("F");
						?>
					</td>
				</tr>
				<tr height="25">
					<td align="right" border="1"><font size="1">School Name &nbsp;</td>
					<td align="center" colspan="3" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><font size="1"><?php echo $current_school_full;?></td>
					<td align="right"><font size="1"></td>
					<td align="center"></td>
					<td></td>
					<td align="right"><font size="1"></td>
					<td width="5%" align="center" style=""><font size="1"></td>
					<td width="12%" align="right"><font size="1"></td>
					<td align="center" style=""><font size="1"></td>
				</tr>				
			</table>
		</td>
		<td width="10%"><img src="./assets/images/sanhs_logo.png" width="80"></td>
	</tr>
</table><br>
<table border="1" cellspacing="0" cellpadding="1" width="1135">
	<tr>
		<th rowspan="3" width="1%">#</th>
		<th rowspan="3" width="20%">NAME (Last Name, First Name, Middle Name)</th>
		<th colspan="25">(1st row for date)</th>
		<th rowspan="2" colspan="2" width="3%">Total for the Month</th>
		<th rowspan="3" width="15%">REMARKS</th>
	</tr>
	<tr height="18">
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
		<th width="2%"></th>
	</tr>
	<tr>
		<th>M</th>
		<th>T</th>
		<th>W</th>
		<th>TH</th>
		<th>F</th>
		<th>M</th>
		<th>T</th>
		<th>W</th>
		<th>TH</th>
		<th>F</th>
		<th>M</th>
		<th>T</th>
		<th>W</th>
		<th>TH</th>
		<th>F</th>
		<th>M</th>
		<th>T</th>
		<th>W</th>
		<th>TH</th>
		<th>F</th>
		<th>M</th>
		<th>T</th>
		<th>W</th>
		<th>TH</th>
		<th>F</th>	
		<th>ABSENT</th>	
		<th>TARDY</th>			
	</tr>
	<?php
	$i=1;
	$MLEi=0;
	if ($_GET['display']=="teaching")
		$filter =" WHERE teach_status='1' AND teach_teacher='1'";
	else if ($_GET['display']=="nonteaching")
		$filter =" WHERE teach_status='1' AND teach_teacher='0'";
	else if ($_GET['display']=="all")
		$filter =" WHERE teach_status='1'";
	else if ($_GET['display']=="nonactive")
		$filter =" WHERE teach_status='0'";
	else 
		$filter =" WHERE teach_status='1'";
		
	$result= dbquery("SELECT * FROM teacher $filter ORDER BY teach_lname ASC, teach_fname ASC");
	while($data = dbarray($result)){
	?>
	<tr height="18">
		<td><?php echo $i;?></td>
		<td><?php echo strtoupper($data['teach_lname'].", ".$data['teach_fname']." ".$data['teach_xname']." ".substr($data['teach_mname'],0,1));?></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td><img src="./assets/images/divider.png" width="17"></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<?php 
	$i++;
	} 

	?>

	<tr height="25">
		<td align="right"><strong><?php echo $i-1;?></strong></td>
		<td align="center"><strong><=== TOTAL Per Day ===></strong></td>
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
	<tr height="60">
		<td align="right"><strong></strong></td>
		<td align="center"><strong>Checker's Initial</strong></td>
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
</table>
<table width="1135">
	<tr>
		<td width="20%" valign="top"><strong></strong>
			<table width="100%">
				<tr><td>Checked by:</td></tr>
				<tr><td align="center"><br><br><strong>_______________________________</strong><br>(Signature of Checker over Printed Name)</td></tr>
			</table>
		</td>
		<td width="20%" valign="top"><strong></strong>
			<table width="100%">
				<tr><td></td></tr>
				<tr><td align="center"><br><br><strong>_______________________________</strong><br>(Signature of Checker over Printed Name)</td></tr>
			</table>
		</td>
		<td width="20%">
			<table width="100%">
				<tr><td></td></tr>
				<tr><td align="center"><br><br><strong>_______________________________</strong><br>(Signature of Checker over Printed Name)</td></tr>
			</table>
		</td>
		<td></td>
		<td width="30%" valign="top">

			<table width="100%">
				<tr><td>Attested by:</td></tr>
				<tr><td align="center"><br><br><strong><?php echo $current_principal;?></strong><br>(Signature of School Head over Printed Name)</td></tr>
			</table>
		</td>
	</tr>
</table>
