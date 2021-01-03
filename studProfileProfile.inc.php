<div class="row-fluid">
	<div class="span12"><br>
		<div class="panel panel-default">
			<div class="panel-heading">
			    <div class="btn-toolbar  pull-right">
					<a <?php echo($_SESSION["user_role"]==2?"disabled":"");?> <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  href="./?page=student&updateProfile=<?php echo $data['stud_no'];?>" title="Update" class="btn  btn-xs  btn-default">
						<span class="glyphicon glyphicon-pencil"></span></a>
				</div>
				Personal Details
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
					<thead>
						<tr>
							<th width="20%">Fields</th>
							<th>Details</th>
						</tr>
					</thead>
					<tbody> 
						<tr>
							<td>Student #</td>
							<td><?php echo $data['stud_no'];?></td>
						</tr>														
						<tr>
							<td>LRN</td>
							<td><?php echo strtoupper($data['stud_lrn']);?></td>
						</tr>
						<tr>
							<td>Last name</td>
							<td><?php echo strtoupper($data['stud_lname']);?></td>
						</tr>
						<tr>
							<td>First name</td>
							<td><?php echo strtoupper($data['stud_fname']);?></td>
						</tr>
						<tr>
							<td>Middle name</td>
							<td><?php echo strtoupper($data['stud_mname']);?></td>
						</tr>
						<tr>
							<td>Ext. name</td>
							<td><?php echo $data['stud_xname'];?></td>
						</tr>
						<tr>
							<td>Gender</td>
							<td><?php echo $data['stud_gender'];?></td>
						</tr>
						<tr>
							<td>Birth date</td>
							<td>
							<?php 
							$phpdate = strtotime($data['stud_bdate']);
							echo $mysqldate = date('F d, Y', $phpdate);
							$date1 = strtotime(date("Y-m-d"));
							$date2 = strtotime($data['stud_bdate']);
							$time_difference = $date1 - $date2;
							$seconds_per_year = 60*60*24*365;
							$years = (int) ($time_difference / $seconds_per_year);
							echo " <small>($years years old)</small>";
						?>													
							</td>
						</tr>
						<tr>
							<td>Current residence</td>
							<td><?php echo $data['stud_residence'];?></td>
						</tr>
						<tr>
							<td>Religion</td>
							<td><?php echo $data['stud_religion'];?></td>
						</tr>
						<tr>
							<td>Mother tongue / dialect</td>
							<td><?php echo $data['stud_dialect'];?></td>
						</tr>
						<tr>
							<td>Ethnicity</td>
							<td><?php echo $data['stud_ethnicity'];?></td>
						</tr>														
						</tbody>
				</table>
			</div>
		</div>														
		<div class="panel panel-default">
			<div class="panel-heading">
			    <div class="btn-toolbar  pull-right">
					<a <?php echo($_SESSION["user_role"]==2?"disabled":"");?> <?php echo ($_SESSION["user_role"]==0?"disabled":"");?>  href="./?page=student&updateProfile=<?php echo $data['stud_no'];?>" title="Update" class="btn  btn-xs  btn-default">
						<span class="glyphicon glyphicon-pencil"></span></a>
				</div>
				Contact Information
			</div>
			<?php
				$contact = dbquery("SELECT * FROM studcontacts INNER JOIN student ON studcontacts.studCont_stud_no=student.stud_no WHERE studcontacts.studCont_stud_no='".$data['stud_no']."'");
				$rowsContact = dbrows($contact);
				$dataContact = dbarray($contact);
			?>
			<div class="table-responsive">
				<table class="table table-bordered table-condensed table-striped table-sticky" style="margin-bottom:20px !important">
					<thead>
							<th width="20%">Fields</th>
							<th>Details</th>													
					</thead>
					<tbody> 
						<tr>
							<td>Mother's maiden name</td>
							<td><?php echo strtoupper($dataContact['studCont_stud_mfname'])." ".strtoupper($dataContact['studCont_stud_mmname'])." ".strtoupper($dataContact['studCont_stud_mlname']); ?></td>
						</tr>	
						<tr>
							<td>Father's name</td>
							<td><?php echo strtoupper($dataContact['studCont_stud_ffname'])." ".strtoupper($dataContact['studCont_stud_fmname'])." ".strtoupper($dataContact['studCont_stud_flname']); ?></td>
						</tr>	
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>	
						<tr>
							<td>Guardian's name</td>
							<td><?php echo strtoupper($dataContact['studCont_stud_gfname'])." ".strtoupper($dataContact['studCont_stud_gmname'])." ".strtoupper($dataContact['studCont_stud_glname'])." (".strtoupper($dataContact['studCont_stud_grelation']).")"; ?></td>
						</tr>	
						<tr>
							<td>Guardian's contact number</td>
							<td><?php echo $dataContact['studCont_stud_gcontact']; ?></td>
						</tr>	
						</tbody>
				</table>
			</div>
		</div>
		<tr>	
		<?php
		$resultUser = dbquery("select * from users where user_no='".$dataContact['stud_create_user_id']."'");
		$dataUser = dbarray($resultUser);
		?>
		<td colspan="9">
		<i>Created by <strong><small><?php echo $dataUser['user_fullname'] ;?> </strong></small> on <strong><small><?php echo date('F d, Y g:ia', strtotime($dataContact['stud_creaatedatetime']) + 8.0 * 3600);?></strong></small>	
		<?php
		$resultUser = dbquery("select * from users where user_no='".$dataContact['stud_lastmod_user_id']."'");
		$dataUser = dbarray($resultUser);
		?>
		</strong></small><br>
		Last modified by <strong><small><?php echo $dataUser['user_fullname']; ?></strong></small> on <strong><small><?php echo date('F d, Y g:ia', strtotime($dataContact['stud_lastmoddatetime']) + 8.0 * 3600);?></strong></small></i></td>
		</tr>
		
	</div>
</div>