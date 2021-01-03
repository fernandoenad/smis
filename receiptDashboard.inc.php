<?php
if(isset($_POST['receiptSearch'])) {
	$receiptSearch = trim($_POST['receiptSearch']);
}
elseif(isset($_GET['receiptSearch'])) {
	$receiptSearch = trim($_GET['receiptSearch']);
}
else{
	$receiptSearch = " ";
}

?>
		<div class="pagecontent container">
			<div class="row row-toolbar">
				<div class="col-lg-3 col-md-3 col-lg-push-9 col-md-push-9">
					<div class="btn-group pull-right" style="margin-top: 5px;">
						<form class="navbar-form navbar-right" method="post" action="./?page=receiptSearch">
							<div class="input-group">
								<input type="text" name="receiptSearch" class="form-control" placeholder="Search Receipt..." value="<?php echo (isset($_POST['receiptSearch'])?$_POST['receiptSearch']:""); ?>" autofocus>
								<div class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="page-header" style="margin-top: 20px">
				<h1>Receipts</h1>
			</div> 
			<div  class="tabbable"><br>
	<ul class="nav nav-tabs">
		<li><a href="#view_ledger" data-toggle="tab">Ledger</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="view_ledger">
			<div class="row-fluid">
				<div class="span12"><br>
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="btn-toolbar  pull-right">
							<div class="btn-group">
								<?php
									$checkAssessment = dbquery("SELECT * FROM bill_receipt WHERE (receipt_no='".$receiptSearch."') ORDER BY receipt_datetime DESC");
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
										<td><?php echo $dataAssessment['receipt_no'];?> <a href="receiptContents.php?stud_no=<?php echo $_GET['showProfile']; ?>&receipt_no=<?php echo $dataAssessment['receipt_no'];?>" title="Details" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false"><i class="glyphicon glyphicon-th-list"></a></td>
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
										<td><a title="Transact" <?php echo ($_SESSION["user_role"]==0?"disabled":"");?> class="btn btn-success btn-xs" href="./?page=financials&showProfile=<?php echo $dataAssessment['receipt_stud_no'];  ?>&tab=ledger">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
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