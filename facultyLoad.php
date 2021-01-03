<?php
session_start();
require('maincore.php');
$checkStudent = dbquery("SELECT * FROM users WHERE (user_no='".$_GET['teach_no']."')");
$dataStudent = dbarray($checkStudent );
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
		font-size: 0.6em;
	} 
	
	td {
		height: 10px;
		text-decoration: none;
		font-family: Tahoma, "Times New Roman", serif; 
		font-size: 0.7em;		
	}
	</style>
</head>	
<table border="0" cellspacing="0" cellpadding="0" width="800">
	<tr>
		<td width="60" valign="top"><img src="./assets/images/sanhs_logo.png" width="50"></td>
		<td align="left" valign="top">
		<strong><?php echo $current_school_name;?></strong><br>
		<?php echo $current_school_address;?>
		<h4>Teacher Load Slip<br>
		School Year <?php echo (isset($_GET['enrol_sy'])?$_GET['enrol_sy']:$current_sy);?>-<?php echo (isset($_GET['enrol_sy'])?$_GET['enrol_sy']+1:$current_sy+1);?><?php echo ($_GET['term']==12?"":($_GET['term']=="1"?", First Semester":($_GET['term']=="2"?", Second Semester":($current_sem=="1"?", First Semester":", Second Semester"))));?> 
		</h4>
		</td>
		<td align="right">
			<?php
				$student_image = "./assets/images/teachers/".$_GET['teach_no'].".jpg";
				$no_image = "./assets/images/noimage.jpg";
			?>
			<img src="<?php echo (file_exists($student_image) ? $student_image : $no_image); ?>" width="75" alt="" style="max-width:143px" />
		
		</td>
		<td align="center"><img src="./barcodeapp/barcode.php?text=<?php echo $_GET['teach_no']; ?>" alt="testing" /><br>Faculty No.: <?php echo $_GET['teach_no']; ?>
		</td>
	</tr>
</table>	
<table border="0" cellspacing="2	" cellpadding="0" width="800">
	<tr>
		<td width="16%" align="right">Teacher Fullname:</td>
		<td> <b><?php echo ($dataStudent['user_no']=="1"?"TBA":strtoupper($dataStudent['user_fullname']));?></td>
		<td width="12%" align="right"></td>
		<td width="15%" align="left"> </td>
	</tr>	
