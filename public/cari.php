<?php

$keyword = $_POST["isi-search"];
$query = mysqli_query($conn, "SELECT * FROM tbl_produk WHERE nama LIKE '%$keyword%' ORDER BY id_produk DESC");

?>


<div class="banner-2">
	<div class="produk-list container" style="padding-top: 2%; padding-bottom: 2%;">
		<span style="margin-left: .25rem;">Hasil Pencarian Dari : <?= $_POST["isi-search"] ?> </span>
		<br>
		<br>
		<div class="row">
			<?php

			while ($row = mysqli_fetch_assoc($query)) {

			?>
			<div class="col-2" style="padding:.25rem;">
				<a class="group" href="?page=detail_produk&id=<?= $row["id_produk"] ?>" style="display: block;">
					<div class="img-pdk" style="background-image: url('lib/img/produk/<?= $row["gambar"] ?>'); background-size: contain; background-position: center; background-repeat: no-repeat;">
						<!-- Img in CSS -->
					</div>
					<div class="detail-pdk mt">
						<span><?= $row["nama"] ?></span>
						<br>
						<br>
						<span style="color: #1581d1;"><?= "Rp.". number_format($row["harga"],0,',','.').",-" ?></span>
					</div>
				</a>
			</div>
		<?php } ?>
		</div>
	</div>
</div>
