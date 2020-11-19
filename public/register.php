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
	<h1>Daftar Member</h1>
	<form action="" method="POST" enctype="multipart/form-data">
		<label>
			Nama
			<input type="text" name="nama" autocomplete="off" required="" class="form-control mt05" onkeypress="return hanyaHuruf(event)">
			<small>Hanya Bisa Menggunakan Huruf A-Z, a-z, (Titik), (Koma), dan (Kutip).</small>
		</label>
		<div class="form-group mt mb">
			<label class="mr">
				Username
				<input type="text" name="username" autocomplete="off" required="" class="form-control mt05">
			</label>
			<label>
				Email
				<input type="email" name="email" autocomplete="off" required="" class="form-control mt05">
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
		<label>
			Alamat
			<textarea class="form-control mt05" name="alamat"></textarea>
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
		<label>
			Foto Profil
			<input type="file" name="gambar" class="form-control mt05">
		</label>
		<button class="btn mt" name="reg_usr" type="submit" style="width: 100%;">Daftar</button>
	</form>
</div>

<script type="text/javascript">
	function hanyaHuruf(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && (charCode < 44 || charCode > 46) && (charCode > 39) && charCode > 32)
			return false;
		return true;
	}
</script>