<?php
require('maincore.php');
$checkStudent = dbquery("select * from student inner join studenroll on stud_no=enrol_stud_no where (stud_no='".$_GET['grade_stud_no']."' and enrol_sy='$current_sy')");
$dataStudent = dbarray($checkStudent);

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
	</head>
	  <body>
		<table width='650' border='0' cellpadding="0" cellspacing="0">
			<tr>
			   <td width='30%' align="center">
			   <img src="./assets/images/students/<?php echo $_GET['grade_stud_no'];?>.jpg" alt="" style="max-width:143px" />
			     </td>
			    <td align='center'>
			   <font size='6'><u><?php echo strtoupper($dataStudent['stud_fname']." ".substr($dataStudent['stud_mname'],0,1).". ".$dataStudent['stud_lname']);?></u></font><BR>
			   <font><b>NAME OF STUDENT</b></font><BR><BR>
			   <font><b>Grade & Section:  <?php echo $dataStudent['enrol_level']." - ".$dataStudent['enrol_section'];?></b></font><BR>
			   </td>
			</tr>
		</table><br>
		<table width='650' border='1' cellpadding="0" cellspacing="0">
			<tr>
				<th rowspan="2">Name of Activity</th>
				<th rowspan="2">Date of Activity</th>
				<th colspan="2">Morning</th>
				<th colspan="2">Afternoon</th>
				<th rowspan="2">Remarks</th>

			</tr>
			<tr>
				<th>Time In</th>
				<th>Time Out</th>
				<th>Time In</th>
				<th>Time Out</th>
			</tr>
			<tr height="200">
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>

			</tr>
		</table>
	 </body>
</html>