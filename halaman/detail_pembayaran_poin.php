<?php
include("../include/_koneksi.php");

$id = $_GET["id"];

$query = mysqli_query($conn, "SELECT * FROM transaksipoin WHERE kdTransaksiPoin='$id'");
$data = mysqli_fetch_assoc($query);
$idKonsumen = $data["idKonsumen"];
$idKurir = $data["idKurir"];
$idOngkir = $data["idOngkir"];
$alamat = "$data[alamat], $data[desa], $data[kec], $data[kab], $data[prov]";
$buktiLampiran = $data["buktiLampiran"];
$noResi = $data["noResi"];
$status = $data["status"];

$query = mysqli_query($conn, "SELECT * FROM ongkir INNER JOIN ongkirkurir ON ongkir.idOK=ongkirkurir.idOK WHERE idOngkir='$idOngkir'");
if (mysqli_num_rows($query) > 0) {
	$data = mysqli_fetch_assoc($query);
	$ongkosKirim = $data["ongkir"];
	$namaOngkir = $data["namaOngkir"];
} else {
	$ongkosKirim = 0;
	$namaOngkir = "-";
}

$query = mysqli_query($conn, "SELECT * FROM kurir WHERE idKurir='$idKurir'");
if (mysqli_num_rows($query) > 0) {
	$data = mysqli_fetch_assoc($query);
	$namaKurir = $data["namaKurir"];
} else
	$namaKurir = "-";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pembayaran</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/font-awesome.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<div class="container-fluid px-0">
		<?php include("_menu.php"); ?>
		<div class="konten">
			<div class="rounded-top bg-white shadow p-5 mx-auto my-5" style="width: 75%; border-bottom: 5px solid teal;">
				<?php if ($_SESSION["akses"] == "Konsumen") { ?>
				<a href="data_transaksi_poin.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
				<?php } elseif ($_SESSION["akses"] == "Admin") { ?>
				<a href="data_order_poin.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
				<?php } ?>
				<h4 class="mb-4">Detail Transaksi Poin</h4>
				<?php
				$query = mysqli_query($conn, "SELECT * FROM konsumen WHERE username='$idKonsumen'");
				$data = mysqli_fetch_assoc($query);
				?>
				<p>Nama: <?php echo $data["nama"]; ?></p>
				<p>Alamat: <?php echo $alamat; ?></p>
				<p>Telepon: +62<?php echo $data["noHp"]; ?></p>
				<p>Email: <?php echo $data["email"]; ?></p>
				<p>Nomor Order: <?php echo $id; ?></p>
				<div class="table-responsive-lg mt-4">
					<table class="table table-sm">
						<thead>
							<tr>
								<th>No</th>
								<th>Produk</th>
								<th>Nama Produk</th>
								<th>Berat</th>
								<th>Qty</th>
								<th>Poin</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$query = mysqli_query($conn, "SELECT * FROM detailtransaksipoin INNER JOIN produkPoin ON detailtransaksipoin.idProduk=produkPoin.idProdukPoin WHERE kdTransaksiPoin='$id' ORDER BY idDetailTransaksiPoin");
							$no = 1;
							$totalPoin = 0;
							$totalBerat = 0;
							while ($data = mysqli_fetch_assoc($query)) {
								$berat = $data["berat"] * $data["qty"];
								$totalPoin += $data["jumlah"];
								$totalBerat += $berat;
								
								echo "<tr>
								<td>$no</td>
								<td><img style='width: 100px; height: 100px; object-fit: cover;' src='$data[gambar]'></td>
								<td>$data[namaProduk]</td>
								<td>" . konversiBerat($data["berat"]) . "</td>
								<td>$data[qty]</td>
								<td>" . number_format($data["jumlahPoin"], 0, ".", ".") . " poin</td>
								<td>" . number_format($data["jumlah"], 0, ".", ".") . " poin</td>
								</tr>";
								$no++;
							}
							$totalOngkir = ceil($totalBerat / 1000) * $ongkosKirim;
							$grandTotal = $totalOngkir;
							?>
						</tbody>
					</table>
				</div>
				<div class="clearfix">
					<div class="float-right font-weight-bold" style="width: 50%;">
						<p>Total: <span class="float-right" id="totalHarga">Rp 0</span></p>
						<p>Ongkos Kirim: <span class="float-right" id="ongkosKirim">Rp <?php echo number_format($ongkosKirim, 0, ".", "."); ?></span></p>
						<p>Total Berat: <span class="float-right" id="totalBerat"><?php echo konversiBerat($totalBerat); ?></span></p>
						<p>Total Ongkos Kirim: <span class="float-right" id="totalOngkir">Rp <?php echo number_format($totalOngkir, 0, ".", "."); ?></span></p>
						<p>Grand Total: <span class="float-right" id="grandTotal">Rp <?php echo number_format($grandTotal, 0, ".", "."); ?></span></p>
						<p>Penggunaan Poin: <span class="float-right" id="gunaPoin"><?php echo $totalPoin; ?> poin</span></p>
					</div>
				</div>
				<?php
				if ($noResi == 0)
					$noResi = "-";
				?>
				<p>Nomor Resi: <?php echo $noResi; ?></p>
				<p>Jasa Pengiriman: <?php echo "$namaKurir - $namaOngkir (Rp " . number_format($ongkosKirim, 0, ".", ".") . "/kg)"; ?></p>
				
				<div class="row">
					<div class="col">
						<?php
						switch($status) {
							case "proses":
								if ($_SESSION["akses"] == "Admin") {
									$hiddenKonfirmasi = "";
									$hiddenTolak = "";
									$hiddenKirim = "hidden";
									$hiddenTerima = "hidden";
									$hiddenRetur = "hidden";
								} elseif ($_SESSION["akses"] == "Konsumen") {
									$hiddenKonfirmasi = "hidden";
									$hiddenTolak = "hidden";
									$hiddenKirim = "hidden";
									$hiddenTerima = "hidden";
									$hiddenRetur = "hidden";
								}
								break;
								
							case "dikonfirmasi":
								if ($_SESSION["akses"] == "Admin") {
									$hiddenKonfirmasi = "hidden";
									$hiddenTolak = "hidden";
									$hiddenKirim = "";
									$hiddenTerima = "hidden";
									$hiddenRetur = "hidden";
								} elseif ($_SESSION["akses"] == "Konsumen") {
									$hiddenKonfirmasi = "hidden";
									$hiddenTolak = "hidden";
									$hiddenKirim = "hidden";
									$hiddenTerima = "hidden";
									$hiddenRetur = "hidden";
								}
								break;
								
							case "dikirim":
								if ($_SESSION["akses"] == "Admin") {
									$hiddenKonfirmasi = "hidden";
									$hiddenTolak = "hidden";
									$hiddenKirim = "hidden";
									$hiddenTerima = "hidden";
									$hiddenRetur = "hidden";
								} elseif ($_SESSION["akses"] == "Konsumen") {
									$hiddenKonfirmasi = "hidden";
									$hiddenTolak = "hidden";
									$hiddenKirim = "hidden";
									$hiddenTerima = "";
									$hiddenRetur = "hidden";
								}
								break;
								
							case "selesai":
								if ($_SESSION["akses"] == "Admin") {
									$hiddenKonfirmasi = "hidden";
									$hiddenTolak = "hidden";
									$hiddenKirim = "hidden";
									$hiddenTerima = "hidden";
									$hiddenRetur = "hidden";
								} elseif ($_SESSION["akses"] == "Konsumen") {
									$hiddenKonfirmasi = "hidden";
									$hiddenTolak = "hidden";
									$hiddenKirim = "hidden";
									$hiddenTerima = "hidden";
									$hiddenRetur = "";
								}
								break;
								
							default:
								$hiddenKonfirmasi = "hidden";
								$hiddenTolak = "hidden";
								$hiddenKirim = "hidden";
								$hiddenTerima = "hidden";
								$hiddenRetur = "hidden";
						}
						?>
						<button type="button" class="tombol tombol-teal" id="tombolKonfirmasi" <?php echo $hiddenKonfirmasi; ?>>Konfirmasi</button>
						<button type="button" class="tombol tombol-red" id="tombolTolak" <?php echo $hiddenTolak; ?>>Tolak</button>
						<button type="button" class="tombol tombol-teal" id="tombolKirim" <?php echo $hiddenKirim; ?>>Kirim</button>
						<button type="button" class="tombol tombol-teal" id="tombolTerima" <?php echo $hiddenTerima; ?>>Terima</button>
						<div class="helper" style="display: inline-block;">
							<div class="dot-pulse" style="display: inline-block; margin: 0 20px;" hidden></div>
							<span></span>
						</div>
					</div>
				</div>
				<div class="row formKirim mt-3" hidden>
					<div class="col">
						<label for="noResi">No. Resi</label>
						<input type="text" class="form-control" id="noResi" name="noResi">
						<button type="submit" class="tombol tombol-teal mt-2" id="submitKirim">Submit</button>
						<div class="helperKirim" style="display: inline-block;">
							<div class="dot-pulse" style="display: inline-block; margin: 0 20px;" hidden></div>
							<span></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include("_footer.php"); ?>
	</div>
  <script src="../js/jquery-3.3.1.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.js"></script>
  <script src="../js/font-awesome.js"></script>
  <script src="../js/misc.js"></script>
