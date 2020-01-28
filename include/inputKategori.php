<?php
include("_koneksi.php");

$nama = $_POST["nama"];

if ($nama == "")
	$respon["status"] = "Isi nama terlebih dahulu";
else {
	$query = mysqli_query($conn, "INSERT INTO kategori VALUES(null, '$nama')");
	if ($query)
		$respon["status"] = "Berhasil";
	else
		$respon["status"] = "Gagal menambahkan kategori";
}

echo json_encode($respon);
?>