<?php
include ("_koneksi.php");

//Mengambil variabel idOrder yg telah dikirimkan melalui ajax di upload_desain.php
$idOrder = $_POST["idOrder"];

//Membuat variabel untuk mengecek data 
$valid = true;

	if ($_FILES["gambar"]["error"] == 4) {
		$valid = false;
		$respon["status"] = "Pilih gambar terlebih dahulu";
	}
	if ($_FILES["gambar"]["error"] == 1) {
		$valid = false;
		$respon["status"] = "Ukuran gambar terlalu besar, maksimal 2MB";
	}

	if ($_FILES["gambar"]["error"] == 0) {
		$cekGambar = getimagesize($_FILES["gambar"]["tmp_name"]);
		if ($cekGambar !== false) {
			$valid = true;
		} else {
			$valid = false;
			$respon["status"] = "File bukan gambar";
		}
	}


	if($valid) {
		
		$targetFolder = "../gambar/desainOrder/";
		$targetFile = $targetFolder . basename($_FILES["gambar"]["name"]);
		$tipeGambar = pathinfo($targetFile, PATHINFO_EXTENSION);
		$namaGambar = $targetFolder . $idOrder . "." . $tipeGambar;
		$namaGambarTanpaFolder = $idOrder . "." . $tipeGambar; 

			if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $namaGambar)) {
				$query = mysqli_query($conn, "UPDATE tblorder SET desain='$namaGambarTanpaFolder' WHERE idOrder='$idOrder'");
					if ($query)
						$respon["status"] = "Berhasil";
					else
						$respon["status"] = "Terjadi kesalahan saat upload gambar";
			}

	} else {
		$respon["status"] = "Gagal! Silahkan Ulangi Lagi!";
	}


	echo json_encode($respon);

?>