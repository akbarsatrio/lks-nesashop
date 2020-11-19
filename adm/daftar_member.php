<?php

$query = mysqli_query($conn, "SELECT * FROM tbl_usr ORDER BY id_usr DESC");


?>
<h1>Daftar Meber</h1>
<table class="table-strip">
	<tr>
		<th>No. </th>
		<th>Nama </th>
		<th>Email </th>
		<th>Aksi</th>
	</tr>
	<?php

	$no = 1;
	while ($row = mysqli_fetch_assoc($query)) {
	?>
	<tr>
		<td width="50"><?= $no++ ?></td>	
		<td><?= $row["nama"] ?></td>
		<td><?= $row["email"] ?></td>		
		<td width="100">
			<a href="hapus_member.php?id=<?= $row["id_usr"] ?>">Hapus</a>
		</td>	
	</tr>
	<?php } ?>
</table>

