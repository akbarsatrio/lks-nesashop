<?php
if (!isset($_SESSION["login_usr"])) {
	echo "<script>
			alert('Login Dulu');
			document.location.href='?page=login';
		</script>";
		return false;
	}

$id_usr = $_SESSION["id_usr"];


?>

<style type="text/css">
	.footer {
		width: 85%;
		margin-left: auto;
	}
</style>
<div class="sidebar fixed-top">
	<div class="photo mb" style="text-align: center;	background:#106aad; padding-top: 2rem; padding-bottom: 1rem;">
		<img src="lib/img/user/<?= $_SESSION["gambar"] ?>" class="img">
		<h3 style="color: #fff;"><?= $_SESSION["nama"] ?></h3>
	</div>
		<a href="?page=profil&page=profil" class="btn sidebar-btn">Profil Saya</a>
		<a href="?page=invoice" class="btn sidebar-btn">Invoice Saya</a>
		<a href="?page=kredit_saya" class="btn sidebar-btn">Kredit Saya</a>
		<a href="logout.php" class="btn sidebar-btn">Logout</a>
</div>
<div class="inside-2">
	<div class="isi-inside-2">
		<?php

		if (isset($_GET["profil"])) {
			$profil = $_GET["profil"];
		} else {
			$profil = 'profil';
		}


		switch ($profil) {
			case 'profil':
				include 'usr/profil_saya.php';
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
</div>