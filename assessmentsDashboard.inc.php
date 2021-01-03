		<div class="pagecontent container">
			<div class="row row-toolbar">
			<div class="col-lg-6">
			<h3>Assessments</h3>
			</div>
			
			<div class="col-lg-3 col-md-3 col-lg-push-3 col-md-push-3">
					<div class="btn-group pull-right" style="margin-top: 5px;">
					
					</div>
				</div>
				
			</div>
			<div  class="tabbable"><br>
	<ul class="nav nav-tabs">
		<li class="active"><a href="#view_accounts" data-toggle="tab">Current School Year's Fees</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="view_accounts">
			<div class="row-fluid">
				<div class="span12"><br>
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="btn-toolbar  pull-right">
							<div class="btn-group">

								<?php
									$checkAssessment = dbquery("SELECT * FROM bill_bills WHERE bill_sy='".$current_sy."' ORDER BY bill_prio ASC");
									$rowsAssessment = dbrows($checkAssessment);
									$disableEnroll = "";
									?>
								<a  <?php echo ($rowsAssessment>0?"disabled":"");?> href="assess.inc.php?Recycle=Yes" class="btn  btn-xs  btn-default" title="Mass Assess" onClick="return confirm('Are you sure you want to recyle bills from the previous school year?')" <?php echo $disableEnroll; ?>>Recycle Fees</a>				
								<?php
								$checkUnAssessed = dbquery("SELECT * FROM studenroll WHERE (enrol_sy='".$current_sy."' AND enrol_section!='' AND enrol_stud_no NOT IN (SELECT (ass_stud_no) FROM bill_assessment where ass_sy='".$current_sy."'))");
								$countUnAssessed = dbrows($checkUnAssessed);
								?>								
								<a  href="assess.inc.php?MassAssess=Yes" class="btn  btn-xs  btn-default" title="Mass Assess" onClick="return confirm('Are you sure you want to mass assess to currently enrolled students?')" <?php echo $disableEnroll; ?>>Mass Assess (<?php echo $countUnAssessed;?>)</a>				
								<a href="assessmentsNew.frm.php" class="btn  btn-xs  btn-default" title="New Assessment" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" <?php echo $disableEnroll; ?>><span class="glyphicon glyphicon-plus"></span></a>							
								
							</div>
							</div>
							
							Current Fees / SY <?php echo $current_sy;?>-<?php echo $current_sy+1;?> / <?php echo ($current_sem==1?"First":"Second")?> Semester</div>
						<div class="table-responsive">
							<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
								<thead>
									<tr>
										<th width="3%">#</th>
										<th width="15%">Category</th>
										<th>Description</th>
										<th width="15%">Amount</th>		
										<th width="15%">Action</th>		
										<th width="10%"></th>	
									</tr>
								</thead>
								<tbody> 
									<?php
									$i=1;
									$sum=0;
									while($dataAssessment = dbarray($checkAssessment)){
									?>
									<tr>
										<td><?php echo $i;?></td>
										<td><?php echo $dataAssessment['bill_category'];?></td>
										<td><?php echo $dataAssessment['bill_desc'];?></td>	
										<td><?php echo $dataAssessment['bill_amount'];?></td>	
										<?php
										$checkUnAssessed = dbquery("SELECT * FROM studenroll WHERE (enrol_sy='".$current_sy."' AND enrol_section!='' AND enrol_stud_no NOT IN (SELECT (ass_stud_no) FROM bill_assessment where ass_bill_no='".$dataAssessment['bill_no']."'))");
										$countUnAssessed = dbrows($checkUnAssessed);
										?>														
										<td>
											<a  href="assess.inc.php?BillAssess=Yes&bill_no=<?php echo $dataAssessment['bill_no']; ?>" class="btn  btn-xs  btn-default" title="Mass Assess" onClick="return confirm('Are you sure you want to assess this bill to currently enrolled students?')" <?php echo $disableEnroll; ?>>Bill Assess (<?php echo $countUnAssessed;?>)</a>	
										</td>
										<td><a href="assessmentsUpdate.frm.php?bill_no=<?php echo $dataAssessment['bill_no']; ?>" title="Update" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
												<span class="glyphicon glyphicon-pencil"></span></a>
												<?php
													$checkBill = dbquery("SELECT * FROM bill_assessment WHERE ass_bill_no='".$dataAssessment['bill_no']."'");
													$countBill = dbrows($checkBill);
												?>
											<a <?php echo ($countBill>0?"disabled":"");?> href="assessmentsUpdate.frm.php?Delete=Yes&bill_no=<?php echo $dataAssessment['bill_no']; ?>" title="Delete" onClick="return confirm('Are you sure you want to delete entry?')" class="btn  btn-xs  btn-default">
												<span class="glyphicon glyphicon-remove"></span></a>
										</td>								
									</tr>
									<?php 
									$i++; 
									$sum=$sum+ $dataAssessment['bill_amount']; } ?>
									<tr>
										<td colspan="3" align="right"><b>TOTAL</td>
										<td colspan="3"><b><?php echo $sum;?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		</div>
	</div>
</div>
		</div>	
	</div>