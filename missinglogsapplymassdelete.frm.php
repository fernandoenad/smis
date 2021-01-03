<?php
require ("maincore.php");
$teacherDetails = dbquery("select * from missinglogs inner join teacher on ml_userid=teach_bio_no where ml_approve_user_no='0' order by ml_userid desc, ml_checkdate asc, ml_checktime asc limit 50");
?>
<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Mass Deletion Panel</h4>
    </div>
	<form method="post" action="missinglogs.scr.php?MassDelete=Yes">
	<div class="modal-body">
		<div class="card-body">	
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<table class="table-hover" width="100%" border="1" cellspacing="0" cellpadding="1">
							<tr>
								<th width="25%" align="center">Filer</th>
								<th width="10%" align="center">Date</th>
								<th width="10%" align="center">Time Stamp</th>
								<th width="10%" align="center">State</th>								
								<th width="30%" align="center">Reason</th>
								<th width="15%" align="center">Delete?</th>
							</tr>	
						<?php
						while ($dataTeacherDetails = dbarray($teacherDetails)){						
						?>
							<tr>
								<td><?php echo strtoupper($dataTeacherDetails['teach_lname'].", ".$dataTeacherDetails['teach_fname']." ".$dataTeacherDetails['teach_xname']." ".substr($dataTeacherDetails['teach_mname'],0,1));?></td>
								<td><?php echo $dataTeacherDetails['ml_checkdate'];?></td>
								<td><?php echo $dataTeacherDetails['ml_checktime'];?></td>
								<td><?php echo ($dataTeacherDetails['ml_checktype']=="O"?"Out":"In");?></td>
								<td><?php echo $dataTeacherDetails['ml_reason'];?></td>
								<td align="center"><input type="checkbox" name="approve[]" value="<?php echo $dataTeacherDetails['ml_no'];?>"></td>
							</tr>
						<?php
						}
						?>
						</table>
					</div>
				</div>
			</div>		
		</div>
     </div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary" onClick="return confirm('Are you sure you want to save changes?')">Save</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	</form>
</div>