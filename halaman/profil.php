<?php
include("../include/_koneksi.php");

$username = $_GET["username"];

$query = mysqli_query($conn, "SELECT * FROM konsumen WHERE username='$username'");
if (mysqli_num_rows($query) > 0) {
	$data = mysqli_fetch_assoc($query);
	$nama = $data["nama"];
	$gender = $data["gender"];
	$ttl = $data["ttl"];
	$email = $data["email"];
	$alamat = $data["alamat"];
	$desa = $data["desa"];
	$kec = $data["kec"];
	$kab = $data["kab"];
	$provinsi = $data["provinsi"];
	$noHp = $data["noHp"];
	$poin = $data["poin"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profil</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/font-awesome.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<div class="container-fluid px-0">
		<?php include("_menu.php"); ?>
		<div class="konten container my-5">
			<a href="utama.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
			<div class="row">
				<div class="col-lg-3 col-4">
					<?php include("_sidemenu_konsumen.php"); ?>
				</div>
				<div class="col-lg-9 col-8">
					<div class="rounded-top bg-white shadow p-5 mx-auto" style="border-bottom: 5px solid teal;">
						<div class="row mb-3">
							<div class="col-lg-3">
								<span>Nama Lengkap:</span>
							</div>
							<div class="col-lg-9">
								<span><?php echo $nama; ?></span>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-lg-3">
								<span>Gender:</span>
							</div>
							<div class="col-lg-9">
								<span>
									<?php
									if ($gender == "L")
										echo "Laki-laki";
									else
										echo "Perempuan";
									?>
								</span>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-lg-3">
								<span>TTL:</span>
							</div>
							<div class="col-lg-9">
								<span><?php echo tanggalLengkap(strtotime($ttl)); ?></span>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-lg-3">
								<span>Email:</span>
							</div>
							<div class="col-lg-9">
								<span><?php echo $email; ?></span>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-lg-3">
								<span>Alamat:</span>
							</div>
							<div class="col-lg-9">
								<span><?php echo $alamat; ?></span>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-lg-3">
								<span>Desa:</span>
							</div>
							<div class="col-lg-9">
								<span><?php echo $desa; ?></span>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-lg-3">
								<span>Kecamatan:</span>
							</div>
							<div class="col-lg-9">
								<span><?php echo $kec; ?></span>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-lg-3">
								<span>Kabupaten:</span>
							</div>
							<div class="col-lg-9">
								<span><?php echo $kab; ?></span>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-lg-3">
								<span>Provinsi:</span>
							</div>
							<div class="col-lg-9">
								<span><?php echo $provinsi; ?></span>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-lg-3">
								<span>Username:</span>
							</div>
							<div class="col-lg-9">
								<span><?php echo $username; ?></span>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-lg-3">
								<span>Nomor HP:</span>
							</div>
							<div class="col-lg-9">
								<span>+62<?php echo $noHp; ?></span>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-lg-3">
								<span>Poin:</span>
							</div>
							<div class="col-lg-9">
								<span><?php echo $poin; ?></span>
							</div>
						</div>
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
	
</script>