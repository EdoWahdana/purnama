<?php
	include('_koneksi.php');

	$idDesainAdmin = $_POST['idDesainAdmin'];
	$username = $_POST['username'];
	$isiMasukan = $_POST['isiMasukan'];
	$createdAt = $_POST['createdAt'];

	//Pembuatan query untuk insert ke tabel masukan
	$insertQuery = "INSERT INTO masukan (idDesainAdmin, username, isiMasukan, createdAt) VALUES ('$idDesainAdmin', '$username', '$isiMasukan', '$createdAt')";

	//Melakukan insert ke tabel masukan
	$insertExec = mysqli_query($conn, $insertQuery);

	//Cek jika insert berhasil
	if($insertExec) {
		$respon['status'] = "Berhasil";
		$respon['idDesainAdmin'] = $idDesainAdmin;
	} else {
		$respon['status'] = "Gagal karena : " . mysqli_error($conn);
	}


	echo json_encode($respon);
?>