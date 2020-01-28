<?php
include("_koneksi.php");

$id = $_POST["idKurir"];
$nama = $_POST["nama"];
$valid = true;

if ($id == "")
	$respon["status"] = "ID tidak terisi";
elseif ($nama == "")
	$respon["status"] = "Isi nama terlebih dahulu";
else {
	if ($valid) {
		$query = mysqli_query($conn, "INSERT INTO ongkirkurir VALUES(NULL, '$id', '$nama')");
		if ($query)
			$respon["status"] = "Berhasil";
		else
			$respon["status"] = "Gagal menambahkan data paket pengiriman";
	}
}

echo json_encode($respon);
?>