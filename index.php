<?php

session_start();
include 'usr/functions.php';
if (isset($_SESSION["login_usr"])) {
	$id_usr = $_SESSION["id_usr"];
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Nesashop Super Sale</title>
	<link rel="stylesheet" type="text/css" href="lib/css/starter.css">
	<link rel="stylesheet" type="text/css" href="lib/css/style.css">
	<script src="lib/js/jquery.min.js"></script>
    <script src="lib/js/instascan.min.js"></script>
</head>
<body>
<nav class="navbar fixed-top">
	<div class="container">
		<div class="row">
			<div class="nav-logo">
				<a href="index.php">
					<img src="lib/img/public/lb.png">
				</a>
			</div>
			<div class="search">
				<form action="?page=cari" method="POST" style="position: relative;">
					<input type="text" name="isi-search" class="form-control" style="padding-right: 4rem;" placeholder="Cari Apapun disini (atau kamu bisa tekan enter untuk melihat seua produk)" autocomplete="off" autofocus="">
					<button type="submit" name="search" class="btn btn-search">Cari</button>
				</form>
			</div>
			<?php

			if (!isset($_SESSION["login_usr"])) {
				echo "
						<div class='nav-btn'>
							<a href='?page=login' class='btn'>Login</a>
						</div>
				";
			} else {
				$ceker = mysqli_query($conn, "SELECT * FROM tbl_cart WHERE id_usr = '$id_usr'");
			$cekstok = mysqli_num_rows($ceker);
				echo "
						<div class='nav-btn'>
							<a href='?page=keranjang' class='btn'>".$cekstok." Barang</a>
							<a href='?page=profil' class='btn'>Profil</a>
						</div>
				";
			}

			?>
			<div class="nav-mob">
				<label class="btn nav-mob-btn" for="menu">Menu</label>
				<input type="checkbox" name="menu" id="menu">
				<div class="nav-mob-show">
					<div class="container">
						<div class="search-mob">
							<form action="?page=cari" method="POST" style="position: relative;">
								<input type="text" name="isi-search" class="form-control" style="padding-right: 4rem;" placeholder="Cari Apapun disini (atau kamu bisa tekan enter untuk melihat seua produk)" autocomplete="off" autofocus="">
								<button type="submit" name="search" class="btn btn-search">Cari</button>
							</form>
						</div>
						<?php

						if (!isset($_SESSION["login_usr"])) {
							echo "
										<a href='?page=login' class='btn btn-mob mt05'>Login</a>
							";
						} else {
							echo"
										<a href='?page=keranjang' class='btn btn-mob mt05'>".$cekstok." Barang</a>
										<a href='?page=profil' class='btn btn-mob mt05 mb05	'>Profil</a>
							";
						}

						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</nav>
<div class="category fixed-top">
	<div class="container">
		<span>Kategori :</span>
		<?php

		$queryKat = mysqli_query($conn, "SELECT * FROM tbl_kategori ORDER BY id_kategori DESC LIMIT 6");
		while ($rowKat = mysqli_fetch_assoc($queryKat)) {

		?>
		<a href="?page=kategori&id=<?= $rowKat["id_kategori"] ?>" style="margin-left: .25rem;"><?= $rowKat["kategori"] ?>,</a>
		<?php }	 ?>
	</div>
</div>

<div class="inside">
	<?php

		if (isset($_GET["page"])) {
			$page = $_GET["page"];
		} else {
			$page = 'produk';
		}

		switch ($page) {
			case 'register':
				include 'public/register.php';
				break;

			case 'login':
				include 'public/login.php';
				break;

			case 'recover':
				include 'public/recover.php';
				break;

			case 'produk':
				include 'public/produk.php';
				break;

			case 'kategori':
				include 'public/kategori.php';
				break;

			case 'cari':
				include 'public/cari.php';
				break;

			case 'detail_produk':
				include 'public/detail_produk.php';
				break;

			case 'keranjang':
				include 'usr/keranjang.php';
				break;

			case 'get_invoice':
				include 'usr/get_invoice.php';
				break;

			case 'profil':
				include 'usr/profil.php';
				break;

			case 'invoice':
				include 'usr/invoice.php';
				break;	

			case 'detail_invoice':
				include 'usr/detail_invoice.php';
				break;					
			
			case 'kredit_saya';
				include 'usr/kredit_saya.php';
				break;
			
			default:
				# code...
				break;
		}

		?>
	
</div>
<footer class="footer" style="background-color: #106aad; padding: .5rem;">
	<div class="container">
		<div class="row">
			<small style="color: white;">Created with Love by Akbar Satrio | 2019</small>
		</div>
	</div>
</footer>
</body>
</html>