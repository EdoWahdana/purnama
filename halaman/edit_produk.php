<?php
include("../include/_koneksi.php");

$id = $_GET["id"];

$query = mysqli_query($conn, "SELECT * FROM produk WHERE idProduk='$id'");
$data = mysqli_fetch_assoc($query);
$nama = $data["namaProduk"];
$deskripsi = $data["deskripsi"];
$kategori = $data["idKategori"];
$harga = $data["harga"];
$gambar = $data["gambar"];
$berat = $data["berat"];
$stok = $data["stok"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Produk</title>
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
			<a href="data_produk.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
			<div class="row">
				<div class="col-lg-3 col-4 side-menu shadow-sm py-4">
					<?php include("_sidemenu_admin.php"); ?>
				</div>
				<div class="col-lg-9 col-8">
					<div class="bg-white shadow-sm p-4 mb-5" style="border-top: 3px solid teal;">
						<form enctype="multipart/form-data" id="formIsian">
							<div class="row mb-3">
								<div class="col-lg-12">
									<label class="border text-center w-100" style="max-height: 300px; cursor: pointer;" id="pilihGambar">
										<div class="py-5 text-muted" hidden>
											<i class="fas fa-image fa-5x"></i>
											<i class="fas fa-plus fa-2x" style="position: absolute;"></i>
										</div>
										<img style="max-height: 200px;" src="<?php echo $gambar; ?>">
										<input type="file" name="gambar" id="gambar" hidden>
									</label>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-lg-3">
									<label for="kategori" class="mt-lg-1">Pilih Kategori</label>
								</div>
								<div class="col-lg-9">
									<select class="form-control" id="kategori" name="kategori">
										<?php
										$query = mysqli_query($conn, "SELECT * FROM kategori");
										if (mysqli_num_rows($query) > 0) {
											while ($data = mysqli_fetch_assoc($query)) {
												if ($data["idKategori"] == $kategori)
													$selected = "selected";
												else
													$selected = "";
												echo "<option value='$data[idKategori]' $selected>$data[nmKategori]</option>";
											}
										} else
											echo "<option value='0'>Tidak ada kategori</option>";
										?>
									</select>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-lg-3">
									<label for="nama" class="mt-lg-1">Nama Produk</label>
								</div>
								<div class="col-lg-9">
									<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-lg-3">
									<label for="deskripsi" class="mt-lg-1">Deskripsi</label>
								</div>
								<div class="col-lg-9">
									<textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"><?php echo $deskripsi; ?></textarea>
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
										<input type="text" class="form-control" id="harga" name="harga" value="<?php echo $harga; ?>">
									</div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-lg-3">
									<label for="stok" class="mt-lg-1">Stok</label>
								</div>
								<div class="col-lg-9">
									<input type="text" class="form-control" id="stok" name="stok" value="<?php echo $stok; ?>">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-lg-3">
									<label for="berat" class="mt-lg-1">Berat</label>
								</div>
								<div class="col-lg-9">
									<div class="input-group">
										<input type="text" class="form-control" id="berat" name="berat" value="<?php echo $berat; ?>">
										<div class="input-group-append">
											<span class="input-group-text">gram</span>
										</div>
									</div>
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
			}
			reader.readAsDataURL(this.files[0]);
		}
	});
	
	$("#formIsian").on("submit", function(e) {
		e.preventDefault();
		var formData = new FormData(this);
		formData.append("id", "<?php echo $id; ?>");
		$("#submitIsian").prop("disabled", true);
		$(".helper div").prop("hidden", false);
		$(".helper span").html("");
		$.ajax({
			url: "../include/updateProduk.php",
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
					location.href = "data_produk.php";
				} else {
					$(".helper span").css("color", "red");
					$(".helper span").html(respon.status);
				}
			}
		});
	});
</script>