<?php
include("_koneksi.php");

$kategori = $_POST["kategori"];
$nama = $_POST["nama"];
$deskripsi = $_POST["deskripsi"];
$harga = $_POST["harga"];
$stok = $_POST["stok"];
$berat = $_POST["berat"];
$valid = true;

if ($kategori == 0)
	$respon["status"] = "Pilih kategori terlebih dahulu";
elseif ($nama == "")
	$respon["status"] = "Isi nama terlebih dahulu";
elseif ($deskripsi == "")
	$respon["status"] = "Isi deskripsi terlebih dahulu";
elseif ($harga == "")
	$respon["status"] = "Isi harga terlebih dahulu";
elseif ($stok == "")
	$respon["status"] = "Isi stok terlebih dahulu";
elseif ($berat == "")
	$respon["status"] = "Isi berat terlebih dahulu";
else {
	if (!ctype_digit($harga)) {
		$valid = false;
		$respon["status"] = "Harga harus angka";
	}
	if (!ctype_digit($stok)) {
		$valid = false;
		$respon["status"] = "Stok harus angka";
	}
	if (!ctype_digit($berat)) {
		$valid = false;
		$respon["status"] = "Berat harus angka";
	}
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
			$query = mysqli_query($conn, "INSERT INTO produk VALUES(null, '$kategori', '$nama', '$deskripsi', '$harga', '', '$stok', '$berat')");
			if ($query) {
				$query = mysqli_query($conn, "SELECT MAX(idProduk) AS idProduk FROM produk");
				$data = mysqli_fetch_assoc($query);
				$idBaru = $data["idProduk"];
				
				if (!file_exists("../gambar/produk/$idBaru"))
					mkdir("../gambar/produk/$idBaru", 0777, true);
				$targetFolder = "../gambar/produk/$idBaru/";
				$targetFile = $targetFolder . basename($_FILES["gambar"]["name"]);
				$tipeGambar = pathinfo($targetFile, PATHINFO_EXTENSION);
				$namaGambar = $targetFolder . $idBaru . "." . $tipeGambar;
				
				if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $namaGambar)) {
					$query = mysqli_query($conn, "UPDATE produk SET gambar='$namaGambar' WHERE idProduk='$idBaru'");
					if ($query)
						$respon["status"] = "Berhasil";
					else
						$respon["status"] = "Terjadi kesalahan saat upload gambar";
				} else
					$respon["status"] = "Berhasil menambahkan produk, gambar gagal diupload";
			} else
				$respon["status"] = "Gagal menambahkan data produk";
		}
	}
}

echo json_encode($respon);
?>