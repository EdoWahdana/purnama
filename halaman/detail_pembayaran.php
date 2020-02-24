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
									$hiddenDesain = "";
								} elseif ($_SESSION["akses"] == "Konsumen") {
									$hiddenKonfirmasi = "hidden";
									$hiddenTolak = "hidden";
									$hiddenKirim = "hidden";
									$hiddenTerima = "hidden";
									$hiddenRetur = "hidden";
									$hiddenDesain = "hidden";
								}
								break;
								
							case "dikonfirmasi":
								if ($_SESSION["akses"] == "Admin") {
									$hiddenKonfirmasi = "hidden";
									$hiddenTolak = "hidden";
									$hiddenKirim = "";
									$hiddenTerima = "hidden";
									$hiddenRetur = "hidden";
									$hiddenDesain = "hidden";
								} elseif ($_SESSION["akses"] == "Konsumen") {
									$hiddenKonfirmasi = "hidden";
									$hiddenTolak = "hidden";
									$hiddenKirim = "hidden";
									$hiddenTerima = "hidden";
									$hiddenRetur = "hidden";
									$hiddenDesain = "hidden";
								}
								break;
								
							case "dikirim":
								if ($_SESSION["akses"] == "Admin") {
									$hiddenKonfirmasi = "hidden";
									$hiddenTolak = "hidden";
									$hiddenKirim = "hidden";
									$hiddenTerima = "hidden";
									$hiddenRetur = "hidden";
									$hiddenDesain = "hidden";
								} elseif ($_SESSION["akses"] == "Konsumen") {
									$hiddenKonfirmasi = "hidden";
									$hiddenTolak = "hidden";
									$hiddenKirim = "hidden";
									$hiddenTerima = "";
									$hiddenRetur = "hidden";
									$hiddenDesain = "hidden";
								}
								break;
								
							case "selesai":
								if ($_SESSION["akses"] == "Admin") {
									$hiddenKonfirmasi = "hidden";
									$hiddenTolak = "hidden";
									$hiddenKirim = "hidden";
									$hiddenTerima = "hidden";
									$hiddenRetur = "hidden";
									$hiddenDesain = "hidden";
								} elseif ($_SESSION["akses"] == "Konsumen") {
									$hiddenKonfirmasi = "hidden";
									$hiddenTolak = "hidden";
									$hiddenKirim = "hidden";
									$hiddenTerima = "hidden";
									$hiddenRetur = "";
									$hiddenDesain = "hidden";
								}
								break;
								
							default:
								$hiddenKonfirmasi = "hidden";
								$hiddenTolak = "hidden";
								$hiddenKirim = "hidden";
								$hiddenTerima = "hidden";
								$hiddenRetur = "hidden";
								$hiddenDesain = "hidden";
						}
						?>

						<hr style="height:1px;border:none;color:#000;background-color:#000;" <?php echo $hiddenDesain; ?>/>

						<p <?php echo $hiddenDesain; ?>> *Disarankan upload desain satu persatu </p>

						<div class="row mb-5">
							<div class="col-6">
								<!-- Form untuk upload gambar yang telah dibuat oleh admin -->
								<form enctype="multipart/form-data" id="formUpload" <?php echo $hiddenDesain; ?>>
									<div class="row mb-3">
										<div class="col-lg-12">
											<label class="border text-center w-100" style="max-height: 300px; cursor: pointer;" id="pilihGambar">
												<div class="py-5 text-muted">
													<i class="fas fa-upload fa-5x"></i>
													<i class="fas fa-plus fa-2x" style="position: absolute;"></i><br>
													<span>Upload Desain yang telah dibuat</span>
												</div>
												<input type="file" name="gambar[]" id="gambar" multiple hidden>
												<input type="text" name="kdTransaksi" id="kdTransaksiText" hidden>
											</label>
											<div id="preview-image"></div>
										</div>
									</div>
				                    <div class="row text-center">
										<div class="col-lg-12">
											<div class="helper text-center my-3" style="display: inline-block;">
												<span></span>
											</div>
											<button type="submit" class="tombol tombol-pale text-center" id="tombolUpload">Upload Desain</button>
										</div>
									</div>
								</form>
							</div>

							<div class="col-6" id="col-gallery" <?php echo $hiddenDesain; ?>>
						        <div class="text-center" id="gallery">
						        	<div class="jumbotron">
							        	<p class="h5 text-muted">DESAIN YANG TELAH DIUPLOAD</p>
							        	<!-- Query untuk menampilkan gambar berdasarkan KDTRANSAKSI -->
										<?php 
											$queryDesainAdmin = mysqli_query($conn, "SELECT * FROM desainadmin WHERE kdTransaksi='$id'");
												if(mysqli_num_rows($queryDesainAdmin) > 0) {
													while($desainAdmin = mysqli_fetch_assoc($queryDesainAdmin)) {
														echo "
															<a href='masukan_desain_admin.php?id=$desainAdmin[idDesainAdmin]'>
																<img src='../gambar/desainAdmin/$desainAdmin[desain]' width='150px' height='100px' style='margin:15px 15px 0 0; padding:8px; border:1px solid #ccc;' />
															</a>
															";
													}
												}
										?>					
									</div>	        	
						        </div>
							</div>
						</div>

						<hr style="height:1px;border:none;color:#000;background-color:#000;" <?php echo $hiddenDesain; ?>/>

						<label class="border text-center w-100" <?php echo $hiddenDesain; ?>>
							<?php
							if ($buktiLampiran == "") {
								$hiddenDiv = "";
								$hiddenImg = "hidden";
							} else {
								$hiddenDiv = "hidden";
								$hiddenImg = "";
							}
							?>
							<div class="py-5 text-muted" <?php echo $hiddenDiv; ?>>
								<i class="fas fa-image fa-5x"></i><br>
								<span>Tidak Ada Bukti Pembayaran dari Konsumen</span>
							</div>
							<img class="w-100" src="<?php echo $buktiLampiran; ?>" <?php echo $hiddenImg; ?>>
						</label>

						<hr style="height:1px;border:none;color:#000;background-color:#000;" <?php echo $hiddenDesain; ?>/>

						<button type="button" class="tombol tombol-teal" id="tombolKonfirmasi" <?php echo $hiddenKonfirmasi; ?>>Konfirmasi</button>
						<button type="button" class="tombol tombol-red" id="tombolTolak" <?php echo $hiddenTolak; ?>>Tolak</button>
						<button type="button" class="tombol tombol-teal" id="tombolKirim" <?php echo $hiddenKirim; ?>>Kirim</button>
						<button type="button" class="tombol tombol-teal" id="tombolTerima" <?php echo $hiddenTerima; ?>>Terima</button>
						<button type="button" class="tombol tombol-red" id="tombolRetur" <?php echo $hiddenRetur; ?>>Retur</button>
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
				<div class="row formRetur mt-3" hidden>
					<div class="col">
						<form enctype="multipart/form-data" id="formRetur">
							<label for="alasan">Alasan</label>
							<textarea class="form-control" name="alasan" id="alasan" rows="5" placeholder="Berikan alasan retur"></textarea>
							<label class="border text-center w-100" style="cursor: pointer;" id="pilihGambarRetur">
								<div class="py-5 text-muted">
									<i class="fas fa-image fa-5x"></i>
									<i class="fas fa-plus fa-2x" style="position: absolute;"></i><br>
									<span>Upload Bukti</span>
								</div>
								<img class="w-100" src="#" hidden>
								<input type="file" name="gambarRetur" id="gambarRetur" hidden>
							</label>
							<button type="submit" class="tombol tombol-teal" id="submitRetur">Submit</button>
							<div class="helperRetur" style="display: inline-block;">
								<div class="dot-pulse" style="display: inline-block; margin: 0 20px;" hidden></div>
								<span></span>
							</div>
						</form>
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

	// Fungsi untuk mengambil value dari parameten URL
	$.urlParam = function(paramName) {
		var result = new RegExp('[\?&]' + paramName + '=([^&#]*)').exec(window.location.href);
		return result[1] || 0;
	}

	//Membuat variabel untuk menampung idOrder pada parameter URL
	var kdTransaksi = $.urlParam("id");
	$("#kdTransaksiText").val(kdTransaksi);

	//Saat klik div pilihGambar akan melakukan klik pada input type file juga
	$("#pilihGambar").on("click", function() {
		$("#gambar").click();
	});

	//Fungsi untuk menampilkan gambar yang telah dipilih 
		var imagesPreview = function(input, placeToPreview) {
			if(input.files) {
				var filesAmount = input.files.length;

				for(i=0; i<filesAmount; i++) {
					var reader = new FileReader();
					reader.onload = function(e) {
						$($.parseHTML("<img class='img-thumbnail mx-2' width='200'>")).attr("src", e.target.result).appendTo(placeToPreview);
					}

					reader.readAsDataURL(input.files[i]);
				}
			}
		};

	$("#gambar").on("change", function() {
		imagesPreview(this, $('#preview-image'));
		$('#pilihGambar').attr('hidden', true);
	});

	//Fungsi untuk melakukan upload saat button UPload Desain diklik
	$("#tombolUpload").on("click", function() {
		$("#formUpload").submit( function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url: "../include/uploadDesainAdmin.php",
				type: "POST",
				data: formData,
				contentType: false,
				cache: false,
				processData: false,
				dataType: "JSON",
				success: function(respon) {
					if(respon.status == "Berhasil") {
						window.location.reload();
					} else {
						$(".helper span").css("color", "red");
						$(".helper span").html(respon.status);
					}
				}, 
				error: function(XMLHttpRequest, respon, error) {
					$(".helper span").css("color", "blue");
					$(".helper span").html(error);

				}
			});
		});
	});



	$("#tombolKonfirmasi").on("click", function() {
		$("button").prop("disabled", true);
		$(".helper div").prop("hidden", false);
		$(".helper span").html("");
		updateTransaksi("pembayaran", <?php echo $grandTotal; ?>);
		updateTransaksi("status", "dikonfirmasi");
	});
	$("#tombolTolak").on("click", function() {
		$("button").prop("disabled", true);
		$(".helper div").prop("hidden", false);
		$(".helper span").html("");
		updateTransaksi("status", "ditolak");
	});
	$("#tombolKirim").on("click", function() {
		$(".formKirim").prop("hidden", false);
	});
	$("#tombolTerima").on("click", function() {
		$("button").prop("disabled", true);
		$(".helper div").prop("hidden", false);
		$(".helper span").html("");
		updateTransaksi("status", "selesai");
	});
	$("#tombolRetur").on("click", function() {
		$(".formRetur").prop("hidden", false);
	});
	$("#tombolUpload").on("click", function() {

	});
	$("#submitKirim").on("click", function() {
		$("button").prop("disabled", true);
		updateTransaksi("noResi", $("#noResi").val());
		updateTransaksi("status", "dikirim");
	});
	$("#submitRetur").on("click", function() {
		$("button").prop("disabled", true);
		$(".helperRetur div").prop("hidden", false);
		$(".helperRetur span").html("");
		inputRetur();
	});
	$("#pilihGambarRetur").on("click", function() {
		$("#gambarRetur").click();
	});
	
	$("#gambarRetur").on("change", function() {
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$("#pilihGambarRetur img").prop("src", e.target.result);
				$("#pilihGambarRetur img").prop("hidden", false);
				$("#pilihGambarRetur div").prop("hidden", true);
			}
			reader.readAsDataURL(this.files[0]);
		}
	});
	
	function inputRetur() {
		var formData = new FormData($("#formRetur")[0]);
		formData.append("kdTransaksi", "<?php echo $id; ?>");
		$.ajax({
			url: "../include/inputRetur.php",
			type: "POST",
			data: formData,
			dataType: "JSON",
			contentType: false,
			cache: false,
			processData: false,
			success: function (respon) {
				$("button").prop("disabled", false);
				$(".helperRetur div").prop("hidden", true);
				if (respon.status == "Berhasil") {
					$("button").prop("hidden", true);
					$(".helperRetur span").css("color", "green");
					$(".helperRetur span").html("Retur pesanan segera diproses");
					updateTransaksi("status", "retur");
				} else if (respon.status != "Proses" && respon.status != "Berhasil") {
					$(".helperRetur span").css("color", "red");
					$(".helperRetur span").html(respon.status);
				}
			}
		});
	}
	function updateTransaksi(field, isi) {
		$.ajax({
			url: "../include/updateTransaksi.php",
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
				} else if (respon.status == "Berhasil poin") {
					$("button").prop("hidden", true);
					$("#tombolRetur").prop("hidden", false);
					$("#submitRetur").prop("hidden", false);
					$(".helper span").css("color", "green");
					$(".helper span").html("Pesanan berhasil diterima, selamat anda mendapatkan " + respon.poin + " poin");
				} else if (respon.status != "Berhasil poin" && respon.status != "Berhasil") {
					$(".helper span").css("color", "red");
					$(".helper span").html(respon.status);
				}
			}
		});
	}
</script>