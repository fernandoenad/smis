<div class="row-fluid">
	<div class="span12"><br>
	<?php
				$resultEnrol = dbquery("SELECT * FROM studenroll WHERE (enrol_sy='".$current_sy."' AND enrol_stud_no='".$_GET['showProfile']."')");
				$dataEnroll = dbarray($resultEnrol);
				$resultSectionName = dbquery("SELECT * FROM section WHERE section_name='".$dataEnroll['enrol_section']."'");
				$dataSectionName = dbarray($resultSectionName);
				$resultGradeOAll = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['showProfile']."' and class.class_sy='".$current_sy."') GROUP BY grade_sem ORDER BY grade_sem asc, pros_sort ASC");
				$countGradeOAll = dbrows($resultGradeOAll);
				if($countGradeOAll==0){ echo "No current enrollment!";}
				while($dataGradeOAll = dbarray($resultGradeOAll)){	
	?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="btn-toolbar  pull-right">
					<div class="btn-group">
					<a <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  title="Print Admission Slip" class="btn  btn-xs  btn-default" onclick="window.open('studAdmin.php?stud_no=<?php echo $data['stud_no']; ?>&enrol_sy=<?php echo $dataGradeOAll['grade_sy'];?>&enrol_sem=<?php echo $dataGradeOAll['grade_sem'];?>', 'newwindow', 'width=850, height=520'); return false;">
						<span class="glyphicon glyphicon-print"></span></a>
					<?php
					$resultGrade = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['showProfile']."' and grade.grade_sy='".$current_sy."') ORDER BY class_timeslots ASC");
					$countGrades = dbrows($resultGrade);

					?>													
					<a  <?php echo($_SESSION["user_role"]!=1?"disabled":"");?> href="addSubsCurrent.frm.php?enrol_stud_no=<?php echo $_GET['showProfile'];?>" class="btn  btn-xs  btn-default" title="Add Additional Subjects" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
							<span class="glyphicon glyphicon-plus"></span></a>	
					</div>	
				</div>
				
				Grade <?php echo $dataEnroll['enrol_level'];?> - <?php echo $dataEnroll['enrol_section'];?> | SY <?php echo $current_sy;?>-<?php echo $current_sy+1;?>, <?php echo ($dataGradeOAll['grade_sem']=="1"?"First Semester":($dataGradeOAll['grade_sem']=="2"?"Second Semester":"Full Year"));?> 
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
					<thead>
						<tr>
							<th width="18%">Course Code</th>
							<th>Descriptive Title</th>
							<th width="3%">Units</th>
							<th width="10%">Time</th>
							<th width="8%">Days</th>
							<th width="13%">Room</th>
							<th width="15%">Teacher</th>
							<th width="8%"></th>
						</tr>
					</thead>
					<tbody> 
					<?php
					$resultGrade = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['showProfile']."' and grade.grade_sy='".$current_sy."' and grade_sem='".$dataGradeOAll['grade_sem']."') ORDER BY grade_sem ASC, class_timeslots ASC, pros_sort ASC");
					$countUnits=0;
					while($dataGrade = dbarray($resultGrade)){
					?>													
						<tr>
							<?php
								$resultClassName = dbquery("select * from section where (section_no='".$dataGrade['class_section_no']."')");
								$dataClassName = dbarray($resultClassName);
							?>
							<td><?php echo $dataGrade['pros_title']; ?> <small><small>(<?php echo $dataClassName['section_name']; ?>)</small></small></td>
							<td><?php echo substr(ucwords(strtolower($dataGrade['pros_desc'])),0,30); ?>...
							<a href="#" title="Remarks" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="<?php echo $dataGrade['pros_desc']; ?>"><span class="glyphicon glyphicon-zoom-in"></a>
							</td>
							<td><?php echo number_format($dataGrade['pros_unit'],2); ?></td>
							<td><?php echo $dataGrade['class_timeslots']; ?></td>
							<td><?php echo $dataGrade['class_days']; ?></td>
							<td><?php echo $dataGrade['class_room']; ?></td>
							<?php
							$checkTeacher = dbquery("SELECT * FROM teacher WHERE teach_no='".$dataGrade['class_user_name']."'");
							$dataTeacher = dbarray($checkTeacher);
							?>
							<td><?php echo ($dataGrade['class_user_name']=="1"?"TBA":strtoupper($dataTeacher['teach_lname'].", ".substr($dataTeacher['teach_fname'],0,1).".")); ?></td>
							<td>
								<a  href="classEdit.frm.php?Update=Yes&grade_no=<?php echo $dataGrade['grade_no'] ;?>&sem=<?php echo $dataGrade['class_sem'];?>" title="Update" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
								<span class="glyphicon glyphicon-pencil"></span></a>
								<?php
									$disabledDelete1 = ($dataGrade['grade_final']<60?"":"disabled");
								?>	
								<a <?php echo($_SESSION["user_role"]!=1?"disabled":"");?> href="grade.scr.php?deleteGrade=Yes&grade_no=<?php echo $dataGrade['grade_no'] ;?>" <?php echo $disabledDelete1;?> <?php echo ($_SESSION["user_role"]==0?"disabled":"");?> <?php echo ($_SESSION["user_role"]==2?"disabled":"");?> title="Delete" onClick="return confirm('Are you sure you want to delete entry?')" class="btn  btn-xs  btn-default">
								<span class="glyphicon glyphicon-remove"></span></a>
							</td>
						</tr>
						<?php 
						$countUnits+=$dataGrade['pros_unit'];
						} 
						?>		
						<tr>
							<td align="right" colspan="2"><b>Total Units</b></td>
							<td colspan="6"><b><?php echo number_format($countUnits,2);?></b></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<?php } ?>
	</div>
</div>