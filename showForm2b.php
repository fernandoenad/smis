<?php
require('maincore.php');

if(isset($_GET['Save']) && $_GET['Save']=="Yes"){
	$sch_no = $_POST['sch_no'];
	$fday = $_POST['fday'];
	$m1 = $_POST['m1'];
	$m2 = $_POST['m2'];
	$m3 = $_POST['m3'];
	$m4 = $_POST['m4'];
	$m5 = $_POST['m5'];
	$m6 = $_POST['m6'];
	$m7 = $_POST['m7'];
	$m8 = $_POST['m8'];
	$m9 = $_POST['m9'];
	$m10 = $_POST['m10'];
	$m11 = $_POST['m11'];
	$m12 = $_POST['m12'];
	$countStudents = count($_POST['sch_no']);
	for($i=0; $i<$countStudents; $i++){
		$schoolno = mysql_escape_string($sch_no[$i]);
		$firstday = mysql_escape_string($fday[$i]);
		$jun = mysql_escape_string($m1[$i]);
		$jul = mysql_escape_string($m2[$i]);
		$aug = mysql_escape_string($m3[$i]);
		$sep = mysql_escape_string($m4[$i]);
		$oct = mysql_escape_string($m5[$i]);
		$nov = mysql_escape_string($m6[$i]);
		$dec = mysql_escape_string($m7[$i]);
		$jan = mysql_escape_string($m8[$i]);
		$feb = mysql_escape_string($m9[$i]);
		$mar = mysql_escape_string($m10[$i]);
		$apr = mysql_escape_string($m11[$i]);
		$may = mysql_escape_string($m12[$i]);
		$result1 = dbquery("UPDATE school_days SET
			sch_firstday = '".$firstday."',
			sch_m1 = '".$jun."',
			sch_m2 = '".$jul."',
			sch_m3 = '".$aug."',
			sch_m4 = '".$sep."',
			sch_m5 = '".$oct."',
			sch_m6 = '".$nov."',
			sch_m7 = '".$dec."',
			sch_m8 = '".$jan."',
			sch_m9 = '".$feb."',
			sch_m10 = '".$mar."',
			sch_m11 = '".$apr."',
			sch_m12 = '".$may."'
			WHERE sch_no='".$schoolno."'
		");	
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<style>
	input {
    width: 35px;
	height: 23px;
	font-size:10px;
	text-align: center;
	}
	input[type=date] {
    width: 130px;
    height: 23px;
	}

	</style>
</head>	
<body>
<?php
$checkSchoolDays = dbquery("SELECT * FROM studenroll WHERE (enrol_section='".$_GET['classProfile']."' AND enrol_sy='".$current_sy."' AND enrol_stud_no NOT IN (SELECT sch_stud_no FROM school_days WHERE sch_sy='".$_GET['enrol_sy']."'))");
$rowsSchoolDays = dbrows($checkSchoolDays);
if($rowsSchoolDays>0){
	while($dataSchoolDays = dbarray($checkSchoolDays)){
			$insertSchoolDays = dbquery("INSERT INTO school_days (sch_no, sch_sy, sch_stud_no) VALUES ('', '".$_GET['enrol_sy']."', '".$dataSchoolDays['enrol_stud_no']."')");
	}
}
?>
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()">&times;</button>
        <h4 class="modal-title">Attendance for <?php echo $_GET['classProfile'];?> </h4>
      </div>
	  <form name="form1" method="post" action="showForm2b.php?Save=Yes">
	  <input type="hidden" id="user_name" name="user_name" maxlength="15" required="required" class="form-control" value="<?php echo $_SESSION["user_name"];?>" / autofocus>
      <div class="modal-body">
			<div class="card-body">
<table border="1" cellspacing="0" cellpadding="2" width="850" align="center">
	<tr align="center">
		<td width="2%">#</td>
		<td>Student Name</td>
		<td width="18%">First Day</td>
		<td width="5%">Jun</td>
		<td width="5%">Jul</td>
		<td width="5%">Aug</td>
		<td width="5%">Sep</td>
		<td width="5%">Oct</td>
		<td width="5%">Nov</td>
		<td width="5%">Dec</td>
		<td width="5%">Jan</td>
		<td width="5%">Feb</td>
		<td width="5%">Mar</td>
		<td width="5%">Apr</td>
		<td width="5%">May</td>
	</tr>
	<?php
	$checkAtt = dbquery("SELECT * FROM school_days WHERE (sch_sy='".$current_sy."' AND sch_stud_no='".$current_sy."')");
	$dataAtt1 = dbarray($checkAtt)
	?>
	<tr align="center" bgcolor="lightgray">
		<td></td>
		<td>Total School Days</td>
		<td align="center"><?php echo ($dataAtt1['sch_firstday']==0?"-":$dataAtt1['sch_firstday']);?></td>
		<td><?php echo ($dataAtt1['sch_m1']==0?"-":$dataAtt1['sch_m1']);?></td>
		<td><?php echo ($dataAtt1['sch_m2']==0?"-":$dataAtt1['sch_m2']);?></td>
		<td><?php echo ($dataAtt1['sch_m3']==0?"-":$dataAtt1['sch_m3']);?></td>
		<td><?php echo ($dataAtt1['sch_m4']==0?"-":$dataAtt1['sch_m4']);?></td>
		<td><?php echo ($dataAtt1['sch_m5']==0?"-":$dataAtt1['sch_m5']);?></td>
		<td><?php echo ($dataAtt1['sch_m6']==0?"-":$dataAtt1['sch_m6']);?></td>
		<td><?php echo ($dataAtt1['sch_m7']==0?"-":$dataAtt1['sch_m7']);?></td>
		<td><?php echo ($dataAtt1['sch_m8']==0?"-":$dataAtt1['sch_m8']);?></td>
		<td><?php echo ($dataAtt1['sch_m9']==0?"-":$dataAtt1['sch_m9']);?></td>
		<td><?php echo ($dataAtt1['sch_m10']==0?"-":$dataAtt1['sch_m10']);?></td>
		<td><?php echo ($dataAtt1['sch_m11']==0?"-":$dataAtt1['sch_m11']);?></td>
		<td><?php echo ($dataAtt1['sch_m12']==0?"-":$dataAtt1['sch_m12']);?></td>
	</tr>
	<tr>
	<?php
	$i=1;
	$result= dbquery("SELECT * FROM studenroll INNER JOIN student on studenroll.enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$current_sy."' AND studenroll.enrol_section='".$_GET['classProfile']."') ORDER BY stud_gender DESC, stud_lname ASC, stud_fname ASC");
	while($dataAttStud = dbarray($result)){
		$checkAtt = dbquery("SELECT * FROM school_days WHERE (sch_sy='".$dataAttStud['enrol_sy']."' AND sch_stud_no='".$dataAttStud['enrol_stud_no']."') ORDER BY sch_sy DESC, sch_no asc");
		$dataAtt = dbarray($checkAtt);
	?>
	<input type="hidden" name="sch_no[]" value="<?php echo $dataAtt['sch_no'];?>">
		<td><?php echo $i;?></td>
		<td><small><small><?php echo strtoupper($dataAttStud['stud_lname'].", ".substr($dataAttStud['stud_fname'],0,10));?>...</small></small></td>
		
		<td align="center"><input type="date" name="fday[]" value="<?php echo $dataAtt['sch_firstday'];?>"></td>
		<td align="center"><input type="number" step="0.01" name="m1[]" value="<?php echo $dataAtt['sch_m1'];?>" min="0" max="<?php echo $dataAtt1['sch_m1'];?>"></td>
		<td align="center"><input type="number" step="0.01" name="m2[]" value="<?php echo $dataAtt['sch_m2'];?>" min="0" max="<?php echo $dataAtt1['sch_m2'];?>"></td>
		<td align="center"><input type="number" step="0.01" name="m3[]" value="<?php echo $dataAtt['sch_m3'];?>" min="0" max="<?php echo $dataAtt1['sch_m3'];?>"></td>
		<td align="center"><input type="number" step="0.01" name="m4[]" value="<?php echo $dataAtt['sch_m4'];?>" min="0" max="<?php echo $dataAtt1['sch_m4'];?>"></td>
		<td align="center"><input type="number" step="0.01" name="m5[]" value="<?php echo $dataAtt['sch_m5'];?>" min="0" max="<?php echo $dataAtt1['sch_m5'];?>"></td>
		<td align="center"><input type="number" step="0.01" name="m6[]" value="<?php echo $dataAtt['sch_m6'];?>" min="0" max="<?php echo $dataAtt1['sch_m6'];?>"></td>
		<td align="center"><input type="number" step="0.01" name="m7[]" value="<?php echo $dataAtt['sch_m7'];?>" min="0" max="<?php echo $dataAtt1['sch_m7'];?>"></td>
		<td align="center"><input type="number" step="0.01" name="m8[]" value="<?php echo $dataAtt['sch_m8'];?>" min="0" max="<?php echo $dataAtt1['sch_m8'];?>"></td>
		<td align="center"><input type="number" step="0.01" name="m9[]" value="<?php echo $dataAtt['sch_m9'];?>" min="0" max="<?php echo $dataAtt1['sch_m9'];?>"></td>
		<td align="center"><input type="number" step="0.01" name="m10[]" value="<?php echo $dataAtt['sch_m10'];?>" min="0" max="<?php echo $dataAtt1['sch_m10'];?>"></td>
		<td align="center"><input type="number" step="0.01" name="m11[]" value="<?php echo $dataAtt['sch_m11'];?>" min="0" max="<?php echo $dataAtt1['sch_m11'];?>"></td>
		<td align="center"><input type="number" step="0.01" name="m12[]" value="<?php echo $dataAtt['sch_m12'];?>" min="0" max="<?php echo $dataAtt1['sch_m12'];?>"></td>
	</tr>	
	<?php $i++; } ?>
	</table>
</div>
 </div>
      <div class="modal-footer">
		<button type="submit" id="submit" name="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')" >Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
      </div>
	  </form>
    </div>
</body>
</html>