<?php


?>

<div class="banner-1" style="position: fixed; z-index: -999;">
	<img src="lib/img/public/banner2.png" style="width: 100%;">
</div>

<div class="banner-1" style="opacity: 0;">
	<img src="lib/img/public/banner2.png" style="width: 100%;">
</div>

<div class="banner-2">
	<div class="produk-list container">
		<span style="margin-left: .25rem;">Produk Terbaru</span>
		<br>
		<br>
		<div class="row">
			<?php

			$query = mysqli_query($conn, "SELECT * FROM tbl_produk ORDER BY id_produk DESC LIMIT 6");
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

<div class="banner-3">
	<div class="produk-list container" style="padding-top: 2rem; padding-bottom: 2rem;">
		<span style="margin-left: .25rem; color: white;">Produk Termurah</span>
		<br>
		<br>
		<div class="row">
			<?php

			$query = mysqli_query($conn, "SELECT * FROM tbl_produk ORDER BY harga LIMIT 6");
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