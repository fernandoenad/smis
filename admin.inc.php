<?php
if(isset($_POST['searchStudent'])) {
	$searchStudent = $_POST['searchStudent'];
}
elseif(isset($_GET['searchStudent'])) {
	$searchStudent = $_GET['searchStudent'];
}
else{
	$searchStudent = "";
}
	$result = dbquery("SELECT * FROM users WHERE (user_name LIKE '%".$searchStudent."%' OR user_fullname LIKE '%".$searchStudent."%')  ORDER BY user_role ASC, user_fullname ASC ");
	$rows = dbrows($result);


?>
		<div class="pagecontent container">
			<div class="row row-toolbar">
				<div class="col-lg-3 col-md-3 col-lg-push-9 col-md-push-9">
					<div class="btn-group pull-right" style="margin-top: 5px;">
						<form class="navbar-form navbar-right" method="post" action="./?page=admin">
							<div class="input-group">
								<input type="text" name="searchStudent" class="form-control" placeholder="Search User..." value="<?php echo (isset($_POST['searchStudent'])?$_POST['searchStudent']:""); ?>" autofocus>
								<div class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="page-header" style="margin-top: 20px">
				<h1>Administration</h1>
			</div>
	    <ol class="breadcrumb">
        <li><a href="./?page=admin">Administration</a></li>
    </ol>
	

			<div class="panel panel-default">

				<div class="panel-heading">User List
				    <div class="btn-toolbar  pull-right">
						<div class="btn-group">
                            <a href="adminNew.frm.php" title="Add User" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
								<span class="glyphicon glyphicon-plus">From Teachers</span></a>
								<a href="adminNew2.frm.php" title="Add User" class="btn  btn-xs  btn-default" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false">
								<span class="glyphicon glyphicon-plus">From Students</span></a>
						</div>
                    </div>
				
				</div>
				
				<div class="table-responsive">
					<table class="table table-bordered table-condensed table-striped table-sticky">
						<thead>
							<tr>
								<th width="3%">#</th>
								<th width="20%">Username</th>
								<th>Fullname</th>
								<th width="18%">Role</th>
								<th width="20%"></th>
							</tr>
						</thead>
						<tbody>
						<?php
						if (dbrows($result)) {
							$i=1;											
							while ($data = dbarray($result)) {
						?>
							<tr>
								<td class="text-right"><?php echo $i; ?></td>
								<td><?php echo $data['user_name']; ?></td>
								<td><?php echo strtoupper($data['user_fullname']); ?></td>
								<td>
									<?php 
									if($data['user_role']==1){
										echo "System Administrator";
									}
									elseif($data['user_role']==2){
										echo "Teacher";
									}
									else{
										echo "Staff";
									}
									
									?>
								</td>
								<td>
									<?php
									$checkTeacherStatus = dbquery("select * from teacher where teach_no='".$data['user_no']."'");
									$resultTeacherStatus = dbarray($checkTeacherStatus);
									$countTeacher = dbrows($checkTeacherStatus);
									$checkTeacherStatus1 = dbquery("select * from student where stud_no='".$data['user_no']."'");
									$resultTeacherStatus1 = dbarray($checkTeacherStatus1);
									
									?>
									<a <?php echo ($data['user_no']==1?"disabled=disabled":"");?> href="./userTools.scr.php?resetPass=Yes&user_no=<?php echo $data['user_no'];?>" title="Reset Password" class="btn  btn-xs  btn-default" onclick="return confirm('Are you sure you want to reset/reactivate the user\'s account and/or access?\nPassword will be reset to \'P@ssw0rd\'?')">
										<span class="glyphicon glyphicon-repeat"></span></a>
									<a <?php echo ($data['user_no']==1 || $data['user_no']==2?"disabled=disabled":"");?> href="adminUpdate.frm.php?UpdateUser=<?php echo $data['user_no'];?>" title="Modify User" data-toggle="modal" data-target="#modal-medium" data-backdrop="static" data-keyboard="false" class="btn  btn-xs  btn-default">
										<span class="glyphicon glyphicon-pencil"></span></a>
									<a <?php echo ($data['user_no']==1 || $data['user_no']==2 || $data['user_name']==$_SESSION["user_name"]?"disabled=disabled":"");?> <?php echo ($data['user_status']==1?"":"disabled");?>  href="./userTools.scr.php?deactivateUser=Yes&user_no=<?php echo $data['user_no'];?>" title="Deactivate User" class="btn  btn-xs  btn-default" onclick="return confirm('Are you sure you want to deactivate the user\'s account and/or access?')">
										<span class="glyphicon glyphicon-glyphicon glyphicon-scissors"></span></a>
									<?php
									if($countTeacher==0 && $data['user_no']!=1){
									?>
									<a <?php echo ($data['user_no']==1 || $data['user_name']==$_SESSION["user_name"]?"disabled=disabled":"");?> <?php echo ($data['user_status']==1?"":"disabled");?>  href="./userTools.scr.php?deleteUser=Yes&user_no=<?php echo $data['user_no'];?>" title="User was not found in the Teacher's List, please delete and click From Teachers button to manually add teachers as users. " class="btn  btn-xs  btn-default" onclick="return confirm('Are you sure you want to delete the user\'s account and/or access?')">
										<span class="glyphicon glyphicon-glyphicon glyphicon-remove"></span></a>
									<?php
									}
									?>
									</td>
							</tr>
						<?php
							$i++;
							}	
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>	
	</div>
	
	