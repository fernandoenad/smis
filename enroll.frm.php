<div class="modal-content">
    <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Search Student to Enroll</h4>
    </div>
	<form method="post" action="./?page=student">
	<div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
						
							<div class="input-group">
								<input type="text" name="searchStudent" class="form-control" placeholder="Search Student..." value="<?php echo (isset($_POST['searchStudent'])?$_POST['searchStudent']:""); ?>" autofocus>
								<div class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
								</div>
							</div>

				</div>
			</div>
		</div>
     </div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary" >Lookup</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	</form>
</div>

