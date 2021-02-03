<?php
session_start();
require_once("maincore.php");

$sql = "SELECT * FROM student 
	INNER JOIN studenroll ON stud_no=enrol_stud_no 
	INNER JOIN studcontacts ON stud_no=studCont_stud_no 
	WHERE enrol_sy=$current_sy
	ORDER BY enrol_level ASC, enrol_section ASC, stud_lname ASC, stud_fname ASC";
$rs = $conn->query($sql);
?>
<small>
<small>
<small>
<table>
	<tr>
		<th>#</th>
		<th>Student No</th>
		<th>LRN</th>
		<th>Student Name</th>
		<th width="8%">Birthdate</th>
		<th>Grade Level</th>
		<th>Section</th>
		<th>Mother</th>
		<th>Father</th>
	</tr>
<?php
$i = 1;
while ($row = $rs->fetch_assoc()){
	?>
	<tr>
		<td><?php echo $i;?></td>
		<th><?php echo $row['stud_no'];?></th>
		<td><?php echo $row['stud_lrn'];?></td>
		<td><?php echo $row['stud_lname'];?>, <?php echo $row['stud_fname'];?></td>
		<td><?php echo $row['stud_bdate'];?></td>
		<td><?php echo $row['enrol_level'];?></td>
		<td><?php echo $row['enrol_section'];?></td>
		<td><?php echo $row['studCont_stud_flname'];?>, <?php echo $row['studCont_stud_ffname'];?> <?php echo $row['studCont_stud_fmname'];?></td>
		<td><?php echo $row['studCont_stud_mlname'];?>, <?php echo $row['studCont_stud_mfname'];?> <?php echo $row['studCont_stud_mmname'];?></td>
	</tr>
	<?php
	$i++;
}
?>
</table>
</small>
</small>
</small>