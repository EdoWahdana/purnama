<?php
include("../include/_koneksi.php");
$kdTransaksi = $_POST["kdTransaksi"];
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
				if($cekGambar !== false) {

				} else {
					$valid = false;
					$respon["status"] = "File bukan gambar";
				}

				if ($valid) {
					if (!file_exists("../gambar/transaksi/$kdTransaksi"))
						mkdir("../gambar/transaksi/$kdTransaksi", 0777, true);
					$targetFolder = "../gambar/transaksi/$kdTransaksi/";
					$targetFile = $targetFolder . basename($_FILES["gambar"]["name"]);
					$tipeGambar = pathinfo($targetFile, PATHINFO_EXTENSION);
					$namaGambar = $targetFolder . $kdTransaksi . "." . $tipeGambar;

					if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $namaGambar)) {
						$query = mysqli_query($conn, "UPDATE transaksi SET buktiLampiran='$namaGambar' WHERE kdTransaksi='$kdTransaksi'");
						if ($query)
						    echo"<script>alert('Data Berhasil Disimpan');history.go(-1);</script>";
						else
							echo"Terjadi kesalahan saat upload gambar";
					}
				}
			}
?>