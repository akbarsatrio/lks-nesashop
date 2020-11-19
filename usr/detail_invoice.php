<?php
include 'phpqrcode/qrlib.php';
$invoice = $_GET["inv"];

$query = mysqli_query($conn, "SELECT * FROM tbl_inv WHERE invoice = '$invoice'");
$row = mysqli_fetch_assoc($query);

if (isset($_POST["bukti"])) {
	if (bukti($_POST) > 0) {
		echo "<script>
						alert('Berhasil');
					</script>";
	} else {
		echo "<script>
						alert('Gagal');
					</script>";
					return false;
	}
}

?>
<div class="container" style="margin-top: 5%; margin-bottom: 5%;">
	<h1 class="nomt">Detail <span style="color: #1581d1;"><?= $row["invoice"] ?></span></h1>

	<?php

	$id_usr = $row["id_usr"];
	$queryMem = mysqli_query($conn, "SELECT * FROM tbl_usr WHERE id_usr = '$id_usr'");
	$rowMem = mysqli_fetch_assoc($queryMem);

	?>

	<table style="font-weight: bold;">
		<tr>
			<td width="60">Nama</td>
			<td width="10">:</td>
			<td><?= $rowMem["nama"] ?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td>:</td>
			<td><?= $rowMem["email"] ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><?= $rowMem["alamat"] ?></td>
		</tr>
		<tr>
			<td>No. Telp</td>
			<td>:</td>
			<td><?= $rowMem["notel"] ?></td>
		</tr>
		<tr>
			<td>Status</td>
			<td>:</td>
			<td><?php

				if ($row["status"] == "Menunggu") {
					echo "<span style='color:blue'>Menunggu</span>";
					$total = $row['total'];
					QRcode::png("$id_usr.$total", "image.png", "L", 5, 5);
					echo "
					<tr>
					<td colspan='3'><img src='image.png'></td>
					</tr>";
				} 

				if ($row["status"] == "Disetujui") {
					echo "<span style='color:green'>Disetujui</span>";
				}

				if ($row["status"] == "Ditolak") {
					echo "<span style='color:red'>Ditolak</span>";
				}


			?></td>
		</tr>
	</table>

	<h1>Rincian Pembelanjaan</h1>
	<table class="table-strip">
		<tr>
			<th width="20">No.</th>
			<th>Nama</th>
			<th>Qty</th>
			<th width="250">Harga (dikali Kuantitas)</th>
		</tr>
		<?php


		$no = 1;
		$query2 = mysqli_query($conn, "SELECT * FROM tbl_inv WHERE invoice = '$invoice'");
		while ($row2 = mysqli_fetch_assoc($query2)) {

			$id_produk = $row2["id_produk"];

			$total = 0;
			$queryProd = mysqli_query($conn, "SELECT * FROM tbl_produk WHERE id_produk ='$id_produk'");

			while ($rowProd = mysqli_fetch_assoc($queryProd)) {
				$harga = $rowProd["harga"]*$row2["qty"];
				$total += $row2["total"];

		?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $rowProd["nama"] ?></td>
			<td><?= $row2["qty"] ?></td>
			<td><?= "Rp. ". number_format($harga,0,',','.') ?></td>
		</tr>
			<?php } ?>
		<?php } ?>
		<tr>
			<td colspan="3">Jumlah</td>
			<td><?="Rp. ". number_format( $total,0,',','.') ?></td>
		</tr>
	</table>
	<form action="" method="POST" enctype="multipart/form-data" class="mt">
		<label>
			<b>Upload Disini</b>
			<input type="file" name="gambar" class="form-control mt05">
		</label>
		<button class="btn mt" type="submit" name="bukti" style="width: 100%;">Upload</button>
		<button onclick="return window.print()" class="btn print mt" style="width: 100%;">Cetak Invoice</button>
	</form>
</div>

<style type="text/css">
	.print {
		background-color: transparent;
		border:1px solid #1581d1;
		color: #1581d1;
	}

	.print:hover {
		background-color: #4dabff;	
		border:1px solid #4dabff;
		color: white;
	}
</style>