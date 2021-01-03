<?php
include "maincore.php";
$resultEnrollment = dbquery("SELECT * FROM studenroll WHERE enrol_no='".$_GET['enrol_no']."'");
$dataEnrollment = dbarray($resultEnrollment);

$enrol_status1=$_POST["enrol_status1"];
$result= dbquery("SELECT * FROM dropdowns WHERE field_category='$enrol_status1' ORDER BY field_no ASC ");
?>
<option value="">---select---</option>
<?php
while($data=dbarray($result)){
?>
	<option value="<?php echo $data['field_name']; ?>"><?php echo $data['field_name']; ?></option>

<?php	}
?>