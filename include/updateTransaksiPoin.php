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
			$query = mysqli_query($conn, "UPDATE transaksipoin SET tanggal='$_POST[isi]' WHERE kdTransaksiPoin='$kdTransaksi'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "jam":
			$query = mysqli_query($conn, "UPDATE transaksipoin SET jam='$_POST[isi]' WHERE kdTransaksiPoin='$kdTransaksi'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "alamat":
			$query = mysqli_query($conn, "UPDATE transaksipoin SET alamat='$_POST[isi]' WHERE kdTransaksiPoin='$kdTransaksi'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "desa":
			$query = mysqli_query($conn, "UPDATE transaksipoin SET desa='$_POST[isi]' WHERE kdTransaksiPoin='$kdTransaksi'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "kecamatan":
			$query = mysqli_query($conn, "UPDATE transaksipoin SET kec='$_POST[isi]' WHERE kdTransaksiPoin='$kdTransaksi'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "kabupaten":
			$query = mysqli_query($conn, "UPDATE transaksipoin SET kab='$_POST[isi]' WHERE kdTransaksiPoin='$kdTransaksi'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "provinsi":
			$query = mysqli_query($conn, "UPDATE transaksipoin SET prov='$_POST[isi]' WHERE kdTransaksiPoin='$kdTransaksi'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "pembayaran":
			$query = mysqli_query($conn, "UPDATE transaksipoin SET pembayaran='$_POST[isi]' WHERE kdTransaksiPoin='$kdTransaksi'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "noResi":
			$query = mysqli_query($conn, "UPDATE transaksipoin SET noResi='$_POST[isi]' WHERE kdTransaksiPoin='$kdTransaksi'");
			if ($query)
				$respon["status"] = "Berhasil";
			else
				$respon["status"] = "Gagal memperbarui transaksi";
			break;
			
		case "status":
			$query = mysqli_query($conn, "UPDATE transaksipoin SET status='$_POST[isi]' WHERE kdTransaksiPoin='$kdTransaksi'");
			if ($query) {
				if ($_POST["isi"] == "proses") {
					$query = mysqli_query($conn, "SELECT * FROM detailtransaksipoin WHERE kdTransaksiPoin='$kdTransaksi'");
					$totalPoin = 0;
					$idKonsumen = "";
					while ($data = mysqli_fetch_assoc($query)) {
						$totalPoin += $data["jumlah"];
						$idKonsumen = $data["idKonsumen"];
					}
					
					$query = mysqli_query($conn, "SELECT * FROM detailtransaksipoin WHERE kdTransaksiPoin='$kdTransaksi'");
					while ($data = mysqli_fetch_assoc($query)) {
						$queryUpdate = mysqli_query($conn, "UPDATE produkPoin SET stok=stok-'$data[qty]' WHERE idProdukPoin=$data[idProduk]");
					}
					
					$query = mysqli_query($conn, "UPDATE konsumen SET poin=poin-'$totalPoin' WHERE username='$idKonsumen'");
					if ($query) {
						$respon["status"] = "Proses";
					} else
						$respon["status"] = "Gagal mengurangi poin";
				} elseif ($_POST["isi"] == "ditolak") {
					$query = mysqli_query($conn, "SELECT * FROM detailtransaksipoin WHERE kdTransaksiPoin='$kdTransaksi'");
					while ($data = mysqli_fetch_assoc($query)) {
						$queryUpdate = mysqli_query($conn, "UPDATE produkPoin SET stok=stok+'$data[qty]' WHERE idProdukPoin=$data[idProduk]");
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
			
			$query = mysqli_query($conn, "UPDATE transaksipoin SET idOngkir='$_POST[isi]', idKurir='$idKurir' WHERE kdTransaksiPoin='$kdTransaksi'");
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
					if (!file_exists("../gambar/transaksipoin/$kdTransaksi"))
						mkdir("../gambar/transaksipoin/$kdTransaksi", 0777, true);
					$targetFolder = "../gambar/transaksipoin/$kdTransaksi/";
					$targetFile = $targetFolder . basename($_FILES["gambar"]["name"]);
					$tipeGambar = pathinfo($targetFile, PATHINFO_EXTENSION);
					$namaGambar = $targetFolder . $kdTransaksi . "." . $tipeGambar;

					if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $namaGambar)) {
						$query = mysqli_query($conn, "UPDATE transaksipoin SET buktiLampiran='$namaGambar' WHERE kdTransaksiPoin='$kdTransaksi'");
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