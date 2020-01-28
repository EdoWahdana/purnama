<?php
include("_koneksi.php");
$prov = $_POST["prov"];
$query = mysqli_query($conn, "SELECT DISTINCT(kab) FROM ongkir WHERE prov='$prov'");
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