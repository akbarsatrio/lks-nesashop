	<?php

	$query = mysqli_query($conn, "SELECT * FROM tbl_balance WHERE id_usr='$id_usr'");
	$row = mysqli_fetch_assoc($query);

	if ($_POST) {
		$my_balance = "Rp. ".number_format($row["balance"],0,',','.');
		$total = $_POST["total"];
		$explode = explode('.', $total);
		$id_usr = $explode[0];
		$total = $explode[1];
		$invoice = $explode[2];

		if ($total > $row["balance"]) {
			echo "<script>document.location.href='?page=kredit_saya';</script>'";
			return false;
		} else {
			$new_balance = $row["balance"]-$total;
			echo "<script>document.location.href='?page=kredit_saya';</script>";
			$query = mysqli_query($conn, "UPDATE tbl_inv SET status='Disetujui' WHERE invoice='$invoice'");
			$query2 = mysqli_query($conn, "UPDATE tbl_balance SET balance='$new_balance' WHERE id_usr='$id_usr'");
			return mysqli_affected_rows($conn);
		}
	}

	?>

	<style type="text/css">
		body {
			background-color: #4dabff;
		}
	</style>
	<div id="wrapper-register" style="text-align: center; width: 100%; margin-bottom: 5%;">
		<small>Powered by</small>
		<br>
		<img src="lib/img/public/kreditku.png">
		<h1>Kredit Kamu : <?= "Rp.".number_format($row["balance"],0,',','.') ?></h1>
		<video id="preview" style="margin-bottom: 2%; border-radius: 5px; width: 100%;"></video>
		<form action="" method="POST" id="myForm">
			<input type="hidden" name="total" id="isi">
		</form>
		<button class="btn" onclick="startScanner()" style="margin-right: 1%;">Mulai Scan</button>
		<button class="btn" onclick="stopScanner()" style="margin-right: 1%;">Stop Scan</button>
		<br>
		<a href="?page=topup" class="btn" style="margin-top: 2%; width: 100%;">Top Up Kreditku</a>
	</div>

	<script type="text/javascript">
	    let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false });
		    Instascan.Camera.getCameras().then(function (cameras) {
		        if (cameras.length > 0) {
		            scanner.start(cameras[1]);
		        } else {
		            console.error('No cameras found.');
		        }

		        if (cameras.length = 1) {
		            scanner.start(cameras[0]);
		        } else {
		            console.error('No cameras found.');
		        }
		    }).catch(function (e) {
		        console.error(e);
		    });
				scanner.addListener('scan', function (content) {
			    window.oninput = document.getElementById("isi");
			    var result = document.getElementById("isi");
			    result.value = content;
			    document.getElementById("myForm").submit("total");
	    });
				function startScanner() {
	            Instascan.Camera.getCameras().then(function (cameras) {
	                if (cameras.length > 0) {
	                    scanner.start(cameras[0]);
	                } else {
	                    console.error('No cameras found.');
	                }
	            }).catch(function (e) {
	                console.error(e);
	            });
	        }
	        function stopScanner() {
	            scanner.stop();
	        }
	</script>
	</html>