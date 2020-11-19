<?php
include 'phpqrcode/qrlib.php';
if (!isset($_SESSION["login_usr"])) {
	echo "<script>
			alert('Login Dulu');
			document.location.href='?page=login';
		</script>";
		return false;
	}

$invoice = $_SESSION["invoice"];
$query = mysqli_query($conn, "SELECT * FROM tbl_inv WHERE invoice = '$invoice'");
$row = mysqli_fetch_assoc($query);

$id_usr = $row["id_usr"];

$queryMem = mysqli_query($conn, "SELECT * FROM tbl_usr WHERE id_usr = '$id_usr'");
$rowMem = mysqli_fetch_assoc($queryMem);


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

if (isset($_POST["direct_tf"])) {
	if (direct_tf($_POST) > 0) {
		echo "<script>
				alert('Berhasil');
			</script>";
	}
}

?>

<style type="text/css">
	body {
		background-color: #f5f5f5;
	}
</style>

<div id="wraper-get">
	<div class="container">
		<div class="get-invoice">
			<div class="row">
				<span style="font-size: 36px; font-weight: bold;">Invoice<span style="font-size: 16px; color: #1581d1;">/<?= $invoice ?></span></span>
				<div class="logo" style="margin-left: auto;">
					<img src="lib/img/public/lb.png">
				</div>
			</div>
			<br>
			<div class="profile">
				<table>
					<tr>
						<td width="70">Nama</td>
						<td width="10">:</td>
						<td><?= $rowMem["nama"] ?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><?= $rowMem["alamat"] ?></td>
					</tr>
					<tr>
						<td>Rekening</td>
						<td>:</td>
						<td><?= $rowMem["norek"] ?></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td style="font-weight: bold;"><?= $row["status"] ?></td>
					</tr>
				</table>
				<br>
				<center>
				<p>Bayar secara instan dengan kreditku, cukup scan qr atau pencet tombol <i>Bayar Instan</i> dibawah</p>
				<?php
				$total = $row['total'];
				if ($row["status"] != 'Disetujui') {
					QRcode::png("$id_usr.$total.$invoice", "image.png", "L", 5, 5);
					echo "<img src='image.png'>

					<form action='' method='POST'>
						<input type='hidden' name='direct_inv' value='$invoice'>
						<button type='submit' name='direct_tf' class='btn'>Bayar Instan Via Kreditku</button>
					</form>

					";
				}
				?>
				</center>
				<h1 style="color: #1581d1;" class="nomb"><?= $invoice ?></h1>
				<i>Transfer Sebesar <b><?= "Rp. ". number_format($row["total"],0,',','.') ?></b> Ke Nomor Rekening <b>12657263 a/n Nesashop</b></i>
				<br>
				<i>Jika Sudah, silahkan upload foto bukti pembayaran dibawah</i>
				<br>
				<br>
				<form action="" method="POST" enctype="multipart/form-data">
					<label>
						<b>Upload Disini</b>
						<input type="file" name="gambar" class="form-control mt05">
					</label>
					<button class="btn mt" type="submit" name="bukti" style="width: 100%;">Upload</button>
				</form>
			</div>
		</div>
	</div>
</div>