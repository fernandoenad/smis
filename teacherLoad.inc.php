<?php

?>
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
							<li><a href="?page=loads&enrol_sy=<?php echo $dataSY['settings_sy'];?>&teach_no=<?php echo $_GET['teach_no'];?>"><?php echo $dataSY['settings_sy'];?> - <?php echo $dataSY['settings_sy']+1;?></a></li>
							<?php }	?>
						</ul>
					</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-pull-4 col-md-pull-4 col-sm-pull-4 col-xs-pull-4">
                <select <?php echo($_SESSION["user_role"]==2?"disabled":"");?> class="form-control" id="ui-classes" style="margin-top: 5px" onchange="if (this.value) window.location.href=this.value">
					<option value=".?page=loads&enrol_sy=<?php echo $_GET['enrol_sy'];?>&teach_no=1" <?php echo ($_GET['teach_no']==1?"selected":"");?>>***TBA***</option>
					<?php
					$checkFaculty = dbquery("SELECT * FROM users WHERE (user_role!='3' and user_status='1' and user_no>'2')  ORDER BY user_fullname ASC");
					while($dataFaculty=dbarray($checkFaculty)){
					?>
						<option value=".?page=loads&enrol_sy=<?php echo $_GET['enrol_sy'];?>&teach_no=<?php echo $dataFaculty['user_no']; ?>" <?php echo ($dataFaculty['user_no']==$_GET['teach_no']?"selected":"");?>><?php echo ($dataFaculty['user_no']=="1"?"TBA":strtoupper($dataFaculty['user_fullname'])); ?></option>
					<?php } ?>
			
                </select>

          </div>
		</div>
			<div class="page-header" style="margin-top: 20px">
				<h1>Class Assignment</h1>
			</div>
	    <ol class="breadcrumb">
        <li><a href="">Class Assignment</a></li>
    </ol>
	
			<?php
				$resultClasses = dbquery("select * from  class inner join prospectus on class_pros_no=pros_no where (class_sy='".$_GET['enrol_sy']."' and class_user_name='".$_GET['teach_no']."') GROUP BY class_sem ORDER BY class_sem ASC");
				while($dataClasses = dbarray($resultClasses)){
			?>
			<div class="panel panel-default">
				<div class="panel-heading">
				<div class="btn-toolbar  pull-right">
						<a title="Print Load" class="btn  btn-xs  btn-default" onclick="window.open('facultyLoad.php?teach_no=<?php echo $_GET['teach_no'];?>&enrol_sy=<?php echo $_GET['enrol_sy'];?>&term=<?php echo $dataClasses['class_sem'];?>', 'newwindow', 'width=850, height=550'); return false;">
						<span class="glyphicon glyphicon-print"></span></a>
					</div>	
				Class List | SY <?php echo $_GET['enrol_sy'];?>-<?php echo $_GET['enrol_sy']+1;?>, <?php echo ($dataClasses['class_sem']=="1"?"First Semester":($dataClasses['class_sem']=="2"?"Second Semester":"Full Year"));?> 
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-condensed table-striped table-sticky">
						<thead>
							<tr>
								<th width="4%">#</th>
								<th width="20%">Course Code/ Term</th>
								<th>Descriptive Title</th>
								<th width="15%">Class / Room</th>
								<th width="5%">Qtr 1</th>
								<th width="5%">Qtr 2</th>
								<th width="5%">Qtr 3</th>
								<th width="5%">Qtr 4</th>
								<th width="5%">Final</th>
								<th width="8%"></th>
							</tr>
						</thead>

						<tbody>
						<?php
							$i=1;
							$checkLoads = dbquery("select * from class inner join prospectus on class_pros_no=pros_no where (class_sy='".$_GET['enrol_sy']."' and class_user_name='".$_GET['teach_no']."' and class_sem='".$dataClasses['class_sem']."') order by class_section_no asc, pros_sort asc");
							while($dataLoads = dbarray($checkLoads)){
							?>									
							<tr>
								<?php
								$checkEnrolled = dbquery("SELECT * FROM grade WHERE grade_class_no='".$dataLoads['class_no']."'");
								$countEnrolled = dbrows($checkEnrolled);
																
								?>
								<td>
								<a href="#" onclick="window.open('./showForm2c.php?class_no=<?php echo $dataLoads['class_no'];?>&enrol_sy=<?php echo $_GET['enrol_sy'];?>', 'newwindow', 'width=850, height=520'); return false;"><?php echo $i;?></a>
								</td>
								<?php
								$resultSectionName = dbquery("select * from section where section_no='".$dataLoads['class_section_no']."'");
								$dataSectionName = dbarray($resultSectionName);
								?>
								<td><a href="#" onclick="window.open('./showForm2d.php?class_no=<?php echo $dataLoads['class_no'];?>&enrol_sy=<?php echo $_GET['enrol_sy'];?>', 'newwindow', 'width=850, height=520'); return false;"> <?php echo $dataLoads['pros_title'];?></a> (<?php echo $dataSectionName['section_name'];?>)
								</td>
								<td><small><?php echo ucwords(strtolower(substr($dataLoads['pros_desc'],0,45	)));?>...</small>
								<a href="#" title="Remarks" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="<?php echo strtoupper($dataLoads['pros_desc']); ?>"><span class="glyphicon glyphicon-zoom-in"></a>
								</td>
								<td><?php echo $dataLoads['class_room'];?><span class="label label-active pull-right"><a href="#" onclick="window.open('./gradeSheet.php?class_no=<?php echo $dataLoads['class_no'];?>&enrol_sy=<?php echo $_GET['enrol_sy'];?>', 'newwindow', 'width=850, height=520'); return false;"><span class="glyphicon glyphicon-print"></span></a></span></td>
								<?php
								$checkGrade1= dbquery("SELECT * FROM grade WHERE (grade_q1>='60' AND grade_class_no='".$dataLoads['class_no']."')");
								$countGrade1= dbrows($checkGrade1);
								?>
								<td><?php echo ($countEnrolled==0?"0":round($countGrade1/$countEnrolled*100,0,3));?>%</td>
								<?php
								$checkGrade1= dbquery("SELECT * FROM grade WHERE (grade_q2>='60' AND grade_class_no='".$dataLoads['class_no']."')");
								$countGrade1= dbrows($checkGrade1);
								?>
								<td><?php echo ($countEnrolled==0?"0":round($countGrade1/$countEnrolled*100,0,3));?>%</td>
								<?php
								$checkGrade1= dbquery("SELECT * FROM grade WHERE (grade_q3>='60' AND grade_class_no='".$dataLoads['class_no']."')");
								$countGrade1= dbrows($checkGrade1);
								?>
								<td><?php echo ($countEnrolled==0?"0":round($countGrade1/$countEnrolled*100,0,3));?>%</td>
								<?php
								$checkGrade1= dbquery("SELECT * FROM grade WHERE (grade_q4>='60' AND grade_class_no='".$dataLoads['class_no']."')");
								$countGrade1= dbrows($checkGrade1);
								?>
								<td><?php echo ($countEnrolled==0?"0":round($countGrade1/$countEnrolled*100,0,3));?>%</td>
								<?php
								$checkGrade1= dbquery("SELECT * FROM grade WHERE (grade_final>='60' AND grade_class_no='".$dataLoads['class_no']."')");
								$countGrade1= dbrows($checkGrade1);
								?>
								<td><?php echo ($countEnrolled==0?"0":round($countGrade1/$countEnrolled*100,0,3));?>%</td>
								<td>
								<?php
								if(substr($dataLoads['pros_title'],0,5)=="MAPEH"){
								?>
								<a href="inputGrades1.frm.php?class_no=<?php echo $dataLoads['class_no'];?>&enrol_sy=<?php echo $_GET['enrol_sy'];?>" title="Input Grades" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
									Submit Grades</a>
								<?php
								}
								else{
								?>
								<a href="inputGrades.frm.php?class_no=<?php echo $dataLoads['class_no'];?>&enrol_sy=<?php echo $_GET['enrol_sy'];?>" title="Input Grades" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
									Submit Grades</a>
								<?php
								}
								?>
								</td>
							</tr>	
						<?php
							$i++;
							}
						?>
						</tbody>
					</table>			
				</div>
			</div> <?php } ?>
		</div>	
	</div>