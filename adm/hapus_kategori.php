<?php
session_start();
include 'functions.php';
$id_kategori = $_GET["id"];

if (del_kategori($id_kategori) > 0) {
	echo "<script>		
					alert('Berhasil Dihapus');
					document.location.href='index.php?page=daftar_kategori';
				</script>";
}

?>