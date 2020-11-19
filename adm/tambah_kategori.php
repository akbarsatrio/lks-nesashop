<?php

if (!isset($_SESSION["login_adm"])) {
	echo "<script>
					alert('Login Dulu');
					document.location.href='login.php';
				</script>";
				return false;
}

if (isset($_POST["add_kategori"])) {
	if (add_kategori($_POST) > 0) {
		echo "<script>
							alert('Sukses');
						</script>";
	} else {
		echo "<script>
							alert('Gagal');
							document.location.href=?page=tambah_kategori'';
						</script>";
						return false;
		}
}

?>

<h1>Tambah Kategori</h1>
<form action="" method="POST">
	<label>
		Nama Kategori
		<input type="text" name="kategori" class="form-control mt05">
	</label>
	<button type="submit" name="add_kategori" class="btn mt">Tambahkan Kategori</button>
</form>