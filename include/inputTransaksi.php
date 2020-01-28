<?php
include("_koneksi.php");

$idKonsumen = $_POST["id"];

if ($idKonsumen == "") 
	$respon["status"] = "ID belum terisi";
else {
	$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE idKonsumen='$idKonsumen' AND status='keranjang'");
	if (mysqli_num_rows($query) > 0) {
		$data = mysqli_fetch_assoc($query);
		$kdTransaksi = $data["kdTransaksi"];

		$respon["status"] = "Berhasil";
		$respon["kdTransaksi"] = $kdTransaksi;
	} else {
		$query = mysqli_query($conn, "SELECT MAX(kdTransaksi) as kdTransaksi FROM transaksi");
		$data = mysqli_fetch_assoc($query);
		if ($data["kdTransaksi"] !== null) {
			$id = explode("TRANS", $data["kdTransaksi"]);
			$kdTransaksi = "TRANS" . str_pad((int)$id[1] + 1, 7, "0", STR_PAD_LEFT);
		} else {
			$kdTransaksi = "TRANS0000001";
		}

		$query = mysqli_query($conn, "INSERT INTO transaksi(idTransaksi, idKonsumen, kdTransaksi, status) VALUES(null, '$idKonsumen', '$kdTransaksi', 'keranjang')");
		if ($query) {
			$respon["status"] = "Berhasil";
			$respon["kdTransaksi"] = $kdTransaksi;
		} else
			$respon["status"] = "Gagal Menambahkan Transaksi";
	}
}

echo json_encode($respon);
?>