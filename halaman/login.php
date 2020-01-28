<?php
include("../include/_koneksi.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Log In</title>
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
				<div class="text-left"><a href="utama.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a></div>
				<form enctype="application/x-www-form-urlencoded" id="formLogIn">
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="username" class="mt-lg-1">Username</label>
						</div>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="username" name="username">
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="password" class="mt-lg-1">Password</label>
						</div>
						<div class="col-lg-9">
							<input type="password" class="form-control" id="password" name="password">
						</div>
					</div>
					<div class="row mr-auto">
						<div class="col">
							<button type="submit" class="tombol tombol-teal" id="submitLogIn">Log In</button>
              <div class="helper" style="display: inline-block;">
                <div class="dot-pulse" style="display: inline-block; margin: 0 20px;" hidden></div>
                <span></span>
							</div>
						</div>
					</div>
				</form>
			</div>
			<p class="text-center mt-3">Belum punya akun? <a href="register.php" style="color: teal">Register</a></p>
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
	$("#submitLogIn").on("click", function() {
		$("#formLogIn").submit();
	});
	
	$("#formLogIn").on("submit", function(e) {
		e.preventDefault();
		$("#submitLogIn").prop("disabled", true);
		$(".helper div").prop("hidden", false);
		$(".helper span").html("");
		$.ajax({
			url: "../include/login.php",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			dataType: "JSON",
			success: function (respon) {
				$("#submitLogIn").prop("disabled", false);
				$(".helper div").prop("hidden", true);
				if (respon.status == "Berhasil") {
					if (respon.akses == "Konsumen") {
						location.href = "utama.php";
					} else {
						location.href = "admin.php";
					}
				} else {
					$(".helper span").css("color", "red");
					$(".helper span").html(respon.status);
				}
			}
		});
	});
</script>