<?php
include("../include/_koneksi.php");

$id = $_GET["id"];

$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE kdTransaksi='$id'");
$data = mysqli_fetch_assoc($query);
$idKurir = $data["idKurir"];
$idOngkir = $data["idOngkir"];
$buktiLampiran = $data["buktiLampiran"];

$query = mysqli_query($conn, "SELECT * FROM ongkir WHERE idOngkir='$idOngkir'");
if (mysqli_num_rows($query) > 0) {
	$data = mysqli_fetch_assoc($query);
	$ongkosKirim = $data["ongkir"];
} else
	$ongkosKirim = 0;
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
				<h4 class="mb-4">Data Transaksi</h4>
				<?php
				$query = mysqli_query($conn, "SELECT * FROM konsumen WHERE username='$_SESSION[username]'");
				$data = mysqli_fetch_assoc($query);
				$alamat = $data["alamat"];
				$desa = $data["desa"];
				$kecamatan = $data["kec"];
				$kabupaten = $data["kab"];
				$provinsi = $data["provinsi"];
				$alamatLengkap = "$data[alamat], $data[desa], $data[kec], $data[kab], $data[provinsi]";
				?>
				<p>Nama: <?php echo $data["nama"]; ?></p>
				<p>Alamat: <span id="alamat"><?php echo "$alamatLengkap"; ?></span><br>
                
                    <button class="tombol tombol-teal mt-2" id="ubah">Ubah Alamat</button>
                    <div id="fieldAlamat" hidden>
						<div class="row mb-3">
							<div class="col-lg-3">
								<label for="alamat" class="mt-lg-1">Alamat</label>
							</div>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="alamatLengkap" name="alamatLengkap" value="<?php echo $alamat; ?>">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-lg-3">
								<label for="desa" class="mt-lg-1">Desa</label>
							</div>
							<div class="col-lg-9">
								<input type="text" class="form-control" id="desa" name="desa" value="<?php echo $desa; ?>">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-lg-3">
								<label for="kecamatan" class="mt-lg-1">Kecamatan</label>
							</div>
							<div class="col-lg-9">
								<select class="form-control" id="kecamatan" name="kecamatan" required>
									<?php
									$query = mysqli_query($conn, "SELECT DISTINCT(kec) FROM ongkir WHERE kab='$kabupaten' AND prov='$provinsi'");
									while ($data = mysqli_fetch_assoc($query)) {
										if ($data["kec"] == $kecamatan)
											$select = "selected";
										else
											$select = "";
										echo "<option value='$data[kec]' $select>$data[kec]</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-lg-3">
								<label for="kabupaten" class="mt-lg-1">Kabupaten</label>
							</div>
							<div class="col-lg-9">
								<select class="form-control" id="kabupaten" name="kabupaten" required>
									<?php
									$query = mysqli_query($conn, "SELECT DISTINCT(kab) FROM ongkir WHERE prov='$provinsi'");
									while ($data = mysqli_fetch_assoc($query)) {
										if ($data["kab"] == $kabupaten)
											$select = "selected";
										else
											$select = "";
										echo "<option value='$data[kab]' $select>$data[kab]</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-lg-3">
								<label for="provinsi" class="mt-lg-1">Provinsi</label>
							</div>
							<div class="col-lg-9">
								<select class="form-control" id="provinsi" name="provinsi" required>
									<?php
									$query = mysqli_query($conn, "SELECT DISTINCT(prov) FROM ongkir");
									while ($data = mysqli_fetch_assoc($query)) {
										if ($data["prov"] == $provinsi)
											$select = "selected";
										else
											$select = "";
										echo "<option value='$data[prov]'>$data[prov]</option>";
									}
									?>
								</select>
							</div>
						</div>
						<button type="button" class="tombol tombol-teal" id="ubahAlamat">OK</button>
					</div>
				</p>               
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
								<th>Harga</th>
								<th>Total</th>
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
								<td>Rp " . number_format($data["jumlah"], 0, ".", ".") . "</td>
								</tr>";
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
						<p>Total Berat: <span class="float-right" id="totalBerat"><?php echo konversiBerat($totalBerat); ?> </span></p>
						<p>Total Ongkos Kirim: <span class="float-right" id="totalOngkir">Rp <?php echo number_format($totalOngkir, 0, ".", "."); ?></span></p>
						<p>Grand Total: <span class="float-right" id="grandTotal">Rp <?php echo number_format($grandTotal, 0, ".", "."); ?></span></p>
						<p>Penggunaan Poin: <span class="float-right" id="gunaPoin">0 poin</span></p>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<select class="form-control" id="kurir" name="kurir">
							<?php
							$query = mysqli_query($conn, "SELECT * FROM ongkir INNER JOIN kurir ON ongkir.idKurir=kurir.idKurir WHERE kec='$kecamatan' AND kab='$kabupaten' AND prov='$provinsi' GROUP BY ongkir.idKurir");
							if (mysqli_num_rows($query) > 0) {
								while ($data = mysqli_fetch_assoc($query)) {
									if ($data["idKurir"] == $idKurir)
										$selected = "selected";
									else
										$selected = "";
									echo "<option value='$data[idKurir]' $selected>$data[namaKurir]</option>";
								}
							} else
							echo "<option value='0'>Tidak ada kurir</option>";
							?>
						</select>
					</div>
					<div class="col">
						<select class="form-control" id="ongkir" name="ongkir">
							<?php
							$query = mysqli_query($conn, "SELECT * FROM ongkir INNER JOIN ongkirkurir ON ongkir.idOK=ongkirkurir.idOK WHERE ongkir.idKurir='$idKurir' AND kec='$kecamatan' AND kab='$kabupaten' AND prov='$provinsi'");
							if (mysqli_num_rows($query) > 0) {
								while ($data = mysqli_fetch_assoc($query)) {
									if ($data["idOngkir"] == $idOngkir)
										$selected = "selected";
									else
										$selected = "";
									echo "<option value='$data[idOngkir]' $selected>$data[namaOngkir] (Rp " . number_format($data["ongkir"], 0, ".", ".") . ")</option>";
								}
							} else
							echo "<option value='0'>Tidak ada ongkos kirim</option>";
							?>
						</select>
					</div>
				</div>
				
				<div class="text-right mt-5">
					<div class="helper text-left" style="display: inline-block;">
						<div class="dot-pulse" style="display: inline-block; margin: 0 20px;" hidden></div>
						<span></span>
					</div>
					<button type="button" class="tombol tombol-teal" id="submitBayar">Proses Pembayaran</button>
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
	var idKurir = <?php echo $idKurir; ?>;
	var totalHarga = <?php echo $totalHarga; ?>;
	var totalBerat = <?php echo $totalBerat; ?>;
	var ongkosKirim = <?php echo $ongkosKirim; ?>;
	var totalOngkir = <?php echo $totalOngkir; ?>;
	var grandTotal = <?php echo $grandTotal; ?>;
	
	$("#ubah").on("click", function() {
		$("#fieldAlamat").prop("hidden", false);
	});
	$("#ubahAlamat").on("click", function() {
		if ($("#alamatLengkap").val() != "" && $("#desa").val() != "")
			$("#alamat").text($("#alamatLengkap").val() + ", " + $("#desa").val() + ", " + $("#kecamatan").val() + ", " + $("#kabupaten").val() + ", " + $("#provinsi").val());
		$("#fieldAlamat").prop("hidden", true);
	});
	
	$("#submitBayar").on("click", function() {
		if ($("#gambar").val() != "") {
			$(this).prop("disabled", true);
			$(".helper div").prop("hidden", false);
			$(".helper span").html("");
			updateTransaksi("status", "proses");
		} else {
			$(".helper span").css("color", "red");
			$(".helper span").html("Upload bukti pembayaran terlebih dahulu");
		}
	});
	$("#pilihGambar").on("click", function() {
		$("#gambar").click();
	});
	
	$("#gambar").on("change", function() {
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$("#pilihGambar img").prop("src", e.target.result);
				$("#pilihGambar img").prop("hidden", false);
				$("#pilihGambar div").prop("hidden", true);
				uploadBukti();
			}
			reader.readAsDataURL(this.files[0]);
		}
	});
	
	$("#provinsi").on("change keyup", function() {
		getKab($(this).val());
	});
	$("#kabupaten").on("change keyup", function() {
		getKec($(this).val());
	});
	$("#kecamatan").on("change keyup", function() {
		getKurir($("#kecamatan").val(), $("#kabupaten").val(), $("#provinsi").val());
	});
	$("#kurir").on("change keyup", function() {
		getOngkir();
	});
	$("#ongkir").on("change keyup", function() {
		$.ajax({
			url: "../include/getOngkirHarga.php",
			type: "POST",
			data: {id: $("#ongkir").val()},
			dataType: "JSON",
			success: function (respon) {
				if (respon.status == "Berhasil") {
					ongkosKirim = respon.hargaOngkir;
					totalOngkir = Math.ceil((totalBerat / 1000)) * ongkosKirim;
					grandTotal = totalHarga + totalOngkir;
				}
				$("#ongkosKirim").text("Rp " + ongkosKirim.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1.'));
				$("#totalOngkir").text("Rp " + totalOngkir.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1.'));
				$("#grandTotal").text("Rp " + grandTotal.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1.'));
				updateTransaksi("idOngkir", $("#ongkir").val());
			}
		});
	});
	
	function getKurir(kec, kab, prov) {
		$.ajax({
			url: "../include/getKurir.php",
			type: "POST",
			data: {
				kec: kec,
				kab: kab,
				prov: prov
			},
			dataType: "JSON",
			success: function (respon) {
				if (respon.status == "Berhasil") {
					$("#kurir").html("");
					$.each(respon.kurir, function(i, item) {
						$("#kurir").append("<option value='" + item.idKurir + "'>" + item.namaKurir + "</option>");
						getOngkir();
					});
				} else {
					$("#kurir").html("<option value='0'>Tidak ada kurir</option>");
				}
			}
		});
	}
	function getOngkir() {
		$.ajax({
			url: "../include/getOngkir.php",
			type: "POST",
			data: {
				idKurir: $("#kurir").val(),
				kec: $("#kecamatan").val(),
				kab: $("#kabupaten").val(),
				prov: $("#provinsi").val()
			},
			dataType: "JSON",
			success: function (respon) {
				if (respon.status == "Berhasil") {
					$("#ongkir").html("");
					$.each(respon.ongkir, function(i, item) {
						$("#ongkir").append("<option value='" + item.idOngkir + "'>" + item.namaOngkir + " (Rp " + item.ongkir.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1.') + ")</option>");
					});
					$("#ongkir").change();
					updateTransaksi("idOngkir", $("#ongkir").val());
				} else {
					$("#ongkir").html("<option value='0'>Tidak ada ongkos kirim</option>");
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
				$("#submitBayar").prop("disabled", false);
				$(".helper div").prop("hidden", true);
				if (respon.status == "Proses") {
					updateTransaksi("alamat", $("#alamatLengkap").val());
					updateTransaksi("desa", $("#desa").val());
					updateTransaksi("kecamatan", $("#kecamatan").val());
					updateTransaksi("kabupaten", $("#kabupaten").val());
					updateTransaksi("provinsi", $("#provinsi").val());
					updateTransaksi("tanggal", "<?php echo date("Y-m-d"); ?>");
					updateTransaksi("jam", "<?php echo date("h:i:s"); ?>");
					location.href = "detail_pembayaran.php?id=<?php echo $id; ?>";
				} else if (respon.status != "Proses" && respon.status != "Berhasil") {
					$(".helper span").css("color", "red");
					$(".helper span").html(respon.status);
				}
			}
		});
	}
	function uploadBukti() {
		var formData = new FormData($("#formUpload")[0]);
		formData.append("kdTransaksi", "<?php echo $id; ?>");
		formData.append("field", "buktiLampiran");
		$.ajax({
			url: "../include/updateTransaksi.php",
			type: "POST",
			data: formData,
			dataType: "JSON",
			contentType: false,
			cache: false,
			processData: false,
			success: function (respon) {
				if (respon.status == "Berhasil") {
					$(".helper span").css("color", "green");
					$(".helper span").html("Bukti berhasil diupload");
				} else {
					$(".helper span").css("color", "red");
					$(".helper span").html(respon.status);
				}
			},
			error: function(jqXHR, exception) {
				alert(exception);
			}
		});
	}
	function getKec(kab) {
		$.ajax({
			url: "../include/getKec.php",
			type: "POST",
			data: {
				kab: kab
			},
			dataType: "JSON",
			success: function (respon) {
				$.each(respon.data, function(i, item) {
					$("#kecamatan").append("<option value='" + item.kec + "'>" + item.kec + "</option>");
				});
			}
		});
	}
	function getKab(prov) {
		$.ajax({
			url: "../include/getKab.php",
			type: "POST",
			data: {
				prov: prov
			},
			dataType: "JSON",
			success: function (respon) {
				$.each(respon.data, function(i, item) {
					$("#kabupaten").append("<option value='" + item.kab + "'>" + item.kab + "</option>");
				});
				getKec($("#kabupaten").val());
			}
		});
	}

</script>