<?php

if (!isset($_SESSION["login_adm"])) {
	echo "<script>
					alert('Login Dulu');
					document.location.href='login.php';
				</script>";
				return false;
}

if (isset($_POST["topup"])) {
	if (topup($_POST) > 0) {
		echo "<script>
						alert('Sukses');
					</script>";
	} else {
		echo "<script>
						alert('Gagal');
					</script>";
	}
}

?>

<h1>Top Up Kredit Member</h1>
<form action="" method="POST" enctype="multipart/form-data">
	<label>
		Username Member
		<input type="text" name="username" class="form-control mt05 mb">
	</label>
	<div class="form-group mb">
		<label class="mr">
			No. Telp
			<input type="number" name="notel" class="form-control mt05 mb">
		</label>
		<label>
			No. Rek
			<input type="number" name="norek" class="form-control mt05">
		</label>
	</div>
	<div class="form-group mb">
		<label class="mr">
			Nominal TopUp
			<select name="nominal" class="form-control mt05">
				<option value="20000">Rp. 20.000,-</option>
				<option value="50000">Rp. 50.000,-</option>
				<option value="100000">Rp. 100.000,-</option>
				<option value="200000">Rp. 200.000,-</option>
				<option value="500000">Rp. 500.000,-</option>
				<option value="1000000">Rp. 1.000.000,-</option>
				<option value="10000000">Rp. 10.000.000,-</option>
			</select>
		</label>
	</div>
	<button class="btn" type="submit" name="topup">TopUp</button>
</form>