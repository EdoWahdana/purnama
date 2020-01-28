<?php
include("_koneksi.php");

$kdTransaksi = $_POST["kdTransaksi"];
$case = $_POST["case"];
$qty = $_POST["qty"];
$valid = true;

if ($kdTransaksi == "")
	$respon["status"] = "Anda belum memesan apapun";
elseif ($case == "")
	$respon["status"] = "Tidak valid";
else {
	foreach ($qty as $q) {
		if (!ctype_digit($q)) {
			$valid = false;
			$respon["status"] = "Qty harus angka";
		}
	}
	
	switch($case) {
		case "tukar":
			if ($valid) {
				$query = mysqli_query($conn, "SELECT * FROM detailtransaksipoin INNER JOIN produkPoin ON detailtransaksipoin.idProduk=produkPoin.idProdukPoin WHERE kdTransaksiPoin='$kdTransaksi' ORDER BY idDetailTransaksiPoin");
				$no = 0;
				while ($data = mysqli_fetch_assoc($query)) {
					$jumlahPoin = $data["jumlahPoin"];
					$jumlah = $qty[$no] * $jumlahPoin;

					$queryUpdate = mysqli_query($conn, "UPDATE detailtransaksipoin SET qty='$qty[$no]', jumlah='$jumlah' WHERE idProduk='$data[idProduk]' AND kdTransaksiPoin='$kdTransaksi'");
					if ($queryUpdate)
						$respon["status"] = "Berhasil";
					else
						$respon["status"] = "Gagal memperbarui detail transaksi poin";
					$no++;
				}
			}
			
			break;
		default:
			$respon["status"] = "Invalid";
	}
}

echo json_encode($respon);
?>