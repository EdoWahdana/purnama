<?php
include("_koneksi.php");
$kode = $_POST["kode"];
$query = mysqli_query($conn, "SELECT * FROM produkpoin WHERE idProdukPoin='$kode'");
$data = mysqli_fetch_assoc($query);
$respon["nama"] = $data["namaProduk"];
$respon["gambar"] = $data["gambar"];
$respon["deskripsi"] = $data["deskripsi"];
$respon["stok"] = $data["stok"];
$respon["jumlahPoin"] = $data["jumlahPoin"];
$query = mysqli_query($conn, "SELECT * FROM konsumen WHERE username='$_SESSION[username]'");
$data = mysqli_fetch_assoc($query);
$respon["poin"] = $data["poin"];
$respon["status"] = "Berhasil";
echo json_encode($respon);
?>