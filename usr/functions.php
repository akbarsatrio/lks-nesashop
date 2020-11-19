<?php

$conn = mysqli_connect("localhost", "root", "", "nesashop");

function reg_usr($data) {
	global $conn;

	$nama = htmlspecialchars(stripslashes($data["nama"]));
	$username = htmlspecialchars(stripslashes(strtolower($data["username"])));
	$email = htmlspecialchars(stripslashes(strtolower($data["email"])));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$notel = htmlspecialchars(stripslashes($data["notel"]));
	$norek = htmlspecialchars(stripslashes($data["norek"]));
	$gambar = upload_profil();

	if (!$gambar) {
		return false;
	}

	if ($_FILES["gambar"]["error"] === 4) {
		$gambar = upload_profil();
	}

	if ($password !== $password2) {
		echo "<script>
						alert('Konfirmasi Password tidak sama');
					</script>";
					return false;
	}

	if ($username == "" && $email == "" && $password == "") {
		echo "<script>
						alert('Mohon isi field yang kosong');
					</script>";
					return false;
	}


	$cek = mysqli_query($conn, "SELECT * FROM tbl_usr WHERE username = '$username' or email = '$email'");
	if (mysqli_fetch_assoc($cek)) {
		echo "<script>
						alert('Pengguna sudah tersedia, coba cari Email dan Username lain');
					</script>";
					return false;
	}

	$password = password_hash($password, PASSWORD_DEFAULT);

	mysqli_query($conn, "INSERT INTO tbl_usr VALUES('', '$nama', '$username', '$email' ,'$password', '$alamat', '$notel', '$norek', '$gambar') ");
	return mysqli_affected_rows($conn);

}

function upload_profil() {
	$nFile = $_FILES["gambar"]["name"];
	$sFile = $_FILES["gambar"]["size"];
	$error = $_FILES["gambar"]["error"];
	$tmp_name = $_FILES["gambar"]["tmp_name"];

	$extV = ['jpg', 'png', 'jpeg'];
	$ext = explode('.', $nFile);
	$ext = strtolower(end($ext));

	if (!in_array($ext, $extV)) {
		echo "<script>
						alert('Tidak ada Foto?');
					</script>";
					return false;
	}

	if ($sFile > 1000000) {
		echo "<script>
						alert('Gagal, Pilih Foto Produk Max 1MB');
					</script>";
					return false;
	}

	move_uploaded_file($tmp_name, "lib/img/user/". $nFile);
	return $nFile;
}


function login_usr($data) {
	global $conn;

	if (isset($_POST["login_usr"])) {
		
		$email = $data["email"];
		$password = $data["password"];

		$cek = mysqli_query($conn, "SELECT * FROM tbl_usr WHERE email = '$email'");
		$row = mysqli_fetch_assoc($cek);
		if (password_verify($password, $row["password"])) {
			
			$_SESSION["id_usr"] = $row["id_usr"];
			$_SESSION["nama"] = $row["nama"];
			$_SESSION["gambar"] = $row["gambar"];
			$_SESSION["login_usr"] = true;
			header("Location: index.php?page=produk");
			exit();
		} else {
			return false;
		}

	}
}

function recover($data) {
	global $conn;

	$email = $data["email"];
	$notel = $data["notel"];
	$norek = $data["norek"];

	// cek
	$cek = mysqli_query($conn, "SELECT * FROM tbl_usr WHERE email = '$email' and notel = '$notel' and norek = '$norek'");
	$row = mysqli_fetch_assoc($cek);

	if ($email == $row["email"] && $notel = $row["notel"] 
		&& $norek == $row["norek"]) {
		
		$password = $data["password"];
		$password2 = $data["password2"];

		if ($password !== $password2) {
			echo "<script>
							alert('Passsword Tidak sama');
						</script>";
						return false;
		}

		$password = password_hash($password, PASSWORD_DEFAULT);

		mysqli_query($conn, "UPDATE tbl_usr SET password = '$password'");
		return mysqli_affected_rows($conn);

	} else {
		echo "<script>
						alert('Gagal, ada yang salah dalam penginputan form');
					</script>";
		return false;
	}

}

