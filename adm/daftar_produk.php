<?php

if (!isset($_SESSION["login_adm"])) {
	echo "<script>
					alert('Login Dulu');
					document.location.href='login.php';
				</script>";
				return false;
}

?>
<h1>Daftar Produk</h1>
<table class="table-strip">
	<tr>
		<th>No. </th>
		<th>Nama </th>
		<th>Harga </th>
		<th>Kuantitas </th>
		<th>Aksi</th>
	</tr>
	<?php

	$no = 1;
	$query = mysqli_query($conn, "SELECT * FROM tbl_produk ORDER BY id_produk DESC");
	while ($row = mysqli_fetch_assoc($query)) {
	?>
	<tr>
		<td width="50"><?= $no++ ?></td>	
		<td><?= $row["nama"] ?></td>
		<td><?= "Rp. ". number_format($row["harga"],0,',','.') ?></td>	
		<td><?= $row["qty"]?> Barang</td>	
		<td width="100">
			<a href="?page=edit_produk&id=<?= $row["id_produk"] ?>">Edit</a>
			<a href="hapus_produk.php?id=<?= $row["id_produk"] ?>">Hapus</a>
		</td>	
	</tr>
	<?php } ?>
</table>