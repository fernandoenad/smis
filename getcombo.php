<?php
include "maincore.php";
?>
<option value="">---select---</option>
<?php
$checkStrands = dbquery("select * from dropdowns where field_category='COMBO-".$_POST['enrol_strand']."'");
while($dataStrands = dbarray($checkStrands)){
?>
	<option value="<?php echo $dataStrands['field_name'];?>"><?php echo $dataStrands['field_name'];?></option>
<?php
}
?>
