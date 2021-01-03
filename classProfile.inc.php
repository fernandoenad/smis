		<!--<?php if($eoyupdate==0){ ?>
		<script>
			alert('End of School Year Status updating is already OPEN. \n\nNOTE: Please report to the School Registrar, names of students who are no longer attending classes or the ones considered DROPPED before proceeding.');
		</script>
		<?php } ?>
		-->
		<div class="pagecontent container">
			<div class="row row-toolbar">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-push-8 col-md-push-8 col-sm-push-8 col-xs-push-8 clearfix"></div>
	
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-pull-4 col-md-pull-4 col-sm-pull-4 col-xs-pull-4">
                <select  class="form-control" id="ui-classes" style="margin-top: 5px" onchange="if (this.value) window.location.href=this.value">
				<?php
				for($section_level=$current_school_minlevel ;$section_level <= $current_school_maxlevel ; $section_level++){
				?>
					<optgroup label="Grade <?php echo $section_level; ?>">  
					<?php
					$resultSection = dbquery("SELECT * FROM section WHERE (section_level='".$section_level."' AND section_sy='".$_GET['enrol_sy']."') ORDER BY section_name ASC");
					while($dataSection = dbarray($resultSection)){
						if(substr($dataSection['section_name'],0,2)=="Z_"){
						}
						else{
					?>
						<option value=".?page=class&enrol_sy=<?php echo $_GET['enrol_sy'];?>&classProfile=<?php echo $dataSection['section_name']; ?>&section_no=<?php echo $dataSection['section_no']; ?>" <?php echo ($dataSection['section_name']==$_GET['classProfile']?"selected":"");?> <?php echo($_SESSION["user_role"]==2?($_SESSION["userid"]==$dataSection['section_adviser']?"":"disabled"):"");?>>Grade <?php echo $dataSection['section_level']; ?> - <?php echo $dataSection['section_name']; ?></option>
					<?php }} ?>
					</optgroup> 
				<?php }?>	
                </select>

          </div>
		</div>
		<div class="page-header" style="margin-top: 20px">
			<a class="btn btn-lg btn-success pull-right" href="enroll.frm.php" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">Enrol Learner</a>
			<h1>Masterlist</h1>
		</div>
			<?php 
				$resultSectionInfo = dbquery("SELECT * FROM section WHERE (section_no='".$_GET['section_no']."' AND section_sy='".$_GET['enrol_sy']."')");
				$dataSectionInfo = dbarray($resultSectionInfo);
			?>
			<ol class="breadcrumb">
				<li><a href="./?page=class&enrol_sy=<?php echo $_GET['enrol_sy']; ?>">Class</a></li>
				<li class="active">Section <?php echo $dataSectionInfo['section_name']; ?></li>
			</ol>
			
			<div class="panel panel-default">
				<div class="panel-heading">Overview
					<div class="btn-toolbar  pull-right">
						<a href="" class="btn  btn-xs  btn-default"  onclick="window.open('classList.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>', 'newwindow', 'width=800, height=600'); return false;">Class List</a>
						<a href="" class="btn  btn-xs  btn-default"  onclick="window.open('classProgram.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&section=<?php echo $_GET['classProfile'];?>&enrol_sem=<?php echo $current_sem;?>', 'newwindow', 'width=820, height=600'); return false;">Class Program</a>						
						<a href="" class="btn  btn-xs  btn-default"  onclick="window.open('<?php echo ($dataSectionInfo['section_level']>10?"showForm1shs":"showForm1");?>.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>', 'newwindow', 'width=1350, height=600'); return false;"><?php echo ($dataSectionInfo['section_level']>10?"SF1-SHS":"SF1");?></a>
						<a href="" class="btn  btn-xs  btn-default"  onclick="window.open('<?php echo ($dataSectionInfo['section_level']>10?"showForm2shs":"showForm2");?>.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>', 'newwindow', 'width=1350, height=600'); return false;"><?php echo ($dataSectionInfo['section_level']>10?"SF2-SHS":"SF2");?></a>
						<a href="" class="btn  btn-xs  btn-default"  onclick="window.open('showForm2a.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>', 'newwindow', 'width=800, height=600'); return false;"><?php echo ($dataSectionInfo['section_level']>10?"SF2-SHS Summary":"SF2 Summary");?></a>
						<a href="" class="btn  btn-xs  btn-default"  onclick="window.open('<?php echo ($dataSectionInfo['section_level']>10?"showForm3shs":"showForm3");?>.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>', 'newwindow', 'width=1350, height=600'); return false;"><?php echo ($dataSectionInfo['section_level']>10?"SF3-SHS":"SF3");?></a>
						<a href="" class="btn  btn-xs  btn-default" onclick="window.open('showForm138.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>&enrol_sem=<?php echo $current_sem;?>', 'newwindow', 'width=1350, height=600'); return false;">Grade Slips</a>	
						<?php
						$checkEnrolled=dbquery("SELECT * FROM studenroll INNER JOIN section ON enrol_section=section_name WHERE (section_no='".$_GET['section_no']."' and enrol_sy='".$_GET['enrol_sy']."' AND enrol_status1='ENROLLED')");
						$dataEnrolled=dbrows($checkEnrolled);
						?>
						<a href="" class="btn  btn-xs  btn-default"  <?php echo ($dataEnrolled>0?"disabled":"");?> onclick="window.open('<?php echo ($dataSectionInfo['section_level']>10?"showForm5ashs":"showForm5");?>.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>', 'newwindow', 'width=1350, height=600'); return false;"><?php echo ($dataSectionInfo['section_level']>10?"SF5A-SHS":"SF5");?></a>	
						<?php 
						if ($dataSectionInfo['section_level']>11){
						?>	
							<a href="" class="btn  btn-xs  btn-default"  <?php echo ($dataEnrolled>0?"disabled":"");?> onclick="window.open('showForm5bshs.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>', 'newwindow', 'width=1350, height=600'); return false;">SF5B-SHS</a>
						<?php
						}
						?>
						<a href="" class="btn  btn-xs  btn-default"  onclick="window.open('showBMI.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>', 'newwindow', 'width=800, height=600'); return false;">SF8</a>							
						<a href="" class="btn  btn-xs  btn-default"  onclick="window.open('summary.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>', 'newwindow', 'width=850, height=600'); return false;">EOSY Summ</a>	
						<a href="" class="btn  btn-xs  btn-default" onclick="window.open('showPayHis.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>', 'newwindow', 'width=1350, height=600'); return false;">Payments Summ</a>	
			</div>					
					</div>
					<div class="panel-body">
						<div class="pull-right">Grade <?php echo $dataSectionInfo['section_level']; ?> - <?php echo $dataSectionInfo['section_name']; ?>  / SY <?php echo $_GET['enrol_sy']; ?> - <?php echo $_GET['enrol_sy']+1; ?></div>
						<?php
						$resultAdviserLookup = dbquery("SELECT * FROM users WHERE user_no='".$dataSectionInfo['section_adviser']."'");
						$dataAdviserLookup = dbarray($resultAdviserLookup);
						?>
						<strong>Adviser:</strong> <?php echo strtoupper($dataAdviserLookup['user_fullname']); ?>
					</div>
				<div class="list-group">
					<div class="row">
						<div class="col-lg-4 col-md-4">
						<div class="text-center">
							<strong>No of learners</strong>
						</div>
						<?php
						$resultCountSY = dbquery("SELECT * FROM studenroll WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_status1!='INACTIVE' AND enrol_section='".$_GET['classProfile']."')");
						$rowCountSY = dbrows($resultCountSY);
						?>
						<div class="text-center figure1"><?php echo $rowCountSY; ?><br>
						<a href="showForm2b.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&classProfile=<?php echo $_GET['classProfile'];?>" title="Modify User" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false">
										<span class="glyphicon glyphicon-calendar"></span></a><br><font size="-1">Summary of Ratings: 
						<?php
						if($dataSectionInfo['section_level']<11){
						?>
						<a href="" onclick="window.open('summaryOfGrades1.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>&term=grade_q1', 'newwindow', 'width=850, height=600'); return false;">Q1</a> |
						<a href="" onclick="window.open('summaryOfGrades1.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>&term=grade_q2', 'newwindow', 'width=850, height=600'); return false;">Q2</a> |
						<a href="" onclick="window.open('summaryOfGrades1.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>&term=grade_q3', 'newwindow', 'width=850, height=600'); return false;">Q3</a> |
						<a href="" onclick="window.open('summaryOfGrades1.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>&term=grade_q4', 'newwindow', 'width=850, height=600'); return false;">Q4</a> |
						<a href="" onclick="window.open('summaryOfGrades7.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>&term=grade_finals', 'newwindow', 'width=850, height=600'); return false;">Ave</a> |
						<a href="" onclick="window.open('summaryOfGrades.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>', 'newwindow', 'width=1350, height=600'); return false;">Summary</a>
						<?php
						}
						else{
						?>
						<a href="" onclick="window.open('summaryOfGrades1.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>&term=grade_q1', 'newwindow', 'width=850, height=600'); return false;">Q1</a> |
						<a href="" onclick="window.open('summaryOfGrades1.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>&term=grade_q2', 'newwindow', 'width=850, height=600'); return false;">Q2</a> |
						<a href="" onclick="window.open('summaryOfGrades3.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>&term=grade_sem1', 'newwindow', 'width=1350, height=600'); return false;">Sem 1</a> | 
						<a href="" onclick="window.open('summaryOfGrades1.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>&term=grade_q3', 'newwindow', 'width=850, height=600'); return false;">Q3</a> |
						<a href="" onclick="window.open('summaryOfGrades1.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>&term=grade_q4', 'newwindow', 'width=850, height=600'); return false;">Q4</a> |
						<a href="" onclick="window.open('summaryOfGrades3.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>&term=grade_sem2', 'newwindow', 'width=1350, height=600'); return false;">Sem 2</a> 
						<?php
						}
						if ($eoyupdate==1 && $dataSectionInfo['section_level']==12){
						?>
						<a href="" onclick="window.open('summaryOfGrades8.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $_GET['classProfile'];?>&term=grade_sem2', 'newwindow', 'width=800, height=600'); return false;">Graduation Summary</a> 						
						<?php
						}
						?>
						</font>
						</div>
                    </div>

					<div class="col-lg-4 col-md-4 small">
						<table class="table table-condensed">
							<thead>
								<th style="width:180px">EOSY Status</th>
								<th class="text-center">Male</th>
								<th class="text-center">Female</th>
							</thead>
							<tbody>
								<tr>
									<td><a href="" onclick="window.open('classList2.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&classProfile=<?php echo $_GET['classProfile'];?>&status=prom', '', 'width=850, height=600'); return false;">Promoted</a></td>
									<?php
									$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' OR studenroll.enrol_status2='GRADUATED') AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND (studenroll.enrol_status2='PROMOTED' OR studenroll.enrol_status2='GRADUATED') AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<tr>
									<td><a href="" onclick="window.open('classList2.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&classProfile=<?php echo $_GET['classProfile'];?>&status=cond', '', 'width=850, height=600'); return false;">Conditional</a></td>
									<?php
									$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<tr>
									<td><a href="" onclick="window.open('classList2.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&classProfile=<?php echo $_GET['classProfile'];?>&status=ret', '', 'width=850, height=600'); return false;">Retained</a></td>
									<?php
									$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
							</tbody>
						</table>
						<?php
						if($dataSectionInfo['section_level']>10){
						?>
						<table class="table table-condensed">
							<thead>
								<th style="width:180px">Senior HS Program Combo</th>
								<th class="text-center">Male</th>
								<th class="text-center">Female</th>
							</thead>
							<tbody>
								<?php
								$checkOfferingsStrand = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND enrol_track!='' and enrol_stud_no!='0' and enrol_section='".$dataSectionInfo['section_name']."') group by enrol_combo order by enrol_combo asc");								
								while($dataOfferingsStrand = dbarray($checkOfferingsStrand)){
								?>
								<tr>
									<td><a href="" onclick="window.open('classList5.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&classProfile=<?php echo $_GET['classProfile'];?>', '', 'width=850, height=600'); return false;"><?php echo $dataOfferingsStrand['enrol_combo'];?></a></td>
									<?php
									$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND enrol_combo='".$dataOfferingsStrand['enrol_combo']."' AND enrol_track!='' and enrol_stud_no!='0' and student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND enrol_combo='".$dataOfferingsStrand['enrol_combo']."' AND enrol_track!='' and enrol_stud_no!='0' and student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<?php
								}
								?>
							</tbody>
						</table>
						<?php
						}
						?>
					</div>
					<div class="col-lg-4 col-md-4 small">
						<table class="table table-condensed">
							<thead>
								<th style="width:180px">BOSY Status</th>
								<th class="text-center">Male</th>
								<th class="text-center">Female</th>
							</thead>
							<tbody>
								<tr>
									<td><a href="" onclick="window.open('classList2.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&classProfile=<?php echo $_GET['classProfile'];?>&status=current', '', 'width=850, height=600'); return false;">Current Enrollment</a></td>
									<?php
									$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED') AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED') AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>	
								<tr>
									<td><a href="" onclick="window.open('classList2.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&classProfile=<?php echo $_GET['classProfile'];?>&status=all', '', 'width=850, height=600'); return false;">Annual Enrollment</a></td>
									<?php
									$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<tr>
									<td colspan="3"></td>
								</tr>								
								<tr>
									<td><a href="" onclick="window.open('classList2.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&classProfile=<?php echo $_GET['classProfile'];?>&status=bosy', '', 'width=850, height=600'); return false;">BOSY Enrollment</a></td>
									<?php
									$enrol_sy=$_GET['enrol_sy'];
									$checkLateDates = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
									$dataLateDates = dbarray($checkLateDates);
									
									$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND enrol_admitdate<='".$dataLateDates['settings_late1']."' and enrol_admitdate!='0000-00-00 00:00:00' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND enrol_admitdate<='".$dataLateDates['settings_late1']."' and enrol_admitdate!='0000-00-00 00:00:00' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<tr>
									<td><a href="" onclick="window.open('classList2.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&classProfile=<?php echo $_GET['classProfile'];?>&status=late1', '', 'width=850, height=600'); return false;">Late Enrollees (1<sup>st</sup> Sem)</a></td>
									<?php
									
									$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$dataLateDates['settings_sy']."' AND studenroll.enrol_admitdate>'".$dataLateDates['settings_late1']." 00:00:00'  AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$dataLateDates['settings_sy']."' AND studenroll.enrol_admitdate>'".$dataLateDates['settings_late1']." 00:00:00'  AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>								
								<tr>
									<td><a href="" onclick="window.open('classList2.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&classProfile=<?php echo $_GET['classProfile'];?>&status=ti', '', 'width=850, height=600'); return false;">Transferred In</a></td>
									<?php
									$enrol_sy=$_GET['enrol_sy'];
									$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_ti='1' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_ti='1' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<?php
								if($dataSectionInfo['section_level']>10){
								?>
								<tr bgcolor="lightgray">
									<td><a href="" onclick="window.open('classList2.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&classProfile=<?php echo $_GET['classProfile'];?>&status=ns', '', 'width=850, height=600'); return false;">New Student (2<sup>nd</sup> Sem, SHS)</a></td>
									<?php
									$enrol_sy=$_GET['enrol_sy'];
									$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND enrol_admitdate='0000-00-00 00:00:00' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND enrol_admitdate='0000-00-00 00:00:00' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<tr bgcolor="lightgray">
									<td><a href="" onclick="window.open('classList2.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&classProfile=<?php echo $_GET['classProfile'];?>&status=late2', '', 'width=850, height=600'); return false;">Late Enrollees (2<sup>nd</sup> Sem, SHS)</a></td>
									<?php
									$enrol_sy=$_GET['enrol_sy'];
									$checkLateDates = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
									$dataLateDates = dbarray($checkLateDates);
									$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$dataLateDates['settings_sy']."' AND studenroll.enrol_admitdate2>'".$dataLateDates['settings_late2']."' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$dataLateDates['settings_sy']."' AND studenroll.enrol_admitdate2>'".$dataLateDates['settings_late2']."' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center">(<?php echo $rowCountSYM; ?>)</td>
									<td  class="text-center">(<?php echo $rowCountSYF; ?>)</td>
								</tr>
								<?php
								}
								?>
								<tr>
									<td><a href="" onclick="window.open('classList2.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&classProfile=<?php echo $_GET['classProfile'];?>&status=to', '', 'width=850, height=600'); return false;">Transferred Out</a></td>
									<?php
									$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='INACTIVE' AND studenroll.enrol_status2='TRANSFERRED OUT' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='INACTIVE' AND studenroll.enrol_status2='TRANSFERRED OUT' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<tr>
									<td><a href="" onclick="window.open('classList2.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&classProfile=<?php echo $_GET['classProfile'];?>&status=do', '', 'width=850, height=600'); return false;">Dropped Out</a></td>
									<?php
									$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='INACTIVE' AND studenroll.enrol_status2='DROPPED OUT' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='INACTIVE' AND studenroll.enrol_status2='DROPPED OUT' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								 </tr>
								<tr>
									<td colspan="3"></td>
								</tr>
								<tr>
									<td><a href="" onclick="window.open('classList2.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&classProfile=<?php echo $_GET['classProfile'];?>&status=cct', '', 'width=850, height=600'); return false;">CCT / 4Ps</a></td>
									<?php
									$enrol_sy=$_GET['enrol_sy'];
									$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND stud_cct!='NO' AND student.stud_gender='MALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND stud_cct!='NO' AND student.stud_gender='FEMALE' AND enrol_section='".$_GET['classProfile']."')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<tr>
									<td colspan="3"></td>
								</tr>
								
						  </tbody>
						</table>

					</div>
				</div>
			</div>
			
			
			</div>

			<div class="panel panel-default">
                <div class="panel-heading">Enrolment
					<div class="btn-toolbar  pull-right">
						<!--
						<small>Input Grades for:</small>
						<?php
						$resultSectioNo = dbquery("SELECT * FROM section WHERE (section_sy='".$_GET['enrol_sy']."' AND section_name='".$_GET['classProfile']."')");
						$dataSectionNo = dbarray($resultSectioNo);
						$resultGrade1 = dbquery("SELECT * FROM class INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (class.class_section_no='".$dataSectionNo['section_no']."' and class.class_sy='".$_GET['enrol_sy']."') ORDER BY pros_no");
						while($dataGrade1 = dbarray($resultGrade1)){
							if($dataGrade1['pros_sem']==$current_sem || $dataGrade1['pros_sem']=="12"){
						?>							
						<a 	href="inputGrades<?php echo (substr($dataGrade1['pros_title'],0,5)=="MAPEH"?"1":"");?>.frm.php?class_no=<?php echo $dataGrade1['class_no'];?>&enrol_sy=<?php echo $_GET['enrol_sy'];?>" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false" <?php echo (substr($dataGrade1['pros_title'],0,5)=="MAPEH"?"":"");?>><?php echo $dataGrade1['pros_title'];?></a>
						<?php } }?>
						--->
						<a href="" class="btn  btn-xs  btn-default" onclick="window.open('showAttStubs.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&section_no=<?php echo $_GET['section_no'];?>&enrol_sem=<?php echo $current_sem;?>', 'newwindow', 'width=1350, height=600'); return false;">Print Stubs</a>	
					</div>			
				</div>
                <div class="table-responsive">
					<table class="table table-bordered table-condensed table-striped table-sticky">
						<thead>
							<tr>
								<th width="3%">#</th>
								<th width="8%">LRN</th>
								<th>Learner</th>
								<th width="5%">Gender</th>
								<th width="5%">CCT</th>
								<th width="7%">1<sup>st</sup> Day</th>
								<th width="12%">Status</th>
								<th width="8%">Final Grade</th>
								<td width="6%"><small><small>Core Values</small></small></td>
								<th width="15%">Remarks</th>
								<th width="8%">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$resultClassList = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='MALE') ORDER BY student.stud_lname ASC, student.stud_fname ASC");
						$i=1;	
						while($dataClassList = dbarray($resultClassList)){
						?>
                            <tr>
                                <td class="text-right"><small><a href="#" title="Print Profile" onclick="window.open('./activeResident.php?grade_stud_no=<?php echo $dataClassList['stud_no'];?>', 'newwindow', 'width=850, height=600'); return false;"><?php echo $i; ?></a></small></td>
								<td><small>
									<a href="#" title="Print ID" onclick="window.open('studPass.php?stud_no=<?php echo $dataClassList['stud_no']; ?>', 'newwindow', 'width=650, height=400'); return false;">
										<?php echo $dataClassList['stud_lrn']; ?>
									</a>
								</small></td>
                                <td><small><?php echo strtoupper($dataClassList['stud_lname']); ?>, <?php echo strtoupper($dataClassList['stud_fname']); ?> <?php echo strtoupper($dataClassList['stud_xname']); ?> <?php echo strtoupper($dataClassList['stud_mname']); ?> </small></td>
                                <?php
									$student_image = "./assets/images/students/".$dataClassList['stud_no'].".jpg";	
								?>
								<td><small><?php echo substr($dataClassList['stud_gender'],0,1);?> <?php echo (file_exists($student_image)?"":"<span class=\"glyphicon glyphicon-user\"></span>"); ?> <?php echo ($dataClassList['stud_dialect']=="-" || $dataClassList['stud_dialect']==""?"<span class=\"glyphicon glyphicon-list\"></span>":""); ?></small></td>
								<td><small><small><?php echo $dataClassList['stud_cct']; ?></small></small></td>
								<td><a href="schoolDays.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&stud_no=<?php echo $dataClassList['stud_no'];?>" title="Modify Attendance" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
															<span class="glyphicon glyphicon-calendar"></span></a>
								<?php
								$checkFirstDay = dbquery("SELECT * FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$dataClassList['stud_no']."')");
								$dataFirstDay = dbarray($checkFirstDay);
								$phpdate = strtotime($dataFirstDay['sch_firstday']);
								echo $mysqldate = date('m/d', $phpdate);
								?>										
								</td>
								<td><small><a href="enrollmentUpdate2.frm.php?enrol_no=<?php echo $dataClassList['enrol_no'];?>" <?php echo ($dataClassList['enrol_status1']!="ENROLLED"?"disabled":"");?> <?php echo ($_GET['enrol_sy']!=$current_sy?"disabled":"");?>  title="Modify Enrollment" <?php echo ($dataClassList['enrol_status1']=="INACTIVE"?"disabled":"");?> class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false">
									<span class="glyphicon glyphicon-pencil"></span> </a><small><small> <?php echo ($dataClassList['enrol_status2']=="IRREGULAR"?"CONDITIONAL":($dataClassList['enrol_status2']=="DROPPED OUT"?"NLS":$dataClassList['enrol_status2'])); ?></small></small>
									</small> </td>
								<td><small><small><?php echo ($dataClassList['enrol_status1']=="ENROLLED" || $dataClassList['enrol_status1']=="INACTIVE"?"-":($dataClassList['enrol_gradawards']!="-"?number_format($dataClassList['enrol_average'],3):number_format($dataClassList['enrol_average'],0))); ?></small> </small>
									<span class="label label-active pull-right">
										<a href="#" title="Print Grades" onclick="window.open('./studGrade.php?stud_no=<?php echo $dataClassList['stud_no'];?>&enrol_sy=<?php echo $current_sy;?>&enrol_sem=<?php echo ($dataClassList['enrol_level']<11?12:$current_sem);?>', 'newwindow', 'width=1050, height=520'); return false;">
											<span class="glyphicon glyphicon-list"></span>
										</a>&nbsp;
										<?php 
										if($dataClassList['enrol_level']<=6){
										?>
										<a href="#" title="Print Form137" onclick="window.open('./form137es.php?grade_stud_no=<?php echo $dataClassList['stud_no'];?>&enrol_sy=<?php echo $current_sy;?>&enrol_sem=<?php echo $current_sem;?>', 'newwindow', 'width=850, height=600'); return false;">
											<span class="glyphicon glyphicon-folder-open"></span></a>
										<?php
										}
										else if($dataClassList['enrol_level']<=10){
										?>
										<a href="#" title="Print Form137" onclick="window.open('./form137jhs_<?php echo($dataClassList['enrol_level']>=10?"o":"n");?>.php?grade_stud_no=<?php echo $dataClassList['stud_no'];?>&enrol_sy=<?php echo $current_sy;?>&enrol_sem=<?php echo $current_sem;?>', 'newwindow', 'width=850, height=600'); return false;">
											<span class="glyphicon glyphicon-folder-open"></span></a>
										<?php
										}
										else{
										?>
										<a href="#" title="Print Form137" onclick="window.open('./form137shs.php?grade_stud_no=<?php echo $dataClassList['stud_no'];?>&enrol_sy=<?php echo $current_sy;?>&enrol_sem=<?php echo $current_sem;?>', 'newwindow', 'width=850, height=600'); return false;">
											<span class="glyphicon glyphicon-folder-open"></span></a>
										<?php
										}
										?>
									</span>
								</td>
								<td><a href="stud_coreval.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&stud_no=<?php echo $dataClassList['stud_no'];?>" title="Modify Core Values" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false">
									<span class="glyphicon glyphicon-pencil"></span></a></td>
								<td><small><small><small><small>
								<?php
									if($earlyregistrationOn==true){
									$erlyregyr = $current_sy+1;
									$checkEarly = dbquery("select * from earlyregistry where (er_stud_no='".$dataClassList['stud_no']."' and er_sy='".$erlyregyr."')");
									$countcheckEarly = dbrows($checkEarly);
									?>
									<a title="Early Register for Next School Year" class="btn btn-danger btn-xs" <?php echo ($countcheckEarly >0 ?"disabled":"");?> href="earlyRegistration.frm.php?showProfile=<?php echo $dataClassList['stud_no'];?>&er_level=<?php echo $dataClassList['enrol_level']+1;?>" <?php echo ($_GET['enrol_sy']!=$current_sy?"disabled":"");?> data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false"><span class="glyphicon glyphicon-check"></span></a>
									<?php
									}
								?>	
								<?php echo strtoupper($dataClassList['enrol_remarks']); ?> /
								<?php 
									if($dataClassList['enrol_level']<=10){
										echo (strpos($dataClassList['stud_credentials'],"jhsEnv")==0?"Envelop, ":"");
										echo (strpos($dataClassList['stud_credentials'],"jhsPho")==0?"Photo, ":"");
										echo (strpos($dataClassList['stud_credentials'],"jhsNso")==0?"NSO, ":"");
										echo (strpos($dataClassList['stud_credentials'],"jhsBir")==0?"Birth Cert, ":"");
										echo (strpos($dataClassList['stud_credentials'],"jhsDip")==0?"Diploma, ":"");
										echo (strpos($dataClassList['stud_credentials'],"jhsGoo")==0?"Good Moral Character Cert, ":"");
										echo (strpos($dataClassList['stud_credentials'],"jhs138")==0?"Form 138, ":"");
										echo (strpos($dataClassList['stud_credentials'],"jhs137")==0?"Form 137":"");
									}
									else {
										echo (strpos($dataClassList['stud_credentials'],"shsEnv")==0?"Envelop, ":"");
										echo (strpos($dataClassList['stud_credentials'],"shsPho")==0?"Photo, ":"");
										echo (strpos($dataClassList['stud_credentials'],"shsNso")==0?"NSO, ":"");
										echo (strpos($dataClassList['stud_credentials'],"shsBir")==0?"Birth Cert, ":"");
										echo (strpos($dataClassList['stud_credentials'],"shsDip")==0?"Diploma, ":"");
										echo (strpos($dataClassList['stud_credentials'],"shsGoo")==0?"Good Moral Character Cert, ":"");
										echo (strpos($dataClassList['stud_credentials'],"shs138")==0?"Form 138, ":"");
										echo (strpos($dataClassList['stud_credentials'],"shs137")==0?"Form 137, ":"");
										echo (strpos($dataClassList['stud_credentials'],"shsNca")==0?"NCAE":"");	
									}
									?>
								</small></small></small></small></td>
                                <td><a href="./?page=student&showProfile=<?php echo $dataClassList['stud_no']; ?>&tab=history" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-user"></span></a>
								<a title="Transact" <?php echo ($_SESSION["user_role"]==2?"disabled":"");?> class="btn btn-success btn-xs" href="./?page=financials&showProfile=<?php echo $dataClassList['stud_no'];?>&tab=assessments">&nbsp;$&nbsp;</a></td>
							</tr>
						<?php 
						$i++;
						} ?>
                            <tr>
                                <td class="text-right"></td>
								<td></td>
                                <td></td>
                                <td></td>
								<td></td>
								<td></td>
								<td></td>								
                                <td></td>
								<td></td>
								<td></td>
                            </tr>
						<?php
						$resultClassList = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_section='".$_GET['classProfile']."' AND student.stud_gender='FEMALE') ORDER BY student.stud_lname ASC, student.stud_fname ASC");
						$i=1;	
						while($dataClassList = dbarray($resultClassList)){
						?>
                            <tr>
                                <td class="text-right"><small><a href="#" title="Print Profile" onclick="window.open('./activeResident.php?grade_stud_no=<?php echo $dataClassList['stud_no'];?>', 'newwindow', 'width=850, height=600'); return false;"><?php echo $i; ?></a></small></td>
								<td><small>
									<a href="#" title="Print ID" onclick="window.open('studPass.php?stud_no=<?php echo $dataClassList['stud_no']; ?>', 'newwindow', 'width=650, height=400'); return false;">
										<?php echo $dataClassList['stud_lrn']; ?>
									</a>
								</small></td>
                                <td><small><?php echo strtoupper($dataClassList['stud_lname']); ?>, <?php echo strtoupper($dataClassList['stud_fname']); ?> <?php echo strtoupper($dataClassList['stud_xname']); ?> <?php echo strtoupper($dataClassList['stud_mname']); ?> <?php echo strtoupper($dataClassList['stud_xname']); ?> </small></td>
                                <?php
									$student_image = "./assets/images/students/".$dataClassList['stud_no'].".jpg";	
								?>
								<td><small><?php echo substr($dataClassList['stud_gender'],0,1);?> <?php echo (file_exists($student_image)?"":"<span class=\"glyphicon glyphicon-user\"></span>"); ?> <?php echo ($dataClassList['stud_dialect']=="-" || $dataClassList['stud_dialect']==""?"<span class=\"glyphicon glyphicon-list\"></span>":""); ?></small></td>
								<td><small><small><?php echo $dataClassList['stud_cct']; ?></small></small></td>
								<td><a href="schoolDays.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&stud_no=<?php echo $dataClassList['stud_no'];?>" title="Modify Attendance" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
															<span class="glyphicon glyphicon-calendar"></span></a>
								<?php
								$checkFirstDay = dbquery("SELECT * FROM school_days WHERE (sch_sy='".$_GET['enrol_sy']."' AND sch_stud_no='".$dataClassList['stud_no']."')");
								$dataFirstDay = dbarray($checkFirstDay);
								$phpdate = strtotime($dataFirstDay['sch_firstday']);
								echo $mysqldate = date('m/d', $phpdate);
								?>
								</td>
								<td><small><a href="enrollmentUpdate2.frm.php?enrol_no=<?php echo $dataClassList['enrol_no'];?>" <?php echo ($dataClassList['enrol_status1']!="ENROLLED"?"disabled":"");?> <?php echo ($_GET['enrol_sy']!=$current_sy?"disabled":"");?> title="Modify Enrollment" <?php echo ($dataClassList['enrol_status1']=="INACTIVE"?"disabled":"");?> class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false">
									<span class="glyphicon glyphicon-pencil"></span> </a><small><small> <?php echo ($dataClassList['enrol_status2']=="IRREGULAR"?"CONDITIONAL":($dataClassList['enrol_status2']=="DROPPED OUT"?"NLS":$dataClassList['enrol_status2'])); ?></small></small>
									</small></td>
								<td><small><small><?php echo ($dataClassList['enrol_status1']=="ENROLLED" || $dataClassList['enrol_status1']=="INACTIVE"?"-":($dataClassList['enrol_gradawards']!="-"?number_format($dataClassList['enrol_average'],3):number_format($dataClassList['enrol_average'],0))); ?></small> </small>
									<span class="label label-active pull-right">
										<a href="#" title="Print Grades" onclick="window.open('./studGrade.php?stud_no=<?php echo $dataClassList['stud_no'];?>&enrol_sy=<?php echo $current_sy;?>&enrol_sem=<?php echo $current_sem;?>', 'newwindow', 'width=1050, height=520'); return false;">
											<span class="glyphicon glyphicon-list"></span>
										</a>&nbsp;
										<?php 
										if($dataClassList['enrol_level']<=6){
										?>
										<a href="#" title="Print Form137" onclick="window.open('./form137es.php?grade_stud_no=<?php echo $dataClassList['stud_no'];?>&enrol_sy=<?php echo $current_sy;?>&enrol_sem=<?php echo $current_sem;?>', 'newwindow', 'width=850, height=600'); return false;">
											<span class="glyphicon glyphicon-folder-open"></span></a>
										<?php
										}
										else if($dataClassList['enrol_level']<=10){
										?>
										<a href="#" title="Print Form137" onclick="window.open('./form137jhs_<?php echo($dataClassList['enrol_level']>=9?"o":"n");?>.php?grade_stud_no=<?php echo $dataClassList['stud_no'];?>&enrol_sy=<?php echo $current_sy;?>&enrol_sem=<?php echo $current_sem;?>', 'newwindow', 'width=850, height=600'); return false;">
											<span class="glyphicon glyphicon-folder-open"></span></a>
										<?php
										}
										else{
										?>
										<a href="#" title="Print Form137" onclick="window.open('./form137shs.php?grade_stud_no=<?php echo $dataClassList['stud_no'];?>&enrol_sy=<?php echo $current_sy;?>&enrol_sem=<?php echo $current_sem;?>', 'newwindow', 'width=850, height=600'); return false;">
											<span class="glyphicon glyphicon-folder-open"></span></a>
										<?php
										}
										?>
									</span>
								</td>
								<td><a href="stud_coreval.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&stud_no=<?php echo $dataClassList['stud_no'];?>" title="Modify Core Values" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false">
									<span class="glyphicon glyphicon-pencil"></span></a></td>
								<td><small><small><small><small>
								<?php
									if($earlyregistrationOn==true){
									$erlyregyr = $current_sy+1;
									$checkEarly = dbquery("select * from earlyregistry where (er_stud_no='".$dataClassList['stud_no']."' and er_sy='".$erlyregyr."')");
									$countcheckEarly = dbrows($checkEarly);
									?>
									<a title="Early Register for Next School Year" class="btn btn-danger btn-xs" <?php echo ($countcheckEarly >0 ?"disabled":"");?> href="earlyRegistration.frm.php?showProfile=<?php echo $dataClassList['stud_no'];?>&er_level=<?php echo $dataClassList['enrol_level']+1;?>" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false"><span class="glyphicon glyphicon-check"></span></a>
									<?php
									}
								?>
								<?php echo strtoupper($dataClassList['enrol_remarks']); ?> / 
								<?php 
									if($dataClassList['enrol_level']<=10){
										echo (strpos($dataClassList['stud_credentials'],"jhsEnv")==0?"Envelop, ":"");
										echo (strpos($dataClassList['stud_credentials'],"jhsPho")==0?"Photo, ":"");
										echo (strpos($dataClassList['stud_credentials'],"jhsNso")==0?"NSO, ":"");
										echo (strpos($dataClassList['stud_credentials'],"jhsBir")==0?"Birth Cert, ":"");
										echo (strpos($dataClassList['stud_credentials'],"jhsDip")==0?"Diploma, ":"");
										echo (strpos($dataClassList['stud_credentials'],"jhsGoo")==0?"Good Moral Character Cert, ":"");
										echo (strpos($dataClassList['stud_credentials'],"jhs138")==0?"Form 138, ":"");
										echo (strpos($dataClassList['stud_credentials'],"jhs137")==0?"Form 137":"");
									}
									else {
										echo (strpos($dataClassList['stud_credentials'],"shsEnv")==0?"Envelop, ":"");
										echo (strpos($dataClassList['stud_credentials'],"shsPho")==0?"Photo, ":"");
										echo (strpos($dataClassList['stud_credentials'],"shsNso")==0?"NSO, ":"");
										echo (strpos($dataClassList['stud_credentials'],"shsBir")==0?"Birth Cert, ":"");
										echo (strpos($dataClassList['stud_credentials'],"shsDip")==0?"Diploma, ":"");
										echo (strpos($dataClassList['stud_credentials'],"shsGoo")==0?"Good Moral Character Cert, ":"");
										echo (strpos($dataClassList['stud_credentials'],"shs138")==0?"Form 138, ":"");
										echo (strpos($dataClassList['stud_credentials'],"shs137")==0?"Form 137, ":"");
										echo (strpos($dataClassList['stud_credentials'],"shsNca")==0?"NCAE":"");	
									}
									?>
								</small></small></small></small></td>
								<td><a href="./?page=student&showProfile=<?php echo $dataClassList['stud_no']; ?>&tab=history" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-user"></span></a>
								<a title="Transact" <?php echo ($_SESSION["user_role"]==2?"disabled":"");?> class="btn btn-success btn-xs" href="./?page=financials&showProfile=<?php echo $dataClassList['stud_no'];?>&tab=assessments">&nbsp;$&nbsp;</a></td>
                            </tr>
						<?php 
						$i++;
						} ?>						
						</tbody>
					</table>
				</div>
			</div>
		</div>

			
		</div>	
	</div>
	
	