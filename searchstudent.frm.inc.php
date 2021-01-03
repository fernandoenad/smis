									<form name="search_stud" class="form-vertical" method="post" action="?page=student&action=searchstudent">
										<table>
											<tr>
												<td>LRN:</td>
												<td><input type="text" name="search_lrn" style="width: 190px;" value="<?php echo (isset($_POST['search_lrn'])?$_POST['search_lrn']:''); ?>"></td>
											</tr>
											<tr>
												<td>Lastname:</td>
												<td><input type="text" name="search_lname" style="width: 190px;" value="<?php echo (isset($_POST['search_lname'])?$_POST['search_lname']:''); ?>" ></td>
											</tr>
											<tr>
												<td>Firstname:</td>
												<td><input type="text" name="search_fname" style="width: 190px;" value="<?php echo (isset($_POST['search_fname'])?$_POST['search_fname']:''); ?>"></td>
											</tr>
											<tr>
												<td></td>
												<td><button type="submit" class="btn btn-primary">Search</button>
													<div class="btn-group btn-group-lg" >
														  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
														  Tools <span class="caret"></span></button>
														  <ul class="dropdown-menu" role="menu">
															<li><a href="./?page=student">Student Dashboard</a></li>
															<li><a href="./?page=student&action=newstudent">New Student</a></li>
														  </ul>
													</div>
												</td>
											</tr>
										</table>
									</form>