<?php

if (!isset($_SESSION["login_adm"])) {
	echo "<script>
					alert('Login Dulu');
					document.location.href='login.php';
				</script>";
				return false;
}

if (isset($_POST["edit_produk"])) {
	if (edit_produk($_POST)) {
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

$id_produk = $_GET["id"];
$query = mysqli_query($conn, "SELECT * FROM tbl_produk WHERE id_produk = '$id_produk'");
$row = mysqli_fetch_assoc($query);

?>

<h1>Edit Produk</h1>
<form action="" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="id_produk" value="<?= $_GET["id"] ?>">
	<label>
		Nama Produk
		<input type="text" name="nama" class="form-control mt05 mb" value="<?= $row["nama"] ?>">
	</label>
	<div class="form-group mb">
		<label class="mr">
			Merk Produk
			<input type="text" name="merk" class="form-control mt05 mb" value="<?= $row["merk"] ?>">
		</label>
		<label>
			Harga Produk
			<input type="number" name="harga" class="form-control mt05" value="<?= $row["harga"]  ?>">
		</label>
	</div>
	<div class="form-group mb">
		<label class="mr">
			Kuantitas Produk
			<input type="number" name="qty" class="form-control mt05" value="<?= $row["qty"] ?>">
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
		<textarea name="deskripsi" class="form-control mt05 mb"><?= $row["deskripsi"] ?></textarea>
	</label>
	<label>
		Foto Produk
		<img src="../lib/img/produk/<?= $row["gambar"] ?>" style="display: block; width: 200px; border:1px solid #f5f5f5; padding: 1rem;" class="mt">
		<input type="file" name="gambar" class="form-control mt05 mb">
		<input type="hidden" name="gambarLama" value="<?= $row["gambar"] ?>">
	</label>
	<button class="btn" type="submit" name="edit_produk">Edit Produk</button>
</form>