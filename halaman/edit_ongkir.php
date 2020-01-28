<?php
include("../include/_koneksi.php");

$id = $_GET["id"];

$query = mysqli_query($conn, "SELECT * FROM ongkir WHERE idOngkir='$id'");
$data = mysqli_fetch_assoc($query);
$idKurir = $data["idKurir"];
$idOK = $data["idOK"];
$ongkir = $data["ongkir"];
$kec = $data["kec"];
$kab = $data["kab"];
$prov = $data["prov"];

$query = mysqli_query($conn, "SELECT * FROM kurir WHERE idKurir='$idKurir'");
$data = mysqli_fetch_assoc($query);
$namaKurir = $data["namaKurir"];

$query = mysqli_query($conn, "SELECT * FROM ongkirkurir WHERE idOK='$idOK'");
$data = mysqli_fetch_assoc($query);
$namaOngkir = $data["namaOngkir"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Ongkos Kirim</title>
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
									<label for="nama" class="mt-lg-1">Nama Ongkos Kirim</label>
								</div>
								<div class="col-lg-9">
									<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $namaOngkir; ?>" readonly>
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
										<input type="text" class="form-control" id="harga" name="harga" value="<?php echo $ongkir; ?>">
									</div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-lg-3">
									<label for="kecamatan" class="mt-lg-1">Kecamatan</label>
								</div>
								<div class="col-lg-9">
									<input type="text" class="form-control" id="kecamatan" name="kecamatan" value="<?php echo $kec; ?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-lg-3">
									<label for="kabupaten" class="mt-lg-1">Kabupaten</label>
								</div>
								<div class="col-lg-9">
									<input type="text" class="form-control" id="kabupaten" name="kabupaten" value="<?php echo $kab; ?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-lg-3">
									<label for="provinsi" class="mt-lg-1">Provinsi</label>
								</div>
								<div class="col-lg-9">
									<input type="text" class="form-control" id="provinsi" name="provinsi" value="<?php echo $prov; ?>">
								</div>
							</div>
							<div class="row mr-auto">
								<div class="col">
									<button type="submit" class="tombol tombol-teal" id="submitIsian">Update</button>
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
		formData.append("id", "<?php echo $id; ?>");
		$("#submitIsian").prop("disabled", true);
		$(".helper div").prop("hidden", false);
		$(".helper span").html("");
		$.ajax({
			url: "../include/updateOngkir.php",
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
					location.href = "data_ongkir.php?id=<?php echo $idKurir; ?>";
				} else {
					$(".helper span").css("color", "red");
					$(".helper span").html(respon.status);
				}
			}
		});
	});
</script>