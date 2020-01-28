<?php
include("_koneksi.php");

$username = $_SESSION["username"];
$subjek = $_POST["subjek"];
$isi = $_POST["isi"];

if ($username == "")
	$respon["status"] = "Invalid";
elseif ($subjek == "")
	$respon["status"] = "Isi subjek terlebih dahulu";
elseif ($isi == "")
	$respon["status"] = "Isi subjek terlebih dahulu";
else {
	$query = mysqli_query($conn, "SELECT * FROM kritik_saran");
	if (mysqli_num_rows($query) > 0) {
		$data = mysqli_fetch_assoc($query);
		$thread = $data["thread"] + 1;
	} else {
		$thread = 1;
	}
	
	$query = mysqli_query($conn, "INSERT INTO kritik_saran VALUES(null, '$username', '$thread', '$subjek', '$isi', 'Deliv')");
	if ($query)
		$respon["status"] = "Berhasil";
	else
		$respon["status"] = "Gagal mengirim pesan";
}

echo json_encode($respon);
?>