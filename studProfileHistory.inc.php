<div class="row-fluid">
	<div class="span12"><br>
		
		<div class="panel panel-default">
			<div class="panel-heading">
			    <div class="btn-toolbar  pull-right">
				<?php
					$resultCheckEnrollment = dbquery("SELECT * FROM studenroll WHERE enrol_stud_no='".$data['stud_no']."' ORDER BY enrol_sy DESC");
					$rowCheckEnrollment = dbrows($resultCheckEnrollment);
					$dataCheckEnrollment = dbarray($resultCheckEnrollment);
					$resultCheckEnrollmentCurrentSY = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$data['stud_no']."' AND enrol_sy='".$current_sy."')");
					$rowCheckEnrollmentCurrentSY = dbrows($resultCheckEnrollmentCurrentSY);
					if($rowCheckEnrollment==0 || $rowCheckEnrollmentCurrentSY==1 || $dataCheckEnrollment['enrol_status2'] == "TRANSFERRED OUT")
						$disableEnroll = "disabled";
					else
						$disableEnroll = "";
				?>
					<div class="btn-group">
					<div class="btn-group">

					<a href="anecdotalCredentials.frm.php?stud_no=<?php echo $_GET['showProfile'];?>" <?php echo ($_SESSION["user_role"]==0?"disabled":"");?> title="View Submitted Credentials" data-toggle="modal" data-target="#modal-medium"  data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
						<span class="glyphicon glyphicon-list"></span></a>

					
						  <a <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  href="enrollmentHistNew.frm.php?showProfile=<?php echo $data['stud_no'];?>" class="btn  btn-xs  btn-default" title="Add History" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false"><span class="glyphicon glyphicon-plus"></a>
							<?php 
							if($_SESSION["user_role"]!=0){
								$checkAssessment = dbquery("SELECT *, SUM(ass_amount) as total  FROM bill_assessment INNER JOIN  bill_bills ON ass_bill_no=bill_no WHERE (ass_sy!='".$current_sy."' AND ass_stud_no='".$_GET['showProfile']."' and ass_invoice_no=0) ORDER BY bill_prio ASC");
								$dataAssessment = dbarray($checkAssessment);
							?>	
						<?php
						if($rowCheckEnrollment==0 && $current_school_minlevel==0){
						?>
						  <a href="enrollmentNew.frm.php?showProfile=<?php echo $data['stud_no'];?>" class="btn  btn-xs  btn-success" title="Enroll Kinder" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false">Enroll Kinder</a>
						<?php
						}
						?>
						<a href="enrollmentNew.frm.php?showProfile=<?php echo $data['stud_no'];?>" class="btn  btn-xs  btn-default" title="Enroll Student" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false" <?php echo $disableEnroll; ?>><span class="glyphicon glyphicon-log-in"></span></a>
							<?php } ?>
							
					</div>
					</div>
				</div>
				Enrollment History
			</div>
			
			<div class="table-responsive">
				<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
					<thead>
						<tr>
							<th width="13%">School Year</th>
							<th >School</th>
							<th width="5%">Level</th>
							<th width="13%">Section</th>
							<th width="25%">Status</th>
							<th width="5%">Average</th>
							<th width="10%"></th>
						</tr>
					</thead>
					<tbody> 
					<?php
						$resultEnrollHist = dbquery("SELECT * FROM studenroll WHERE enrol_stud_no='".$data['stud_no']."' ORDER BY enrol_sy DESC, enrol_no DESC, enrol_level DESC ");
						while ($dataEnrollHist = dbarray($resultEnrollHist)){
					?>
						<tr>
							<td><?php echo $dataEnrollHist['enrol_sy']; ?> - <?php echo $dataEnrollHist['enrol_sy']+1; ?></td>
							<?php
								$dataSchoolArray = unserialize($dataEnrollHist['enrol_school']);
							?>
							<td><small><small><?php echo strtoupper($dataSchoolArray['1']); ?> - <?php echo strtoupper($dataSchoolArray['2']); ?></small></small></td>
							<td><?php echo $dataEnrollHist['enrol_level']; ?></td>
							<td><?php echo strtoupper(($dataEnrollHist['enrol_section']==""?"SYS HIST":$dataEnrollHist['enrol_section'])); ?></td>
							<td><small><?php echo $dataEnrollHist['enrol_status1']; ?> (<?php echo $dataEnrollHist['enrol_status2']; ?>) </small>
								<a href="#" title="Remarks" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="<?php echo strtoupper($dataEnrollHist['enrol_remarks']); ?>"><span class="glyphicon glyphicon-zoom-in"></a>
							</td>
							<td><?php echo (number_format($dataEnrollHist['enrol_average'],3)==0?"-":number_format($dataEnrollHist['enrol_average'],3)); ?></td>
							<td><?php
								if($dataEnrollHist['enrol_sy']==$current_sy){
								?>
								<a <?php echo($_SESSION["user_role"]==2?"disabled":"");?> <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  href="enrollmentUpdate.frm.php?enrol_no=<?php echo $dataEnrollHist['enrol_no'];?>" title="Modify Current Enrollment" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
									<span class="glyphicon glyphicon-pencil"></span></a>
								<?php
								}
								else{
								?>
								<a <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  href="enrollmentHistoryUpdate.frm.php?enrol_no=<?php echo $dataEnrollHist['enrol_no'];?>" title="Modify Enrollment History" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
									<span class="glyphicon glyphicon-pencil"></span></a>
								<?php
								}
								?>
								<?php
									$checkGrades = dbquery("SELECT * FROM grade INNER JOIN class ON grade_class_no=class_no INNER JOIN prospectus ON class_pros_no=pros_no WHERE (grade_stud_no='".$data['stud_no']."' and grade_sy='".$dataEnrollHist['enrol_sy']."' and grade_final>60) ORDER BY pros_sem ASC LIMIT 0,1");
									$dataGrades = dbarray($checkGrades);
									$rowCheckGrades = dbrows($checkGrades);
									$disabledUnEnroll = ($rowCheckGrades>0?"disabled":"");
								?>																
								<a <?php echo($_SESSION["user_role"]==2?"disabled":"");?> <?php echo $disabledUnEnroll;?> <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  href="./confirmAdmin.frm.php?enrol_no=<?php echo $dataEnrollHist['enrol_no']; ?>&showProfile=<?php echo $data['stud_no'];?>&enrol_sy=<?php echo $dataEnrollHist['enrol_sy'];?>" title="Unenroll Student" data-toggle="modal" data-target="#modal-small" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
									<span class="glyphicon glyphicon-log-out"></span></a>
								<?php
								
									$check2ndSemEnrolled = dbquery("SELECT * FROM grade INNER JOIN class ON grade_class_no=class_no INNER JOIN prospectus ON class_pros_no=pros_no WHERE (grade_stud_no='".$data['stud_no']."' AND grade_sy='".$current_sy."' AND class_sem='2')");
									$rowsCheck2ndSemEnrolled = dbrows($check2ndSemEnrolled);
									$disabled2ndSemEnroll = ($rowsCheck2ndSemEnrolled>0?"disabled":"");
								?>
								<a <?php echo($_SESSION["user_role"]==2?"disabled":"");?> <?php echo ($dataEnrollHist['enrol_sy']!=$current_sy?"disabled":"");?> <?php echo $disabled2ndSemEnroll;?> <?php echo $disabled2ndSemEnroll;?> <?php echo ($dataEnrollHist['enrol_level']<11?"disabled":($current_sem==2?"":"disabled"));?>  href="add2ndSemSubs.frm.php?stud_no=<?php echo $data['stud_no'];?>" title="Add 2nd Sem Subjects" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
									<span class="glyphicon glyphicon-log-in"></span></a>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
			
		</div>
		


	</div>
</div>