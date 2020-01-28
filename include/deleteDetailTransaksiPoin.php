<?php
include("_koneksi.php");

$id = $_POST["id"];
$kd = $_POST["kd"];

$query = mysqli_query($conn, "DELETE FROM detailtransaksipoin WHERE idDetailTransaksiPoin='$id'");
if ($query) {
	$query = mysqli_query($conn, "SELECT * FROM transaksipoin WHERE kdTransaksiPoin='$kd'");
	if (mysqli_num_rows($query) == 0) {
		$query = mysqli_query($conn, "DELETE FROM transaksipoin WHERE kdTransaksiPoin='$kd'");
		if ($query)
			$respon["status"] = "Berhasil";
		else
			$respon["status"] = "Gagal menghapus transaksi poin";
	} else
		$respon["status"] = "Berhasil";
} else
	$respon["status"] = "Gagal menghapus detail transaksi poin";

echo json_encode($respon);
?>