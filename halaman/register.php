<?php
include("../include/_koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registrasi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/font-awesome.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<div class="container-fluid px-0">
		<?php include("_menu.php"); ?>
		<div class="konten my-5">
			<div class="rounded-top bg-white shadow p-5 mx-auto" style="width: 50%; border-bottom: 5px solid teal;">
				<div class="text-left"><a href="login.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a></div>
				<p class="text-danger">* harus diisi</p>
				<form enctype="application/x-www-form-urlencoded" id="formRegister">
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="nama" class="mt-lg-1">Nama<span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="nama" name="nama" pattern="[A-Za-z\s]+" required>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="gender" class="mt-lg-3">Gender</label>
						</div>
						<div class="col-lg-9">
							<div class="row">
								<div class="col-6 pr-1">
									<input type="radio" class="radio-custom" id="genderCowo" name="gender" value="L" checked>
									<label for="genderCowo" class="radio-custom-label"><i class="fas fa-mars"></i> Laki - Laki</label>
								</div>
								<div class="col-6 pl-1">
									<input type="radio" class="radio-custom" id="genderCewe" name="gender" value="P">
									<label for="genderCewe" class="radio-custom-label"><i class="fas fa-venus"></i> Perempuan</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="ttl" class="mt-lg-1">TTL<span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
							<input type="date" class="form-control" id="ttl" name="ttl" required>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="email" class="mt-lg-1">Email<span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
							<input type="email" class="form-control" id="email" name="email" required>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="alamat" class="mt-lg-1">Alamat<span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="alamat" name="alamat" required>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="desa" class="mt-lg-1">Desa<span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="desa" name="desa" required>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="kecamatan" class="mt-lg-1">Kecamatan<span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
							<select class="form-control" id="kecamatan" name="kecamatan" required>
							</select>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="kabupaten" class="mt-lg-1">Kabupaten<span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
							<select class="form-control" id="kabupaten" name="kabupaten" required>
							</select>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="provinsi" class="mt-lg-1">Provinsi<span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
							<select class="form-control" id="provinsi" name="provinsi" required>
								<?php
								$query = mysqli_query($conn, "SELECT DISTINCT(prov) FROM ongkir");
								while ($data = mysqli_fetch_assoc($query)) {
									echo "<option value='$data[prov]'>$data[prov]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="username" class="mt-lg-1">Username<span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="username" name="username" required>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="password" class="mt-lg-1">Password<span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
							<input type="password" class="form-control" id="password" name="password" required>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-lg-3">
							<label for="noHp" class="mt-lg-1">Nomor HP<span class="text-danger">*</span></label>
						</div>
						<div class="col-lg-9">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">+62</span>
								</div>
								<input type="text" class="form-control" id="noHp" name="noHp" pattern="[0-9].{10,12}" required>
							</div>
						</div>
					</div>
					<div class="row mr-auto">
						<div class="col-lg-9">
							<button type="submit" class="tombol tombol-teal" id="submitRegister">Register</button>
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
	getKab($("#provinsi").val());
	
	$("#provinsi").on("change keyup", function() {
		getKab($(this).val());
	});
	$("#kabupaten").on("change keyup", function() {
		getKec($(this).val());
	});
	
	$("input[type='text'], input[type='password'], input[type='email'], input[type='date']").on("blur", function() {
		if (!$(this).is(":invalid")) {
			$(this).css("background-color", "#ffffff");
		}
	})
	
	$("#submitRegister").on("click", function() {
		$("#formRegister").submit();
	});
	
	$("#formRegister").on("submit", function(e) {
		if ($("#noHp").is(":invalid")) {
			$("#noHp").focus();
			$("#noHp").css("background-color", "#FD8B8D");
			$("#noHp").prop("placeholder", "Isi nomor HP dengan benar");
		}
		if ($("#password").is(":invalid")) {
			$("#password").focus();
			$("#password").css("background-color", "#FD8B8D");
			$("#password").prop("placeholder", "Isi password terlebih dahulu");
		}
		if ($("#username").is(":invalid")) {
			$("#username").focus();
			$("#username").css("background-color", "#FD8B8D");
			$("#username").prop("placeholder", "Isi username terlebih dahulu");
		}
		if ($("#provinsi").is(":invalid")) {
			$("#provinsi").focus();
			$("#provinsi").css("background-color", "#FD8B8D");
			$("#provinsi").prop("placeholder", "Isi provinsi terlebih dahulu");
		}
		if ($("#kabupaten").is(":invalid")) {
			$("#kabupaten").focus();
			$("#kabupaten").css("background-color", "#FD8B8D");
			$("#kabupaten").prop("placeholder", "Isi kabupaten terlebih dahulu");
		}
		if ($("#kecamatan").is(":invalid")) {
			$("#kecamatan").focus();
			$("#kecamatan").css("background-color", "#FD8B8D");
			$("#kecamatan").prop("placeholder", "Isi kecamatan terlebih dahulu");
		}
		if ($("#desa").is(":invalid")) {
			$("#desa").focus();
			$("#desa").css("background-color", "#FD8B8D");
			$("#desa").prop("placeholder", "Isi desa terlebih dahulu");
		}
		if ($("#alamat").is(":invalid")) {
			$("#alamat").focus();
			$("#alamat").css("background-color", "#FD8B8D");
			$("#alamat").prop("placeholder", "Isi alamat terlebih dahulu");
		}
		if ($("#email").is(":invalid")) {
			$("#email").focus();
			$("#email").css("background-color", "#FD8B8D");
			$("#email").prop("placeholder", "Isi email terlebih dahulu");
		}
		if ($("#ttl").is(":invalid")) {
			$("#ttl").focus();
			$("#ttl").css("background-color", "#FD8B8D");
		}
		if ($("#nama").is(":invalid")) {
			$("#nama").focus();
			$("#nama").css("background-color", "#FD8B8D");
			$("#nama").prop("placeholder", "Isi nama dengan benar");
		}
		e.preventDefault();
		$("#submitRegister").prop("disabled", true);
		$(".helper div").prop("hidden", false);
		$(".helper span").html("");
		$.ajax({
			url: "../include/register.php",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			dataType: "JSON",
			success: function (respon) {
				$("#submitRegister").prop("disabled", false);
				$(".helper div").prop("hidden", true);
				if (respon.status == "Berhasil") {
					$(".helper span").css("color", "green");
					$(".helper span").html("Berhasil membuat akun");
				} else {
					$(".helper span").css("color", "red");
					$(".helper span").html(respon.status);
				}
			}
		});
	});
	
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