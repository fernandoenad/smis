<?php
include "maincore.php";
?>
<option value="">---select---</option>
<?php
	$checkStrands = dbquery("select * from dropdowns where field_category='"."STRAND-".$_POST['enrol_track']."'");
	while($dataStrands = dbarray($checkStrands)){
?>
	<option value="<?php echo $dataStrands['field_name'];?>"><?php echo $dataStrands['field_name'];?></option>
<?php
	}
?>
