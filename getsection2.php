<?php
include "maincore.php";
$enrol_level=$_POST["enrol_level"];
$enrol_sy=$_POST["enrol_sy"];
$result= dbquery("SELECT * FROM section WHERE (section_level='$enrol_level' AND section_sy='$current_sy' and section_name NOT LIKE 'Z_T%') ORDER BY section_name ASC ");

?>
<option value="">TRANSFEREE</option>
<?php
while($data=dbarray($result)){
$resultClass = dbquery("SELECT * FROM studenroll WHERE (enrol_section='".$data['section_name']."' AND enrol_sy='".$current_sy."')");
$rowClass = dbrows($resultClass);
$resultCap = dbquery("SELECT * FROM section WHERE (section_name='".$data['section_name']."' AND section_sy='".$current_sy."')");
$rowCap = dbarray($resultCap);
?>
	<option value="<?php echo $data['section_name']; ?>"><?php echo $data['section_name'];?></option>";

<?php	}
?>
