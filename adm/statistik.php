<?php

if (!isset($_SESSION["login_adm"])) {
	echo "<script>
					alert('Login Dulu');
					document.location.href='login.php';
				</script>";
				return false;
}

$query = mysqli_query($conn, "SELECT * FROM tbl_produk");
$row = mysqli_num_rows($query);

$query2 = mysqli_query($conn, "SELECT * FROM tbl_inv WHERE status = 'Disetujui'");
$row2 = mysqli_num_rows($query2);

$query3 = mysqli_query($conn, "SELECT * FROM tbl_inv WHERE status = 'Menunggu'");
$row3 = mysqli_num_rows($query3);

$query4 = mysqli_query($conn, "SELECT * FROM tbl_inv WHERE status = 'Ditolak'");
$row4 = mysqli_num_rows($query4);

$query5 = mysqli_query($conn, "SELECT * FROM tbl_usr");
$row5 = mysqli_num_rows($query5);

?>


<h1 style="margin-left: .5rem;">Statistik Toko</h1>
<div class="statistik">
	<div class="row">
		<div class="col-4" style="padding: .5rem">
			<div class="isi-stat" style="">
				<img src="../lib/icon/blue/bar-chart-box-fill.svg">
				<h3 class="mt05">Jumlah Produk</h3>
				<h1 style="color: #1581d1;"><?= $row ?> Produk</h1>
			</div>
		</div>
		<div class="col-4" style="padding: .5rem">
			<div class="isi-stat">
				<img src="../lib/icon/blue/exchange-box-fill.svg">
				<h3 class="mt05" style="margin-bottom: .7rem;">Transaksi Toko</h3>
				<table style="color: #1581d1;">
					<tr>
						<td>Disetujui</td>
						<td>:</td>
						<td><?= $row2 ?></td>
					</tr>
					<tr>
						<td>Menuggu</td>
						<td>:</td>
						<td><?= $row3 ?></td>
					</tr>
					<tr>
						<td>Ditolak</td>
						<td>:</td>
						<td><?= $row4 ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="col-4" style="padding: .5rem">
			<div class="isi-stat">
				<img src="../lib/icon/blue/account-box-fill.svg">
				<h3 class="mt05">Total Member</h3>
				<h1 style="color: #1581d1;"><?= $row5 ?> Member</h1>
			</div>
		</div>
	</div>
</div>
<br>
<h1>Transaksi Terbaru</h1>
<?php

$query = mysqli_query($conn, "SELECT DISTINCT invoice, total, status FROM tbl_inv ORDER BY id_inv DESC");

?>
<table class="table-strip">
	<tr>
		<th width="50">No.</th>
		<th>Invoice</th>
		<th>Total</th>
		<th>Status</th>
		<th>Aksi</th>
	</tr>
	<?php

		$no = 1;
		while ($row = mysqli_fetch_assoc($query)) {

		?>
	<tr>
		<td><?= $no++ ?></td>
		<td><?= $row["invoice"] ?></td>
		<td><?= "Rp. ". number_format($row["total"],0,',','.') ?></td>
		<td><?= $row["status"] ?></td>
		<td>
			<a href="?page=detail_invoice&inv=<?= $row["invoice"] ?>">Detail</a>
		</td>
	</tr>
	<?php } ?>
</table>