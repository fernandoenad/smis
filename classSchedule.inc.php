<?php

?><br>
		<div class="pagecontent container">
			<div class="row row-toolbar">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-push-8 col-md-push-8 col-sm-push-8 col-xs-push-8 clearfix"></div>
					<div class="btn-group pull-right" style="margin-top: 5px;">
						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" style="margin-right: 15px;">
						SY <?php echo $_GET['enrol_sy'];?> - <?php echo $_GET['enrol_sy']+1;?>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
							<li role="presentation" class="dropdown-header">Select School Year</li>
							<?php 
								$checkSY = dbquery("select * from settings order by settings_sy desc");
								while($dataSY = dbarray($checkSY)){
							?>
							<li><a href="?page=offerings&enrol_sy=<?php echo $dataSY['settings_sy'];?>&section_no=%"><?php echo $dataSY['settings_sy'];?> - <?php echo $dataSY['settings_sy']+1;?></a></li>
							<?php }	?>
						</ul>
					</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-pull-4 col-md-pull-4 col-sm-pull-4 col-xs-pull-4">
                <select class="form-control" id="ui-classes" style="margin-top: 5px" onchange="if (this.value) window.location.href=this.value">
				<?php
				for($section_level=$current_school_minlevel ;$section_level <= $current_school_maxlevel ; $section_level++){
				?>
					<optgroup label="Grade <?php echo $section_level; ?>">  
					<?php
				
					$resultSection = dbquery("SELECT * FROM section WHERE (section_level='".$section_level."' AND section_sy='".$_GET['enrol_sy']."') ORDER BY section_name ASC");
					while($dataSection = dbarray($resultSection)){
					?>
						<option value=".?page=offerings&enrol_sy=<?php echo $_GET['enrol_sy'];?>&section_no=<?php echo $dataSection['section_no'];?>" <?php echo ($dataSection['section_no']==$_GET['section_no']?"selected":"");?>>Grade <?php echo $dataSection['section_level']; ?> - <?php echo $dataSection['section_name']; ?></option>
					<?php } ?>
					</optgroup> 
				<?php }?>	
                </select>
          </div>
		</div>
		<div class="page-header" style="margin-top: 20px">
			<a <?php echo ($_SESSION['user_role']==2?"disabled=disabled":"");?> class="btn btn-lg btn-success pull-right" href="scheduleNew.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&section_no=<?php echo $_GET['section_no'];?>" title="New Subject Offering" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">New Schedule</a>
			<h1>Class Offering</h1>
		</div>
			<?php
			$resultSection = dbquery("SELECT * FROM section WHERE (section_no='".$_GET['section_no']."' AND section_sy='".$_GET['enrol_sy']."')");
			$dataSection = dbarray($resultSection);
			?>
			<ol class="breadcrumb">
				<li><a href="./?page=class&enrol_sy=<?php echo $_GET['enrol_sy']; ?>">Class Offering</a></li>
				<li class="active">Section <?php echo $dataSection['section_name']; ?></li>
				<div class="btn-toolbar  pull-right">
					<?php if($dataSection['section_level']>10){ ?>
					<a <?php echo ($_SESSION['user_role']==2?"disabled=disabled":"");?>  href="scheduleNew.frm.php?classProfile=<?php echo (isset($dataSection['section_name']) ? $dataSection['section_name'] : "");?>&enrol_sy=<?php echo (isset($_GET['enrol_sy']) ? $_GET['enrol_sy'] : "");?>&section_no=<?php echo $_GET['section_no'];?>&type=irr" title="Off Semester Offering" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
					Off Semester Offering <span class="glyphicon glyphicon-plus"></span></a>
					<?php } ?>
					<a <?php echo (substr($dataSection['section_name'],0,2)=="Z_"?"disabled":"");?> href="sched.scr.php?MassSched=Yes&classProfile=<?php echo $dataSection['section_name'];?>&section_no=<?php echo $_GET['section_no'];?>" title="Mass Loading of Schedules" class="btn  btn-xs  btn-default" onClick="return confirm('This will load all subjects from your active curriculum.')">
					Mass Subject Loading <span class="glyphicon glyphicon-plus"></span></a>
				</div>
			</ol>
			

			

			<?php
						
				$resultSection = dbquery("SELECT * FROM section WHERE (section_no='".$_GET['section_no']."' AND section_sy='".$_GET['enrol_sy']."')");
				$dataSection = dbarray($resultSection);
				// comment if bosy
				// $resultSubjects = dbquery("SELECT * FROM grade INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (class_section_no='".$dataSection['section_no']."' and class.class_sy='".$current_sy."') GROUP BY grade_sem ORDER BY grade_sem asc, pros_sort ASC");
				
				// comment if on-going
				$resultSubjects = dbquery("SELECT * FROM class INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (class_section_no='".$dataSection['section_no']."' and class.class_sy='".$_GET['enrol_sy']."') GROUP BY class_sem ORDER BY class_sem asc, pros_sort ASC");
				while($dataSubjects = dbarray($resultSubjects)){
				?>
				<div class="panel panel-default">
				<div class="panel-heading">		
					<div class="btn-toolbar  pull-right">
						<a <?php echo ($dataSection['section_name']=="TLE"?"disabled":"");?> title="Print Load" class="btn  btn-xs  btn-default" onclick="window.open('classProgram.php?section=<?php echo $dataSection['section_name'];?>&enrol_sy=<?php echo $_GET['enrol_sy'];?>&enrol_sem=<?php echo $dataSubjects['class_sem'];?>', 'newwindow', 'width=850, height=550'); return false;">
						<span class="glyphicon glyphicon-print"></span></a>
					</div>				
					Grade <?php echo $dataSection['section_level'];?>- <?php echo $dataSection['section_name'];?> | SY: <?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?>, <?php echo ($dataSubjects['class_sem']=="1"?"First Semester":($dataSubjects['class_sem']=="2"?"Second Semester":"Full Year"));?>
				</div>
                <div class="table-responsive">
					<table class="table table-bordered table-condensed table-striped table-sticky">
						<thead>
							<tr>
								<th width="20%">Course Code</th>
								<th>Descriptive Title</th>
								<th width="10%">Time</th>
								<th width="10%">Days</th>
								<th width="12%">Room</th>
								<th width="18%">Teacher</th>
								<th width="10%"></th>
							</tr>
						</thead>
						<tbody>
						<?php
						if($dataSection['section_name']=="TLE"){
						$resultGrade = dbquery("SELECT * FROM class INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (class.class_sy='".$_GET['enrol_sy']."' AND pros_title LIKE '%TLE%' AND pros_level>'8') ORDER BY pros_level ASC, class_timeslots ASC, pros_sort ASC, class_room ASC");
						}
						else{
						// comment if bosy
						$resultGrade = dbquery("SELECT * FROM class INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (class.class_sy='".$_GET['enrol_sy']."' AND class.class_section_no='".$dataSection['section_no']."' and class_sem='".$dataSubjects['class_sem']."') ORDER BY class_sem ASC, class_timeslots ASC, pros_sort ASC");
						
						// comment if on-going
						// $resultGrade = dbquery("SELECT * FROM class INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (class.class_sy='".$_GET['enrol_sy']."' AND class.class_section_no='".$dataSection['section_no']."') ORDER BY pros_sem ASC, class_timeslots ASC, pros_sort ASC");
						}
						
						while($dataGrade = dbarray($resultGrade)){
						
						$checkEnrolled = dbquery("SELECT * FROM grade WHERE (grade_class_no='".$dataGrade['class_no']."' AND grade_sy='".$_GET['enrol_sy']."')");
						$countEnrolled = dbrows($checkEnrolled)
						?>													
							<tr>
								<td><a href="#" onclick="window.open('showForm2c.php?class_no=<?php echo $dataGrade['class_no'];?>&enrol_sy=<?php echo $_GET['enrol_sy'];?>', 'newwindow', 'width=820, height=520'); return false;"><?php echo $dataGrade['pros_title']; ?></a> 
									(<small><?php echo substr($dataSection['section_name'],0,3);?></small>)
									<span class="label label-default pull-right"><?php echo $countEnrolled; ?></span></td>
								<td><small><?php echo substr(ucwords(strtolower($dataGrade['pros_desc'])),0,30); ?>...</small>
								<a href="#" title="Remarks" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="<?php echo strtoupper($dataGrade['pros_desc']); ?>"><span class="glyphicon glyphicon-zoom-in"></a>
								</td>
								<td><?php echo $dataGrade['class_timeslots']; ?></td>
								<td><?php echo $dataGrade['class_days']; ?></td>
								<td><small><?php echo $dataGrade['class_room']; ?></small></td>
								<td><small><?php 
								$checkTeacher = dbquery("SELECT * FROM users WHERE user_no='".$dataGrade['class_user_name']."'");
								$dataTeacher = dbarray($checkTeacher);
								echo ($dataGrade['class_user_name']==1?"TBA":strtoupper($dataTeacher['user_fullname']));
								?>
								</small></td>
								<td><a <?php echo ($_SESSION["user_role"]!=1?"disabled=disabled":"");?> href="scheduleUpdate.frm.php?classProfile=<?php echo $dataSection['section_name'];?>&class_no=<?php echo $dataGrade['class_no'] ;?>&section_no=<?php echo $dataSection['section_no'];?>" title="Update" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
									<span class="glyphicon glyphicon-pencil"></span></a>
									<a <?php echo ($_SESSION["user_role"]!=1?"disabled=disabled":"");?> <?php echo ($countEnrolled>0?"disabled":"");?> href="sched.scr.php?DeleteSched=Yes&class_no=<?php echo $dataGrade['class_no'] ;?>" title="Delete" onClick="return confirm('Are you sure you want to delete entry?')" class="btn  btn-xs  btn-default">
									<span class="glyphicon glyphicon-remove"></span></a>
									<a <?php echo ($_SESSION["user_role"]!=1?"disabled=disabled":"");?> <?php echo (substr($dataGrade['pros_title'],0,3)=="TLE"?"disabled":"");?> href="enrollmentManual.scr.php?Enroll=Yes&class_no=<?php echo $dataGrade['class_no'] ;?>&classProfile=<?php echo $dataSection['section_name'];?>&section_no=<?php echo $dataSection['section_no'];?>" title="Mass Enroll Class" onClick="return confirm('Are you sure you want to mass enroll the class?')" class="btn  btn-xs  btn-default">
									<span class="glyphicon glyphicon-plus"></span></a></td>
								</tr>
							<?php } ?>							
						</tbody>
					</table>
				</div>
				
			</div>
			<?php } ?>
		</div>

			
		</div>	
	</div>
	
	