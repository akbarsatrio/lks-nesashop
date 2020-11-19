<?php

include 'functions.php';

if (isset($_POST["reg_adm"])) {
	if (reg_adm($_POST) > 0) {
		echo "<script>
						alert('Sukses');
					</script>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Reg adm emp</title>
</head>
<body>
<div class="wrapper">
	<form action="" method="POST">
		<input type="text" name="username" onkeypress="return hanyaHuruf(event)">
		<input type="password" name="password">
		<input type="password" name="code">
		<button type="submit" name="reg_adm">Reg</button>
	</form>
</div>
</body>
<script type="text/javascript">
	function hanyaHuruf(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && (charCode < 44 || charCode > 46) && (charCode > 39) && charCode > 32)
			return false;
		return true;
	}
</script>
</html>