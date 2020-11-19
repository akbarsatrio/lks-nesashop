<?php

if (!isset($_SESSION["login_adm"])) {
	echo "<script>
					alert('Login Dulu');
					document.location.href='login.php';
				</script>";
				return false;
}

if (isset($_POST["edit_kategori"])) {
	if (edit_kategori($_POST) > 0) {
		echo "<script>
							alert('Sukses');
							document.location.href='?page=daftar_kategori';
						</script>";
	} else {
		echo "<script>
							alert('Gagal');
							document.location.href='?page=daftar_kategori';
						</script>";
						return false;
		}
}

$id_kategori = $_GET["id"];
$query = mysqli_query($conn, "SELECT * FROM tbl_kategori WHERE id_kategori = '$id_kategori'");
$row = mysqli_fetch_assoc($query);

?>

<h1>Edit Kategori</h1>
<form action="" method="POST">
	<label>
		Nama Kategori
		<input type="text" name="kategori" class="form-control mt05" value="<?= $row["kategori"] ?>">
	</label>
	<button type="submit" name="edit_kategori" class="btn mt">Edit Kategori</button>
</form>