<?php

if (isset($_POST["beli"])) {
	if (beli($_POST) > 0) {
		echo "<script>
						alert('Berhasil Checkout');
						document.location.href='?page=get_invoice';
					</script>";
	} else {
		echo "<script>
						alert('Gagal Checkout');
					</script>";
					return false;
	}
}

if (!isset($_SESSION["login_usr"])) {
	echo "<script>
			alert('Login Dulu');
			document.location.href='?page=login';
		</script>";
		return false;
	}

?>

<style type="text/css">
	body {
		background-color: #f5f5f5;
	}
</style>

<div id="wrapper-keranjang">
	<div class="container">
		<div class="keranjang">
			<span style="color: #1581d1;">Keranjang</span>
			<h1 class="nomt">Keranjang Kamu</h1>
			<table class="table-strip" style="overflow-x: scroll;">
				<tr>
					<th>No.</th>
					<th>Nama</th>
					<th>Kuantitas</th>
					<th>Harga (dikali Kuantitas)</th>
					<th>Aksi</th>
				</tr>
				<?php

				$total = 0;
				$no = 1;
				$id_usr = $_SESSION["id_usr"];
				$query = mysqli_query($conn, "SELECT * FROM tbl_cart WHERE id_usr = '$id_usr'");
				while ($row = mysqli_fetch_assoc($query)) {
					$total += $row["harga"];
				?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $row["nama"] ?></td>
					<td><?= $row["qty"] ?></td>
					<td><?= "Rp. ". number_format($row["harga"],0,',','.') ?></td>
					<td>
						<a href="usr/hapus_cart.php?id=<?= $row["id_cart"] ?>">Hapus</a>
					</td>
				</tr>
				<form action="" method="POST">
					<input type="hidden" name="id_produk[]" value="<?= $row["id_produk"] ?>">
					<input type="hidden" name="qty[]" value="<?= $row["qty"] ?>">
				<?php } ?>
				<tr>
					<td colspan="3">Jumlah</td>
					<td colspan="2"><?= "Rp. ". number_format($total,0,',','.') ?></td>
				</tr>
			</table>
			<button class="btn mt" name="beli" type="submit" >Beli Sekarang</button>
			</form>
		</div>
	</div>
</div>