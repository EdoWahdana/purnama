<?php
include("_koneksi.php");

$id = $_POST["id"];

$query = mysqli_query($conn, "DELETE FROM ongkir WHERE idOngkir='$id'");
if ($query)
	$respon["status"] = "Berhasil";
else
	$respon["status"] = "Gagal menghapus ongkos kirim";

echo json_encode($respon);
?>