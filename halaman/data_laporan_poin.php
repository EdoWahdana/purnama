<?php
include("../include/_koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Laporan</title>
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
			<div class="row">
				<div class="col-lg-3 col-4 side-menu shadow-sm py-4">
					<?php include("_sidemenu_admin.php"); ?>
				</div>
				<div class="col-lg-9 col-8">
					<div class="bg-white shadow-sm p-4 mb-5" style="border-top: 3px solid teal;">
						<h4 class="mb-3">Laporan Transaksi Poin</h4>
						<form enctype="application/x-www-form-urlencoded" id="formLaporan" action="printTransaksiPoin.php" method="post" target="_blank">
							<div class="row mb-3">
								<div class="col-lg-3">
									<label for="tanggalAwal" class="mt-lg-1">Dari Tanggal</label>
								</div>
								<div class="col-lg-9">
									<input type="date" class="form-control" id="tanggalAwal" name="tanggalAwal">
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-lg-3">
									<label for="tanggalAkhir" class="mt-lg-1">S/D Tanggal</label>
								</div>
								<div class="col-lg-9">
									<input type="date" class="form-control" id="tanggalAkhir" name="tanggalAkhir">
								</div>
							</div>
							<button type="submit" class="tombol tombol-teal">Proses</button>
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
	
</script>