<?php

?>
		<div class="pagecontent container">
		<div class="row row-toolbar">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-push-8 col-md-push-8 col-sm-push-8 col-xs-push-8 clearfix"></div>
	
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-pull-4 col-md-pull-4 col-sm-pull-4 col-xs-pull-4">
                <select class="form-control" id="ui-classes" style="margin-top: 5px" onchange="if (this.value) window.location.href=this.value">
					<option value=".?page=student&earlyRegistration&er_level=all" <?php echo ($_GET['er_level']=="all"?"selected":"");?>>List</option>
				<?php
				for ($i=$current_school_minlevel; $i<=$current_school_maxlevel; $i++) {
				?>
					<option value=".?page=student&earlyRegistration&er_level=<?php echo $i;?>" <?php echo ($_GET['er_level']==$i?"selected":"");?>>Grade <?php echo $i;?></option>
				<?php
				}
				?>
                </select>

          </div>
		</div>
			<div class="page-header" style="margin-top: 20px">
				<h1>Early Registry for SY <?php echo $current_sy+1;?>-<?php echo $current_sy+2;?></h1>
			</div>
	    <ol class="breadcrumb">
        <li><a href="">Early Registry</a></li>
    </ol>
			<div class="panel panel-default">
				<div class="panel-heading">
				<div class="btn-toolbar  pull-right">
						<div class="btn-group">
						
							<a href="" class="btn  btn-xs  btn-default" <?php echo ($_GET['er_level']=="all"?"disabled":"");?> onclick="window.open('EarlyRegistrationList.php?er_level=<?php echo $_GET['er_level'];?>', '', 'width=1200, height=600'); return false;" title="Print Early Registration List" class="btn  btn-xs  btn-default">
							<span class="glyphicon glyphicon-print"></span></a>
						</div>
					</div>
					Early Registry for SY <?php echo $current_sy+1;?>-<?php echo $current_sy+2;?>, <?php echo ($dataClasses['grade_sem']=="1"?"First Semester":($dataClasses['grade_sem']=="2"?"Second Semester":"Full Year"));?> 
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-condensed table-striped table-sticky">
						<thead>
							<tr>
								<th width="4%">#</th>
								<th>Name</th>
								<th width="5%">Sex</th>
								<th width="5%">Age</th>
								<th width="10%">Birthdate</th>
								<th width="20%">Address</th>
								<th width="15%">Disability</th>
								<th width="15%">Remarks</th>
								<th width="5%"></th>
							</tr>
						</thead>

						<tbody>
						<?php
							$i=1;
							$earlyRegYr = $current_sy+1;
							if($_GET['er_level']=="all"){
								$checkLoads = dbquery("select * from earlyregistry inner join student on er_stud_no=stud_no where (er_sy='".$earlyRegYr."' ) order by stud_lname asc, stud_fname asc");							
							}
							else{
								$checkLoads = dbquery("select * from earlyregistry inner join student on er_stud_no=stud_no where (er_sy='".$earlyRegYr."' and er_level='".$_GET['er_level']."') order by stud_lname asc, stud_fname asc");
							}
							while($dataLoads = dbarray($checkLoads)){
							?>									
							<tr>
								<td><?php echo $i;?></td>
								<td><small><small><?php echo strtoupper($dataLoads['stud_lname'].", ".$dataLoads['stud_fname']." ".substr($dataLoads['stud_mname'],0,1));?> </small></small></td>
								<td><small><small><?php echo $dataLoads['stud_gender'];?></small></small></td>
								<?php
								$date1 = strtotime(date("Y-m-d"));
								$date2 = strtotime($dataLoads['stud_bdate']);
								$time_difference = $date1 - $date2;
								$seconds_per_year = 60*60*24*365;
								$years = round($time_difference / $seconds_per_year);
								?>
								<td><small><small><?php echo $years;?></small></small></td>
								<td><small><small><?php echo  date('Y-m-d',strtotime($dataLoads['stud_bdate']));?></small></small></td>
								<td><small><small><?php echo $dataLoads['stud_residence'];?></small></small></td>
								<td><small><small><?php echo $dataLoads['er_disability'];?></small></small></td>
								<td><small><small><?php echo $dataLoads['er_remarks'];?></small></small></td>
								<td><small><small>
								<a title="Edit Profile" href="./?page=student&updateProfile=<?php echo $dataLoads['stud_no'];  ?>">
									<span class="glyphicon glyphicon-user"></span></a> / 
								<a title="Edit Registry" href="earlyRegistrationUpdate.frm.php?showProfile=<?php echo $dataLoads['stud_no'];?>&er_no=<?php echo $dataLoads['er_no'];?>" data-toggle="modal" data-target="#modal-large" data-backdrop="static" data-keyboard="false">
									<span class="glyphicon glyphicon-share"></span></a>
								
								</small></small></td>
							</tr>	
						<?php
							$i++;
							}
						?>
						</tbody>
					</table>			
				</div>
			</div> 
		</div>	
	</div>