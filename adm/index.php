<?php

include 'functions.php';
session_start();
if (!isset($_SESSION["login_adm"])) {
	echo "<script>
					alert('Login Dulu');
					document.location.href='login.php';
				</script>";
				return false;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Nesashop Admin Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../lib/css/starter.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<nav class="navbar fixed-top">
	<div class="row">
		<div class="navbar-logo">
			<a href="index.php">
				<img src="../lib/img/public/la.png">
			</a>
		</div>
		<div class="nav-btn">
			<a href="logout.php" class="btn">Keluar</a>
		</div>
	</div>
</nav>
<div class="sidebar fixed-top">
	<a href="?page=statistik" class="btn sidebar-btn">Statistik</a>
	<a href="?page=tambah_produk" class="btn sidebar-btn">Tambah Produk</a>
	<a href="?page=daftar_produk" class="btn sidebar-btn">Daftar Produk</a>
	<a href="?page=tambah_kategori" class="btn sidebar-btn">Tambah Kategori</a>
	<a href="?page=daftar_kategori" class="btn sidebar-btn">Daftar Kategori</a>
	<a href="?page=daftar_member" class="btn sidebar-btn">Daftar Member</a>
	<a href="?page=daftar_invoice" class="btn sidebar-btn">Daftar Invoice</a>
	<a href="?page=top_up_member" class="btn sidebar-btn">Top Up kredit</a>
</div>

<div class="inside">
	<div class="isi-inside">
		<?php

		if (isset($_GET["page"])) {
			$page = $_GET["page"];
		} else {
			$page = 'statistik';
		}

		switch ($page) {
			case 'statistik':
				include 'statistik.php';
				break;

			case 'tambah_produk':
				include 'tambah_produk.php';
				break;

			case 'daftar_produk':
				include 'daftar_produk.php';
				break;

			case 'tambah_kategori':
				include 'tambah_kategori.php';
				break;

			case 'daftar_kategori':
				include 'daftar_kategori.php';
				break;

			case 'edit_kategori':
				include 'edit_kategori.php';
				break;

			case 'edit_produk':
				include 'edit_produk.php';
				break;

			case 'daftar_member':
				include 'daftar_member.php';
				break;

			case 'daftar_invoice':
				include 'daftar_invoice.php';
				break;

			case 'detail_invoice':
				include 'detail_invoice.php';
				break;

			case 'top_up_member':
				include 'top_up_member.php';
				break;
			
			default:
				# code...
				break;
		}


		?>
	</div>
</div>
</body>
</html>