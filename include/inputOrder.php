<?php
include("_koneksi.php");

$idProduk = $_POST["idProduk"];
$idKonsumen = $_POST["idKonsumen"];
$kdTransaksi = $_POST["kdTransaksi"];

if ($idProduk == "")
	$respon["status"] = "ID produk belum terisi";
elseif ($idKonsumen == "")
	$respon["status"] = "ID konsumen belum terisi";
elseif ($kdTransaksi == "")
	$respon["status"] = "Kode transaksi belum terisi";
else {
	$query = mysqli_query($conn, "INSERT INTO tblorder VALUES(null, '$kdTransaksi', '$idKonsumen', '$idProduk', '0', '1', '0', '')");
	if ($query)
		$respon["status"] = "Berhasil";
	else
		$respon["status"] = "Gagal menambahkan order";
}

echo json_encode($respon);
?>