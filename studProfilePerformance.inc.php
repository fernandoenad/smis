<div  class="tabbable"><br>
		<ul class="nav nav-tabs">
		<li class="<?php echo ($_GET['tab2']=="grades"?"active":"");?>" ><a href="?page=student&showProfile=<?php echo $_GET['showProfile'];?>&tab=performance&tab2=grades">Grades</a></li>
		<li class="<?php echo ($_GET['tab2']=="form137"?"active":"");?>" ><a href="?page=student&showProfile=<?php echo $_GET['showProfile'];?>&tab=performance&tab2=form137">Form 137</a></li>
		</ul>
		<div class="tab-content">
		<div class="<?php echo ($_GET['tab2']=="grades"?"tab-pane active":"tab-pane");?>" id="grades">
	<div class="row-fluid">
		<div class="span12"><br>
		<?php
					$resultEnrol = dbquery("SELECT * FROM studenroll WHERE (enrol_sy='".$current_sy."' AND enrol_stud_no='".$_GET['showProfile']."')");
					$dataEnroll = dbarray($resultEnrol);
					$resultGradeOAll = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['showProfile']."' and class.class_sy='".$current_sy."') GROUP BY grade_sem ORDER BY grade_sem asc, pros_sort ASC");
					$countGradeOAll = dbrows($resultGradeOAll);
					if($countGradeOAll==0){ echo "No current enrollment!";}
					while($dataGradeOAll = dbarray($resultGradeOAll)){
					?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="btn-toolbar  pull-right">
					<div class="btn-group">
						<a <?php echo($_SESSION["user_role"]!=1?"disabled":"");?> <?php echo ($_SESSION["user_role"]==0?"disabled":"");?> href="updateStudentGrades1.frm.php?stud_no=<?php echo $_GET['showProfile']; ?>&enrol_sy=<?php echo $current_sy;?>&enrol_sem=<?php echo $dataGradeOAll['grade_sem'];?>" title="Update" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
						<a <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  href="" class="btn  btn-xs  btn-default" onclick="window.open('studGrade.php?stud_no=<?php echo $_GET['showProfile']; ?>&enrol_sy=<?php echo $dataGradeOAll['grade_sy'];?>&enrol_sem=<?php echo $dataGradeOAll['grade_sem'];?>', 'newwindow', 'width=1050, height=600'); return false;" Title="Print Form 138/Form 9"><span class="glyphicon glyphicon-print"></span> Form 138/9</a>
						<a <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  href="" class="btn  btn-xs  btn-default" onclick="window.open('studGrade1.php?stud_no=<?php echo $_GET['showProfile']; ?>&enrol_sy=<?php echo $dataGradeOAll['grade_sy'];?>&enrol_sem=<?php echo $dataGradeOAll['grade_sem'];?>', 'newwindow', 'width=1050, height=600'); return false;" Title="Print Grade Slip"><span class="glyphicon glyphicon-print"></span> Grade Slip</a>
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
								<th width="3%">Q1</th>
								<th width="3%">Q2</th>
								<th width="3%">Q3</th>
								<th width="3%">Q4</th>
								<th width="5%">Final</th>
								<th width="8%">Remarks</th>	
								<th width="15%">Teacher</th>
								<th width="8%"></th>
								
							</tr>
						</thead>
						<tbody> 
							<?php
							$resultGrade1 = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['showProfile']."' and class.class_sy='".$current_sy."' and grade_sem='".$dataGradeOAll['grade_sem']."') ORDER BY grade_sem ASC, pros_sort ASC");
							$aveQ1=0;
							$aveQ2=0;
							$aveQ3=0;
							$aveQ4=0;
							$aveQf=0;
							$gradedUnits1=0;
							$gradedUnits2=0;
							$gradedUnits3=0;
							$gradedUnits4=0;
							$gradedUnitsqf=0;
							$countUnits=0;
							$gradedUnits=0;
							while($dataGrade1 = dbarray($resultGrade1)){
							?>													
							<tr>
								<?php
									$resultClassName = dbquery("select * from section where (section_no='".$dataGrade1['class_section_no']."')");
									$dataClassName = dbarray($resultClassName);
								?>
								<td><?php echo $dataGrade1['pros_title']; ?> <small>(<?php echo substr($dataClassName['section_name'],0,3); ?>)</small></td>
								<td><?php echo substr(ucwords(strtolower($dataGrade1['pros_desc'])),0,30); ?>...
								<a href="#" title="Remarks" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="<?php echo $dataGrade1['pros_desc']; ?>"><span class="glyphicon glyphicon-zoom-in"></a>
								</td>
								<td><?php echo number_format($dataGrade1['pros_unit'],2); ?></td>
								<td><?php echo ($dataGrade1['grade_q1']<60?"-":$dataGrade1['grade_q1']); 
								$aveQ1 += ($dataGrade1['grade_q1']*$dataGrade1['pros_unit']);?></td>
								<td><?php echo ($dataGrade1['grade_q2']<60?"-":$dataGrade1['grade_q2']); 
								$aveQ2 += ($dataGrade1['grade_q2']*$dataGrade1['pros_unit']);?></td>
								<td><?php echo ($dataGrade1['grade_q3']<60?"-":$dataGrade1['grade_q3']); 
								$aveQ3 += ($dataGrade1['grade_q3']*$dataGrade1['pros_unit']);?></td>
								<td><?php echo ($dataGrade1['grade_q4']<60?"-":$dataGrade1['grade_q4']); 
								$aveQ4 += ($dataGrade1['grade_q4']*$dataGrade1['pros_unit']);?></td>
								<td><strong>
								<?php 
								if($dataGrade1['pros_level']<11 && ($dataGrade1['grade_q1']<60 || $dataGrade1['grade_q2']<60 || $dataGrade1['grade_q3']<60 || $dataGrade1['grade_q4']<60)){
									echo "-";
								}
								else if($dataGrade1['pros_level']>10 && ($dataGrade1['grade_q1']<60 || $dataGrade1['grade_q2']<60)){
									echo "-";
								}
								else {
									echo $dataGrade1['grade_final'];
								}
								$aveQf += ($dataGrade1['grade_final']*$dataGrade1['pros_unit']);?></strong></td>
								<td>
								<?php
								if($dataGrade1['pros_level']<11 && ($dataGrade1['grade_q1']<60 || $dataGrade1['grade_q2']<60 || $dataGrade1['grade_q3']<60 || $dataGrade1['grade_q4']<60)){
									echo "-";
								}
								else if($dataGrade1['pros_level']>10 && ($dataGrade1['grade_q1']<60 || $dataGrade1['grade_q2']<60)){
									echo "-";
								}
								else {
									echo ($dataGrade1['grade_final']>=74.5?"PASSED":"FAILED");
								}										
								?>
								</td>
								<?php
								$checkTeacher = dbquery("SELECT * FROM teacher WHERE teach_no='".$dataGrade1['class_user_name']."'");
								$dataTeacher = dbarray($checkTeacher);
								?>
								<td><?php echo ($dataGrade1['class_user_name']=="1"?"TBA":$dataTeacher['teach_lname'].", ".substr($dataTeacher['teach_fname'],0,1)."."); ?></td>
								<td>
									<a <?php echo($_SESSION["user_role"]!=1?"disabled":"");?> <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  href="updateStudentGrades.frm.php?grade_no=<?php echo $dataGrade1['grade_no']; ?>" title="Update" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
									<span class="glyphicon glyphicon-pencil"></span></a>
								</td>
							</tr>
							<?php 
							if($dataGrade1['grade_q1']<60){
								$gradedUnits1+=0;
							} else {
								$gradedUnits1+=$dataGrade1['pros_unit'];
							}
							if($dataGrade1['grade_q2']<60){
								$gradedUnits2+=0;
							}else {
								$gradedUnits2+=$dataGrade1['pros_unit'];
							}
							if($dataGrade1['grade_q3']<60){
								$gradedUnits3+=0;
							}else {
								$gradedUnits3+=$dataGrade1['pros_unit'];
							}
							if($dataGrade1['grade_q4']<60){
								$gradedUnits4+=0;
							}else {
								$gradedUnits4+=$dataGrade1['pros_unit'];
							}
							if($dataGrade1['grade_final']<60){
								$gradedUnitsqf+=0;
							}
							else {
								$gradedUnitsqf+=$dataGrade1['pros_unit'];
							}
							$countUnits+=$dataGrade1['pros_unit'];
							$pros_level=$dataGrade1['pros_level'];
							} 
							
							?>
							<tr>
								<td align="right" colspan="2"><b>Total Units / Gen. Ave.</b></td>
								<td><b><?php echo number_format($countUnits,2);?></b></td>
								<td align="left"><b><?php echo $q1=($countUnits!=$gradedUnits1?"-":round($aveQ1/$countUnits,0));?></b></td>
								<td align="left"><b><?php echo $q2=($countUnits!=$gradedUnits2?"-":round($aveQ2/$countUnits,0));?></b></td>
								<td align="left"><b><?php echo $q3=($countUnits!=$gradedUnits3?"-":round($aveQ3/$countUnits,0));?></b></td>
								<td align="left"><b><?php echo $q4=($countUnits!=$gradedUnits4?"-":round($aveQ4/$countUnits,0));?></b></td>
								<td align="left">
								<b>
								<?php 
								if($pros_level<11 && ($q1=="-" || $q2=="-"|| $q3=="-" || $q4=="-")){
									echo "-";
								}
								else if($pros_level>10 && ($q1=="-" || $q2=="-")){
									echo "-";
								}
								else {
									echo round($aveQf/$countUnits,0);
								} 	
								
								?>
								<!--<?php echo ($countUnits!=$gradedUnitsqf?"-":round($aveQf/$countUnits,0));?> -->
								</b></td>
								<?php
								$resultEnrolInfo = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['showProfile']."' AND enrol_sy='".$dataEnroll['enrol_sy']."')");
								$dataEnrolInfo = dbarray($resultEnrolInfo);
								?>
								<td colspan="3"><strong><?php echo ($dataEnrolInfo['enrol_status2']=="IRREGULAR"?"CONDITIONAL":$dataEnrolInfo['enrol_status2']);?></strong></td>
								
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>

