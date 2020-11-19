<?php

$id_produk = $_GET["id"];
$query = mysqli_query($conn, "SELECT * FROM tbl_produk WHERE id_produk = '$id_produk'");
$row = mysqli_fetch_assoc($query);

if (isset($_POST["add_cart"])) {
	if (add_cart($_POST) > 0) {
		echo "<script>
						alert('Berhasil Dimasukan Ke Keranjang');
						document.location.href='?page=keranjang';
					</script>";
	} else {
		echo "<script>
						alert('Gagal Dimasukan Ke Keranjang');
					</script>";
					return false;
	}
}

?>
<style type="text/css">
	body {
		background-color: #f5f5f5;
	}
</style>
<div id="wrapper-detail">
	<div class="container">
		<div class="detail-produk">
			<div class="row">
				<div class="col-4 img-detail-produk" style="background-image: url('lib/img/produk/<?= $row["gambar"] ?>');">
					
				</div>
				<div class="col-8">
					<div class="detail-produk-2">
						<h3 class="nomt mb05" style="font-size: 21px;"><?= $row["nama"] ?></h3>
						<h1 style="color: #1581d1;" class="nomt"><?= "Rp. ". number_format($row["harga"],0,',','.').",-" ?></h1>
						<table style="color: #1581d1;">
							<tr>
								<td width="40">Merk</td>
								<td width="10">:</td>
								<td><?= $row["merk"] ?></td>
							</tr>
							<tr>
								<td width="40">Stok</td>
								<td width="10">:</td>
								<td><?= $row["qty"] ?></td>
							</tr>
						</table>
						<div class="deskripsi mt">
							<span>Deskripsi :</span>
							<br>
							<br>
							<span><?= $row["deskripsi"] ?></span>
						</div>
						<div class="action-buy mt">
							<form class="form-group" action="" method="POST">
								<input type="number" name="qty" min="1" max="<?= $row["qty"] ?>" class="form-control mr" style="width: 20%;" placeholder="Kuantitas">
								<button class="btn" type="submit" name="add_cart">Tambah Ke Keranjang</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="banner-3">
	<div class="produk-list container" style="padding-top: 2rem; padding-bottom: 2rem;">
		<span style="margin-left: .25rem; color: white;">Mungkin Kamu Juga Tertarik</span>
		<br>
		<br>
		<div class="row">
			<?php

			$query = mysqli_query($conn, "SELECT * FROM tbl_produk ORDER BY RAND() LIMIT 6");
			while ($row = mysqli_fetch_assoc($query)) {

			?>
			<div class="col-2" style="padding-left: .25rem; padding-right: .25rem;">
				<a class="group" href="?page=detail_produk&id=<?= $row["id_produk"] ?>" style="display: block;">
					<div class="img-pdk" style="background-image: url('lib/img/produk/<?= $row["gambar"] ?>'); background-size: contain; background-position: center; background-repeat: no-repeat;">
						<!-- Img in CSS -->
					</div>
					<div class="detail-pdk mt">
						<span><?= $row["nama"] ?></span>
						<br>
						<br>
						<span style="color: #1581d1;"><?= "Rp.". number_format($row["harga"],0,',','.').",-" ?></span>
					</div>
				</a>
			</div>
		<?php } ?>
		</div>
	</div>
</div>