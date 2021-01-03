<div class="row-fluid">
	<div class="span12"><br>
		
		<?php 
		$checkEnrolInfo = dbquery("select * from studenroll where enrol_stud_no='".$_GET['showProfile']."' order by enrol_sy desc");
		$dataEnrolInfo = dbarray($checkEnrolInfo);
		$level = $dataEnrolInfo['enrol_level'];
		$limit = ($level>10?12:($level>6?10:6));
		$low = ($level>10?11:($level>6?7:0));
		$resultProsSems = dbquery("select * from prospectus where (pros_curr='".$current_pros."' and (pros_level between '".$low."' and '".$limit."') and pros_part='1') GROUP BY pros_level ORDER by pros_level ASC ");
		while($dataProsSems = dbarray($resultProsSems))	{
		$resultGradeOAll = dbquery("SELECT * FROM prospectus WHERE (pros_curr='".$current_pros."' and pros_level='".$dataProsSems['pros_level']."' and pros_part='1') GROUP BY pros_sem ORDER BY pros_sem ASC, pros_sort ASC");
		while($dataGradeOAll = dbarray($resultGradeOAll)){
		?>	
			<div class="panel panel-default">
			<div class="panel-heading">
				Grade <?php echo $dataProsSems['pros_level']; ?>, <?php echo ($dataGradeOAll['pros_sem']=="1"?"First Semester":($dataGradeOAll['pros_sem']=="2"?"Second Semester":"Full Year"));?></div>
			<div class="table-responsive">
				<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
					<thead>
						<tr>
							<th width="15%">Course Code</th>
							<th>Descriptive Title</th>
							<th width="10%">Cut-off Grade</th>
							<th width="12%">No. of Takes</th>
							<th width="15%">Pre-requisites</th>
							<th width="5%">Units</th>
							<th width="8%">Grade</th>
							<th width="8%">Remarks</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$pros= substr($dataEnrolInfo['enrol_strand'],strlen($dataEnrolInfo['enrol_strand'])-2,strlen($dataEnrolInfo['enrol_strand']));
					$resultProspectus = dbquery("SELECT * FROM prospectus WHERE (pros_curr='".$current_pros."' AND pros_level='".$dataProsSems['pros_level']."' and pros_sem='".$dataGradeOAll['pros_sem']."' and pros_part='1') ORDER BY pros_sort ASC");
					while($dataProspectus = dbarray($resultProspectus)){
						if(substr($dataProspectus['pros_track'],-3)=="RAL" || substr($dataProspectus['pros_track'],-3)=="IED" || substr($dataProspectus['pros_track'],-2)==$pros){
							$resultProsGrade = dbquery("SELECT * FROM grade INNER JOIN student ON student.stud_no=grade.grade_stud_no INNER JOIN class ON grade.grade_class_no=class.class_no INNER JOIN prospectus ON class.class_pros_no=prospectus.pros_no WHERE (class.class_pros_no='".$dataProspectus['pros_no']."' AND grade.grade_stud_no='".$_GET['showProfile']."')");
							$dataProsGrade = dbarray($resultProsGrade);
							$countProsGrade = dbrows($resultProsGrade);	
							$dataProsGrade = (isset($dataProsGrade) ? $dataProsGrade : array("grade_final"=> 0, "grade_remarks"=>""));												
					?>	
						<tr>
							<td width="12%"><?php echo $dataProspectus['pros_title'];?> (<?php echo ($dataProspectus['pros_track']=="SHS GENERAL"?"Core":($dataProspectus['pros_track']=="SHS APPLIED"?"Applied":"Major"));?>)</td>
							<td><?php echo substr(ucwords(strtolower($dataProspectus['pros_desc'])),0,30); ?>...
							<a href="#" title="Remarks" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="<?php echo $dataProspectus['pros_desc']; ?>"><span class="glyphicon glyphicon-zoom-in"></a>
							</td>
							<td width="10%"><?php echo $dataProspectus['pros_cutoff'];?></td>
							<td width="12%"><?php echo $countProsGrade;?></td>
							<td width="15%"><small><?php echo $dataProspectus['pros_prereq'];?></small></td>
							<td width="5%"><?php echo number_format($dataProspectus['pros_unit'],2);?></td>
							<td width="8%"><?php echo ($dataProsGrade['grade_final']<60?"-":$dataProsGrade['grade_final']);?></td>
							<td width="8%"><?php echo ($dataProsGrade['grade_remarks']==1?"PASSED":"FAILED");?></td>
						</tr>
					<?php } }?>	
					</tbody>
				</table>
			</div></div>
		<?php }} ?><br>
		
	</div>
</div>