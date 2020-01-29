<?php
	include('_koneksi.php');

	$idProduk = $_POST['idProduk'];
	$usernameKonsumen = $_POST['usernameKonsumen'];
	$isiKomentar = $_POST['isiKomentar'];
	$createdAt = $_POST['createdAt'];

	//Pembuatan query untuk insert ke tabel komentar
	$insertQuery = "INSERT INTO komentar (idProduk, usernameKonsumen, isiKomentar, createdAt) VALUES ('$idProduk', '$usernameKonsumen', '$isiKomentar', '$createdAt')";

	//Melakukan insert ke tabel komentar
	$insertExec = mysqli_query($conn, $insertQuery);

	//Cek jika insert berhasil
	if($insertExec) {
		$respon['status'] = "Berhasil";
		$respon['idProduk'] = $idProduk;
	} else {
		$respon['status'] = "Gagal karena : " . mysqli_error($conn);
	}


	echo json_encode($respon);
?>