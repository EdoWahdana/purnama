<?php
include("_koneksi.php");
$kode = $_POST["kode"];
$query = mysqli_query($conn, "SELECT * FROM produk WHERE idProduk='$kode'");
$data = mysqli_fetch_assoc($query);
$respon["nama"] = $data["namaProduk"];
$respon["gambar"] = $data["gambar"];
$respon["deskripsi"] = $data["deskripsi"];
$respon["stok"] = $data["stok"];
$respon["status"] = "Berhasil";
echo json_encode($respon);
?>