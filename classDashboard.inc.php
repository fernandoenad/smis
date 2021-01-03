<?php

?>
		<div class="pagecontent container">
			<div class="row row-toolbar">
				<div class="col-lg-3 col-md-3 col-lg-push-9 col-md-push-9">
					<div class="btn-group pull-right" style="margin-top: 5px;">
						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
						SY <?php echo $_GET['enrol_sy'];?> - <?php echo $_GET['enrol_sy']+1;?>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
							<li role="presentation" class="dropdown-header">Select School Year</li>
							<?php 
								$checkSY = dbquery("select settings_sy from settings order by settings_sy desc");
								while($dataSY = dbarray($checkSY)){
							?>
							<li><a href="?page=class&enrol_sy=<?php echo $dataSY['settings_sy'];?>"><?php echo $dataSY['settings_sy'];?> - <?php echo $dataSY['settings_sy']+1;?></a></li>
							<?php }	?>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-lg-pull-3 col-md-pull-3"  style="margin-top: 5px;">
					<div class="btn-group">
					<?php 
					if($_SESSION["user_role"]==0){
					?>						
						<a href="classNew.frm.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>" title="New class" class="btn btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false"><span class="glyphicon glyphicon-plus"></span> Create Class</a>
					<?php } ?>
					</div>
				</div>
			</div>

			<div class="page-header" style="margin-top: 20px">
				<h1>List of Classes</h1>
			</div>
			<ol class="breadcrumb">
				<li><a href="./?page=class&enrol_sy=<?php echo $current_sy; ?>">Class</a></li>
			</ol>
			<div class="panel panel-default">
  <div class="panel-heading">
      Overview
					<div class="btn-toolbar  pull-right">
						<a href="" class="btn  btn-xs  btn-default"  onclick="window.open('showForm4a.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $current_month;?>', '', 'width=850, height=600'); return false;">Form 3 (Old)</a>				
						
						<a href="" class="btn  btn-xs  btn-default"  onclick="window.open('showForm4.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $current_month;?>&g1=<?php echo $current_school_minlevel;?>&gn=<?php echo ($current_school_maxlevel>10?10:$current_school_maxlevel);?>', '', 'width=1350, height=600'); return false;">SF4</a>	
						<?php
						if($current_school_maxlevel>10){
						?>
						<a href="" class="btn  btn-xs  btn-default"  onclick="window.open('showForm4shs.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $current_month;?>&g1=11&gn=12', '', 'width=1350, height=600'); return false;">SF4-SHS</a>				
						<?php 
						}
						?>
						
						<a href="" class="btn  btn-xs  btn-default"  <?php echo ($eoyupdate==0?"disabled":"");?> onclick="window.open('showForm6.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&g1=<?php echo $current_school_minlevel;?>&gn=<?php echo ($current_school_maxlevel>10?10:$current_school_maxlevel);?>', 'newwindow', 'width=1350, height=600'); return false;">SF6</a>
						<?php
						if($current_school_maxlevel>10){
						?>
						<a href="" class="btn  btn-xs  btn-default"  <?php echo ($eoyupdate==0?"disabled":"");?> onclick="window.open('showForm6shs.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&g1=11&gn=12', 'newwindow', 'width=1350, height=600'); return false;">SF6-SHS</a>
						<?php 
						}
						?>
						
						<a href="" class="btn  btn-xs  btn-default"  onclick="window.open('showForm7.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&g1=<?php echo $current_school_minlevel;?>&gn=<?php echo ($current_school_maxlevel>10?10:$current_school_maxlevel);?>', 'newwindow', 'width=1350, height=600'); return false;">SF7</a>
						<?php
						if($current_school_maxlevel>10){
						?>
						<a href="" class="btn  btn-xs  btn-default"  onclick="window.open('showForm7shs.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&g1=11&gn=12', 'newwindow', 'width=1350, height=600'); return false;">SF7-SHS</a>
						<?php 
						}
						?>
						
						<a href="" class="btn  btn-xs  btn-default"  onclick="window.open('showBMIGen.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&g1=<?php echo $current_school_minlevel;?>&gn=<?php echo ($current_school_maxlevel>10?10:$current_school_maxlevel);?>', 'newwindow', 'width=1350, height=600'); return false;">SF8</a>
						<?php
						if($current_school_maxlevel>10){
						?>
						<a href="" class="btn  btn-xs  btn-default"  onclick="window.open('showBMIGen.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&g1=11&gn=12', 'newwindow', 'width=1350, height=600'); return false;">SF8-SHS</a>
						<?php 
						}
						?>
						
						<a href="" class="btn  btn-xs  btn-default"  onclick="window.open('showPayHisGen.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>', 'newwindow', 'width=1350, height=600'); return false;">Pymts Summ (By Class)</a>
						<a href="" class="btn  btn-xs  btn-default"  onclick="window.open('showPayHisGen2.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>', 'newwindow', 'width=1350, height=600'); return false;">Pymts Summ (By Student)</a>
						</div>		  
				</div>			
			
				<div class="list-group">
					<h4 class="list-group-item-heading"></h4>
					<div class="row">
						<div class="col-lg-4 col-md-4">
						<div class="text-center">
							<strong>No of learners</strong>
						</div>
						<?php
						$resultCountSY = dbquery("SELECT enrol_sy, enrol_status1, enrol_section FROM studenroll WHERE (enrol_sy='".$_GET['enrol_sy']."' AND enrol_status1!='INACTIVE' AND enrol_section!='')");
						$rowCountSY = dbrows($resultCountSY);
						?>
						<div class="text-center figure1"><?php echo $rowCountSY; ?></div>

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
									<td><a href="showEnrollmentProm.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">Promoted</a></td>
									<?php
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='PROMOTED' AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='PROMOTED' AND enrol_section!='' AND student.stud_gender='FEMALE')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<tr>
									<td><a href="showEnrollmentCond.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">Conditional</a></td>
									<?php
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='IRREGULAR' AND enrol_section!='' AND student.stud_gender='FEMALE')");									
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<tr>
									<td><a href="showEnrollmentRet.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">Retained</a></td>
									<?php
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='PROMOTED' AND studenroll.enrol_status2='RETAINED' AND enrol_section!='' AND student.stud_gender='FEMALE')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
							</tbody>
						</table>
						<?php
						if($current_school_maxlevel>10){
						?>
						<table class="table table-condensed">
							<thead>
								<th style="width:180px">Senior HS Programs</th>
								<th class="text-center">Male</th>
								<th class="text-center">Female</th>
							</thead>
							<tbody>
								<?php
								$checkOfferingsTracks = dbquery("SELECT * FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND enrol_track!='' and enrol_stud_no!='0' and enrol_level>10 AND enrol_section!='') group by enrol_track order by enrol_track asc");								
								while($dataOfferingsTracks = dbarray($checkOfferingsTracks)){
								?>
								<tr>
									<td><a href="showEnrollmentProgram.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>&enrol_track=<?php echo $dataOfferingsTracks['enrol_track'];?>" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false"><?php echo $dataOfferingsTracks['enrol_track'];?></a></td>
									<?php
									$resultCountSYM = dbquery("SELECT * FROM studenroll INNER JOIN student ON enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND enrol_track='".$dataOfferingsTracks['enrol_track']."' AND enrol_track!='' and enrol_stud_no!='0' AND enrol_level>'10' AND enrol_section!='' AND student.stud_gender='MALE' AND enrol_status1!='INACTIVE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT *	 FROM studenroll INNER JOIN student ON enrol_stud_no=student.stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND enrol_track='".$dataOfferingsTracks['enrol_track']."' AND enrol_track!='' and enrol_stud_no!='0' AND enrol_level>'10' AND enrol_section!='' AND student.stud_gender='FEMALE' AND enrol_status1!='INACTIVE')");
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
									<td><a href="showEnrollmentCurrent.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">Current Enrollment</a></td>
									<?php
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED') AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED') AND enrol_section!='' AND student.stud_gender='FEMALE')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>	
								<?php
								if($current_school_maxlevel>10){
								?>
								<tr>
									<td>* Junior HS</td>
									<?php
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED') and enrol_level<11 AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED') and enrol_level<11 AND enrol_section!='' AND student.stud_gender='FEMALE')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<tr>
									<td>* Senior HS</td>
									<?php
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED') AND enrol_track!='' and enrol_stud_no!='0' and enrol_level>10 AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND (enrol_status1='ENROLLED' OR enrol_status1='PROMOTED') AND enrol_track!='' and enrol_stud_no!='0' and enrol_level>10 AND enrol_section!='' AND student.stud_gender='FEMALE')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<?php
								}
								?>
								<tr>
									<td><a href="showEnrollment.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">Annual Enrollment</a></td>
									<?php
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND enrol_section!='' AND student.stud_gender='FEMALE')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<?php
								if($current_school_maxlevel>10){
								?>	
								<tr>
									<td>* Junior HS</td>
									<?php
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' and enrol_level<11 AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."'  and enrol_level<11 AND enrol_section!='' AND student.stud_gender='FEMALE')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<tr>
									<td>* Senior HS</td>
									<?php
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND enrol_track!='' and enrol_stud_no!='0' and enrol_level>10 AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND enrol_track!='' and enrol_stud_no!='0' and enrol_level>10 AND enrol_section!='' AND student.stud_gender='FEMALE')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<?php
								}
								?>
								<tr>
								<tr>
									<td colspan="3"></td>
								</tr>
								<tr>
									<td><a href="showEnrollmentBOSY.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">BOSY Enrollment</a></td>
									<?php
									$enrol_sy=$_GET['enrol_sy'];
									$checkLateDates = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
									$dataLateDates = dbarray($checkLateDates);
									
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND enrol_admitdate<='".$dataLateDates['settings_late1']."' and enrol_admitdate!='0000-00-00 00:00:00' AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND enrol_admitdate<='".$dataLateDates['settings_late1']."' and enrol_admitdate!='0000-00-00 00:00:00' AND enrol_section!='' AND student.stud_gender='FEMALE')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<tr>
									<td><a href="showEnrollmentLE.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">Late Enrollees (1<sup>st</sup> Sem)</a></td>
									<?php
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$dataLateDates['settings_sy']."' AND studenroll.enrol_admitdate>'".$dataLateDates['settings_late1']."' AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$dataLateDates['settings_sy']."' AND studenroll.enrol_admitdate>'".$dataLateDates['settings_late1']."' AND enrol_section!='' AND student.stud_gender='FEMALE')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<!-- to work on .... -->
								<!--
								<tr>
									<td><a href="showEnrollmentBA.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">Balik Aral</a></td>
									<?php									
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$dataLateDates['settings_sy']."' AND studenroll.enrol_admitdate>'".$dataLateDates['settings_late1']."' AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$dataLateDates['settings_sy']."' AND studenroll.enrol_admitdate>'".$dataLateDates['settings_late1']."' AND enrol_section!='' AND student.stud_gender='FEMALE')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<tr>
									<td><a href="showEnrollmentRP.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">Repeater</a></td>
									<?php									
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$dataLateDates['settings_sy']."' AND studenroll.enrol_admitdate>'".$dataLateDates['settings_late1']."' AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$dataLateDates['settings_sy']."' AND studenroll.enrol_admitdate>'".$dataLateDates['settings_late1']."' AND enrol_section!='' AND student.stud_gender='FEMALE')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								-->
								<tr>
									<td><a href="showEnrollmentTI.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">Transferred In</a></td>
									<?php
									$enrol_sy=$_GET['enrol_sy'];
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$enrol_sy."' AND studenroll.enrol_ti='1' AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$enrol_sy."' AND studenroll.enrol_ti='1' AND enrol_section!='' AND student.stud_gender='FEMALE')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<?php
								if($current_school_maxlevel>10){
								?>
								<tr>
								<tr bgcolor="lightgray">
									<td><a href="showEnrollmentNS.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">New Student (2<sup>nd</sup> Sem, SHS)</a></td>
									<?php
									$enrol_sy=$_GET['enrol_sy'];
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$enrol_sy."' AND enrol_admitdate='0000-00-00 00:00:00' AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$enrol_sy."' AND enrol_admitdate='0000-00-00 00:00:00' AND enrol_section!='' AND student.stud_gender='FEMALE')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center">(<?php echo $rowCountSYM; ?>)</td>
									<td  class="text-center">(<?php echo $rowCountSYF; ?>)</td>
								</tr>
								<tr bgcolor="lightgray">
									<td><a href="showEnrollmentLE2.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">Late Enrollees (2<sup>nd</sup> Sem, SHS)</a></td>
									<?php
									$enrol_sy=$_GET['enrol_sy'];
									$checkLateDates = dbquery("select * from settings where settings_sy='".$_GET['enrol_sy']."'");
									$dataLateDates = dbarray($checkLateDates);
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$dataLateDates['settings_sy']."' AND studenroll.enrol_admitdate2>'".$dataLateDates['settings_late2']."' AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$dataLateDates['settings_sy']."' AND studenroll.enrol_admitdate2>'".$dataLateDates['settings_late2']."' AND enrol_section!='' AND student.stud_gender='FEMALE')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center">(<?php echo $rowCountSYM; ?>)</td>
									<td  class="text-center">(<?php echo $rowCountSYF; ?>)</td>
								</tr>
								<?php
								}
								?>
								<tr>
								<tr>
									<td><a href="showEnrollmentTO.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">Transferred Out</a></td>
									<?php
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='INACTIVE' AND studenroll.enrol_status2='TRANSFERRED OUT' AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='INACTIVE' AND studenroll.enrol_status2='TRANSFERRED OUT' AND enrol_section!='' AND student.stud_gender='FEMALE')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								</tr>
								<tr>
									<td><a href="showEnrollmentDO.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">Dropped Out</a></td>
									<?php
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='INACTIVE' AND studenroll.enrol_status2='DROPPED OUT' AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND studenroll.enrol_status1='INACTIVE' AND studenroll.enrol_status2='DROPPED OUT' AND enrol_section!='' AND student.stud_gender='FEMALE')");
									$rowCountSYF = dbrows($resultCountSYF);									
									?>									
									<td  class="text-center"><?php echo $rowCountSYM; ?></td>
									<td  class="text-center"><?php echo $rowCountSYF; ?></td>
								 </tr>
								<tr>
									<td colspan="3"></td>
								</tr>
								<tr>
									<td><a href="showEnrollmentCCT.frm.php?enrol_sy=<?php echo $_GET['enrol_sy'];?>" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">CCT / 4Ps</a></td>
									<?php
									$enrol_sy=$_GET['enrol_sy'];
									$resultCountSYM = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."'  AND enrol_status1!='INACTIVE' AND stud_cct!='NO' AND enrol_section!='' AND student.stud_gender='MALE')");
									$rowCountSYM = dbrows($resultCountSYM);
									$resultCountSYF = dbquery("SELECT enrol_no FROM studenroll INNER JOIN student ON student.stud_no=enrol_stud_no WHERE (studenroll.enrol_sy='".$_GET['enrol_sy']."' AND enrol_status1!='INACTIVE' AND stud_cct!='NO' AND enrol_section!='' AND student.stud_gender='FEMALE')");
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
			</div></div>

			<div class="row">
				<?php 
				$checkYearLevels = dbquery("select section_level, section_name, section_sy from section where section_sy='".$current_sy."' group by section_level order by section_level asc");
				$countLevels = dbrows($checkYearLevels);
				$counter=1;
				//for ($i=$current_school_minlevel; $i<=$current_school_maxlevel; $i++){
				while($dataYearLevels = dbarray($checkYearLevels)){
				?>
                <div class="col-sm-2">
					<div class="panel panel-default">
						<div class="panel-heading">
								<?php
								$resultLevel = dbquery("SELECT * FROM studenroll WHERE (enrol_status1!='INACTIVE' AND enrol_section!='' AND enrol_level='".$dataYearLevels['section_level']."' AND enrol_sy='".$_GET['enrol_sy']."')");
								$rowLevel = dbrows($resultLevel);
								?>
							<center><strong><a href="" onclick="window.open('levelList.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $dataYearLevels['section_level'];?>', 'newwindow', 'width=1350, height=600'); return false;">Grade <?php echo $dataYearLevels['section_level']; ?></a> <a href="" onclick="window.open('levelListg10.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $dataYearLevels['section_level'];?>', 'newwindow', 'width=1350, height=600'); return false;">*</a></strong><span class="label label-default pull-right">
<?php echo $rowLevel; ?></span><br>
						</div>
						<?php
						$resultSections = dbquery("SELECT section_no, section_name FROM section WHERE (section_level='".$dataYearLevels['section_level']."' AND section_sy='".$_GET['enrol_sy']."') ORDER BY section_name ASC");
						while ($dataSections = dbarray($resultSections)){
						if(substr($dataSections['section_name'],0,2)=="Z_"){
						}
						else{
						?>
						<ul class="list-group">
                            <li class="list-group-item clearfix">
                                <p>
								<?php
								$resultClass = dbquery("SELECT enrol_no FROM studenroll WHERE (enrol_section='".$dataSections['section_name']."' AND enrol_status1!='INACTIVE' AND enrol_sy='".$_GET['enrol_sy']."')");
								$dataClass = dbarray($resultClass);
								$rowClass = dbrows($resultClass);
								?>
                                  <span class="label label-default pull-right"><?php echo $rowClass; ?></span>
                                  <a href="./?page=class&enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $dataSections['section_name']; ?>&section_no=<?php echo $dataSections['section_no']; ?>"><strong><?php echo $dataSections['section_name']; ?></strong></a>
								</p>
                                <div class="pull-left"></div>
                                <div class="pull-right">
									<div class="btn-group">
                                        <a href="./?page=class&enrol_sy=<?php echo $_GET['enrol_sy']; ?>&classProfile=<?php echo $dataSections['section_name']; ?>&section_no=<?php echo $dataSections['section_no']; ?>" class="btn btn-default btn-sm">View Enrolment</a>
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li <?php echo ($_GET['enrol_sy']!=$current_sy?"class=disabled":"");?>><a href="enroll.frm.php" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false"><span class="text-primary glyphicon glyphicon-user"></span> Enrol Learner</a></li>
                                            <li class="divider"></li>
											<?php
											$resultGrade = dbquery("SELECT class_no FROM class INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (class.class_sy='".$_GET['enrol_sy']."' AND class.class_section_no='".$dataSections['section_no']."') ORDER BY pros_no");
											$rowsGrade = dbrows($resultGrade);
											?>	
											<li <?php echo ($_GET['enrol_sy']!=$current_sy?"class=disabled":"");?>><a href="./?page=schedule&enrol_sy=<?php echo $_GET['enrol_sy']; ?>&section_no=<?php echo $dataSections['section_no']; ?>"><span class="glyphicon glyphicon-list"></span> View Sched <span class="label label-default pull-right"><?php echo $rowsGrade;?></span></a></li>
                                            <li <?php echo ($_GET['enrol_sy']!=$current_sy?"class=disabled":"");?>><a href="classUpdate.frm.php?enrol_sy=<?php echo $_GET['enrol_sy']; ?>&section_no=<?php echo $dataSections['section_no']; ?>"  data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" title="Class settings"><span class="glyphicon glyphicon-cog"></span> Class settings</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
						<?php } } ?>
					</div>
				</div>
				<?php 
				$counter++;
				if ($countLevels>6 && $counter==7){
					echo "</div><hr>";
					echo "<div class=row>";
				}
				
				} ?>
			</div>

			
		</div>	
	</div>