<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<video id="preview"></video>
<form action="" method="POST" id="myForm">
	<input type="hidden" name="id" id="isi">
</form>
</body>
<script type="text/javascript">
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false });
	    Instascan.Camera.getCameras().then(function (cameras) {
	        if (cameras.length > 0) {
	            scanner.start(cameras[1]);
	        } else {
	            console.error('No cameras found.');
	        }

	        if (cameras.length = 1) {
	            scanner.start(cameras[0]);
	        } else {
	            console.error('No cameras found.');
	        }
	    }).catch(function (e) {
	        console.error(e);
	    });
			scanner.addListener('scan', function (content) {
	    window.oninput = document.getElementById("isi");
	    var result = document.getElementById("isi");
	    result.value = content;
	    document.getElementById("myForm").submit();
    });
</script>
</html>