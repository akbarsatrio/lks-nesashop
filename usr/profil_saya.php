<?php

$id_usr = $_SESSION["id_usr"];

$query = mysqli_query($conn, "SELECT * FROM tbl_usr WHERE id_usr = '$id_usr'");
$row = mysqli_fetch_assoc($query);

$id_usr = $row['id_usr'];

$query2 = mysqli_query($conn, "SELECT * FROM tbl_balance WHERE id_usr ='$id_usr'");
$row2 = mysqli_fetch_assoc($query2);


if (isset($_POST["edit_profil"])) {
	if (edit_profil($_POST) > 0) {
		echo "<script>
						alert('Berhasil, anda akan logout');
						document.location.href='?page=login';
					</script>";
	} else {
		echo "<script>
						alert('Oops, Gagal');
					</script>";
					return false;
	}
}

?>
<h1>Profil Saya</h1>
<h1>Kredit Saya : <?= "Rp. ".number_format($row2["balance"],0,',','.') ?></h1>
<form action="" method="POST" enctype="multipart/form-data">
	<label>
		Nama
		<input type="text" name="nama" class="form-control mt05 mb" value="<?= $row["nama"] ?>">
	</label>
	<div class="form-group mb">
		<label class="mr">
			Username
			<input type="text" name="username" class="form-control mt05 mb" value="<?= $row["username"] ?>">
		</label>
		<label>
			Email
			<input type="email" name="email" class="form-control mt05" value="<?= $row["email"] ?>">
		</label>
	</div>
	<label>
		Alamat
		<textarea name="alamat" class="form-control mt05"><?= $row["alamat"] ?></textarea>
	</label>
	<div class="form-group mb mt">
		<label class="mr">
			Nomor Telepon
			<input type="number" name="notel" class="form-control mt05 mb" value="<?= $row["notel"] ?>">
		</label>
		<label>
			Nomor Rekening
			<input type="number" name="norek" class="form-control mt05 mb" value="<?= $row["norek"] ?>">
		</label>
	</div>
	<label>
		Foto Profil
		<img src="lib/img/user/<?= $row["gambar"] ?>" style="display: block; width: 200px; border:1px solid #f5f5f5; padding: 1rem;" class="mt">
		<input type="hidden" name="gambarLama" value="<?= $row["gambar"] ?>">
		<input type="file" name="gambar" class="form-control mt05 mb" value="<?= $row["norek"] ?>">
	</label>
	<button class="btn" type="submit" name="edit_profil">Ubah Profil</button>
</form>