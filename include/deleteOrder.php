<?php
include("_koneksi.php");

$id = $_POST["id"];
$kd = $_POST["kd"];

$query = mysqli_query($conn, "DELETE FROM tblorder WHERE idOrder='$id'");
if ($query) {
	$query = mysqli_query($conn, "SELECT * FROM tblorder WHERE kdTransaksi='$kd'");
	if (mysqli_num_rows($query) == 0) {
		$query = mysqli_query($conn, "DELETE FROM transaksi WHERE kdTransaksi='$kd'");
		if ($query)
			$respon["status"] = "Berhasil";
		else
			$respon["status"] = "Gagal menghapus transaksi";
	} else
		$respon["status"] = "Berhasil";
} else
	$respon["status"] = "Gagal menghapus order";

echo json_encode($respon);
?>