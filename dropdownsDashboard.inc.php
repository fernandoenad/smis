<?php
if(isset($_GET['delete']) && $_GET['delete']=="yes"){
	$queryDel = dbquery("delete from dropdowns where field_no='".$_GET['field_no']."'");
}
else if(isset($_GET['edit']) && $_GET['edit']=="yes"){
	$queryEdit = dbquery("");
}
else if(isset($_GET['add']) && $_GET['add']=="yes"){
	$queryAdd = dbquery("");
}
?>

	<div class="pagecontent container">
	<div class="row row-toolbar">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-push-8 col-md-push-8 col-sm-push-8 col-xs-push-8 clearfix"></div>

			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-pull-4 col-md-pull-4 col-sm-pull-4 col-xs-pull-4">
                <select  class="form-control" id="ui-classes" style="margin-top: 5px" onchange="if (this.value) window.location.href=this.value">
					<?php
					$checkDropdowns = dbquery("select * from dropdowns GROUP BY field_category order by field_category asc");
					while($dataDropdowns = dbarray($checkDropdowns)){
					?>
					<option value=".?page=dropdowns&category=<?php echo $dataDropdowns['field_category'];?>" <?php echo ($dataDropdowns['field_category']==$_GET['category']?"selected":"");?> <?php echo ($dataDropdowns['field_category']=="RESIDENCE" || $dataDropdowns['field_category']=="TIMELSLOTS"?"":"disabled");?> ><?php echo $dataDropdowns['field_category'];?></option>
					<?php
					}
					?>
                </select>

          </div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">Current Dropdown List Items
			<div class="btn-toolbar  pull-right">
						<div class="btn-group">
							<a  title="Add Item List" class="btn  btn-xs  btn-default" href="dropdownsAdd.frm.php?category=<?php echo $_GET['category'];?>&add=yes" title="Modify Dropdown Item" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
								<span class="glyphicon glyphicon-plus"></span></a>

						</div>
                    </div>
			
			
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table-condensed table-striped table-sticky">
					<thead>
						<tr>
							<th width="3%">#</th>
							<th width="15%">Category</th>
							<th width="45%">Field Name</th>
							<th>Extension</th>
							<th width="10%"></th>
						</tr>
					</thead>
					<tbody>
					<?php
					$i=1;	
					$checkDropdowns = dbquery("select * from dropdowns where field_category='".$_GET['category']."' order by field_name asc");
					while($dataDropdowns = dbarray($checkDropdowns)){
					?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $dataDropdowns['field_category'];?></td>
							<td><?php echo $dataDropdowns['field_name'];?></td>
							<td><?php echo $dataDropdowns['field_ext'];?></td>
							<td>
								<a href="dropdownsEdit.frm.php?category=<?php echo $dataDropdowns['field_category'];?>&edit=yes&field_no=<?php echo $dataDropdowns['field_no'];?>" title="Modify Dropdown Item" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
									<span class="glyphicon glyphicon-pencil"></span></a>
								<a href="?page=dropdowns&category=<?php echo $dataDropdowns['field_category'];?>&delete=yes&field_no=<?php echo $dataDropdowns['field_no'];?>" title="Delete Dropdown Item" class="btn  btn-xs  btn-default" onclick="return confirm('Are you sure you want delete this entry?')">
									<span class="glyphicon glyphicon-remove"></span></a>
							</td>
						</tr>
					<?php
					$i++;
					}
					?>
					</tbody>
				</table>
			</div>
		</div>

	</div>	</div></div>

