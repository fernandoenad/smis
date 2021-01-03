
<!DOCTYPE html>
<html>
<head>
	<title>ID Capturing System</title>

	<script src="scripts/jquery.min.js"></script>
	<style>
		#camera_wrapper, #show_saved_img{align:center; width: 350px;}
	</style>
	<script language="javascript">
        function Close() {
            opener.Reload();
            self.close();
        }
    </script>
	<script type="text/javascript" src="scripts/webcam.js"></script>
	<script>
		$(function(){
			var stud = <?php echo $_GET['showProfile']; ?>
			//give the php file path
			webcam.set_api_url( 'saveimage2.php?stud_no='+stud);
			webcam.set_swf_url( 'scripts/webcam.swf' );//flash file (SWF) file path
			webcam.set_quality( 100 ); // Image quality (1 - 100)
			webcam.set_shutter_sound( true ); // play shutter click sound
			
			var camera = $('#camera');
			camera.html(webcam.get_html(210, 210)); //generate and put the flash embed code on page
			
			$('#capture_btn').click(function(){
				//take snap
				webcam.snap();
				$('#show_saved_img').html('<h3>Please Wait...</h3>');
			});
			

			//after taking snap call show image
			webcam.set_hook( 'onComplete', function(img){
				$('#show_saved_img').html('<img src="' + img + '">');
				//reset camera for the next shot
				webcam.reset();
			});
			
		});
	</script>
</head>
<body onunload="window.opener.reload();">
	<!-- camera screen -->
	<center>
	<div id="camera_wrapper">
	<div id="camera"></div>
	<br />
	
	<button id="capture_btn">Capture</button>
	<a href="javascript:Close()"><button id="capture_btn">Close</button></a>
	</div>
	</center>
</body>
</html>