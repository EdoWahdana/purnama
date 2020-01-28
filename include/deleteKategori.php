<?php
include("_koneksi.php");

$id = $_POST["id"];

if ($id == "")
	$respon["status"] = "ID tidak terisi";
else {
	$query = mysqli_query($conn, "DELETE FROM kategori WHERE idKategori='$id'");
	if ($query)
		$respon["status"] = "Berhasil";
	else
		$respon["status"] = "Gagal menghapus kategori";
}

echo json_encode($respon);
?>