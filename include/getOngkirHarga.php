<?php
include("_koneksi.php");

$id = $_POST["id"];

$query = mysqli_query($conn, "SELECT * FROM ongkir WHERE idOngkir='$id'");
if (mysqli_num_rows($query) > 0) {
	$data = mysqli_fetch_assoc($query);
	$respon["hargaOngkir"] = $data["ongkir"];
	$respon["status"] = "Berhasil";
} else
	$respon["status"] = "Tidak ada ongkos kirim";

echo json_encode($respon);
?>