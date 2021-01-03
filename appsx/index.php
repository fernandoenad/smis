<!DOCTYPE html>
<html>
	<head>
		<title>SANHS Image Capture System</title>
		<script language="JavaScript" src="jquery.min.js"></script>
		<script language="JavaScript" src="swfobject.js"></script>
		<script language="JavaScript" src="scriptcam.js"></script>
		<script language="JavaScript"> 
			$(document).ready(function() {
				$("#webcam").scriptcam({
					showMicrophoneErrors:false,
					onError:onError,
					cornerRadius:20,
					cornerColor:'e3e5e2',
					onWebcamReady:onWebcamReady,
					uploadImage:'upload.gif',
					onPictureAsBase64:base64_tofield_and_image
				});
			});
			function base64_tofield() {
				$('#formfield').val($.scriptcam.getFrameAsBase64());
			};
			function base64_toimage() {
				$('#image').attr("src","data:image/png;base64,"+$.scriptcam.getFrameAsBase64());
			};
			function base64_tofield_and_image(b64) {
				$('#formfield').val(b64);
				$('#image').attr("src","data:image/png;base64,"+b64);
			};
			function changeCamera() {
				$.scriptcam.changeCamera($('#cameraNames').val());
			}
			function onError(errorId,errorMsg) {
				$( "#btn1" ).attr( "disabled", true );
				$( "#btn2" ).attr( "disabled", true );
				alert(errorMsg);
			}			
			function onWebcamReady(cameraNames,camera,microphoneNames,microphone,volume) {
				$.each(cameraNames, function(index, text) {
					$('#cameraNames').append( $('<option></option>').val(index).html(text) )
				}); 
				$('#cameraNames').val(camera);
			}
		</script> 
	</head>
	<body>
		<div style="width:330px;float:left;">
			<div id="webcam">
			</div>
			<div style="margin:5px;">
				<img src="webcamlogo.png" style="vertical-align:text-top"/>
				<select id="cameraNames" size="1" onChange="changeCamera()" style="width:245px;font-size:10px;height:25px;">
				</select>
				<p align="center"><button class="btn btn-small" id="btn2" onclick="base64_toimage()">Snapshot to image</button></p>

			</div>
		</div>
		<div style="width:200px;float:left;">
			<p><img id="image" style="width:200px;height:153px;"/></p>
			<p align="center"><?php echo "For student id: ".$_GET['stud_no'];?></p>
			<p align="center"><button type="button" onclick="window.open('', '_self', ''); window.close();">Close</button></p>
		</div>
		
	</body>
</html>
