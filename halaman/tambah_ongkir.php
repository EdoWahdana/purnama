<?php
include("../include/_koneksi.php");

$id = $_GET["id"];

$query = mysqli_query($conn, "SELECT * FROM kurir WHERE idKurir='$id'");
$data = mysqli_fetch_assoc($query);
$namaKurir = $data["namaKurir"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Tambah Ongkos Kirim</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/font-awesome.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<div class="container-fluid px-0">
		<?php include("_menu.php"); ?>
		<div class="konten container mt-5">
			<a href="data_ongkir.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
			<div class="row">
				<div class="col-lg-3 col-4 side-menu shadow-sm py-4">
					<?php include("_sidemenu_admin.php"); ?>
				</div>
				<div class="col-lg-9 col-8">
					<div class="bg-white shadow-sm p-4 mb-5" style="border-top: 3px solid teal;">
						<form enctype="application/x-www-form-urlencoded" id="formIsian">
							<div class="row mb-3">
								<div class="col-lg-3">
									<label for="kurir" class="mt-lg-1">Nama Kurir</label>
								</div>
								<div class="col-lg-9">
									<input type="text" class="form-control" id="kurir" name="kurir" value="<?php echo $namaKurir; ?>" readonly>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-lg-3">
									<label for="ongkir" class="mt-lg-1">Paket Jasa Pengiriman</label>
								</div>
								<div class="col-lg-9">
									<select class="form-control" id="ongkir" name="ongkir">
										<?php
										$query = mysqli_query($conn, "SELECT * FROM ongkirkurir WHERE idKurir='$id'");
										while ($data = mysqli_fetch_assoc($query)) {
											echo "<option value='$data[idOK]'>$data[namaOngkir]</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-lg-3">
									<label for="harga" class="mt-lg-1">Harga</label>
								</div>
								<div class="col-lg-9">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">Rp</span>
										</div>
										<input type="text" class="form-control" id="harga" name="harga">
									</div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-lg-3">
									<label for="kecamatan" class="mt-lg-1">Kecamatan</label>
								</div>
								<div class="col-lg-9">
									<input type="text" class="form-control" id="kecamatan" name="kecamatan">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-lg-3">
									<label for="kabupaten" class="mt-lg-1">Kabupaten</label>
								</div>
								<div class="col-lg-9">
									<input type="text" class="form-control" id="kabupaten" name="kabupaten">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-lg-3">
									<label for="provinsi" class="mt-lg-1">Provinsi</label>
								</div>
								<div class="col-lg-9">
									<input type="text" class="form-control" id="provinsi" name="provinsi">
								</div>
							</div>
							<div class="row mr-auto">
								<div class="col">
									<button type="submit" class="tombol tombol-teal" id="submitIsian">Tambah</button>
									<div class="helper" style="display: inline-block;">
										<div class="dot-pulse" style="display: inline-block; margin: 0 20px;" hidden></div>
										<span></span>
									</div>
								</div>
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
	$("#submitIsian").on("click", function() {
		$("#formIsian").submit();
	});
	
	$("#formIsian").on("submit", function(e) {
		e.preventDefault();
		var formData = new FormData(this);
		formData.append("idKurir", "<?php echo $id; ?>");
		$("#submitIsian").prop("disabled", true);
		$(".helper div").prop("hidden", false);
		$(".helper span").html("");
		$.ajax({
			url: "../include/inputOngkir.php",
			type: "POST",
			data: formData,
			contentType: false,
			cache: false,
			processData: false,
			dataType: "JSON",
			success: function (respon) {
				$("#submitIsian").prop("disabled", false);
				$(".helper div").prop("hidden", true);
				if (respon.status == "Berhasil") {
					location.href = "data_ongkir.php?id=<?php echo $id; ?>";
				} else {
					$(".helper span").css("color", "red");
					$(".helper span").html(respon.status);
				}
			}
		});
	});
</script>