<?php
include("../include/_koneksi.php");

$id = $_GET["id"];

$query = mysqli_query($conn, "SELECT * FROM kategori WHERE idKategori='$id'");
$data = mysqli_fetch_assoc($query);
$nama = $data["nmKategori"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Kategori Produk</title>
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
			<a href="data_kategori.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
			<div class="row">
				<div class="col-lg-3 col-4 side-menu shadow-sm py-4">
					<?php include("_sidemenu_admin.php"); ?>
				</div>
				<div class="col-lg-9 col-8">
					<div class="bg-white shadow-sm p-4 mb-5" style="border-top: 3px solid teal;">
						<form enctype="application/x-www-form-urlencoded" id="formIsian">
							<div class="row mb-3">
								<div class="col-lg-3">
									<label for="nama" class="mt-lg-1">Nama Kategori</label>
								</div>
								<div class="col-lg-9">
									<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
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
			url: "../include/updateKategori.php",
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
					location.href = "data_kategori.php";
				} else {
					$(".helper span").css("color", "red");
					$(".helper span").html(respon.status);
				}
			}
		});
	});
</script>