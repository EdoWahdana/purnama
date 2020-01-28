<?php
include("_koneksi.php");

$id = $_POST["id"];
$nama = $_POST["nama"];

if ($id == "")
	$respon["status"] = "ID tidak terisi";
elseif ($nama == "")
	$respon["status"] = "Isi nama terlebih dahulu";
else {
	$query = mysqli_query($conn, "UPDATE kategori SET nmKategori='$nama' WHERE idKategori='$id'");
	if ($query)
		$respon["status"] = "Berhasil";
	else
		$respon["status"] = "Gagal memperbarui kategori";
}

echo json_encode($respon);
?>