function add_cart($data) {
	global $conn;

	if (!isset($_SESSION["login_usr"])) {
	echo "<script>
			alert('Login Dulu');
			document.location.href='?page=login';
		</script>";
		return false;
	}

	$id_usr = $_SESSION["id_usr"];
	$id_produk = $_GET["id"];
	$qty = $data["qty"];

	$cek = mysqli_query($conn, "SELECT * FROM tbl_produk WHERE id_produk = '$id_produk'");
	$rowcek = mysqli_fetch_assoc($cek);
		
	$qtyUpdate = $rowcek["qty"]-$qty;
	$harga = $rowcek["harga"]*$qty;
	$nama = $rowcek["nama"];

	if ($qty > $rowcek["qty"]) {
		echo "<script>
						alert('Tidak Boleh melebihi stok');
					</script>";
					return false;
	}

	$cekker = mysqli_query($conn, "SELECT * FROM tbl_cart WHERE id_produk = '$id_produk' and id_usr = '$id_usr'");
	if ($rowceker = mysqli_fetch_assoc($cekker)) {

		$qtyCart = $rowceker["qty"];
		$qtyBaru = $qtyCart+$qty;
		$hargaBaru = $rowcek["harga"]*$qtyBaru;
		mysqli_query($conn, "UPDATE tbl_cart SET qty = '$qtyBaru', harga = '$hargaBaru' WHERE id_produk = '$id_produk'");
	} else {
		mysqli_query($conn, "INSERT INTO tbl_cart VALUES('', '$id_usr', '$id_produk', '$nama','$harga', '$qty') "); 
	}

	mysqli_query($conn, "UPDATE tbl_produk SET qty = '$qtyUpdate' WHERE id_produk = '$id_produk'");
	return mysqli_affected_rows($conn);
}

function del_cart($data) {
	global $conn;

	$id_cart = $_GET["id"];
	$id_usr = $_SESSION["id_usr"];

	$query = mysqli_query($conn, "SELECT * FROM tbl_cart WHERE id_cart = '$id_cart' and $id_usr = '$id_usr'");
	$row = mysqli_fetch_assoc($query);
	$id_produk = $row["id_produk"];

	$cekQty = mysqli_query($conn, "SELECT * FROM tbl_produk WHERE id_produk = '$id_produk'");
	$rowQty = mysqli_fetch_assoc($cekQty);

	$qty = $row["qty"];
	$qtyLama = $rowQty["qty"];
	$qtyUpdate = $qty+$qtyLama;

	mysqli_query($conn, "UPDATE tbl_produk SET qty = '$qtyUpdate' WHERE id_produk = '$id_produk'");

	mysqli_query($conn, "DELETE FROM tbl_cart WHERE id_cart = '$id_cart' ");
	return mysqli_affected_rows($conn);

}

function beli($data){
	global $conn;

	$id_usr = $_SESSION["id_usr"];
	$id_produk = $data["id_produk"];
	$qty = $data["qty"];

	if ($qty == "") {
		return false;
	}

	if ($qty == 0) {
		return false;
	}

	$total = 0;
	$cekhar = mysqli_query($conn, "SELECT * FROM tbl_cart WHERE id_usr = '$id_usr'");
	while ($rowhar = mysqli_fetch_assoc($cekhar)) {
		$total += $rowhar["harga"];
	}

	if ($id_produk && $qty > 0) {
		
		$jumlah_produk = count($id_produk);
		$jumlah_qty = count($qty);
		$invoice = "NESAINV". rand(10000, 99999);
		$status = "Menunggu";
		$_SESSION["invoice"] = $invoice;

		for ($i=0; $i <$jumlah_produk == $jumlah_qty ; $i++) {		
			mysqli_query($conn, "INSERT INTO tbl_inv VALUES('', '$id_usr', '$id_produk[$i]', '$qty[$i]', '$total', '$invoice', '$status', '')");
		}

		mysqli_query($conn, "DELETE FROM tbl_cart WHERE id_usr = '$id_usr'");
		return mysqli_affected_rows($conn);
	}

}

