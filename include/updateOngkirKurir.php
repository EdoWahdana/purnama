<?php
include("_koneksi.php");

$id = $_POST["id"];
$idKurir = $_POST["idKurir"];
$nama = $_POST["nama"];
$valid = true;

if ($id == "")
	$respon["status"] = "ID tidak terisi";
elseif ($nama == "")
	$respon["status"] = "Isi nama terlebih dahulu";
else {
	if ($valid) {
		$query = mysqli_query($conn, "UPDATE ongkirkurir SET idKurir='$idKurir', namaOngkir='$nama' WHERE idOK='$id'");
		if ($query)
			$respon["status"] = "Berhasil";
		else
			$respon["status"] = "Gagal memperbarui data paket pengiriman";
	}
}

echo json_encode($respon);
?>