<?php
include("_koneksi.php");

$hargaPoin = $_POST["hargaPoin"];
$valid = true;

if ($hargaPoin == "")
	$respon["status"] = "Isi harga poin terlebih dahulu";
else {
	if (!ctype_digit($hargaPoin)) {
		$valid = false;
		$respon["status"] = "Harga poin harus angka";
	}
	if ($valid) {
		$query = mysqli_query($conn, "UPDATE pengaturan SET hargaPoin='$hargaPoin'");
		if ($query) {
			$respon["status"] = "Berhasil";
			$respon["hargaPoin"] = number_format($hargaPoin, 0, ".", ".");
		}
		else
			$respon["status"] = "Gagal memperbarui harga poin";
	}
}

echo json_encode($respon);
?>