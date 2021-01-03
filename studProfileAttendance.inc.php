<div class="row-fluid">
	<div class="span12"><br>
		<div class="panel panel-default">
			<div class="panel-heading">
				Attendance Records</div>
			<div class="table-responsive">
				<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
					<thead>
						<tr>
					<th width="5%">SY</th>
					<th width="5%">First Day</th>
					<th width="3%">Jun</th>
					<th width="3%">Jul</th>
					<th width="3%">Aug</th>
					<th width="3%">Sep</th>
					<th width="3%">Oct</th>
					<th width="3%">Nov</th>
					<th width="3%">Dec</th>
					<th width="3%">Jan</th>
					<th width="3%">Feb</th>
					<th width="3%">Mar</th>
					<th width="3%">Apr</th>
					<th width="3%">May</th>
					<th width="3%">Total</th>
					<th width="3%">%</th>
					<th width="3%"></th>

				</tr>
			</thead>
			<tbody>
			<?php
			$resultEnrollList = dbquery("select * from studenroll where (enrol_stud_no='".$_GET['showProfile']."' and enrol_level>='".$current_school_minlevel."') order by enrol_sy desc");
			while ($dataEnrollList = dbarray($resultEnrollList)){
				$checkAtt = dbquery("SELECT * FROM school_days WHERE (sch_sy='".$dataEnrollList['enrol_sy']."' AND sch_stud_no='".$_GET['showProfile']."') ORDER BY sch_sy DESC, sch_no asc");
				$dataAtt = dbarray($checkAtt);
				$dataAtt = (isset($dataAtt) ? $dataAtt : array("sch_firstday"=>"0000-00-00", "sch_m1"=>0, "sch_m2"=>0, "sch_m3"=>0, "sch_m4"=>0, "sch_m5"=>0, "sch_m6"=>0, "sch_m7"=>0, "sch_m8"=>0, "sch_m9"=>0, "sch_m10"=>0, "sch_m11"=>0, "sch_m12"=>0));
			?>
				<tr>
					<td><small><small><?php echo $dataEnrollList['enrol_sy'];?>-<?php echo $dataEnrollList['enrol_sy']+1;?></small></small></td>
					<td><small><?php echo $dataAtt['sch_firstday'];?></small></td>
					<td><?php echo number_format($dataAtt['sch_m1'],2);?></td>
					<td><?php echo number_format($dataAtt['sch_m2'],2);?></td>
					<td><?php echo number_format($dataAtt['sch_m3'],2);?></td>
					<td><?php echo number_format($dataAtt['sch_m4'],2);?></td>
					<td><?php echo number_format($dataAtt['sch_m5'],2);?></td>
					<td><?php echo number_format($dataAtt['sch_m6'],2);?></td>
					<td><?php echo number_format($dataAtt['sch_m7'],2);?></td>
					<td><?php echo number_format($dataAtt['sch_m8'],2);?></td>
					<td><?php echo number_format($dataAtt['sch_m9'],2);?></td>
					<td><?php echo number_format($dataAtt['sch_m10'],2);?></td>
					<td><?php echo number_format($dataAtt['sch_m11'],2);?></td>
					<td><?php echo number_format($dataAtt['sch_m12'],2);?></td>
					<?php
					$checkPresent = dbquery("SELECT (sch_m1 + sch_m2 + sch_m3 + sch_m4 + sch_m5 + sch_m6 + sch_m7 + sch_m8 + sch_m9 + sch_m10 + sch_m11 + sch_m12) as total FROM school_days WHERE (sch_sy='".$dataEnrollList['enrol_sy']."' AND sch_stud_no='".$_GET['showProfile']."')");
					$dataPresent = dbarray($checkPresent);
					$dataPresent = (isset($dataPresent) ? $dataPresent : array("total"=>0));
					?>
					<td><?php echo number_format($dataPresent['total'],2);?></td>
					<?php
					$checkSchoolDays = dbquery("SELECT (sch_m1 + sch_m2 + sch_m3 + sch_m4 + sch_m5 + sch_m6 + sch_m7 + sch_m8 + sch_m9 + sch_m10 + sch_m11 + sch_m12) as total FROM school_days WHERE (sch_sy='".$dataEnrollList['enrol_sy']."' AND sch_stud_no='".$dataEnrollList['enrol_sy']."')");
					$dataSchoolDays = dbarray($checkSchoolDays);
					$dataSchoolDays = (isset($dataSchoolDays) ? $dataSchoolDays : array("total"=>0));
					$dataSchDays = ($dataSchoolDays['total']==0?1:number_format($dataSchoolDays['total'],2));
					?>
					<td><?php echo number_format($dataPresent['total']/$dataSchDays*100,2);?>%</td>
					<td>
						<?php
						if($_SESSION["user_role"]==0 || $_SESSION["user_role"]==2){}
						else{
						?>
						<a href="schoolDays.frm.php?enrol_sy=<?php echo $dataEnrollList['enrol_sy'];?>&stud_no=<?php echo $_GET['showProfile'];?>" title="Modify Attendance" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
							<span class="glyphicon glyphicon-calendar" ></span></a>
						<?php 
						}
						?>
					</td>
				</tr>
			<?php
			}
			?>
			</tbody>
			</table>
			</div>
		</div>
	</div>
</div>