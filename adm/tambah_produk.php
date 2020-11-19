<?php

if (!isset($_SESSION["login_adm"])) {
	echo "<script>
					alert('Login Dulu');
					document.location.href='login.php';
				</script>";
				return false;
}

if (isset($_POST["add_produk"])) {
	if (add_produk($_POST) > 0) {
		echo "<script>
						alert('Sukses');
					</script>";
	} else {
		echo "<script>
						alert('Gagal');
					</script>";
					return false;
	}
}

?>

<h1>Tambah Produk</h1>
<form action="" method="POST" enctype="multipart/form-data">
	<label>
		Nama Produk
		<input type="text" name="nama" class="form-control mt05 mb">
	</label>
	<div class="form-group mb">
		<label class="mr">
			Merk Produk
			<input type="text" name="merk" class="form-control mt05 mb">
		</label>
		<label>
			Harga Produk
			<input type="number" name="harga" class="form-control mt05">
		</label>
	</div>
	<div class="form-group mb">
		<label class="mr">
			Kuantitas Produk
			<input type="number" name="qty" class="form-control mt05">
		</label>
		<label>
			Kategori Produk
			<select name="kategori" class="form-control mt05">
				<option value="all">Tidak Diberi Kategori</option>
				<?php

				$queryKat = mysqli_query($conn, "SELECT * FROM tbl_kategori ORDER BY id_kategori DESC");
				while ($rowKat = mysqli_fetch_assoc($queryKat)) {
				?>
				<option value="<?= $rowKat["id_kategori"] ?>"><?= $rowKat["kategori"] ?></option>
			<?php } ?>
			</select>
		</label>
	</div>
	<label>
		Deskripsi
		<textarea name="deskripsi" class="form-control mt05 mb"></textarea>
	</label>
	<label>
		Foto Produk
		<input type="file" name="gambar" class="form-control mt05 mb">
	</label>
	<button class="btn" type="submit" name="add_produk">Upload Produk</button>
</form>