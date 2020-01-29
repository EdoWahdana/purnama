<?php
	include('/_koneksi.php');

	$respon['status'] = '';

	$idProduk = $_POST['idProduk'];
	$usernameKonsumen = $_POST['usernameKonsumen'];
	$isiKomentar = $_POST['isiKomentar'];
	$createdAt = $_POST['createdAt'];

	//Pembuatan query untuk insert ke tabel komentar
	$insertQuery = "INSERT INTO komentar (idProduk, usernameKonsumen, isiKomentar, createdAt) VALUES ('$idProduk', '$usernameKonsumen', '$isiKomentar', '$createdAt')";

	//Melakukan insert ke tabel komentar
	$insertExec = mysqli_query($conn, $insertQuery);

	//Cek jika insert berhasil
	if($query) {
		$respon['status'] = "Berhasil";
		$respon['idProduk'] = $idProduk;
	}

?>