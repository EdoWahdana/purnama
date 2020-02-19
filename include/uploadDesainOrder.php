 <?php
include ("_koneksi.php");

//Mengambil variabel idOrder yg telah dikirimkan melalui ajax di upload_desain.php
$idOrder = $_POST["idOrder"];

//Membuat variabel untuk mengecek data 
$valid = true;

$count = 0;

foreach($_FILES["gambar"]["name"] as $key=>$val) {

	if ($_FILES["gambar"]["error"][$key] == 4) {
		$valid = false;
		$respon["status"] = "Pilih gambar terlebih dahulu";
	}
	if ($_FILES["gambar"]["error"][$key] == 1) {
		$valid = false;
		$respon["status"] = "Ukuran gambar terlalu besar, maksimal 2MB";
	}

	if ($_FILES["gambar"]["error"][$key] == 0) {
		$cekGambar = getimagesize($_FILES["gambar"]["tmp_name"][$key]);
		if ($cekGambar !== false) {
			$valid = true;
		} else {
			$valid = false;
			$respon["status"] = "File bukan gambar";
		}
	}

	//Jika file diterima sebagai gambar

	if($valid) {
		
		$targetFolder = "../gambar/desainOrder/";
		$targetFile = $targetFolder . basename($_FILES["gambar"]["name"][$key]);
		$tipeGambar = pathinfo($targetFile, PATHINFO_EXTENSION);
		$namaGambar = $targetFolder . $idOrder . "_" . $count . "." . $tipeGambar;
		$namaGambarTanpaFolder = $idOrder . "_" . $count . "." . $tipeGambar; 

			if (move_uploaded_file($_FILES["gambar"]["tmp_name"][$key], $namaGambar)) {
				$insertDesain = mysqli_query($conn, "INSERT INTO gambardesain (idOrder, desain) VALUES ('$idOrder', '$namaGambarTanpaFolder')");
 				if($insertDesain){
					if ($insertDesain)
						$respon["status"] = "Berhasil";
					else
						$respon["status"] = "Terjadi kesalahan saat upload gambar";
				}
				
			}

	} else {
		$respon["status"] = "Gagal! Silahkan Ulangi Lagi!";
	}

	$count++;
}



	echo json_encode($respon);

?>