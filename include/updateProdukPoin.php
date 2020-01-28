<?php
include("_koneksi.php");

$id = $_POST["id"];
$kategori = $_POST["kategori"];
$nama = $_POST["nama"];
$deskripsi = $_POST["deskripsi"];
$jumlahPoin = $_POST["jumlahPoin"];
$stok = $_POST["stok"];
$berat = $_POST["berat"];
$valid = true;

if ($kategori == 0)
	$respon["status"] = "ID tidak terisi";
elseif ($kategori == 0)
	$respon["status"] = "Pilih kategori terlebih dahulu";
elseif ($nama == "")
	$respon["status"] = "Isi nama terlebih dahulu";
elseif ($deskripsi == "")
	$respon["status"] = "Isi deskripsi terlebih dahulu";
elseif ($jumlahPoin == "")
	$respon["status"] = "Isi julah poin terlebih dahulu";
elseif ($stok == "")
	$respon["status"] = "Isi stok terlebih dahulu";
elseif ($berat == "")
	$respon["status"] = "Isi berat terlebih dahulu";
else {
	if (!ctype_digit($jumlahPoin)) {
		$valid = false;
		$respon["status"] = "Jumlah poin harus angka";
	}
	if (!ctype_digit($stok)) {
		$valid = false;
		$respon["status"] = "Stok harus angka";
	}
	if (!ctype_digit($berat)) {
		$valid = false;
		$respon["status"] = "Berat harus angka";
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
		
		if (!file_exists("../gambar/produkpoin/$id"))
			mkdir("../gambar/produkpoin/$id", 0777, true);
		$targetFolder = "../gambar/produkpoin/$id/";
		$targetFile = $targetFolder . basename($_FILES["gambar"]["name"]);
		$tipeGambar = pathinfo($targetFile, PATHINFO_EXTENSION);
		$namaGambar = $targetFolder . $id . "." . $tipeGambar;

		if ($valid) {
			if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $namaGambar)) {
				$query = mysqli_query($conn, "UPDATE produkpoin SET gambar='$namaGambar' WHERE idProdukPoin='$id'");
				if (!$query) {
					$valid = false;
					$respon["status"] = "Gagal memperbarui gambar";
				}
			} else {
				$valid = false;
				$respon["status"] = "Gambar gagal diupload";
			}
		}
	}
	
	if ($valid) {
		if ($valid) {
			$query = mysqli_query($conn, "UPDATE produkpoin SET idKategori='$kategori', namaProduk='$nama', deskripsi='$deskripsi', jumlahPoin='$jumlahPoin', stok='$stok', berat='$berat' WHERE idProdukPoin='$id'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui produk";
		}
	}
}

echo json_encode($respon);
?>