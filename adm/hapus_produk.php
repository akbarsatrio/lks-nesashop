<?php
session_start();
include 'functions.php';
$id_produk = $_GET["id"];

if (del_produk($id_produk) > 0) {
	echo "<script>		
					alert('Berhasil Dihapus');
					document.location.href='index.php?page=daftar_produk';
				</script>";
				return true;
} else{
	echo "<script>		
					alert('Gagal Dihapus');
					document.location.href='index.php?page=daftar_produk';
				</script>";
				return false;
}

?>