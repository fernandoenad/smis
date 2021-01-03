	<div id="footer">
		<div class="container">
			<p class="text-muted" style="margin-top:20px"><small> Copyright &copy; 2016. <a href="">School Management Information System</a> by <a href="mailto:fernando.enad@deped.gov.ph">Fernando B. Enad</a> (San Agustin NHS - Sagbayan, Bohol).</small></p>
		</div>
	</div>


	<div id="modal-large" class="modal fade remote-modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">Loading content... Reload webpage if loading took more than a minute.</div>
			</div>
		</div>
	</div>

	<div id="modal-medium" class="modal fade remote-modal">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">Loading content... Reload webpage if loading took more than a minute.</div>
			</div>
		</div>
	</div>

	<div id="modal-small" class="modal fade remote-modal">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">Loading content... Reload webpage if loading took more than a minute.</div>
			</div>
		</div>
	</div>	
	




	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="./assets/js/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="./assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="./assets/js/require.js"></script>
	<script>
	$(document).ready(function(){
		$('[data-toggle="popover"]').popover(); 
	});
	</script>
	<script>
	$('#modal-large').on('hide.bs.modal', function() {
		$(this).removeData();
	  });
	</script>
	<script>
	$('#modal-medium').on('hide.bs.modal', function() {
		$(this).removeData();
	  });
	</script>
	<script>
	$('#modal-small').on('hide.bs.modal', function() {
		$(this).removeData();
	  });
	</script>
</body>
</html>