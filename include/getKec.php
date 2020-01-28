<?php
include("_koneksi.php");
$kab = $_POST["kab"];
$query = mysqli_query($conn, "SELECT DISTINCT(kec) FROM ongkir WHERE kab='$kab'");
if (mysqli_num_rows($query) > 0) {
	$respon["data"] = array();
	while ($data = mysqli_fetch_assoc($query)) {
		array_push($respon["data"], $data);
	}
	$respon["status"] = "Berhasil";
} else {
	$respon["status"] = "Tidak ada data";
}
echo json_encode($respon);
?>