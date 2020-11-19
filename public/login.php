<?php

if (isset($_POST["login_usr"])) {
	if (login_usr($_POST) > 0) {
		echo "<script>
						alert('Berhasil Login');
					</script>";
	} else {
		echo "<script>
						alert('Gagal Login');
					</script>";
					return false;
	}
}

?>

<?php

if (isset($_POST["reg_usr"])) {
	if (reg_usr($_POST) > 0) {
		echo "<script>
						alert('Berhasil Mendaftar! silahkan login');
						document.location.href='?page=login';
					</script>";
	} else {
		echo "<script>
						alert('Oops, gagal mendaftar');
						document.location.href='?page=register';
					</script>";
	}
}

?>
<style type="text/css">
	body {
		background-color: #4dabff;
	}
</style>
<div id="wrapper-register">
	<h1>Login Member</h1>
	<form action="" method="POST" enctype="multipart/form-data">
		<label>
			Email
			<input type="email" name="email" autocomplete="off" required="" class="form-control mt05 mb">
		</label>
		<label>
			Password
			<input type="password" name="password" autocomplete="off" required="" class="form-control mt05">
		</label>
		<button class="btn mt" name="login_usr" type="submit" style="width: 100%;">Login</button>
		<br>
		<br>
		<center>
		<small>Belum Punya Akun? <a href="?page=register">Daftar</a><br><a href="?page=recover">Lupa Password</a></small>
		</center>
	</form>
</div>