</table>	
<hr>
<div class="table-responsive">
	<table width="800" class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
		<thead>
			<tr>
				<th align="left" width="10%"><u>Code</th>
				<th align="left"><u>Descriptive Title</th>
				<th align="left" width="5%"><u>Units</th>
				<th align="left" width="10%"><u>Time</th>
				<th align="left" width="10%"><u>Days</th>
				<th align="left" width="13%"><u>Section</th>
				<th align="left" width="15%"><u>Room</th>
			</tr>
		</thead>
		<tbody> 
		
			<tr>
				<td>###</td>
				<td>Morning Ceremonies / Supervisory Activities</td>
				<td>###</td>
				<td bgcolor="lightgray">###</td>
				<td>###</td>
				<td>###</td>
				<td>###</td>
			</tr>
		<?php
		
		$resultGrade = dbquery("SELECT * FROM class INNER JOIN prospectus ON class_pros_no=pros_no WHERE (class_sy='".(isset($_GET['enrol_sy'])?$_GET['enrol_sy']:$current_sy)."' AND (class_sem='12' or class_sem='".$_GET['term']."') AND class_user_name='".$_GET['teach_no']."') ORDER BY class_timeslots ASC, pros_sort asc");
		$countUnits=0;
		$countHours=0;
		$hoursAdvisor=0;
		while($dataGrade = dbarray($resultGrade)){
		if(substr($dataGrade['pros_title'],0,3)!="***"){	
		?>													
			<tr>
				<td><?php echo $dataGrade['pros_title']; ?></td>
				<td><?php echo ucwords(strtolower($dataGrade['pros_desc'])); ?></td>
				<td><?php echo $dataGrade['pros_unit'];?></td>
				<td bgcolor="lightgray"><?php echo $dataGrade['class_timeslots']; ?></td>
				<td><?php echo $dataGrade['class_days']; ?></td>
				<?php
				$checkSection = dbquery("select * from class inner join section on class_section_no=section_no where section_no='".$dataGrade['class_section_no']."'");
				$dataSection = dbarray($checkSection);
				?>
				<td><?php echo $dataSection['section_name']; ?></td>
				<td><?php echo $dataGrade['class_room']; ?></td>
			</tr>
		<?php 
		$countHours += $dataGrade['pros_hoursPerWk'];
		$countUnits+=$dataGrade['pros_unit'];
		
		}
		}?>	
			<?php
				$checkAdvisor = dbquery("SELECT * FROM section WHERE (section_adviser='".$_GET['teach_no']."' and section_sy='".(isset($_GET['enrol_sy'])?$_GET['enrol_sy']:$current_sy)."')");
				$countAdvisor = dbrows($checkAdvisor);
				$dataAdvisor = dbarray($checkAdvisor);
				$hoursAdvisor = 5 * ($countAdvisor>1?1:$countAdvisor);
				if($countAdvisor>0){
				?>
				<tr>
					<td>###</td>
					<td>Homeroom Advisory</td>
					<td>0</td>
					<td bgcolor="lightgray">###</td>

					<?php
					$checkTeacher = dbquery("SELECT * FROM users WHERE user_no='".$dataGrade['class_user_name']."'");
					$dataTeacher = dbarray($checkTeacher);
					$resultGrade = dbquery("SELECT * FROM class INNER JOIN prospectus ON class_pros_no=pros_no WHERE (class_sy='".(isset($_GET['enrol_sy'])?$_GET['enrol_sy']:$current_sy)."' AND class_user_name='".$_GET['teach_no']."') ORDER BY class_timeslots ASC");
					$dataGrade = dbarray($resultGrade);
					$checkAdvisor = dbquery("SELECT * FROM section WHERE (section_adviser='".$_GET['teach_no']."' and section_sy='".(isset($_GET['enrol_sy'])?$_GET['enrol_sy']:$current_sy)."')");
					$dataAdvisor = dbarray($checkAdvisor);
					?>
					<td>M-F</td>
					<td><?php echo $dataAdvisor['section_name'];?></td>
					<td><?php echo $dataAdvisor['section_name'];?></td>
				</tr>
				<?php
				}
				else {
				}
				?>
			<tr>
				<td></td>
				<td align="right"><b>Total Units</b></td>
				<td><b><?php echo number_format($countUnits,2);?></b></td>
				<td><b><?php echo number_format($countHours+$hoursAdvisor,2);?> Hrs/Wk</b></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
</div><hr>
<table border="0" cellspacing="0" cellpadding="0" width="800">
	<tr>
		<td width="33%">Prepared by:<br><br><br></td>
		<td><br><br><br></td></td>
		<td width="33%">Conforme:<br><br><br></td>
	</tr>
	<tr>
		<?php
		$checkUser = dbquery("SELECT * FROM users WHERE user_no='".$_GET['teach_no']."'");
		$dataUser = dbarray($checkUser );
		?>
		<td align="center"><b>________________________</b><br>Schedule Planner</td>
		<td><br><br><br></td></td>
		<td align="center"><b><?php echo strtoupper($dataUser['user_fullname']);?></b><br>Teacher</td>
	</tr>	
	<tr>
		<?php
		$checkUser = dbquery("SELECT * FROM users WHERE user_name='".$_SESSION["user_name"]."'");
		$dataUser = dbarray($checkUser );
		?>
		<td colspan="3"><br>*** <?php echo date("M d, Y - D / h:i:s A");?> / <?php echo strtoupper($dataUser['user_fullname']);?> ***</font></td>
	</tr>		
</table>	