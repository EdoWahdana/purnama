<?php
include("_koneksi.php");

$kdTransaksi = $_POST["kdTransaksi"];
$field = $_POST["field"];

if ($kdTransaksi == "")
	$respon["status"] = "Kode transaksi belum terisi";
elseif ($field == "")
	$respon["status"] = "Tidak valid";
else {
	switch($field) {
		case "tanggal":
			$query = mysqli_query($conn, "UPDATE transaksi SET tanggal='$_POST[isi]' WHERE kdTransaksi='$kdTransaksi'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "jam":
			$query = mysqli_query($conn, "UPDATE transaksi SET jam='$_POST[isi]' WHERE kdTransaksi='$kdTransaksi'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "alamat":
			$query = mysqli_query($conn, "UPDATE transaksi SET alamat='$_POST[isi]' WHERE kdTransaksi='$kdTransaksi'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "desa":
		$query = mysqli_query($conn, "UPDATE transaksi SET desa='$_POST[isi]' WHERE kdTransaksi='$kdTransaksi'");
		if ($query)
			$respon["status"] = "Berhasil";
		else
			$respon["status"] = "Gagal memperbarui transaksi";
		break;
			
		case "kecamatan":
			$query = mysqli_query($conn, "UPDATE transaksi SET kec='$_POST[isi]' WHERE kdTransaksi='$kdTransaksi'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "kabupaten":
			$query = mysqli_query($conn, "UPDATE transaksi SET kab='$_POST[isi]' WHERE kdTransaksi='$kdTransaksi'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "provinsi":
			$query = mysqli_query($conn, "UPDATE transaksi SET prov='$_POST[isi]' WHERE kdTransaksi='$kdTransaksi'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "pembayaran":
			$query = mysqli_query($conn, "UPDATE transaksi SET pembayaran='$_POST[isi]' WHERE kdTransaksi='$kdTransaksi'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "noResi":
			$query = mysqli_query($conn, "UPDATE transaksi SET noResi='$_POST[isi]' WHERE kdTransaksi='$kdTransaksi'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "status":
			$query = mysqli_query($conn, "UPDATE transaksi SET status='$_POST[isi]' WHERE kdTransaksi='$kdTransaksi'");
			if ($query) {
				if ($_POST["isi"] == "proses") {
					$respon["status"] = "Proses";
					$query = mysqli_query($conn, "SELECT * FROM tblorder WHERE kdTransaksi='$kdTransaksi'");
					while ($data = mysqli_fetch_assoc($query)) {
						$queryUpdate = mysqli_query($conn, "UPDATE produk SET stok=stok-'$data[qty]' WHERE idProduk=$data[idProduk]");
					}
				} elseif ($_POST["isi"] == "selesai") {
					$query = mysqli_query($conn, "SELECT * FROM tblorder WHERE kdTransaksi='$kdTransaksi'");
					$totalHarga = 0;
					$idKonsumen = "";
					while ($data = mysqli_fetch_assoc($query)) {
						$totalHarga += $data["jumlah"];
						$idKonsumen = $data["idKonsumen"];
					}
					
					$query = mysqli_query($conn, "SELECT * FROM konsumen WHERE username='$idKonsumen'");
					$data = mysqli_fetch_assoc($query);
					$poin = $data["poin"];
					
					$query = mysqli_query($conn, "SELECT * FROM pengaturan");
					$data = mysqli_fetch_assoc($query);
					$hargaPoin = $data["hargaPoin"];
					
					$dapatPoin = floor($totalHarga / $hargaPoin);
					$poin += $dapatPoin;
					
					$query = mysqli_query($conn, "UPDATE konsumen SET poin='$poin' WHERE username='$idKonsumen'");
					if ($query) {
						$respon["status"] = "Berhasil poin";
						$respon["poin"] = $dapatPoin;
					} else
						$respon["status"] = "Gagal mendapatkan poin";
				} elseif ($_POST["isi"] == "ditolak") {
					$query = mysqli_query($conn, "SELECT * FROM tblorder WHERE kdTransaksi='$kdTransaksi'");
					while ($data = mysqli_fetch_assoc($query)) {
						$queryUpdate = mysqli_query($conn, "UPDATE produk SET stok=stok-'$data[qty]' WHERE idProduk=$data[idProduk]");
						if ($queryUpdate) {
							$respon["status"] = "Berhasil";
						} else
							$respon["status"] = "Gagal menambahkan stok";
					}
				} else
					$respon["status"] = "Berhasil";
			} else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "idOngkir":
			$query = mysqli_query($conn, "SELECT * FROM ongkir WHERE idOngkir='$_POST[isi]'");
			$data = mysqli_fetch_assoc($query);
			$idKurir = $data["idKurir"];
			
			$query = mysqli_query($conn, "UPDATE transaksi SET idOngkir='$_POST[isi]', idKurir='$idKurir' WHERE kdTransaksi='$kdTransaksi'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "buktiLampiran":
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
							$respon["status"] = "Berhasil";
						else
							$respon["status"] = "Terjadi kesalahan saat upload gambar";
					}
				}
			}
			break;
			
		default:
			$respon["status"] = "Invalid";
	}
}

echo json_encode($respon);
?>