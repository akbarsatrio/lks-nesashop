<?php

$conn = mysqli_connect("localhost", "root", "", "nesashop");

function reg_adm($data){
	global $conn;

	$username = $data["username"];
	$password = $data["password"];
	$code = $data['code'];

	$password = password_hash($password, PASSWORD_DEFAULT);
	$code = password_hash($code, PASSWORD_DEFAULT);

	mysqli_query($conn, "INSERT INTO tbl_adm VALUES('', '$username', '$password', '$code') "); 
	return mysqli_affected_rows($conn);
}

function login_adm($data){
	global $conn;

	$username = $data["username"];
	$password = $data["password"];
	$code = $data["code"];

	$cek = mysqli_query($conn, "SELECT * FROM tbl_adm WHERE username = '$username'");
	$row = mysqli_fetch_assoc($cek);
	if (password_verify($password, $row["password"]) && password_verify($code, $row["code"])) {
		
		$_SESSION["login_adm"] = true;
		header("Location: index.php");
		exit();
	} else {
		echo "<script>
						alert('Gagal');
					</script>";
		header("Location: login.php");
		exit();
	}
}

function add_kategori($data) {
	global $conn;

	$kategori = $data["kategori"];

	$cek = mysqli_query($conn, "SELECT * FROM tbl_kategori WHERE kategori = '$kategori'");

	if (mysqli_fetch_assoc($cek)) {
		echo "<script>
							alert('Kategori sudah ada, silahkan cari yang lain');
						</script>";
						return false;
	}

	if ($kategori == "") {
		return false;
	}

	mysqli_query($conn, "INSERT INTO tbl_kategori VALUES('', '$kategori') "); 
	return mysqli_affected_rows($conn);
}

function add_produk($data) {
	global $conn;

	$nama = $data["nama"];
	$merk = $data["merk"];
	$harga = $data["harga"];
	$qty = $data["qty"];
	$kategori = $data["kategori"];
	$deskripsi = $data["deskripsi"];
	$gambar = foto_produk();

	if (!$gambar) {
		return false;
	}

	if ($_FILES["gambar"]["error"] === 4) {
		$gambar = foto_produk();
	}

	if (isset($_POST) == 0) {
		return false;
	}

	mysqli_query($conn, "INSERT INTO tbl_produk VALUES('', '$nama', '$merk', '$harga', '$qty', '$kategori', '$deskripsi', '$gambar') ");
	return mysqli_affected_rows($conn);
}

function edit_produk($data) {
	global $conn;

	$id_produk = $data["id_produk"];
	$nama = $data["nama"];
	$merk = $data["merk"];
	$harga = $data["harga"];
	$qty = $data["qty"];
	$kategori = $data["kategori"];
	$deskripsi = $data["deskripsi"];
	$gambarLama = $data["gambarLama"];
	$gambar = foto_produk();


	if ($_FILES["gambar"]["error"] === 4) {
		$gambar = $gambarLama;
	} else {
		$gambar = foto_produk();
	}

	mysqli_query($conn, "UPDATE tbl_produk SET
		nama = '$nama',
		merk = '$merk',
		harga = '$harga',
		qty = '$qty',
		id_kategori = '$kategori',
		deskripsi = '$deskripsi',
		gambar = '$gambar' WHERE id_produk = '$id_produk'");
	return mysqli_affected_rows($conn);
}

function foto_produk() {
	$nFile = $_FILES["gambar"]["name"];
	$sFile = $_FILES["gambar"]["size"];
	$error = $_FILES["gambar"]["error"];
	$tmp_name = $_FILES["gambar"]["tmp_name"];

	$extV = ['jpg', 'png', 'jpeg'];
	$ext = explode('.', $nFile);
	$ext = strtolower(end($ext));

	if (!in_array($ext, $extV)) {
		echo "<script>
						alert('Tidak Upload Foto Produk?');
					</script>";
					return false;
	}

	if ($sFile > 1000000) {
		echo "<script>
						alert('Gagal, Pilih Foto Produk Max 1MB');
					</script>";
					return false;
	}

	move_uploaded_file($tmp_name, "../lib/img/produk/". $nFile);
	return $nFile;
}

function del_produk($id) {
	global $conn;

	$id_produk = $_GET["id"];

	mysqli_query($conn, "DELETE FROM tbl_produk WHERE id_produk = '$id_produk'");
	return mysqli_affected_rows($conn);
}

function del_kategori($id) {
	global $conn;

	$id_kategori = $_GET["id"];

	mysqli_query($conn, "DELETE FROM tbl_kategori WHERE id_kategori = '$id_kategori'");
	return mysqli_affected_rows($conn);
}

function del_member($id) {
	global $conn;

	$id_usr = $_GET["id"];

	mysqli_query($conn, "DELETE FROM tbl_usr WHERE id_usr = '$id_usr'");
	return mysqli_affected_rows($conn);
}

function edit_kategori($data) {
	global $conn;

	$id_kategori = $_GET["id"];
	$kategori = $data["kategori"];

	$cek = mysqli_query($conn, "SELECT * FROM tbl_kategori WHERE kategori = '$kategori'");

	if ($kategori == "") {
		return false;
	}

	if (mysqli_fetch_assoc($cek)) {
		echo "<script>
							alert('Kategori sudah ada, silahkan cari yang lain');
						</script>";
						return false;
	} else {
		mysqli_query($conn, "UPDATE tbl_kategori SET kategori = '$kategori' WHERE id_kategori = '$id_kategori'");
		return mysqli_affected_rows($conn);
	}

}

function ubah_status($data){
	global $conn;

	$status = $_POST["status"];
	$invoice = $_GET["inv"];

	mysqli_query($conn, "UPDATE tbl_inv SET status = '$status' WHERE invoice = '$invoice'");
	return mysqli_affected_rows($conn);
}

function topup($data) {
	global $conn;

	$username = $data["username"];
	$notel = $data["notel"];
	$norek = $data["norek"];
	$nominal = $data["nominal"];

	if (isset($_POST) < 4) {
		return false;
	}

	$query = mysqli_query($conn, "SELECT * FROM tbl_usr WHERE username='$username'");
	$row = mysqli_fetch_assoc($query);

	$query2 = mysqli_query($conn, "SELECT * FROM tbl_balance WHERE id_usr='".$row["id_usr"]."'");
	$row2 = mysqli_fetch_assoc($query2);

	if ($username !== $row["username"] && $notel !== $row["notel"] && $norek !== $row["norek"]) {
		return false;
	}

	if ($row["id_usr"] !== $row2["id_usr"]) {

		mysqli_query($conn, "INSERT INTO tbl_balance VALUES('','".$row["id_usr"]."', '$nominal')");
		return mysqli_affected_rows($conn);

	} else {

		$topup = $row2["balance"]+$nominal;
		mysqli_query($conn, "UPDATE tbl_balance SET balance='$topup' WHERE id_usr='".$row["id_usr"]."'");
		return mysqli_affected_rows($conn);
	}
}