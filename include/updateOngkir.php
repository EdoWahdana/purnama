<?php
include("_koneksi.php");

$id = $_POST["id"];
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
		$query = mysqli_query($conn, "UPDATE ongkir SET ongkir='$harga', kec='$kecamatan', kab='$kabupaten', prov='$provinsi' WHERE idOngkir='$id'");
		if ($query)
			$respon["status"] = "Berhasil";
		else
			$respon["status"] = "Gagal memperbarui ongkos kirim";
	}
}

echo json_encode($respon);
?>