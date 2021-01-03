<?php

require('maincore.php');
require('./phptopdfapp/fpdf.php');


$checkStudent = dbquery("SELECT * FROM studenroll inner join student on enrol_stud_no=stud_no inner join section on enrol_section=section_name WHERE (section_no='".$_GET['section_no']."' AND enrol_sy='".$_GET['enrol_sy']."' AND section_sy='".$_GET['enrol_sy']."'  AND (enrol_status1='ENROLLED' or enrol_status1='PROMOTED')) order by stud_gender desc, stud_lname asc, stud_fname asc");
$CountStudent = dbrows($checkStudent);
?>
<table border="1" width="200">
	<?php
	while($dataStudent = dbarray($checkStudent)){
		?>
		<tr height="100">
			<td align="center" valign="bottom">
				<img src="./barcodeapp/barcode.php?text=<?php echo $dataStudent['stud_no']; ?>" alt="testing" width="250" >
				<small><small><small><small><?php echo $dataStudent['stud_no']." * ".$dataStudent['stud_lname'].", ".$dataStudent['stud_fname']." ".$dataStudent['stud_xname']; ?><br><br></small></small></small></small>
				
			</td>
		</tr>
		<?php
	}
	
	?>
</table>