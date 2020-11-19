<?php

$query = mysqli_query($conn, "SELECT DISTINCT invoice, total, status FROM tbl_inv ORDER BY id_inv DESC");

?>

<h1>Daftar Invocie</h1>
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