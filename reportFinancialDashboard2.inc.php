		<div class="pagecontent container">
			<div class="row row-toolbar">
			<div class="col-lg-6">
			<h3>Transaction Report Summary</h3>
			</div>
			
			<div class="col-lg-3 col-md-3 col-lg-push-3 col-md-push-3">
					<div class="btn-group pull-right" style="margin-top: 5px;">
					<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
						SY <?php echo $_GET['enrol_sy'];?> - <?php echo $_GET['enrol_sy']+1;?> <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
							<li role="presentation" class="dropdown-header">Select School Year</li>
							<?php 
							$checkSY = dbquery("select * from bill_receipt group by receipt_sy order by receipt_sy desc");
							while($dataSY = dbarray($checkSY)){
							?>
							<li><a href="?page=reportsSum&enrol_sy=<?php echo $dataSY['receipt_sy'];?>"><?php echo $dataSY['receipt_sy'];?> - <?php echo $dataSY['receipt_sy']+1;?></a></li>
							<?php
							}
							?>
						</ul>
					</div>
				</div>
				
			</div>
			<div  class="tabbable"><br>
	<ul class="nav nav-tabs">
		<li class="active"><a href="#view_accounts" data-toggle="tab">Today's Report</a></li>
		<li ><a href="#view_ledger" data-toggle="tab">Summary of Collection</a></li>
		<li ><a href="#view_reports" data-toggle="tab">Report Generator</a></li>
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
									$today = date("Ymd");
									$checkAssessment = dbquery("SELECT *, SUM(receipt_amtPaid) as paidAMount FROM bill_receipt WHERE (DATE(`receipt_datetime`) BETWEEN '".$today."' AND '".$today."') GROUP BY receipt_user ORDER BY receipt_datetime DESC");
									$rowsAssessment = dbrows($checkAssessment);
									?>
								<a href="" class="btn  btn-xs  btn-default" onclick="window.open('reportSummary2.php?date=<?php echo $today;?>', 'newwindow', 'width=850, height=600'); return false;" Title="Today's Summary"><span class="glyphicon glyphicon-print"></span></a>	
									
							</div>
							</div>
							
							Today's Transaction Report Summary / SY <?php echo $current_sy;?>-<?php echo $current_sy+1;?> / <?php echo ($current_sem==1?"First":"Second")?> Semester</div>
						<div class="table-responsive">
							<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
								<thead>
									<tr>
										<th width="3%">#</th>
										<th>Total Collections</th>
										<th width="60%">Issuer</th>
										<th width="20%"></th>

										
										
									</tr>
								</thead>
								<tbody> 
									<?php
									$i=1;
									while($dataAssessment = dbarray($checkAssessment)){
									?>
									<tr>
										<td><?php echo $i;?></td>
										<td align="right"><?php echo number_format($dataAssessment['paidAMount'],2);?></td>
										<td>
											<?php 
											$checkUser = dbquery("SELECT * FROM users WHERE user_no='".$dataAssessment['receipt_user']."'");
											$dataUser = dbarray($checkUser);
											echo $dataUser['user_fullname'];
											?>
										</td>	
										<td><a href="" class="btn  btn-xs  btn-default" onclick="window.open('reportSummary.php?user_no=<?php echo $dataUser['user_no']; ?>&date=<?php echo $today;?>','newwindow', 'width=850, height=600'); return false;" title="Details"><i class="glyphicon glyphicon-print"></a></td>
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
		<div class="tab-pane" id="view_balances">
			<h1>Coming soon...</h1>
		</div>
		<div class="tab-pane" id="view_ledger">
<div class="row-fluid">
				<div class="span12"><br>
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="btn-toolbar  pull-right">
							<div class="btn-group">
								<?php
									$checkAssessment = dbquery("SELECT DATE(`receipt_datetime`) AS dateTrans , SUM(receipt_amtPaid) AS paidAmount FROM bill_receipt GROUP BY DATE(`receipt_datetime`) ORDER BY dateTrans DESC");
									$rowsAssessment = dbrows($checkAssessment);
									?>
								<a href="" class="btn  btn-xs  btn-default" disabled onclick="window.open('reportSummary3.php?date=<?php echo $today;?>&enrol_sy=<?php echo $_GET['enrol_sy'];?>', 'newwindow', 'width=850, height=600'); return false;" Title="Today's Summary"><span class="glyphicon glyphicon-print"></span></a>	

							</div>
							</div>
							
							Summary of Collection / SY <?php echo $current_sy;?>-<?php echo $current_sy+1;?> / <?php echo ($current_sem==1?"First":"Second")?> Semester</div>
						<div class="table-responsive">
							<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
								<thead>
									<tr>
										<th width="3%">#</th>
										<th width="60%">Date</th>
										<th>Total Collection</th>
										<th width="20%"></th>
							
									</tr>
								</thead>
								<tbody> 
									<?php
									$i=1;
									while($dataAssessment = dbarray($checkAssessment)){
									?>
									<tr>
										<td><?php echo $i;?></td>
										<td><?php  
										$phpdate = strtotime($dataAssessment['dateTrans']);
										echo $mysqldate = date('F d, Y', $phpdate);
										$mysqldate = date('Ymd', $phpdate);
										?></td>
										<td align="right"><?php echo number_format($dataAssessment['paidAmount'],2);?></td>
										<td><a href="" class="btn  btn-xs  btn-default" onclick="window.open('reportSummary2.php?date=<?php echo $mysqldate;?>', 'newwindow', 'width=850, height=600'); return false;" Title="Today's Summary"><span class="glyphicon glyphicon-print"></span></a></td>
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
		<div class="tab-pane" id="view_reports">
			<div class="row-fluid">
				<div class="span12"><br>
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="btn-toolbar  pull-right">
							<div class="btn-group">

								<?php
									$checkAssessment = dbquery("SELECT SUM( ass_amount ) AS sumPay,  `bill_no` ,  `bill_category` ,  `bill_desc`  FROM bill_bills INNER JOIN bill_assessment ON bill_no=ass_bill_no INNER JOIN bill_receipt ON ass_invoice_no=receipt_no WHERE (bill_sy='".$_GET['enrol_sy']."' and receipt_sy='".$_GET['enrol_sy']."') GROUP BY bill_desc ORDER BY bill_prio ASC");
									$rowsAssessment = dbrows($checkAssessment);
									?>
								
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
										<td align="right"><?php echo number_format($dataAssessment['sumPay'],2);?></td>	
										<td>
											<a href="" class="btn  btn-xs  btn-default" onclick="window.open('reportSummary6.php?bill_no=<?php echo $dataAssessment['bill_no'];?>&enrol_sy=<?php echo $_GET['enrol_sy'];?>', 'newwindow', 'width=850, height=600'); return false;" Title="Today's Summary"><span class="glyphicon glyphicon-print"></span></a>
												<?php
													$checkBill = dbquery("SELECT * FROM bill_assessment WHERE ass_bill_no='".$dataAssessment['bill_no']."'");
													$countBill = dbrows($checkBill);
												?>
										</td>								
									</tr>
									<?php 
									$i++; 
									$sum=$sum+ $dataAssessment['sumPay']; } ?>
									<tr>
										<td colspan="3" align="right"><b>TOTAL</td>
										<td align="right"><b><?php echo number_format($sum,2);?></td>
										<td width="20%"></td>
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