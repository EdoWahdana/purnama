<?php
include("../include/_koneksi.php");
$nama = $_POST["nama"];
$keterangan = $_POST["keterangan"];
$valid = true;
			
			if ($_FILES["gambarDesain"]["error"] == 4) {
				$valid = false;
				$respon["status"] = "Pilih gambar terlebih dahulu";
			}
			if ($_FILES["gambarDesain"]["error"] == 1) {
				$valid = false;
				$respon["status"] = "Ukuran gambar terlalu besar, maksimal 2MB";
			}
			if ($_FILES["gambarDesain"]["error"] == 0) {
				$cekGambar = getimagesize($_FILES["gambarDesain"]["tmp_name"]);
				if($cekGambar !== false) {

				} else {
					$valid = false;
					$respon["status"] = "File bukan gambar";
				}
				
		if ($_FILES["buktiBayar"]["error"] == 4) {
				$valid = false;
				$respon["status"] = "Pilih gambar terlebih dahulu";
			}
			if ($_FILES["buktiBayar"]["error"] == 1) {
				$valid = false;
				$respon["status"] = "Ukuran gambar terlalu besar, maksimal 2MB";
			}
			if ($_FILES["buktiBayar"]["error"] == 0) {
				$cekGambar = getimagesize($_FILES["buktiBayar"]["tmp_name"]);
				if($cekGambar !== false) {

				} else {
					$valid = false;
					$respon["status"] = "File bukan gambar";
				}	

				if ($valid) {
					if (!file_exists("../gambar/UploadDesain/$nama"))
						mkdir("../gambar/UploadDesain/$nama", 0777, true);
					$targetFolder = "../gambar/UploadDesain/$nama/";
					$targetFile = $targetFolder . basename($_FILES["gambarDesain"]["name"]);
					$tipeGambar = pathinfo($targetFile, PATHINFO_EXTENSION);
					$namaGambar = $targetFolder . $nama . "." . $tipeGambar;
					//buktiBayar
					$targetFile1 = $targetFolder . basename($_FILES["buktiBayar"]["name"]);
					$tipeGambar1 = pathinfo($targetFile1, PATHINFO_EXTENSION);
					$namaGambar1 = $targetFolder . $nama . "." . $tipeGambar1;

					if (move_uploaded_file($_FILES["gambarDesain"]["tmp_name"], $namaGambar)) {
						if (move_uploaded_file($_FILES["buktiBayar"]["tmp_name"], $namaGambar1)) {
						$query = mysqli_query($conn, "INSERT INTO reqdesain VALUES(null, '$nama','$namaGambar','$namaGambar1','$keterangan')");
						if ($query)
						    echo"<script>alert('Data Berhasil Disimpan');history.go(-1);</script>";
						else
							echo"Terjadi kesalahan saat upload gambar";
					}
				}
			}
			}
			}
?>