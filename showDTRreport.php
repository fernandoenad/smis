<?php
session_start();
require('maincore.php');
$checkTeacher = dbquery("select * from teacher");
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
<table border="0" cellspacing="0" cellpadding="1" width="800" align="center">
<tr>
	<td width="50%" align="center">
		<table border="0" cellspacing="0" cellpadding="1" width="100%">
			<tr><td colspan="7" align="center"><font size="2"><strong><?php echo $current_school_name;?><br><?php echo $current_school_address;?></strong></td></tr>
			<tr><td colspan="7" align="center"><font size="3"><br><strong>DAILY ATTENDANCE RECORD/LOG for <?php echo date('F d, Y - D',strtotime($_GET['year']."-".$_GET['month']."-".$_GET['day'])); ?></strong></font><br><br></td></tr>
			
		</table>
	</td>
</table>

<table border="0" cellspacing="0" cellpadding="1" width="800" align="center">
<tr>			
			<tr>
				<td width="30%" align="center" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"><strong>EMPLOYEE NAME</strong></td>
				<td colspan="2" align="center" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"><strong>AM</strong></td>
				<td colspan="2" align="center" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"><strong>PM</strong></td>
				<td colspan="2" align="center" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px;"><strong>UNDERTIME</strong></td>
			</tr>
			<tr height="2">
				<td align="center" width="5%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>#</small></td>
				<td align="center" width="10%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Arrival</small></td>
				<td align="center" width="10%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Departure</small></td>
				<td align="center" width="10%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Arrival</small></td>
				<td align="center" width="10%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Departure</small></td>
				<td align="center" width="10%" style="BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Hours</small></td>
				<td align="center" width="10%" style="BORDER-RIGHT: black solid 1px; BORDER-TOP: black solid 1px; BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><small>Minutes</small></td>
			</tr>
			<?php
			$checkTeachers = dbquery("select * from teacher where teach_status='1' order by teach_lname asc, teach_fname asc, teach_mname asc");
			$i=0;
			while($dataTeachers = dbarray($checkTeachers)){
				$i++;
			?>
			<tr height="20">
				<td align="left" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo $i;?>. <?php echo strtoupper($dataTeachers['teach_lname'].", ".$dataTeachers['teach_fname']." ".$dataTeachers['teach_xname']." ".$dataTeachers['teach_mname']);?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$_GET['day']." 00:00:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$_GET['day']." 11:59:59";
				$checkAMIn = dbquery("select * from checkinout where (USERID='".$dataTeachers['teach_bio_no']."' and CHECKTYPE='I' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME asc");
				$dataAMIn = dbarray($checkAMIn );
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataAMIn['CHECKTIME']==""?"":date('g:ia', strtotime($dataAMIn['CHECKTIME'])));?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$_GET['day']." 8:00:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$_GET['day']." 13:00:00";
				$checkAMOut = dbquery("select * from checkinout where (USERID='".$dataTeachers['teach_bio_no']."' and CHECKTYPE='O' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME desc");
				$dataAMOut = dbarray($checkAMOut );
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataAMOut['CHECKTIME']==""?"":date('g:ia', strtotime($dataAMOut['CHECKTIME'])));?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$_GET['day']." 12:30:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$_GET['day']." 16:59:59";
				$checkPMIn = dbquery("select * from checkinout where (USERID='".$dataTeachers['teach_bio_no']."' and CHECKTYPE='I' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME asc");
				$dataPMIn = dbarray($checkPMIn );
				?>
				<td align="center" style="BORDER-LEFT: black solid 1px; BORDER-BOTTOM: black solid 1px"><?php echo ($dataPMIn['CHECKTIME']==""?"":date('g:ia', strtotime($dataPMIn['CHECKTIME'])));?></td>
				<?php
				$startlog = $_GET['year']."-".$_GET['month']."-".$_GET['day']." 14:00:00";
				$endlog = $_GET['year']."-".$_GET['month']."-".$_GET['day']." 23:59:59";
				$checkPMOut = dbquery("select * from checkinout where (USERID='".$dataTeachers['teach_bio_no']."' and CHECKTYPE='O' and CHECKTIME between '$startlog' and '$endlog') order by CHECKTIME desc");
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

			<tr>
				<td align="left" colspan="7" style="">			
				</td>
			</tr>
			<tr>
				<td align="left" colspan="3"><br>
				<strong><?php echo strtoupper($_SESSION["user_fullname"]);?> / <?php echo date("M d, Y @ h:ia");?></font>
				</td>
				<td align="center" colspan="4" style="BORDER-BOTTOM: black solid 1px"><br>
				<strong><font size="2"><?php echo strtoupper($current_principal);?></strong></font>
				</td>
			</tr>
			<tr>
				<td align="left" colspan="3" style="">
				Printed by/on
				</td>
				<td align="center" colspan="4">
				In Charge
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>

