<?php
session_start();
include 'functions.php';
$id_usr = $_GET["id"];

if (del_member($id_usr) > 0) {
	echo "<script>		
					alert('Berhasil Dihapus');
					document.location.href='index.php?page=daftar_member';
				</script>";
}

?>