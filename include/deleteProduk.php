<?php
include("_koneksi.php");

$id = $_POST["id"];

$query = mysqli_query($conn, "DELETE FROM produk WHERE idProduk = '$id'");
if ($query) {
	array_map("unlink", glob("../gambar/produk/$id/*"));
	rmdir("../gambar/produk/$id");
	
	$respon["status"] = "Berhasil";
} else {
	$respon["status"] = "Gagal menghapus produk";
}

echo json_encode($respon);
?>