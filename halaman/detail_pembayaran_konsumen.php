<?php
include("../include/_koneksi.php");

$id = $_GET["id"];

$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE kdTransaksi='$id'");
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
  <link rel="stylesheet" href="../css/modal-lightbox.css">
</head>
<body>
	<div class="container-fluid px-0">
		<?php include("_menu.php"); ?>
		<div class="konten">
			<div class="rounded-top bg-white shadow p-5 mx-auto my-5" style="width: 85%; border-bottom: 5px solid teal;">
				<?php if ($_SESSION["akses"] == "Konsumen") { ?>
				<a href="data_transaksi.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
				<?php } elseif ($_SESSION["akses"] == "Admin") { ?>
				<a href="data_order.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
				<?php } ?>
				<h4 class="mb-4">Detail Transaksi</h4>
				<?php
				$query = mysqli_query($conn, "SELECT * FROM konsumen WHERE username='$idKonsumen'");
				$data = mysqli_fetch_assoc($query);
				?>
				<p>Nama: <?php echo $data["nama"]; ?></p>
				<p>Alamat: <?php echo $alamat; ?></p>
				<p>Telepon: +62<?php echo $data["noHp"]; ?></p>
				<p>Email: <?php echo $data["email"]; ?></p>
				<p>Nomor Order: <?php echo $id; ?></p>
				<table border="0">
				<tr>
				<td>Silahkan melakukan pembayaran melalui BANK Transfer dibawah ini :</td>
				</tr>
					<tr> 
							
					</tr>
					<tr>
					<td><img src="../gambar/BRI.png">
					No.Rek : 430xxxxxx
					a/n Nama Agung Kurniawan</td>
					</tr>
				</table>
				
				
				<div id="fieldData" hidden>
						<div class="row mb-3">
							<div class="col-lg-3">
								<label for="alamat" class="mt-lg-1">Alamat</label>
							</div>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="alamatLengkap" name="alamatLengkap" value="<?php echo $alamat; ?>">
							</div>
						</div>
						
						
						
						
						<button type="button" class="tombol tombol-teal" id="ubahAlamat">OK</button>
				</div>	
				
				<div class="table-responsive-lg mt-4">
					<table class="table table-sm text-center">
						<thead>
							<tr>
								<th>No</th>
								<th>Produk</th>
								<th>Nama Produk</th>
								<th>Berat</th>
								<th>Qty</th>
								<th>Harga</th>
								<th>Total</th>
								<th>Desain Konsumen</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$query = mysqli_query($conn, "SELECT * FROM tblorder INNER JOIN produk ON tblorder.idProduk=produk.idProduk WHERE kdTransaksi='$id' ORDER BY idOrder");
							$no = 1;
							$totalHarga = 0;
							$totalBerat = 0;
							while ($data = mysqli_fetch_assoc($query)) {
								$berat = $data["berat"] * $data["qty"];
								$totalHarga += $data["jumlah"];
								$totalBerat += $berat;
								
								echo "<tr>
								<td>$no</td>
								<td><img style='width: 100px; height: 100px; object-fit: cover;' src='$data[gambar]'></td>
								<td>$data[namaProduk]</td>
								<td>" . konversiBerat($data["berat"]) . "</td>
								<td>$data[qty]</td>
								<td>Rp " . number_format($data["harga"], 0, ".", ".") . "</td>
								<td>Rp " . number_format($data["jumlah"], 0, ".", ".") . "</td>";

								//Query untuk menampilkan tombol download gambar
								$gambarquery = mysqli_query($conn, "SELECT desain FROM gambardesain WHERE idOrder='$data[idOrder]'");
								if(mysqli_num_rows($gambarquery) > 0) {
									echo "<td>";
									while($gambar = mysqli_fetch_assoc($gambarquery)) {
										echo "<small class='mx-3'><a href='../gambar/desainOrder/$gambar[desain]' class='badge badge-success' download>Download Desain <i class='fas fa-download'></i> </a></small>";
									}
									echo "</td>";
								}

								echo "</tr>";
								$no++;
							}
							$totalOngkir = ceil($totalBerat / 1000) * $ongkosKirim;
							$grandTotal = $totalHarga + $totalOngkir;
							?>
						</tbody>
					</table>
				</div>
				<div class="clearfix">
					<div class="float-right font-weight-bold" style="width: 50%;">
						<p>Total: <span class="float-right" id="totalHarga">Rp <?php echo number_format($totalHarga, 0, ".", "."); ?></span></p>
						<p>Ongkos Kirim: <span class="float-right" id="ongkosKirim">Rp <?php echo number_format($ongkosKirim, 0, ".", "."); ?></span></p>
						<p>Total Berat: <span class="float-right" id="totalBerat"><?php echo konversiBerat($totalBerat); ?></span></p>
						<p>Total Ongkos Kirim: <span class="float-right" id="totalOngkir">Rp <?php echo number_format($totalOngkir, 0, ".", "."); ?></span></p>
						<p>Grand Total: <span class="float-right" id="grandTotal">Rp <?php echo number_format($grandTotal, 0, ".", "."); ?></span></p>
						<p>Penggunaan Poin: <span class="float-right" id="gunaPoin">0</span></p>
					</div>
				</div>
				<?php
				if ($noResi == 0)
					$noResi = "-";
				?>
				<p>Nomor Resi: <?php echo $noResi; ?></p>
				<p>Jasa Pengiriman: <?php echo "$namaKurir - $namaOngkir (Rp " . number_format($ongkosKirim, 0, ".", ".") . "/kg)"; ?></p>
				
				<hr style="height:1px;border:none;color:#000;background-color:#000;" />

				<p class="text-center text-muted h2 mb-3"> DESAIN YANG TELAH DIBUAT  </p>

				<div class="row">								
					<!-- Query untuk menampilkan gambar berdasarkan KDTRANSAKSI -->
					<?php 
						$queryDesainAdmin = mysqli_query($conn, "SELECT * FROM desainadmin WHERE kdTransaksi='$id'");
						if(mysqli_num_rows($queryDesainAdmin) > 0) {
							while($desainAdmin = mysqli_fetch_assoc($queryDesainAdmin)) {
								echo "
								<div class='col-lg-4  text-center'>
									<div class='card' style='width: 18rem;'>
									  <img class='card-img-top img-fluid img-thumbnail' src='../gambar/desainAdmin/$desainAdmin[desain]' >
									  <div class='card-body'>
									    <a href='masukan_desain_admin.php?id=$desainAdmin[idDesainAdmin]' class='tombol tombol-teal'> Beri Masukan </a>
									  </div>
									</div>
								</div>
								";
								//echo "<img src='../gambar/desainAdmin/$desainAdmin[desain]' width='300px' height='200px' class='img-thumbnail mx-3 pb-3 pt-3' /> ";
								//echo "<a href='' class='tombol tombol-teal mt-2'> Beri Masukan </a>";
							}
						} else {
							echo "<p class='text-center text-muted mb-3'> *Belum ada desain yang dibuat</p>";	
						}
					?>				        			
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

	// Fungsi untuk mengambil value dari parameten URL
	$.urlParam = function(paramName) {
		var result = new RegExp('[\?&]' + paramName + '=([^&#]*)').exec(window.location.href);
		return result[1] || 0;
	}

	//Membuat variabel untuk menampung idOrder pada parameter URL
	var kdTransaksi = $.urlParam("id");
	$("#kdTransaksiText").val(kdTransaksi);

	
</script>