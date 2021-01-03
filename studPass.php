<?php
require('maincore.php');
$resultStudent = dbquery("SELECT * FROM student INNER JOIN studenroll ON student.stud_no=studenroll.enrol_stud_no INNER JOIN studcontacts ON studenroll.enrol_stud_no=studcontacts.studCont_stud_no WHERE (stud_no='".$_GET['stud_no']."') order by enrol_sy desc");
$dataStudent = dbarray($resultStudent );
$limit = ($dataStudent['enrol_level']>10?11:($dataStudent['enrol_level']>6?7:0));
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
		font-family: Book Antiqua, "Times New Roman", serif; 
		font-size: 0.7em;
	} 
	
	td {
		height: 10px;
		text-decoration: none;
		font-family: Book Antiqua, "Times New Roman", serif; 
		font-size: 0.6em;	
		
	}
	</style>
</head>	
<table border="1" width="450" cellspacing="1">
	<tr height="335">
		<td valign="top" background="./assets/images/idbg.jpg">
			<table width="225" border="0" align="center">
				<tr>
					<td>
						<table>
							<tr>
								<td><img src="./assets/images/sanhs_logo.png" width="40"></td>
								<td valign="middle">
								<small>Department of Education</small><br>
								<small>Division of <?php echo $current_school_division;?></small><br>
								<strong><font size="1"><?php echo $current_school_name;?></strong></font><br><?php echo $current_school_address;?></td>
							</tr>
						</table>	
					</td>
				</tr>
				<tr>
					<td align="center">
						<?php $count=strlen($dataStudent['stud_fname']." ".($dataStudent['stud_mname']=="-"?"":substr($dataStudent['stud_mname'],0,1).".")." ".$dataStudent['stud_lname']." ".$dataStudent['stud_xname']); ?>
						<h2><?php echo ($dataStudent['enrol_level']>10?"SENIOR HIGH SCHOOL":($dataStudent['enrol_level']<7?"ELEMENTARY SCHOOL":"JUNIOR HIGH SCHOOL"));?></h2>
						<img src="./assets/images/students/<?php echo $dataStudent['stud_no'].".jpg"; ?>" width="110" height="110" border="2">
						<br><font size="2">LRN: <?php echo $dataStudent['stud_lrn'];?></font><br>
						<font size="<?php echo ($count>25?"":($count>15?"+1":"+2"));?>"><b><?php echo strtoupper($dataStudent['stud_fname']." ".($dataStudent['stud_mname']=="-"?"":substr($dataStudent['stud_mname'],0,1).".")." ".$dataStudent['stud_lname']." ".$dataStudent['stud_xname']);?></font></b><br>
						
						<img src="./assets/images/1.png" width="80"><br>
						<font size="2"><strong><?php echo strtoupper($current_principal);?></strong></font><br><font size="1">School Head/In-Charge</font>
						
					</td>
				</tr>
			</table>
		</td>
		<td valign="top" style="BORDER: black solid 0px;"></td>
		<td valign="top">
			<table width="225" border="0" align="center">
				<tr>
					<td align="left" >
						<table width="100%" border="0">
							</tr>
								<td align="center" valign="top">
								<h3>BIRTHDATE: 
								<?php 
									$phpdate = strtotime($dataStudent['stud_bdate']); 
									echo $mysqldate = date('F d, Y', $phpdate);
								?></h3>
								<h5>In case of emergency, please notify</h5>
								<?php
									echo "<b>".strtoupper(($dataStudent['studCont_stud_gfname']=="-"?($dataStudent['studCont_stud_ffname']=="-"?$dataStudent['studCont_stud_mfname']:$dataStudent['studCont_stud_ffname']):$dataStudent['studCont_stud_gfname']))." ".strtoupper(($dataStudent['studCont_stud_glname']=="-"?($dataStudent['studCont_stud_flname']=="-"?$dataStudent['studCont_stud_mlname']:$dataStudent['studCont_stud_flname']):$dataStudent['studCont_stud_glname']))."</b><br>";
									echo strtoupper($dataStudent['stud_residence'])."<br>";
									echo "Contact #: ".strtoupper($dataStudent['studCont_stud_gcontact']);
								?><br><br><br><br>
								<hr width="75%">
								Student's Signature<br><br>
								<h5>In case of loss, please return to</h5>
									<?php
										echo "Office of the Principal<br>";
										echo $current_school_name."<br>";
										echo $current_school_address."<br>";
										echo "Contact #: ".$current_school_contact;
									?><br><br>
								<!--
								<table border="1" cellspacing="0" width="100%">
									<tr height="20"><th><font size=".3">Sch. Yr.</th><th>Lvl./Sec.</th><th>Valid'n</th></tr>
									<?php
									$counter=1;
									$enrol_sy=0;
									$checkHist = dbquery("select * from studenroll where (enrol_stud_no='".$_GET['stud_no']."' and enrol_level>='".$limit."' and enrol_section!='') order by enrol_sy asc limit 4");
									while($dataHist = dbarray($checkHist)){
									?>
									<tr height="20"><td><?php echo $dataHist['enrol_sy'];?>-<?php echo $dataHist['enrol_sy']+1;?></td><td><?php echo $dataHist['enrol_level'];?> - <?php echo $dataHist['enrol_section'];?> </td><td></td></tr>
									<?php
									$counter++;
									$enrol_sy=$dataHist['enrol_sy'];
									}
									while($counter<5){
									?>
									<tr height="20"><td><?php echo ++$enrol_sy;?>-<?php echo $enrol_sy+1;?></td><td></td><td></td></tr>									
									<?php
									$counter++;
									}
									?>
								</table>
								-->
								

								

								<img src="./barcodeapp/barcode.php?text=<?php echo $dataStudent['stud_no']; ?>" alt="testing" width="200" height="30"/><br>Student No.: <?php echo $dataStudent['stud_no']; ?>
								
							</tr>
							
						</table>	
						<br>
						<small>Date Issued: <?php echo date("M d, Y");?></small>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>		