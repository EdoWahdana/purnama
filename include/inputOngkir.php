<?php
include("_koneksi.php");

$id = $_POST["idKurir"];
$ongkir = $_POST["ongkir"];
$harga = $_POST["harga"];
$kecamatan = $_POST["kecamatan"];
$kabupaten = $_POST["kabupaten"];
$provinsi = $_POST["provinsi"];
$valid = true;

if ($id == "")
	$respon["status"] = "ID tidak terisi";
elseif ($harga == "")
	$respon["status"] = "Isi harga terlebih dahulu";
else {
	if (!ctype_digit($harga)) {
		$valid = false;
		$respon["status"] = "Harga harus angka";
	}
	
	if ($valid) {
		$query = mysqli_query($conn, "INSERT INTO ongkir VALUES(NULL, '$id', '$ongkir', '$harga', '$kecamatan', '$kabupaten', '$provinsi')");
		if ($query)
			$respon["status"] = "Berhasil";
		else
			$respon["status"] = "Gagal menambahkan ongkos kirim";
	}
}

echo json_encode($respon);
?>