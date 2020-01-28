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
		case "bayar":
			if ($valid) {
				$query = mysqli_query($conn, "SELECT * FROM tblorder INNER JOIN produk ON tblorder.idProduk=produk.idProduk WHERE kdTransaksi='$kdTransaksi' ORDER BY idOrder");
				$no = 0;
				while ($data = mysqli_fetch_assoc($query)) {
					$harga = $data["harga"];
					$jumlah = $qty[$no] * $harga;

					$queryUpdate = mysqli_query($conn, "UPDATE tblorder SET qty='$qty[$no]', jumlah='$jumlah' WHERE idProduk='$data[idProduk]' AND kdTransaksi='$kdTransaksi'");
					if ($queryUpdate)
						$respon["status"] = "Berhasil";
					else
						$respon["status"] = "Gagal memperbarui order";
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