<div class="<?php echo ($_GET['tab2']=="form137"?"tab-pane active":"tab-pane");?>" id="form137">
	<div class="row-fluid">
		<div class="span12"><br>
					
				<?php
				$checkEnrollES = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['showProfile']."' AND enrol_level<='6') order by enrol_sy asc");
				$rowEnrollES = dbrows($checkEnrollES);
				$checkEnrollJHS = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['showProfile']."' AND (enrol_level>='6' and enrol_level<='10'))");
				$rowEnrollJHS = dbrows($checkEnrollJHS);
				$checkEnrollSHS = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['showProfile']."' AND enrol_level>='10')");
				$rowEnrollSHS = dbrows($checkEnrollSHS);


				
				?>
				<div class="pull-right">
				<?php
				if($rowEnrollES>1){
				?>
				<a <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  title="Print ES Form 137 / Form 10-ES" href="" class="btn  btn-xs  btn-default" onclick="window.open('form137es.php?grade_stud_no=<?php echo $_GET['showProfile']; ?>', 'newwindow', 'width=820, height=600'); return false;" Title="Print Form 137A">SF10-ES <span class="glyphicon glyphicon-print"></span></a>
				<?php
				}
				if($rowEnrollJHS>1){
				?>
				<a <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  title="Print JHS Form 137 / Form 10-JHS" href="" class="btn  btn-xs  btn-default" onclick="window.open('form137jhs_<?php echo($dataEnroll['enrol_level']>=10?"o":"n");?>.php?grade_stud_no=<?php echo $_GET['showProfile']; ?>', 'newwindow', 'width=820, height=600'); return false;" Title="Print Form 137A">SF10-JHS <span class="glyphicon glyphicon-print"></span></a>
				<?php
				}
				if($rowEnrollSHS>1){
				?>
				<a <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  title="Print SHS Form 137 / Form 10-SHS" href="" class="btn  btn-xs  btn-default" onclick="window.open('form137shs.php?grade_stud_no=<?php echo $_GET['showProfile']; ?>', 'newwindow', 'width=820, height=600'); return false;" Title="Print Form 137A">SF10-SHS <span class="glyphicon glyphicon-print"></span></a>
				<?php
				}
				?>
				</div>
				<?php
				if($current_school_minlevel>=0 && $current_school_maxlevel<=6){
					$resultEnrolHist = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['showProfile']."' and enrol_sy!='".$current_sy."' and (enrol_level>=1 and enrol_level<=6)) order by enrol_sy asc");
				} 
				else if($current_school_minlevel<=7 && $current_school_maxlevel<=10){
					$resultEnrolHist = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['showProfile']."' and enrol_sy!='".$current_sy."' and (enrol_level>=7 and enrol_level<=10)) order by enrol_sy asc");
				}
				else if($current_school_minlevel<=7 && $current_school_maxlevel<=12){
					$resultEnrolHist = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['showProfile']."' and enrol_sy!='".$current_sy."' and (enrol_level>=7 and enrol_level<=12)) order by enrol_sy asc");
				}
				else if($current_school_minlevel<=11 && $current_school_maxlevel<=12){
					$resultEnrolHist = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['showProfile']."' and enrol_sy!='".$current_sy."' and (enrol_level>=11 and enrol_level<=12)) order by enrol_sy asc");
				}

				while($dataEnrolHist = dbarray($resultEnrolHist)){
					$checkEnrolInSY = dbquery("select * from grade where (grade_sy='".$dataEnrolHist['enrol_sy']."' and grade_stud_no='".$_GET['showProfile']."')");
					$countEnrolInSY = (isset($checkEnrolInSY) ? dbrows($checkEnrolInSY): 0);
					$setDisabled = "";
				?>
				<a <?php echo($_SESSION["user_role"]==0?"disabled":"");?> <?php echo $setDisabled;?> <?php echo ($_SESSION["user_role"]==0?"disabled":"");?> <?php echo ($countEnrolInSY>0?"disabled=disabled":"");?> href="addSubs.frm.php?enrol_stud_no=<?php echo $_GET['showProfile'];?>&enrol_sy=<?php echo $dataEnrolHist['enrol_sy'];?>&enrol_level=<?php echo $dataEnrolHist['enrol_level'];?>&enrol_sem=%&all" class="btn  btn-xs  btn-default" title="Add Historical Subjects" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
							<span class="glyphicon glyphicon-plus"> SY <?php echo round($dataEnrolHist['enrol_sy'],0);?></span></a>
				<?php
				}
				?>
				
				<br><br>

			
			<?php
			$resultForm137 = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['showProfile']."' and enrol_level>=$current_school_minlevel) ORDER BY enrol_level ASC, enrol_sy ASC ");
			while($dataForm137 = dbarray($resultForm137)){
				$dataEnrollmentSchool = unserialize($dataForm137['enrol_school']);
				$enrol_sy = $dataForm137['enrol_sy'];
				$resultGradeOAll = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['showProfile']."' and grade_sy='".$enrol_sy."') GROUP BY grade_sem ORDER BY grade_sem ASC, pros_sort ASC");
				while($dataGradeOAll = dbarray($resultGradeOAll)){
				?>
				<div class="panel panel-default">
					<div class="panel-heading">
						Grade <?php echo $dataForm137['enrol_level'];?>- <?php echo strtoupper($dataForm137['enrol_section']);?> | <?php echo strtoupper($dataEnrollmentSchool['1']." - ".$dataEnrollmentSchool['2']." (".$dataEnrollmentSchool['0'].")");?>,  SY: <?php echo round($dataForm137['enrol_sy'],0);?>-<?php echo round($dataForm137['enrol_sy'],0)+1;?>, <?php echo ($dataGradeOAll['grade_sem']=="1"?"First Semester":($dataGradeOAll['grade_sem']=="2"?"Second Semester":"Full Year"));?> 
						<div class="pull-right">
							<a <?php echo($_SESSION["user_role"]!=1?"disabled":"");?> href="gradesHistNew.scr.php?enrol_stud_no=<?php echo $_GET['showProfile'];?>&enrol_sy=<?php echo $dataForm137['enrol_sy'];?>&enrol_level=<?php echo $dataForm137['enrol_level'];?>&DeleteGradeHist=Yes" class="btn  btn-xs  btn-default" onClick="return confirm('Are you sure you want to delete historical grades \nfor SY <?php echo $dataForm137['enrol_sy'];?>-<?php echo $dataForm137['enrol_sy']+1;?>?')" <?php echo ($dataForm137['enrol_sy']==$current_sy?"disabled=disabled":"");?>>
							<span class="glyphicon glyphicon-remove"></span></a>
							<a <?php echo($_SESSION["user_role"]==0?"disabled":"");?> href="updateStudentGrades1.frm.php?stud_no=<?php echo $_GET['showProfile']; ?>&enrol_sy=<?php echo $dataGradeOAll['grade_sy'];?>&enrol_sem=<?php echo $dataGradeOAll['grade_sem'];?>" title="Update" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
							<span class="glyphicon glyphicon-pencil"></span></a>
							<a <?php echo($_SESSION["user_role"]!=1?"disabled":"");?> <?php echo($dataGradeOAll['grade_sy']==$current_sy && $dataGradeOAll['grade_sem']==$current_sem?"disabled":"");?>  href="addSubs.frm.php?enrol_stud_no=<?php echo $_GET['showProfile'];?>&enrol_sy=<?php echo $dataForm137['enrol_sy'];?>&enrol_level=<?php echo $dataForm137['enrol_level'];?>&enrol_sem=<?php echo $dataGradeOAll['grade_sem'];?>" class="btn  btn-xs  btn-default" title="Add Previously Taken Subjects" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
							<span class="glyphicon glyphicon-download-alt"></span></a>
							<a <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  href="" class="btn  btn-xs  btn-default" onclick="window.open('studGrade.php?stud_no=<?php echo $_GET['showProfile']; ?>&enrol_sy=<?php echo $dataGradeOAll['grade_sy'];?>&enrol_sem=<?php echo $dataGradeOAll['grade_sem'];?>', 'newwindow', 'width=1050, height=600'); return false;" Title="Print Current Grades"><span class="glyphicon glyphicon-print"></span></a>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
							<thead>
								<tr>
									<th width="18%">Course Code</th>
									<th>Descriptive Title</th>
									<th width="3%">Units</th>
									<th width="3%">Q1</th>
									<th width="3%">Q2</th>
									<th width="3%">Q3</th>
									<th width="3%">Q4</th>
									<th width="5%">Final</th>
									<th width="8%">Remarks</th>	
									<th width="15%">Teacher</th>
									<th width="10%"></th>
								</tr>
							</thead>
							<tbody> 
								<?php
								$resultGrade1 = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (grade.grade_stud_no='".$_GET['showProfile']."' AND class.class_sy='".$dataForm137['enrol_sy']."' and grade_sem='".$dataGradeOAll['grade_sem']."') ORDER BY grade_sem ASC, pros_sort ASC");
								$aveQ1=0;
								$aveQ2=0;
								$aveQ3=0;
								$aveQ4=0;
								$aveQf=0;
								$gradedUnits1=0;
								$gradedUnits2=0;
								$gradedUnits3=0;
								$gradedUnits4=0;
								$gradedUnitsqf=0;
								$countUnits=0;
								$gradedUnits=0;
								while($dataGrade1 = dbarray($resultGrade1)){
								?>													
									<tr>
										<?php
											$resultClassName = dbquery("select * from section where (section_no='".$dataGrade1['class_section_no']."')");
											$dataClassName = dbarray($resultClassName);
										?>
										<td><?php echo $dataGrade1['pros_title']; ?> <small>(<?php echo (isset($dataClassName['section_name']) ? substr($dataClassName['section_name'],0,3) : "N/A"); ?>)</small></td>
										<td><?php echo substr(ucwords(strtolower($dataGrade1['pros_desc'])),0,30); ?>...
										<a href="#" title="Remarks" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="<?php echo $dataGrade1['pros_desc']; ?>"><span class="glyphicon glyphicon-zoom-in"></a>
										</td>
										<td><?php echo number_format($dataGrade1['pros_unit'],2); ?></td>
										<td><?php echo ($dataGrade1['grade_q1']<60?"-":$dataGrade1['grade_q1']); 
										$aveQ1 += ($dataGrade1['grade_q1']*$dataGrade1['pros_unit']);?></td>
										<td><?php echo ($dataGrade1['grade_q2']<60?"-":$dataGrade1['grade_q2']); 
										$aveQ2 += ($dataGrade1['grade_q2']*$dataGrade1['pros_unit']);?></td>
										<td><?php echo ($dataGrade1['grade_q3']<60?"-":$dataGrade1['grade_q3']); 
										$aveQ3 += ($dataGrade1['grade_q3']*$dataGrade1['pros_unit']);?></td>
										<td><?php echo ($dataGrade1['grade_q4']<60?"-":$dataGrade1['grade_q4']); 
										$aveQ4 += ($dataGrade1['grade_q4']*$dataGrade1['pros_unit']);?></td>
										<td><strong>
										<?php
										if($dataGrade1['pros_level']<11 && ($dataGrade1['grade_q1']<60 || $dataGrade1['grade_q2']<60 || $dataGrade1['grade_q3']<60 || $dataGrade1['grade_q4']<60)){
											echo "-";
										}
										else if($dataGrade1['pros_level']>10 && ($dataGrade1['grade_q1']<60 || $dataGrade1['grade_q2']<60)){
											echo "-";
										}
										else {
											echo $dataGrade1['grade_final'];
										}										
										$aveQf += ($dataGrade1['grade_final']*$dataGrade1['pros_unit']);?></strong></td>
										<td>
										<?php
										if($dataGrade1['pros_level']<11 && ($dataGrade1['grade_q1']<60 || $dataGrade1['grade_q2']<60 || $dataGrade1['grade_q3']<60 || $dataGrade1['grade_q4']<60)){
											echo "-";
										}
										else if($dataGrade1['pros_level']>10 && ($dataGrade1['grade_q1']<60 || $dataGrade1['grade_q2']<60)){
											echo "-";
										}
										else {
											echo ($dataGrade1['grade_final']>=75?"PASSED":"FAILED");
										}										
										?>
										
										</td>
										<?php
										$checkTeacher = dbquery("SELECT * FROM teacher WHERE teach_no='".$dataGrade1['class_user_name']."'");
										$dataTeacher = dbarray($checkTeacher);
										?>
										<td><?php echo ($dataGrade1['class_user_name']=="1"?"TBA":$dataTeacher['teach_lname'].", ".substr($dataTeacher['teach_fname'],0,1)."."); ?></td>
										<td>
											<a <?php echo($_SESSION["user_role"]!=1?"disabled":"");?> <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  href="updateStudentGrades.frm.php?grade_no=<?php echo $dataGrade1['grade_no']; ?>" title="Update" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
											<span class="glyphicon glyphicon-pencil"></span></a>
											<?php
												$disabledDelete1 = ($dataGrade1['grade_final']<60?"":"disabled");
											?>	
											<a <?php echo($_SESSION["user_role"]!=1?"disabled":"");?> href="grade.scr.php?deleteGrade=Yes&grade_no=<?php echo $dataGrade1['grade_no'] ;?>" <?php echo $disabledDelete1;?> <?php echo ($_SESSION["user_role"]==0?"disabled":"");?> <?php echo ($_SESSION["user_role"]==2?"disabled":"");?> title="Delete" onClick="return confirm('Are you sure you want to delete entry?')" class="btn  btn-xs  btn-default">
											<span class="glyphicon glyphicon-remove"></span></a>
											<?php
												$disabledDelete2 = ($dataGrade1['grade_final']>=75?"disabled":($dataGrade1['grade_final']<60?"disabled":""));
											?>	
											<a <?php echo($_SESSION["user_role"]!=1?"disabled":"");?> <?php echo $disabledDelete2;?>  href="remedialgradeadd.frm.php?grade_no=<?php echo $dataGrade1['grade_no']; ?>" title="Add Remedial Grade" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
											<font color="<?php echo ($dataGrade1['grade_final']<75 && $dataGrade1['grade_final']>59?"red":"gray");?>"><span class="glyphicon glyphicon-flag"></span></font></a>
										</td>
									</tr>
									<?php 
									if($dataGrade1['grade_q1']<60){
										$gradedUnits1+=0;
									} else {
										$gradedUnits1+=$dataGrade1['pros_unit'];
									}
									if($dataGrade1['grade_q2']<60){
										$gradedUnits2+=0;
									}else {
										$gradedUnits2+=$dataGrade1['pros_unit'];
									}
									if($dataGrade1['grade_q3']<60){
										$gradedUnits3+=0;
									}else {
										$gradedUnits3+=$dataGrade1['pros_unit'];
									}
									if($dataGrade1['grade_q4']<60){
										$gradedUnits4+=0;
									}else {
										$gradedUnits4+=$dataGrade1['pros_unit'];
									}
									if($dataGrade1['grade_final']<60){
										$gradedUnitsqf+=0;
									}
									else {
										$gradedUnitsqf+=$dataGrade1['pros_unit'];
									}
									$countUnits+=$dataGrade1['pros_unit'];
									} 
									if($countUnits==0){
										$countUnits=1;
									}
									?>
									<tr>
										<td align="right" colspan="2"><b>Total Units / Gen. Ave.</b></td>
										<td><b><?php echo number_format($countUnits,2);?></b></td>
										<td align="left"><b><?php echo ($countUnits!=$gradedUnits1?"-":round($aveQ1/$countUnits,0));?></b></td>
										<td align="left"><b><?php echo ($countUnits!=$gradedUnits2?"-":round($aveQ2/$countUnits,0));?></b></td>
										<td align="left"><b><?php echo ($countUnits!=$gradedUnits3?"-":round($aveQ3/$countUnits,0));?></b></td>
										<td align="left"><b><?php echo ($countUnits!=$gradedUnits4?"-":round($aveQ4/$countUnits,0));?></b></td>
										<td align="left"><b><?php echo ($countUnits!=$gradedUnitsqf?"-":round($aveQf/$countUnits,0));?></b></td>
										<?php
										$resultEnrolInfo = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['showProfile']."' AND enrol_sy='".$dataEnroll['enrol_sy']."')");
										$dataEnrolInfo = dbarray($resultEnrolInfo);
										?>
										<td colspan="3"><strong><?php echo ($dataForm137['enrol_status2']=="IRREGULAR"?"CONDITIONAL":$dataForm137['enrol_status2']);?></strong></td>
									</tr>																
							</tbody> 
						</table>
					</div>
				</div>

				<?php 
				}
			}	
				?>
		</div>
	</div>
</div>
</div>
</div>