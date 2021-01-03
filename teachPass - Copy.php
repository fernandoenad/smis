<?php
require('maincore.php');
$resultStudent = dbquery("SELECT * FROM teacher WHERE teach_no='".$_GET['teach_no']."'");
$dataStudent = dbarray($resultStudent);
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
		font-size: 0.7em;
	} 
	
	td {
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.6em;		
	}
	</style>
</head>	
<table border="1" width="500">
	<tr>
		<td valign="top">
			<table width="250" border="0" align="center" background="./assets/images/idbg.jpg">
				<tr>
					<td><br>
						<table>
							<tr>
								<td><img src="./assets/images/sanhs_logo.png" width="50"></td>
								<td>
								<small>Department of Education</small><br>
								<small>Division of <?php echo $current_school_division;?></small><br>
								<strong><?php echo $current_school_name;?></strong><br><?php echo $current_school_address;?></td>
							</tr>
						</table>	
					</td>
				</tr>
				<tr>
					<td align="center">
						<img src="./assets/images/teachers/<?php echo $dataStudent['teach_no'].".jpg"; ?>" width="140" height="140" border="2">
						<br> DepEd ID #: <?php echo $dataStudent['teach_id'];?><br><br>
						<font size="+2"><b><?php echo strtoupper($dataStudent['teach_fname'])." ".strtoupper($dataStudent['teach_xname'])." ".($dataStudent['teach_mname']=="-"?"":substr(strtoupper($dataStudent['teach_mname']),0,1).".")." ".strtoupper($dataStudent['teach_lname']);?></font></b><br>
						<img src="./assets/images/1.png" width="80"><br>
						<strong><?php echo strtoupper($current_principal);?></strong><br>School Head/In-Charge<br><br>
						
					</td>
				</tr>
			</table>
		</td>
		<td valign="top"> &nbsp;</td>
		<td valign="top">
			<table width="250" border="0" align="center">
				<tr>
					<td align="left" ><br>
						<table width="100%" border="0">
							</tr>
								<td align="center" valign="top">
								<h3>BIRTHDATE: 
								<?php 
									$phpdate = strtotime($dataStudent['teach_bdate']); 
									echo $mysqldate = date('F d, Y', $phpdate);
								?></h3>
								<h3>RESIDENCE: 
								<?php 
									echo $dataStudent['teach_residence']; 
								?></h3>								
								
								<h5>In case of loss, please return to</h5>
								<?php
									echo "Office of the Principal<br>";
									echo $current_school_name."<br>";
									echo $current_school_address."<br>";
									echo "Contact #: ".$current_school_contact;
								?><br><br><br>

								<br><br><br><br><br>
								<hr width="75%">
								Employee's Signature<br><br><br>
								<img src="./barcodeapp/barcode.php?text=<?php echo $dataStudent['teach_no']; ?>" alt="testing" height="30"/><br>Internal Teacher No.: <?php echo $dataStudent['teach_no']; ?>
								
							</tr>
							
						</table>	
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>		