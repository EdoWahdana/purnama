<?php
include("_koneksi.php");

$idKonsumen = $_POST["id"];

if ($idKonsumen == "") 
	$respon["status"] = "ID belum terisi";
else {
	$query = mysqli_query($conn, "SELECT * FROM transaksipoin WHERE idKonsumen='$idKonsumen' AND status='keranjang'");
	if (mysqli_num_rows($query) > 0) {
		$data = mysqli_fetch_assoc($query);
		$kdTransaksi = $data["kdTransaksiPoin"];

		$respon["status"] = "Berhasil";
		$respon["kdTransaksi"] = $kdTransaksi;
	} else {
		$query = mysqli_query($conn, "SELECT MAX(kdTransaksiPoin) as kdTransaksiPoin FROM transaksipoin");
		$data = mysqli_fetch_assoc($query);
		if ($data["kdTransaksiPoin"] !== null) {
			$id = explode("TRANP", $data["kdTransaksiPoin"]);
			$kdTransaksi = "TRANP" . str_pad((int)$id[1] + 1, 7, "0", STR_PAD_LEFT);
		} else {
			$kdTransaksi = "TRANP0000001";
		}

		$query = mysqli_query($conn, "INSERT INTO transaksipoin(idTransaksiPoin, idKonsumen, kdTransaksiPoin, status) VALUES(null, '$idKonsumen', '$kdTransaksi', 'keranjang')");
		if ($query) {
			$respon["status"] = "Berhasil";
			$respon["kdTransaksi"] = $kdTransaksi;
		} else
			$respon["status"] = "Gagal menambahkan transaksi";
	}
}

echo json_encode($respon);
?>