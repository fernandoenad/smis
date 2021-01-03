    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Residence</h4>
      </div>
	<form method="post" action="student.scr.php?saveResidence=Yes">
	<div class="modal-body">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="form-group">
						<label class="control-label required" for="stud_lrn">Residence <span title="Required" class="text-danger">*</span></label> (Barangay, Town, Province)
						<input type="text" id="residence" name="residence" required="required" class=" form-control" value="" style="text-transform:uppercase;" >
					</div>
				</div>
			</div>
		</div>
     </div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary" >Save</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	</form>
    </div>