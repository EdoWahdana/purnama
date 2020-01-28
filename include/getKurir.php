<?php
include("_koneksi.php");

$kecamatan = $_POST["kec"];
$kabupaten = $_POST["kab"];
$provinsi = $_POST["prov"];

$query = mysqli_query($conn, "SELECT * FROM ongkir INNER JOIN kurir ON ongkir.idKurir=kurir.idKurir WHERE kec='$kecamatan' AND kab='$kabupaten' AND prov='$provinsi' GROUP BY ongkir.idKurir");
if (mysqli_num_rows($query) > 0) {
	$respon["kurir"] = array();
	
	while ($data = mysqli_fetch_assoc($query)) {
		array_push($respon["kurir"], $data);
	}
	
	$respon["status"] = "Berhasil";
} else
	$respon["status"] = "Tidak ada kurir";

echo json_encode($respon);
?>