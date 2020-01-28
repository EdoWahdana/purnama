<?php
include("_koneksi.php");

$id = $_POST["id"];

if ($id == "")
	$respon["status"] = "ID tidak terisi";
else {
	$query = mysqli_query($conn, "DELETE FROM kurir WHERE idKurir='$id'");
	if ($query)
		$respon["status"] = "Berhasil";
	else
		$respon["status"] = "Gagal menghapus kurir";
}

echo json_encode($respon);
?>