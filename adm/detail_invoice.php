<?php

$invoice = $_GET["inv"];

$query = mysqli_query($conn, "SELECT * FROM tbl_inv WHERE invoice = '$invoice'");
$row = mysqli_fetch_assoc($query);

if (isset($_POST["ubah_status"])) {
	if (ubah_status($_POST) > 0) {
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
		<td><?= $row["status"] ?></td>
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

		$queryProd = mysqli_query($conn, "SELECT * FROM tbl_produk WHERE id_produk ='$id_produk'");

		while ($rowProd = mysqli_fetch_assoc($queryProd)) {

	?>
	<tr>
		<td><?= $no++ ?></td>
		<td><?= $rowProd["nama"] ?></td>
		<td><?= $row2["qty"] ?></td>
		<td></td>
	</tr>
	<?php } ?>
	<?php } ?>
</table>

<h1>Bukti</h1>
<img src="../lib/img/bukti/<?= $row["bukti"] ?>" width="200px">
<form action="" method="POST">
	<div class="form-group">
		<label class="mt">
			Status
			<br>
			<select name="status" class="form-control mt05" style="width: 60%">
				<option value="Menunggu">Menunggu</option>
				<option value="Disetujui">Disetujui</option>
				<option value="Ditolak">Ditolak</option>
			</select>
			<br>
			<button class="btn mt" type="submit" name="ubah_status">Ubah status</button>
		</label>
	</div>
</form>

