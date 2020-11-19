<?php
/*
if (!isset($_SESSION["login_usr"])) {
	echo "<script>
			alert('Login Dulu');
			document.location.href='?page=login';
		</script>";
		return false;
	} else {
		e
	}

*/
session_start();
include 'functions.php';
$id_cart = $_GET["id"];
if (del_cart($id_cart) > 0) {
	echo "<script>
					alert('BErhasil Dihapus');
				</script>";
}