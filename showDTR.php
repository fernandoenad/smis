<?php
session_start();
require('maincore.php');
$checkTeacher = dbquery("select * from teacher where teach_no='".$_GET['teach_no']."'");
$dataTeacher = dbarray($checkTeacher);
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
		font-size: 0.5em;
	} 

	td {
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.7em;		
	}
	</style>	
</head>
<br><br><br><br>
<table border="0" cellspacing="0" cellpadding="1" width="800">
<tr>
	<td width="50%" align="center">
		<table border="0" cellspacing="0" cellpadding="1" width="90%">
			<tr><td colspan="7" >CIVIL SERVICE FORM No. 48<br><br></td></tr>
			<tr><td colspan="7" align="center"><font size="3"><strong>DAILY TIME RECORD</strong></font></td></tr>
			<tr><td colspan="7" align="center" style="BORDER-BOTTOM: black solid 1px"><br><font size="2"><strong><?php echo strtoupper($dataTeacher['teach_fname']." ".substr($dataTeacher['teach_mname'],0,1).($dataTeacher['teach_mname']=="-"?"":".")." ".$dataTeacher['teach_lname']." ".$dataTeacher['teach_xname']);?></strong></td></tr>
			<tr><td colspan="7" align="center"><i>(Name)</i></td></tr>
			<tr>
				<td colspan="3" width="35%">For the month of </td>
				<td colspan="4" align="center" style="BORDER-BOTTOM: black solid 1px"><strong><?php echo date('F, Y',strtotime($_GET['year']."-".$_GET['month']."-01")); ?></strong></td>
			</tr>
			<tr>
				<td colspan="3">Office hours for arrival</td>
				<td colspan="2" align="center">Regular Days</td>
				<td colspan="2" align="center" style="BORDER-BOTTOM: black solid 1px"><small>7:30A-12P/1P-5PM</small></td>
			</tr>
			<tr>
				<td colspan="3" align="center">and departure</td>
				<td colspan="2" align="center">Saturdays</td>
				<td colspan="2" align="center" style="BORDER-BOTTOM: black solid 1px"><small>As Required</small></td>
			</tr>
			<tr>
				<td colspan="7"></td>
			</tr>
			<tr>
				<td align="center" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"></td>
				<td colspan="2" align="center" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"><strong>AM</strong></td>
				<td colspan="2" align="center" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"><strong>PM</strong></td>
				<td colspan="2" align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"><strong>UNDERTIME</strong></td>
			</tr>
			<tr height="2">
				<td align="center" width="5%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>DAY</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Arrival</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Departure</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Arrival</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Departure</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Hours</small></td>
				<td align="center" width="13%" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Minutes</small></td>
			</tr>
			<?php
			for($i=1;$i<=31;$i++){
			?>
			<tr height="20">
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo $i;?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$i." 00:00:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$i." 11:59:59";
				$checkAMIn = dbquery("select * from checkinout where (USERID='".$dataTeacher['teach_bio_no']."' and CHECKTYPE='I' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME asc");
				$dataAMIn = dbarray($checkAMIn );
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataAMIn['CHECKTIME']==""?"":date('g:ia', strtotime($dataAMIn['CHECKTIME'])));?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$i." 8:00:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$i." 13:00:00";
				$checkAMOut = dbquery("select * from checkinout where (USERID='".$dataTeacher['teach_bio_no']."' and CHECKTYPE='O' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME desc");
				$dataAMOut = dbarray($checkAMOut );
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataAMOut['CHECKTIME']==""?"":date('g:ia', strtotime($dataAMOut['CHECKTIME'])));?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$i." 12:30:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$i." 16:59:59";
				$checkPMIn = dbquery("select * from checkinout where (USERID='".$dataTeacher['teach_bio_no']."' and CHECKTYPE='I' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME asc");
				$dataPMIn = dbarray($checkPMIn );
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataPMIn['CHECKTIME']==""?"":date('g:ia', strtotime($dataPMIn['CHECKTIME'])));?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$i." 14:00:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$i." 23:59:59";
				$checkPMOut = dbquery("select * from checkinout where (USERID='".$dataTeacher['teach_bio_no']."' and CHECKTYPE='O' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME desc");
				$dataPMOut = dbarray($checkPMOut );
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataPMOut['CHECKTIME']==""?"":date('g:ia', strtotime($dataPMOut['CHECKTIME'])));?></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"></td>
				<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"></td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
			</tr>
			<tr height="25">
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="left" colspan="4" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"><strong>TOTAL</strong></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
			</tr>
			<tr>
				<td align="center" colspan="7">
				<i>I CERTIFY on my honor that the above is a true and correct report of the hours of work perform, record of which was made daily at the time of arrival and departure from office.</i>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="7" style="BORDER-BOTTOM: black solid 1px">
				<font size="2"><br><strong><?php echo strtoupper($dataTeacher['teach_fname']." ".substr($dataTeacher['teach_mname'],0,1).($dataTeacher['teach_mname']=="-"?"":".")." ".$dataTeacher['teach_lname']." ".$dataTeacher['teach_xname']);?></strong>
				</td>
			</tr>
			<tr>
				<td align="left" colspan="7" style="">
				<i>Verified as to the prescribed office hours.</i>				
				</td>
			</tr>
			<tr>
				<td align="left" colspan="7" style="">			
				</td>
			</tr>
			<tr>
				<td align="left" colspan="3" style=""></td>
				<td align="center" colspan="4" style="BORDER-BOTTOM: black solid 1px">
				<?php
				$checkSupervisor = dbquery("select * from teacherappointments where (teacherappointments_teach_no='".$dataTeacher['teach_no']."' and teacherappointments_active='1')");
				$dataSupervisor = dbarray($checkSupervisor);
				if(substr($dataSupervisor['teacherappointments_position'],0,9)=="PRINCIPAL"){
					$supervisor = $current_psds;					
				}
				else {
					$supervisor = $current_principal;					
				}
				?>
				<strong><font size="2"><?php echo $supervisor;?></strong></font>
				</td>
			</tr>
			<tr>
				<td align="left" colspan="3" style=""></td>
				<td align="center" colspan="4">
				In Charge
				</td>
			</tr>
		</table>
	</td>
	<td width="50%" align="center">
		<table border="0" cellspacing="0" cellpadding="1" width="90%">
			<tr><td colspan="7" >CIVIL SERVICE FORM No. 48<br><br></td></tr>
			<tr><td colspan="7" align="center"><font size="3"><strong>DAILY TIME RECORD</strong></font></td></tr>
			<tr><td colspan="7" align="center" style="BORDER-BOTTOM: black solid 1px"><br><font size="2"><strong><?php echo strtoupper($dataTeacher['teach_fname']." ".substr($dataTeacher['teach_mname'],0,1).($dataTeacher['teach_mname']=="-"?"":".")." ".$dataTeacher['teach_lname']." ".$dataTeacher['teach_xname']);?></strong></td></tr>
			<tr><td colspan="7" align="center"><i>(Name)</i></td></tr>
			<tr>
				<td colspan="3" width="35%">For the month of </td>
				<td colspan="4" align="center" style="BORDER-BOTTOM: black solid 1px"><strong><?php echo date('F, Y',strtotime($_GET['year']."-".$_GET['month']."-01")); ?></strong></td>
			</tr>
			<tr>
				<td colspan="3">Office hours for arrival</td>
				<td colspan="2" align="center">Regular Days</td>
				<td colspan="2" align="center" style="BORDER-BOTTOM: black solid 1px"><small>7:30A-12P/1P-5PM</small></td>
			</tr>
			<tr>
				<td colspan="3" align="center">and departure</td>
				<td colspan="2" align="center">Saturdays</td>
				<td colspan="2" align="center" style="BORDER-BOTTOM: black solid 1px"><small>As Required</small></td>
			</tr>
			<tr>
				<td colspan="7"></td>
			</tr>
			<tr>
				<td align="center" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"></td>
				<td colspan="2" align="center" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"><strong>AM</strong></td>
				<td colspan="2" align="center" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"><strong>PM</strong></td>
				<td colspan="2" align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"><strong>UNDERTIME</strong></td>
			</tr>
			<tr height="2">
				<td align="center" width="5%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>DAY</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Arrival</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Departure</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Arrival</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Departure</small></td>
				<td align="center" width="13%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Hours</small></td>
				<td align="center" width="13%" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Minutes</small></td>
			</tr>
			<?php
			for($i=1;$i<=31;$i++){
			?>
			<tr height="20">
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo $i;?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$i." 00:00:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$i." 11:59:59";
				$checkAMIn = dbquery("select * from checkinout where (USERID='".$dataTeacher['teach_bio_no']."' and CHECKTYPE='I' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME asc");
				$dataAMIn = dbarray($checkAMIn );
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataAMIn['CHECKTIME']==""?"":date('g:ia', strtotime($dataAMIn['CHECKTIME'])));?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$i." 8:00:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$i." 13:00:00";
				$checkAMOut = dbquery("select * from checkinout where (USERID='".$dataTeacher['teach_bio_no']."' and CHECKTYPE='O' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME desc");
				$dataAMOut = dbarray($checkAMOut );
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataAMOut['CHECKTIME']==""?"":date('g:ia', strtotime($dataAMOut['CHECKTIME'])));?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$i." 12:30:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$i." 16:59:59";
				$checkPMIn = dbquery("select * from checkinout where (USERID='".$dataTeacher['teach_bio_no']."' and CHECKTYPE='I' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME asc");
				$dataPMIn = dbarray($checkPMIn );
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataPMIn['CHECKTIME']==""?"":date('g:ia', strtotime($dataPMIn['CHECKTIME'])));?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$i." 14:00:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$i." 23:59:59";
				$checkPMOut = dbquery("select * from checkinout where (USERID='".$dataTeacher['teach_bio_no']."' and CHECKTYPE='O' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME desc");
				$dataPMOut = dbarray($checkPMOut );
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataPMOut['CHECKTIME']==""?"":date('g:ia', strtotime($dataPMOut['CHECKTIME'])));?></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"></td>
				<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"></td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
			</tr>
			<tr height="25">
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="left" colspan="4" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"><strong>TOTAL</strong></td>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
				<td align="center" style="BORDER-RIGHT: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 2px"></td>
			</tr>
			<tr>
				<td align="center" colspan="7">
				<i>I CERTIFY on my honor that the above is a true and correct report of the hours of work perform, record of which was made daily at the time of arrival and departure from office.</i>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="7" style="BORDER-BOTTOM: black solid 1px">
				<font size="2"><br><strong><?php echo strtoupper($dataTeacher['teach_fname']." ".substr($dataTeacher['teach_mname'],0,1).($dataTeacher['teach_mname']=="-"?"":".")." ".$dataTeacher['teach_lname']." ".$dataTeacher['teach_xname']);?></strong>
				</td>
			</tr>
			<tr>
				<td align="left" colspan="7" style="">
				<i>Verified as to the prescribed office hours.</i>				
				</td>
			</tr>
			<tr>
				<td align="left" colspan="7" style="">			
				</td>
			</tr>
			<tr>
				<td align="left" colspan="3" style=""></td>
				<td align="center" colspan="4" style="BORDER-BOTTOM: black solid 1px">
				<strong><font size="2"><?php echo $supervisor;?></strong></font>
				</td>
			</tr>
			<tr>
				<td align="left" colspan="3" style=""></td>
				<td align="center" colspan="4">
				In Charge
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>