function bukti($data) {
	global $conn;

	$invoice = $_SESSION["invoice"];
	$gambar = upload2();

	if (!$gambar) {
		return false;
	}

	mysqli_query($conn, "UPDATE tbl_inv SET bukti = '$gambar' WHERE invoice = '$invoice'");
	return mysqli_affected_rows($conn);
}

function upload2() {
	$nFile = $_FILES["gambar"]["name"];
	$sFile = $_FILES["gambar"]["size"];
	$error = $_FILES["gambar"]["error"];
	$tmp_name = $_FILES["gambar"]["tmp_name"];

	$extV = ['jpg', 'png', 'jpeg'];
	$ext = explode('.', $nFile);
	$ext = strtolower(end($ext));

	if (!in_array($ext, $extV)) {
		echo "<script>
						alert('Tolong masukan foto produk');
					</script>";
					return false;
	}

	if ($sFile > 1000000) {
		echo "<script>
						alert('Gagal, Pilih Foto Produk Max 1MB');
					</script>";
					return false;
	}

	move_uploaded_file($tmp_name, "lib/img/bukti/". $nFile);
	return $nFile;
}


function edit_profil($data) {
	global $conn;

	$id_usr = $_SESSION["id_usr"];
	$nama = htmlspecialchars(stripslashes($data["nama"]));
	$username = htmlspecialchars(stripslashes(strtolower($data["username"])));
	$email = htmlspecialchars(stripslashes(strtolower($data["email"])));
	$alamat = htmlspecialchars($data["alamat"]);
	$notel = htmlspecialchars(stripslashes($data["notel"]));
	$norek = htmlspecialchars(stripslashes($data["norek"]));
	$gambarLama = $data["gambarLama"];
	$gambar = upload_profil();

	if ($_FILES["gambar"]["error"] === 4) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload_profil();
	}

	mysqli_query($conn, "UPDATE tbl_usr SET 
						nama = '$nama',
						username = '$username',
						email = '$email', 
						alamat = '$alamat',
						notel = '$notel',
						norek = '$norek',
						gambar = '$gambar' WHERE id_usr = '$id_usr'");
	return mysqli_affected_rows($conn);

}

function direct_tf($data) {
	global $conn;

	$id_usr = $_SESSION["id_usr"];
	$query = mysqli_query($conn, "SELECT * FROM tbl_balance WHERE id_usr='$id_usr'");
	$row = mysqli_fetch_assoc($query);
	$my_balance = "Rp. ".number_format($row["balance"],0,',','.');
	$invoice = $_POST["direct_inv"];
	$queryInv = mysqli_query($conn, "SELECT * FROM tbl_inv WHERE invoice = '$invoice'");
	while ($row2 = mysqli_fetch_assoc($queryInv)) {
		$total = $row2["total"];
	}

	if ($total > $row["balance"]) {
			echo "<script>
					alert('Kredit Kamu Kurang, Silahkan TopUp');

			</script>";
			return false;
		} else {
			$new_balance = $row["balance"]-$total;
			echo "<script>document.location.href='?page=kredit_saya';</script>";
			$query = mysqli_query($conn, "UPDATE tbl_inv SET status='Disetujui' WHERE invoice='$invoice'");
			$query2 = mysqli_query($conn, "UPDATE tbl_balance SET balance='$new_balance' WHERE id_usr='$id_usr'");
			return mysqli_affected_rows($conn);
			echo "<script>
					document.location.href='?page=get_invoice';

			</script>";
		}
}
