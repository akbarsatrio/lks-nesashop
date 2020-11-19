<?php

if (isset($_POST["recover"])) {
	if (recover($_POST) > 0) {
		echo "<script>
						alert('AKun berhasil dikemalikan! silahkan login');
						document.location.href='?page=login';
					</script>";
	} else {
		echo "<script>
						alert('Oops,Gagal Dkembalikan');
						document.location.href='?page=recover';
					</script>";
					return false;
	}
}

?>
<style type="text/css">
	body {
		background-color: #4dabff;
	}
</style>
<div id="wrapper-register">
	<h1>Recovery Password</h1>
	<form action="" method="POST" enctype="multipart/form-data">
		<label>
			Email
			<input type="email" name="email" autocomplete="off" required="" class="form-control mt05">
		</label>
		<div class="form-group mt mb">
			<label class="mr">
				No. Telepon
				<input type="number" name="notel" autocomplete="off" required="" class="form-control mt05">
			</label>
			<label>
				No. Rekening
				<input type="number" name="norek" autocomplete="off" required="" class="form-control mt05">
			</label>
		</div>
		<div class="form-group mt mb">
			<label class="mr">
				Password
				<input type="password" name="password" autocomplete="off" required="" class="form-control mt05">
			</label>
			<label>
				Konfirmasi
				<input type="password" name="password2" autocomplete="off" required="" class="form-control mt05">
			</label>
		</div>
		<button class="btn mt" name="recover" type="submit" style="width: 100%;">Kembalikan Akun Saya</button>
		<br>
		<br>
		<center>
		<small>Sudah Punya Akun? <a href="?page=register">Daftar</a><br><a href="?page=recover">Lupa Password</a></small>
		</center>
	</form>
</div>