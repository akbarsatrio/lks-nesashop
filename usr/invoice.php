<?php
if (!isset($_SESSION["login_usr"])) {
	echo "<script>
			alert('Login Dulu');
			document.location.href='?page=login';
		</script>";
		return false;
	}

$id_usr = $_SESSION["id_usr"];

$query = mysqli_query($conn, "SELECT DISTINCT invoice, total, status FROM tbl_inv WHERE id_usr = '$id_usr'");

?>

<div class="container" style="margin-top: 5%; margin-bottom:5%;">
	<h1>Invoice Saya</h1>
	<table class="table-strip">
		<tr>
			<th>No.</th>
			<th>Invoice</th>
			<th>Total</th>
			<th>Status</th>
			<th width="150">Aksi</th>
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
				<a href="?page=detail_invoice&inv=<?= $row["invoice"] ?>">Hapus</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>