<?php

session_start();
include 'functions.php';

if (isset($_POST["login_adm"])) {
	if (login_adm($_POST) > 0) {
		echo "<script>
						alert('Sukses');
					</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Admin</title>
	<link rel="stylesheet" type="text/css" href="../lib/css/starter.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style type="text/css">
		body {
			background: #4dabff;
		}
	</style>
</head>
<body>
<div class="wrapper">
	<h1>Login Admin</h1>
	<form action="" method="POST">
		<label>
			Username
			<input type="text" name="username" class="form-control mt05">
		</label>
		<div class="form-group mt">
			<label class="mr">
				Password
				<input type="password" name="password" class="form-control mt05">
			</label>
			<label>
				Code
				<input type="password" name="code" class="form-control mt05">
			</label>
		</div>
		<button type="submit" name="login_adm" class="btn mt">Login</button>
	</form>
</div>
</body>
</html>