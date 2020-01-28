<?php
include("../include/_koneksi.php");

$id = $_GET["id"];

$query = mysqli_query($conn, "SELECT * FROM reqdesain WHERE nama='$id'");
$data = mysqli_fetch_assoc($query);
$nama = $data["nama"];
$buktiBayar = $data["buktiBayar"];
$gambarDesain = $data["gambarDesain"];

$query1 = mysqli_query($conn, "SELECT alamat,desa,kec,kab,provinsi,noHp,email FROM konsumen INNER JOIN reqdesain ON konsumen.nama=reqdesain.nama");
$data1 = mysqli_fetch_assoc($query1);
$alamat = $data1["alamat"];
$desa = $data1["desa"];
$kec = $data1["kec"];
$kab = $data1["kab"];
$provinsi = $data1["provinsi"];
$noHp = $data1["noHp"];
$email = $data1["email"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Request Desain</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/font-awesome.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body onLoad="window.print();">
	<div class="container-fluid px-0">
		<?php include("_menu.php"); ?>
		<div class="konten">
			<div class="rounded-top bg-white shadow p-5 mx-auto my-5" style="width: 75%; border-bottom: 5px solid teal;">
				<?php if ($_SESSION["akses"] == "Konsumen") { ?>
				<a href="data_transaksi.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
				<?php } elseif ($_SESSION["akses"] == "Admin") { ?>
				<a href="dataRequest.php" class="tombol tombol-teal mb-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
				<?php } ?>
				<h4 class="mb-4">Detail Data Request Desain</h4>
				<?php
				$query = mysqli_query($conn, "SELECT * FROM reqdesain WHERE nama='$nama'");
				$data = mysqli_fetch_assoc($query);
				?>
				<p>Nama: <?php echo $data["nama"]; ?></p>
				<?php
				$query1 = mysqli_query($conn, "SELECT alamat,desa,kec,kab,provinsi,noHp,email FROM konsumen INNER JOIN reqdesain ON konsumen.nama=reqdesain.nama");
				$data1 = mysqli_fetch_assoc($query1);
				?>
				<p>Alamat lengkap: <?php echo $data1["alamat"]; ?> <?php echo $data1["desa"];?> <?php echo $data1["kec"]; ?> <?php echo $data1["kab"]; ?> <?php echo $data1["provinsi"]; ?></p>
				<p>No Hp: <?php echo $data1["noHp"]; ?></p>
				<p>Email: <?php echo $data1["email"]; ?></p>
				<p>Keterangan: <?php echo $data["keterangan"]; ?></p>
				<label class="border text-center w-100">
					<?php
					if ($buktiBayar == "") {
						$hiddenDiv = "";
						$hiddenImg = "hidden";
					} else {
						$hiddenDiv = "hidden";
						$hiddenImg = "";
					}
					?>
					<?php
					if ($gambarDesain == "") {
						$hiddenDiv = "";
						$hiddenImg = "hidden";
					} else {
						$hiddenDiv = "hidden";
						$hiddenImg = "";
					}
					?>
				<div class="table-responsive-lg mt-4">
					<p> Request Desain </p>
					<img class="w-100" src="<?php echo $gambarDesain; ?>" <?php echo $hiddenImg; ?>>
					<div class="py-5 text-muted" <?php echo $hiddenDiv; ?>>
						<i class="fas fa-image fa-5x"></i><br>
						<span>Tidak Ada Desain</span>
					</div>
				</div>
				
				<div class="table-responsive-lg mt-4">
					</p> Bukti Pembayaran </p>
					<img class="w-100" src="<?php echo $buktiBayar; ?>" <?php echo $hiddenImg; ?>>	
					<div class="py-5 text-muted" <?php echo $hiddenDiv; ?>>
						<i class="fas fa-image fa-5x"></i><br>
						<span>Tidak Ada Bukti Pembayaran</span>
					</div>
				</div>
				</label>
				
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

