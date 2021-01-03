<?php

	$checkStudent = dbquery("SELECT * FROM student WHERE stud_no='".$_GET['showProfile']."'");
	$dataStudent = dbarray($checkStudent);
	$checkAssessment = dbquery("SELECT * FROM bill_assessment INNER JOIN  bill_bills ON ass_bill_no=bill_no WHERE (ass_sy='".$current_sy."' AND ass_stud_no='".$_GET['showProfile']."') ORDER BY bill_no ASC");


?>
		<div class="pagecontent container">
			<div class="row row-toolbar">
			<div class="col-lg-6">
			<h3><a href="./?page=student&showProfile=<?php echo $_GET['showProfile'];?>&tab=history"><?php echo strtoupper($dataStudent['stud_lname'].", ".$dataStudent['stud_fname']." ".$dataStudent['stud_xname']." ".$dataStudent['stud_mname']);?></a> <br>
			<?php
				$checkEnrol = dbquery("SELECT * FROM studenroll WHERE (enrol_stud_no='".$_GET['showProfile']."' AND enrol_sy='".$current_sy."')");
				$dataEnrol = dbarray($checkEnrol);
				
			?>
			<small> <?php echo ($dataEnrol['enrol_level']==""?"Not Enrolled for the current School Year":"Grade ".$dataEnrol['enrol_level']." - ".$dataEnrol['enrol_section']);?></small>
			</h3>
			</div>
			
			<div class="col-lg-3 col-md-3 col-lg-push-3 col-md-push-3">
					<div class="btn-group pull-right" style="margin-top: 5px;">
					<a href="./?page=student&transact=Yes">New <i title="New Transaction" class="glyphicon glyphicon-search"></i></a> | Receipt #:
						<h1>
						<?php 
						if(isset($_GET['receiptNo'])){
						?>
						<a href="" title="Print Receipt" onclick="window.open('studStatementReceipt.php?&receipt_no=<?php echo $_GET['receiptNo'];?>', 'newwindow', 'width=850, height=600'); return false;"><?php echo $_GET['receiptNo'];?></a>
						<?php
						}
						?>
						</h1>
						
					</div>
				</div>
				
			</div>
			<div  class="tabbable"><br>
	<ul class="nav nav-tabs">
		<li class="<?php echo ($_GET['tab']=="assessments"?"active":"");?>"><a href="?page=financials&showProfile=<?php echo $_GET['showProfile'];?>&tab=assessments">Assessments</a></li>
		<li class="<?php echo ($_GET['tab']=="back"?"active":"");?>"><a href="?page=financials&showProfile=<?php echo $_GET['showProfile'];?>&tab=back">Back Balances</a></li>
		<li class="<?php echo ($_GET['tab']=="ledger"?"active":"");?>"><a href="?page=financials&showProfile=<?php echo $_GET['showProfile'];?>&tab=ledger">Ledger</a></li>
	</ul>
	<div class="tab-content">
		<div class="<?php echo ($_GET['tab']=="assessments"?"tab-pane active":"tab-pane");?>" id="assessments">
			<div class="row-fluid">
				<div class="span12"><br>
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="btn-toolbar  pull-right">
							<div class="btn-group">
								<?php
									$checkAssessment = dbquery("SELECT * FROM bill_assessment INNER JOIN  bill_bills ON ass_bill_no=bill_no WHERE (ass_sy='".$current_sy."' AND ass_stud_no='".$_GET['showProfile']."') ORDER BY bill_prio ASC");
									$rowsAssessment = dbrows($checkAssessment);
									?>
								<a <?php echo ($rowsAssessment>0?"disabled":"");?> href="./assess.inc.php?assess=Yes&enrol_sy=<?php echo $current_sy;?>&stud_no=<?php echo $_GET['showProfile'];?>" title="Assess" onClick="return confirm('Are you sure you want to assess student?')" class="btn  btn-xs btn-default">
									Assess</a>	
								<a href="" class="btn  btn-xs  btn-default" onclick="window.open('studStatement.php?stud_no=<?php echo $_GET['showProfile']; ?>', 'newwindow', 'width=850, height=600'); return false;" Title="Print Statement of Account"><span class="glyphicon glyphicon-print"></span></a>	
								<a href="studStatement.frm.php?stud_no=<?php echo $_GET['showProfile']; ?>" title="Update" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-success">
								Transact</a>
									
							</div>
							</div>
							
							Assessment of Fees / SY <?php echo $current_sy;?>-<?php echo $current_sy+1;?> / <?php echo ($current_sem==1?"First":"Second")?> Semester</div>
						<div class="table-responsive">
							<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
								<thead>
									<tr>
										<th width="10%">Bill Category</th>
										<th>Description</th>
										<th width="10%">Amount</th>
										<th width="13%">Invoice #</th>
										<th width="25%">Remarks</th>
										<th width="10%"></th>
										
										
									</tr>
								</thead>
									<?php
									$sumPayable=0;
									$sumPaid=0;
									while($dataAssessment = dbarray($checkAssessment)){
									?>
									<tr>
										<td><?php echo $dataAssessment['bill_category'];?></td>
										<td><?php echo $dataAssessment['bill_desc'];?></td>
										<td><?php echo $dataAssessment['ass_amount'];?></td>
										<td><?php echo ($dataAssessment['ass_invoice_no']==0?"":$dataAssessment['ass_invoice_no']);?></td>
										<td><?php echo substr($dataAssessment['ass_remarks'],0,20);?>...<a href="#" title="Remarks" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="<?php echo $dataAssessment['ass_remarks'];?>"><span class="glyphicon glyphicon-zoom-in"></a></td>
										<td><a <?php echo ($dataAssessment['ass_invoice_no']==0?"":"disabled");?> href="studStatementWaive.frm.php?stud_no=<?php echo $_GET['showProfile']; ?>&ass_no=<?php echo $dataAssessment['ass_no'];?>" title="Waive Fee" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-gift"></span></a>
											<a <?php echo ($dataAssessment['ass_invoice_no']==1?"":"disabled");?> <?php echo ($_SESSION["user_role"]==1?"":"disabled");?> href="studStatementWaive.frm.php?cancelwaive=yes&ass_no=<?php echo $dataAssessment['ass_no'];?>" onClick="return confirm('Are you sure you want to cancel the waiving of fees?')" title="Cancel Waiving of Fee" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-alert"></span></a>
										</td>
						
										
									</tr>
									<?php 
									$sumPayable=$sumPayable+$dataAssessment['ass_amount'];
									$sumPaid=$sumPaid + ($dataAssessment['ass_invoice_no']==0?0:$dataAssessment['ass_amount']);
									} ?>
									<tr>
										<td colspan="2" align="right"><b>Total Payables / Payments </b></td>
										<td><b><?php echo $sumPayable;?></b></td>
										<td colspan="3"><b><?php echo $sumPaid;?></b></td>
									</tr>
								<tbody> 
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="<?php echo ($_GET['tab']=="back"?"tab-pane active":"tab-pane");?>" id="back">
			<div class="row-fluid">
				<div class="span12"><br>
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="btn-toolbar  pull-right">
							<div class="btn-group">
								<?php
									$checkAssessment = dbquery("SELECT * FROM bill_assessment INNER JOIN  bill_bills ON ass_bill_no=bill_no WHERE (ass_sy!='".$current_sy."' AND ass_stud_no='".$_GET['showProfile']."' and ass_invoice_no=0) ORDER BY bill_prio ASC");
									$rowsAssessment = dbrows($checkAssessment);
									?>
								<a href="studStatementBack.frm.php?stud_no=<?php echo $_GET['showProfile']; ?>" title="Update" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-success">
								Transact</a>
									
							</div>
							</div>
							
							Back Balances</div>
						<div class="table-responsive">
							<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
								<thead>
									<tr>
										<th width="10%">Bill Category</th>
										<th>Description</th>
										<th width="10%">Amount</th>
										<th width="13%">Invoice #</th>
										<th width="25%">Remarks</th>
										<th width="10%"></th>
										
										
									</tr>
								</thead>
									<?php
									$sumPayable=0;
									$sumPaid=0;
									while($dataAssessment = dbarray($checkAssessment)){
									?>
									<tr>
										<td><?php echo $dataAssessment['bill_category'];?></td>
										<td><?php echo $dataAssessment['bill_desc'];?></td>
										<td><?php echo $dataAssessment['ass_amount'];?></td>
										<td><?php echo ($dataAssessment['ass_invoice_no']==0?"":$dataAssessment['ass_invoice_no']);?></td>
										<td><?php echo substr($dataAssessment['ass_remarks'],0,20);?>...<a href="#" title="Remarks" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="<?php echo $dataAssessment['ass_remarks'];?>"><span class="glyphicon glyphicon-zoom-in"></a></td>
										<td><a <?php echo ($dataAssessment['ass_invoice_no']==0?"":"disabled");?> href="studStatementWaive.frm.php?stud_no=<?php echo $_GET['showProfile']; ?>&ass_no=<?php echo $dataAssessment['ass_no'];?>" title="Waive Fee" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-gift"></span></a>
											<a <?php echo ($dataAssessment['ass_invoice_no']==1?"":"disabled");?> <?php echo ($_SESSION["user_role"]==1?"":"disabled");?> href="studStatementWaive.frm.php?cancelwaive=yes&ass_no=<?php echo $dataAssessment['ass_no'];?>" onClick="return confirm('Are you sure you want to cancel the waiving of fees?')" title="Cancel Waiving of Fee" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-alert"></span></a>
										</td>
						
										
									</tr>
									<?php 
									$sumPayable=$sumPayable+$dataAssessment['ass_amount'];
									$sumPaid=$sumPaid + ($dataAssessment['ass_invoice_no']==0?0:$dataAssessment['ass_amount']);
									} ?>
									<tr>
										<td colspan="2" align="right"><b>Total Payables / Payments </b></td>
										<td><b><?php echo $sumPayable;?></b></td>
										<td colspan="3"><b><?php echo $sumPaid;?></b></td>
									</tr>
								<tbody> 
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="<?php echo ($_GET['tab']=="ledger"?"tab-pane active":"tab-pane");?>" id="ledger">
<div class="row-fluid">
				<div class="span12"><br>
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="btn-toolbar  pull-right">
							<div class="btn-group">
								<?php
									$checkAssessment = dbquery("SELECT * FROM bill_receipt WHERE (receipt_stud_no='".$_GET['showProfile']."') ORDER BY receipt_sy DESC, receipt_datetime DESC limit 50");
									$rowsAssessment = dbrows($checkAssessment);
									?>
																	
							</div>
							</div>
							
							Ledger / SY <?php echo $current_sy;?>-<?php echo $current_sy+1;?> / <?php echo ($current_sem==1?"First":"Second")?> Semester</div>
						<div class="table-responsive">
							<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
								<thead>
									<tr>
										<th width="3%">#</th>
										<th width="18%">Receipt #</th>
										<th>Amount Paid</th>
										<th>School Year</th>
										<th width="17%">Date/Time Issued</th>
										<th width="27%">Issuer</th>
										<th width="10%"></th>

										
										
									</tr>
								</thead>
								<tbody> 
									<?php
									$i=1;
									while($dataAssessment = dbarray($checkAssessment)){
									?>
									<tr>
										<td><?php echo $i;?></td>
										<td><?php echo $dataAssessment['receipt_no'];?> <a href="receiptContents.php?stud_no=<?php echo $_GET['showProfile']; ?>&receipt_no=<?php echo $dataAssessment['receipt_no'];?>" title="Details" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false"><i class="glyphicon glyphicon-th-list"></i></a> <a href="" title="Print Receipt" onclick="window.open('studStatementReceipt.php?&receipt_no=<?php echo $dataAssessment['receipt_no'];?>', 'newwindow', 'width=850, height=600'); return false;"> <i class="glyphicon glyphicon-print"></i></a></td>
										<td><?php echo $dataAssessment['receipt_amtPaid'];?><?php echo ($dataAssessment['receipt_active']==0?" (voided)":"");?></td>
										<td><?php echo $dataAssessment['receipt_sy'];?></td>
										<td><?php echo $dataAssessment['receipt_datetime'];?></td>
										<td>
											<?php 
											$checkUser = dbquery("SELECT * FROM users WHERE user_no='".$dataAssessment['receipt_user']."'");
											$dataUser = dbarray($checkUser);
											echo $dataUser['user_fullname'];
											?>
										</td>	
										<td><a <?php echo ($_SESSION["user_role"]==1?"":"disabled");?> <?php echo ($dataAssessment['receipt_active']==0?"disabled":"");?> href="studStatementWaive.frm.php?stud_no=<?php echo $_GET['showProfile']; ?>&cancelreceipt=yes&receipt_no=<?php echo $dataAssessment['receipt_no'];?>" onClick="return confirm('Are you sure you want to void this receipt?')" title="Void Receipt" class="btn  btn-xs  btn-default">
														<span class="glyphicon glyphicon-remove"></span></a></td>
									</tr>
									<?php 
									$i++; } ?>
								
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