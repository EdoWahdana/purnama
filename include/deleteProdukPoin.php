<?php
include("_koneksi.php");

$id = $_POST["id"];

$query = mysqli_query($conn, "DELETE FROM produkpoin WHERE idProdukPoin = '$id'");
if ($query) {
	array_map("unlink", glob("../gambar/produkpoin/$id/*"));
	rmdir("../gambar/produkpoin/$id");
	
	$respon["status"] = "Berhasil";
} else {
	$respon["status"] = "Gagal menghapus produk";
}

echo json_encode($respon);
?>