</body>
</html>

<script>
	$("#tombolKonfirmasi").on("click", function() {
		$("button").prop("disabled", true);
		$(".helper div").prop("hidden", false);
		$(".helper span").html("");
		updateTransaksiPoin("pembayaran", <?php echo $grandTotal; ?>);
		updateTransaksiPoin("status", "dikonfirmasi");
	});
	$("#tombolTolak").on("click", function() {
		$("button").prop("disabled", true);
		$(".helper div").prop("hidden", false);
		$(".helper span").html("");
		updateTransaksiPoin("status", "ditolak");
	});
	$("#tombolKirim").on("click", function() {
		$(".formKirim").prop("hidden", false);
	});
	$("#tombolTerima").on("click", function() {
		$("button").prop("disabled", true);
		$(".helper div").prop("hidden", false);
		$(".helper span").html("");
		updateTransaksiPoin("status", "selesai");
	});
	$("#tombolRetur").on("click", function() {
		$(".formRetur").prop("hidden", false);
	});
	$("#submitKirim").on("click", function() {
		$("button").prop("disabled", true);
		updateTransaksiPoin("noResi", $("#noResi").val());
		updateTransaksiPoin("status", "dikirim");
	});
	
	function updateTransaksiPoin(field, isi) {
		$.ajax({
			url: "../include/updateTransaksiPoin.php",
			type: "POST",
			data: {
				kdTransaksi: "<?php echo $id; ?>",
				field: field,
				isi: isi
			},
			dataType: "JSON",
			success: function (respon) {
				$("button").prop("disabled", false);
				$(".helper div").prop("hidden", true);
				if (respon.status == "Berhasil") {
					$("button").prop("hidden", true);
					if (isi == "dikonfirmasi") {
						$("#tombolKirim").prop("hidden", false);
						$("#submitKirim").prop("hidden", false);
					}
					$(".helper span").css("color", "green");
					$(".helper span").html("Pesanan berhasil " + isi);
				} else if (respon.status != "Berhasil poin" && respon.status != "Berhasil") {
					$(".helper span").css("color", "red");
					$(".helper span").html(respon.status);
				}
			}
		});
	}
</script>