<?php 

	include('_koneksi.php');
	
	
	$idProduk = $_POST['kode'];
	
	$query = mysqli_query($conn, "SELECT * FROM komentar WHERE idProduk='$idProduk'");
	$data = mysqli_fetch_assoc($query);

	$respon['createdAt'] = $data['createdAt'];
	$respon['idKomentar'] = $data['idKomentar'];
	$respon['idProduk'] = $data['idProduk'];
	$respon['isiKomentar'] = $data['isiKomentar'];
	$respon['usernameKonsumen'] = $data['usernameKonsumen'];
	
	$respon['status'] = 'Berhasil';
	
	echo json_encode($respon);

?>