<?php
include("_koneksi.php");

$kdTransaksi = $_POST["kdTransaksi"];
$alasan = $_POST["alasan"];
$valid = true;

if ($kdTransaksi == "")
	$respon["status"] = "Kode transaksi tidak valid";
elseif ($alasan == "")
	$respon["status"] = "Isi alasan terlebih dahulu";
else {
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
			$query = mysqli_query($conn, "INSERT INTO retur VALUES(null, '$kdTransaksi', '$alasan', '', 'proses')");
			if ($query) {
				$query = mysqli_query($conn, "SELECT MAX(idRetur) AS idRetur FROM retur");
				$data = mysqli_fetch_assoc($query);
				$idBaru = $data["idRetur"];
				
				if (!file_exists("../gambar/retur/$idBaru"))
					mkdir("../gambar/retur/$idBaru", 0777, true);
				$targetFolder = "../gambar/retur/$idBaru/";
				$targetFile = $targetFolder . basename($_FILES["gambar"]["name"]);
				$tipeGambar = pathinfo($targetFile, PATHINFO_EXTENSION);
				$namaGambar = $targetFolder . $idBaru . "." . $tipeGambar;
				
				if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $namaGambar)) {
					$query = mysqli_query($conn, "UPDATE retur SET gambarBukti='$namaGambar' WHERE idRetur='$idBaru'");
					if ($query)
						$respon["status"] = "Berhasil";
					else
						$respon["status"] = "Terjadi kesalahan saat upload gambar";
				} else
					$respon["status"] = "Berhasil menambahkan retur, gambar gagal diupload";
			} else
				$respon["status"] = "Gagal menambahkan retur";
		}
	}
}

echo json_encode($respon);
?>