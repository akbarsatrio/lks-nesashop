<?php

if (!isset($_SESSION["login_adm"])) {
	echo "<script>
					alert('Login Dulu');
					document.location.href='login.php';
				</script>";
				return false;
}

?>
<h1>Daftar Kategori</h1>
<table class="table-strip">
	<tr>
		<th>No. </th>
		<th>Kategori </th>
		<th>Aksi</th>
	</tr>
	<?php

	$no = 1;
	$query = mysqli_query($conn, "SELECT * FROM tbl_kategori ORDER BY id_kategori DESC");
	while ($row = mysqli_fetch_assoc($query)) {
	?>
	<tr>
		<td width="50"><?= $no++ ?></td>	
		<td><?= $row["kategori"] ?></td>
		<td width="100">
			<a href="?page=edit_kategori&id=<?= $row["id_kategori"] ?>">Edit</a>
			<a href="hapus_kategori.php?id=<?= $row["id_kategori"] ?>">Hapus</a>
		</td>	
	</tr>
	<?php } ?>
</table>