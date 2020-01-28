<?php
include("_koneksi.php");

$idKurir = $_POST["idKurir"];
$kecamatan = $_POST["kec"];
$kabupaten = $_POST["kab"];
$provinsi = $_POST["prov"];

$query = mysqli_query($conn, "SELECT * FROM ongkir INNER JOIN ongkirkurir ON ongkir.idOK=ongkirkurir.idOK WHERE ongkir.idKurir='$idKurir' AND kec='$kecamatan' AND kab='$kabupaten' AND prov='$provinsi'");
if (mysqli_num_rows($query) > 0) {
	$respon["ongkir"] = array();
	
	while ($data = mysqli_fetch_assoc($query)) {
		array_push($respon["ongkir"], $data);
	}
	
	$respon["status"] = "Berhasil";
} else
	$respon["status"] = "Tidak ada ongkos kirim";

echo json_encode($respon);
?>