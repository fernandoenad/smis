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
<table border="0" width="650">
	<tr>
		<td valign="top">
			<table width="325" height="450" border="0" align="center" background="./assets/images/idbg2.jpg">
				<tr height="90">
					<td colspan="2" align="center" valign="top"><br>
						<font face="Old English Text MT">Republic of the Philippines</font><br>
						Department of Education<br>
						<?php echo $current_school_region;?><br>
						Division of <?php echo $current_school_division;?><br>
						District of <?php echo $current_school_district;?><br>
						<strong><strong><?php echo strtoupper($current_school_name);?></strong></strong><br><?php echo $current_school_address;?><br><br>
					</td>
				</tr>
				<tr height="150">
					<td align="right" valign="top">
						<img src="./assets/images/sanhs_logo.png" width="120" height="120">	
					</td>
					<td align="center" valign="top">
						<img src="./assets/images/teachers/<?php echo $dataStudent['teach_no'].".jpg"; ?>" width="140" height="140" border="2">
					</td>								
				</tr>
				<tr height="179">
					<td align="left" colspan="2" valign="top">
						<?php $count=strlen($dataStudent['teach_fname']." ".$dataStudent['teach_xname']); ?>
						&nbsp;&nbsp;&nbsp;<font size="<?php echo ($count>15?"+2":($count>10?"+3":"+4"));?>"><b><?php echo strtoupper($dataStudent['teach_fname'])." ".strtoupper($dataStudent['teach_xname']);?></font></b><br>
						&nbsp;&nbsp;&nbsp;<font size="+2"><b><?php echo ($dataStudent['teach_mname']=="-"?"":substr(strtoupper($dataStudent['teach_mname']),0,1).".")." ".strtoupper($dataStudent['teach_lname']);?></font></b><br>
						<?php
						$checkPosition = dbquery("select * from teacherappointments inner join dropdowns on teacherappointments_position=field_name where (teacherappointments_teach_no='".$_GET['teach_no']."' and teacherappointments_active='1')");
						$dataPosition = dbarray($checkPosition);
						?>
						<br>&nbsp;&nbsp;&nbsp;<b><?php echo substr($dataPosition['field_ext'],2);?></b><br>
					</td>
				</tr>
			</table>
		</td>

		<td valign="top">
			<table width="325" height="450" border="0" align="center" background="./assets/images/idbg3.jpg">
				<tr height="420">
					<td align="center" valign="top"><br>
						<img src="./assets/images/deped_word.png" width="120"><br><br>
						<table width="90%" height="180" align="center">
							<tr>
								<td valign="top" width="25%">Date of Birth</td>
								<td valign="top">:</td>
								<td valign="top">
									<b>
									<?php 
										$phpdate = strtotime($dataStudent['teach_bdate']); 
										echo $mysqldate = date('F d, Y', $phpdate);
									?>
									</b>
								</td>
							</tr>
							<tr height="10">
								<td valign="top">Residence</td>
								<td valign="top">:</td>
								<td valign="top"><b><small><?php echo $dataStudent['teach_residence']; ?></b> </td>
							</tr>
							<tr>
								<td valign="top">TIN</td>
								<td valign="top">:</td>
								<td valign="top"><b><?php echo substr($dataStudent['teach_tin'],0,3)."-".substr($dataStudent['teach_tin'],3,3)."-".substr($dataStudent['teach_tin'],6,3);?></b></td>
							</tr>
							<tr>
								<td valign="top">DepEd ID</td>
								<td valign="top">:</td>
								<td valign="top"><b><?php echo ($dataStudent['teach_id']<1111200?"For Processing":$dataStudent['teach_id']);?></b></td>
							</tr>
							
							<tr>
								<td colspan="3" align="center">
									<hr><h5>In case of loss, please return to</h5>
									<?php
										echo "Office of the Principal<br>";
										echo $current_school_name."<br>";
										echo $current_school_address."<br>";
										echo "Contact #: ".$current_school_contact;
									?>
								</td>
							</tr>
						</table>
						
						<br>
						<img src="./assets/images/1.png" width="100"><br>
						<b><font size="+1"><?php echo $current_principal;?></font></b><br>
						School Head / In-Charge<br><br>
						<img src="./barcodeapp/barcode.php?text=<?php echo $dataStudent['teach_no']; ?>" alt="testing" width="250"/><br><?php echo $current_school_code;?>-<?php echo $dataStudent['teach_no']; ?>
					</td>
				</tr>
				<tr height="30">
					<td colspan="2" align="right" valign="top">Date Issued: <i><?php echo date('F d, Y');?>&nbsp;&nbsp;&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>		