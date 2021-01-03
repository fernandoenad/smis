<?php
session_start();
require ('maincore.php');

if(isset($_GET['DeleteSched']) && $_GET['DeleteSched']=="Yes"){
	$result1 = dbquery("delete from section where section_no='".$_GET['section_no']."'");	
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">List of Students for School Year <?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?></h4>
      </div>
      <div class="modal-body">
		<div class="card-body">
				<table class="table table-condensed">
					<thead>
						<th style="width:50px">Level</th>
						<th style="width:150px">Section</th>
						<th class="text-center"></th>
					</thead>
					<tbody>
					<?php
					$checkClasses= dbquery("SELECT * FROM section WHERE section_sy='".$_GET['enrol_sy']."' ORDER BY section_level ASC, section_name ASC");
					while($dataClasses = dbarray($checkClasses)){
					
					?>
					<tr>
						<td><?php echo $dataClasses['section_level'];?></td>
						<td><?php echo $dataClasses['section_name'];?></td>
						<?php
						$totalMale = 0;
						$totalFemale = 0;
						$checkMale = dbquery("SELECT * FROM studenroll INNER JOIN student ON enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataClasses['section_name']."' AND stud_gender='MALE')");
						$countMale = dbrows($checkMale);
						$totalMale += $countMale;
						$checkFemale = dbquery("SELECT * FROM studenroll INNER JOIN student ON enrol_stud_no=stud_no WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_section='".$dataClasses['section_name']."' AND stud_gender='FEMALE')");
						$countFemale = dbrows($checkFemale);
						$totalFemale += $countFemale;
						$total = $countMale+$countFemale;
						$resultGrade = dbquery("SELECT * FROM class INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (class.class_sy='".$_GET['enrol_sy']."' AND class.class_section_no='".$dataClasses['section_no']."') ORDER BY pros_no");
						$rowsGrade = dbrows($resultGrade);
						?>
						<td align="center">
							<a href="classUpdate.frm.php?enrol_sy=<?php echo $current_sy; ?>&section_no=<?php echo $dataClasses['section_no'] ;?>" title="Class settings" class="btn  btn-xs  btn-default"  data-toggle="modal" data-target="#modal-small" data-backdrop="static" data-keyboard="false" ><span class="glyphicon glyphicon-cog"></span></a>
							<a <?php echo ($rowsGrade>0?"disabled=disabled":"");?> <?php echo ($total>0?"disabled":"");?> href="viewSections.frm.php?DeleteSched=Yes&section_no=<?php echo $dataClasses['section_no'] ;?>" title="Delete" onClick="return confirm('Are you sure you want to delete entry?')" class="btn  btn-xs  btn-default">
									<span class="glyphicon glyphicon-remove"></span></a>
						</td>
					</tr>
					<?php		
				
					}
					?>
					</tbody>
				</table>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	  </form>
    </div>
