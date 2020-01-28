<?php
include("../include/_koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Kirim Kritik &amp; Saran</title>
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
			<div class="rounded-top bg-white shadow p-5 mx-auto" style="width: 50%; border-bottom: 5px solid teal; margin-top: 85px;">
				<div class="text-left"><a href="kontak.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a></div>
				<form enctype="application/x-www-form-urlencoded" id="formPesan">
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="subjek" class="mt-lg-1">Subjek</label>
						</div>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="subjek" name="subjek">
						</div>
					</div>
					<label for="isi">Isi Pesan</label>
					<textarea class="form-control mb-3" name="isi" id="isi" rows="5" placeholder="Isi pesan"></textarea>
					<div class="row mr-auto">
						<div class="col">
							<button type="submit" class="tombol tombol-teal" id="submitPesan">Kirim</button>
              <div class="helper" style="display: inline-block;">
                <div class="dot-pulse" style="display: inline-block; margin: 0 20px;" hidden></div>
                <span></span>
							</div>
						</div>
					</div>
				</form>
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
	$("#submitPesan").on("click", function() {
		$("#formPesan").submit();
	});
	
	$("#formPesan").on("submit", function(e) {
		e.preventDefault();
		$("#submitPesan").prop("disabled", true);
		$(".helper div").prop("hidden", false);
		$(".helper span").html("");
		$.ajax({
			url: "../include/inputKritik.php",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			dataType: "JSON",
			success: function (respon) {
				$("#submitPesan").prop("disabled", false);
				$(".helper div").prop("hidden", true);
				if (respon.status == "Berhasil") {
					$(".helper span").css("color", "green");
					$(".helper span").html("Berhasil mengirim pesan");
					setTimeout(function() {
						location.href = "kontak.php";
					}, 2000);
				} else {
					$(".helper span").css("color", "red");
					$(".helper span").html(respon.status);
				}
			}
		});
	});
</script>